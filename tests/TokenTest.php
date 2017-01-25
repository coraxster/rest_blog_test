<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class TokenTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testGetToken()
    {
    	$faker = Faker\Factory::create();
    	$userData = [
    		'email' => $faker->unique()->safeEmail,
    		'password' => $faker->unique()->password()
    	];
        $user = factory(\App\User::class)
        	->create([
        		'email' => $userData['email'],
        		'password' => bcrypt($userData['password'])
        	]);
        $response = $this->call('POST', '/json/auth', [
        		'email' => $userData['email'],
	    		'password' => $userData['password']
        	]);
        $this->seeInDatabase('users', [
                'email' => $userData['email'],
	    		'token' => $response->original
            ]);
    }
    public function testGetTokenFail()
    {
        $faker = Faker\Factory::create();
        $userData = [
            'email' => $faker->unique()->safeEmail,
            'password' => $faker->unique()->password()
        ];
        $user = factory(\App\User::class)
            ->create([
                'email' => $userData['email'],
                'password' => bcrypt($userData['password'])
            ]);
        $response = $this->post('/json/auth', [
                'email' => $userData['email'],
                'password' => 'super_fake_password'
            ])->assertResponseStatus(403);
    }
}
