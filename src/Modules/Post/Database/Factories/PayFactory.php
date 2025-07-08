<?php

namespace WeeWorxxSDK\SharedResources\Modules\Post\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use WeeWorxxSDK\SharedResources\Modules\Post\Models\Pay;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\{{ namespacedModel }}>
 */
class PayFactory extends Factory
{
    protected string $model = Pay::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $type = ['salary', 'hourly'];
        $cur = ['USD', 'CAD', 'PHP'];
        return [
            'type' => $type[rand(0,1)],
            'currency' => $cur[rand(0,2)],
            'amount' => $this->faker->randomDigit()
        ];
    }
}
