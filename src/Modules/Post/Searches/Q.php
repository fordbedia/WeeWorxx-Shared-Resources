<?php

namespace WeeWorxxSDK\SharedResources\Modules\Post\Searches;

final class Q implements SearchConstructor
{
	public function constructQuery(): array
	{
		return [
			'type' => 'table',
			'comparison' => '%LIKE%',
			'key' => 'q',
			'column' => 'posts.title'
		];
	}

	/**
	 * @return array
	 */
	public function tableJoins(): array
	{
		return [];
	}
}