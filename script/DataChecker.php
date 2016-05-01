<?php
require_once __DIR__ . '/../model/Summoner.php';
require_once __DIR__ . '/../model/Game.php';
require_once __DIR__ . '/../controller/DatabaseController.php';
require_once __DIR__ . '/../controller/JsonController.php';

class DataChecker{



    public function checkData(){
        $summoners = DatabaseController::getInstance()->getAllSummoners();
        foreach($summoners as $summoner){
            //$games = array();

            $createDateDB = DatabaseController::getInstance()->getNewestCreateDate($summoner->__get('id'));
            $games = JsonController::getInstance()->getGames($summoner->__get("summonerId"));
            foreach($games as $game){
                $createDateAPI = $game->__get("createDate");
                echo $createDateAPI." : ".$createDateDB;

                if($createDateAPI > $createDateDB){
                    //TODO save in DB
                    echo " NEW<br>";
                }elseif($createDateAPI <= $createDateDB){
                    //TODO don't save in DB
                    echo " OLD<br>";
                }

                //TODO look at the $resultJSON_decoded->games[1]->createDate


                /*
                $game = new Game();
                $game->__set('gameId', $gameJsonObj->gameId);
                $game->__set('gameMode', $gameJsonObj->gameMode);
                $game->__set('gameType', $gameJsonObj->gameType);
                $game->__set('subType', $gameJsonObj->subType);
                $game->__set('createDate', $gameJsonObj->createDate);

                array_push($games, $game);
                */


                //$summoner->__set('games', $games);
            }

        }
    }

}