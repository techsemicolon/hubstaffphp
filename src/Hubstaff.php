<?php 

namespace Hubstaff;


use Hubstaff\Authentication\Token;
use Hubstaff\Repositories\User;
use Hubstaff\Repositories\Organization;
use Hubstaff\Repositories\Project;
use Hubstaff\Repositories\Activity;
use Hubstaff\Repositories\Screenshot;
use Hubstaff\Repositories\Note;
use Hubstaff\Repositories\Task;
use Hubstaff\Repositories\Report;
use Hubstaff\Repositories\Payment;

class Hubstaff {

    protected static $instance = null;
    private $appToken;
    private $email;
    private $password;
    private $authToken;
    

    public static function getInstance() {

        if (is_null(self::$instance)) {
            self::$instance = new Hubstaff();
        }
        return self::$instance;
    }

    public function authenticate($appToken, $email, $password, $authToken = null){
        
        $this->appToken = $appToken;
        $this->email = $email;
        $this->password = $password;

        if(is_null($authToken)){
            $token = new Token();
            $this->authToken = $token->getAuthToken($appToken, $email, $password);
        }
        else{
            $this->authToken = $authToken;
        }

        return $this;

    }

    public function getRepository($repo){

        $repo = ucwords(strtolower($repo));
        $repo = 'Hubstaff\\Repositories\\'.$repo;
        return new $repo($this->appToken, $this->authToken);
    }
    


}