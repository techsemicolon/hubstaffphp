<?php 

namespace Hubstaff\Repositories;

use Curl\Curl;

class Task {

    
    private $appToken;
    private $authToken;
    private $urls = [
        'allTasks' => 'https://api.hubstaff.com/v1/tasks',
        'taskDetail' => 'https://api.hubstaff.com/v1/notes/{taskId}'
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
    * Retrieve tasks
    * 
    * @param startTime [Date ISO 86010]  stopTime [Date ISO 86010] organizatuions [array of organization IDs]   users [array of user IDs]
    * @return object tasks 
    */
    
    public function getTasks($projectIds = [], $offset = 0){
        
        $curl = new Curl();
        $curl->setHeader('App-Token', $this->appToken);
        $curl->setHeader('Auth-Token', $this->authToken);
        
        $curl->get($this->urls['allTasks'] , array(
            'projects' => implode(",", $projectIds),
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

        return $response->tasks;
    }


    /**
    * Get task detail from task Id
    *  
    * @param orgId [integer]
    * @return object task 
    */
    
    public function getTaskDetail($taskId = null){
        
        $curl = new Curl();
        $curl->setHeader('App-Token', $this->appToken);
        $curl->setHeader('Auth-Token', $this->authToken);
        
        $url = str_replace('{taskId}', $taskId, $this->urls['taskDetail']);

        $curl->get($url);
        if ($curl->error) {
            echo 'errorCode' . $curl->error_code;
            die();
        }
        else {
            $response = json_decode($curl->response);
        }
        

        $curl->close();

        return $response->task;
    }
}