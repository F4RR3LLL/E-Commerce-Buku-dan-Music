<?php
// Mengimpor file functions.php yang berisi definisi fungsi dan koneksi database
require 'function.php';
// Memulai sesi untuk penggunaan variabel global $_SESSION
session_start();
// Cek apakah variabel session "login" sudah di-set, jika belum maka user akan di-redirect ke halaman login
if (!isset($_SESSION["login"])) {
	header("Location: login.php");
	exit;
}
//Cek apakah tombol register sudah ditekan atau belum
if (isset($_POST["register"])) {
	//Jika sudah ditekan, jalankan fungsi tambah_user pada file functions.php dan cek apakah data berhasil ditambahkan atau tidak
	if (tambah($_POST) > 0) {
		//Jika berhasil, tampilkan pesan sukses dan redirect ke halaman utama
		echo "
			<script>
				alert('Data Berhasil Disimpan');
				document.location.href='index.php';
			</script>
		";
	} else {
		//Jika gagal, tampilkan pesan gagal dan redirect ke halaman utama
		echo "
			<script>
				alert('Data Gagal Disimpan');
				document.location.href='index.php';
			</script>
		";
	}
}
?>

<!DOCTYPE html>

<head>
	<title>Tambah User</title>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.1/css/all.css" integrity="sha384-gfdkjb5BdAXd+lj+gudLWI+BXq4IuLW5IT+brZEZsLFm++aCMlF1V92rMkPaX4PP" crossorigin="anonymous">
	<link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
	<script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
	<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
	<style>
	</style>
</head>

<body>
	<ul class="nav nav-tabs">
		<li class="nav-item">
			<a class="nav-link active" aria-current="page" href="index.php">User</a>
		</li>
		<li class="nav-item">
			<a class="nav-link" href="#">Produk</a>
		</li>
		<li class="nav-item">
			<a class="nav-link" href="#">Transaksi</a>
		</li>
	</ul>
	<br>
	<br>
	<form action="" method="post" enctype="multipart/form-data">
        <div class="input-group mb-3">
            <span class="input-group-text" id="inputGroup-sizing-default">Username</span>
            <input type="text" class="form-control" name="username" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default">
        </div>
		<div class="input-group mb-3">
			<span class="input-group-text" id="inputGroup-sizing-default">Nama</span>
			<input type="text" class="form-control" name="nama" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default">
		</div>
		<!-- <div class="input-group mb-3">
			<span class="input-group-text" id="inputGroup-sizing-default">Password</span>
			<input type="password" class="form-control" name="password" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default">
		</div> -->
        <div class="input-group mb-3">
			<span class="input-group-text" id="inputGroup-sizing-default">Email</span>
			<input type="text" class="form-control" name="email" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default">
		</div>
		<div class="input-group mb-3">
			<span class="input-group-text" id="inputGroup-sizing-default">Foto</span>
			<input type="file" class="form-control" name="gambar" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default">
		</div>
		<div class="d-flex justify-content-center mt-3 login_container">
			<button type="submit" name="register" class="btn login_btn">Register</button>
		</div>
	</form>
</body>

</html>