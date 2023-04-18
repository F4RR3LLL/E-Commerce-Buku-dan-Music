<?php
// Memulai session pada PHP
session_start();
// Mengosongkan seluruh data pada $_SESSION
$_SESSION =[];
// Menghapus seluruh variabel session yang terdaftar
session_unset();
// Menghancurkan session yang aktif
session_destroy();
// Menghapus cookie id dan key dengan mengatur waktu kedaluwarsa cookie ke 1 jam yang lalu (dihapus)
setcookie('id','',time()-3600);
setcookie('key','',time()-3600);
// Mengarahkan pengguna kembali ke halaman login.php
header("Location: login.php");
exit;
?>