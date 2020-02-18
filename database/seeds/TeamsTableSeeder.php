<?php

use Illuminate\Database\Seeder;

class TeamsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker\Factory::create();

        for ($i = 0; $i < 10; $i++) {
            $author = App\Models\Author::create(
                [
                    'name' => $faker->name
                ]
            );


            for ($k = 0; $k < 25; $k++) {
                App\Models\Book::create(
                    [
                        'title' => $faker->firstName,
                        'published_at' => now()->subDays(rand(0, 730)),
                        'author_id' => $author->id,
                        'genre_id' => rand(1,22),
                    ]
                );
            }
        }
    }
}
