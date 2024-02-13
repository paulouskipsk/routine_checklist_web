<?php

namespace Tests;

use Illuminate\Foundation\Testing\TestCase as BaseTestCase;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication;

    public function getHeader(){
        $params = ['login' => 'admin', 'password' =>'123'];
        $response = $this->post('/api/auth/authenticate',  $params, [ 'Accept', 'application/json']);
        $header = [ 'Accept', 'application/json', 'Authorization' => "Bearer ". $response['payload']['token']];
        return $header;
    }
}
