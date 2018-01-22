<?php

use Illuminate\Database\Seeder;
use App\Project;

class ProjectsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Project::create([
            'name' => 'CV à la manière de…',
        ]);
        Project::create([
            'name' => 'CSS Zen Garden',
        ]);
        Project::create([
            'name' => 'Exposition d’un artiste',
        ]);
        Project::create([
            'name' => 'Portfolio',
        ]);
        Project::create([
            'name' => 'Mariam Faso',
        ]);
        Project::create([
            'name' => 'Design Mobile Quick',
        ]);
        Project::create([
            'name' => 'Centre de santé d’Angleur',
        ]);
        Project::create([
            'name' => 'Espace P',
        ]);
        Project::create([
            'name' => 'Pré-production du PFE',
        ]);
        Project::create([
            'name' => 'Jiri',
        ]);
    }
}
