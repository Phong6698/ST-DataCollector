<?php
require_once __DIR__ .'/../database/TableSummoner.php';
require_once __DIR__ .'/../database/TableGames.php';
//http://stackoverflow.com/questions/9149483/get-folder-up-one-level


class DatabaseController{

    private  $TABLE_SUMMONER = null;
    private  $TABLE_GAMNES = null;

    private static $instance = null;

    private function __construct(){
        $this->TABLE_SUMMONER = new TableSummoner();
        $this->TABLE_GAMNES = new TableGames();
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

    public function getNewestCreateDate($summoner_ID){
        $createDate = $this->TABLE_GAMNES->getNewestCreateDate($summoner_ID);
        return $createDate;
    }


}

