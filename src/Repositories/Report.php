<?php 

namespace Hubstaff\Repositories;

use Curl\Curl;

class Report {

    
    private $appToken;
    private $authToken;
    private $urls = [
        'teamReport' => 'https://api.hubstaff.com/v1/weekly/team',
        'myReport' => 'https://api.hubstaff.com/v1/weekly/my',
        'customTeamReportByDate' => 'https://api.hubstaff.com/v1/custom/by_date/team',
        'customMyReportByDate' => 'https://api.hubstaff.com/v1/custom/by_member/my',
        'customTeamReportByMember' => 'https://api.hubstaff.com/v1/custom/by_date/team',
        'customMyReportByMember' => 'https://api.hubstaff.com/v1/custom/by_member/my',
        'customTeamReportByProject' => 'https://api.hubstaff.com/v1/custom/by_project/team',
        'customMyReportByProject' => 'https://api.hubstaff.com/v1/custom/by_project/my'
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
    * Retrieve time worked team report for a week
    * 
    * @param date [DateinWeek yyyy-mm-dd]  organizations [array of organization IDs]   projects [array of project IDs]   users [array of user IDs]
    * @return object notes 
    */
    
    public function getWeeklyTeamReport($date, $organizationIds = [], $projectIds = [], $userIds = []){
        
        $curl = new Curl();
        $curl->setHeader('App-Token', $this->appToken);
        $curl->setHeader('Auth-Token', $this->authToken);
        
        $curl->get($this->urls['teamReport'] , array(
            'date' => $date,
            'organizations' => implode(",", $organizationIds),
            'projects' => implode(",", $projectIds),
            'users' => implode(",", $userIds)
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
    * Retrieve time worked my report for a week
    * 
    * @param date [DateinWeek yyyy-mm-dd]  organizations [array of organization IDs]   projects [array of project IDs]   users [array of user IDs]
    * @return object notes 
    */
    
    public function getWeeklyMyReport($date, $organizationIds = [], $projectIds = [], $userIds = []){
        
        $curl = new Curl();
        $curl->setHeader('App-Token', $this->appToken);
        $curl->setHeader('Auth-Token', $this->authToken);
        
        $curl->get($this->urls['teamReport'] , array(
            'date' => $date,
            'organizations' => implode(",", $organizationIds),
            'projects' => implode(",", $projectIds),
            'users' => implode(",", $userIds)
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
    * Retrieve custom team report grouped by date
    * 
    * @param startDate [date yyyy-mm-dd] endDate [date yyyy-mm-dd]  organizations [array of organization IDs]   projects [array of project IDs]   users [array of user IDs] showTasks[boolean] showNotes[boolean] showActivity[boolean] includeArchived[boolean]
    * @return object notes 
    */
    
    public function getCustomTeamReportByDate($startDate, $endDate, $organizationIds = [], $projectIds = [], $userIds = [], $showTasks = false, $showNotes = false, $showActivity = false, $includeArchived = false){
        
        $curl = new Curl();
        $curl->setHeader('App-Token', $this->appToken);
        $curl->setHeader('Auth-Token', $this->authToken);
        
        $curl->get($this->urls['customTeamReportByDate'] , array(
            'start_date' => $startDate,
            'end_date' => $endDate,
            'organizations' => implode(",", $organizationIds),
            'projects' => implode(",", $projectIds),
            'users' => implode(",", $userIds),
            'show_tasks' => $showTasks,
            'show_notes' => $showNotes, 
            'show_activity' => $showActivity,
            'include_archived' => $includeArchived
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
    * Retrieve custom my report grouped by date
    * 
    * @param startDate [date yyyy-mm-dd] endDate [date yyyy-mm-dd]  organizations [array of organization IDs]   projects [array of project IDs]   users [array of user IDs] showTasks[boolean] showNotes[boolean] showActivity[boolean] includeArchived[boolean]
    * @return object notes 
    */
    
    public function getCustomMyReportByDate($startDate, $endDate, $organizationIds = [], $projectIds = [], $userIds = [], $showTasks = false, $showNotes = false, $showActivity = false, $includeArchived = false){
        
        $curl = new Curl();
        $curl->setHeader('App-Token', $this->appToken);
        $curl->setHeader('Auth-Token', $this->authToken);
        
        $curl->get($this->urls['customMyReportByDate'] , array(
            'start_date' => $startDate,
            'end_date' => $endDate,
            'organizations' => implode(",", $organizationIds),
            'projects' => implode(",", $projectIds),
            'users' => implode(",", $userIds),
            'show_tasks' => $showTasks,
            'show_notes' => $showNotes, 
            'show_activity' => $showActivity,
            'include_archived' => $includeArchived
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
    * Retrieve custom team report grouped by member
    * 
    * @param startDate [date yyyy-mm-dd] endDate [date yyyy-mm-dd]  organizations [array of organization IDs]   projects [array of project IDs]   users [array of user IDs] showTasks[boolean] showNotes[boolean] showActivity[boolean] includeArchived[boolean]
    * @return object notes 
    */
    
    public function getCustomTeamReportByMember($startDate, $endDate, $organizationIds = [], $projectIds = [], $userIds = [], $showTasks = false, $showNotes = false, $showActivity = false, $includeArchived = false){
        
        $curl = new Curl();
        $curl->setHeader('App-Token', $this->appToken);
        $curl->setHeader('Auth-Token', $this->authToken);
        
        $curl->get($this->urls['customTeamReportByMember'] , array(
            'start_date' => $startDate,
            'end_date' => $endDate,
            'organizations' => implode(",", $organizationIds),
            'projects' => implode(",", $projectIds),
            'users' => implode(",", $userIds),
            'show_tasks' => $showTasks,
            'show_notes' => $showNotes, 
            'show_activity' => $showActivity,
            'include_archived' => $includeArchived
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
    * Retrieve custom my report grouped by member
    * 
    * @param startDate [date yyyy-mm-dd] endDate [date yyyy-mm-dd]  organizations [array of organization IDs]   projects [array of project IDs]   users [array of user IDs] showTasks[boolean] showNotes[boolean] showActivity[boolean] includeArchived[boolean]
    * @return object notes 
    */
    
    public function getCustomMyReportBymember($startDate, $endDate, $organizationIds = [], $projectIds = [], $userIds = [], $showTasks = false, $showNotes = false, $showActivity = false, $includeArchived = false){
        
        $curl = new Curl();
        $curl->setHeader('App-Token', $this->appToken);
        $curl->setHeader('Auth-Token', $this->authToken);
        
        $curl->get($this->urls['customMyReportByMember'] , array(
            'start_date' => $startDate,
            'end_date' => $endDate,
            'organizations' => implode(",", $organizationIds),
            'projects' => implode(",", $projectIds),
            'users' => implode(",", $userIds),
            'show_tasks' => $showTasks,
            'show_notes' => $showNotes, 
            'show_activity' => $showActivity,
            'include_archived' => $includeArchived
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
    * Retrieve custom team report grouped by project
    * 
    * @param startDate [date yyyy-mm-dd] endDate [date yyyy-mm-dd]  organizations [array of organization IDs]   projects [array of project IDs]   users [array of user IDs] showTasks[boolean] showNotes[boolean] showActivity[boolean] includeArchived[boolean]
    * @return object notes 
    */
    
    public function getCustomTeamReportByProject($startDate, $endDate, $organizationIds = [], $projectIds = [], $userIds = [], $showTasks = false, $showNotes = false, $showActivity = false, $includeArchived = false){
        
        $curl = new Curl();
        $curl->setHeader('App-Token', $this->appToken);
        $curl->setHeader('Auth-Token', $this->authToken);
        
        $curl->get($this->urls['customTeamReportByProject'] , array(
            'start_date' => $startDate,
            'end_date' => $endDate,
            'organizations' => implode(",", $organizationIds),
            'projects' => implode(",", $projectIds),
            'users' => implode(",", $userIds),
            'show_tasks' => $showTasks,
            'show_notes' => $showNotes, 
            'show_activity' => $showActivity,
            'include_archived' => $includeArchived
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
    * Retrieve custom my report grouped by project
    * 
    * @param startDate [date yyyy-mm-dd] endDate [date yyyy-mm-dd]  organizations [array of organization IDs]   projects [array of project IDs]   users [array of user IDs] showTasks[boolean] showNotes[boolean] showActivity[boolean] includeArchived[boolean]
    * @return object notes 
    */
    
    public function getCustomMyReportByProject($startDate, $endDate, $organizationIds = [], $projectIds = [], $userIds = [], $showTasks = false, $showNotes = false, $showActivity = false, $includeArchived = false){
        
        $curl = new Curl();
        $curl->setHeader('App-Token', $this->appToken);
        $curl->setHeader('Auth-Token', $this->authToken);
        
        $curl->get($this->urls['customMyReportByProject'] , array(
            'start_date' => $startDate,
            'end_date' => $endDate,
            'organizations' => implode(",", $organizationIds),
            'projects' => implode(",", $projectIds),
            'users' => implode(",", $userIds),
            'show_tasks' => $showTasks,
            'show_notes' => $showNotes, 
            'show_activity' => $showActivity,
            'include_archived' => $includeArchived
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
    * Retrieve time edit logs
    * 
    * @param startDate [date yyyy-mm-dd] endDate [date yyyy-mm-dd]  organizations [array of organization IDs]   projects [array of project IDs]   users [array of user IDs] offset[integer]
    * @return object notes 
    */
    
    public function getTimeEditLogs($startDate, $endDate, $organizationIds = [], $projectIds = [], $userIds = [], $offset = 0){
        
        $curl = new Curl();
        $curl->setHeader('App-Token', $this->appToken);
        $curl->setHeader('Auth-Token', $this->authToken);
        
        $curl->get($this->urls['customMyReportByProject'] , array(
            'start_date' => $startDate,
            'end_date' => $endDate,
            'organizations' => implode(",", $organizationIds),
            'projects' => implode(",", $projectIds),
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

        return $response;
    }



    

    
}