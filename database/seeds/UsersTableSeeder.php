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
        User::create(array(
            'name' => 'tony',
            'username' => 'tony_admin',
			'password' => Hash::make('admin'),
            'email' => 'tony_admin@laravel.com',
        ));
        User::create(array(
            'name' => 'matt',
            'username' => 'matt_admin',
			'password' => Hash::make('admin'),
            'email' => 'matt_admin@laravel.com',
        ));
        User::create(array(
            'name' => 'charlie',
            'username' => 'charlie_admin',
			'password' => Hash::make('admin'),
            'email' => 'charlie_admin@laravel.com',
        ));
    }
}
