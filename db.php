<?php
// Mendefinisikan parameter koneksi ke database MySQL
$host = "localhost"; // Nama host untuk server MySQL (localhost biasanya untuk development)
$user = "root"; // Username yang digunakan untuk login ke server MySQL
$pass = ""; // Password untuk login ke server MySQL (kosong jika tidak ada password)
$db = "perpustakaan"; // Nama database yang digunakan, dalam hal ini 'perpus'

// Membuat objek koneksi menggunakan MySQLi (MySQL Improved)
$koneksi = new mysqli($host, $user, $pass, $db);

// Mengecek apakah koneksi berhasil
if ($koneksi->connect_error) {
  // Jika terjadi error saat koneksi, tampilkan pesan error dan hentikan eksekusi
  die("Koneksi gagal: " . $koneksi->connect_error);
}
