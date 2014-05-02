<?php
header("content-Type: text/html; charset=gb2312");
$con = @mysql_connect("localhost","root","");
if (!$con)
  {
  die('Could not connect: ' . mysql_error());
  }
$flag=mysql_select_db("moviedb", $con);
if (!$flag)
  {
  die('Could not select: ' . mysql_error());
  }
?>
