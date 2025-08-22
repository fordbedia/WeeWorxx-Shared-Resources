<?php

namespace WeeWorxxSDK\SharedResources\Modules\User\Services\Contracts;

use Illuminate\Database\Eloquent\Model;

interface PostServicesInterface
{
	public function create(array|Model $data);
}