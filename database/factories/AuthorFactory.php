<?php

namespace Database\Factories;

use App\Models\Author;
use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Profile;

class AuthorFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [

        ];
    }

}

$factory->afterCreating(App\Models\Author::class, function ($author, $faker) {
    $author->profile()->save (Profile::factory()->make() );
});
