<?php  

session_start();

$connection=mysqli_connect("localhost","root","","ecommerce");

$name=$_SESSION['user'];
$id=$_GET['id'];

$sql_check="SELECT * FROM temp_order WHERE email='$name' and itemid='$id'";
if(!mysqli_query($connection,$sql_check))
{
	echo "error".mysqli_error($connection);
	
}
$res=mysqli_query($connection,$sql_check);
$num=mysqli_num_rows($res);


if($num==0){
	

$sql="INSERT INTO temp_order(email,itemid)VALUES('$name','$id')";
if(!mysqli_query($connection,$sql))
{
	echo "error".mysqli_error($connection);
	
}
}


else
{
	$sql="UPDATE temp_order SET qty=qty+1 WHERE email='$name'";
if(!mysqli_query($connection,$sql))
{
	echo "error".mysqli_error($connection);
	
}
	
	
	
}
echo "<script>window.location='menu.php';</script>";



?>