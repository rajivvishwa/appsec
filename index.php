<?php
define("ABS_PATH", $_SERVER['DOCUMENT_ROOT']);
$title = "Vulnerable Bank - Login";
include (ABS_PATH . "/appsec/include/header.php");
?>
<div id="main">
	<div id="divContainer" align="center">
		<p>
			XSS
		</p>
		<a href="xss/">Demo</a>
	</div>
	<div id="divContainer" align="center">
		<p>
			XSRF
		</p>
		<a href="xsrf/bank.com">bank.com</a>
		<BR>
		<a href="xsrf/client.com">client.com</a>
	</div>
	<div id="divContainer" align="center">
		<p>
			WebSQLi
		</p>
		<a href="html5/websql/">Demo</a>
		<BR>
	</div>
	<div id="divContainer" align="center">
		<p>
			CORS
		</p>
		<a href="html5/cors-client/">Demo</a>
	</div>

	<div id="divContainer" align="center">
		<p>
			iFrame Sandboxing
		</p>
		<a href="html5/iframe/">Demo (<a href="/html5/iframe/index.php?sandbox">sandbox</a>)
		<BR>
	</div>
</div>
<?php
	include (ABS_PATH . "/appsec/include/footer.php");
?>