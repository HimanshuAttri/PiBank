<?php
session_start();
if((isset($_SESSION["user_id_session"]))&&(!empty($_SESSION["user_id_session"])))
{
$user_id=$_SESSION["user_id_session"];
echo '<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
';
echo '<style>
		table {
		border-collapse: collapse;
		border-spacing: 2px;
		}
		td{
			padding:10px;
		}
		.upvote,.downvote,.views{
			 background-color: #ffffff;
			 border: none;
		}
		</style>';
		$check=0;
$connection1=mysqli_connect("localhost","root","toor","dcb");
$query2="SELECT balance FROM dcb.balance WHERE user_id=$user_id";
$result2=mysqli_query($connection1,$query2);
if(mysqli_num_rows($result2)>0)
{
	while($row2=mysqli_fetch_assoc($result2))
	{
		$balance=$row2["balance"];
	}
}
echo'<table class="news_data" style="width:100%;border:1px solid #3333ff;" bgcolor="#ffffff" >
	 <tr style="border:1px solid #3333ff;background:#3333ff;"><td><font color="white" size="3">सेश राशी  -  <b><font size="4">&#x20B9; '.$balance.'</font></b></td><td align="right"><font color="white" size="3">Available Balance -  <b><font size="4">&#x20B9; '.$balance.'</font></b></td></tr>
	 </table>';
echo'<table class="news_data" width="100%">
	<tr style="border:1px solid #3333ff;background:#b3e6ff;"><td width="20%" align="center"><font color="black">नाम / Name</font></td><td width="20%" align="center"><font color="black">रकम / Amount</font></td><td width="20%" align="center"><font color="black">लेन-देन / Transaction</font></td><td width="20%" align="center"><font color="black">
दिन / Date</font></td><td width="20%" align="center"><font color="black">
उद्देश्य / Purpose</font></td></tr>
	</table>';
$connection2=mysqli_connect("localhost","root","toor","dcb_tranz");
$query1="SELECT send_user_id,amount,type,time,purpose FROM dcb_tranz.$user_id ORDER BY id DESC";
$result1=mysqli_query($connection2,$query1);
//$index=0;
if(mysqli_num_rows($result1)>0)
{
	while($row1=mysqli_fetch_assoc($result1))
	{
		$send_user_id=$row1["send_user_id"];
		$query3="SELECT name,mobile FROM dcb.user WHERE user_id=$send_user_id";
		$result3=mysqli_query($connection1,$query3);
		if(mysqli_num_rows($result3)>0)
		{
			while($row3=mysqli_fetch_assoc($result3))
			{
				$name=$row3["name"];
				$phone=$row3["mobile"];
			}
		}
		$amount=$row1["amount"];
		$type=$row1["type"];
		if($type=="1")
		{
			$type_next="श्रेय / Credit";
		}
		else if($type=="0")
		{
			$type_next="निकाला / Debit";
		}
		$time=strtotime($row1["time"]);
		$date=date('d-m-Y',$time);
		$purpose=$row1["purpose"];
		echo'<table width="100%" style="border:1px solid #3333ff;border-top: none;background:#ffffff;">
			 	<tr width="100%">
				<td width="20%" align="center">'.$name.' ('.$phone.')'.'</td>
				<td width="20%" align="center">&#x20B9; '.$amount.'</td>
				<td width="20%" align="center">'.$type_next.'</td>
				<td width="20%" align="center">'.$date.'</td>
				<td width="20%" align="center">'.$purpose.'</td>
				</tr>      
			</table>';
		$check=1;	 
	}
}
if($check==0)
{
	echo'<table style="width:100%;border:1px solid #ff3300;" bgcolor="#ffffff" >
	     <tr style="border:1px solid #ff3300;background:#ff3300;"><td><font color="white" size="3">कोई लेन-देन इतिहास उपलब्ध नहीं है । <br>No transaction history available !</font></td></tr>
		 </table>';
	echo "<br>";
}}
?>
