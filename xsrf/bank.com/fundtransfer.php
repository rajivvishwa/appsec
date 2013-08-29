<?php
    session_cache_expire( 20 );
    session_start();
    $inactive = 1200;
    if(isset($_SESSION['start']) ) {
      $session_life = time() - $_SESSION['start'];
    if($session_life > $inactive){
        Header("Location: index.php");
      }
    }
    $_SESSION['start'] = time();
 
    if (!$_SESSION["valid_user"]){
        // User not logged in, redirect to login page
        Header("Location: index.php");
    }
?>

<html>
  <head>
    <title>
      Fundtransfer
    </title>
    <link rel="stylesheet" type="text/css" href="../../styles.css" />
  </head>
  <body>
    <script type="text/javascript">
    //<![CDATA[
        function toggle(o){
            var e = document.getElementById(o);
            e.style.display = (e.style.display == 'none') ? 'block' : 'none';
        }
    //]]>
    </script>
  <h1>Vulnerable Bank</h1>
    <div class="logout" align="center">Welcome <b><i><?php echo $_SESSION["valid_user"]; ?></i></b>&nbsp;&nbsp;(<a href=../bank.com/?op=logout><em><font size=2>Logout</font></em></a>)</div><br/>
    <div id="main">

       <div id="divContainer" align="center">
      <?php
        include '../../connect.php';
        
        echo "<p><b> Old Details </b></p>";
        function getBal()
        {
        $query  = "SELECT victim, attacker FROM account";
        
        $result = mysql_query($query);
        $num=mysql_numrows($result);

        $i=0;
        while($i < $num)
        {
          $victimbal = mysql_result($result,$i,"victim");
          $attackerbal = mysql_result($result,$i,"attacker");
          $i++;
        }
        
        echo "<table width='80%' border='0' cellpadding='3' cellspacing='1'>";
          echo "<tr>";
            echo "<td>Victim Balance</td>";
            echo "<td>:</td>";
          echo "<td><b>".$victimbal."</b></td>";
          echo "</tr>";    
          echo "<tr>";
            echo "<td><font color=#FBAA85><i>Attacker Balance</i></font></td>";
            echo "<td>:</td>";
          echo "<td><font color=#FBAA85><b>".$attackerbal."</b></font></td>";
          echo "</tr>";
          echo "<tr><td colspan=3>&nbsp;</td></tr>";
        echo "</table>";
        }
        
        getBal();

        $from= "victim";
        $to= "attacker";
        $amount = 0;
        $date = date('r',time());
        $serverToken = md5($_SESSION['valid_user'].$_SESSION['valid_time']);
        $serverToken2 = $_SESSION['token'];
        
        if (isset($_POST['amt']) && isset($_POST['toacc'])) {
          $amount = $_POST['amt'];
          $to   = $_POST['toacc'];
          $from = $_POST['fromacc'];
          $clientToken = $_POST['token'];
          $clientToken2 = $_POST['token2'];
          $tokenflag = $_POST['tokenflag'];
        } elseif (isset($_GET['amt']) && isset($_GET['toacc'])) {
          $amount   = $_GET['amt'];
          $to = $_GET['toacc'];
          $from = $_GET['fromacc'];
          $clientToken = $_GET['token'];
          $clientToken2 = $_GET['token2'];
          $tokenflag = $_GET['tokenflag'];
        }
        echo "</div>";
        
        //Check if token validation is 'on'
        if($tokenflag == "on"){
            $tokenSuccess = ($clientToken == $serverToken?'true':'false');
            $tokenSuccess2 = ($clientToken2 == $serverToken2?'true':'false');
        } else {
            $tokenSuccess = "true";
            $tokenSuccess2 = "true";
            $tokenflag = "false";
        }
        
        echo "<div id='divContainer' align='center'>";
        
        echo "From : " .$from ."<br>";
        echo "To: " .$to ."<br>";
        echo "Amount: " .$amount ."<br>";
        
        echo "<br><hr><br>";

        if ($tokenSuccess=="true"){
            if($to == "attacker" || $to == "victim"){
                $transfer_query = "Update account set ".$_SESSION['valid_user']."=".$_SESSION['valid_user']."-'$amount'".", ".$to."=".$to."+'$amount'";
                mysql_query($transfer_query);
            }else {
                $transfer_query = "Update account set ".$_SESSION['valid_user']."=".$_SESSION['valid_user']."-'$amount'";
                mysql_query($transfer_query);
            }
        }else {
            $transfer_query = "Invalid Token";
        }
        echo "<font color=#40A2D4 face=monospace><b>Query</b>: " .$transfer_query. "</font><br>";
        echo "</div>";
        echo "<div id='divContainer' align='center'>";
        echo "<p><b> New Details </b></p>";
        getBal();
        mysql_close($conn);
?>

      <input type="button" class="button" value="Back" onClick="parent.location='balance.php'"/>
      <input type="button" class="reset" value="Reset" onClick="parent.location='reset.php'"/>
      </div>
      
      <div id='divContainer' align='center'>
        <a href="#" onclick="toggle('list');"><i>Show/Hide Trace</i></a>
        <div id="list" style="display: none;">
<?php

        echo "<br><hr><br><font face='monospace'>";
        echo "Token Check: " . $tokenflag ."<br>";
        echo "Token Age: " . (time() - $_SESSION['valid_time'])." secs | ".round(abs(time() - $_SESSION['valid_time'])/60,2)." mins <br>";
      
        echo "<br><hr><br>";
        
        echo "Client Token: " . $clientToken."<br>";
        echo "Server Token: " . $serverToken."<br>";
        echo "Token Match: " . $tokenSuccess ."<br>";
        
        echo "<br><hr><br>";
        
        echo "Client Token2: " . $clientToken2."<br>";
        echo "Server Token2: " . $serverToken2."<br>";
        echo "Token Match2: " . $tokenSuccess2 ."<br>";
        
        echo "<br></font>";
        echo "</div>";
        
?>
    </div>
  </body>
</html>