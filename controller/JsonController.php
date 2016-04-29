<?php
include_once __DIR__ . '/../json/JsonLoader.php';
include_once __DIR__ . '/../model/Game.php';
class JsonController{

    private $jsonLoader;

    private static $instance = null;

    private function __construct(){
        $this->jsonLoader = new JsonLoader();
    }

    static public function getInstance() {
        if (null === self::$instance) {
            self::$instance = new self ();
        }
        return self::$instance;
    }

    public function getGames($summonerId){
        $result = $this->jsonLoader->getRecentGames($summonerId);
        $games = array();
        foreach ($result->games as $gameJsonObj){
            $game = new Game();
            $game->__set("createDate", $gameJsonObj->createDate);
            array_push($games, $game);
        }
        return $games;
    }
}