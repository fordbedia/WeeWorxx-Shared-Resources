<?php

namespace WeeWorxxSDK\SharedResources\Modules\Post\Models;


use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use WeeWorxxSDK\SharedResources\Modules\Post\Database\Factories\PostBenefitsFactory;

class PostBenefits extends Model
{
    use HasFactory;

    protected $table = 'post_benefits';

    protected $guarded = [];

    protected static function newFactory()
    {
        return PostBenefitsFactory::new();
    }
}
