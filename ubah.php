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
// Mengambil nilai id dari parameter url dan menyimpannya dalam variabel $id dengan $_GET
$id = $_GET["id"];
// Mengambil data mahasiswa dari database berdasarkan id yang diberikan dan memilih data pertama menggunakan [0] untuk mengambil array asosiatif
$user = query("SELECT * FROM user WHERE id_user = $id")[0];
//Cek apakah tombol ubah sudah ditekan atau belum
if (isset($_POST["ubah"])) {
	//Jika sudah ditekan, jalankan fungsi ubah_user pada file functions.php dan cek apakah data berhasil ditambahkan atau tidak
	if (ubah($_POST) > 0) {
		//Jika berhasil, tampilkan pesan sukses dan redirect ke halaman utama
		echo "
				<script>
					alert('Data Berhasil Diubah');
					document.location.href='index.php';
				</script>
			";
	} else {
		//Jika berhasil, tampilkan pesan sukses dan redirect ke halaman utama
		echo "
				<script>
					alert('Data Gagal Diubah');
					document.location.href='index.php';
				</script>
			";
	}
}
?>

<!DOCTYPE html>

<head>
	<title>Ubah User</title>
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
		<input type="hidden" name="id" value="<?= $user["id_user"] ?>">
		<input type="hidden" name="gambarLama" value="<?= $user["foto"] ?>">
		<div class="input-group mb-3">
			<span class="input-group-text" id="inputGroup-sizing-default">Nama</span>
			<input type="text" class="form-control" name="name" required value="<?= $user["nama"] ?>" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default">
		</div>
		<div class="input-group mb-3">
			<span class="input-group-text" id="inputGroup-sizing-default">Username</span>
			<input type="text" class="form-control" name="username" required value="<?= $user["username"] ?>" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default">
		</div>
        <div class="input-group mb-3">
			<span class="input-group-text" id="inputGroup-sizing-default">Email</span>
			<input type="text" class="form-control" name="email" required value="<?= $user["email"] ?>" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default">
		</div>
		<div class="input-group mb-3">
			<span class="input-group-text" id="inputGroup-sizing-default">Foto</span>
			<input type="file" class="form-control" name="gambar" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default">
		</div>
		<div class="d-flex justify-content-center mt-3 login_container">
			<button type="submit" name="ubah" class="btn login_btn">Ubah Data</button>
		</div>
	</form>
</body>

</html>