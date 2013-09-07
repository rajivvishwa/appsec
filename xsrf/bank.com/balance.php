<?php
    ob_start();
    define("ABS_PATH", $_SERVER['DOCUMENT_ROOT']);
	$title = "Vulnerable Bank";
	include (ABS_PATH . "/appsec/include/header.php");
	require_once (ABS_PATH . "/appsec/include/connect.php");
    
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


    <div class="logout" align="center">Welcome <b><i><?php echo $_SESSION["valid_user"]; ?></i></b>&nbsp;&nbsp;(<a href=../bank.com/?op=logout><em><font size=2>Logout</font></em></a>)</div><br/>
    <div id="main">
    <div id="divContainer" align="center">
      <br>

      <p><b> Account Details </b></p>
      <?php
       
        $query  = "SELECT victim, attacker FROM account";
       
        $result = mysql_query($query);
        while($row = mysql_fetch_assoc($result))
        {
          echo "<table width='70%' border='0' cellpadding='5' cellspacing='2'>";
            echo "<tr><td colspan=3>&nbsp;</td></tr>";
            echo "<tr>";
              echo "<td>Victim Balance</td>";
              echo "<td>:</td>";
              echo "<td><b>{$row['victim']}</b></td>";
            echo "</tr>";
            
            echo "<tr>";
              echo "<td><font color=#FBAA85><i>Attacker Balance</i></font></td>";
              echo "<td>:</td>";
              echo "<td><font color=#FBAA85><i><b>{$row['attacker']}</b></i></font></td>";
            echo "</tr>";

          echo "</table>";
        }
        mysql_close($conn);
      ?>
      <br>
      <input type="button" class="button" value="Refresh" onClick="window.location.reload()"/>
      <input type="button" class="reset" value="Reset" onClick="parent.location='reset.php'"/>
    </div>
      <div id="divContainer" align="center">
      <p>Transfer Funds</p>
        <FORM METHOD=POST ACTION="fundtransfer.php">

          <table width="70%" border="0" cellpadding="3" cellspacing="1" bgcolor="#FFFFFF">
          <tr>
            <td width="78">To</td>
            <td width="6">:</td>
            <td width="294"><input name="toacc" type="text" id="toacc" value="any user" size=30></td>
          </tr>
          <tr>
            <td>Amount</td>
            <td>:</td>
            <td><input name="amt" type="text" id="amt" value="0" size=30></td>
          </tr>
          <tr>
            <td>From</td>
            <td>:</td>
            <td><?php echo $_SESSION['valid_user'];?><input name="fromacc" type="hidden" id="fromacc" value="<?php echo $_SESSION['valid_user'];?>" readonly size=30></td>
          </tr>
          <tr>
            <td>&nbsp;</td>
            <td><input type="hidden" id="token2" name="token2" value="<?php echo $_SESSION['token']; ?>" size=30></td>
            <td><input type="hidden" id="token" name="token" value="<?php echo md5($_SESSION['valid_user'].$_SESSION['valid_time']); ?>" size=30></td>
          </tr>
          <tr>
             <td>Token</td>
             <td>:</td>
             <td><input name="tokenflag" type="checkbox" id="tokenflag"></td>
          </tr>
          <tr>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td align="right"><input type="submit" class="button" name="Submit" value="Transfer"></td>
          </tr>
          </table>
        </form>
      </div>
    </div>
<?php
include (ABS_PATH . "/appsec/include/footer.php");
?>