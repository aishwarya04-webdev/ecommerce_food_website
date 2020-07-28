<?php include 'header.php' ?>

<div class="container-fluid text-center">

<div class="row text-center">
<div class="col-sm-2">

<ul id="menulink">
<?php 

$connection=mysqli_connect("localhost","root","","ecommerce");
$sql="SELECT DISTINCT category FROM item";
if(!mysqli_query($connection,$sql))
{
	echo "error".mysqli_error($connection);
	
}
else
{
	$res=mysqli_query($connection,$sql);
	$num=mysqli_num_rows($res);
	$counts=1;
	while($counts<=$num)
	{
		$row=mysqli_fetch_assoc($res);
		echo ' <li><a  href="?cat='.$row["category"].'">'.$row["category"].'</a> </li>';
		$counts++;
		
	}
}

?>
</ul>
</div><!-- end of col 1  -->

<?php

if(!isset($_GET['cat']))
{
	$cats='biryani';
}
else
{
	$cats=$_GET['cat'];
}
$connection=mysqli_connect("localhost","root","","ecommerce");

$sql="SELECT * FROM item WHERE category = '$cats'";
if(!mysqli_query($connection,$sql))
{
	echo "error".mysqli_error($connection);
	
}
else
{
	$res=mysqli_query($connection,$sql);
	$num=mysqli_num_rows($res);
	$counts=1;
	while($counts<=$num)
	{
		$row=mysqli_fetch_assoc($res);
		echo '
             <div class="col-sm-1">

             <div class="thumbnail">
              <img src="'.$row["photo"].'" alt="" height="200px" width="300px">
              <p><strong>'.$row["name"].'</strong></p>
              <p><strong>Rs.'.$row["price"].'</strong></p>
              <a href="temp_order.php?id='.$row["ID"].'">Add</a>
              </div>
             </div><!--end of col2 -->
			 ';
		$counts++;
		
	}
}
?>
<div class="col-sm-7">
<table width="100%" class="table-responsive" border="1">
<tr>
<th>Name</th>
<th>Price</th>
<th>Qty</th>
<th>SubTotal</th>
<th>Remove</th>
</tr>

<?php


$connection=mysqli_connect("localhost","root","","ecommerce");
$name=$_SESSION['user'];
$sql="SELECT item.ID,name,price,qty FROM item inner join temp_order on item.ID=temp_order.itemid WHERE email='$name'";
if(!mysqli_query($connection,$sql))
{
	echo "error".mysqli_error($connection);
	
}
else
{
	$res=mysqli_query($connection,$sql);
	$num=mysqli_num_rows($res);
	$counts=1;
	$total=0;
	while($counts<=$num)
	{
		$row=mysqli_fetch_assoc($res);
		
		
		echo '<tr>';
		echo '<td>'.$row["name"].'</td>';
		echo '<td>'.$row["price"].'</td>';
		echo '<td>'.$row["qty"].'</td>';
		echo '<td>'.$row["price"]*$row["qty"].'</td>';
		echo '<td><a href="delete_item.php?id='.$row["ID"].'"><img src="delete.jpg" height="24px"></a></td>';
		echo '</tr>';
		$counts++;
	    $total=$total+($row["price"]*$row["qty"]);	
	}
	
}
 
?>
</table>
<?php

echo '<h3>Total Amount is Rs.'.$total.'</h3>';


?>
<form action="add_order.php">

<input type="submit" value="Order Now" class="btn btn-danger">
</form>

</div><!-- end of col3-->
</div><!--end of row -->

</div><!--end of container -->
<?php include 'footer.php' ?>