<?php

namespace WeeWorxxSDK\SharedResources\Modules\Post\Models;


use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PostStatuses extends Model
{
    use HasFactory;

    protected $table = 'post_statuses';

    protected $guarded = [];
}
