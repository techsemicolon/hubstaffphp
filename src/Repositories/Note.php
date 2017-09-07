<?php 

namespace Hubstaff\Repositories;

use Curl\Curl;

class Note {

    
    private $appToken;
    private $authToken;
    private $urls = [
        'allNotes' => 'https://api.hubstaff.com/v1/notes',
        'noteDetail' => 'https://api.hubstaff.com/v1/notes/{noteId}'
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
    * Retrieve notes
    * 
    * @param startTime [Date ISO 86010]  stopTime [Date ISO 86010] organizatuions [array of organization IDs]   users [array of user IDs]
    * @return object notes 
    */
    
    public function getNotes($startTime, $stopTime, $organizationIds = [], $userIds = [], $offset = 0){
        
        $curl = new Curl();
        $curl->setHeader('App-Token', $this->appToken);
        $curl->setHeader('Auth-Token', $this->authToken);
        
        $curl->get($this->urls['allNotes'] , array(
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

        return $response->notes;
    }


    /**
    * Get note detail from note Id
    *  
    * @param orgId [integer]
    * @return object note 
    */
    
    public function getNoteDetail($noteId = null){
        
        $curl = new Curl();
        $curl->setHeader('App-Token', $this->appToken);
        $curl->setHeader('Auth-Token', $this->authToken);
        
        $url = str_replace('{noteId}', $noteId, $this->urls['noteDetail']);

        $curl->get($url);
        if ($curl->error) {
            echo 'errorCode' . $curl->error_code;
            die();
        }
        else {
            $response = json_decode($curl->response);
        }
        

        $curl->close();

        return $response->note;
    }
}