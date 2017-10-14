<head>
<style>
#chatlist {
	width:20%;
	
	overflow:auto;
	border: 1px solid black;
	border-radius:5px 5px;
	height:70%;
	position:fixed;
}
#chatname {
	width:100%;
	padding:3% 5%;
	border-bottom:1px solid #efefef;
}
#chatname:hover {
	cursor:pointer;
	background-color:#efefef;
}
.initial {
	height:100%;
	width:100%;
	padding:20px 20px;
	font:30px;
}
.bubble {
	padding:5px 5px 5px 5px;
	height:auto;
	border-radius:8px 8px;
	background-color:#404040;
	color:#fff;
	float:right;
	clear:both;
	text-align:left;
}
.bottom_fixed {
	position:fixed;
	bottom:20px;
}
.image_buttons {
	height:25px;
	width:25px;
}
.chat_image {
	height:50px;
	width:50px;
	float:right;
	clear:both;
}
</style>
</head>
<body>
<div id="chatlist">
			<?php 
			if(isset($_POST['add_person_id']))
			{
				$query = "INSERT INTO euid VALUES(".$_POST['add_person_id'].",".$eid.")";
				$result = mysqli_query($connection,$query);
				if($result)
				{
					echo "inserted";
				}
				echo $_POST['add_person_id']."is the person you added";
			}
			 $query = "SELECT * FROM event_".$eid." ORDER BY id"; 
			 $result = mysqli_query($connection,$query);		 //if the chat has begin ie there is atleast one message
			 if(mysqli_num_rows($result) > 0)
			 {
			 while($row = mysqli_fetch_assoc($result))
			 {
			 if($row['type'] == 1)
				{
					$address = $row['msg'];
					echo "<span class='bubble'>".$row['msg']."</span><br>";
					echo "<img class='chat_image' src='".$row['msg']."'>";
				}
				else
					echo "<span class='bubble'>".$row['msg']."</span><br>".$row['time']."<br><br>";
			 $i = $row['ID'];
			 }
			 }
			 else 
			 {
				 echo "<span class='initial'>Add people to your event to start a chat</span>";
			 }
			?>
		<div id="chat"></div>
		<?php
		$query6 = "SELECT id from user where name = '".$_SESSION['name']."'";
		$result6 = mysqli_query($connection,$query6);
		while ($row6 = mysqli_fetch_assoc($result6))
		{
			$uid = $row6['id'];
		}
		 if(isset($_POST['submit']))
		 {
			 $message = $_POST['message'];
			 $query = "INSERT INTO event_".$eid." (`uid`,`msg`) VALUES ('$uid','$message')"; 
			 $run = $connection->query($query); 
		 } 
		 else echo "not inserted";
		 $_SESSION['eid'] = $eid;
		 $_SESSION['uid'] = $uid;
		?>
		<script> 
function getMessage(x) //uploading medias
{
	document.getElementById("demo2").innerHTML = x;
	var form = document.getElementById("form1");
	var formdata =new FormData(form);
	formdata.append("param", x);
	var req = new XMLHttpRequest(); 
	req.onreadystatechange = function() 
							{ 
								if(req.readyState == 4 && req.status == 200)
								{
									document.getElementById('demo3').innerHTML = req.responseText;
								
								} 
							} 
	req.open('POST', 'mediauploadinchat.php', true); 
	req.send(formdata);
}
		var element = document.getElementById("chatlist");
		 function scrolldown()
		{
		element.scrollTop = element.scrollHeight;
		}
		var i = <?php echo $i; ?>;
		function chat_ajax()
		{
			var req1 = new XMLHttpRequest(); 
			req1.onreadystatechange = function() 
									{ 
										if(req1.readyState == 4 && req1.status == 200)
										{
											document.getElementById('chat').innerHTML = req1.responseText;
										
										} 
									} 
			req1.open('GET', 'chats.php?q='+i, true); req1.send(); 
		}
		 setInterval(function(){chat_ajax()}, 500) 
		</script>
</div>
<div class="bottom_fixed">
<form method="post" submit="chat_user1.php">
	<input type = "text" name = "message">
	<input type = "image" value = "send" src="send-icon.png" alt="submit" width="20" style="height:20px width:20px;border-radius:30px 30px;" name="submit">
</form>
<a href="validate/logout.php">logout</a>
<form action="mediauploadinchat.php" id="form1" method="post" enctype="multipart/form-data">
	<img src="image-icon.png" class="image_buttons" id="iicon">
	<input style="display:none" id="imagebutn" type="file" name="image" onchange="getMessage('image');" accept="image/*" multiple />
	<img src="video-icon.png" class="image_buttons" id="vicon">
	<input style="display:none" id="video" name="video" type="file" accept="video/*" onchange="getMessage('video');" multiple />
	<img src="audio-icon.png" class="image_buttons" id="aicon">
	<input style="display:none" id="audio" name="audio" type="file" accept="audio/*" onchange="getMessage('audio');" multiple />
	<img src="documents-icon.png" class="image_buttons" id="dicon">
	<input style="display:none" id="document" name="document" type="file" onchange="getMessage('document');" accept="application/*,message/*,text/*" multiple/>
</form>
<script>
	var ibut = document.getElementById("iicon");
	var iput = document.getElementById("imagebutn");
	var vbut = document.getElementById("vicon");
	var vput = document.getElementById("video");
	var abut = document.getElementById("aicon");
	var aput = document.getElementById("audio");
	var dbut = document.getElementById("dicon");
	var dput = document.getElementById("document");
	ibut.addEventListener('click', function (e) 
	{
    e.preventDefault();
    iput.click();
	});
	vbut.addEventListener('click', function (e) 
	{
    e.preventDefault();
    vput.click();
	});
	abut.addEventListener('click', function (e) 
	{
    e.preventDefault();
    aput.click();
	});
	dbut.addEventListener('click', function (e) 
	{
    e.preventDefault();
    dput.click();
	});
</script>
</div>		
</body>
</html>