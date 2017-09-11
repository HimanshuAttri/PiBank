<!DOCTYPE html>
<html lang="en">
<head>
<title>DCB Gramin Bank Sewa</title>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.0/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.0/jquery.min.js"></script>
<link href='https://fonts.googleapis.com/css?family=Alegreya Sans' rel='stylesheet'>
<style>
.jumbotron 
{
 background-color: #fff;
 color: #009999;
 padding: 40px 25px;
}
#next{
	background-color: #3385ff; /* Blue-Green */
    border: none;
    color: white;
    padding: 5px 18px;
    text-align: center;
    text-decoration: none;
    display: inline-block;
    font-size: 12px;
    margin: 4px 2px;
    cursor: pointer;
	border-radius: 2px;
	border: 1px solid #3385ff;
}
</style>
<script>
function checkemployee() 
{
  var str1=document.getElementById("employee").value;
  document.getElementById("1").src = "wait.gif"; 
  if (str1=='') 
  {
    return;
  } 
  else 
  {
   if (window.XMLHttpRequest) 
    {
      xmlhttp=new XMLHttpRequest();
    } 
   else 
    {
      xmlhttp=new ActiveXObject('Microsoft.XMLHTTP');
    }
    xmlhttp.onreadystatechange=function() 
	{
      if(this.readyState==4&&this.status==200) 
	  {
       if(this.responseText=="okay")
	   {
		document.getElementById('1').src="right.png";
        document.getElementById('next').disabled=false;
	   }
	   else
       {
	   document.getElementById('1').src="wrong.png";
       document.getElementById('next').disabled=true;   
	   }
	  }
    };
   xmlhttp.open('GET','checkemployee.php?e='+str1,true);
   xmlhttp.send();
}
}


function checkDetails()
{
	var name=document.getElementById("name").value;
	var email=document.getElementById("email").value;
	var username=document.getElementById("username").value;
	var password=document.getElementById("password").value;
	var recheck_password=document.getElementById("recheck_password").value;
	var dob=document.getElementById("dob").value;
	var institute=document.getElementById("institute").value;
	
	if(name=="")
	{
		alert("Name must be filled");
		return false;
	}
	else if(username=="")
	{
		alert("Username must be filled");
		return false;
	}
    else if(email=="")
	{
		alert("Email must be filled");
		return false;
	}
    else if(password=="")
	{
		alert("Password must be filled");
		return false;
	}
    else if(recheck_password=="")
	{
		alert("Recheck password must be filled");
		return false;
	}
    else if(dob=="")
	{
		alert("Date of birth must be filled");
		return false;
	}
    else
	{
		return true;
	}		
}
</script>
</head>
</head>
<body>

<div class="jumbotron">
 <div class="container text-center">
<h1><image src="logo.png" width="40%"></h1></div>    
</div>

<div class="container">
  <form action="signup_admin2.php" class="form-horizontal" name="signup_form" method="post" onsubmit="return checkDetails()">
    <div class="form-group">
      <label class="control-label col-sm-4" for="name">Name</label>
      <div class="col-sm-4">
        <input type="text" class="form-control" id="name" name="name" required>
      </div>
    </div>
	<div class="form-group">
      <label class="control-label col-sm-4" for="mobile">Employee ID</label>
      <div class="col-sm-4">          
        <input type="text" class="form-control" id="employee" name="employee" onblur="checkemployee()" required>
      </div><img id="1" width="26" height="26">
    </div>
    <div class="form-group">
      <label class="control-label col-sm-4" for="password">Password</label>
      <div class="col-sm-4">          
        <input type="password" class="form-control" id="password" name="password" required>
      </div><img id="3" width="26" height="26">
    </div>
    <div class="form-group">
      <label class="control-label col-sm-4" for="password">Re-enter Password</label>
      <div class="col-sm-4">          
        <input type="password" class="form-control" id="recheck_password" name="recheck_password" onblur="recheckPassword()" required>
      </div>
    </div>
    <script>
	function recheckPassword()
    { 
	var password1 = document.getElementById("recheck_password").value;
	var password2 = document.getElementById("password").value;
	if(password2!=password1)
	{
		document.getElementById("3").src = "wrong.png";
		document.getElementById("dob").disabled=true;
		document.getElementById("institute").disabled=true;
	}
	else
	{
		document.getElementById("3").src = "right.png";
		document.getElementById("dob").disabled=false;
		document.getElementById("institute").disabled=false;
	}
    }
	</script>
	<div class="form-group">        
      <div class="col-sm-offset-4 col-sm-4">
        <button type="submit" value="submit" class="btn btn-primary pull-right btn-sm" id="next">Sign Up</button>
      
    </div>
  </div>
  </form>
</div>
</body>
</html>
