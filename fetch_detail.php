<?php
session_start();
$village=$_POST["v"];
if((isset($_SESSION["admin_id_session"]))&&(!empty($_SESSION["admin_id_session"])))
{
$admin_id=$_SESSION["admin_id_session"];
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
		$index=0;
		$connection1=mysqli_connect("localhost","root","toor","dcb");
		$connection2=mysqli_connect("localhost","root","toor","dcb_tranz");
		$query2="SELECT user_id,balance FROM dcb.balance";
		$result2=mysqli_query($connection1,$query2);
		echo'<table width="100%" style="border:1px solid #3333ff;border-top: none;background:#3333ff;">
			 <tr width="100%">
			 <td width="20%"><font face="" color="white">Account Details</font></td>
			 </tr>      
			 </table>';
		if(mysqli_num_rows($result2)>0)
		{
			while($row2=mysqli_fetch_assoc($result2))
			{
				$balance=$row2["balance"];
				$user_id=$row2["user_id"];
				$query1="SELECT name FROM dcb.user WHERE user_id=$user_id";
				$result1=mysqli_query($connection1,$query1);
				if(mysqli_num_rows($result1)>0)
				{
					while($row1=mysqli_fetch_assoc($result1))
					{
						$name=$row1["name"];
						echo'<table width="100%" style="border:1px solid #3333ff;border-top: none;background:#ffffff;">
						<tr>
						<td width="100%">
							<table width="100%">
							<tr>
								<td align="center" width="30%">'.$name.'</td>
								<td align="center">&#x20B9; '.$balance.'</td>
								<td align="center"><button type="button" class="tranz" onclick="a('.$index.','.$user_id.')">Transactions</button></td>
							</tr>
							</table>
						</td>
						</tr>      
						<tr>
						<td><div class="discuss"></div></td></tr>
						</table>';
						$check=1;
						$index=$index+1;
					}
				}
			}
		}
if($check==0)
{
	echo'<table style="width:100%;border:1px solid #ff3300;" bgcolor="#ffffff" >
	     <tr style="border:1px solid #ff3300;background:#ff3300;"><td><font color="white" size="3">कोई लेन-देन इतिहास उपलब्ध नहीं है । <br>No transaction history available !</font></td></tr>
		 </table>';
	echo "<br>";
}
}
?>
