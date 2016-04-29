<?php
include_once 'script/DataChecker.php';

$page = $_SERVER['PHP_SELF'];
$sec = "1500";
// 	1500 = 25 min
// 	summonerid = 67540676
?>
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
		$dataChecker = new DataChecker();
		$dataChecker->checkData();

		/*
         *Get games infos from API
         */
		




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

