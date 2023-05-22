<?php

namespace Database\Seeders;

use App\Models\Type;
use App\Models\Project;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Generator as Faker;
use Illuminate\Support\Str;

class ProjectSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker $faker)
    {
    
        Project::truncate();
        
        for($i = 0; $i < 10; $i++) {
            $type = Type::inRandomOrder()->first();
            $new_project = new Project();
            $new_project->title = $faker->sentence(1);
            $new_project->description = $faker->sentence();
            $new_project->start_date = $faker->dateTime();
            $new_project->end_date = $faker->dateTimeInInterval($new_project->start_date, '+10 weeks');
            $new_project->slug = Str::slug($new_project->title, '-');
            $new_project->type_id = $type->id;
            $new_project->save();
        }
    }
}
