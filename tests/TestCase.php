<?php

namespace Tests;

use Illuminate\Foundation\Testing\TestCase as BaseTestCase;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication;

    public function getHeader(int $unityId = 1){
        $params = ['login' => 'admin', 'password' =>'utfprgp', 'unity' => $unityId];
        $response = $this->post('/api/auth/authenticate',  $params, [ 'Accept', 'application/json']);
        $header = [ 'Accept', 'application/json', 'Authorization' => "Bearer ". $response['payload']['token']];
        return $header;
    }

}
