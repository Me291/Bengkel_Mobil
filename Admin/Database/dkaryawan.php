<?php
$conn = mysqli_connect("localhost", "root", "", "service_car");

function registrasi($data)
{
    global $conn;

    $username = mysqli_real_escape_string($conn, $data['nama']);
    $id_admin = mysqli_real_escape_string($conn, $data['id_karyawan']);
    $jeniskelamin = mysqli_real_escape_string($conn, $data['jenis_kelamin']);
    $ttl = mysqli_real_escape_string($conn, $data['ttl']);
    $alamat = mysqli_real_escape_string($conn, $data['alamat']);
    $no_telpon = mysqli_real_escape_string($conn, $data['no_telepon']);
    
    // Check if username, Id_Admin, and No_Telepon already exist
    $result_username = mysqli_query($conn, "SELECT nama_karyawan FROM data_karyawan WHERE nama_karyawan = '$username'");
    $result_id_admin = mysqli_query($conn, "SELECT id_karyawan FROM data_karyawan WHERE id_karyawan = '$id_admin'");
    $result_no_telpon = mysqli_query($conn, "SELECT no_telepon FROM data_karyawan WHERE no_telepon = '$no_telpon'");

    if (mysqli_fetch_assoc($result_username)) {
        echo "<script>alert('Nama sudah digunakan. Silakan gunakan Nama lain.');</script>";
        return false;
    }
    if (mysqli_fetch_assoc($result_id_admin)) {
        echo "<script>alert('Id_Admin sudah digunakan. Silakan gunakan Id_Admin lain.');</script>";
        return false;
    }
    if (mysqli_fetch_assoc($result_no_telpon)) {
        echo "<script>alert('No Telepon sudah digunakan. Silakan gunakan No Telepon lain.');</script>";
        return false;
    }

    // If everything is fine, proceed with the registration
    mysqli_query($conn, "INSERT INTO data_karyawan (nama_karyawan, id_karyawan, jenis_kelamin, ttl, alamat, no_telepon) VALUES ('$username', '$id_admin','$jeniskelamin','$ttl', '$alamat','$no_telpon')");
    return mysqli_affected_rows($conn);
}
?>
