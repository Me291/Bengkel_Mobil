<?php
$conn = mysqli_connect("localhost", "root", "", "service_car");

function registrasi($data)
{
    global $conn;

    $nama = mysqli_real_escape_string($conn, $data['nama']);
    $email = strtolower(stripslashes($data['email']));
    $no_telepon = mysqli_real_escape_string($conn, $data['no_telepon']);
    $jumlah = mysqli_real_escape_string($conn, $data['jumlah']);
    $tanggal_pembayaran = mysqli_real_escape_string($conn, $data['tanggal_pembayaran']);

    // Pastikan jumlah kolom dan nilai sesuai
    $query = "INSERT INTO pembayaran (nama, email, no_telepon, tanggal_pembayaran, jumlah_pembayaran) 
              VALUES ('$nama', '$email', '$no_telepon', '$tanggal_pembayaran', '$jumlah')";

    mysqli_query($conn, $query);
    return mysqli_affected_rows($conn);
}
?>
