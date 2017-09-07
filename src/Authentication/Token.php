<?php 

namespace Hubstaff\Authentication;

use Curl\Curl;

class Token {

    private $url = 'https://api.hubstaff.com/v1/auth';


    /**
    * Get Auth Token for your application. Apparently as of now hubstaff do not have expiry
    * for this token. So you can request it and save it in database or env file
    * Please note Auth Token is different from App Token which you can get from My Apps : https://developer.hubstaff.com/my_apps
    * @param none
    * @return string auth token
    */
    
    public function getAuthToken($appToken, $email, $password){
        
        $curl = new Curl();
        $curl->setHeader('App-Token', $appToken);
        $curl->post($this->url, array(
            'email' => $email,
            'password' => $password,
        ));
        if ($curl->error) {
            echo 'errorCode Auth' . $curl->error_code;
            die();
        }
        else {
            $response = json_decode($curl->response);
        }

        $curl->close();

        return $response->user->auth_token;
    }
}