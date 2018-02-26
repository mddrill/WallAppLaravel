<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Hash;
use App\User;

class UserTest extends BaseUnitTestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
     public function testUser()
     {
         $name = 'tony';
         $username = 'tony_admin';
         $password = Hash::make('admin');
         $email = 'tony_admin@laravel.com';
         $user = new User([
             'name' => $name,
             'username' => $username,
 			 'password' => $password,
             'email' => $email,
         ]);
         $this->assertTrue($user instanceof User);
         $this->assertTrue($user->name === $name);
         $this->assertTrue($user->username === $username);
         $this->assertTrue($user->password === $password);
         $this->assertTrue($user->email === $email);
     }
}
