<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;



class CountrySeeder extends Seeder
{
    public function run()
    {
        DB::table('countries')->delete();
        
        $countries = [
            ['name' => 'United Kingdom', 'code' => 'GB'],
            ['name' => 'United States', 'code' => 'US'],
        ];

        DB::table('countries')->insert($countries);
    }
}
