<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\DB;

class CommentFactory extends Factory
{

    public function definition(): array
    {
        $post_ids = DB::table('posts')->pluck('id');
        $user_ids = DB::table('users')->pluck('id');
        return [
            'post_id' => fake()->randomElement($post_ids),
            'user_id' => fake()->randomElement($user_ids),
            'body' => fake()->paragraph(),
        ];
    }

}
