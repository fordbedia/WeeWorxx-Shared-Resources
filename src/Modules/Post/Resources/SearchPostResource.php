<?php

namespace WeeWorxxSDK\SharedResources\Modules\Post\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class SearchPostResource extends JsonResource
{
	public function toArray($request)
	{
		return parent::toArray($request);
	}
}