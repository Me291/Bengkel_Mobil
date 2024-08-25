<?php
session_start();
$conn = new mysqli("localhost", "root", "", "service_car");

// Pastikan bahwa pengguna benar-benar ingin menghapus barang
if (isset($_GET['halaman']) && $_GET['halaman'] == "hapus barang" && isset($_GET['id']) && isset($_GET['id_user'])) {
    // Ambil ID barang dan ID pengguna dari URL
    $id_barang = $_GET['id'];
    $id_pengguna = $_GET['id_user'];

    // Lakukan proses penghapusan data barang dari database
    $hapus_barang = $conn->prepare("DELETE FROM data_barang WHERE id = ? AND id_user = ?");
    $hapus_barang->bind_param("ii", $id_barang, $id_pengguna);
    $hapus_barang->execute();

    // Redirect kembali ke halaman tampil barang setelah penghapusan
    header("Location: Tampil Barang.php?id=$id_pengguna");
    exit; // Pastikan untuk keluar dari skrip setelah melakukan redirect
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
                        <h3>Tampil Barang</h3>
                        <i class='bx bx-filter'></i>
                        <i class='bx bx-search'></i>
                    </div>
                    <table>
                        <thead>
                            <tr>
                                <th>Id</th>
                                <th>Nama Barang</th>
                                <th>Merk</th>
                                <th>Jumlah</th>
                                <th>Harga</th>
                                <th>Harga Total</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $nomor = 1;
                            // Ambil ID pengguna dari URL
                            if (isset($_GET['id'])) {
                                $id_pengguna = $_GET['id'];

                                // Ambil data barang dari tabel data_barang berdasarkan ID pengguna
                                $ambil_barang = $conn->prepare("SELECT * FROM data_barang WHERE id_user = ?");
                                $ambil_barang->bind_param("i", $id_pengguna);
                                $ambil_barang->execute();
                                $result_barang = $ambil_barang->get_result();

                                while ($pecah_barang = $result_barang->fetch_assoc()) {
                                    // Hitung harga total
                                    $harga_total = $pecah_barang['jumlah'] * $pecah_barang['harga'];
                                    // Format harga total menjadi Rupiah
                                    $harga_total_rupiah = "Rp " . number_format($harga_total, 0, ',', '.');
                                    ?>
                                    <tr>
                                        <td><?php echo $nomor; ?></td>
                                        <td><?php echo $pecah_barang['nama_barang']; ?></td>
                                        <td><?php echo $pecah_barang['merk']; ?></td>
                                        <td><?php echo $pecah_barang['jumlah']; ?></td>
                                        <td><?php echo "Rp " . number_format($pecah_barang['harga'], 0, ',', '.'); ?></td>
                                        <td><?php echo $harga_total_rupiah; ?></td> <!-- Kolom harga total -->
                                        <td>
                                            <button class="edit-button"><a
                                                    href="../Update/Update Data Barang.php?halaman=ubah barangk&id=<?php echo $pecah_barang['id']; ?>">Edit</a></button>
                                            <button class="delete-button"><a
                                                    href="Tampil Barang.php?halaman=hapus barang&id=<?php echo $pecah_barang['id']; ?>&id_user=<?php echo $id_pengguna; ?>">Hapus</a></button>
                                        </td>
                                    </tr>
                                    <?php $nomor++;
                                }
                            }
                            ?>
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