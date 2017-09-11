<?php
session_start();
$user_id=$_SESSION["user_id_session"];
$var=$_POST["m"];
$connection1=mysqli_connect("localhost","root","toor","dcb_fav");
$query1="INSERT INTO dcb_fav.$user_id(phone) VALUES('$var')";
$result1=mysqli_query($connection1,$query1);
if(!$result1)
{
	echo"error";
}
else
{
	echo"Added to favourite !";
}
?>
