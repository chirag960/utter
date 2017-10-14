<?php
session_start();
$connection = mysqli_connect('localhost','root','secret','maps') or die("couldn't make any connection");
$eid = $_SESSION['eid'];
$uid = $_SESSION['uid'];
$id=$_GET["q"];
 $query = "SELECT * FROM event_".$eid." WHERE `ID` > '".$id."' ORDER BY id"; 
 $run = $connection->query($query); 
 while($row = $run->fetch_array()) : 
?>

<span><?php 
if($row['type'] == 1)
{
	$address = $row['msg'];
	echo "<span class='bubble'>".$row['msg']."</span><br>";
	echo "<img class='chat_image' src='".$row['msg']."'>";
}
else
	echo "<span class='bubble'>".$row['msg']."</span><br>".$row['time']."<br><br>";
?>
</span>

<?php endwhile; ?>
