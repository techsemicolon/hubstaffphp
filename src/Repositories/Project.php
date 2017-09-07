<?php 

namespace Hubstaff\Repositories;

use Curl\Curl;

class Project {

    
    private $appToken;
    private $authToken;
    private $urls = [
        'allProjects' => 'https://api.hubstaff.com/v1/projects',
        'projectDetail' => 'https://api.hubstaff.com/v1/projects/{projectId}',
        'projectUsers' => 'https://api.hubstaff.com/v1/projects/{projectId}/members'
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
    * Get all projects list
    * 
    * @param status [string : active or archived]  offset [numetric & optional]
    * @return object projects 
    */
    
    public function getAllProjects($status = null, $offset = 0){
        
        $curl = new Curl();
        $curl->setHeader('App-Token', $this->appToken);
        $curl->setHeader('Auth-Token', $this->authToken);
        
        
        $curl->get($this->urls['allProjects'] , array(
            'offset' => $offset,
            'status' => $status
        ));
        if ($curl->error) {
            echo 'errorCode' . $curl->error_code;
            die();
        }
        else {
            $response = json_decode($curl->response);
        }
        
        $curl->close();

        return $response->projects;
    }

    /**
    * Get project detail from project Id
    *  
    * @param projectId [integer]
    * @return object project 
    */
    
    public function getProjectDetail($projectId = null){
        
        $curl = new Curl();
        $curl->setHeader('App-Token', $this->appToken);
        $curl->setHeader('Auth-Token', $this->authToken);
        
        $url = str_replace('{projectId}', $projectId, $this->urls['projectDetail']);

        $curl->get($url);
        if ($curl->error) {
            echo 'errorCode' . $curl->error_code;
            die();
        }
        else {
            $response = json_decode($curl->response);
        }
        

        $curl->close();

        return $response->project;
    }


    /**
    * Retrieve users for a project
    *  
    * @param projectId [integer], offset [numetric & optional]
    * @return object projectusers 
    */
    
    public function getProjectUsers($projectId = null, $offset = 0, $includeRemoved = false){
        
        $curl = new Curl();
        $curl->setHeader('App-Token', $this->appToken);
        $curl->setHeader('Auth-Token', $this->authToken);
        
        $url = str_replace('{projectId}', $projectId, $this->urls['projectUsers']);
        $curl->get($url, array(
            'include_removed' => $includeRemoved,
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