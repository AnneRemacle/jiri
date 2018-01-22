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
        User::create([
            'is_admin' => 1,
            'name' => 'Admin',
            'email' => 'admin@jiri.be',
            'password' => Hash::make('azerty'),
            'clear_password' => 'azerty',
            'company' => 'Jiri'
        ]);
        User::create([
            'is_admin' => 1,
            'name' => 'Myriam Dupont',
            'email' => 'myriam.dupont@hepl.be',
            'password' => Hash::make('azerty'),
            'clear_password' => 'azerty',
            'company' => 'HEPL'
        ]);
        User::create([
            'is_admin' => 1,
            'name' => 'Dominique Vilain',
            'email' => 'dominique.vilain@hepl.be',
            'password' => Hash::make('azerty'),
            'clear_password' => 'azerty',
            'company' => 'HEPL'
        ]);
        User::create([
            'is_admin' => 0,
            'name' => 'Léa Vérou',
            'email' => 'lea@verou.me',
            'password' => Hash::make('azerty'),
            'clear_password' => 'azerty',
            'company' => 'W3C'
        ]);
        User::create([
            'is_admin' => 0,
            'name' => 'Benjamin Decock',
            'email' => 'benjamin@stripe.com',
            'password' => Hash::make('azerty'),
            'clear_password' => 'azerty',
            'company' => 'Stripe'
        ]);
        User::create([
            'is_admin' => 0,
            'name' => 'Tim Van Damme',
            'email' => 'max@voltar.be',
            'password' => Hash::make('azerty'),
            'clear_password' => 'azerty',
            'company' => 'Abstract'
        ]);
        User::create([
            'is_admin' => 0,
            'name' => 'Mike Monteiro',
            'email' => 'mike@monteiro.com',
            'password' => Hash::make('azerty'),
            'clear_password' => 'azerty',
            'company' => 'Mule Design'
        ]);
        User::create([
            'is_admin' => 0,
            'name' => 'Mariam Faso',
            'email' => 'mariam@faso.be',
            'password' => Hash::make('azerty'),
            'clear_password' => 'azerty',
            'company' => null
        ]);
        User::create([
            'is_admin' => 0,
            'name' => 'Vincent De Oliveira',
            'email' => 'vincent@oliveira.fr',
            'password' => Hash::make('azerty'),
            'clear_password' => 'azerty',
            'company' => null
        ]);
        User::create([
            'is_admin' => 0,
            'name' => 'Raphaël Goëtter',
            'email' => 'raphael@alsacreation.fr',
            'password' => Hash::make('azerty'),
            'clear_password' => 'azerty',
            'company' => 'Alsacréation'
        ]);
        User::create([
            'is_admin' => 0,
            'name' => 'Molly Holzschlag',
            'email' => 'me@molly.com',
            'password' => Hash::make('azerty'),
            'clear_password' => 'azerty',
            'company' => null
        ]);
        User::create([
            'is_admin' => 0,
            'name' => 'Andy Clarke',
            'email' => 'andy@stuffandnonsense.com',
            'password' => Hash::make('azerty'),
            'clear_password' => 'azerty',
            'company' => 'Stuff & nonsense'
        ]);
        User::create([
            'is_admin' => 0,
            'name' => 'Taylor Otwell',
            'email' => 'taylor@laravel.com',
            'password' => Hash::make('azerty'),
            'clear_password' => 'azerty',
            'company' => null
        ]);
        User::create([
            'is_admin' => 0,
            'name' => 'Dan Cederholm',
            'email' => 'dan@dribbble.com',
            'password' => Hash::make('azerty'),
            'clear_password' => 'azerty',
            'company' => 'Dribbble'
        ]);
        User::create([
            'is_admin' => 0,
            'name' => 'Quentin Deltour',
            'email' => 'quentin@espacep.be',
            'password' => Hash::make('azerty'),
            'clear_password' => 'azerty',
            'company' => 'Espace P'
        ]);
        User::create([
            'is_admin' => 0,
            'name' => 'Anne-Marie Dal',
            'email' => 'anne-marie@csiangleur.be',
            'password' => Hash::make('azerty'),
            'clear_password' => 'azerty',
            'company' => 'CSIA'
        ]);
        User::create([
            'is_admin' => 0,
            'name' => 'Matt Stauffer',
            'email' => 'matt@stauffer.com',
            'password' => Hash::make('azerty'),
            'clear_password' => 'azerty',
            'company' => null
        ]);
        User::create([
            'is_admin' => 0,
            'name' => 'Jeffrey Zeldman',
            'email' => 'jeffrey@ala.com',
            'password' => Hash::make('azerty'),
            'clear_password' => 'azerty',
            'company' => 'A list apart'
        ]);
        User::create([
            'is_admin' => 0,
            'name' => 'Jason Santa Maria',
            'email' => 'jason@santa-maria.com',
            'password' => Hash::make('azerty'),
            'clear_password' => 'azerty',
            'company' => null
        ]);
        User::create([
            'is_admin' => 0,
            'name' => 'Jeremy Keith',
            'email' => 'jeremey@clearleft.com',
            'password' => Hash::make('azerty'),
            'clear_password' => 'azerty',
            'company' => 'clearleft'
        ]);
    }
}
