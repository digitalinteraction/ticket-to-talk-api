<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class ConversationTest extends TestCase
{
    var $conversation_id = 0;
    var $ticket_id = 0;

    public function testUserCanStoreConversation()
    {
        global $conversation_id;

        $response = $this->json("POST", "/api/conversations/store",
            [
                'token' => $_ENV['TEST_TOKEN'],
                'api_key' => $_ENV['TEST_API_KEY'],
                'datetime' => '01/01/2016 00:00:00',
                'platform' => 'Android',
                'notes' => 'These are notes',
                'person_id' => 1,

            ]
        );

        $response
            ->assertResponseOk()
            ->seeJson([
                'errors' => false
            ]);

        $d = $response->decodeResponseJson();
        $conversation_id = $d['data']['conversation']['id'];
    }

    public function testUserCanGetAPersonsConversations()
    {
        $response = $this->json("GET", "/api/conversations/get",
            [
                'token' => $_ENV['TEST_TOKEN'],
                'api_key' => $_ENV['TEST_API_KEY'],
                'person_id' => 1,
            ]
        );

        $response
            ->assertResponseOk()
            ->seeJson([
                'errors' => false
            ]);
    }

    public function testUserCanUpdateConversation()
    {
        global $conversation_id;

        $rand = rand(100,999);

        $response = $this->json("POST", "/api/conversations/update",
            [
                'token' => $_ENV['TEST_TOKEN'],
                'api_key' => $_ENV['TEST_API_KEY'],
                'notes' => 'These are notes ' . $rand,
                'conversation_id' => $conversation_id,
            ]
        );

        $response
            ->assertResponseOk()
            ->seeJson([
                'errors' => false
            ])->seeJson([
                'notes' => 'These are notes ' . $rand
            ]);
    }

    public function testUserCanAddTicketToConversation()
    {

        global $conversation_id;
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

        $ticket_id = $response->decodeResponseJson()['data']['ticket']['id'];

        $response = $this->json("POST", "/api/conversations/tickets/add",
            [
                'token' => $_ENV['TEST_TOKEN'],
                'api_key' => $_ENV['TEST_API_KEY'],
                'conversation_id' => $conversation_id,
                'ticket_id' => $ticket_id,
            ]
        );

        $response
            ->assertResponseOk()
            ->seeJson([
                'errors' => false
            ]);
    }

    public function testUserCanRemoveATicketFromConversation()
    {
        global $conversation_id;
        global $ticket_id;

        $response = $this->json("POST", "/api/conversations/tickets/remove",
            [
                'token' => $_ENV['TEST_TOKEN'],
                'api_key' => $_ENV['TEST_API_KEY'],
                'conversation_id' => $conversation_id,
                'ticket_id' => $ticket_id,
            ]
        );

        $response
            ->assertResponseOk()
            ->seeJson([
                'errors' => false
            ]);

        $response = $this->json("DELETE", "/api/tickets/destroy",
            [
                'token' => $_ENV['TEST_TOKEN'],
                'api_key' => $_ENV['TEST_API_KEY'],
                'ticket_id' => $ticket_id,
            ]
        );
    }

    public function testUserCanDeleteAConversation()
    {
        global $conversation_id;
        global $ticket_id;

        $response = $this->json("GET", "/api/conversations/destroy",
            [
                'token' => $_ENV['TEST_TOKEN'],
                'api_key' => $_ENV['TEST_API_KEY'],
                'conversation_id' => $conversation_id,
            ]
        );

        $response
            ->assertResponseOk()
            ->seeJson([
                'errors' => false
            ]);
    }
}
