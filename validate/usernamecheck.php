<?php
$connection = mysqli_connect("localhost","root","secret","utter") or die("couldn't make a connection");
$found = 0;
$str = $_GET['q'];
$query = "SELECT user-name FROM user";
$result = mysqli_query($connection,$query);
while($row = mysqli_fetch_assoc($result))
{
	if($str == $row['user-name'])
	{
		echo "Name already taken. Please choose another one";
		$found = 1;
		break;
	}
}
 if ($found == 0)
 {
	echo "You've got this username";
 }
?>