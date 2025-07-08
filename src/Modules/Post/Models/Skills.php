<?php

namespace WeeWorxxSDK\SharedResources\Modules\Post\Models;


use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use WeeWorxxSDK\SharedResources\Modules\Post\Database\Factories\SkillsFactory;

class Skills extends Model
{
    use HasFactory;

    protected $table = 'skills';

    protected $guarded = [];

    protected static function newFactory()
    {
        return SkillsFactory::new();
    }
}
