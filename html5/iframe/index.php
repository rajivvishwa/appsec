<!DOCTYPE HTML>
<html>
    <head></head>
	<body>
		<div name="query" id="query" style="font-family:monospace;color:red">
			<?php

			if (isset($_GET['sandbox'])) {
				$sandboxVal = "sandbox";
				echo "Sandbox Enabled";
			} elseif (isset($_GET['scripts'])) {
				echo "Allow Scripts";
				$sandboxVal = "sandbox=\"allow-scripts\"";
			} else {
				$sandboxVal = "";
			}
		?>
		</div>
		<h3>Load iframe from Remote</h3>
		<iframe <?php echo $sandboxVal ?> src="http://rajivvishwa.kd.io/appsec/html5/iframe/frame.php"></iframe>
		<br />
		<h4>Random Data</h4>
	</body>
</html>