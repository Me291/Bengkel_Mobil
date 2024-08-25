<?php
session_start();

// Mengatur koneksi ke database
$conn = new mysqli("localhost", "root", "", "service_car");

// Memeriksa apakah form 'masuk' telah disubmit
if (isset($_POST['login'])) {
    // Mengambil nilai yang di-submit dari form
    $namaKaryawan = $_POST['nama_karyawan'];
    $idKaryawan = $_POST['id_karyawan'];

    // Membuat prepared statement untuk menghindari SQL injection
    $query = "SELECT * FROM data_karyawan WHERE nama_karyawan = ? AND id_karyawan = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("ss", $namaKaryawan, $idKaryawan);
    $stmt->execute();
    $result = $stmt->get_result();

    // Memeriksa jumlah baris yang cocok dengan kriteria pencarian
    if ($result->num_rows == 1) {
        // Jika ditemukan 1 baris, simpan data karyawan ke dalam session
        $row = $result->fetch_assoc();
        $_SESSION['data_karyawan'] = $row;
        echo "<script>alert('Berhasil Login');</script>";
        echo "<meta http-equiv='refresh' content='1;url= Admin Dashboard/Data Admin.php'>";
    } else {
        // Jika tidak ditemukan baris yang cocok, tampilkan pesan error
        echo "<script>alert('Karyawan Tidak Terdaftar!!!');</script>";
        echo "<meta http-equiv='refresh' content='1;url = Login Admin.php'>";
    }

    // Menutup prepared statement
    $stmt->close();
}

// Menutup koneksi ke database
$conn->close();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="Css/Login Admin.css">
    <title>Login Admin</title>
</head>

<body>
    <form action="" method="post">
        <div class="login-box">
            <div class="login-header">
                <header>LOGIN ADMIN</header>
            </div>
            <div class="input-box">
                <input type="text" name="nama_karyawan" class="input-field" placeholder="Nama Karyawan"
                    autocomplete="off" required>
            </div>
            <div class="input-box">
                <input type="password" name="id_karyawan" class="input-field" placeholder="Id Karyawan"
                    autocomplete="off" required>
            </div>
            <div class="input-submit">
                <button name="login" class="submit-btn" id="submit"></button>
                <label for="submit">Sign In</label>
            </div>
        </div>
    </form>
</body>

</html>