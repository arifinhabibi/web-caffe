<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Menu;
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

        $menus = [
            [
                'menu' => 'Ekspresso',
                'price' => 20000,
                'image' => 'logo-coffe.png'
            ],
            [
                'menu' => 'Americano',
                'price' => 16000,
                'image' => 'logo-coffe.png'
            ],
            [
                'menu' => 'Machiatto',
                'price' => 26000,
                'image' => 'logo-coffe.png'
            ],
            [
                'menu' => 'Green Tea',
                'price' => 21000,
                'image' => 'logo-coffe.png'
            ],
            [
                'menu' => 'Cappucino',
                'price' => 25000,
                'image' => 'logo-coffe.png'
            ],
            [
                'menu' => 'Ice Tea',
                'price' => 14000,
                'image' => 'logo-coffe.png'
            ],
        ];

        foreach ($menus as $menu) {
            # code...
            Menu::create($menu);
        }
    }
}
