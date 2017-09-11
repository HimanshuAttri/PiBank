<?php
session_start();
$user_id=$_SESSION["user_id_session"];
$index=0;
$c=mysqli_connect("localhost","root","toor","dcb_fav");
$q="SELECT phone FROM dcb_fav.$user_id";
$r=mysqli_query($c,$q);
if(mysqli_num_rows($r)>0)
{
  	while($row=mysqli_fetch_assoc($r))
	{
		echo '<input type="radio" class="list" value="'.$row["phone"].'" onclick="add_to_form('.$row["phone"].','.$index.')">'.$row["phone"].'<br>';
		$index=$index+1;
	}
}
?>
