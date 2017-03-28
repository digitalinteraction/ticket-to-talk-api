<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class TicketTest extends TestCase
{
    public function testUserCanStoreTicket()
    {
        // TODO FINISH
        $response = $this->json("POST", "/api/tickets/store",
            [
                'token' => $_ENV['TEST_TOKEN'],
                'api_key' => $_ENV['TEST_API_KEY'],
                'ticket' =>
                    [
                        'title' => 'Test',
                        'description' => "this is a test ticket",
                        'year' => 2000,
                        'access_level' => 'All',
                        'period_id' => 1,
                        'area' => 'London',
                        'person_id' => 1
                    ],
                'period' =>
                    [
                        'text' => "childhood"
                    ],
                'media' => "sdfsdfsdf"
            ]
        );

        $response
            ->assertResponseOk()
            ->seeJson([
                'errors' => false
            ]);
    }
}
