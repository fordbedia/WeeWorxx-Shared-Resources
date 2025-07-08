<?php

namespace WeeWorxxSDK\SharedResources\Modules\Post\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use WeeWorxxSDK\SharedResources\Modules\Post\Models\Skills;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\{{ namespacedModel }}>
 */
class SkillsFactory extends Factory
{
    protected string $model = Skills::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $skills = [
            'PHP', 'Python', 'JavaScript', 'TypeScript',
            'React', 'Vue', 'Angular',
            'Docker', 'Kubernetes', 'AWS',
            'MySQL', 'PostgreSQL', 'Redis',
        ];
        $name = $this->faker->randomElement($skills);
        return [
            'name' => $name,
            'identifier' => Str::snake($name)
        ];
    }
}
