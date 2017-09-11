<?php
$var=$_POST["m"];
$connection1=mysqli_connect("localhost","root","toor","dcb");
$query1="SELECT name FROM dcb.user WHERE mobile='$var'";
$result1=mysqli_query($connection1,$query1);
if(mysqli_num_rows($result1)>0)
{
	while($row1=mysqli_fetch_assoc($result1))
	{
		$name=$row1["name"];
		echo $name;
	}
}
else
{
	echo "Error";
}
?>
