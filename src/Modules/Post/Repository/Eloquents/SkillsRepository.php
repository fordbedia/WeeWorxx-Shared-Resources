<?php

namespace WeeWorxxSDK\SharedResources\Modules\Post\Repository\Eloquents;

use WeeWorxxSDK\SharedResources\Modules\Post\Models\Skills;
use WeeWorxxSDK\SharedResources\Modules\Post\Repository\BaseRepository;
use WeeWorxxSDK\SharedResources\Modules\Post\Repository\Contracts\SkillsRepositoryInterface;
use \Illuminate\Database\Eloquent\Model;

class SkillsRepository extends BaseRepository implements SkillsRepositoryInterface
{
	public function create(array $data): Model|array
	{
		if (array_is_list($data)) {
			$ids = [];
			foreach($data as $d) {
				$ids[] = $this->model->firstOrCreate($d)->id;
			}
			return $ids;
		} else {
			return $this->model->firstOrCreate($data);
		}
	}

	public function makeModel(): string
	{
		return Skills::class;
	}
}