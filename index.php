<?php
	$page = $_SERVER['PHP_SELF'];
	$sec = "1500";
	$summonerId = "";
	$api_key = "58453580-a12b-497a-bdde-d1255bd0fda3";
	$servername = "localhost:3307";
	$username = "root";
	$password = "";
	$dbname = "st-datacollector";
	$summoners = array();
// 	1500 = 25 min
// 	summonerid = 67540676
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">	
	<meta http-equiv="refresh" content="<?php echo $sec?>;URL='<?php echo $page?>'">
	<script src="JavaScript.js"></script>
	<title>Summoner Tracker - Data Collector</title>
</head>
<body>
	<div class="header">
		<h1>Summoner Tracker - Data Collector</h1>
		
	</div>
	<hr />
	<div class="content">
		<?php
			echo 'Last update: '. date("H:i:s d.m.Y") ."\n";			
		?>
		<div class="countdown">
			<p>Next update in: <span id="countdown"></span></p>
		</div>

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
						$summoner->__set('summonerId', $row['SummonerId']);				
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
					
					//$games = array();
						
					foreach($resultJSON_decoded->games as $gameJsonObj){
						//SELECT createDate FROM `games` WHERE Summoner_ID = 1 ORDER BY createDate DESC;
						//TODO createDate(API) > createDate(DB) save in DB
						//TODO createDate(API) <= createDate(DB) don't save in DB
						//if($gameJsonObj->createDate ==
						
						
						/*
						$game = new Game();
						$game->__set('gameId', $gameJsonObj->gameId);
						$game->__set('gameMode', $gameJsonObj->gameMode);
						$game->__set('gameType', $gameJsonObj->gameType);
						$game->__set('subType', $gameJsonObj->subType);
						$game->__set('createDate', $gameJsonObj->createDate);
						
						array_push($games, $game);
						*/
						
					}					
					//$summoner->__set('games', $games);
				}
				
				
				
				
			?>
		</div>
		<br>
		
		<script type="text/javascript">
		  var timeSec = <?php echo $sec; ?>; 
		  var display = document.querySelector('#countdown');
		  startTimer(timeSec, display);
		</script>
	</div>
	
</body>
</html>

