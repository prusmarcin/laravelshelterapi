<?php

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class DatabaseSeeder extends Seeder
{

    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {

        $faker = Faker::create('pl_PL');

        /* ================ shelters seeder ==================== */
        
        DB::table('shelters')->insert([
            'uskey' => substr($faker->md5, 0, 5),
            'name' => 'Schronisko Gdynia',
            'city' => 'Gdynia',
            'size' => 2200,
            'created_at' => $faker->dateTimeThisDecade($max = 'now')
        ]);

        DB::table('shelters')->insert([
            'uskey' => substr($faker->md5, 0, 5),
            'name' => 'Schronisko Gdańsk',
            'city' => 'Gdańsk',
            'size' => 1300,
            'created_at' => $faker->dateTimeThisDecade($max = 'now')
        ]);
        
        /* ================ workers seeder ==================== */

        for ($i = 1; $i <= 5; $i++) {
            DB::table('workers')->insert([
                'name' => $faker->firstName . ' ' . $faker->lastName,
                'age' => $faker->numberBetween($min = 20, $max = 50),
                'shelter_id' => 1,
                'created_at' => $faker->dateTimeThisYear($max = 'now')
            ]);
        }

        for ($i = 1; $i <= 8; $i++) {
            DB::table('workers')->insert([
                'name' => $faker->firstName . ' ' . $faker->lastName,
                'age' => $faker->numberBetween($min = 20, $max = 50),
                'shelter_id' => 2,
                'created_at' => $faker->dateTimeThisYear($max = 'now')
            ]);
        }


        /* ================ cats seeder ==================== */
        
        $cat_colors = array(
            'czarny',
            'niebieski',
            'czekoladowy',
            'liliowy',
            'czerwony',
            'cynamonowy',
            'biały',
            'brązowy',
            'rudy',
            'szary',
            'czarno-biały',
            'szaro-biały',
            'czarno-szary',
            'czarno-rudy',
            'cynamonowo-biały',
            'cynamonowo-czarny',
            'cynamonowo-szary'
        );

        for ($i = 1; $i <= rand(600, 1200); $i++) {
            $shelter_id = $faker->numberBetween($min = 1, $max = 2);
            if ($shelter_id == 1) {
                DB::table('cats')->insert([
                    'name' => $faker->firstName,
                    'color' => $faker->randomElement($cat_colors),
                    'worker_id' => $faker->numberBetween($min = 1, $max = 5),
                    'shelter_id' => $shelter_id,
                    'created_at' => $faker->dateTimeThisYear($max = 'now')
                ]);
            } else {
                DB::table('cats')->insert([
                    'name' => $faker->firstName,
                    'color' => $faker->randomElement($cat_colors),
                    'worker_id' => $faker->numberBetween($min = 6, $max = 13),
                    'shelter_id' => $shelter_id,
                    'created_at' => $faker->dateTimeThisYear($max = 'now')
                ]);
            }
        }
    }
}
