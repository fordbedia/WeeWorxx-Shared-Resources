<?php

namespace WeeWorxxSDK\SharedResources\Modules\Post\Searches;

class Test implements SearchConstructor
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
			'type' => '*raw*',
			'key' => 'test',
			'raw' => function($value){
				return "posts.is_test != 1";
			}
		];
	}
}