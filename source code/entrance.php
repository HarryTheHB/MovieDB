<?php
session_start();
include ("db_connect.php");
if(isset($_POST["register"]))
{
	$u_email = $_POST["mail1"];
	$u_nickname = $_POST["nickname"];
	$u_passwd = $_POST["passwd1"];

	$query = mysql_query("select * from user where Email = '$u_email'")
	or die("Invalid query:".mysql_error());
	if($row = mysql_fetch_array($query))
	{
		echo "<script> alert('This Email has already been taken');
		window.location.href = 'intro.html';</script>";
	}
	else
	{
		$new_insert = "insert into user(Email, Password, Nickname) " .
				"values('$u_email', '$u_passwd', '$u_nickname')";
		$rst = mysql_query($new_insert)or die("Invalid query: ".mysql_error());;
		if($rst)
		{
			echo "<script> " .
					"alert('register suscessfully'); window.location.href='module_opt.php';" .
					"</script>";
		}
	}
	$u_query = "SELECT * FROM user WHERE Email = '$u_email'";
			$u_rst_query = mysql_query($u_query)or die("Invalid query: ".mysql_error());
			$u_row_query = mysql_fetch_array($u_rst_query);
			$_SESSION['UID'] = $u_row_query['UID'];

}
else if(isset($_POST["login"]))
{
	$u_email = $_POST["mail2"];
	$u_passwd = $_POST["passwd2"];
	$query = mysql_query("select * from user where Email = '$u_email'")
	or die("Invalid query:".mysql_error());

	if($row = mysql_fetch_array($query))
	{

		if($u_passwd != $row['Password'])
		{

			echo "<script> alerr('wrong password');
		window.location.href = 'intro.html';</script>";
		}
		else
		{
			echo "<script> alert('login successfully');
		window.location.href = 'module_opt.php';</script>";
		}
	}

	else
	{

		echo "<script> alert('user not existed');
		window.location.href = 'intro.html';</script>";
	}
	$_SESSION['UID'] = $row['UID'];
}


?>
