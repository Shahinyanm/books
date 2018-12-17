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
            $team = App\Models\Team::create([
                'name' => $faker->name
            ]);
            for ($k = 0; $k < 5; $k++) {
                App\Models\Player::create([
                    'first_name' => $faker->firstName,
                    'last_name' => $faker->lastName,
                    'team_id' => $team->id,
                ]);
            }
        }
    }
}
