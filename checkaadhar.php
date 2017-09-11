<?php
$var=$_GET["a"];
$connection1=mysqli_connect("localhost","root","toor","dcb");
$query1="SELECT aadhar FROM dcb.user WHERE aadhar='$var'";
$result1=mysqli_query($connection1,$query1);
if(mysqli_num_rows($result1)>0)
{
	echo"notokay";
}
else
{
	echo"okay";
}
?>
