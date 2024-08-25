<?php
session_start();
$conn = new mysqli("localhost", "root", "", "service_car");

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

            <!-- Laporan Keuangan -->
            <section class="financial-report">
                <h2>Laporan Keuangan</h2>
                <form method="POST" action="">
                    <label for="start-date">Start Date:</label>
                    <input type="date" id="start-date" name="start-date" required>
                    <label for="end-date">End Date:</label>
                    <input type="date" id="end-date" name="end-date" required>
                    <button type="submit">Submit</button>
                </form>
                <table>
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Keterangan</th>
                            <th>Tanggal</th>
                            <th>Nominal</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php

                        // Function to validate date format
                        function validateDate($date, $format = 'Y-m-d')
                        {
                            $d = DateTime::createFromFormat($format, $date);
                            return $d && $d->format($format) === $date;
                        }

                        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                            $start_date = $_POST['start-date'];
                            $end_date = $_POST['end-date'];

                            // Validate the date format
                            if (validateDate($start_date, 'Y-m-d') && validateDate($end_date, 'Y-m-d')) {
                                // Debug: output the received dates
                                echo "<tr><td colspan='4'>Start Date: $start_date, End Date: $end_date</td></tr>";

                                // Fetch data from the database
                                $query = "SELECT * FROM pembayaran WHERE tanggal_pembayaran BETWEEN '$start_date' AND '$end_date'";
                                $result = mysqli_query($conn, $query);

                                if ($result) {
                                    if (mysqli_num_rows($result) > 0) {
                                        $no = 1;
                                        while ($row = mysqli_fetch_assoc($result)) {
                                            echo "<tr>";
                                            echo "<td>" . $no . "</td>";
                                            echo "<td>" . $row['nama'] . "</td>";
                                            echo "<td>" . date('Y-m-d H:i:s', strtotime($row['tanggal_pembayaran'])) . "</td>";
                                            echo "<td>Rp " . number_format($row['jumlah_pembayaran'], 0, ',', '.') . "</td>";
                                            echo "</tr>";
                                            $no++;
                                        }
                                    } else {
                                        echo "<tr><td colspan='4'>No records found</td></tr>";
                                    }
                                } else {
                                    echo "<tr><td colspan='4'>Error: " . mysqli_error($conn) . "</td></tr>";
                                }
                            } else {
                                echo "<tr><td colspan='4'>Invalid date format. Please use YYYY-MM-DD.</td></tr>";
                            }
                        }
                        ?>
                    </tbody>
                </table>
            </section>
            <!-- End of Laporan Keuangan -->
        </main>

    </div>

    <script src="../Js/Main.js"></script>
</body>

</html>