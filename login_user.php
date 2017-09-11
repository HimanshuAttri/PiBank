<?php
session_start();
$aadhar=$_POST["aadhar"];
$password=$_POST["password"];
$connection1=mysqli_connect("localhost","root","toor","dcb");
$query1="SELECT user_id FROM dcb.user WHERE aadhar='$aadhar' AND password='$password'";
$result1=mysqli_query($connection1,$query1);
if(mysqli_num_rows($result1)>0)
{
	while ($obj = mysqli_fetch_object($result1)) 
	    {
          $user_id=$obj->user_id;
        }
   $_SESSION["user_id_session"]=$user_id;
   echo $user_id;
   header('Location: main.php');
}
else
{
   header('Location: index.php');
}
?>
