<?php

namespace WeeWorxxSDK\SharedResources\Modules\Post\Searches;

class Company implements SearchConstructor
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
			'key' => 'company',
			'column' => 'posts.company_name'
		];
	}
}