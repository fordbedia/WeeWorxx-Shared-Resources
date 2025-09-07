<?php

namespace WeeWorxxSDK\SharedResources\Modules\Post\Searches;

final class Skills implements SearchConstructor
{
	public function tableJoins(): array
	{
		return [
			'ps' => 'inner join post_skills ps ON ps.post_id = posts.id',
			'skills' => 'inner join skills s ON s.id = ps.skills_id',
		];
	}

	public function constructQuery(): array
	{
		return [
			'type' => 'table',
			'tableJoin' => ['ps', 'skills'],
			'comparison' => 'IN',
			'key' => 'skills',
			'column' => 's.name'
		];
	}
}