<?php

namespace WeeWorxxSDK\SharedResources\Modules\Post\Searches;

interface SearchConstructor
{
	public function tableJoins(): array;

	public function constructQuery(): array;
}