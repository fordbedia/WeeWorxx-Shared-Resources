<?php

namespace WeeWorxxSDK\SharedResources\Modules\Post\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use WeeWorxxSDK\SharedResources\Modules\Post\Models\Post;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\{{ namespacedModel }}>
 */
class PostFactory extends Factory
{
    protected $model = Post::class;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $jobType = ['full_time', 'part_time', 'contract'];
        $jobLocation = [
            'Remote',
            'Houston, TX',
            'Remote in LA',
            'Remote/Hybrid',
            'Remote/Hybrid in Tallahassee, FL',
            'Orlando, FL',
            'New York, NY',
            'Remote in NY',
            'Remote in San Diego',
            'Hybrid',
            'Hybrid in New Orleans'
        ];
        return [
            'posted_by' => rand(1, 50),
            'company_id' => rand(1, 50),
            'post_status_id' => rand(1, 5),
            'employment_type' => $jobType[rand(0, 2)],
            'salary' => $this->faker->randomDigit(),
            'job_location' => $jobLocation[rand(0,10)],
            'title' => $this->faker->jobTitle(),
            'content' => $this->faker->paragraphs(3, true),
            'valid_at' => $this->faker->dateTimeBetween('now', '+1 year'),
            'is_test' => 1
        ];
    }
}
