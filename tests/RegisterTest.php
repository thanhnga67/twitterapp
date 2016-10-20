<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Resources\lang\jp\validation;

class RegisterTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testRegisterSuccessfully()
    {
        $user = factory(App\User::class)->make();
        $this->visit('/register')
            ->submitForm( trans('app.home.register'), [
            'name' => $user->name,
            'email' => $user->email,
            'password' => "secret",
            'password_confirmation' => "secret"
            ])
            ->seePageIs('/home')
            ->see('You are logged in!');
    }

    public function testRegisterWithuniqueEmail()
     {
         $user = factory(App\User::class)->create(['email' => 'test@realworld.jp', 'password' => bcrypt('secret')]);
         $this->visit('/register')
             ->type('Test', 'name')
             ->type('test@realworld.jp', 'email')
             ->type('secret', 'password')
             ->type('secret', 'password_confirmation')
             ->press( trans('app.home.register') )
             ->see('メールアドレス が既に使用されています');
     }
 
     public function testRegisterWithInvalidPasswordLength()
     {
         $user = factory(App\User::class)->make();
         $this->visit('register')
             ->type($user->name, 'name')
             ->type($user->email, 'email')
             ->type('secre', 'password')
             ->type('secre', 'password_confirmation')
             ->press( trans('app.home.register') )
             ->see('パスワードは 6 文字以上にしてください。');
     }
 
     public function testRegisterWithInvalidPasswordConfirm()
     {
         $user = factory(App\User::class)->make();
         $this->visit('register')
             ->type($user->name, 'name')
             ->type($user->email, 'email')
             ->type('secret', 'password')
             ->type('secret1', 'password_confirmation')
             ->press( trans('app.home.register') )
             ->see( 'パスワード が確認用欄と一致しません。');
     }
 
}
