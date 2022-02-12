<?php

namespace Database\Factories;

use App\Models\BlogPost;
use Illuminate\Database\Eloquent\Factories\Factory;

class BlogPostFactory extends Factory
{
    /**
     * Define the model's default state.edfd
     *
     * @return array
     */

    public function definition()
    {
        return [
            'title' => $this->faker->sentence(10),
            'content' => $this->faker->paragraph(5, true),
            'created_at' => $this->faker->dateTimeBetween('-3 months'),
        ];
    }

    public function defaultTitle()
    {
        return $this->state([
            'title' => 'New title'
        ]);
    }



}
