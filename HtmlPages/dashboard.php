<?php
	include("../config/connectDB.php");
	session_start();
	$username = $_SESSION['username'];
	if(isset($_GET['chatUser']))
	{
		echo htmlspecialchars($_GET['chatUser']);
		$_SESSION['chatUser'] = $_GET['chatUser'];
		// echo $_SESSION['chatUser'];
		header("Location: chatPage.php");
	}
	if(isset($_POST['logoutButton']))
	{
		session_destroy();
		header("Location: ../index.php");
	}
	//echo $username;
	$searchName = '';
	if(isset($_GET['search_user_button']))
	{
		$searchName = mysqli_real_escape_string($conn, $_GET['search_user_text']);
	}
	$sql = "SELECT username from user where username like '%$searchName%' and username!='$username'";
	$result = mysqli_query($conn, $sql);
	$users = [];
	if(mysqli_num_rows($result) > 0)
	{
		$users = mysqli_fetch_all($result);
	}
	mysqli_free_result($result);
	//print_r($users);

?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>DashBoard</title>
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
	<link rel="stylesheet" href="../CSS/index_style.css">
	<link rel="stylesheet" href="../CSS/style.css">
</head>
<body>
	<form action="dashboard.php" method="GET">
		<input type="text" name="search_user_text">
		<input type="submit" name="search_user_button" value="Search">
		<table>
			<?php
				foreach($users as $user):
			?>
			<tr>
				<table>
					<tr>
						<input type="submit" name="chatUser" value="<?php echo htmlspecialchars($user[0]); ?>">
					</tr>
					<tr>
						<p>last message</p>
					</tr>
				</table>
			</tr>
			<?php
				endforeach;
			?>
		</table>
	</form>
	<form action="dashboard.php" method="POST">
		<input type="submit" name="logoutButton" value="Logout">
	</form>
</body>
</html>