<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class AuthTest extends TestCase
{

    public function testUserCanRegisterAnAccount()
    {

        $response = $this->json('POST', '/api/auth/register',
            [
                'name' => "Test",
                'email' => uniqid(rand(1000000, 9999999)) . "@unittest-email.com",
                'image' => "default_profile.jpg",
                'imageHash' => "sdfsfgfdfhd",
                'password' => $_ENV["TEST_PASSWORD"],
            ]
        );

        $response
            ->assertResponseOk()
            ->seeJson([
                'errors' => false,
            ]);
    }

    public function testUserCanLogin()
    {
        $response = $this->json('POST', '/api/auth/login',
            [
                'email' => $_ENV["TEST_EMAIL"],
                'password' => $_ENV["TEST_PASSWORD"],
                'api_key' => $_ENV["TEST_API_KEY"],
            ]
        );

        $response
            ->assertResponseOk()
            ->seeJson([
                'errors' => false,
            ]);

        $data = $response->decodeResponseJson();
        $_ENV['TEST_TOKEN'] = $data['data']['token'];
    }
}
