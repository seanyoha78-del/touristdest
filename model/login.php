<?php
session_start();
require 'config.php'; // Adjust the path if needed

if (isset($_POST['login'])) {
	$username = $_POST['username'];
	$password = $_POST['password'];

	$query = "SELECT * FROM admin_users WHERE username = ?";
	$stmt = mysqli_prepare($conn, $query);
	mysqli_stmt_bind_param($stmt, "s", $username);
	mysqli_stmt_execute($stmt);
	$result = mysqli_stmt_get_result($stmt);

	if ($row = mysqli_fetch_assoc($result)) {
		if (password_verify($password, $row['password'])) {
			$_SESSION['admin'] = $row['username'];
			header("Location: dashboard.php"); // Success
			exit();
		} else {
			$_SESSION['error'] = "Incorrect password.";
			header("Location: login.php"); // Redirect back to login
			exit();
		}
	} else {
		$_SESSION['error'] = "Username not found.";
		header("Location: login.php"); // Redirect back to login
		exit();
	}
}
?>
<h1><b><i>INCORRECT PASSWORD!</i></b></h1>
