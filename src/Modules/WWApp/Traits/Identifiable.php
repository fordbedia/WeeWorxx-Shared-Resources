<?php

namespace WeeWorxxSDK\SharedResources\Modules\WWApp\Traits;

use Illuminate\Support\Str;

trait Identifiable
{
	protected static function bootIdentifiable()
	{
		static::creating(function ($model) {
			$model->identifier = Str::snake($model->name);
		});
	}
}