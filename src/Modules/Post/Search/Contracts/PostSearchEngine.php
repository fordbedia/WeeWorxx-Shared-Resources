<?php

namespace WeeWorxxSDK\SharedResources\Modules\Post\Search\Contracts;

interface PostSearchEngine
{
	public function build(): string;
}