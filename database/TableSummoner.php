<?php
require_once 'Database.php';

class TableSummoner extends Database{

    public function getAllSummoners(){
        $this->openCon();
        $sql = "SELECT * FROM summoner";
        $result = $this->getConnection()->query($sql);

        $summoners = array();

        if($this->checkResult($result)) {
            if ($result->num_rows > 0) {
                // output data of each row
                while ($row = $result->fetch_assoc()) {
                    $summoner = new Summoner();
                    $summoner->__set('id', $row['ID_Summoner']);
                    $summoner->__set('summonerId', $row['summonerId']);
                    array_push($summoners, $summoner);
                }
            } else {
                echo "0 results";
            }
        }
        $this->closeCon();

        return $summoners;

    }

}