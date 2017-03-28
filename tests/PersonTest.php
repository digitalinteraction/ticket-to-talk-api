<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class PersonTest extends TestCase
{

    var $person_id = 0;
    /**
     *
     */
    public function testUserCanStorePerson()
    {
        global $person_id;
        $response = $this->json('POST', '/api/people/store',
            [
                'token' => $_ENV['TEST_TOKEN'],
                'api_key' => $_ENV['TEST_API_KEY'],
                'name' => "test_person",
                'birthYear' => "2000",
                'birthPlace' => "London",
                'notes' => 'this is a test person',
                'townCity' => 'London',
                'relation' => 'Granddad',
                'image' => 'default_profile.jpg',
                'imageHash' => 'jdfskjbfslkfbgklsfbg'
            ]
        );

        $response
            ->assertResponseOk()
            ->seeJson([
                'errors' => false
            ]);

        $data = $response->decodeResponseJson();
        $id = $data['data']['person']['id'];

        $person_id = $id;
    }

    public function testUserCanUpdatePerson()
    {

        global $person_id;
        $rand = rand(1000000, 9000000);

        $response = $this->json('POST', '/api/people/update',
            [
                'token' => $_ENV['TEST_TOKEN'],
                'api_key' => $_ENV['TEST_API_KEY'],
                'person_id' => $person_id,
                'name' => "updated test_person",
                'birthYear' => "2000",
                'birthPlace' => "London",
                'notes' => 'this is a test person' . $rand,
                'townCity' => 'London',
                'relation' => 'Granddad',
                'image' => 'default_profile.jpg',
                'imageHash' => 'jdfskjbfslkfbgklsfbg'
            ]
        );

        $response
            ->assertResponseOk()
            ->seeJson([
                'errors' => false
            ])->seeJson([
                'notes' => 'this is a test person' . $rand
            ]);
    }

    /**
     *
     */
    public function testUserCanGetAPerson()
    {
        global $person_id;
        $response = $this->json('GET', '/api/people/show',
            [
                'token' => $_ENV['TEST_TOKEN'],
                'api_key' => $_ENV['TEST_API_KEY'],
                'person_id' => $person_id
            ]
        );

        $response
            ->assertResponseOk()
            ->seeJson([
                'errors' => false
            ]);
    }

    public function testUserCannotSeeUnauthorisedPeople()
    {
        $response = $this->json('GET', '/api/people/show',
            [
                'token' => $_ENV['TEST_TOKEN'],
                'api_key' => $_ENV['TEST_API_KEY'],
                'person_id' => 7
            ]
        );

        $response
            ->assertResponseStatus(403)
            ->seeJson([
                'errors' => true
            ]);
    }

    public function testUserCanSeeContributingPeople()
    {
        global $person_id;

        $response = $this->json('GET', '/api/people/getusers',
            [
                'token' => $_ENV['TEST_TOKEN'],
                'api_key' => $_ENV['TEST_API_KEY'],
                'person_id' => $person_id
            ]
        );

        $response
            ->assertResponseOk()
            ->seeJson([
                'errors' => false
            ]);
    }

    public function testUserCanGetPersonsTickets()
    {
        global $person_id;

        $response = $this->json('GET', '/api/people/tickets',
            [
                'token' => $_ENV['TEST_TOKEN'],
                'api_key' => $_ENV['TEST_API_KEY'],
                'person_id' => $person_id
            ]
        );

        $response
            ->assertResponseOk()
            ->seeJson([
                'errors' => false
            ]);
    }

    public function testUserCannotGetUnauthorisedPersonsTickets()
    {
        $response = $this->json('GET', '/api/people/tickets',
            [
                'token' => $_ENV['TEST_TOKEN'],
                'api_key' => $_ENV['TEST_API_KEY'],
                'person_id' => 7
            ]
        );

        $response
            ->assertResponseStatus(403)
            ->seeJson([
                'errors' => true
            ]);
    }

    public function testUserCanDeletePerson()
    {
        global $person_id;
        $response = $this->json("DELETE", '/api/people/destroy',
            [
                'token' => $_ENV['TEST_TOKEN'],
                'api_key' => $_ENV['TEST_API_KEY'],
                'person_id' => $person_id
            ]
        );

        $response
            ->assertResponseOk()
            ->seeJson([
                'errors' => false
            ]);
    }
}
