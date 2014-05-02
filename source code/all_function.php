<?php
function checkMovieName($MovieName)
{
	$str = "";
	if($MovieName != NULL)
		$str = "MovieName like '%".$MovieName."%' and ";
	return $str;
}
function checkCountry($Country)
{
	$str = "";
	if($Country != NULL)
		$str = "Country like '%".$Country."%' and ";
	return $str;
}
function checkMinRating($MinRating)
{
	$str = "Rating > '0'";
	if($MinRating != NULL)
		$str = "Rating > '".$MinRating."'";
	return $str;
}
function checkMaxRating($MaxRating)
{
	$str = "";
	if($MaxRating != NULL)
		$str = "Rating > '".$MaxRating."' and ";
	return $str;
}
function checkMinRelease($MinRelease)
{
	$str = "";
	if($MinRelease != NULL)
		$str = "Released > '".$MinRelease."' and ";
	return $str;
}
function checkMaxRelease($MaxRelease)
{
	$str = "";
	if($MaxRelease != NULL)
		$str = "Released < '".$MaxRelease."' and ";
	return $str;
}

function checkArtistName($ArtistName)
{
	$str = "";
	if($ArtistName != NULL)
		$str = "Name like '%".$ArtistName."%' and ";
	return $str;
}
function checkArtistGender($Gender)
{
	$str = "";
	if($Gender != NULL)
		$str = "Gender = '".$Gender."' and ";
	return $str;
}
function checkMinDOB($MinDOB)
{
	$str = "Birthday >= '0000-00-00'";
	if($MinDOB != NULL)
		$str = "Birthday >= '".$MinDOB."'";
	return $str;
}
function checkMaxDOB($MaxDOB)
{
	$str = "";
	if($MaxDOB != NULL)
		$str = "Birthday =< '".$MaxDOB."' and ";
	return $str;
}
function printMovie($query)
{
while($row = mysql_fetch_array($query))
	{
		echo "
                        <div class='info_tab02'>
                        	<table>
                            	<tbody class='tab_showall'>
                                	<tr>
                                    	<th>Name£º ".$row['MovieName']."</th>
									</tr>
									<tr>
                                        <td>Country£º ".$row['Country']."</td>
                                        <td>Release Time£º ".$row['Released']."</td>
									</tr>
									<tr>
										<td>Rating£º ".$row['Rating']."</td>
										<td>Box Office(Million)£º ".$row['Box_Office']."</td>
                                       
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        		";
	}
}

function printArtist($query)
{
	while($row = mysql_fetch_array($query))
	{
		echo "
                        <div class='info_tab02'>
                        	<table>
                            	<tbody class='tab_showall'>
                                	<tr>
                                    	<td>Name£º ".$row['Name']."</td>
										<td>Gender£º ".$row['Gender']."</td>
									</tr>
									<tr>
                                        <td>Country£º ".$row['Country']."</td>
                                        <td>Birthday£º ".$row['Birthday']."</td>
									</tr>
									
                                </tbody>
                            </table>
                        </div>
                        		";
	}	
}
?>
