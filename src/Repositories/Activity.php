<?php 

namespace Hubstaff\Repositories;

use Curl\Curl;

class Activity {

    
    private $appToken;
    private $authToken;
    private $urls = [
        'activities' => 'https://api.hubstaff.com/v1/activities',
        'activityApplications' => 'https://api.hubstaff.com/v1/activities/applications',
        'activityUrls' => 'https://api.hubstaff.com/v1/activities/urls'
    ];

    /**
    * Constructor to initialize appToken and authToken
    * 
    * @param appToken [string]  authToken [string]
    * @return object this 
    */

    public function __construct($appToken, $authToken){

        $this->appToken = $appToken;
        $this->authToken = $authToken;

        return $this;
    }

    /**
    * Get activities
    * 
    * @param startTime [Date ISO 86010]  stopTime [Date ISO 86010] organizatuions [array of organization IDs]   users [array of user IDs]
    * @return object activities 
    */
    
    public function getActivities($startTime, $stopTime, $organizationIds = [], $userIds = [], $offset = 0){
        
        $curl = new Curl();
        $curl->setHeader('App-Token', $this->appToken);
        $curl->setHeader('Auth-Token', $this->authToken);
        
        $curl->get($this->urls['activities'] , array(
            'start_time' => date(DATE_ISO8601, strtotime($startTime)),
            'stop_time' => date(DATE_ISO8601, strtotime($stopTime)),
            'organizations' => implode(",", $organizationIds),
            'users' => implode(",", $userIds),
            'offset' => $offset
        ));
        if ($curl->error) {
            echo 'errorCode' . $curl->error_code;
            die();
        }
        else {
            $response = json_decode($curl->response);
        }
        
        $curl->close();

        return $response->activities;
    }

    /**
    * Retrieve application activities
    * 
    * @param startTime [Date ISO 86010]  stopTime [Date ISO 86010] organizatuions [array of organization IDs]   users [array of user IDs]
    * @return object activities 
    */
    
    public function getActivityApplications($startTime, $stopTime, $organizationIds = [], $userIds = [], $offset = 0){
        
        $curl = new Curl();
        $curl->setHeader('App-Token', $this->appToken);
        $curl->setHeader('Auth-Token', $this->authToken);
        
        $curl->get($this->urls['activityApplications'] , array(
            'start_time' => date(DATE_ISO8601, strtotime($startTime)),
            'stop_time' => date(DATE_ISO8601, strtotime($stopTime)),
            'organizations' => implode(",", $organizationIds),
            'users' => implode(",", $userIds),
            'offset' => $offset
        ));
        if ($curl->error) {
            echo 'errorCode' . $curl->error_code;
            die();
        }
        else {
            $response = json_decode($curl->response);
        }
        
        $curl->close();

        return $response->applications;
    }


    /**
    * Retrieve URL activities
    * 
    * @param startTime [Date ISO 86010]  stopTime [Date ISO 86010] organizatuions [array of organization IDs]   users [array of user IDs]
    * @return object activities 
    */
    
    public function getActivityUrls($startTime, $stopTime, $organizationIds = [], $userIds = [], $offset = 0){
        
        $curl = new Curl();
        $curl->setHeader('App-Token', $this->appToken);
        $curl->setHeader('Auth-Token', $this->authToken);
        
        $curl->get($this->urls['activityUrls'] , array(
            'start_time' => date(DATE_ISO8601, strtotime($startTime)),
            'stop_time' => date(DATE_ISO8601, strtotime($stopTime)),
            'organizations' => implode(",", $organizationIds),
            'users' => implode(",", $userIds),
            'offset' => $offset
        ));
        if ($curl->error) {
            echo 'errorCode' . $curl->error_code;
            die();
        }
        else {
            $response = json_decode($curl->response);
        }
        
        $curl->close();

        return $response->urls;
    }


    
}