<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

use Illuminate\Support\Facades\DB;


class WeekDaySeeder extends Seeder
{
    public function run()
    {
        DB::table('week_days')->delete();

        $week_days = [
            ['dayValue' => 0, 'dayName' => 'Sunday'],
            ['dayValue' => 1, 'dayName' => 'Monday'],
            ['dayValue' => 2, 'dayName' => 'Tuesday'],
            ['dayValue' => 3, 'dayName' => 'Wednesday'],
            ['dayValue' => 4, 'dayName' => 'Thursday'],
            ['dayValue' => 5, 'dayName' => 'Friday'],
            ['dayValue' => 6, 'dayName' => 'Saturday'],
        ];

        DB::table('week_days')->insert($week_days);
    }
}