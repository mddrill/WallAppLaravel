<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Hash;

class RegistrationTest extends BaseTestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testRegistration()
    {
        $name = 'Light Yagami';
        $username = 'lyagami245';
        $password = 'L did you know, gods of death love apples';
        $email = 'lyagami@mu.com';
        $payload = [
            'name' => $name,
            'username' => $username,
            'password' => $password,
            'email' => $email
        ];
        $response = $this->json('POST', '/register', $payload);
        $this->assertStatusCode(201, $response);
        $this->assertDatabaseHas('users', [
            'name' => $name,
            'username' => $username,
            'email' => $email
        ]);
    }
}
