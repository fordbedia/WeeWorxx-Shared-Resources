<?php

namespace WeeWorxxSDK\SharedResources\Modules\Post\Searches;

class Benefits implements SearchConstructor
{

	/**
	 * @return array
	 */
	public function tableJoins(): array
	{
		return [
			'pb' => 'inner join post_benefits pb on pb.post_id = posts.id',
			'benefits' => 'inner join benefits b on b.id = pb.benefits_id',
		];
	}

	/**
	 * @return array
	 */
	public function constructQuery(): array
	{
		return [
			'type' => 'table',
			'tableJoin' => ['pb', 'benefits'],
			'comparison' => 'IN',
			'key' => 'benefits',
			'column' => 'b.name'
		];
	}
}