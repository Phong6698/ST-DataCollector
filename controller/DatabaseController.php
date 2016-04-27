<?php
require_once __DIR__ .'/../database/TableSummoner.php';
//http://stackoverflow.com/questions/9149483/get-folder-up-one-level


class DatabaseController{

    private  $TABLE_SUMMONER = null;

    private static $instance = null;

    private function __construct(){
        $this->TABLE_SUMMONER = new TableSummoner();
    }

    static public function getInstance() {
        if (null === self::$instance) {
            self::$instance = new self ();
        }
        return self::$instance;
    }


    public function getAllSummoners(){
        $summoners = $this->TABLE_SUMMONER->getAllSummoners();
        return $summoners;
    }

    
}

