<?php
	$page = $_SERVER['PHP_SELF'];
	$sec = "1500";
	$summonerId = "";
	$api_key = "58453580-a12b-497a-bdde-d1255bd0fda3";
// 	1500 = 25 min
// 	summonerid = 67540676
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">	
	<meta http-equiv="refresh" content="<?php echo $sec?>;URL='<?php echo $page?>'">
	<title>Summoner Tracker - Data Collector</title>
</head>
<body>
	<div class="header">
		<h1>Summoner Tracker - Data Collector</h1>
		
	</div>
	<hr />
	<div class="content">
		<?php 
		
			$servername = "localhost:3307";
			$username = "root";
			$password = "";
			$dbname = "st-datacollector";
			
			$conn = new mysqli($servername, $username, $password, $dbname);
			// Check connection
			if ($conn->connect_error) {
			    die("Connection failed: " . $conn->connect_error);
			}
			echo "Connected successfully";
			
			$sql = "SELECT * FROM summoner";
			$result = $conn->query($sql);
			
			if ($result->num_rows > 0) {
				// output data of each row
				//TODO Fatal error: Call to a member function fetch_assoc() on string 
				//Created an ask on stackoverflow
				while($row = $result->fetch_assoc()) {
					echo "<h1>" . $row["SummonerId"]. "</h1>";		
					$summonerId = $row["SummonerId"];
					$url = "https://euw.api.pvp.net/api/lol/euw/v1.3/game/by-summoner/" . $summonerId . "/recent?api_key=" . $api_key;
						
					$result = file_get_contents($url);
					$resultJSON = json_decode($result);
						
						
					foreach($resultJSON->games as $game){
						echo $game->gameMode." ".$game->gameType." ".$game->subType;
						echo "<br>";
					}
				}
			} else {
				echo "0 results";
			}
			
			$mysqli->close();
			
		?>
	</div>
	
</body>
</html>

