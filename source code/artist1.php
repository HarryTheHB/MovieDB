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

                        <?php
						$sql = "SELECT *
FROM 
Artist as A1 JOIN Work_on ON A1.ArtistID = Work_on.ArtistID JOIN Movie ON 
Movie.movieID = Work_on.movieID
WHERE job = 'director' and released like '2013%'
GROUP BY A1.artistID
HAVING count(Movie.movieID)>=
	(SELECT count(Movie.movieID)
	FROM Artist as A2 JOIN Work_on ON A2.ArtistID = Work_on.ArtistID JOIN Movie ON 
	      Movie.movieID = Work_on.movieID
	WHERE job = 'director' and A1.artistID = A2.artistID and released like '2012%'
	GROUP BY A2.artistID
	HAVING count(Movie.movieID)>=
		(SELECT count(Movie.movieID)
		FROM Artist as A3 JOIN Work_on ON A3.ArtistID = Work_on.ArtistID JOIN Movie ON 
		Movie.movieID = Work_on.movieID
		WHERE job = 'director' and A1.artistID=A3.artistID and released like '2011%'
		GROUP BY A3.artistID ))";
	$query = mysql_query($sql)or die("Invalid query:".mysql_error);
	printArtist($query);
 	?>

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
