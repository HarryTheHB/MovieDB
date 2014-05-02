<?php
include("check01.php");
include("db_connect.php");
include("all_function.php");

$query1 = mysql_query("select distinct Relation from has_relation")
or die("Invalid query:".mysql_error);
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
                    	<div class="info_main">
                    	<div class="index_title">
                            	<h3>Search Artist
                                </h3>
                                <h4>
								Searh By Details
                                </h4>
                        </div>
						
                        <form action = "show_result2.php" method = "post">
                        <div class="info_tab02">
                        	<table>
                            	<tbody class="tab_showall">
                                	<tr>
                                    	<td>Name</td><td><input name="name" type="text" /></td>
                                        </tr>
                                        <tr>
                                        <td>Country</td><td><input name="country" type="text" /></td>
                                        <td>Gender</td>
                                        <td>
                                        <select class="selection01" name="gender">
                                        	<option value = "M">Male</option>
                                            <option value = "F">Female</option>
                                        </select></td>
                                        </tr>
                                        <tr>
                                        <td>DOB From</td><td><input name="mindob" type="text" /></td><td>To</td><td><input name="maxdob" type="text" />
                                        </td>
                                        </tr>
                  
                                    <tr>
                                    <td colspan="4"><i>(Time Format: YYYY-MM-DD)</i></td>
                                    </tr>
                                    <tr>
                                    <td colspan="4"><input name="qDetail" type="submit" value = "submit"/></td>
                                    </tr>
                                    
                                </tbody>
                            </table>
                        </div>
                        </form> 
                        
                        <div class="index_title">
                                <h4>
								Searh By Movie
                                </h4>
                        </div>
                        <form action = "show_result2.php" method = "post">
                        <div class="info_tab02">
                        	<table>
                            	<tbody class="tab_showall">
                                	<tr>
                                    <td>Name</td><td><input name="name" type="text" /></td>
                                    <td>Multiple Jobs?</td><td><p>
                                      <label>
                                        <input type="radio" name="multiJobs" value="1" id="multiJobs_0" />
                                        Yes</label>
                                      <label>
                                        <input type="radio" name="multiJobs" value="0" id="multiJobs_1" />
                                        No</label>
                                      <br />
                                    </p></td>	
                                    </tr>
                                    <tr>
                                    <td colspan="4"><input name="qMovie" type="submit" value = "submit"/></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        </form>
                        
                        <div class="index_title">
                                <h4>
								Searh By Awards
                                </h4>
                        </div>
                        <form action = "show_result2.php" method = "post">
                        <div class="info_tab02">
                        	<table>
                            	<tbody class="tab_showall">
                                	<tr>
                                    	<td>Award Name</td><td><input name="award" type="text" /></td>
                                    </tr>
                                    <tr>
                                     <td colspan="2"><input name="qAward" type="submit" value = "submit"/></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        </form>
                        <div class="index_title">
                        		<h3>Try something fun here </h3>
                        </div>
                        <div class="info_tab02">
                        	<table>
                            	<tbody class="tab_showall">
                                	<tr><td>Do you know which directors whose films' number in every year keep increasing?
                                
                                <a href="artist1.php">click here!</a>
                             		</td></tr>
                                    <tr><td>Do you know which acotr/actress have won best actor/actress in 3 different Award?
                                
                                <a href="artist2.php">click here!</a>
                             		</td></tr>
                                    <tr><td>Do you know which artitsts with some relation have showed in one movie?
                                
                                <a href="artist3.php">click here!</a>
                             		</td></tr>
                                </tbody>
                            </table>
                       </div>
    
                       
                        
                        <div class="index_title">
                                <h4>
								Long Relation Search
                                </h4>
                                <p>Search all artists who have relation with someone who have been in the same film with this artist</p>
                        </div>
                        <form action = "show_result2.php" method = "post">
                        <div class="info_tab02">
                        	<table>
                            	<tbody class="tab_showall">
                                	<tr>
                                    	<td>Artist Name</td><td><input name="name" type="text"/></td>
                                    </tr>
                                    <td colspan="2"><input name="qArtist" type="submit" value = "submit"/></td>
                                </tbody>
                            </table>
                        </div>
                        </form>
                        
                        <div class="index_title">
                                <h4>
								Director Obessesing
                                </h4>
                                <p>Search all artists who have showed in all movie directed by this director</p>
                        </div>
                        <form action = "show_result2.php" method = "post">
                        <div class="info_tab02">
                        	<table>
                            	<tbody class="tab_showall">
                                	<tr>
                                    	<td>Director Name</td><td><input name="name" type="text"/></td>
                                    </tr>
                                    <td colspan="2"><input name="qDirector" type="submit" value = "submit"/></td>
                                </tbody>
                            </table>
                        </div>
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
