<?php
session_start();
$conn = new mysqli("localhost", "root", "", "service_car");

$ambil = $conn->query("SELECT * FROM booking WHERE Id = '$_GET[Id]'");
$pecah = $ambil->fetch_assoc();

if (isset($_POST['kirim'])) {
    $nama = $_POST['nama'];
    $email = $_POST['email'];
    $no_telepon = $_POST['no_telepon'];
    $tanggal_booking = $_POST['tanggal_booking'];
    $jam_booking = $_POST['jam_booking'];
    $status = $_POST['status_booking']; // Ambil nilai status dari form

    // Validasi apakah email sudah digunakan
    $check_email = $conn->query("SELECT * FROM booking WHERE Email = '$email' AND Id != '$_GET[Id]'");
    if ($check_email->num_rows > 0) {
        echo "<script>alert('Email sudah digunakan!');</script>";
        echo "<meta http-equiv='refresh' content='0;url=../Admin Dashboard/Data Booking.php'>";
        exit(); // Keluar dari skrip karena validasi gagal
    }

    // Validasi apakah nomor telepon sudah digunakan
    $check_telepon = $conn->query("SELECT * FROM booking WHERE No_Telepon = '$no_telepon' AND Id != '$_GET[Id]'");
    if ($check_telepon->num_rows > 0) {
        echo "<script>alert('Nomor Telepon sudah digunakan!');</script>";
        echo "<meta http-equiv='refresh' content='0;url=../Admin Dashboard/Data Booking.php'>";
        exit(); // Keluar dari skrip karena validasi gagal
    }

    // Validasi apakah tanggal booking dan jam booking sudah digunakan
    $check_booking = $conn->query("SELECT * FROM booking WHERE Tanggal_Booking = '$tanggal_booking' AND Jam_Booking = '$jam_booking' AND Id != '$_GET[Id]'");
    if ($check_booking->num_rows > 0) {
        echo "<script>alert('Tanggal dan Jam Booking sudah digunakan!');</script>";
        echo "<meta http-equiv='refresh' content='0;url=../Admin Dashboard/Data Booking.php'>";
        exit(); // Keluar dari skrip karena validasi gagal
    }

    // Update data booking dan status
    $conn->query("UPDATE booking SET Nama = '$nama', Email = '$email', No_Telepon = '$no_telepon', Tanggal_Booking = '$tanggal_booking', Jam_Booking = '$jam_booking', Status = '$status' WHERE Id = '$_GET[Id]'");
    echo "<script>alert('Data Berhasil Dirubah');</script>";
    echo "<meta http-equiv='refresh' content='1;url=../Admin Dashboard/Data Booking.php'>";
}

?>



<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="../Css/Input.css">
    <script src="https://kit.fontawesome.com/c856ca633a.js" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.0/jquery.min.js"
        integrity="sha512-8Z5++K1rB3U+USaLKG6oO8uWWBhdYsM3hmdirnOEWp8h2B1aOikj5zBzlXs8QOrvY9OxEnD2QDkbSKKpfqcIWw=="
        crossorigin="anonymous"></script>
    <title>Dashboard</title>
</head>

<body>

    <!-- Sidebar -->
    <div class="sidebar">
        <a href="#" class="logo">
            <i class='bx bx-code-alt'></i>
            <div class="logo-name"><span>Bengkel</span>Grg</div>
        </a>
        <ul class="side-menu">
            <li><a href="../Admin Dashboard/Dashboard.php"><i class="fa-solid fa-house"
                        style="font-size: 20px;"></i>Dashboard</a></li>
            <li><a href="../Admin Dashboard/Data Admin.php"><i class="fa-solid fa-user"
                        style="font-size: 20px;"></i>Data Karyawan</a></li>
            <li><a href="../Admin Dashboard/Pesan.php"><i class="fa-solid fa-message"
                        style="font-size: 20px;"></i>Pesan</a></li>
            <li><a href="../Admin Dashboard/Data Booking.php"><i class="fa-solid fa-calendar-days"
                        style="font-size: 20px;"></i>Booking</a></li>
            <li><a href="../Admin Dashboard/Buat Nota.php"><i class="fa-solid fa-file-invoice"
                        style="font-size: 20px;"></i>Pembuatan Nota</a>
            </li>
            <li><a href="../Admin Dashboard/Invoice.php"><i class="fa-solid fa-file-invoice"
                        style="font-size: 20px;"></i>Info Pembayaran</a>
            </li>
        </ul>
        <ul class="side-menu">
            <a href="../Admin Dashboard/Log Out.php" class="logout">
                <i class="fa-solid fa-right-from-bracket" style="font-size: 20px;"></i>
                Logout
            </a>
        </ul>
    </div>
    <!-- End of Sidebar -->

    <!-- Main Content -->
    <div class="content">
        <!-- Navbar -->
        <nav>
            <i class='bx bx-menu'></i>
            <form action="#">
                <div class="form-input">
                    <input type="search" placeholder="Search...">
                    <button class="search-btn" type="submit"><i class='bx bx-search'></i></button>
                </div>
            </form>
            <input type="checkbox" id="theme-toggle" hidden>
            <label for="theme-toggle" class="theme-toggle"></label>
            <a href="#" class="profile">
                <img
                    src="https://images.unsplash.com/photo-1438761681033-6461ffad8d80?q=80&w=1770&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D">
            </a>
        </nav>

        <!-- End of Navbar -->

        <main>
            <!-- Insights -->
            <ul class="insights">
                <li>
                    <i class='bx bx-calendar-check'></i>
                    <span class="info">
                        <h3>
                            1,074
                        </h3>
                        <p>Paid Order</p>
                    </span>
                </li>
                <li><i class='bx bx-show-alt'></i>
                    <span class="info">
                        <h3>
                            3,944
                        </h3>
                        <p>Site Visit</p>
                    </span>
                </li>
                <li><i class='bx bx-line-chart'></i>
                    <span class="info">
                        <h3>
                            14,721
                        </h3>
                        <p>Searches</p>
                    </span>
                </li>
                <li><i class='bx bx-dollar-circle'></i>
                    <span class="info">
                        <h3>
                            $6,742
                        </h3>
                        <p>Total Sales</p>
                    </span>
                </li>
            </ul>
            <!-- End of Insights -->

            <div class="bottom-data">
                <div class="orders">
                    <div class="header">
                        <i class="fa-solid fa-envelopes-bulk"></i>
                        <h3>Tambah Data Karyawan</h3>
                        <i class='bx bx-filter'></i>
                        <i class='bx bx-search'></i>
                    </div>

                    <!-- Form untuk tambah data karyawan -->
                    <div class="add-form">
                        <form action="#" method="POST">
                            <div class="form-group">
                                <label for="nama">Nama:</label>
                                <input type="text" id="nama" name="nama" required value="<?php echo $pecah['Nama']; ?>">
                            </div>
                            <div class="form-group">
                                <label for="id_karyawan">Email:</label>
                                <input type="text" id="id_karyawan" name="email" required
                                    value="<?php echo $pecah['Email']; ?>">
                            </div>
                            <div class="form-group">
                                <label for="no_telepon">No Telepon:</label>
                                <input type="text" id="no_telepon" name="no_telepon" required
                                    value="<?php echo $pecah['No_Telepon']; ?>">
                            </div>
                            <div class="form-group">
                                <label for="ttl">Tanggal Booking:</label>
                                <input type="date" id="ttl" name="tanggal_booking" required
                                    value="<?php echo $pecah['Tanggal_Booking']; ?>">
                            </div>
                            <div class="form-group">
                                <label for="jam_booking">Jam Booking:</label>
                                <input type="time" id="jam_booking" name="jam_booking" required
                                    value="<?php echo $pecah['Jam_Booking']; ?>">
                            </div>
                            <div class="form-group">
                                <label for="Status Booking">Status:</label>
                                <select id="status_booking" name="status_booking" required>
                                    <option value="">Pilih Status</option> <!-- Opsi default untuk memilih -->
                                    <option value="Menunggu" <?php if ($pecah['Status'] == "Menunggu")
                                        echo "selected"; ?>>Menunggu</option>
                                    <option value="Belum Dikerjakan" <?php if ($pecah['Status'] == "Belum Dikerjakan")
                                        echo "selected"; ?>>Belum Dikerjakan</option>
                                    <option value="Selesai Dikerjakan" <?php if ($pecah['Status'] == "Selesai Dikerjakan")
                                        echo "selected"; ?>>Selesai Dikerjakan</option>
                                </select>
                            </div>

                            <div class="form-group">
                                <button name="kirim" type="submit">Update</button>
                            </div>
                        </form>
                    </div>
                    <!-- End of Form tambah data karyawan -->
                </div>
                <!-- End of Orders-->
            </div>
        </main>

    </div>

    <script src="../Js/Main.js"></script>
</body>

</html>