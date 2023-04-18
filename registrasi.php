<?php
//koneksi db
require 'function.php';
//tombol cari d'klik
if (isset($_POST["register"])) {
	if (registrasi($_POST) > 0) {
		echo "
			<script>
				alert('Reagistrasi Berhasil');
				document.location.href='login.php';
			</script>
		";
	}else{
		echo mysqli_error($conn);
	}
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Halaman Registrasi</title>
	<style>
		label{
			display: block;
		}
	</style>
</head>
<body>
	<h1>Halaman Registrasi</h1>
	<form action="" method="post">
		<ul>
			<li>
				<label for="username">Username :</label>
				<input type="text" name="username" id="username" require autocomplete="off">
			</li>
			<li>
				<label for="password">Password :</label>
				<input type="password" name="password" require id="password">
			</li>
			<li>
				<label for="password2">Konfirmasi Password :</label>
				<input type="password" name="password2" require id="password2">
			</li>
			<li>
				<button type="submit" name="register">Register</button>
			</li>
		</ul>
	</form>
</body>
</html>