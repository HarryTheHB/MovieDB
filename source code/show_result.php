<?php
include("check01.php");
include("db_connect.php");
include("all_function.php");

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=gb2312" />
<title>show result</title>
<link href="css/style.css" rel="stylesheet" type="text/css" />
<link href="css/style_showall.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="js/action.js"></script>
</head>

<body class="normal">
	<div class="intro">
    	<div class="header">
        	<table>
            	<tbody>
                	<tr>
                    	<td>
                       	<p class="logo">Movie Database</p>
                        </td>
                        <td class="td_blank">
                        </td>
                        <td>
                        <a href="module_opt.php" class="btm_head">section choose</a>
                        </td>
                        <td>
                        <a href="qmovie.php" class="btm_head">search movie</a>
                        </td>
                        <td>
                        <a href="qartist.php" class="btm_head">search artist</a>
                        </td>
                        <td>
                        <a href="logout.php" class="btm_head">logout</a>
                        </td>
                	</tr>
                </tbody>
            </table>

    	</div>

    	<div class="main">
        	<div class="blank"></div>
        	<div class="infor_input">
        		<div class="overview">
                	<div class="info_main">
                    	<div class="index_title">
                            	<h3>Search Result
                                </h3>
                                <h4>

                                </h4>
                        </div>
<form action = 'show_detail.php' method = 'post''>
                        <?php
if(isset($_POST["qDetail"])||isset($_POST['qType'])||isset($_POST['qDirAward'])||isset($_POST['qArtist'])||isset($_POST['qCountry'])) {
	if(isset($_POST["qDetail"])) {
		$MovieName = $_POST["name"];
		$Country = $_POST["country"];
		$MinRating = $_POST["minrating"];
		$MaxRating = $_POST["maxrating"];
		$MinRelease = $_POST["minrelease"];
		$MaxRelease = $_POST["maxrelease"];
		//echo checkMovieName($MovieName).checkCountry($Country).checkMinRelease($MinRelease).checkMaxRelease($MaxRelease).checkMaxRating($MaxRating).checkMinRating($MinRating);
		$query = mysql_query("select * from Movie where ".checkMovieName($MovieName).checkCountry($Country).checkMinRelease($MinRelease).checkMaxRelease($MaxRelease).
		checkMaxRating($MaxRating).checkMinRating($MinRating)
		)
		or die("Invalid query:".mysql_error);
	}

	if(isset($_POST['qType'])){
		$sql = "select *
from Movie JOIN Has_genre ON Movie.movieID = Has_genre.movieID
where genre = '".$_POST['genre']."' and rating = (
select max(rating)
from Movie JOIN Has_genre ON Movie.movieID = Has_genre.movieID
where genre = '".$_POST['genre']."'
)";
	echo $_POST['genre'];
		$query = mysql_query($sql)or die("Invalid query:".mysql_error);
	}

	if(isset($_POST['qDirAward'])){
		$sql = "SELECT *
FROM Artist JOIN Work_on ON Artist.ArtistID = Work_on.ArtistID JOIN Movie ON 
Movie.movieID = Work_on.movieID JOIN Movie_win ON 
Work_on.movieID = Work_on.movieID JOIN Award ON Award.awardID = Movie_win.awardID 
WHERE name like '%".$_POST['director']."%' and job = 'director'
       and awardname like '%".$_POST['award']."%'";
		$query = mysql_query($sql)or die("Invalid query:".mysql_error);
	}

	if(isset($_POST['qArtist'])){
		if(isset($_POST['age'])){
		$age = $_POST['age'];
		if(isset($age[0])){
			$str0 = "FLOOR(DATEDIFF(m1.Released, a1.Birthday) / 365) < 30 OR ";
		}
		else 
			$str0 = "";
		if(isset($age[1])){
			$str1 = "FLOOR(DATEDIFF(m1.Released, a1.Birthday) / 365) between 30 and 40 OR ";
		}
		else 
			$str1 = "";
		if(isset($age[2])){
			$str2 = "FLOOR(DATEDIFF(m1.Released, a1.Birthday) / 365) between 40 and 50 OR ";
		}
		else 
			$str2 = "";
		if(isset($age[3])){
			$str3 = "FLOOR(DATEDIFF(m1.Released, a1.Birthday) / 365) between 50 and 60 OR ";
		}
		else 
			$str3 = "";
		if(isset($age[4])){
			$str4 = "FLOOR(DATEDIFF(m1.Released, a1.Birthday) / 365) > 60)";
		}
		else 
			$str4 = "FLOOR(DATEDIFF(m1.Released, a1.Birthday) / 365) < 100)";
		}
		else {
			$str0 = "";
			$str1 = "";
			$str2 = "";
			$str3 = '';
			$str4 = "FLOOR(DATEDIFF(m1.Released, a1.Birthday) / 365) < 100)";
		}
			
		//echo $str0.$str1.$str2.$str3.$str4;

			
		$sql = "SELECT *
FROM Movie AS m
INNER JOIN Movie_win AS mw ON m.MovieID = mw.MovieID
INNER JOIN Work_on AS wo ON wo.MovieID = mw.MovieID
INNER JOIN Artist AS a ON a.ArtistID = wo.ArtistID
WHERE a.gender = '".$_POST['gender']."' AND wo.Job = 'director' 
AND EXISTS (
	SELECT * 
	FROM Artist AS a1
	INNER JOIN Work_on AS wo1 ON wo1.ArtistID = a1.ArtistID
	INNER JOIN Movie as m1 ON m1.MovieID = wo1.MovieID
	WHERE wo.Job != 'Director'
	AND (".$str0.$str1.$str2.$str3.$str4."
	)";
		$query = mysql_query($sql)or die("Invalid query:".mysql_error);
	}
	if(isset($_POST['qCountry'])){
		$sql = "SELECT *
FROM Movie as m1
WHERE m1.movieID not in( 
SELECT m2.movieID
FROM Artist as A JOIN Work_on ON A.ArtistID = Work_on.ArtistID JOIN Movie as m2 ON 
m2.movieID = Work_on.movieID

WHERE A.country != '".$_POST['country']."'
)";
		$query = mysql_query($sql)or die("Invalid query:".mysql_error);
	}
	printMovie($query);
 
}
else if(isset($_POST['qAward'])){
	$sql = "SELECT mw.AwardTitle
FROM Award AS a
INNER JOIN Movie_win AS mw ON mw.AwardID = a.AwardID
INNER JOIN Movie AS m ON m.MovieID = mw.MovieID
WHERE m.MovieName LIKE  '%".$_POST["movie"]."%'
AND a.AwardName LIKE  '%".$_POST["award"]."%'";
$query = mysql_query($sql)or die("Invalid query:".mysql_error);
	while($row = mysql_fetch_array($query))
	{
		echo "
                        <div class='info_tab02'>
                        	<table>
                            	<tbody class='tab_showall'>
                                	<tr>
                                    	<th>Name： ".$row['AwardTitle']."</th>
									</tr>
                                </tbody>
                            </table>
                        </div>
                        		";
	}
}
                        ?>
                        </form>
                    </div>
                </div>
            </div>
            <div class="footer">
            	<div class="help_link">
                	contact email: daiyang58@hotmail.com
                </div>
                <p class="copyright">by Yang Dai & Tao Li 
                </p>
            </div>
     	</div>

    </div>

</body>
</html>
