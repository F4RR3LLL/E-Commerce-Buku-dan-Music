<?php 

require 'function.php';
session_start();

// Cek apakah variabel session "login" sudah di-set, jika belum maka user akan di-redirect ke halaman login
if (!isset($_SESSION["login"])) {
	header("Location: login.php");
	exit;
}


// Deklarasi variabel untuk menentukan jumlah data yang akan ditampilkan pada setiap halaman
$jumlahDataPerHalaman = 2;
// Menghitung jumlah data yang ada di database
$jumlahData = count(query("SELECT * FROM user"));
// Menghitung jumlah halaman yang diperlukan
$jumlahHalaman = ceil($jumlahData / $jumlahDataPerHalaman);
// Menentukan halaman aktif saat ini, jika tidak ada parameter halaman di URL maka halaman aktif = 1
$halamanAktif = (isset($_GET["halaman"])) ? $_GET["halaman"] : 1;
// Menentukan awal data yang akan ditampilkan pada halaman aktif
$awalData = ($jumlahDataPerHalaman * $halamanAktif) - $jumlahDataPerHalaman;
// Mengambil data user dari database sesuai dengan halaman aktif dan jumlah data per halaman
$user = query("SELECT * FROM user LIMIT $awalData, $jumlahDataPerHalaman");


?>

<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>DATA</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
  </head>
  <body>

    <nav class="navbar navbar-expand-lg navbar-light bg-light">

  <div class="collapse navbar-collapse" id="navbarNav">
    <ul class="navbar-nav">
      <li class="nav-item active">
        <a class="nav-link" href="#">User</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="#">Produksi</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="#">Transaksi</a>
      </li>
    </ul>
  </div>
</nav>
  

<br>
	<br>
	<!-- Jika halaman aktif lebih besar dari 1 maka akan menampilkan tombol untuk ke halaman sebelumnya -->
	<?php if ($halamanAktif > 1) : ?>
		<a href="?halaman=<?= $halamanAktif - 1 ?>">&laquo;</a>
	<?php endif; ?>
	<!-- Perulangan for digunakan untuk menampilkan link ke semua halaman yang ada -->
	<?php for ($i = 1; $i <= $jumlahHalaman; $i++) : ?>
		<?php if ($i == $halamanAktif) : ?>
			<!-- // Jika nomor halaman sama dengan halaman aktif maka akan menampilkan nomor halaman dengan warna merah dan bold -->
			<a href="?halaman=<?= $i; ?>" style="font-weight: bold; color: red;"><?= $i; ?></a>
		<?php else : ?>
			<!-- // Jika nomor halaman tidak sama dengan halaman aktif maka akan menampilkan nomor halaman biasa tanpa style -->
			<a href="?halaman=<?= $i; ?>"><?= $i; ?></a>
		<?php endif; ?>
	<?php endfor; ?>
	<!-- Jika halaman aktif kurang dari jumlah halaman maka akan menampilkan tombol untuk ke halaman selanjutnya -->
	<?php if ($halamanAktif < $jumlahHalaman) : ?>
		<a href="?halaman=<?= $halamanAktif + 1 ?>">&raquo;</a>
	<?php endif; ?>
	<br>


 <table class="table">
		<thead class="table-dark">
			<tr>
				<th>No. </th>
				<th>Username</th>
				<th>Nama</th>
       			<th>Password</th>
        		<th>Email</th>
				<th>Gambar</th>
				<th>Aksi</th>
				
			</tr>
		</thead>
		
		<tbody>
			<br>
	<a class="btn btn-outline-primary" href="tambah.php">Tambah Data</a>
	<a class="btn btn-outline-danger" href="logout.php">Logout</a>
	<br>
	<br>
			<!-- Inisialisasi variabel $i dengan nilai 1, kemudian melakukan looping dengan foreach untuk setiap data user pada array $user. -->
			<?php $i = 1; ?>
			<!-- Untuk setiap data user, dibuat sebuah baris tabel (<tr>) yang berisi nomor urut ($i ditambah $awalData), nama user, dan username. -->
			<?php foreach ($user as $row) : ?>
				<tr>
					<!-- Kemudian variabel $i ditambah 1 untuk menambah nomor urut pada baris selanjutnya. -->
					<td><?= $i + $awalData ?></td>
					<td><?= $row["username"]; ?></td>
					<td><?= $row["nama"]; ?></td>
					<td><?= $row["password"]; ?></td>
					<td><?= $row["email"]; ?></td>
					<td><img src="images/<?= $row["gambar"]; ?>" width="100"></td>
					<td>
						<a class="btn btn-outline-primary btn-sm" href="ubah.php?id=<?= $row["id_user"]; ?>">Ubah</a> |
						<a class="btn btn-outline-danger btn-sm"  href="hapus.php?id=<?= $row["id_user"]; ?>" onclick="return confirm('Yakin');">Hapus</a>
					</td>
				</tr>
				<?php $i++; ?>
			<?php endforeach; ?>
		</tbody>
	</table>
  </body>
</html>
