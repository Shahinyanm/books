<?php

use Illuminate\Database\Seeder;

class GenresTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $genres = [
            'Action and Adventure',
            'Anthology',
            'Classic',
            'Comic and Graphic Novel',
            'Crime and Detective',
            'Drama',
            'Fable',
            'Fairy Tale',
            'Fan-Fiction',
            'Fantasy',
            'Historical Fiction',
            'Horror',
            'Humor',
            'Legend',
            'Magical Realism',
            'Mystery',
            'Mythology',
            'Realistic Fiction',
            'Romance',
            'Satire',
            'Science Fiction ',
            'Short Story',
            'Suspense/Thriller',
        ];
        foreach ($genres as $genre) {
            \App\Models\Genre::firstOrCreate(['genre' => $genre]);
        }
    }
}
