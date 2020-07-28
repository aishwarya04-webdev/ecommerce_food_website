<?php include'header.php'?>





<center>
<form action="createaccount.php" method="post">

<input type="email" class="form-control" placeholder="enter your mail-id" name="u_mail" style="width:35%" required></br>
<input type="password" class="form-control" placeholder="enter your password" name="u_pass" style="width:35%" required></br>
<input type="password" class="form-control" placeholder="confirm your password" name="u_conpass" style="width:35%" required></br>
<input type="text" class="form-control" placeholder="enter your name" name="u_name" style="width:35%" required></br>
<input type="number" class="form-control" placeholder="enter your mobile number" name="u_num" style="width:35%" required></br>
<input type="text" class="form-control" placeholder="enter your country" name="u_cont" style="width:35%" required></br>
<input type="submit" class="btn btn-danger" value="Sign Up" name="signupp">
</form>

</center>
<?php 

if(isset($_POST['signupp']))
{
	if($_POST['u_pass']==$_POST['u_conpass']){
$connection=mysqli_connect("localhost","root","","ecommerce");
$mail=$_POST['u_mail'];
$password=$_POST['u_pass'];
$name=$_POST['u_name'];
$mobile=$_POST['u_num'];
$country=$_POST['u_cont'];
$sql="INSERT INTO users (email,password,name,mobile,country) VALUES ('$mail','$password','$name','$mobile','$country')";
if(!mysqli_query($connection,$sql))
{
	echo "error".mysqli_error($connection);
}	
$_SESSION['user']=$_POST['u_mail'];
	echo "<script> window.location='menu.php';</script>";
}
else
{
	echo "<script> alert('password didnt match');</script>";
}
}
?>

<?php include'footer.php'?>