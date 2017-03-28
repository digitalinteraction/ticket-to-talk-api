<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class ArticleTest extends TestCase
{
    public function testUserCanViewArticles()
    {
        $response = $this->json('GET', '/api/articles/all',
            [
                'token' => $_ENV['TEST_TOKEN'],
                'api_key' => $_ENV['TEST_API_KEY']
            ]
        );

        $response
            ->assertResponseOk()
            ->seeJson([
                'errors' => false,
            ]);
    }

    public function testUserCanStoreArticle()
    {
        $response = $this->json('POST', '/api/articles/store',
            [
                'token' => $_ENV['TEST_TOKEN'],
                'api_key' => $_ENV['TEST_API_KEY'],
                'title' => "test article",
                'link' => "tickettotalk.openlab.ncl.ac.uk",
                'notes' => 'this is a test article'
            ]
        );

        $response
            ->assertResponseOk()
            ->seeJson([
                'errors' => false,
            ]);
    }

    public function testUserCanUpdateArticle()
    {

        $rand = rand(1000000, 2000000);

        $response = $this->json('POST', '/api/articles/store',
            [
                'token' => $_ENV['TEST_TOKEN'],
                'api_key' => $_ENV['TEST_API_KEY'],
                'article_id' => 1,
                'title' => "test article",
                'link' => "tickettotalk.openlab.ncl.ac.uk",
                'notes' => 'this is a test article --' . $rand
            ]
        );

        $response
            ->assertResponseOk()
            ->seeJson([
                'errors' => false
            ])
            ->seeJson([
                'notes' => 'this is a test article --' . $rand,
            ]);
    }

    public function testUserCanGetTheirArticle()
    {
        $response = $this->json('GET', '/api/articles/show',
            [
                'token' => $_ENV['TEST_TOKEN'],
                'api_key' => $_ENV['TEST_API_KEY'],
                'article_id' => 5
            ]
        );

        $response
            ->assertResponseOk()
            ->seeJson([
                'errors' => false,
            ]);
    }


    public function testUserCannotGetOtherUsersArticle()
    {
        $response = $this->json('GET', '/api/articles/show',
            [
                'token' => $_ENV['TEST_TOKEN'],
                'api_key' => $_ENV['TEST_API_KEY'],
                'article_id' => 3
            ]
        );

        $response
            ->assertResponseStatus(403)
            ->seeJson([
                'errors' => true,
            ]);
    }
}
