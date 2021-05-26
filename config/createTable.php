<?php
	include('connectDB.php');

	$sql = "CREATE table user (
		uid int unsigned AUTO_INCREMENT,
		email varchar(100),
		password varchar(100),
		username varchar(30),
		fname varchar(20),
		lname varchar(30),
		CONSTRAINT PK_user PRIMARY KEY(uid),
		CONSTRAINT UC_user UNIQUE(email),
		CONSTRAINT UC_user1 UNIQUE(username)
		)";

	if (mysqli_query($conn, $sql)) {
	  echo "Table user created successfully <br />";
	} else {
	  echo "Error creating table: " . mysqli_error($conn) . "<br />";
	}

	$sql = "CREATE table chat (
		cid int unsigned AUTO_INCREMENT,
		user1 int unsigned,
		user2 int unsigned,
		msg varchar(500),
		seen BOOLEAN,
		sent_time TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
		CONSTRAINT PK_chat PRIMARY KEY(cid),
		CONSTRAINT FK_chat1 FOREIGN KEY(user1) references user(uid),
		CONSTRAINT FK_chat2 FOREIGN KEY(user2) references user(uid)
		)";

	if (mysqli_query($conn, $sql)) {
	  echo "Table chat created successfully <br />";
	} else {
	  echo "Error creating table: " . mysqli_error($conn) . "<br />";
	}

	mysqli_close($conn);


?>