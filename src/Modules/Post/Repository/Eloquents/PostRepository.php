<?php

namespace WeeWorxxSDK\SharedResources\Modules\Post\Repository\Eloquents;

use Illuminate\Database\Eloquent\Builder;
use WeeWorxxSDK\SharedResources\Modules\Post\Models\Post;
use WeeWorxxSDK\SharedResources\Modules\Post\Repository\BaseRepository;
use WeeWorxxSDK\SharedResources\Modules\Post\Repository\Contracts\PostRepositoryInterface;

class PostRepository extends BaseRepository implements PostRepositoryInterface
{
    public function makeModel(): string
    {
        return Post::class;
    }

    public function create(array $data): Post
    {
        return $this->model->create($data);
    }

		public static function sqlToEloquent(string $sql, array $bindings = []): Builder
		{
			return Post::query()->fromSub(function ($q) use ($sql, $bindings) {
				$q->fromRaw("({$sql}) as sub", $bindings);
			}, 'sub')
				->select('sub.*');
		}
}
