<?php
	include('../config/connectDB.php');
	if(isset($_POST['register']))
	{
		if(isset($_POST['email'])&&
			isset($_POST['username'])&&
			isset($_POST['password'])&&
			isset($_POST['confirmPassword'])&&
			isset($_POST['fname'])&&
			isset($_POST['lname']))
		{
			$email = mysqli_real_escape_string($conn, $_POST['email']);
			$username = mysqli_real_escape_string($conn, $_POST['username']);
			$password = mysqli_real_escape_string($conn, $_POST['password']);
			$confirmPassword = mysqli_real_escape_string($conn, $_POST['confirmPassword']);
			$fname = mysqli_real_escape_string($conn, $_POST['fname']);
			$lname = mysqli_real_escape_string($conn, $_POST['lname']);

			if($password != $confirmPassword)
			{
				echo "Passwords don't match";
			}
			else
			{
				if(!filter_var($email,FILTER_VALIDATE_EMAIL))
				{
					echo "Email id is in incorrect format";
				}
				else if(strlen($password)<6)
				{
					echo "password cannot be less than 6 characters";
				}
				else
				{
					$sql = "INSERT into user(email,password,username,fname,lname) values('$email','$password','$username','$fname','$lname');";
					if (mysqli_query($conn, $sql)) {
					 	header("Location: ../index.php");
					} else {
					  	echo "you can't register with this email/username"  . mysqli_error($conn) ;
					}
				}
				
			}
		}
		else
		{
			echo "all fields are required";
		}
	}
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Register</title>
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
	<link rel="stylesheet" href="../CSS/index_style.css">
	<link rel="stylesheet" href="../CSS/style.css">
</head>
<body>
	<form class="form-floating" action="register.php" method="POST">
		<table>
			<tr>
				<div class="input-group mb-3 textbox">
		  			<td>
		  				<span class="input-group-text" id="inputGroup-sizing-default">Email ID:</span>
		  			</td>
		  			<td>
		  				<input type="text" class="form-control" name="email">
		  			</td>
				</div>
			</tr>
			<tr>
				<div class="input-group mb-3 textbox">
		  			<td>
		  				<span class="input-group-text" id="inputGroup-sizing-default">First Name:</span>
		  			</td>
		  			<td>
		  				<input type="text" class="form-control" name="fname">
		  			</td>
				</div>
			</tr>
			<tr>
				<div class="input-group mb-3 textbox">
		  			<td>
		  				<span class="input-group-text" id="inputGroup-sizing-default">Last Name:</span>
		  			</td>
		  			<td>
		  				<input type="text" class="form-control" name="lname">
		  			</td>
				</div>
			</tr>
			<tr>
				<div class="input-group mb-3 textbox">
		  			<td>
		  				<span class="input-group-text" id="inputGroup-sizing-default">Username:</span>
		  			</td>
		  			<td>
		  				<input type="text" class="form-control" name="username">
		  			</td>
				</div>
			</tr>
			<tr>
				<div class="input-group mb-3 textbox">
		  			<td>
		  				<span class="input-group-text" id="inputGroup-sizing-default">Password:</span>
		  			</td>
		  			<td>
		  				<input type="password" class="form-control" name="password">
		  			</td>
				</div>
			</tr>
			<tr>
				<div class="input-group mb-3 textbox">
		  			<td>
		  				<span class="input-group-text" id="inputGroup-sizing-default">Confirm Password:</span>
		  			</td>
		  			<td>
		  				<input type="password" class="form-control" name="confirmPassword">
		  			</td>
				</div>
			</tr>
	</table>

	<div>
		<input id="register_button" type="submit" name="register" value="Register">
	</div>
		
	</form>
</body>
</html>