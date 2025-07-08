<?php

namespace WeeWorxxSDK\SharedResources\Modules\Post\Models;


use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use WeeWorxxSDK\SharedResources\Modules\Post\Database\Factories\PayFactory;

class Pay extends Model
{
    use HasFactory;

    protected $table = 'pay';
    protected $guarded = [];

    protected static function newFactory()
    {
        return PayFactory::new();
    }
}
