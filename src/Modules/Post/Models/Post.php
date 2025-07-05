<?php

namespace WeeWorxxSDK\SharedResources\Modules\Post\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use WeeWorxxSDK\SharedResources\Modules\Post\Database\Factories\PostFactory;

class Post extends Model
{
    use HasFactory;

    protected static function newFactory()
    {
        return PostFactory::new();
    }
}
