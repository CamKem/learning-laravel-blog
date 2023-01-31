<?php

namespace Database\Factories;

use App\Models\Category;
use App\Models\User;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class PostFactory extends Factory
{
    use Sluggable;

    public function getFakeData(Generator $faker)
    {
        $paragraphs = rand(1, 5);
        $i = 0;
        $ret = "";
        while ($i < $paragraphs) {
            $ret .= "<p>" . $faker->paragraph(rand(2, 6)) . "</p>";
            $i++;
        }
        return $ret;
    }

    public function definition(): array
    {
        $category_ids = DB::table('categories')->pluck('id');
        $user_ids = DB::table('users')->pluck('id');
        return [
            'category_id' => fake()->randomElement($category_ids),
            'user_id' => fake()->randomElement($user_ids),
            //Options below are to create a new category and user for each post
            //'category_id' => Category::factory(),
            //'user_id' => User::factory(),
            'title' => fake()->sentence(6),
            'body' => '<p>' . implode('</p><p>', fake()->paragraphs(6)) . '</p>',
            'excerpt' => '<p>' . implode('</p><p>', fake()->paragraphs(3)) . '</p>',
        ];
    }

    public function getExcerpt($string, $limit = 500): string
    {
        $string = substr($string, strpos($string, '</p>') + 4);
        if (strlen($string) > $limit) {
            $string = substr($string, 0, $limit) . '...';
        }
        return $string;
    }

    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'title'
            ]
        ];
    }
}
