<?php

namespace WeeWorxxSDK\SharedResources\Modules\Post\Searches;

class Location implements SearchConstructor
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
			'key' => 'location',
			'column' => 'posts.job_location'
		];
	}
}