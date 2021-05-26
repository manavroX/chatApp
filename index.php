<?php
	include('config/connectDB.php');
	if(isset($_POST['register']))
	{
		header('Location: HtmlPages/register.php');
	}
	if(isset($_POST['signin']))
	{
		$email = mysqli_real_escape_string($conn, $_POST['email']);
		$password = mysqli_real_escape_string($conn, $_POST['password']);
		$sql = "SELECT password,username from user where email = '$email'";
		$result = mysqli_query($conn, $sql);
		if(mysqli_num_rows($result)!=0)
		{
			$actualPassArr = mysqli_fetch_assoc($result);
			$actualPass = $actualPassArr['password'];
			$username = $actualPassArr['username'];
			if($password===$actualPass)
			{
				session_start();
				$_SESSION['username'] = $username;
				header('Location: HtmlPages/dashboard.php');
			}
		}
	}
?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">

	<title>Chat App</title>

	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
	<link rel="stylesheet" href="CSS/index_style.css">

</head>
<body>
	<div class="login-box">
		<form class="form-floating" action="index.php" method="POST">
			<h1>Login</h1>
			<div class="textbox">
				<input type="text" class="form-control" name="email" placeholder="email">
			</div>
			<div class="textbox">
				<input type="password" class="form-control" name="password" placeholder="Passsword">
			</div>
			<div>
				<input type="submit" class="buttons" name="signin" value="Sign In">
			</div>
			<div>
				<input type="submit" class="buttons" name="register" value="Register">
			</div>
		</form>
	</div>
</body>
</html>