<?php
session_start();
$employee=$_POST["employee"];
$password=$_POST["password"];
$connection1=mysqli_connect("localhost","root","toor","dcb");
$query1="SELECT id FROM dcb.admin WHERE employee='$employee' AND password='$password'";
$result1=mysqli_query($connection1,$query1);
if(mysqli_num_rows($result1)>0)
{
	while ($obj = mysqli_fetch_object($result1)) 
	    {
          $id=$obj->id;
        }
   $_SESSION["admin_id_session"]=$id;
   header('Location: admin_main.php');
}
else
{
 //  header('Location: login_admin.php');
}
?>
