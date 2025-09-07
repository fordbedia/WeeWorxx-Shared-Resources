<?php

namespace WeeWorxxSDK\SharedResources\Modules\Post\Search;

use WeeWorxxSDK\SharedResources\Modules\Post\DTO\PostSearchCriteria;
use WeeWorxxSDK\SharedResources\Modules\Post\Repository\Contracts\PostRepositoryInterface;
use WeeWorxxSDK\SharedResources\Modules\Post\Repository\Eloquents\PostRepository;
use WeeWorxxSDK\SharedResources\Modules\Post\Search\Contracts\PostSearchEngine;

class PostSearch
{
	public function __construct(protected PostSearchEngine $engine){}

	public function search(PostSearchCriteria $criteria)
	{
		$sql = $this->engine->constructQuery($criteria)
			->build();

		return PostRepository::sqlToEloquent($sql)->paginate(10);
	}
}