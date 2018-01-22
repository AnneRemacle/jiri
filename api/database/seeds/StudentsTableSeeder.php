<?php

use Illuminate\Database\Seeder;
use App\Student;

class StudentsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Student::create(['name' => 'Scott Jurek', 'email' => 'scott@jurek.com']);
        Student::create(['name' => 'Anton Krupicka', 'email' => 'anton@kupricka.com']);
        Student::create(['name' => 'Emelie Forsberg', 'email' => 'emelie@forsberg.com']);
        Student::create(['name' => 'Jim Walmsley', 'email' => 'jim@walmsley.com']);
        Student::create(['name' => 'Caroline Chaverot', 'email' => 'caroline@chaverot.com']);
        Student::create(['name' => 'Luis Alberto Hernando', 'email' => 'luis@hernando.com']);
        Student::create(['name' => 'François Dhaene', 'email' => 'francois@dhaene.com']);
        Student::create(['name' => 'Sébastien Chaigneau', 'email' => 'seb@chaigneau.com']);
        Student::create(['name' => 'Xavier Thévenard', 'email' => 'xavier@thevenard.com']);
        Student::create(['name' => 'Kilian Jornet', 'email' => 'kilian@jornet.com']);
        Student::create(['name' => 'Julien Chorier', 'email' => 'julien@chorier.com']);
        Student::create(['name' => 'Ryan Sandes', 'email' => 'ryan@sandes.com']);
        Student::create(['name' => 'Megan Kimmel', 'email' => 'megan@kimmel.com']);
        Student::create(['name' => 'Sage Canaday', 'email' => 'sage@canaday.com']);
        Student::create(['name' => 'Anna Frost', 'email' => 'anna@frosty.com']);
        Student::create(['name' => 'Nuria Picas', 'email' => 'nuria@picas.com']);
        Student::create(['name' => 'Alex Honnold', 'email' => 'alex@honnold.com']);
        Student::create(['name' => 'Stephanie Howe', 'email' => 'stephanie@howe.com']);
        Student::create(['name' => 'Max King', 'email' => 'max@king.com']);
        Student::create(['name' => 'Tim Tollefson', 'email' => 'tim@tollefson.com']);
        Student::create(['name' => 'Stella Petric', 'email' => 'stella@petric.com']);
        Student::create(['name' => 'Étienne Van Gasse', 'email' => 'etienne@vangasse.com']);
        Student::create(['name' => 'Nicola Bucci', 'email' => 'nicola@bucci.com']);
        Student::create(['name' => 'Janick Delva', 'email' => 'janick@delva.com']);
        Student::create(['name' => 'Mathieu Deville', 'email' => 'mathieu@deville.com']);
    }
}
