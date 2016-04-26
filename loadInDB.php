<?php
	include_once '/model/Summoner.php';

	$summonerId = "";
	$api_key = "58453580-a12b-497a-bdde-d1255bd0fda3";
	$servername = "localhost:3307";
	$username = "root";
	$password = "";
	$dbname = "st-datacollector";
	
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
				var_dump($summoners);
				
			?>
		</div>
	</div>
	
</body>
</html>

