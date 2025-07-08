<?php

namespace WeeWorxxSDK\SharedResources\Modules\Post\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use WeeWorxxSDK\SharedResources\Modules\Post\Models\Benefits;
use WeeWorxxSDK\SharedResources\Modules\Post\Models\Post;
use WeeWorxxSDK\SharedResources\Modules\Post\Models\PostBenefits;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\{{ namespacedModel }}>
 */
class PostBenefitsFactory extends Factory
{
    protected string $model = PostBenefits::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $benefitsId = Benefits::where('id', rand(1,50))->pluck('id')->first();
        $postId = Post::where('id', rand(1,50))->pluck('id')->first();
        return [
            'benefits_id' => $benefitsId,
            'post_id' => $postId
        ];
    }
}
