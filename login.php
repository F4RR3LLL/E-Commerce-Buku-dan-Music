<?php

// Mengimpor file functions.php yang berisi definisi fungsi dan koneksi database
require 'function.php';
// Memulai sesi untuk penggunaan variabel global $_SESSION
session_start();

// Pengecekan apakah cookie sudah ter-set sebelumnya
if (isset($_COOKIE['id']) && isset($_COOKIE['key'])) {
	// Mengambil nilai cookie yang tersimpan
	$id = $_COOKIE['id'];
	$key = $_COOKIE['key'];
	// Query ke database untuk mengambil username dengan id yang didapat dari cookie
	$result = mysqli_query($conn, "SELECT username FROM user WHERE id ='$id'");
	$row = mysqli_fetch_assoc($result);
	// Mengecek apakah hash dari username sama dengan nilai key pada cookie
	if ($key === hash('sha256', $row['username'])) {
		// Jika sama, maka user dianggap sudah login dan session di-set
		$_SESSION['login'] = true;
	}
}

// Cek apakah user sudah login, jika sudah redirect ke halaman index
if (isset($_SESSION["login"])) {
	header("Location: index.php");
	exit;
}

// Jika tombol login ditekan, maka:
if (isset($_POST["login"])) {
	// Mengambil data username dan password dari form login
	$username = $_POST["username"];
	$password = $_POST["password"];
	// Menjalankan query pada tabel user untuk mengambil data user dengan username yang sesuai dengan inputan username
	$result = mysqli_query($conn, "SELECT * FROM user WHERE username = '$username'");
	// Jika query menghasilkan satu baris, maka:
	if (mysqli_num_rows($result) === 1) {
		// Mengambil data user dari hasil query
		$row = mysqli_fetch_assoc($result);
		// Melakukan verifikasi password
		if (password_verify($password, $row["password"])) {
			// Jika password benar, maka set session login menjadi true
			$_SESSION["login"] = true;
			//Jika checkbox remember me di-check, maka set cookie
			if (isset($_POST['remeber'])) {
				// Membuat cookie dengan nama 'id' dan nilai id user yang sedang login
				setcookie('id', $row['id'], time() + 60);
				// Membuat cookie dengan nama 'key' dan nilai hash sha256 dari username user yang sedang login
				setcookie('key', hash('sha256', $row['username']), time() + 120);
			}
			// Redirect ke halaman index.php
			header("Location: index.php");
			exit;
		} else {
			// Jika password salah, maka set variabel error menjadi true
			$error = true;
		}
	} else {
		// Jika username tidak ditemukan di database, maka set variabel 
		$error = true;
	}
}

?>



<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,400&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="fonts/icomoon/style.css">

    <link rel="stylesheet" href="css/owl.carousel.min.css">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="css/bootstrap.min.css">
    
    <!-- Style -->
    <link rel="stylesheet" href="css/style.css">

    <title>Login</title>
  </head>
  <body>
  

  <div class="d-lg-flex half">
    <div class="bg order-1 order-md-2" style="background-image: url('images/buku-dan-album-musik.jpg');"></div>
    <div class="contents order-2 order-md-1">
      
  <?php if (isset($error)) : ?>
							<!-- Jika variabel $error telah di-set oleh kode sebelumnya, maka akan menampilkan pesan kesalahan pada halaman web. -->
							<p style="color: red; font-style: italic;">username / password salah</p>
							<!-- Syntax endif digunakan untuk menutup blok kondisi IF di baris sebelumnya. -->
						<?php endif; ?>

      <div class="container">
        <div class="row align-items-center justify-content-center">
          <div class="col-md-7">
            <div class="mb-4">
              <h3>Login</h3>
              <p class="mb-4"></p>
            </div>
            <form action="" method="post">
              <div class="form-group first">
                <label for="username">Username</label>
                <input type="text" class="form-control" name="username">

              </div>
              <div class="form-group last mb-3">
                <label for="password">Password</label>
                <input type="password" class="form-control" name="password">
                
              </div>
              
              <div class="d-flex mb-5 align-items-center">
                <label class="control control--checkbox mb-0"><span class="caption">Remember me</span>
                  <input type="checkbox" checked="checked"/>
                  <div class="control__indicator"></div>
                </label>
                <span class="ml-auto"><a href="index" class="forgot-pass">Lupa Password</a></span> 
              </div>

              <button type="submit" name="login" class="btn btn-block btn-primary">Login</button>

              <span class="d-block text-center my-4 text-muted">&mdash; or &mdash;</span>
              
              <div class="social-login">
                <a href="#" class="facebook btn d-flex justify-content-center align-items-center">
                  <span class="icon-facebook mr-3"></span> Login with Facebook
                </a>
                <a href="#" class="twitter btn d-flex justify-content-center align-items-center">
                  <span class="icon-twitter mr-3"></span> Login with  Twitter
                </a>
                <a href="#" class="google btn d-flex justify-content-center align-items-center">
                  <span class="icon-google mr-3"></span> Login with  Google
                </a>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>

    
  </div>
    
    <script src="js/jquery-3.3.1.min.js"></script>
    <script src="js/popper.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/main.js"></script>
  </body>
</html>