<?php 

namespace Hubstaff\Repositories;

use Curl\Curl;

class User {

    
    private $appToken;
    private $authToken;
    private $urls = [
        'allUsers' => 'https://api.hubstaff.com/v1/users',
        'userDetail' => 'https://api.hubstaff.com/v1/users/{userId}',
        'organizationUser' => 'https://api.hubstaff.com/v1/users/{userId}/organizations',
        'projectUser' => 'https://api.hubstaff.com/v1/users/{userId}/projects'
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
    * Get all users list
    * 
    * @param organizationMemberships [Include the organization memberships for each user], projectMemberships [Include the project memberships for each user]
    * @return object users 
    */
    
    public function getAllUsers($organizationMemberships = false, $projectMemberships = false, $offset = 0){
        
        $curl = new Curl();
        $curl->setHeader('App-Token', $this->appToken);
        $curl->setHeader('Auth-Token', $this->authToken);
        
        
        $curl->get($this->urls['allUsers'] , array(
            'organization_memberships' => $organizationMemberships,
            'project_memberships' => $projectMemberships,
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

        return $response->users;
    }

    /**
    * Get user detail from user Id
    *  
    * @param userId [integer]
    * @return object user 
    */
    
    public function getUserDetail($userId = null){
        
        $curl = new Curl();
        $curl->setHeader('App-Token', $this->appToken);
        $curl->setHeader('Auth-Token', $this->authToken);
        
        $url = str_replace('{userId}', $userId, $this->urls['userDetail']);

        $curl->get($url);
        if ($curl->error) {
            echo 'errorCode' . $curl->error_code;
            die();
        }
        else {
            $response = json_decode($curl->response);
        }
        

        $curl->close();

        return $response;
    }


    /**
    * Retrieve organization memberships for a user
    *  
    * @param userId [integer], offset [numetric & optional]
    * @return object user 
    */
    
    public function getUserOrgMemberships($userId = null, $offset = 0){
        
        $curl = new Curl();
        $curl->setHeader('App-Token', $this->appToken);
        $curl->setHeader('Auth-Token', $this->authToken);
        
        $url = str_replace('{userId}', $userId, $this->urls['organizationUser']);

        $curl->get($url, array(
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

        return $response;
    }

    /**
    * Retrieve project memberships for a user
    *  
    * @param userId [integer], offset [numetric & optional]
    * @return object user 
    */
    
    public function getUserProjectMemberships($userId = null, $offset = 0){
        
        $curl = new Curl();
        $curl->setHeader('App-Token', $this->appToken);
        $curl->setHeader('Auth-Token', $this->authToken);
        
        $url = str_replace('{userId}', $userId, $this->urls['projectUser']);

        $curl->get($url, array(
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

        return $response;
    }
}