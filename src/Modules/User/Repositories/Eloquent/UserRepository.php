<?php

namespace WeeWorxxSDK\SharedResources\Modules\User\Repositories\Eloquent;

use Illuminate\Database\Eloquent\Model;
use WeeWorxxSDK\SharedResources\Modules\User\Models\User;
use WeeWorxxSDK\SharedResources\Modules\User\Repositories\BaseRepository;
use WeeWorxxSDK\SharedResources\Modules\User\Repositories\Contracts\UserRepositoryInterface;
use WeeWorxxSDK\SharedResources\SDK\Exception\RepositoryException;

class UserRepository extends BaseRepository implements UserRepositoryInterface
{
    public function makeModel(): string
    {
        return User::class;
    }

    public function paginate(
        $query = null,
        int $perPage = 15,
        array $columns = ['*'],
        string $pageName = 'page',
        int|null $page = null
    ) {
        // Add custom condition(s)
        $query = $this->model->newQuery()->where('active', true);

        // You can chain more: ->where('type', 'admin')->orderBy('name')
        return parent::paginate($query, $perPage, $columns, $pageName, $page);
    }

    /**
     * @throws RepositoryException
     */
    public function create(array $data): User
    {
        if ($this->isExists('email', $data['email'])) {
            throw new RepositoryException('User already exists.', 503);
        }
        return $this->model->create(array_merge($data, ['password' => bcrypt($data['password'])]));
    }
}