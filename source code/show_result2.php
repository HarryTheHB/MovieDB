<?php
include("check01.php");
include("db_connect.php");
include("all_function.php");
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=gb2312" />
<title>show all users</title>
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
if(isset($_POST["qDetail"])||isset($_POST["qArtist"])||isset($_POST["qDirector"])) {
	
	if(isset($_POST["qDetail"])) {
		$ArtistName = $_POST["name"];
		$Country = $_POST["country"];
		$Gender = $_POST["gender"];
		$MinDOB = $_POST["mindob"];
		$MaxDOB = $_POST["maxdob"];
		//echo "select * from Artist where ".checkArtistName($ArtistName).								checkCountry($Country).checkMaxDOB($MaxDOB).checkMinDOB($MinDOB);
		$query = mysql_query("select * from Artist where ".checkArtistName($ArtistName).checkCountry($Country).checkArtistGender($Gender).checkMaxDOB($MaxDOB).checkMinDOB($MinDOB)
		)
		or die("Invalid query:".mysql_error);
	}
	if(isset($_POST["qArtist"])){
	$sql = "SELECT *
FROM Artist AS a1
WHERE a1.ArtistID IN (
	SELECT hr.ArtistID1
	FROM Has_relation AS hr
	WHERE hr.ArtistID2 IN (
		SELECT wo1.ArtistID
		FROM Work_on AS wo1
		WHERE wo1.MovieID IN (
			SELECT wo2.MovieID
			FROM Work_on AS wo2 INNER JOIN Artist AS a2 ON a2.ArtistID = wo2.ArtistID
			WHERE a2.Name like '%".$_POST['name']."%'
			)
		)
	) ORDER BY a1.Name DESC
";
	//echo $_POST['qArtist'];
	$query = mysql_query($sql) or die("Invalid query:".mysql_error);
	}
	if(isset($_POST["qDirector"])){
	$sql = "SELECT *
FROM Artist AS a1
WHERE a1.ArtistID NOT IN (
	SELECT wo1.ArtistID
	FROM Work_on AS wo1
	WHERE wo1.MovieID NOT IN (
		SELECT wo2.MovieID
		FROM Work_on AS wo2 
		INNER JOIN Artist AS a2 ON a2.ArtistID = wo2.ArtistID
		WHERE a2.Name like '%".$_POST["name"]."%' AND wo2.Job = 'director'
		)
	)
";
	$query = mysql_query($sql) or die("Invalid query:".mysql_error);
	}
	printArtist($query);
}
else if(isset($_POST["qMovie"])){
	if($_POST["multiJobs"] == 1){
		$sql = "
select  Artist.ArtistID,Name,Gender,Birthday,Artist.Country,Job,Movie.movieID,MovieName
from 
(SELECT Artist.ArtistID 
FROM Artist JOIN Work_on ON Artist.ArtistID = Work_on.ArtistID JOIN Movie ON 
Movie.movieID = Work_on.movieID
WHERE  Movie.moviename like '%".$_POST["name"]."%'
GROUP BY artistID, Movie.movieID
HAVING count(job) >1) as M INNER JOIN Work_on ON M.artistID = Work_on.artistID INNER JOIN
Artist ON M.artistID = Artist.artistID JOIN Movie ON Work_on.movieID = Movie.movieID
ORDER BY MovieID DESC, ArtistID DESC

";
		$query = mysql_query($sql) or die("Invalid query:".mysql_error);
	}
	else{
		$sql = "
select *
from 
(SELECT Artist.ArtistID 
FROM Artist JOIN Work_on ON Artist.ArtistID = Work_on.ArtistID JOIN Movie ON 
Movie.movieID = Work_on.movieID
WHERE Movie.moviename like '%".$_POST["name"]."%'
GROUP BY artistID, Movie.movieID
HAVING count(job) =1) as M INNER JOIN Work_on ON M.artistID = Work_on.artistID INNER JOIN
Artist ON M.artistID = Artist.artistID JOIN Movie ON Work_on.movieID = Movie.movieID
ORDER BY MovieID DESC, ArtistID DESC
";
		$query = mysql_query($sql) or die("Invalid query:".mysql_error);
		}
		while($row = mysql_fetch_array($query))
	{
		echo "
                        <div class='info_tab02'>
                        	<table>
                            	<tbody class='tab_showall'>
                                	<tr>
                                    	<td>Name： ".$row['Name']."</td>
										<td>Gender： ".$row['Gender']."</td>
									</tr>
									<tr>
                                        <td>Country： ".$row['Country']."</td>
                                        <td>Birthday： ".$row['Birthday']."</td>
									</tr>
									<tr>
										<td>MovieName: ".$row['MovieName']."</td>
										<td>Job： ".$row['Job']."</td>
									</tr
                                </tbody>
                            </table>
                        </div>
                        		";
	}	
}
else if(isset($_POST["qAward"])){
	$query = mysql_query("") or die("Invalid query:".mysql_error);
}
else if(isset($_POST["qRelation"])){
	$query = mysql_query("") or die("Invalid query:".mysql_error);
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
