<?php

namespace WeeWorxxSDK\SharedResources\Modules\Post\Models;


use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use WeeWorxxSDK\SharedResources\Modules\Post\Database\Factories\SkillsFactory;
use WeeWorxxSDK\SharedResources\Modules\WWApp\Traits\Identifiable;

class Skills extends Model
{
    use HasFactory, Identifiable;

    protected $table = 'skills';

    protected $guarded = [];

    protected static function newFactory()
    {
        return SkillsFactory::new();
    }
}
