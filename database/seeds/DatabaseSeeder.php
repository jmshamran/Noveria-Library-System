<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')
        ->insert([
            [
                'name' => "Shamran",
                'email' => 'shamran@gmail.com',
                'password' => bcrypt('raptor'),
                'dob' => '2010-05-22',
                'phone' => '666-765-980',
                'job' => 'Web App Developer',
                'address' => 'No. 122, Priscilla Avenue, Haestrom Street, Novigrad.',
                'position' => 1,
                'image' => 'asset/dist/img/users/1.png', 
                'about' => 'Human Forerunner, UNSC Commander, Council Spectre. I fight to protect and further the universal rights of all sentient life; 
                from the depth of the pacific, to the edge of the galaxy. For as long as I shall live!',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'name' => "Thor Odinson",
                'email' => 'strong.av@avengers.com',
                'password' => bcrypt('pointbreak'),
                'dob' => '1995-01-01',
                'phone' => '777-987-456',
                'job' => 'King',
                'address' => 'Odin\'s Palace, Asgard, Nine Relams.',
                'position' => 0,
                'image' => 'asset/dist/img/users/2.jpg', 
                'about' => 'King of Asgard, Protector of Nine Realms, Strongest Avenger and the Lord of Thunder.',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'name' => "Rocket Racoon",
                'email' => 'rabbit@avengers.com',
                'password' => bcrypt('trashpanda'),
                'dob' => '1789-03-02',
                'phone' => '876-2223-131',
                'job' => 'Captain of Benetar',
                'address' => 'Captain\'s seat and pilot\'s seat, Guardian\'s Benatar, Andromeda Galaxy, Space Time.',
                'position' => 2,
                'image' => 'asset/dist/img/users/5.jpg', 
                'about' => 'Subject 89p13, cybernetic super raccoon, space mercenary, expert marksman and expert pilot.',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ]
        ]);
    }
}
