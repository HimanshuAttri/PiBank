<?php
session_start();
if((isset($_SESSION["user_id_session"]))&&(!empty($_SESSION["user_id_session"])))
{
	$user_id=$_SESSION["user_id_session"];
}
else
{
	header("Location: index.php");
	die();
}
$amount=$_POST["a"];
$mobile=$_POST["m"];
$purpose=$_POST["p"];
$connection1=mysqli_connect("localhost","root","toor","dcb");
$connection2=mysqli_connect("localhost","root","toor","dcb_tranz");
$query1="SELECT user_id FROM dcb.user WHERE mobile='$mobile'";
$result1=mysqli_query($connection1,$query1);
if($result1)
{
	while($row1=mysqli_fetch_assoc($result1))
	{
		$send_user_id=$row1["user_id"];
	}
}
else
{
	die(mysqli_error($connection1));
}
//inserting transaction for sender
$query2="INSERT INTO dcb_tranz.$user_id(amount,send_user_id,type,time,purpose) VALUES('$amount','$send_user_id','0',CURRENT_TIMESTAMP(),'$purpose')";
$result2=mysqli_query($connection2,$query2);
if(!$result2)
{
	die(mysqli_error($connection2));
}
//fetching balance from sender 
$query6="SELECT balance FROM dcb.balance WHERE user_id='$user_id'";
$result6=mysqli_query($connection1,$query6);
if(mysqli_num_rows($result6))
{
	while($row3=mysqli_fetch_assoc($result6))
	{
		$user_amount=$row3["balance"];
	}
}
else
{
	die(mysqli_error($connection1));
}
if($amount<=$user_amount)
{
	$new_balance=$user_amount-$amount;
//updating balance for sender 
$query4="UPDATE dcb.balance SET balance='$new_balance' WHERE user_id='$user_id'";
$result4=mysqli_query($connection1,$query4);
if(!$result4)
{
	die(mysqli_error($connection1));
}
//inserting transaction for receiver
$query5="INSERT INTO dcb_tranz.$send_user_id(amount,send_user_id,type,time,purpose) VALUES('$amount','$user_id','1',CURRENT_TIMESTAMP(),'$purpose')";
$result5=mysqli_query($connection2,$query5);
if(!$result5)
{
	die(mysqli_error($connection2));
}
//fetching balance form receiver
$query3="SELECT balance FROM dcb.balance WHERE user_id='$send_user_id'";
$result3=mysqli_query($connection1,$query3);
if(mysqli_num_rows($result3))
{
	while($row2=mysqli_fetch_assoc($result3))
	{
		$send_user_amount=$row2["balance"];
	}
}
else
{
	die(mysqli_error($connection1));
}
$new_balance_send=$send_user_amount+$amount;
//updating balance of receiver
$query4="UPDATE dcb.balance SET balance='$new_balance_send' WHERE user_id='$send_user_id'";
$result4=mysqli_query($connection1,$query4);
if(!$result4)
{
	die(mysqli_error($connection1));
}
echo "Payement Successful";
}
else
{
	echo "Your account balance is ".$user_amount;
}
?>
