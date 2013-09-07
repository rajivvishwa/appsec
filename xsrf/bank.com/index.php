<?php
    ob_start();
    session_start();
	define("ABS_PATH", $_SERVER['DOCUMENT_ROOT']);
	$title = "Vulnerable Bank - Login";
	include (ABS_PATH . "/appsec/include/header.php");
	require_once (ABS_PATH . "/appsec/include/connect.php");

    //Login-Logout Operations


    if ($_GET["op"] == "login") {
      if (!$_POST["userid"] || !$_POST["password"]) {
        die("You need to provide a username and password.");
      }

	//$q = "SELECT * FROM `users`";
      $q = "SELECT * FROM `users` "
        ."WHERE `username`='".$_POST["userid"]."' "
        ."AND `password`=('".md5($_POST["password"])."')"
        ."LIMIT 1";
    
      $r = mysql_query($q) or die(mysql_error());
	  //echo mysql_num_rows($r);
	  //echo 'fetch object'.@mysql_fetch_object($r);
	  
      if ( $obj = @mysql_fetch_object($r) ) {
        // Login good, create session variables
        $_SESSION["valid_id"] = $obj->id;
        $_SESSION["valid_user"] = $_POST["userid"];
        $_SESSION["valid_time"] = time();
        $token = md5(uniqid(rand(), TRUE));
        $_SESSION['token'] = $token;
        Header("location: balance.php");
      }
      else {
      	die("Sorry, could not log you in. Wrong login information");
      }
    }
    elseif ($_GET["op"] == "logout"){
        session_start();
        session_destroy();
      Header("Location: ../bank.com/");
    }
    else {
    //Display Login Page
?>
<div id="main">

	<div id="divContainer" align="center">
		<p>
			Login Form
		</p>
		<FORM METHOD=POST ACTION="?op=login">
			<table width="60%" border="0" cellpadding="3" cellspacing="1" bgcolor="#FFFFFF">
				<tr>
					<td width="78">User Id</td>
					<td width="6">:</td>
					<td width="294">
					<input name="userid" type="text" id="userid" value="victim" size=30>
					</td>
				</tr>
				<tr>
					<td>Password</td>
					<td>:</td>
					<td>
					<input name="password" type="password" id="password" value="tester" size=30>
					</td>
				</tr>
				<tr>
					<td>&nbsp;</td>
					<td>&nbsp;</td>
					<td>
					<input type="submit" class="button" name="Submit" value="Login">
					</td>
				</tr>
			</table>
		</form>
	</div>
</div>
<?php
}
?>
<?php
include (ABS_PATH . "/appsec/include/footer.php");
?>