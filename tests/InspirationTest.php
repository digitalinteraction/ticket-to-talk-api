<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class InspirationTest extends TestCase
{
    public function testUserCanGetInspirations()
    {
        $response = $this->json("GET", "/api/inspiration/get",
            [
                'token' => $_ENV['TEST_TOKEN'],
                'api_key' => $_ENV['TEST_API_KEY'],
            ]
        );

        $response
            ->assertResponseOk()
            ->seeJson([
                'errors' => false
            ])
            ->see("[name]");
    }
}
