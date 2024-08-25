<?php
$conn = mysqli_connect("localhost", "root", "", "service_car");

function registrasi($data)
{
    global $conn;

    // Melakukan escape terhadap nilai-nilai yang diambil dari form
    $username = mysqli_real_escape_string($conn, $data['Nama']);
    $email = mysqli_real_escape_string($conn, strtolower($data['Email']));
    $password = mysqli_real_escape_string($conn, $data['Password']);
    $password2 = mysqli_real_escape_string($conn, $data['Konfirmasi_Password']);

    // Memeriksa apakah username sudah terdaftar sebelumnya
    $result = mysqli_query($conn, "SELECT Nama FROM registrasi WHERE Nama = '$username'");
    if (mysqli_num_rows($result) > 0) {
        echo "<script>alert('Akun Sudah Terdaftar!');</script>";
        return false;
    }

    // Memeriksa apakah password dan konfirmasi password sesuai
    if ($password != $password2) {
        echo "<script>alert('Password tidak sesuai, Mohon cek kembali dengan benar');</script>";
        return false;
    }

    // Memasukkan data user ke dalam tabel 'data_user'
    $query = "INSERT INTO registrasi (Nama, Email, Password, Konfirmasi_Password) 
              VALUES ('$username', '$email', '$password','$password2')";
              
    if (mysqli_query($conn, $query)) {
        return mysqli_affected_rows($conn);
    } else {
        // Menampilkan pesan error jika terjadi kesalahan saat mengeksekusi query INSERT
        echo "Error: " . $query . "<br>" . mysqli_error($conn);
        return false;
    }
}
?>
