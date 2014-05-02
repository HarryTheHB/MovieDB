<?php
include("check01.php");
include("db_connect.php");
include("all_function.php");

$query1 = mysql_query("select distinct Genre from has_genre")
or die("Invalid query:".mysql_error);

$query2 = mysql_query("select distinct AwardName from Award")
or die("Invalid query:".mysql_error);
             
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=gb2312" />
<title>query movie</title>
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
                            	<h3>Search Movie
                                </h3>
                                <h4>
								Searh By Details
                                </h4>
                        </div>
						
                        <form action = "show_result.php" method = "post">
                        <div class="info_tab02">
                        	<table>
                            	<tbody class="tab_showall">
                                	<tr>
                                    	<td>Name</td><td><input name="name" type="text" /></td>
                                        </tr>
                                        <tr>
                                        <td>Country</td><td><input name="country" type="text" /></td>
                                        </tr>
                                        <tr>
                                        <td>Rating From</td><td><input name="minrating" type="text" /></td><td>To</td><td><input name="maxrating" type="text" />
                                        </td>
                                        </tr>
                                        <tr>
                                        <td>ReleasedTime From</td><td><input name="minrelease" type="text" /></td><td>To</td><td><input name="maxrelease" type="text" />
                                        </td>
                                    </tr>
                                    <tr>
                                    <td colspan="4"><i>(Time Format: YYYY-MM-DD)</i></td>
                                    </tr>
                                    <tr>
                                    <td colspan="4"><input name="qDetail" type="submit" value = "search"/></td>
                                    </tr>
                                    
                                </tbody>
                            </table>
                        </div>
                        </form> 
                        <div class="index_title">
                                <h4>
								Searh By Type (highest rating in the type)
                                
                                </h4>
                                
                        </div>
                         <form action = "show_result.php" method = "post">
                        <div class="info_tab02">
                        	<table>
                            	<tbody class="tab_showall">
                                <tr>
                                	<td>Choose Type</td>
                                	<td>
                                    <select class="selection01" name="genre">
                                    	<?php
										while($row1 = mysql_fetch_array($query1)){
											$genre = $row1['Genre'];
											echo "
											<option value=".$genre.">".$genre."</option>
											";
											}
										?>
                                    </select>
                                    </td>
                               </tr>
                               <tr>
                                    <td colspan="2"><input name="qType" type="submit" value = "search"/></td>
                                 </tr>
                                </tbody>
                       	 	</table>
                        </div>
                        </form>
                        <div class="index_title">
                                <h4>
								Searh By Director and Award
                                
                                </h4>
                                
                        </div>
                         <form action = "show_result.php" method = "post">
                        <div class="info_tab02">
                        	<table>
                            	<tbody class="tab_showall">
                                <tr>
                                	<td>Director Name</td><td><input name="director" type="text" /></td>
                                	<td>Award Name</td>
                                	<td>
                                    <select class="selection01" name="award">
                                    	<?php
										while($row2 = mysql_fetch_array($query2)){
											$award = $row2['AwardName'];
											echo "
											<option value=".$award.">".$award."</option>
											";
											}
										?>
                                    </select>
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="4"><input name="qDirAward" type="submit" value = "search"/></td>
                                </tr>
                                </tbody>
                       	 	</table>
                        </div>
                        </form>
                        <div class="index_title">
                                <h4>
								Searh awards By Movie Name ( All award item this moive has won in one Award)
                                
                                </h4>
                                
                        </div>
                         <form action = "show_result.php" method = "post">
                        <div class="info_tab02">
                        	<table>
                            	<tbody class="tab_showall">
                                	<tr>
                                    	
                                        <td>Movie Name</td><td><input name="movie" type="text" /></td>
                                        <td>Award Name</td><td><select class="selection01" name="award">
                                    	<?php
										$query2 = mysql_query("select distinct AwardName from Award")
or die("Invalid query:".mysql_error);
										while($row2 = mysql_fetch_array($query2)){
											$award = $row2['AwardName'];
											echo "
											<option value=".$award.">".$award."</option>
											";
											}
										?>
                                    </select></td>
                                	</tr>
                                    <tr>
                                    <td colspan="4"><input name="qAward" type="submit" value = "search"/></td>
                                </tr>
                                </tbody>
                       	 	</table>
                        </div>
                        </form>
                        <div class="index_title">
                                <h4>
								Searh By Artist 
                                
                                </h4>
                                
                        </div>
                         <form action = "show_result.php" method = "post">
                        <div class="info_tab02">
                        	<table>
                            	<tbody class="tab_showall">
                                	<tr>
                                    	<td>Direcotr Gender</td>
                                        <td>
                                        <select class="selection01" name="gender">
                                        	<option value = "M">Male</option>
                                            <option value = "F">Female</option>
                                        </select></td>
                                        </tr>
                                        <tr>
                                        <td>All Artist Age</td>
                                        <td class="info_tab_vm">
                                                <input name="age[]" type="checkbox" value="1" class="info_radio01"
                                               />
                                                <label>20s and below</label>
                                                &nbsp;&nbsp;&nbsp;&nbsp;
                                                <input name="age[]" type="checkbox" value="1" class="info_radio01"
                                               />
                                                <label>30s</label>
                                                &nbsp;&nbsp;&nbsp;&nbsp;
                                                <input name="age[]" type="checkbox" value="1" class="info_radio01"
                                               />
                                                <label>40s</label>
                                                &nbsp;&nbsp;&nbsp;&nbsp;
                                                <input name="age[]" type="checkbox" value="1" class="info_radio01"
                                               />
                                                <label>50s</label>
                                                &nbsp;&nbsp;&nbsp;&nbsp;
                                                <input name="age[]" type="checkbox" value="1" class="info_radio01"
                                               />
                                                <label>60s and above</label>
                                                &nbsp;&nbsp;&nbsp;&nbsp;
                                        </td>
                                	</tr>
                   					<tr>
                                    <td colspan="2"><input name="qArtist" type="Submit" value = "search"/></td>
                                </tr>
                                </tbody>
                       	 	</table>
                        </div>
                        </form>
                        <div class="index_title">
                        		<h3> Tired of regular search? Take a look at these links. </h3>
                        </div>
                        <div class="info_tab02">
                        	<table>
                            	<tbody class="tab_showall">
                                	<tr><td>Do you know which type of movie has won awards most times?
                                
                                <a href="movie1.php">click here!</a>
                             		</td></tr>
                                    <tr><td>Do you know which type of movie has highest average rating?
                                
                                <a href="movie5.php">click here!</a>
                             		</td></tr>
                                    <tr>
                                      <td>Do you konw which movies have box office higher than average but have rating lower than average?
                                
                                <a href="movie2.php">click here!</a>
                             		</td></tr>
                                    <tr><td>Do you know which movies have won awards but none of them were for artists?
                                
                                <a href="movie3.php">click here!</a>
                             		</td></tr>
                                    <tr><td>Do you know which pair of movies are so similar?
                                    <a href="movie4.php">click here!</a></td>
                                    </tr>
                                    <tr>
                                    <td><i class="W_textb">(They have at least one common type and one common artist and have obtained at least one awards from a common Award)</i></td>
                                </tr>
                                </tbody>
                            </table>
                        </div>

                        
                        <div class="index_title">
                                <h4>
								Do you want to know which movies have only used artists in their producing country?
                                
                                </h4>
                                
                        </div>
                         <form action = "show_result.php" method = "post">
                        <div class="info_tab02">
                        	<table>
                            	<tbody class="tab_showall">
                                <tr>
                                	<td>Country Name</td><td><input name="country" type="text" /></td>
                                </tr>
                                <tr>
                                    <td colspan="2"><input name="qCountry" type="submit" value = "go"/></td>
                                </tr>
                                </tbody>
                       	 	</table>
                        </div>
                        </form>
                        
              
                        
                    </div>
                </div>
            </div>
            <div class="footer">
            	<div class="help_link">
                	联系我们
                </div>
                <p class="copyright">copyright
                <span class="Icp">ICP号</span>
                </p>
            </div>
     	</div>

    </div>

</body>
</html>
