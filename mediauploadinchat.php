<?php
session_start();
$connection = mysqli_connect('localhost','root','secret','maps') or die("couldn't make any connection");
$type = $_POST['param'];
$eid = $_SESSION['eid'];
$uid = $_SESSION['uid'];
$fulleid = "event_".$eid;
echo $fulleid;
$target_dir = "media/".$fulleid."/".$type."/";
$target_file = $target_dir . basename($_FILES[$type]["name"]);
$uploadOk = 1;
setlocale(LC_ALL,'en_US.UTF-8');
$ext = pathinfo(basename($_FILES[$type]["name"]),PATHINFO_EXTENSION);
switch($type)
{
	case "image" : $t = 1; $pre = "Img_"; break;
	case "video" : $t = 2; $pre = "Vid_"; break;
	case "audio" : $t = 3; $pre = "Aud_"; break;
	case "document" : $t = 4; $pre = "Doc_"; break;
}
$query = "INSERT INTO ".$fulleid." (`uid`,`type`) VALUES ('".$uid."','".$t."')"; 
	 if($run = $connection->query($query))
	 {
		 echo "inserted";
		 $id = mysqli_insert_id($connection);
		 $query1 = "SELECT * FROM ".$fulleid." WHERE id = ".$id;
		 $run1 = mysqli_query($connection,$query1);
		 while($row1 = mysqli_fetch_assoc($run1))
		 {
			 $time = $row1['time'];
		 }
		$time = str_replace(" ","-",$time);
		$time = str_replace(":","-",$time);
		
		 $msg = "media/".$fulleid."/".$type."/".$pre.$time.".".$ext;
		 $query2 = "UPDATE ".$fulleid." SET `msg` = '$msg' WHERE `id`=".$id;
		 $run2 = mysqli_query($connection,$query2);
	 }
	else echo "not inserted";
// Check file size
if ($_FILES[$type]["size"] > 50000000000) {
    echo "Sorry, your file is too large.";
    $uploadOk = 0;
}
// Check if $uploadOk is set to 0 by an error
if ($uploadOk == 0) {
    echo "Sorry, your file was not uploaded.";
// if everything is ok, try to upload file
} else {
    if (move_uploaded_file($_FILES[$type]["tmp_name"], $target_file))
	{
        echo "The file ". basename( $_FILES[$type]["name"]). " has been uploaded.";
    } else 
	{
        echo "Sorry, there was an error uploading your file.";
    }
}
?>