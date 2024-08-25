<?php
session_start();
$conn = new mysqli("localhost", "root", "", "service_car");

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Convert | Export html Table to CSV & EXCEL File</title>
    <link rel="stylesheet" type="text/css" href="../../Css/Antrian.css">
</head>

<body>
    <main class="table" id="customers_table">
        <section class="table__header">
            <h1>Table Antrian</h1>
            <div class="input-group">
                <input type="search" placeholder="Search Data...">
                <img src="https://github.com/JeetSaru/Responsive-HTML-Table-With-Pure-CSS---Web-Design-UI-Design/blob/main/images/search.png?raw=true" alt="">
            </div>
        </section>
        <section class="table__body">
            <table>
                <thead>
                    <tr>
                        <th> Id </th>
                        <th> Nama </th>
                        <th> Email</th>
                        <th> No Telepon </th>
                        <th> Tanggal Booking </th>
                        <th> Jam Booking </th>
                        <th> Jenis Service </th>
                        <th> Lokasi Service </th>
                        <th> Status </th>
                    </tr>
                </thead>
                <tbody>
                    <?php $nomor = 1;
                    $ambil = $conn->query("SELECT * FROM booking");
                    while ($pecah = $ambil->fetch_assoc()) { ?>
                        <tr>
                            <td><?php echo $nomor; ?></td>
                            <td><?php echo $pecah['Nama']; ?></td>
                            <td><?php echo $pecah['Email']; ?></td>
                            <td><?php echo $pecah['No_Telepon']; ?></td>
                            <td><?php echo $pecah['Tanggal_Booking']; ?></td>
                            <td><?php echo date('H:i', strtotime($pecah['Jam_Booking'])); ?></td>
                            <td><?php echo $pecah['Jenis_Service']; ?></td>
                            <td><?php echo $pecah['Lokasi_Service']; ?></td>
                            <td><?php echo $pecah['Status']; ?></td>
                        </tr>
                        <?php $nomor++;
                    } ?>
                </tbody>
            </table>
        </section>
    </main>
    <script src="../../Js/Antrian.js"></script>

</body>

</html>