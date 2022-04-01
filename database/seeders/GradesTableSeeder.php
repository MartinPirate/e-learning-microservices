<?php

namespace Database\Seeders;

use App\Models\Grade;
use Illuminate\Database\Seeder;

class GradesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(): void
    {
        $grade = new Grade();
        $grade->name = '1st Grade';
        $grade->save();

        $grade = new Grade();
        $grade->name = '2nd Grade';
        $grade->save();

        $grade = new Grade();
        $grade->name = '3rd Grade';
        $grade->save();


        $grade = new Grade();
        $grade->name = '4th Grade';
        $grade->save();


        $grade = new Grade();
        $grade->name = '5th Grade';
        $grade->save();

    }

}
