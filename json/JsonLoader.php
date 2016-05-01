<?php

class JsonLoader{

    private $api_key;

    public function __construct(){
        $this->api_key = file_get_contents( __DIR__ .'/../json/League of Legends API Key');
    }

    public function getRecentGames($summonerId){
        $url = "https://euw.api.pvp.net/api/lol/euw/v1.3/game/by-summoner/" . $summonerId . "/recent?api_key=" . file_get_contents( __DIR__ .'/../json/League of Legends API Key');
        $result = file_get_contents($url);
        return json_decode($result);
    }

}