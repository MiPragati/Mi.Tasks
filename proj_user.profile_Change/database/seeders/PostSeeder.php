<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Post;
use App\Models\Category;
use Illuminate\Support\Str;

class PostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        $faker = \Faker\Factory::create();
        $categories = Category::all();

        foreach ($categories as $category) {
            for ($i = 0; $i < 6; $i++) {
                Post::create([
                    'title'       => $faker->sentence,
                    'content'     => $faker->paragraphs(6, true),
                    'category_id' => $category->id,
                    'user_id'     => 1,
                ]);
            }
        }
    }
}
