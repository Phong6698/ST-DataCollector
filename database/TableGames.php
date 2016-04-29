<?php
require_once 'Database.php';

class TableGames extends Database{

    public function getNewestCreateDate($summoner_ID){
        $this->openCon();
		$sql = "SELECT createDate FROM `games` WHERE Summoner_ID = $summoner_ID ORDER BY createDate DESC;";		
        $result = $this->getConnection()->query($sql);

        if($this->checkResult($result)) {
            if ($result->num_rows > 0) {
                // output data of each row
                while ($row = $result->fetch_assoc()) {
					return $row['createDate'];
					break;
                }
            } else {
                echo "0 results";
            }
        }
        $this->closeCon();     

    }
	
	public function saveGames(){
	
	}

}