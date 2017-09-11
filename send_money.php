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
?>
<!DOCTYPE html>
<html lang="en">
<head>
<title>DCB Gramin Bank Sewa</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	<link href='https://fonts.googleapis.com/css?family=Alegreya Sans' rel='stylesheet'>
	<style>
	body{
		background-color:#f9f9f9;
	}
	
	.navbar {
      margin-bottom: 0;
      background-color: #3333ff;
      z-index: 9999;
      border: 0;
      font-size: 15px !important;
      line-height: 1.42857143 !important;
      border-radius: 0;
      font-family: Arial, sans-serif;
	}
	.navbar li a, .navbar .navbar-brand {
      color: #ffffff !important;
	}
	.navbar-nav li a:hover, .navbar-nav li.active a {
      color: #000000 !important;
      background-color: #fff !important;
	}
	.navbar-default .navbar-toggle {
      border-color: transparent;
      color: #fff !important;
	}
	#ask_button
	{
		background-color: #3385ff; /* Blue-Green */
		border: none;
		color: white;
		padding: 5px 10px;
		text-align: center;
		text-decoration: none;
		display: inline-block;
		font-size: 12px;
		margin: 4px 2px;
		cursor: pointer;
		border-radius: 2px;
		border: 1px solid #3385ff;
	}
	footer 
	{
		padding: 2em;
    color: black;
    background-color: #cccccc;
    clear: left;
    text-align: center;
	}
	</style>
</head>

<body  onload="give_alert()">
<!--navigation bar-->
<nav class="navbar navbar-default navbar-fixed-top" id="navi_bar">
  <div class="container-fluid">
    <div class="navbar-header">
	 <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>                        
      </button>
      <a class="navbar-brand" href="index.php"><font face="Alegreya Sans">DCB Gramin Bank Sewa</font></a>
    </div>
	<div class="collapse navbar-collapse" id="myNavbar">
    <ul class="nav navbar-nav navbar-right">
      <li><a href="main.php"><font face="Alegreya Sans">Home</font></a></li>
      <li><a href="logout_user.php"><font face="Alegreya Sans">Log out</font></a></li>
    </ul>
	</div>
  </div>
</nav>
<br>
<br>
<br>
<br>
<br>
<!-- body-->
<div class="container">
  <div class="row">
    <div class="col-sm-2">
	</div>
	<div class="col-sm-8">
		<div id="filter" style="border:none;float:center;">
			
				<div class="form-group" style="text-align:center">
				<label for="comment"><font face="Alegreya Sans" size="5">भुगतान करें<br>Pay</font></label><br><br>
				</div>
				<label for="phone"><font face="Alegreya Sans">फ़ोन नंबर / Phone Number</font></label><br>
				<div>
				<input type="text" class="form-control" id="phone">
				<br>
				</div>
				<div id="fav_contacts">
				</div>
				<br>
				<input type="checkbox" class="checkbox" onclick="update_fav()"><b><font face="Alegreya Sans"> पसंदीदा में जोड़ें / Add to favourites</font></b><br><br>
				<label for="address"><font face="Alegreya Sans">राशि / Amount</font></label><br>
				<div>
				<input type="text" class="form-control" id="amount"><br>
				</div>
				<label for="name"><font face="Alegreya Sans">उद्देश्य / Purpose</font></label><br>
				<div>   
				<input type="text" class="form-control" id="purpose"><br>
				</div>
				<div style="text-align:left">
				<button type="button" id="ask_button" class="btn btn-default" onclick="fetch_name()">भुगतान  / Pay</button>
			</div>
		</div>
	 </div>
	 <div class="col-sm-2">
	 <div id="check" style="display:hidden"></div>
	</div>
</div></div>
<script>
$(document).ready(function(){
    	$("#fav_contacts").load("phone_option.php");
})

$(document).ready(function(){
    $("#ask_button").click(function(){
		s=$("#village").val();
        $("#details").load("fetch_detail.php",{'v':s});
    });
});
function add_to_form(num,index)
{
	var x=document.getElementsByClassName("list")[index].value;
	document.getElementById("phone").value=x;
}
function send_money(mobile,amount,purpose){
		if (window.XMLHttpRequest) 
		{
			xhttp=new XMLHttpRequest();
		} 
		else 
		{
			xhttp=new ActiveXObject('Microsoft.XMLHTTP');
		}
		xhttp.onreadystatechange = function() {
		if (this.readyState == 4 && this.status == 200) {
			alert(this.responseText);
			}
		};
	xhttp.open("POST", "update_money.php",true);
    xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhttp.send("a="+amount+"&m="+mobile+"&p="+purpose);		
	
}
function fetch_name(){
	var mobile=document.getElementById("phone").value;
	var amount=document.getElementById("amount").value;
	var purpose=document.getElementById("purpose").value;
	if (window.XMLHttpRequest) 
    {
      xhttp=new XMLHttpRequest();
    } 
	else 
    {
      xhttp=new ActiveXObject('Microsoft.XMLHTTP');
    }
	xhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
		if (confirm(this.responseText) == true) 
		{
			send_money(mobile,amount,purpose);
		} 
		else 
		{
        alert("Cancelled");
		}
	  }
	 };
    xhttp.open("POST", "check_mobile.php", true);
    xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhttp.send("m="+mobile);
}
function update_fav()
{
	var mobile=document.getElementById("phone").value;
	if(mobile!="")
	{
		if (window.XMLHttpRequest) 
		{
			xhttp=new XMLHttpRequest();
		} 
		else 
		{
			xhttp=new ActiveXObject('Microsoft.XMLHTTP');
		}
		xhttp.onreadystatechange = function() {
		if (this.readyState == 4 && this.status == 200) {
		alert(this.responseText); 
	    }
	 };
     xhttp.open("POST", "update_fav.php", true);
     xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
     xhttp.send("m="+mobile);	
    }
	else{
		alert("First enter the phone number ")
	}
}

</script>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<footer><font face="Alegreya Sans" size="4">
DCB Gramin Bank Sewa</font>
</footer>
</body>
</html>
