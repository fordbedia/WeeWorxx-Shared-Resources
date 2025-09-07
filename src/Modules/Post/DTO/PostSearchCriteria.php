<?php

namespace WeeWorxxSDK\SharedResources\Modules\Post\DTO;

use JsonSerializable;
use WeeWorxxSDK\SharedResources\Modules\Post\Traits\PostSearchCriteriaTrait;
use WeeWorxxSDK\SharedResources\SDK\Traits\AttributesCallable;

final class PostSearchCriteria implements JsonSerializable
{
	use PostSearchCriteriaTrait, AttributesCallable;

	public function __construct(
		protected readonly string $q,
		protected readonly ?string $location,
		protected readonly ?string $company,
		protected readonly ?string $empType,
		protected readonly ?string $salary,
		protected readonly ?string $benefits,
		protected readonly ?string $skills,
		protected readonly ?string $test
	){}

	public function sortKeys(): array
	{
		return [
				'q',
				'skills',
				'benefits',
				'location',
				'company',
				'empType',
				'salary',
				'test',
		];
	}

	public function get(): object
	{
		return (object) [
			'q' => $this->getQ(),
			'location' => $this->getLocation(),
			'company' => $this->getCompany(),
			'empType' => $this->getEmpType(),
			'salary' => $this->getSalary(),
			'benefits' => $this->getBenefits(),
			'skills' => $this->getSkills(),
			'test' => $this->getTest(),
		];
	}

	public function toArray(): array
	{
		return get_object_vars($this);
	}

	/**
	 * Specify data which should be serialized to JSON
	 * @link https://php.net/manual/en/jsonserializable.jsonserialize.php
	 * @return mixed data which can be serialized by <b>json_encode</b>,
	 * which is a value of any type other than a resource.
	 * @since 5.4
	 */
	public function jsonSerialize(): mixed
	{
		return $this->toArray();
	}
}