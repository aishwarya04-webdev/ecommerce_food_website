<?php  

session_start();

$connection=mysqli_connect("localhost","root","","ecommerce");

$name=$_SESSION['user'];
$id=$_GET['id'];

$sql_check="DELETE FROM temp_order WHERE email='$name' and itemid='$id'";
if(!mysqli_query($connection,$sql_check))
{
	echo "error".mysqli_error($connection);
	
}

echo "<script>window.location='menu.php';</script>";



?>