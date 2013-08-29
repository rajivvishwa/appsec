<?php

// Error reporting:
error_reporting(E_ALL^E_NOTICE);

include "../../connect.php";
include "comment.class.php";


/*
/  Select all the comments and populate the $comments array with objects
*/

$comments = array();
$result = mysql_query("SELECT * FROM comments ORDER BY id ASC");

while($row = mysql_fetch_assoc($result))
{
  $comments[] = new Comment($row);
}

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Popular Social Forum</title>

<link rel="stylesheet" type="text/css" href="../styles.css" />

</head>

<body>

<script type="text/javascript">
//<![CDATA[
function toggle(o)
{
var e = document.getElementById(o);
e.style.display = (e.style.display == 'none') ? 'block' : 'none';
}
//]]>
</script>

<h1>Popular Social Forum</h1>

<div id="main">

<?php

/*
/  Output the comments one by one:
*/

foreach($comments as $c){
  echo $c->markup();
}

?>

  <div id="addCommentContainer">
    <p>Add a Comment</p>
    <form id="addCommentForm" method="post" action="">
      <div>
        <label for="name">User Name</label>
        <input type="text" name="name" id="name" value="tester"/>
        
        <label for="email">Your Email</label>
        <input type="text" name="email" id="email" value="tester@test.com" />
        
        <label for="url">Website (not required)</label>
        <input type="text" name="url" id="url" />
        
        <label for="body">Comment</label>
        <textarea name="body" id="body" cols="20" rows="5"></textarea>
        
        <input type="submit" id="submit" value="Submit" />
        <input type="button" id="flush" value="Reset" onClick="parent.location='reset.php'"/>

      </div>
    </form>
  </div>
  <div id="addCommentContainer" align=center>
    <a href="#" onclick="toggle('list');"><i>Show/Hide Scripts</i></a>
    <div id="list" style="display: none;">
      <ul>
        <table align=center>

          <tr> 
            <td colspan=2><hr></td>
          </tr>
          <tr> 
            <td>XSS </th>
            <td><font size=2 color=red face=monospace><i>&lt;script&gt;alert(document.cookie)&lt;/script&gt;</i></font></th>
          </tr>
          <tr> 
            <td colspan=2><hr border=1></td>
          </tr>
          <tr> 
            <td>XSRF </th>
            <td><font size=2 color=red face=monospace><i>&lt;img height=0 width=0 src=../bank.com/fundtransfer.php?toacc=attacker&amp;fromacc=victim&amp;amt=3500&amp;submit=Submit&gt;</i></font></th>
          </tr>
          <tr> 
            <td colspan=2><hr></td>
          </tr>
        </table>
      </ul>
    </div>
  </div>
  
</div>

<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.4.2/jquery.min.js"></script>
<script type="text/javascript" src="script.js"></script>

</body>
</html>
