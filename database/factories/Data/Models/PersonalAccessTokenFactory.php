<?php


namespace Database\Factories\Data\Models;

use App\Data\Models\PersonalAccessToken;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

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
            'tokenable_type' => 'App\Data\Models\User',
            'tokenable_id' => 1,
            'name' => 'api_client',
            'token' => hash('sha256', $plainTextToken = Str::random(40)),
            'abilities' => ["*"],
        ];
    }
}
