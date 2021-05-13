<?php


namespace Database\Factories\Data\Models;

use App\Data\Models\PersonalAccessToken;
use Illuminate\Database\Eloquent\Factories\Factory;

class PersonalAccessTokenFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = PersonalAccessToken::class;
    /**
     * @return array
     */
    public function definition()
    {
        return [
            'id' => $this->faker->title,
            'tokenable_type' => $this->faker->title,
            'tokenable_id' => $this->faker->title,
            'name' => $this->faker->title,
            'token' => $this->faker->title,
            'abilities' => $this->faker->title,
        ];
    }
}
