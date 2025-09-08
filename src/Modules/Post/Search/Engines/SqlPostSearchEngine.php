<?php

namespace WeeWorxxSDK\SharedResources\Modules\Post\Search\Engines;

use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use ReflectionClass;
use WeeWorxxSDK\SharedResources\Modules\Post\DTO\PostSearchCriteria;
use WeeWorxxSDK\SharedResources\Modules\Post\DTO\PostSearchCriteriaToSql;
use WeeWorxxSDK\SharedResources\Modules\Post\Search\Contracts\PostSearchEngine;
use WeeWorxxSDK\SharedResources\Modules\Post\Searches\SearchConstructor;

class SqlPostSearchEngine implements PostSearchEngine
{
	protected array $queryDataSet = [];

	protected string $query;

	protected string $defaultTable = 'posts';

	protected string $connection = 'weeworx';

	protected ?bool $hasSearchTestPost = null;

	public function __construct()
	{

	}

	protected function resolveClasses(Collection $classes)
	{
		return $classes->map(function ($class) {
			return app($class);
		});
	}

	public function constructQuery(PostSearchCriteria $criteria): self
	{
		$searchIntances = $this->resolveClasses($this->mapClasses())->toArray();
		$classKeywords = $this->getKeys($criteria);
		if (empty($classKeywords)) {
			abort(400, 'Something went wrong with the search criteria.');
		}

		$this->hasSearchTestPost = $criteria->getTest();

		foreach($classKeywords as $index => $classKeyword) {
			if (!isset($searchIntances[$classKeyword])){
				continue;
			}
			$instance = $searchIntances[$classKeyword];
			if (($constructQuery = $instance->constructQuery()) && !empty($instance->constructQuery())) {
				$key = isset($instance->constructQuery()['key']) ? $instance->constructQuery()['key'] : null;
				$column = isset($instance->constructQuery()['column']) ? $instance->constructQuery()['column'] : null;
				$comparison = isset($instance->constructQuery()['comparison']) ? $instance->constructQuery()['comparison'] : null;
				$value = $criteria->{'get'.ucfirst($key)}();
				if ($constructQuery['type'] === 'table') {
					// ----------------------------------------------------------------------------
					// Check each array from the `tableJoin` array keys if it;s present,
					// if present, then add into the array, otherwise, just proceed without the joins.
					// ----------------------------------------------------------------------------
					$joins = $this->iterateJoins($instance, $constructQuery);

					if ($value) {
						$formattedValue = $this->getFormattedValue($comparison, $value);
						$where = "{$column} {$this->trimComparisonString($comparison)} $formattedValue";
						$this->setQueryDataSet('table', $where, $joins);
					}

				} else if ($constructQuery['type'] === '*raw*') {
					// For RAW SQLs
					$joins = $this->iterateJoins($instance, $constructQuery);
					$where = $constructQuery['raw']($value);
					$this->setQueryDataSet('*raw*', $where, $joins);
				}
			}
		}
		return $this;
	}

	public function build(): string
	{
		$this->query = "SELECT $this->connection.posts.* FROM {$this->connection}.{$this->defaultTable} ";

		$joins = collect();
		$where = collect();
		foreach($this->getQueryDataSet() as $key => $types) {
			foreach($types as $type) {
				$joins->push($type['join']);
				$where->push($type['where']);
			}
		}
		$joins = $joins->filter()->values()->flatten();

		$where = $where->filter()->values();
		if ($where->isNotEmpty()) {
			$first = $where->shift();
			$where = collect([$first])
				->concat($where->flatMap(fn ($v) => ['OR', $v]))->values();
		}

		// ----------------------------------------------------------------------------
		// Concatenate all joins
		// ----------------------------------------------------------------------------
		$this->query = $this->query . $joins->implode(' ');
		// ----------------------------------------------------------------------------
		// Concatenate the where clauses' arguments
		// ----------------------------------------------------------------------------
		$this->query = $this->query . " WHERE " . $where->implode(' ');

		// ----------------------------------------------------------------------------
		// Guard this feature so test posts can only accessible by authenticated users
		// ----------------------------------------------------------------------------
		if (Auth::user()) {
			$isTestValue = (int) $this->hasSearchTestPost;
			$this->query = $this->query . " AND posts.is_test = {$isTestValue}";
		}

		$lastStatementClauses = " GROUP BY posts.id ORDER BY posts.title DESC";

		$this->query = $this->query . $lastStatementClauses;

		return $this->getQuery();
	}

	protected function iterateJoins(SearchConstructor $instance, array $constructQuery)
	{
		$joins = [];
		if (array_key_exists('tableJoin', $constructQuery)) {
			foreach ($constructQuery['tableJoin'] as $join) {
				if (array_key_exists($join, $instance->tableJoins())) {
					$joins[] = $instance->tableJoins()[$join];
				}
			}
		}
		return $joins;
	}

	protected function getKeys(PostSearchCriteria $criteria): array
	{
		return $criteria->sortKeys();
	}

	public function setQueryDataSet($name, $where, $joins = []): array
	{
		$arr = [
			'join' => $joins,
			'where' => $where
		];

		$this->queryDataSet[$name][] = $arr;

		return $this->queryDataSet;
	}

	public function getQueryDataSet(): array
	{
		return $this->queryDataSet;
	}

	protected function mapClasses()
	{
		$path = base_path('../shared-resources/src/Modules/Post/Searches');
		$namespace = "\\WeeWorxxSDK\\SharedResources\\Modules\\Post\Searches";
		$requiredInterface = "WeeWorxxSDK\\SharedResources\\Modules\\Post\\Searches\\SearchConstructor";

		return collect(File::allFiles($path))
			->mapWithKeys(function($file) use ($namespace, $requiredInterface) {
				$class = $namespace . '\\' . $file->getFilenameWithoutExtension();
				$reflection = new ReflectionClass($class);
				if (in_array($requiredInterface, $reflection->getInterfaceNames())) {
					return [lcfirst(class_basename($reflection->getShortName())) => $class];
				}
				return [];
			})
			->filter(function ($class) {
        return class_exists($class);
			});
	}

	protected function getFormattedValue(string $comparison, string $value): string
	{
		return match ($comparison) {
			'IN' => "({$this->toString($value)})",
			'LIKE' => "'{$value}'",
			'%LIKE' => "'%{$value}'",
			'%LIKE%' => "'%{$value}%'",
			default => is_numeric($value) ? $value : "'".trim($value)."'",
		};
	}

	protected function toString(string $value)
	{
		return collect(explode(',',$value))->map(fn ($v) => "'".trim($v)."'")->implode(', ');
	}

	protected function trimComparisonString($instance): string
	{
		if (preg_match('/^%?(.+?)%?$/', $instance, $comparison)) {
			return $comparison[1];
		}

		return $instance;
	}

	public function getQuery(): string
	{
		return $this->query;
	}
}
