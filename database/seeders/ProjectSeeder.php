<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Project;
use Illuminate\Support\Str;
use Faker\Generator as Faker;

class ProjectSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(Faker $faker): void
    {
        $randomVideo =
            [
                'https://www.youtube.com/watch?v=UwxatzcYf9Q&list=PLjKI5ONdAyGS01UfxE2alDJZ-ffOFPM73',
                'https://www.youtube.com/watch?v=KgEQNlR4A6o&list=PLjKI5ONdAyGS01UfxE2alDJZ-ffOFPM73&index=6&pp=iAQB8AUB',
                'https://www.youtube.com/watch?v=O84CCjrcmR8&list=PLjKI5ONdAyGS01UfxE2alDJZ-ffOFPM73&index=7&pp=iAQB8AUB',
            ];
        for ($i = 0; $i < 10; $i++) {
            $project = new Project();
            $project->title = $faker->words(4, true);
            $project->link = $faker->url();
            $project->slug = Str::of($project->title)->slug('-');
            $project->content = $faker->text(300);
            $project->cover_image = $faker->imageUrl(150, 150, 'Project', true);
            $project->video = $faker->randomElement($randomVideo);
            $project->save();
        }
    }
}
