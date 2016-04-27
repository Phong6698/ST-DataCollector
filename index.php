<?php
	require_once 'model/Summoner.php';
	require_once 'model/Game.php';
	require_once 'controller/DatabaseController.php';

	$page = $_SERVER['PHP_SELF'];
	$sec = "1500";
	$api_key = "58453580-a12b-497a-bdde-d1255bd0fda3";
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
				$summoners = DatabaseController::getInstance()->getAllSummoners();
				
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
						echo $gameJsonObj->subType."<br>";
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

