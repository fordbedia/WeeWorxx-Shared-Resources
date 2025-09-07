<?php

namespace WeeWorxxSDK\SharedResources\Modules\Post\Searches;

class EmpType implements SearchConstructor
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
			'comparison' => '=',
			'key' => 'empType',
			'column' => 'posts.employment_type'
		];
	}
}