<?php
session_start();
if((isset($_SESSION["user_id_session"]))&&(!empty($_SESSION["user_id_session"])))
{
	$user_id=$_SESSION["user_id_session"];
}
else
{
	header("Location: inde.php");
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

<body>
<!--navigation bar-->
<nav class="navbar navbar-default navbar-fixed-top" id="navi_bar">
  <div class="container-fluid">
    <div class="navbar-header">
	 <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>                        
      </button>
      <a class="navbar-brand" href="index.php"><font face="Alegreya Sans">DCB ग्रामीन बैंक सेवा</font></a>
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
		<div id="load_passbook">
		</div>
	 </div>
	 <div class="col-sm-2">
	</div>
</div></div>
<script>
$(document).ready(function(){
    	$("#load_passbook").load("load_passbook.php");
});
function send_money(){
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
		alert(this.responseText);
     }
	 };
    xhttp.open("POST", "update_money.php",true);
    xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhttp.send("a="+amount+"&m="+mobile+"&p="+purpose);
}
function fetch_name(mobile){
	var money=document.getElementById("phone").value;
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
		if(this.responseText=="okay")
		{
			alert("Transaction successful");
			document.getElementById("phone").reset;
			document.getElementById("amount").reset;
			document.getElementById("purpose").reset;
		}
     }
	 };
    xhttp.open("POST", "check_mobile.php?m="+mobile, true);
    xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhttp.send();
}
</script>
<br>
<br>
<br>



<footer><font face="Alegreya Sans" size="4">
DCB Gramin Bank Sewa</font>
</footer>
</body>
</html>
