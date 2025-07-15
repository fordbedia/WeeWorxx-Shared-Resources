<?php

namespace WeeWorxxSDK\SharedResources\Modules\Post\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use WeeWorxxSDK\SharedResources\Modules\Post\Database\Factories\PostFactory;
use WeeWorxxSDK\SharedResources\Modules\User\Models\User;

class Post extends Model
{
    use HasFactory;

    protected $table = 'posts';
    protected $guarded = [];

    protected static function booted()
    {
        static::created(function($post) {
            if (!empty($post->title)) {
                $post->permalink = Str::slug($post->title);
                $hasDuplicatePermalink = self::where('permalink', $post->permalink)->exists();
                if ($hasDuplicatePermalink) {
                    $post->permalink = Str::slug($post->title .'-'.$post->id);
                }
                $post->save();
            }
        });
    }

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

    public function skills()
    {
        return $this->belongsToMany(
            Skills::class,
            'post_skills',
            'post_id',
            'skills_id',
            'id',
            'id'
        )->withTimestamps();
    }

    public function benefits()
    {
        return $this->belongsToMany(
            Benefits::class,
            'post_benefits',
            'post_id',
            'benefits_id',
            'id',
            'id'
        )->withTimestamps();
    }
}
