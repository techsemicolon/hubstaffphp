<?php 

namespace Hubstaff\Repositories;

use Curl\Curl;

class Organization {

    
    private $appToken;
    private $authToken;
    private $urls = [
        'allOrgs' => 'https://api.hubstaff.com/v1/organizations',
        'orgDetail' => 'https://api.hubstaff.com/v1/organizations/{orgId}',
        'orgProjects' => 'https://api.hubstaff.com/v1/organizations/{orgId}/projects',
        'orgUsers' => 'https://api.hubstaff.com/v1/organizations/{orgId}/members'
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
    * @param offset [numetric & optional]
    * @return object organizations 
    */
    
    public function getAllOrgs($offset = 0){
        
        $curl = new Curl();
        $curl->setHeader('App-Token', $this->appToken);
        $curl->setHeader('Auth-Token', $this->authToken);
        
        
        $curl->get($this->urls['allOrgs'] , array(
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

        return $response->organizations;
    }

    /**
    * Get organization detail from organization Id
    *  
    * @param orgId [integer]
    * @return object organization 
    */
    
    public function getOrgDetail($orgId = null){
        
        $curl = new Curl();
        $curl->setHeader('App-Token', $this->appToken);
        $curl->setHeader('Auth-Token', $this->authToken);
        
        $url = str_replace('{orgId}', $orgId, $this->urls['orgDetail']);

        $curl->get($url);
        if ($curl->error) {
            echo 'errorCode' . $curl->error_code;
            die();
        }
        else {
            $response = json_decode($curl->response);
        }
        

        $curl->close();

        return $response->organization;
    }


    /**
    * Retrieve projects for an organization
    *  
    * @param orgId [integer], offset [numetric & optional]
    * @return object user 
    */
    
    public function getOrgProjects($orgId = null, $offset = 0){
        
        $curl = new Curl();
        $curl->setHeader('App-Token', $this->appToken);
        $curl->setHeader('Auth-Token', $this->authToken);
        
        $url = str_replace('{orgId}', $orgId, $this->urls['orgProjects']);

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
    * Retrieve users for an organization
    *  
    * @param orgId [integer], offset [numetric & optional]
    * @return object organizationusers 
    */
    
    public function getOrgUsers($orgId = null, $offset = 0){
        
        $curl = new Curl();
        $curl->setHeader('App-Token', $this->appToken);
        $curl->setHeader('Auth-Token', $this->authToken);
        
        $url = str_replace('{orgId}', $orgId, $this->urls['orgUsers']);

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