<?php

namespace WeeWorxxSDK\SharedResources\Modules\Post\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use WeeWorxxSDK\SharedResources\Modules\Post\Models\Benefits;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\{{ namespacedModel }}>
 */
class BenefitsFactory extends Factory
{
    protected string $model = Benefits::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $benefits = [
            '401(k)', 'Paid time off', 'Vision insurance', 'Dental insurance',
            'Disability insurance', 'Happy hour', 'Passion Friday',
            'Free Friday', 'PTO', 'AWS',
        ];
        $name = $this->faker->randomElement($benefits);
        return [
            'name' => $name,
            'identifier' => Str::snake($name)
        ];
    }
}
