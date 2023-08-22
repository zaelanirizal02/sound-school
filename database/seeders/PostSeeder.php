<?php

namespace Database\Seeders;
use App\Models\Post;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = \Faker\Factory::create('id_ID');
        for ($i=0; $i <10 ; $i++) { 

            Post::create([
                'image'=>$faker->image(storage_path(path: 'app/public/posts'), 300, 300),
                'title'=>$faker->name,
                'content'=>$faker->sentence
            ]);
            
        }
    }
}
