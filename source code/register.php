<?php
include("check01.php");
include("db_connect.php");
include("all_function.php");

$u_id = $_SESSION['u_id'];
$u_nickname = $_POST['nickname'];
$u_sex = $_POST['sex'];
$u_major = $_POST['major'];
$u_degree = $_POST['degree'];
$u_campus = $_POST['campus'];
$u_grade = $_POST['grade'];
$u_selfintro = $_POST['selfintro'];
$up_realname = $_POST['realname'];
$up_hometown =$_POST['hometown'];
$up_birthyear = $_POST['Date_Year'];
$up_birthmonth = $_POST['birthday_m'];
$up_birthday = $_POST['birthday_d'];
$up_phone = $_POST['phone'];
$u_private = $_POST['private'];
$rp_br = $_POST['bedroom'];
$rp_ba = $_POST['bathroom'];
$rn_array = $_POST['roommates'];
$rn_1 = $rn_array[0]?$rn_array[0]:0;
$rn_2 = $rn_array[1]?$rn_array[1]:0;
$rn_3 = $rn_array[2]?$rn_array[2]:0;
$rn_4 = $rn_array[3]?$rn_array[3]:0;
$ub_clean = $_POST['clean'];
$ub_smoking = $_POST['smoking'];
$ub_cooking = $_POST['cooking'];
$ub_party = $_POST['party'];
$ub_bestow = $_POST['bestow'];
$ub_wake = $_POST['wake'];
$ub_sleep = $_POST['sleep'];
$ub_noise = $_POST['noise'];
$ubp_array = $_POST['pet'];
$ubp_dog = $ubp_array[0]?$ubp_array[0]:0;
$ubp_cat = $ubp_array[1]?$ubp_array[1]:0;
$ubp_others = $ubp_array[2]?$ubp_array[2]:0;
$ubp_any = $ubp_array[3]?$ubp_array[3]:0;
$uh_sport = $_POST['sport'];
$uh_music = $_POST['music'];
$uh_art = $_POST['art'];
$uh_others = $_POST['others'];

$new_query01 = mysql_query("select * from user where u_id='$u_id'")
or die("Invalid query:".mysql_error);
if($row_query01 = mysql_fetch_array($new_query01))
{
	$new_update01 = "UPDATE user SET u_nickname = '$u_nickname', u_sex = '$u_sex', " .
			"u_major = '$u_major', u_degree = '$u_degree', u_campus = '$u_campus', " .
			"u_grade = '$u_grade', u_selfintro = '$u_selfintro', u_private = '$u_private', " .
			"u_authority = '1' WHERE u_id = '$u_id'";
	mysql_query($new_update01)or die("Invalid query:".mysql_error());
}

	$new_query02 = "SELECT * from user_privateinfo WHERE u_id = '$u_id'";
	$rst_query02 = mysql_query($new_query02)or die("Invalid query:".mysql_error());
	if(mysql_num_rows($rst_query02) > 0)
	{

		$new_update02 = "UPDATE user_privateinfo SET up_realname = '$up_realname', " .
				"up_hometown = '$up_hometown', up_birthyear = '$up_birthyear', " .
				"up_birthmonth = '$up_birthmonth', up_birthday = '$up_birthday', " .
				"up_phone = '$up_phone' WHERE u_id = '$u_id'";
	mysql_query($new_update02)or die("Invalid query:".mysql_error());
	}
	else
	{
	$new_insert02 = "INSERT INTO user_privateinfo(u_id, up_realname, " .
			"up_hometown, up_birthyear, up_birthmonth, up_birthday, up_phone) " .
			"value('$u_id', '$up_realname', '$up_hometown', '$up_birthyear', " .
			"'$up_birthmonth', '$up_birthday', '$up_phone')";
	mysql_query($new_insert02)or die("Invalid query:".mysql_error());
	}

	$new_search01 = "SELECT * FROM room_pattern WHERE rp_br = '$rp_br' " .
			"AND rp_ba = '$rp_ba'";
	$rst_search01 = mysql_query($new_search01)or die("Invalid query:".mysql_error());
	if($row_search01 = mysql_fetch_array($rst_search01))
	{
		$u_roompattern = $row_search01['rp_id'];
		mysql_query("UPDATE user SET u_roompattern='$u_roompattern' WHERE u_id = '$u_id'")
		or die("Invalid query:".mysql_error);
	}
	else
	{
		$new_insert03 = "insert into room_pattern(rp_br, rp_ba) " .
				"value('$rp_br', '$rp_ba')";
		mysql_query($new_insert03)or die("Invalid query:".mysql_error());
		$rst_search02 = mysql_query($new_search01)or die("Invalid query:".mysql_error());
		if($row_search02 = mysql_fetch_array($rst_search02))
		{
			$u_roompattern = $row_search02['rp_id'];
			mysql_query("UPDATE user SET u_roompattern='$u_roompattern' WHERE u_id = '$u_id'")
		or die("Invalid query: 14".mysql_error);
		}
	}

	$rn_query = "SELECT * FROM roommates_number WHERE rn_1 = '$rn_1' " .
			"AND rn_2 = '$rn_2' AND rn_3 = '$rn_3' AND rn_4 = '$rn_4'";
	$rn_rst_query = mysql_query($rn_query)or die("Invalid query: 13".mysql_error());
	if($rn_row_query = mysql_fetch_array($rn_rst_query))
	{
		$u_roommates = $rn_row_query['rn_id'];
		mysql_query("UPDATE user SET u_roommates='$u_roommates' WHERE u_id = '$u_id'")
		or die("Invalid query: 12".mysql_error);
	}
	else
	{
		$rn_insert = "insert into roommates_number(rn_1, rn_2, rn_3, rn_4) " .
				"value('$rn_1', '$rn_2', '$rn_3', '$rn_4')";
		mysql_query($rn_insert)or die("Invalid query: 11".mysql_error());
		$rn_rst_insert = mysql_query($new_search01)or die("Invalid query: 10".mysql_error());
		if($rn_row_insert = mysql_fetch_array($rn_rst_insert))
		{
			$u_roommates = $rn_row_insert['rn_id'];
			mysql_query("UPDATE user SET u_roommates='$u_roommates' WHERE u_id = '$u_id'")
		or die("Invalid query: 9".mysql_error());
		}
	}

$ub_query = "SELECT * FROM user_habit WHERE u_id = '$u_id'";
$rst_ub_query = mysql_query($ub_query)or die("Invalid query: 8".mysql_error());
if($row_ub_query = mysql_fetch_array($rst_ub_query))
{
	$ub_update = "UPDATE user_habit SET ub_clean = '$ub_clean', ub_smoking = '$ub_smoking', " .
			"ub_cooking = '$ub_cooking', ub_party = '$ub_party', ub_bestow = '$ub_bestow', " .
			"ub_wake = '$ub_wake', ub_sleep = '$ub_sleep', ub_noise = '$ub_noise'";
	mysql_query($ub_update)or die("Invalid query: 7".mysql_error());
}
else
{
	$ub_insert = "INSERT INTO user_habit(u_id, ub_clean, ub_smoking, ub_cooking, ub_party, " .
			"ub_bestow, ub_wake, ub_sleep, ub_noise) VALUE('$u_id', '$ub_clean', " .
			"'$ub_smoking', '$ub_cooking', '$ub_party', '$ub_bestow', '$ub_wake', " .
			"'$ub_sleep', '$ub_noise')";
			mysql_query($ub_insert)or die("Invalid query: 6".mysql_error());
}


	$ubp_query = "SELECT * FROM user_habit_pet WHERE u_id = '$u_id'";
	$ubp_rst_query = mysql_query($ubp_query)or die("Invalid query: 5".mysql_error());
	if($ubp_row_query = mysql_fetch_array($ubp_rst_query))
	{
		mysql_query("UPDATE user_habit_pet SET ubp_dog = '$ubp_dog', ubp_cat = '$ubp_cat', " .
				"ubp_others = '$ubp_others', ubp_any = '$ubp_any' WHERE u_id = '$u_id'")
		or die("Invalid query: 4".mysql_error());
	}
	else
	{
		$ubp_insert = "insert into user_habit_pet(u_id, ubp_dog, ubp_cat, ubp_others, ubp_any) " .
				"value('$u_id', '$ubp_dog', '$ubp_cat', '$ubp_others', '$ubp_any')";
		$ubp_rst_insert = mysql_query($ubp_insert)or die("Invalid query: 3".mysql_error());

	}

	$uh_query = "SELECT * FROM user_hobby WHERE u_id = '$u_id'";
	$uh_rst_query = mysql_query($uh_query)or die("Invalid query:".mysql_error());
	if($uh_row_query = mysql_fetch_array($uh_rst_query))
	{
		mysql_query("UPDATE user_hobby SET uh_sport = '$uh_sport', uh_music = '$uh_music', " .
				"uh_art = '$uh_art', uh_others = '$uh_others' WHERE u_id = '$u_id'")
		or die("Invalid query: 2".mysql_error());
	}
	else
	{
		$uh_insert = "insert into user_hobby(u_id, uh_sport, uh_music, uh_art, uh_others) " .
				"value('$u_id', '$uh_sport', '$uh_music', '$uh_art', '$uh_others')";
		$uh_rst_insert = mysql_query($uh_insert)or die("Invalid query: 1".mysql_error());

	}
echo "<script> " .
					"alert('资料更新成功'); window.location.href='detail_info.php';" .
					"</script>";



?>
