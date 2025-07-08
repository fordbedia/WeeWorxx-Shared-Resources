<?php

namespace WeeWorxxSDK\SharedResources\Modules\Post\Models;


use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use WeeWorxxSDK\SharedResources\Modules\Post\Database\Factories\BenefitsFactory;

class Benefits extends Model
{
    use HasFactory;

    protected $table = 'benefits';
    protected $guarded = [];

    protected static function newFactory()
    {
        return BenefitsFactory::new();
    }
}
