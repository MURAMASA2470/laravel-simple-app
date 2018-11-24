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
        $user = User::create([
            'name' => '田中さん',
            'email' => 'admin@mail',
            'password' => Hash::make('admin'),
        ]);
        $user->assignRole('admin');

        $user = User::create([
            'name' => '鈴木さん',
            'email' => 'staff@mail',
            'password' => Hash::make('staff'),
        ]);
        $user->assignRole('staff');

        $user = User::create([
            'name' => '一般人さん',
            'email' => 'common@mail',
            'password' => Hash::make('common'),
        ]);
        $user->assignRole('common');

    }
}
