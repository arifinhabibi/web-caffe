<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\User;
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
      
        for ($index = 1; $index <= 2;$index++) { 
            User::create(
                [
                    'username' => 'user'.$index,
                    'password' => bcrypt(121212)
                ]
            );
        }
    }
}
