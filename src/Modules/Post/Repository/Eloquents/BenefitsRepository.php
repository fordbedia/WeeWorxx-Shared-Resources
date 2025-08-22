<?php

namespace WeeWorxxSDK\SharedResources\Modules\Post\Repository\Eloquents;

use WeeWorxxSDK\SharedResources\Modules\Post\Models\Benefits;
use WeeWorxxSDK\SharedResources\Modules\Post\Repository\BaseRepository;
use Illuminate\Database\Eloquent\Model;
use WeeWorxxSDK\SharedResources\Modules\Post\Repository\Contracts\BenefitsRepositoryInterface;

class BenefitsRepository extends BaseRepository implements BenefitsRepositoryInterface
{
	public function create(array $data): array|Model
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
		return Benefits::class;
	}
}