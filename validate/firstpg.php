<!DOCTYPE html>
<html>
<head>
<style>

</style>
</head>
<body>
<div>
</div>
<?php
session_start();
$name = $_POST['user_name'];
$_SESSION['name'] = $name;
$email = $_POST['e-mail'];
$mobo = $_POST['mobo'];
$upassword = $_POST['password'];
$connection = mysqli_connect("localhost","root","secret","utter") or die("couldn't make a connection");
$query = "INSERT INTO user(`user-name`,`email`,`password`,`phone`) VALUES ('$name','$email','$upassword','$mobo')";
$result = mysqli_query($connection,$query);
ob_start();
header('Location: ../chatlistdata.php');
ob_end_flush();
die();
?>
<script>

</script>
</body>
</html>
