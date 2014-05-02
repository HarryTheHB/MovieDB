<?php
 session_start();
 if(empty($_SESSION['UID'])){
	echo "<script> alert('Not login, please login first'); window.location='intro.html';</script>";
}
?>
