<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        DB::table('cats')->insert([
            'name' => 'Kiciuś',
            'color' => 'brązowy'
        ]);
        
        DB::table('cats')->insert([
            'name' => 'Trebusz',
            'color' => 'czarno-szary'
        ]);
        
        DB::table('cats')->insert([
            'name' => 'Opon',
            'color' => 'rudy'
        ]);
        
        DB::table('shelters')->insert([
            'uskey' => 'df32A',
            'name' => 'Schronisko Gdańsk',
            'city' => 'Gdańsk',
            'size' => 1150
        ]);
        
        DB::table('shelters')->insert([
            'uskey' => '5dFde',
            'name' => 'Schronisko Warszawa',
            'city' => 'Warszawa',
            'size' => 2500
        ]);
    }
}
