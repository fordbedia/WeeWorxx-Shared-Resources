<?php

namespace WeeWorxxSDK\SharedResources\Modules\Post\Models;


use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use WeeWorxxSDK\SharedResources\Modules\Post\Database\Factories\PostSkillsFactory;

class PostSkills extends Model
{
    use HasFactory;

    protected $table = 'post_skills';

    protected $guarded = [];

    protected static function newFactory()
    {
        return PostSkillsFactory::new();
    }
}
