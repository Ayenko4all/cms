<?php

use App\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UsersTablSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = User::where('email' , 'kenny4all40@gmail.com')->first();

        if (!$user) {
            User::create([
                'name' => 'Ayeni kehinde',
                'email' => 'kenny4all40@gmail.com',
                'password' => Hash::make('password'),
                'role' => 'admin'
            ]);
        }
    }
}
