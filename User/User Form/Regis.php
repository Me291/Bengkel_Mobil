<?php
    require '../Database/dregister.php';
    if(isset($_POST['Submit']))
    {
        if(registrasi($_POST) > 0)
        {
            echo "<script>
            alert('User baru telah berhasil ditambahkan!');
            </script>";
            echo "<meta http-equiv='refresh' content='1;url = ../Home.php'>";
        }  else {
            echo mysqli_error($conn);
        }
    }
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Responsive Form</title>
    <!--Google Font-->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500&display=swap" rel="stylesheet">
    <!--Stylesheet-->
    <link rel="stylesheet" href="../Css/Regis.css">
</head>
<body>
    <div class="container">
        <h1>Daftar Disini</h1>
        <p>Tempat Service Terpercaya Di Jakarta Mudah dan Cepat</p>
        <form action="" method="post">
            <div class="row">
                <div class="column">
                    <label for="name">Name</label>
                    <input type="text" id="name" name="Nama" placeholder="Masukan Nama Mu Disini">
                </div>
                <div class="column">
                    <label for="email">Email</label>
                    <input type="email" id="email" name="Email" placeholder="Masukan Email Mu Disini">
                </div>
            </div>
            <div class="row">
                <div class="column">
                    <label for="subject">Password</label>
                    <input type="password" id="subject" name="Password" placeholder="Masukan Password Mu Disini">
                </div>
                <div class="column">
                    <label for="contact">Konfirmasi Password</label>
                    <input type="password" id="contact" name="Konfirmasi_Password" placeholder="Masukan Konfirmasi Password">
                </div>
            </div>
            <button name="Submit">Submit</button>
        </form>
    </div>
</body>
</html>