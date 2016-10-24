<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class Tweet extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */

    protected function loggedin()
    {
        $user = factory(App\User::class)->create();
        $this->visit('/login')
            ->submitForm(trans('app.home.login'), [
                'email' => $user->email,
                'password' => 'secret'
                ]);
    }


    public function notLogin()
    {

    }

    public function testCreateTweetWithoutContent()
    {
        $this->loggedin();
        $server = $this->transformHeadersToServerVars(['HTTP_X-Requested-With' => 'XMLHttpRequest']);
        $this->call('POST', '/createArticle', ['_token' => csrf_token(), 'content' => ''], [], $server);
        $responseData = $this->decodeResponseJson();
        $this->assertEquals($responseData['errors']['content'][0], 'ツイート は必要です。');
    }

    public function testCreateTweetWithTooLongContent()
    {
        $this->loggedin();
        $server = $this->transformHeadersToServerVars(['HTTP_X-Requested-With' => 'XMLHttpRequest']);
        $invalidContent = "too long too long too long too long too long too long too long too long too long too long too long too long too long too long too long too long too long too long too long ";
        $this->call('POST', '/createArticle', ['_token' => csrf_token(), 'content' => $invalidContent], [], $server);
        $responseData = $this->decodeResponseJson();
        $this->assertEquals($responseData['errors']['content'][0], 'ツイートは140 文字以内です。');
    }

    public function testSuccessfullCreateTweet()
    {
        $this->loggedin();
        $server = $this->transformHeadersToServerVars(['HTTP_X-Requested-With' => 'XMLHttpRequest']);
        $this->call('POST', '/createArticle', ['_token' => csrf_token(), 'content' => 'test'], [], $server);
        $responseData = $this->decodeResponseJson();
        $this->visit('home')->see('test');
    }

    public function testLoadMore()
    {
        $user = factory(App\User::class)->create();
        factory(App\Article::class, 20)->create(['user_id' => $user->id]);
        $articles = $user->articles()->orderBy('created_at', 'DESC')->take(10)->skip(10)->get();

        $this->visit('/login')
            ->submitForm(trans('app.home.login'), [
                'email' => $user->email,
                'password' => 'secret'
                ]);

        $expectedView = view('Articles', array('articles' => $articles))->render();
        $responseData = $this->call('GET', '/home/?page=2', [], [], ['HTTP_X-Requested-With' => 'XMLHttpRequest']);
        $data = $responseData->original;
        $actualView = view('Articles', array('articles' => $data['articles']))->render();
        $this->assertEquals($expectedView, $actualView);
    }
}
