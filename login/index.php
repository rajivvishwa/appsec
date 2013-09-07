

<?php
 	define("ABS_PATH", $_SERVER['DOCUMENT_ROOT']);
	$title = "Login";
	include (ABS_PATH . "/appsec/include/header.php");
	require_once (ABS_PATH . "/appsec/include/connect.php");
	   session_start();

    if ($_GET["op"] == "login") {
      if (!$_POST["userid"] || !$_POST["password"]) {
        die("You need to provide a username and password.");
      }

      $q = "SELECT * FROM `users` "
        ."WHERE `username`='".$_POST["userid"]."' "
        ."AND `password`=('".md5($_POST["password"])."')"
        ."LIMIT 1";
      
      $r = mysql_query($q);
	  
      if ( $obj = @mysql_fetch_object($r) ) {
        // Login good, create session variables
        $_SESSION["valid_id"] = $obj->id;
        $_SESSION["valid_user"] = $_POST["userid"];
        $_SESSION["valid_time"] = time();
  
        
        echo $_SESSION["valid_id"];
        // Redirect to member page
        //Header("Location: members.php");
      }
      else {
      die("Sorry, could not log you in. Wrong login information.");
      }
    }
    else {
?>

  <div id="main">
    <div id="divContainer" align="center">
      <p>Login Form</p>
      <FORM METHOD=POST ACTION="?op=login">
        <table width="70%" border="0" cellpadding="3" cellspacing="1" bgcolor="#FFFFFF">
          <tr>
            <td width="78">User Id</td>
            <td width="6">:</td>
            <td width="294"><input name="userid" type="text" id="userid" value="victim" size=30></td>
          </tr>
          <tr>
            <td>Password</td>
            <td>:</td>
            <td><input name="password" type="password" id="password" value="tester" size=30></td>
          </tr>
          <tr>
            <td>Token</td>
            <td>:</td>
            <td><input name="tokenflag" type="checkbox" id="tokenflag"></td>
          </tr>
          <tr>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td><input type="submit" class="button" name="Submit" value="Login"></td>
          </tr>
        </table>
      </form>  
    </div>
  </div>
<?php
    }
?>
  </body>
</html>