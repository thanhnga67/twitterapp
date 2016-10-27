<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class loadMore extends TestCase
{
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
