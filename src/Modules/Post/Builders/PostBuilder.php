<?php

namespace WeeWorxxSDK\SharedResources\Modules\Post\Builders;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;

class PostBuilder extends Builder
{
	public function active()
	{
		$today = Carbon::today();
		return $this->whereDate('valid_at', '>=', $today);
	}

	public function addValidity(int|array|null $id = null, ?int $days = null): int
	{
		$days ??= 30;
		$query = $this;
		if ($id !== null) {
			// allow single id or array of ids
			$query = $query->whereKey($id);
		}
		return $query->update([
			'valid_at' => now()->addDays($days),
		]);
	}
}