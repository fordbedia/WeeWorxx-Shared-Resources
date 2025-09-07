<?php

namespace WeeWorxxSDK\SharedResources\Modules\Post\Searches;

class Salary implements SearchConstructor
{

	/**
	 * @return array
	 */
	public function tableJoins(): array
	{
		return [];
	}

	/**
	 * @return array
	 */
	public function constructQuery(): array
	{
		return [
			'type' => 'table',
			'comparison' => '%LIKE%',
			'key' => 'salary',
			'column' => 'posts.salary'
		];
	}
}