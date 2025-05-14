<?php
header("Content-Type: application/json");
require 'db.php';

$method = $_SERVER['REQUEST_METHOD'];

switch ($method) {
  case 'GET':
    // Ambil semua data dari tabel buku
    $sql = "SELECT * FROM buku";
    $result = $koneksi->query($sql);
    $data = [];
    while ($row = $result->fetch_assoc()) {
      $data[] = $row;
    }
    echo json_encode($data);
    break;

  case 'POST':
    // Tambah data baru
    $input = json_decode(file_get_contents("php://input"), true);
    $judul = $input['judul'];
    $penulis = $input['penulis'];
    $tahun_terbit = $input['tahun_terbit'];
    $sql = "INSERT INTO buku (judul, penulis, tahun_terbit) VALUES ('$judul', '$penulis', '$tahun_terbit')";
    if ($koneksi->query($sql)) {
      echo json_encode(['status' => true, 'message' => 'Data berhasil ditambahkan']);
    } else {
      echo json_encode(['status' => false, 'message' => 'Gagal menambahkan data']);
    }
    break;

  case 'PUT':
    // Edit data berdasarkan ID
    $input = json_decode(file_get_contents("php://input"), true);
    $id = $input['id'];
    $judul = $input['judul'];
    $penulis = $input['penulis'];
    $tahun_terbit = $input['tahun_terbit'];
    $sql = "UPDATE buku SET judul='$judul', penulis='$penulis', tahun_terbit='$tahun_terbit' WHERE id=$id";
    if ($koneksi->query($sql)) {
      echo json_encode(['status' => true, 'message' => 'Data berhasil diedit']);
    } else {
      echo json_encode(['status' => false, 'message' => 'Gagal mengedit data']);
    }
    break;

  case 'DELETE':
    // Hapus data berdasarkan ID
    $input = json_decode(file_get_contents("php://input"), true);
    $id = $input['id'];
    $sql = "DELETE FROM buku WHERE id=$id";
    if ($koneksi->query($sql)) {
      echo json_encode(['status' => true, 'message' => 'Data berhasil dihapus']);
    } else {
      echo json_encode(['status' => false, 'message' => 'Gagal menghapus data']);
    }
    break;

  default:
    // Jika method tidak dikenali
    http_response_code(405);
    echo json_encode(['error' => 'Method Not Allowed']);
    break;
}
