<?php

if (isset($_POST['signup-submit'])) {
	
	require 'dbh.inc.php';

	$username = $_POST['username'];
	$email = $_POST['mail'];
	$status = $_POST['status'];
	
	$password = $_POST['pwd'];
	$passrep = $_POST['pwd-rep'];

	echo $username;

	if (empty($username) || empty($email) || empty($password) || empty($passrep) || empty($status)) {
		header("Location: ../signup.php?error=emptyfields&username=".$username."&mail=".$email);
		exit();
	}
	else if (!filter_var($email, FILTER_VALIDATE_EMAIL) && (!preg_match("/^[a-zA-Z0-9]*$/", $username))) {
		header("Location: ../signup.php?error=invalidmail&username");
		exit();
	}
	else if(!filter_var($email, FILTER_VALIDATE_EMAIL)) {
		
		header("Location: ../signup.php?error=invalidmail&mail=".$email);
		exit();
	}
	else if(!preg_match("/^[a-zA-Z0-9]*$/", $username)) {
		
		header("Location: ../signup.php?error=invalidusername=".$username);
		exit();
	}
	else if ($password !== $passrep) {
		header("Location: ../signup.php?error=emptyfields&username=".$username."&mail=".$email);
		exit();
	}
	else {

		$sql = "SELECT username FROM users WHERE username=?";
		$stmt = mysqli_stmt_init($conn);
		if (!mysqli_stmt_prepare($stmt, $sql)) {
			header("Location: ../signup.php?error=sqlerr");
		exit();
		}
		else {
			mysqli_stmt_bind_param($stmt, "s", $username);
			mysqli_stmt_execute($stmt);
			mysqli_stmt_store_result($stmt);
			$result = mysqli_stmt_num_rows($stmt);
			if ($result > 0) {
				header("Location: ../signup.php?error=usertaken&mail=".$email);
		    exit();
			}
			else {
				$sql = "INSERT INTO users (usertype, username, email, password, cart, history) VALUES(?, ?, ?, ?, ?, ?)";
				$stmt = mysqli_stmt_init($conn);
				if (!mysqli_stmt_prepare($stmt, $sql)) {
					header("Location: ../signup.php?error=sqlerr");
				exit();
				}
				else {

                   $hashedPwd = password_hash($password, PASSWORD_DEFAULT);
                   $cart = $history = "";
					mysqli_stmt_bind_param($stmt, "ssssss", $status, $username, $email, $hashedPwd, $cart, $history);
					mysqli_stmt_execute($stmt);
					mysqli_stmt_store_result($stmt);
					header("Location: ../signup.php?signup=success");
					exit();
				}
			}
		}
	}
	mysqli_stmt_close($stmt);
	mysqli_close($conn);
}

else {
	header("Location: ../signup.php");
	exit();

}