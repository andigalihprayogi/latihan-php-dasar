<?php 
session_start();
require 'function.php';

// cek cookie
if (isset($_COOKIE['id']) && isset($_COOKIE['key'])) {
	# code...
	$id = $_COOKIE['id'];
	$key = $_COOKIE['key'];

	// ambil username berdasarkan id
	$result = mysqli_query($conn, "SELECT username FROM user WHERE id = $id");

	$row = mysqli_fetch_assoc($result);

	if ($key === hash('sha256', $row['username'])) {
		$_SESSION['login'] = true;
	}

}

if (isset($_SESSION["login"])) {
	# code...
	header("Location: index.php");
}


if (isset($_POST["login"])) {

	$username = $_POST["username"];
	$password = $_POST["password"];

	$result = mysqli_query($conn, "SELECT * FROM user WHERE username = '$username'");

	// cek username

	if (mysqli_num_rows($result) === 1) {
		// cek password

		$row = mysqli_fetch_assoc($result);

		if (password_verify($password, $row["password"])) {
			// set session

			$_SESSION["login"] = true;

			// cek rememmber me

			if (isset($_POST['rememmber'])) {
				# code...
				setcookie('id', $row['id'], time() + 60);
				setcookie('key', hash('sha256', $row['username']), time() + 60);
			}


			header("Location: index.php");
			exit;
		}
	}

	$error = true;
}

 ?>

 <!DOCTYPE html>
 <html>
 <head>
 	<title>Halaman Login</title>
 </head>
 <body>
 	<h1>Halaman Login</h1>

 	<?php if (isset($error)): ?>
 		<p style="color: red; font-style: italic;">username / password salah</p>
 	<?php endif; ?>

 	<form action="" method="post">
 		<ul>
 			<li>
 				<label for="username">Username :</label>
 				<input type="text" name="username" id="username">
 			</li>
 			<li>
 				<label for="password">Password :</label>
 				<input type="password" name="password" id="password">
 			</li>
 			<li>
 				<input type="checkbox" name="rememmber" id="rememmber">
 				<label for="rememmber">rememmber me :</label>
 				
 			</li>
 			<li>
 				<button type="submit" name="login">login</button>
 			</li>
 		</ul>
 	</form>
 
 </body>
 </html>