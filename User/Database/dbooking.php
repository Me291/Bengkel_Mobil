<?php
$conn = mysqli_connect("localhost", "root", "", "service_car");

function booking($data)
{
    global $conn;

    // Melakukan escape terhadap nilai-nilai yang diambil dari form
    $username = mysqli_real_escape_string($conn, $data['Nama']);
    $email = mysqli_real_escape_string($conn, strtolower($data['Email']));
    $no_telepon = mysqli_real_escape_string($conn, $data['No_Telepon']);
    $date = mysqli_real_escape_string($conn, $data['Date']);
    $time = mysqli_real_escape_string($conn, $data['Jam_Booking']);
    $jenis_service = mysqli_real_escape_string($conn, $data['Jenis_Service']);
    $lokasi_service = mysqli_real_escape_string($conn, $data['Lokasi_Service']);
    $alamat_rumah = mysqli_real_escape_string($conn, $data['Alamat_Rumah']);

    // Memeriksa apakah username sudah terdaftar sebelumnya
    $result_username = mysqli_query($conn, "SELECT Nama FROM booking WHERE Nama = '$username'");
    if (mysqli_num_rows($result_username) > 0) {
        echo "<script>alert('Nama Pengguna Sudah Terdaftar!');</script>";
        return false;
    }

    // Memeriksa apakah email sudah terdaftar sebelumnya
    $result_email = mysqli_query($conn, "SELECT Email FROM booking WHERE Email = '$email'");
    if (mysqli_num_rows($result_email) > 0) {
        echo "<script>alert('Email Sudah Terdaftar!');</script>";
        return false;
    }

    // Memeriksa apakah nomor telepon sudah terdaftar sebelumnya
    $result_telepon = mysqli_query($conn, "SELECT No_Telepon FROM booking WHERE No_Telepon = '$no_telepon'");
    if (mysqli_num_rows($result_telepon) > 0) {
        echo "<script>alert('Nomor Telepon Sudah Terdaftar!');</script>";
        return false;
    }

    // Memeriksa apakah jam booking sudah terdaftar sebelumnya pada tanggal yang sama
    $result_jam = mysqli_query($conn, "SELECT Jam_Booking FROM booking WHERE Tanggal_Booking = '$date' AND Jam_Booking = '$time'");
    if (mysqli_num_rows($result_jam) > 0) {
        echo "<script>alert('Jam Booking pada Tanggal Tersebut Sudah Terdaftar!');</script>";
        return false;
    }

    // Memeriksa apakah alamat rumah sudah terdaftar sebelumnya
    $result_alamat = mysqli_query($conn, "SELECT Alamat_Rumah FROM booking WHERE Alamat_Rumah = '$alamat_rumah'");
    if (mysqli_num_rows($result_alamat) > 0) {
        echo "<script>alert('Alamat Rumah Sudah Terdaftar!');</script>";
        return false;
    }

    // Memasukkan data user ke dalam tabel 'booking'
    $query = "INSERT INTO booking (Nama, Email, No_Telepon, Tanggal_Booking, Jam_Booking, Jenis_Service, Lokasi_Service, Alamat_Rumah) 
              VALUES ('$username', '$email', '$no_telepon', '$date', '$time', '$jenis_service', '$lokasi_service', '$alamat_rumah')";
              
    if (mysqli_query($conn, $query)) {
        return mysqli_affected_rows($conn);
    } else {
        // Menampilkan pesan error jika terjadi kesalahan saat mengeksekusi query INSERT
        echo "Error: " . $query . "<br>" . mysqli_error($conn);
        return false;
    }
}
?>
