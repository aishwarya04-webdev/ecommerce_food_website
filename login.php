<?php include'header.php'?>





<body>

<div class="row">
<div id="col1" class="col col-sm-6">

<form id="form1" method="post" action="login.php">

Mail-Id<br>
<input type="email" placeholder="ENTER THE mail-id" name="u_mail" required>
<br><br>

Password<br>
<input type="password" placeholder="ENTER YOUR PASSWORD" name="pass_name" required>
<br><br>

<a href="createaccount.php"><input type="button" class="bg-primary" value="Create an account"></a>
<br><br>
<a href="forgotpassword.php"><input type="button" class="bg-primary" value="Forgot Password"></a>
<br><br>
<input class="bg-success"type="submit" value="Login" name="loginn">
</form>

</div>

<div id="col2" class="col offset-sm-1 col-sm-5">

<p id="para1" ><i>No more getting stuck in traffic jams, paying for parking, standing in long queues and carrying heavy bags – get everything you need, when you need, right at your doorstep.</i></p>
<hr>
<img src="https://thumbs.dreamstime.com/b/online-grocery-store-online-grocery-store-shopping-people-cart-supermarket-baskets-online-market-app-vector-concept-157461867.jpg" alt="" width="550px" height="500px">

</div>

</div>

<?php 


if(isset($_POST['loginn']))
{
	$connection=mysqli_connect("localhost","root","","ecommerce");
	$email=$_POST['u_mail'];
	$password=$_POST['pass_name'];
	$sql_check="SELECT * FROM users WHERE email='$email' AND password='$password'";
	$res1=mysqli_query($connection,$sql_check);
if($res1)
{
	$res=mysqli_num_rows($res1);
}
if($res==0)
{
	echo "<script> alert('Login failed');</script>";
}
else
{
	$_SESSION['user']=$_POST['u_mail'];
	echo "<script> window.location='menu.php';</script>";
	
}
}












?>









<?php include'footer.php'?>