<?php
require '../../Database/dpembayaran.php';

if (isset($_POST['bayar'])) {
    if (registrasi($_POST) > 0) {
        echo "<script>
        alert('Pembayaran berhasil!');
        </script>";
        echo "<meta http-equiv='refresh' content='1;url=User.php'>";
    } else {
        echo mysqli_error($conn);
    }
}
?>



<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- custom css file link  -->
    <link rel="stylesheet" href="../../Css/Payment.css">
</head>

<body>

    <div class="container">

        <form action="" method="post">

            <div class="row">

                <div class="col">

                    <h3 class="title">billing address</h3>

                    <div class="inputBox">
                        <span>Nama :</span>
                        <input type="text" name="nama" placeholder="Input Nama Yang Sesuai" required>
                    </div>
                    <div class="inputBox">
                        <span>Email :</span>
                        <input type="email" name="email" placeholder="example@example.com" required>
                    </div>
                    <div class="inputBox">
                        <span>No Telepon :</span>
                        <input type="text" name="no_telepon" placeholder="+62xxxxxxxxxx" required>
                    </div>
                </div>

                <div class="col">

                    <h3 class="title">payment</h3>

                    <div class="inputBox">
                        <span>cards accepted :</span>
                        <img src="card_img.png" alt="Cards Accepted">
                    </div>
                    <div class="inputBox">
                        <span>Jumlah Yang Harus Dibayar :</span>
                        <input type="text" name="jumlah" placeholder="" required>
                    </div>
                    <div class="inputBox">
                        <span>Tanggal Pembayaran :</span>
                        <input type="date" name="tanggal_pembayaran" required>
                    </div>
                    <div class="inputBox">
                        <span>QRIS :</span>
                        <img src="QR.PNG"
                            alt="QRIS" style="width: 300px; height: 300px;">
                    </div>
                </div>
            </div>

            <input type="submit" name="bayar" value="Bayar" class="submit-btn">

        </form>

    </div>

</body>

</html>