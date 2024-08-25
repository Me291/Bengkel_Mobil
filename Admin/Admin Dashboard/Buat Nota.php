<?php
session_start();
$conn = new mysqli("localhost", "root", "", "service_car");

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Hapus data dari tabel invoice berdasarkan id
    $delete_invoice = mysqli_query($conn, "DELETE FROM `invoice` WHERE `id`= '$id'");

    // Hapus data dari tabel data_barang yang memiliki id_user yang sesuai
    $delete_barang = mysqli_query($conn, "DELETE FROM `data_barang` WHERE `id_user`= '$id'");

    // Periksa apakah kedua operasi penghapusan berhasil
    if ($delete_invoice && $delete_barang) {
        echo "<script>alert('Data Berhasil Dihapus');</script>";
        echo "<meta http-equiv='refresh' content='1;url= Buat Nota.php'>";
    } else {
        // Jika salah satu atau kedua operasi penghapusan gagal
        echo "<script>alert('Gagal menghapus data');</script>";
        echo "<meta http-equiv='refresh' content='1;url= Buat Nota.php'>";
    }
}

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="../Css/Data Admin.css">
    <script src="https://kit.fontawesome.com/c856ca633a.js" crossorigin="anonymous"></script>
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
            <li><a href="Dashboard.php"><i class="fa-solid fa-house" style="font-size: 20px;"></i>Dashboard</a></li>
            <li><a href="Data Admin.php"><i class="fa-solid fa-user" style="font-size: 20px;"></i>Data Karyawan</a></li>
            <li><a href="Pesan.php"><i class="fa-solid fa-message" style="font-size: 20px;"></i>Pesan</a></li>
            <li><a href="Data Booking.php"><i class="fa-solid fa-calendar-days" style="font-size: 20px;"></i>Booking</a>
            </li>
            <li><a href="Buat Nota.php"><i class="fa-solid fa-file-invoice" style="font-size: 20px;"></i>Pembuatan
                    Nota</a></li>
            <li><a href="Invoice.php"><i class="fa-solid fa-money-bill" style="font-size: 20px;"></i>Info Pembayaran</a>
            </li>
        </ul>


        <ul class="side-menu">
            <li>
                <a href="Log Out.php" class="logout">
                    <i class="fa-solid fa-right-from-bracket" style="font-size: 20px;"></i>
                    Logout
                </a>
            </li>
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
            <div class="header">
                <a href="../Input/Input Nota.php" class="report">
                    <span>Tambah Data</span>
                    <i class="fa-solid fa-plus"></i>
                </a>
            </div>

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
                        <h3>Pembuatan Nota</h3>
                        <i class='bx bx-filter'></i>
                        <i class='bx bx-search'></i>
                    </div>
                    <table>
                        <thead>
                            <tr>
                                <th>Id</th>
                                <th>Nama</th>
                                <th>Email</th>
                                <th>No Telepon</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $nomor = 1;
                            $ambil = $conn->query("SELECT * FROM invoice");
                            while ($pecah = $ambil->fetch_assoc()) { ?>
                                <tr>
                                    <td><?php echo $nomor; ?></td>
                                    <td><?php echo $pecah['nama']; ?></td>
                                    <td><?php echo $pecah['email']; ?></td>
                                    <td><?php echo $pecah['no_telepon']; ?></td>
                                    <td>
                                        <button class="edit-button">
                                            <a
                                                href="../Update/Update Invoice.php?halaman=ubah karyawank&id=<?php echo $pecah['id'] ?>">Edit</a>
                                        </button>
                                        <button class="delete-button">
                                            <a
                                                href="Buat Nota.php?halaman=hapus data_nota&id=<?php echo $pecah['id'] ?>">Hapus</a>
                                        </button>
                                        <button class="nota-button">
                                            <a
                                                href="Tampil Nota.php?halaman=tampil data_nota&id=<?php echo $pecah['id'] ?>">Buat
                                                Nota</a>
                                        </button>
                                        <button class="tambah-button">
                                            <a
                                                href="../Input/Input Barang.php?halaman=tambah_barangk&id=<?php echo $pecah['id'] ?>">Tambah</a>
                                        </button>
                                        <button class="lihat-button">
                                            <a
                                                href="Tampil Barang.php?halaman=lihat_barang&id=<?php echo htmlspecialchars($pecah['id']); ?>">Lihat</a>
                                        </button>
                                    </td>
                                </tr>
                                <?php $nomor++;
                            } ?>
                        </tbody>
                    </table>
                </div>


                <!-- End of Reminders-->

            </div>

        </main>

    </div>

    <script src="../Js/Main.js"></script>
</body>

</html>