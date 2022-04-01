<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class test_user_can_login extends TestCase
{


    /**test login
     * @return void
     */
    public function test_user_can_login_with_correct_credentials(): void
    {
        $response = $this->call('POST', '/login', [
            'email' => 'teacher@couch.tutors',
            'password' => 'P@ssw0rd',
        ]);

        $this->assertEquals(200, $response->getStatusCode());
    }

    /**invalid data
     * @return void
     */
    public function test_invalid_credentials_returns_an_error(): void
    {
        $response = $this->call('POST', '/login', [
            'email' => 'bad@email.com',
            'password' => 'badpass',
        ]);

        $this->assertEquals(400, $response->getStatusCode());
    }


    /**empty email returns an error
     * @return void
     */
    public function test_empty_email_returns_an_error(): void
    {
        $response = $this->call('POST', '/login', [
            'password' => 'badpass',
        ]);

        $this->assertEquals(422, $response->getStatusCode());
    }
}
