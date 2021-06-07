<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\User;

class UserFactory extends Factory
{
    /**
    * The name of the factory's corresponding model.
    *
    * @var  string
    */
    protected $model = User::class;

    /**
    * Define the model's default state.
    *
    * @return  array
    */
    public function definition(): array
    {
        return [
                'name' => $this->faker->name,
                'email' => $this->faker->safeEmail,
                'settings' => $this->faker->word,
                'sex_id' => rand(1, 2),
                'unique_id' => $this->faker->word,
                'email_verified_at' => $this->faker->dateTime(),
                'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
                'remember_token' => Str::random(10),
                'photo_name' => $this->faker->word,
                'photo_url' => $this->faker->word,
                'relation_id' => rand(1,3),
        ];
    }
}
