<?php
	require_once 'model/Summoner.php';
	require_once 'model/Game.php';

	$summonerId = "";
	$api_key = file_get_contents( __DIR__ .'/json/League of Legends API');
	$servername = "localhost:3307";
	$username = "root";
	$password = "";
	$dbname = "summoner-tracker";
	
	$summoners = array();
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">	
	<title>Summoner Tracker - Data Collector</title>
</head>
<body>
	<div class="header">
		<h1>Summoner Tracker - Data Collector</h1>
		
	</div>
	<hr />
	<div class="content">	
		<div class="summoners">
			<?php 
				
				
				
				/*
				 *Get all Summoner from DB
				 */
				$conn = new mysqli($servername, $username, $password, $dbname);
				// Check connection
				if ($conn->connect_error) {
					die("Connection failed: " . $conn->connect_error);
				}
				echo "Connected successfully"."<br>";
				
				$sql = "SELECT * FROM summoner";
				$result = $conn->query($sql);
				if (!$result) {
					throw new Exception("Database Error [{$this->database->errno}] {$this->database->error}");
				}
				if ($result->num_rows > 0) {
					// output data of each row
					while($row = $result->fetch_assoc()) {
						$summoner = new Summoner();
						$summoner->__set('id', $row['ID_Summoner']);
						$summoner->__set('summonerId', $row['summonerId']);
						array_push($summoners, $summoner);							
					}
				} else {
					echo "0 results";
				}
				$conn->close();
				
				
				/*
				 *Get games infos from API
				 */
				foreach($summoners as $summoner){
					$urlapi = "https://euw.api.pvp.net/api/lol/euw/v1.3/game/by-summoner/" . $summoner->__get('summonerId') . "/recent?api_key=" . $api_key;
					$urllocal = "http://localhost:8080/ST-DataCollector/LocalJSON.json";	
					$resultJSON = file_get_contents($urlapi);
					$resultJSON_decoded = json_decode($resultJSON);
					
					$games = array();
						
					foreach($resultJSON_decoded->games as $gameJsonObj){
						$game = new Game();
						$game->__set('gameId', $gameJsonObj->gameId);
						$game->__set('gameMode', $gameJsonObj->gameMode);
						$game->__set('gameType', $gameJsonObj->gameType);
						$game->__set('subType', $gameJsonObj->subType);
						$game->__set('createDate', $gameJsonObj->createDate);
						
						array_push($games, $game);
						
					}					
					$summoner->__set('games', $games);
				}
				
			
				/*
				 *Save games infos in DB
				 */
				$conn = new mysqli($servername, $username, $password, $dbname);
				$stmt = $conn->prepare("INSERT INTO game (gameId, gameMode, gameType, subType, createDate, Summoner_ID) VALUES (?, ?, ?, ?, ?, ?);");
				$stmt->bind_param("isssii", $gameId, $gameMode, $gameType, $subType, $createDate, $Summoner_ID);

				foreach($summoners as $summoner){
					$summoner_ID = $summoner->__get('id');
					echo $summoner_ID;
					echo "<br";
					foreach($summoner->__get('games') as $game){
						$gameId = $game->__get('gameId');
						echo $gameId;
						echo "<br";
						$gameMode = $game->__get('gameMode');
						echo $gameMode;
						echo "<br";
						$gameType = $game->__get('gameType');
						echo $gameType;
						echo "<br";
						$subType = $game->__get('subType');
						echo $subType;
						echo "<br";
						$createDate = $game->__get('createDate');
						echo $createDate;
						echo "<br";

						$stmt->execute();
					}
				}
				$conn->close();
				

				/* 
				foreach($summoners as $summoner){
					echo $summoner->__get('id') . "<br>";
					echo $summoner->__get('summonerId') . "<br>";
					foreach($summoner->__get('games') as $game){
						echo $game->__get('gameId'). "<br>";
						echo $game->__get('gameMode'). "<br>";
						echo $game->__get('gameType'). "<br>";
						echo $game->__get('subType'). "<br>";
						echo $game->__get('createDate'). "<br><br>";
					}
				}
				*/
				
				
				
			?>
		</div>
	</div>
	
</body>
</html>

