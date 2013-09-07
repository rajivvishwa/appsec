<?php

// Error reporting:
error_reporting(E_ALL ^ E_NOTICE);

define("ABS_PATH", $_SERVER['DOCUMENT_ROOT']);
$title = "Popular Social Forum";
include (ABS_PATH . "/appsec/include/header.php");
require_once (ABS_PATH . "/appsec/include/connect.php");
include "comment.class.php";
/*
 /  Select all the comments and populate the $comments array with objects
 */

$comments = array();
$result = mysql_query("SELECT * FROM comments ORDER BY id ASC");

while ($row = mysql_fetch_assoc($result)) {
	$comments[] = new Comment($row);
}
?>

<script type="text/javascript">
	//<![CDATA[
	function toggle(o) {
		var e = document.getElementById(o);
		e.style.display = (e.style.display == 'none') ? 'block' : 'none';
	}

	//]]>
</script>

<div id="main">

	<?php

	/*
	 /  Output the comments one by one:
	 */

	foreach ($comments as $c) {
		echo $c -> markup();
	}
	?>

	<div id="addCommentContainer">
		<p>
			Add a Comment
		</p>
		<form id="addCommentForm" method="post" action="">
			<!--div-->
			<table width="80%" border="0" cellpadding="3" cellspacing="3" bgcolor="#FFFFFF">
				<tr>
					<td><label for="email">Your Email</label></td>
					<td>
					<input type="text" name="email" id="email" value="tester@test.com" size="55"/>
					</td>
				</tr>
				<tr>
					<td><label for="email">Your Name</label></td>
					<td>
					<input type="text" name="name" id="name" value="tester" size="55"/>
					</td>
				</tr>

				<tr>
					<td><label for="url">Website (not required)</label></td>
					<td>
					<input type="text" name="url" id="url" size="55"/>
					</td>
				</tr>

				<tr>
					<td><label for="body">Comment</label></td>
					<td>					<textarea name="body" id="body" cols="20" rows="5"></textarea></td>
				</tr>

				<tr>
					<td>
					<input type="submit" id="submit" value="Submit" />
					</td><td>
					<input type="button" id="flush" value="Reset" onClick="parent.location='reset.php'"/>
					</td>
				</tr>

			</table>

			<!--/div-->
		</form>
	</div>
	<div id="addCommentContainer" align=center>
		<a href="#" onclick="toggle('list');"><i>Show/Hide Scripts</i></a>
		<div id="list" style="display: none;">
			<ul>
				<table id="scriptsTbl" width="80%" border="0" cellpadding="3" cellspacing="3" bgcolor="#FFFFFF">

					<tr>
						<td colspan=2>
						<hr>
						</td>
					</tr>
					<tr>
						<td>XSS </td>
						<td><font size=2 color=red face=monospace><i>&lt;script&gt;alert(document.cookie)&lt;/script&gt;</i></font></td>
					</tr>
					<tr>
						<td colspan=2>
						<hr border=1>
						</td>
					</tr>
					<tr>
						<td> XSRF </td>
						<td><font size=2 color=red face=monospace><i>&lt;img height=0 width=0 src=../bank.com/fundtransfer.php?toacc=attacker&amp;fromacc=victim&amp;amt=3500&amp;submit=Submit&gt;</i></font></td>
					</tr>
					<tr>
						<td colspan=2>
						<hr>
						</td>
					</tr>
				</table>
			</ul>
		</div>
	</div>

</div>

<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.4.2/jquery.min.js"></script>
<script type="text/javascript" src="script.js"></script>

<?php
include (ABS_PATH . "/appsec/include/footer.php");
?>

