<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class AuthTest extends TestCase
{
    public function testLogin()
    {
        $response = $this->json('POST', '/api/auth/login',
            [
                'email' => getenv("TEST_EMAIL"),
                'password' => env("TEST_PASSWORD"),
                'api_key' => env("TEST_API_KEY"),
            ]
        );

        $response
            ->assertResponseOk()
            ->seeJson([
                'errors' => false,
            ]);
    }
}
