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
        $paragraphs = collect(range(1, rand(1, 3))) // generate 3 paragraphs
            ->map(fn () => $this->faker->text(3000))
            ->implode("<br /><br />"); // join them with paragraph spacing
        return [
            'posted_by' => rand(1, 50),
            'company_id' => rand(1, 50),
            'post_status_id' => rand(1, 5),
            'employment_type' => $jobType[rand(0, 2)],
            'salary' => $this->faker->randomDigit(),
            'job_location' => $jobLocation[rand(0,10)],
            'job_url' => $this->faker->url(),
            'title' => $this->faker->jobTitle(),
            'content' => $paragraphs,
            'valid_at' => $this->faker->dateTimeBetween('now', '+1 year'),
            'is_test' => 1
        ];
    }
}
