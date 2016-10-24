<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class createTweet extends TestCase
{
    protected function loggedIn()
    {
        $user = factory(App\User::class)->create();
        $this->visit('/login')
            ->submitForm(trans('app.home.login'), [
                'email' => $user->email,
                'password' => 'secret'
            ]);
    }

    public function testCreateTweetWithoutContent()
    {
        $this->loggedIn();
        $server = $this->transformHeadersToServerVars(['HTTP_X-Requested-With' => 'XMLHttpRequest']);
        $this->call('POST', '/createArticle', ['_token' => csrf_token(), 'content' => ''], [], $server);
        $responseData = $this->decodeResponseJson();
        $this->assertEquals($responseData['errors']['content'][0], 'ツイート は必要です。');
    }

    public function testCreateTweetWithTooLongContent()
    {
        $this->loggedIn();
        $server = $this->transformHeadersToServerVars(['HTTP_X-Requested-With' => 'XMLHttpRequest']);
        $tooLongContent = str_random(1000);
        $this->call('POST', '/createArticle', ['_token' => csrf_token(), 'content' => $tooLongContent], [], $server);
        $responseData = $this->decodeResponseJson();
        $this->assertEquals($responseData['errors']['content'][0], 'ツイートは140 文字以内です。');
    }

    public function testSuccessfullCreateTweet()
    {
        $this->loggedIn();
        $server = $this->transformHeadersToServerVars(['HTTP_X-Requested-With' => 'XMLHttpRequest']);
        $this->call('POST', '/createArticle', ['_token' => csrf_token(), 'content' => 'test'], [], $server);
        $responseData = $this->decodeResponseJson();
        $this->visit('home')->see('test');
    }
}
