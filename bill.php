<?php include 'header.php'?>

<div class="container-fluid text-center">

<?php
$connection=mysqli_connect("localhost","root","","ecommerce");

$name=$_SESSION['user'];
$billnum=$_GET['bno'];

$sql_check="SELECT * FROM bill WHERE bil_no='$billnum'";
if(!mysqli_query($connection,$sql_check))
{
	echo "error".mysqli_error($connection);
	
}
$rs=mysqli_query($connection,$sql_check);
$get=mysqli_fetch_assoc($rs);
echo '<h4>'.$get["bil_no"].'</h4>';
echo '<h4>'.$get["bill_date"].'</h4>';


$sql_check1="SELECT name,price,itemqty FROM item inner join bill_det ON item.id=bill_det.itemid WHERE bill_no='$billnum'";
if(!mysqli_query($connection,$sql_check1))
{
	echo "error".mysqli_error($connection);
	
}
$rs1=mysqli_query($connection,$sql_check1);
$n1=1;
$num1=mysqli_num_rows($rs1);

echo '<table border="1" width="70%">';
echo '<tr>';
echo '<th>Name</th>';
echo '<th>Price</th>';
echo '<th>Quantity</th>';
echo '<th>Sub Total</th>';
echo '</tr>';

$total=0;
while($n1<=$num1)
{
	$get1=mysqli_fetch_assoc($rs1);
	
	echo '<tr>';
	echo '<td>'.$get1["name"].'</td>';
	echo '<td>'.$get1["price"].'</td>';
	echo '<td>'.$get1["itemqty"].'</td>';
	echo '<td>'.$get1["price"]*$get1["itemqty"].'</td>';
	echo '</tr>';
	$n1++;
	$total=$total+($get1['price']*$get1['itemqty']);
}
echo '</table>';

echo " <h3> The total amount is Rs.".$total."</h3>";
?>


<form action="https://www.sandbox.paypal.com/cgi-bin/webscr" method="post">
<input type="hidden" name="business" value="b-aishwaryapanneer04@gmail.com">
<input type="hidden" name="cmd" value="_xclick">
<input type="hidden" name="item_name" value="order food menu">
<input type="hidden" name="amount" value="<?php  echo $total; ?>">
<input type="hidden" name="currency_code" value="INR">
<input type="image" name="submit" border="0" src="paypal.png" height="200px" width="200px">

</form>
</div>



<?php include 'footer.php'?>