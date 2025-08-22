<?php

namespace WeeWorxxSDK\SharedResources\Modules\User\Collections;

use Illuminate\Http\Resources\Json\JsonResource;
use WeeWorxxSDK\SharedResources\Modules\User\Enums\PostStatus;

class CheckoutPost extends JsonResource
{
	public function toArray($request): array
	{
		$skills = collect($this->resource['skills'])->mapWithKeys(fn ($skill, $i) => [$i => ['name' => $skill]])->toArray();
		$benefits = collect($this->resource['benefits'])->mapWithKeys(fn ($benefits, $i) => [$i => ['name' => $benefits]])->toArray();
		$post = collect($this->resource)
			->merge(['posted_by' => $this->resource['user']['id'], 'post_status_id' => PostStatus::ACTIVE->getId()])
			->except(['user', 'skills', 'benefits'])
			->toArray();

		return [
			'user' => $this->resource['user'],
			'post' => $post,
			'benefits' => $benefits,
			'skills' => $skills,
		];
	}
}