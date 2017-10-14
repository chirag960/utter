<!DOCTYPE html>
<html>
<head>
<style>
.container {
	width:30%;
	margin:10px 10px;
	height:400px;
	overflow:auto;
	border:1px solid black;
	border-radius:4px 4px;
}
.bubble {
	padding:5px 5px 5px 5px;
	height:30px;
	border-radius:8px 8px;
	background-color:rgb(86, 145, 239);
	width:60%;
}
</style>
</head>
<body onload="scrolldown()">
<div class="container" id="cont">
<div id="demo"></div>
	<?php
	$connection = mysqli_connect('localhost','root','secret','maps') or die("couldn't make any connection");
	//$eid = $_SESSION['eid'];
	//$uid = $_SESSION['uid'];
	session_start();
	$eid = $_SESSION['eid'];
	$uid = $_SESSION['uid'];
	$_SESSION['eid'] = $eid;
	$_SESSION['uid'] = $uid;
	 $query = "SELECT * FROM event_".$eid." ORDER BY id"; 
	 $run = $connection->query($query); 
	 while($row = $run->fetch_array())
	 {
	 echo "<span class='bubble'>".$row['msg']."</span><br><>".$row['time']."</span><br><br>";
	 $i = $row['ID'];
	 }
	?>
<div id="chat"></div>
<?php
 if(isset($_POST['submit']))
 {
	 $message = $_POST['message'];
	 $query = "INSERT INTO event_".$eid." (`uid`,`msg`) VALUES ('$uid','$message')"; 
	 $run = $connection->query($query); 
 } 
 else echo "not inserted";
?>
<script> 
var element = document.getElementById("cont");
 function scrolldown()
{
element.scrollTop = element.scrollHeight;
}
var i = <?php echo $i; ?>;
function chat_ajax()
{
	var req = new XMLHttpRequest(); 
	req.onreadystatechange = function() 
							{ 
								if(req.readyState == 4 && req.status == 200)
								{
									document.getElementById('chat').innerHTML = req.responseText;
								
								} 
							} 
	req.open('GET', 'chat.php?q='+i, true); req.send(); 
}
 setInterval(function(){chat_ajax()}, 500) 
</script>
</div>
<form method="post" submit="chat_user1.php">
<input type = "text" name = "message">
<input type = "submit" value = "send" name="submit">
</form>

</body>
</html>