<?php

namespace WeeWorxxSDK\SharedResources\Modules\Post\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use WeeWorxxSDK\SharedResources\Modules\Post\Database\Factories\PostFactory;
use WeeWorxxSDK\SharedResources\Modules\User\Models\User;

class Post extends Model
{
    use HasFactory;

    protected $table = 'posts';
    protected $guarded = [];

    public function company()
    {
        return $this->hasOne(Company::class, 'id', 'company_id');
    }

    public function postedBy()
    {
        return $this->hasOne(User::class, 'id', 'posted_by');
    }

    public function status()
    {
        return $this->hasOne(PostStatuses::class, 'id', 'post_status_id');
    }

    protected static function newFactory()
    {
        return PostFactory::new();
    }
}
