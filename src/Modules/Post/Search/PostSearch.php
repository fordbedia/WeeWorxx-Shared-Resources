<?php

namespace WeeWorxxSDK\SharedResources\Modules\Post\Search;

use WeeWorxxSDK\SharedResources\Modules\Post\DTO\PostSearchCriteria;
use WeeWorxxSDK\SharedResources\Modules\Post\Repository\Contracts\PostRepositoryInterface;
use WeeWorxxSDK\SharedResources\Modules\Post\Repository\Eloquents\PostRepository;
use WeeWorxxSDK\SharedResources\Modules\Post\Resources\SearchPostResource;
use WeeWorxxSDK\SharedResources\Modules\Post\Search\Contracts\PostSearchEngine;
use WeeWorxxSDK\SharedResources\Modules\User\Traits\PostRelation;

class PostSearch
{
	use PostRelation;

	public function __construct(protected PostSearchEngine $engine){}

	public function search(PostSearchCriteria $criteria)
	{
		$sql = $this->engine->constructQuery($criteria)
			->build();

		$paginator = PostRepository::sqlToEloquent($sql)->with($this->postRelation)
			->active()
			->paginate(10)
			->through(fn ($post) => (new SearchPostResource($post))->toArray(request()));

		return array_merge($paginator->toArray(), [
			'sql_query' => $sql,
		]);
	}
}