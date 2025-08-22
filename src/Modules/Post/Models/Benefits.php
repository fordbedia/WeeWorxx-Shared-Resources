<?php

namespace WeeWorxxSDK\SharedResources\Modules\Post\Models;


use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use WeeWorxxSDK\SharedResources\Modules\Post\Database\Factories\BenefitsFactory;
use WeeWorxxSDK\SharedResources\Modules\WWApp\Traits\Identifiable;

class Benefits extends Model
{
    use HasFactory, Identifiable;

    protected $table = 'benefits';
    protected $guarded = [];

    protected static function newFactory()
    {
        return BenefitsFactory::new();
    }
}
