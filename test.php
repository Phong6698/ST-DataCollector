<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="refresh" content="<?php echo $sec?>;URL='<?php echo $page?>'">
	<script src="script/JavaScript.js"></script>
	<title>Summoner Tracker - Data Collector</title>
</head>
<body>
<div class="header">
	<h1>Summoner Tracker - Data Collector</h1>

</div>
<hr />
<div class="content">
	<div class="countdown">
	</div>

	<div class="summoners">
		<?php
		
		$waiting = 1.2;
		$microseconds = 1000000;
		
		$summoners = 10;
		$iterator = 1;
		$time_pre1 = microtime(true);
		while($iterator <= $summoners){
			
			$i = 0;
			$time_pre2 = microtime(true);
			while($i<=10000000){
				$i = $i + 1;
			}
			$time_post2 = microtime(true);
			$exec_time2 = $time_post2 - $time_pre2;
			
			echo "<br>task ".$exec_time2;
			$sleep = $waiting - $exec_time2;
			echo "<br>sleep ".$sleep . "<br>";
			if($sleep > 0){
				usleep($sleep * $microseconds);
			}
			
			$iterator = $iterator + 1;
		}
		$time_post1 = microtime(true);
		$exec_time1 = $time_post1 - $time_pre1;
		echo "<br>time ". $exec_time1;
		
		?>
	</div>
	<br>
</div>

</body>
</html>

