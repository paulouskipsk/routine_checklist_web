<?php

namespace Tests;

use Illuminate\Foundation\Testing\TestCase as BaseTestCase;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication;

    public function getHeaderAPI(int $unityId = 1){
        $params = ['login' => 'admin', 'password' =>'utfprgp@tsi', 'unity' => $unityId];
        $response = $this->post('/api/auth/authenticate',  $params, [ 'Accept', 'application/json']);
        $header = [ 'Accept', 'application/json', 'Authorization' => "Bearer ". $response['payload']['token']];
        return $header;
    }

    public function getHeaderWEB(){
        $header = [
            'Accept' => 'application/json', 
            'laravel_session' => $this->getCookie('admin', 'utfprgp@tsi')
        ];
        return $header;
    }

    public function getCookie($login, $password){
        $params = ['login' => $login, 'password' => $password];
        $headers = [ 'Accept', 'application/json'];
        $response = $this->post('/authenticate',  $params, $headers);
        $response->assertCookieNotExpired('laravel_session');
        return $response->getCookie('laravel_session');
    }

}
