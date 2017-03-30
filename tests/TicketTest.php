<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class TicketTest extends TestCase
{

    var $ticket_id = 0;

    public function testUserCanStoreTicket()
    {

        global $ticket_id;

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
                        'person_id' => 1,
                        'mediaType' => 'Picture'
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

        $d = $response->decodeResponseJson();
        $ticket_id = $d['data']['ticket']['id'];
    }

    public function testUserCanUpdateTicket()
    {

        global $ticket_id;

        $rand = rand(100, 900);

        $response = $this->json("POST", "/api/tickets/update",
            [
                'token' => $_ENV['TEST_TOKEN'],
                'api_key' => $_ENV['TEST_API_KEY'],
                'ticket_id' => $ticket_id,
                'title' => 'Test',
                'description' => "this is an updated test ticket " . $rand,
                'year' => 2000,
                'access_level' => 'All',
                'period' => "Childhood",
                'area' => 'London',
                'person_id' => 1,
                'mediaType' => 'Picture',
            ]
        );

        $response
            ->assertResponseOk()
            ->seeJson([
                'errors' => false
            ])->seeJson([
                'description' => "this is an updated test ticket " . $rand
            ]);
    }

    public function testUserCanDeleteTicket()
    {

        global $ticket_id;

        $response = $this->json("DELETE", "/api/tickets/destroy",
            [
                'token' => $_ENV['TEST_TOKEN'],
                'api_key' => $_ENV['TEST_API_KEY'],
                'ticket_id' => $ticket_id,
            ]
        );

        $response
            ->assertResponseOk()
            ->seeJson([
                'errors' => false
            ]);
    }
}
