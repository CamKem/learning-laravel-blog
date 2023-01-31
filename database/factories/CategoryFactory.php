<?php

namespace Database\Factories;

use App\Models\Category;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Factories\Factory;

class CategoryFactory extends Factory
{
    use Sluggable;

    protected $model = Category::class;

    public function definition(): array
    {
        return [
            'name' => fake()->word().' '.fake()->word(),
        ];
    }

    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'name'
            ]
        ];
    }
}
