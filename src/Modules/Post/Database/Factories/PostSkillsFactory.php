<?php

namespace WeeWorxxSDK\SharedResources\Modules\Post\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use WeeWorxxSDK\SharedResources\Modules\Post\Models\Post;
use WeeWorxxSDK\SharedResources\Modules\Post\Models\PostSkills;
use WeeWorxxSDK\SharedResources\Modules\Post\Models\Skills;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\{{ namespacedModel }}>
 */
class PostSkillsFactory extends Factory
{
    protected string $model = PostSkills::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $postId = Post::where('id', rand(1,50))->pluck('id')->first();
        $skillsId = Skills::where('id', rand(1,50))->pluck('id')->first();
        return [
            'skills_id' => $skillsId,
            'post_id' => $postId
        ];
    }
}
