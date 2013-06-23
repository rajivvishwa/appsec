<?php
header("X-XSS-Protection: 0");
?>
<!DOCTYPE HTML PUBLIC "-//W3C/DTD HTML 4.0 Transitional//EN">
<html>
<head><title> Execute XSS </title>
  <link rel="stylesheet" type="text/css" href="styles.css" />
</head>
<body>
  <div id="main">
    <h1>Summary</h1>
    <div id="divContainer" align="center">
      <BR>
      <?php
        //setcookie( name, value, expire, path, domain, secure, httponly);
        $httponlyflag = false;
        $secureflag = false;
        $sopflag = false;
    
        if(isset($_POST['httponly'])) {
          $httponlyflag = true; 
        }
        if(isset($_POST['secure'])) {
          $secureflag = true;
        }
        if(isset($_POST['csp'])) {
          header("X-Content-Security-Policy: script-src 'unsafe-inline'");
          header("Content-Security-Policy: script-src 'unsafe-inline'");
        }
        
        if(isset($_POST['xssP'])) {
          header("X-XSS-Protection: 1");
        }
        
    
        setcookie("SecretCookie", "myPassword");
        setcookie("SecretCookie2", "myPassword2", 0, '/', '', $secureflag, $httponlyflag);
    
        echo "<br><table width='70%' border='0' cellpadding='3' cellspacing='3'>";
        echo "<tr><td>Request Method</td><td width='20'>:</td><td><b>" . $_SERVER['REQUEST_METHOD'] . "</b></td></tr>";
        if ($_SERVER['REQUEST_METHOD']=='POST'){
          $userid = $_POST['userid'];
          $role = $_POST['role'];
        } else {
          $userid = $_GET['userid'];
        $role = $_GET['role']; 
          //echo "<tr><td>QueryString: </td><td>" . $_SERVER['QUERY_STRING'] . "</td></tr>";
        }
        $role = preg_replace('/[^-a-zA-Z0-9_]/', '', $role);
        echo "<tr><td><b><i>UserId</i></b></td><td>:</td><td>" . $userid . "</td></tr>";
        echo "<tr><td><b><i>Role</i></b></td><td>:</td><td>" . $role . "</td></tr>";
        echo "<tr><td>HTTP Only</td><td>:</td><td>";
        echo $httponlyflag? 'true' : 'false';
        echo "</td></tr>";
        echo "<tr><td>Secure</td><td>:</td><td>";
        echo $secureflag? 'true' : 'false';
        echo "</td></tr>";
        echo "<tr><td>UserId Entered (fixed)</td><td>:</td><td>" . htmlspecialchars($userid) . "</td></tr></table><br>";
      ?>
      <BR>
      <input type="button" class="button" value="Back" onClick="parent.location='../xss'"/>

      <BR><BR>
    </div>
  </div>
</body>
</html>