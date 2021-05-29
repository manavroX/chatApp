<?php
	include('../config/connectDB.php');
	session_start();
	$user1 = $_SESSION['username'];
	$user2 = $_SESSION['chatUser'];
	//dkhbfiberfbhe
	$sql = "SELECT uid from user where username='$user1'";
	$result = mysqli_query($conn, $sql);
	$useridArr = mysqli_fetch_assoc($result);
	$userid1 = $useridArr['uid'];
	mysqli_free_result($result);
	$sql = "SELECT uid from user where username='$user2'";
	$result = mysqli_query($conn, $sql);
	$useridArr2 = mysqli_fetch_assoc($result);
	$userid2 = $useridArr2['uid'];
	mysqli_free_result($result);
	// echo $userid1;
	// echo $userid2;
	// echo "user1 = $user1 <br>";
	// echo "user2 = $user2 <br>";
	if(isset($_POST['back']))
	{
		header('Location: dashboard.php');
	}

	if(isset($_POST['enter']))
	{
		if($_POST['message']!='')
		{
			$sendMsg =mysqli_real_escape_string($conn, $_POST['message']);
			//echo $sendMsg;

			$sql = "INSERT into chat(user1,user2,msg,seen) values($userid1,$userid2,'$sendMsg',false);";
			if (mysqli_query($conn, $sql)) {
			} 
			else {
			  	echo "Please check your connection" . mysqli_error($conn) . "<br />";
			}
		}
	}
	$sql = "SELECT msg,user1 from chat where
	 		(user1 = $userid1 and user2 = $userid2)
	 		or
	 		(user2 = $userid1 and user1 = $userid2) 
	 		order by sent_time desc;";
	$result = mysqli_query($conn, $sql);
	$msgArr = [];
	if(mysqli_num_rows($result) > 0)
	{
		$msgArr = mysqli_fetch_all($result);
	}
	
	mysqli_free_result($result);
	//print_r($msgArr);
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Chat</title>
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
	<link rel="stylesheet" href="../CSS/index_style.css">
	<link rel="stylesheet" href="../CSS/style.css">
</head>
<body>
	<form action="chatPage.php" method="POST">
		<input type="submit" name="back" value=back>
	</form>
	<table class="chatbox">
		<?php
			foreach ($msgArr as $msg):
		?>
			<tr>
				<?php
					if($msg[1]==$userid2):
				?>
					<td class="recieved">
				<?php
					else:
				?>
					<td class="sent">
				<?php
					endif;
				?>
					<?php
						echo $msg[0];
					?>
				</td>
			</tr>
		<?php
			endforeach;
		?>
		<!-- <tr>
			<td class="recieved">
				abc
			</td>
		</tr>
		<tr>
			<td class="sent">
				def
			</td>
		</tr> -->
	</table>
	<form action="chatPage.php" method="POST">
		<input type="text" name="message">
		<input type="submit" name="enter" value="Send">
	</form>
</body>
</html>