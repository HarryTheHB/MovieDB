<?php
session_start();
if(!empty($_SESSION['u_id'])){
	unset($_SESSION['u_id']);
}
session_destroy();
echo "<script> alert('logout successfully');
		window.location.href = 'intro.html';</script>";
exit;
?>

