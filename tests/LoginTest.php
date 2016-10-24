<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class LoginTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    use DatabaseTransactions;

    public function testLoginView()
    {
        $this->visit('/login')
            ->click( trans('app.home.registerlink') )
            ->seePageIs('/register');
    }

    public function testSuccessfullLogin() {
    
    $user = factory(App\User::class)->create();

    $this->visit('/login')
        ->submitForm( trans('app.home.login'), [
            'email' => $user->email,
            'password' => "secret"
        ])
        ->seePageIs('/home');
	}

    public function testLoginWithInvalidEmail()
    {
        $user = factory(App\User::class)->create();
        $invalidEmail = $user->email . '123';
        $this->visit('/login')
            ->type($invalidEmail, 'email')
            ->type($user->password, 'password')
            ->press(trans('app.home.login'))
            ->see( trans('auth.failed') );
    }

    public function testLoginWithInvalidPassword()
    {
        $user = factory(App\User::class)->create();
        $invalidEmail = $user->password . '123';
        $this->visit('/login')
            ->type($invalidEmail, 'email')
            ->type($user->password, 'password')
            ->press(trans('app.home.login'))
            ->see( trans('auth.failed') );
    }
}
