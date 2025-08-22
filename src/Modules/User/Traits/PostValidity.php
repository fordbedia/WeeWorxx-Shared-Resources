<?php

namespace WeeWorxxSDK\SharedResources\Modules\User\Traits;

use Carbon\Carbon;

trait PostValidity
{
	protected static function bootPostValidity()
	{
		static::creating(function ($model) {
			$model->valid_at = Carbon::now()->addMonths(1);
		});
	}
}