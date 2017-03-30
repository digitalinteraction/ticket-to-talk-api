<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class ArticleTest extends TestCase
{

    var $article_id;

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

        global $article_id;

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

        $d = $response->decodeResponseJson();
        $article_id = $d['data']['article']['id'];
    }

    public function testUserCanUpdateArticle()
    {

        global $article_id;

        $rand = rand(1000000, 2000000);

        $response = $this->json('POST', '/api/articles/store',
            [
                'token' => $_ENV['TEST_TOKEN'],
                'api_key' => $_ENV['TEST_API_KEY'],
                'article_id' => $article_id,
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

        global $article_id;

        $response = $this->json('GET', '/api/articles/show',
            [
                'token' => $_ENV['TEST_TOKEN'],
                'api_key' => $_ENV['TEST_API_KEY'],
                'article_id' => $article_id
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

    public function testUserCanDeleteArticle()
    {
        global $article_id;

        $response = $this->json('DELETE', '/api/articles/destroy',
            [
                'token' => $_ENV['TEST_TOKEN'],
                'api_key' => $_ENV['TEST_API_KEY'],
                'article_id' => $article_id
            ]
        );

        $response
            ->assertResponseOk()
            ->seeJson([
                'errors' => false,
            ]);
    }
}
