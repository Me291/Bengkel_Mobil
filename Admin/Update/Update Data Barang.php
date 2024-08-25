<?php
session_start();
$conn = new mysqli("localhost", "root", "", "service_car");

// Periksa apakah variabel $pecah tidak null sebelum digunakan
if (isset($_GET['id'])) {
    $ambil = $conn->query("SELECT * FROM data_barang WHERE id = '$_GET[id]'");
    $pecah = $ambil->fetch_assoc();
}

// Validasi input agar tidak ada karyawan lain dengan id_karyawan, nama, dan no_telepon yang sama
if (isset($_POST['kirim'])) {
    $nama_barang = $_POST['nama_barang'];
    $merk = $_POST['merk_barang'];
    $jumlah = $_POST['jumlah'];
    $harga = $_POST['harga']; // Tambah titik koma di sini

    // Jika semua validasi berhasil, update data karyawan
    $query_update = "UPDATE data_barang SET nama_barang = '$nama_barang', merk = '$merk', jumlah = '$jumlah', harga ='$harga' WHERE id = '$_GET[id]'";
    if ($conn->query($query_update) === TRUE) {
        echo "<script>alert('Data Berhasil Dirubah');</script>";
        echo "<meta http-equiv='refresh' content='1;url = ../Admin Dashboard/Buat Nota.php'>";
    } else {
        echo "Error updating record: " . $conn->error;
    }
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
                        <h3>Ubah Data Karyawan</h3>
                        <i class='bx bx-filter'></i>
                        <i class='bx bx-search'></i>
                    </div>

                    <!-- Form untuk tambah data karyawan -->
                    <div class="add-form">
                        <form action="#" method="POST">
                            <div class="form-group">
                                <label for="nama">Nama:</label>
                                <input type="text" id="nama" name="nama_barang" required
                                    value="<?php echo $pecah['nama_barang']; ?>">
                            </div>
                            <div class="form-group">
                                <label for="id_karyawan">Merk Barang:</label>
                                <input type="text" id="id_karyawan" name="merk_barang" required
                                    value="<?php echo $pecah['merk']; ?>">
                            </div>
                            <div class="form-group">
                                <label for="ttl">Jumlah:</label>
                                <input type="text" id="ttl" name="jumlah" required
                                    value="<?php echo $pecah['jumlah']; ?>">
                            </div>
                            <div class="form-group">
                                <label for="no_telepon">Harga:</label>
                                <input type="text" id="no_telepon" name="harga" required
                                    value="<?php echo $pecah['harga']; ?>">
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