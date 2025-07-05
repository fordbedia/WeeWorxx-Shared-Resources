<?php

namespace WeeWorxxSDK\SharedResources\Modules\Post\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use WeeWorxxSDK\SharedResources\Modules\Post\Models\Post;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\{{ namespacedModel }}>
 */
class PostFactory extends Factory
{
    protected string $model = Post::class;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'posted_by' => rand(1, 50),
            'company_id' => rand(1, 50),
            'post_status_id' => rand(1, 5),
            'title' => $this->faker->title(),
            'content' => $this->faker->paragraphs(3, true),
            'valid_at' => $this->faker->dateTimeBetween('now', '+1 year')
        ];
    }
}
