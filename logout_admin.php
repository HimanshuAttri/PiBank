<?php
session_start();
$_SESSION["admin_id_session"]=null;
session_unset();
session_destroy(); 
header('Location: admin_login.php');
exit;
?>
