<?php
session_start();

$connection=mysqli_connect("localhost","root","","ecommerce");

$name=$_SESSION['user'];


$sql_check="INSERT INTO bill(email) VALUES('$name')";
if(!mysqli_query($connection,$sql_check))
{
	echo "error".mysqli_error($connection);
	
}




$sql_billdet="SELECT max(bil_no) as billno FROM bill WHERE email='$name'";
if(!mysqli_query($connection,$sql_billdet))
{
	echo "error".mysqli_error($connection);
	
}
$get=mysqli_query($connection,$sql_billdet);
$val=mysqli_fetch_array($get);
$billdata= $val['billno'];

//get bill_det 

$sql_temp="SELECT * FROM temp_order WHERE email='$name'";
if(!mysqli_query($connection,$sql_temp))
{
	echo "error".mysqli_error($connection);
	
}
$rs=mysqli_query($connection,$sql_temp);
$count=mysqli_num_rows($rs);
$c=1;
while($c<=$count)
{
	$row_temp=mysqli_fetch_assoc($rs);
	$item=$row_temp['itemid'];
	$quant=$row_temp['qty'];
	$sql_det="INSERT INTO bill_det(bill_no,itemid,itemqty) VALUES('$billdata','$item','$quant')";
	if(!mysqli_query($connection,$sql_det))
{
	echo "error".mysqli_error($connection);
	
}
	
	$c++;
}

// delete temp_order

$sql_delete="DELETE FROM temp_order WHERE email='$name'";
	if(!mysqli_query($connection,$sql_delete))
{
	echo "error".mysqli_error($connection);
	
}

echo "<script>window.location='bill.php?bno=".$billdata."';</script>";


?>