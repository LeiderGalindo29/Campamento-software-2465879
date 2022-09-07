<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CourseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //conectarnos al archivo json 
        $json = File::get("database/_data/course.json");
        json_decode($json);
        $Array_course=json_decode($json);
        //reoger el archivo
        foreach($Array_course as $c ){

        
        //por cada instancia crear un bootcamps

        $course = new Course();
        $course ->title = $c -> title;
        $course ->description = $c-> description;
        $course ->weeks = $c-> weeks;
        $course ->enroll_cost = $c-> enroll_cost;
        $course ->minimum_skill = $c-> minimum_skill;
        $course ->bootcamp_id = $c-> bootcamp_id;
        $course -> save();        
        }
    }
}