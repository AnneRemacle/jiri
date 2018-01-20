<?php

use Illuminate\Database\Seeder;
use App\User;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::insert([
            'name' => str_random(10),
            'email' => 'admin@jiri.be',
            'password' => bcrypt('azerty'),
            'is_admin' => true,
        ]);

        User::insert([
            'name' => str_random(10),
            'email' => str_random(10).'@gmail.com',
            'password' => bcrypt('azerty'),
            'is_admin' => false,
        ]);
    }
}
