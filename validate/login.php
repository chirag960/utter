<!DOCTYPE html>
<html>
<head>
<style>
html, body {
	width:100%;
	height:100%;
	margin:0;
	padding:0;
}
.header {
	text-align:center;
	font-family:"Trebuchet MS",Helvetica,sans-serif;
	font-size: 450%;
}
.container {
	padding-top : 20px;
	padding-bottom : 20px;
	margin : 10px auto 10px;
	text-align:center;
	width:40%;
	border : 1px solid #000;
	background:  rgba(0,0,0,0.1);
	transition : 0.3s;
}
.input-div {
	text-align:center;
	padding : 1px 1px 1px 1px; 
}
#list{
	padding:1px 2px 1px 1px;
	color: #000;
	font-size : 2em;
}
input {
	opacity :0.1%;
	border: none;
	border-bottom: 1px solid #fff;
	padding: 10px 10px 10px 10px;
	width:70%;
	transition:0.2s;
}
input:focus, textarea:focus {
	padding:15px 15px 15px 15px;
	outline: none;
	border-bottom:2px solid #efefef;
}
.create-but {
	background-color:#000;
		color:#fff;
	width:30%;
	border:1px solid #000;
}
.create-but:hover {
	background-color:#00a1ff;
	color: #fff;
}
a {
	color:#000;
	text-decoration: none;
}
a:hover {
	text-decoration: underline;
}
</style>
</head>
<body>
<?php
$connection = mysqli_connect('localhost','root','secret','utter') or die("couldn't make any connection");
if ($connection) echo "<p style='color:#fff'>connection made</p>";
if(isset($_POST['submit']))
{
	$name = $_POST['name'];
	session_start();
	$_SESSION['name'] = $_POST['name'];
	echo "session starts ".$_SESSION['name'];
	$password = $_POST['password'];
	$query="SELECT `password` FROM `user` WHERE `user-name` = '".$_SESSION['name']."'";
	$result = mysqli_query($connection,$query);
	$rowcount =  mysqli_num_rows($result);
	if($rowcount > 0)
	{
		echo "<p style='color:#000'>name is registered</p>";
		while ($row = mysqli_fetch_assoc($result))
		{
			$psd = $row['password'];
			if($psd == $password)
			{
				header('Location: ../chatlistdata.php');
			}
			else echo "<p style='background-color:red'>password wrong</p>";
		}
	}
	else 
	{
		echo "<p style='background-color:red'>sorry no such name registered ".$name."</p>";
	}
}
?>
<div class="header">Utter</div>
<div style="text-align:center">
<!--<div style="text-align:center;margin-top:3%;"><img src ="logo.jpg"></div>-->
<div class = "container" align="center">
<form action="login.php" method="post">
<div class="input-div">
<input type = "text" id="nm" name="name" onblur="checkname();" placeholder="Name" required><p id="nmp"></p>
</div>
<br>
<div class="input-div">
<input type = "password" id="ps" name="password" onblur="checkLast();" placeholder="Password" required><p id="psp"></p>
</div>
<br>
<div class="input-div">
<input id="login" onmouseover="this.value='Login ->'" onmouseout="this.value='Login'" class="create-but" type = "submit" value="Login" name="submit">
</div>
</form>
</div>
<a href="Signin.html">Do not have an Account? Create one.</a>
</div>
</body>
</html>