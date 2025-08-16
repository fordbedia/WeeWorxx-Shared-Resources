<?php

namespace WeeWorxxSDK\SharedResources\Modules\User\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use WeeWorxxSDK\SharedResources\Modules\User\Models\User;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\{{ namespacedModel }}>
 */
class UserFactory extends Factory
{
    protected $model = User::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $fname = $this->faker->firstName();
        $lname = $this->faker->lastName();
        return [
            'fname' => $fname,
            'lname' => $lname,
            'mname' => $this->faker->lastName(),
            'name' => $fname . ' ' . $lname,
            'email' => $this->faker->email(),
            'email_verified_at' => $this->faker->dateTimeBetween('-1 year', 'now'),
            'password' => bcrypt('12345'),
            'remember_token' => null,
            'type_id' => rand(1,2),
            'auth_type' => 'app',
            'is_test' => 1,
        ];
    }
}
