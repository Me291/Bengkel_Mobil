<?php
session_start();
$conn = new mysqli("localhost", "root", "", "service_car");

if (isset($_POST['Login'])) {
    // Assign input values to variables
    $sign_email = $_POST['Email'];
    $sign_password = $_POST['Password'];

    // Prepare and bind SQL statement
    $stmt = $conn->prepare("SELECT * FROM registrasi WHERE Email = ? AND Password = ?");
    $stmt->bind_param("ss", $sign_email, $sign_password);

    // Execute the statement
    $stmt->execute();

    // Get result
    $result = $stmt->get_result();

    // Check if there is a matching user
    if ($result->num_rows == 1) {
        // Fetch the user data
        $user_data = $result->fetch_assoc();

        // Assign user data to session
        $_SESSION['login'] = $user_data;

        // Redirect user to Home.php
        echo "<script>alert('Berhasil Login');</script>";
        echo "<meta http-equiv='refresh' content='1;url= User Form/User Page/User.php'>";
    } else {
        // Redirect user to Home.php
        echo "<script>alert('User Tidak Terdaftar!!!');</script>";
        echo "<meta http-equiv='refresh' content='1;url=Home.php'>";
    }

    // Close statement and connection
    $stmt->close();
    $conn->close();
}


require 'Database/dpesan.php';
if (isset($_POST['kirim'])) {
    if (registrasi($_POST) > 0) {
        echo "<script>
alert('Pesan berhasil ditambahkan!');
</script>";
        echo "<meta http-equiv='refresh' content='1;url = Home.php'>";
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
    <title>Home</title>
    <!-- font awesome cdn link  -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">

    <link rel="stylesheet" href="https://unpkg.com/swiper/swiper-bundle.min.css" />
    <!-- custom css link -->
    <link rel="stylesheet" href="Css/style.css">
    <link rel="stylesheet" href="Css/Css 2.css"> <!-- Ganti "style.css" dengan nama file CSS Anda -->
</head>

</head>

<body>

    <!-- header section starts -->

    <header class="header">

        <a href="#" class="logo"></i>Garage Car</a>

        <nav class="navbar">
            <a href="#home" class="hover-underline">home</a>
            <a href="#about" class="hover-underline">about</a>
            <a href="#teacher" class="hover-underline">Mekanik</a>
            <a href="#review" class="hover-underline">review</a>
            <a href="#contact" class="hover-underline">contact</a>
        </nav>

        <div class="icons">
            <div id="login-btn" class="fas fa-user"></div>
            <div id="menu-btn" class="fas fa-bars"></div>
        </div>

        <!-- login form -->
        <form action="" method="post" class="login-form">
            <h3>User Login</h3>
            <input type="email" placeholder="Nama" name="Email" class="box">
            <input type="password" placeholder="Password" name="Password" class="box">
            <button name="Login">
                <span class="text text-1">Login</span>
                <span class="text text-2" aria-hidden="true">Login</span>
            </button>
        </form>

    </header>

    <!-- header section ends -->

    <!-- home section starts-->

    <section class="home" id="home">

        <div class="content">
            <h3>Bengkel Terbaik Hanya Disini</h3>
            <p> Inilah tempat di mana keahlian bertemu kebutuhan, di sini solusi ditemukan untuk setiap tantangan
                kendaraan Anda</p>
            </p>
            <a href="User Form/Regis.php" class="button-link">
                <button name="Login">
                    <span class="text text-1">Daftar</span>
                    <span class="text text-2" aria-hidden="true">Daftar</span>
                </button>
            </a>

        </div>

    </section>

    <!-- home section ends -->

    <!-- about section starts -->

    <section class="about" id="about">

        <h1 class="heading">about us</h1>
        <div class="container">
            <figure class="about-image">
                <img src="https://images.unsplash.com/photo-1625047509168-a7026f36de04?q=80&w=1780&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D"
                    alt="" height="500">
                <img src="https://images.unsplash.com/photo-1625047509248-ec889cbff17f?q=80&w=1932&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D"
                    alt="" class="about-img">
            </figure>
            <div class="about-content">
                <h3>20 Tahun Melayani</h3>
                <p>Selamat datang di Bengkel Mobil Garage, destinasi terpercaya Anda untuk perawatan dan perbaikan
                    kendaraan. Sebagai pionir dalam layanan otomotif, kami berkomitmen untuk memberikan pengalaman
                    terbaik kepada pelanggan kami.
                    Sejak didirikan, Bengkel Mobil Garage telah menjadi pusat keahlian yang mengutamakan kualitas,
                    keandalan, dan kepuasan pelanggan. Kami memiliki tim terampil dan berpengalaman yang siap memberikan
                    solusi terbaik untuk setiap perawatan dan perbaikan mobil Anda.
                </p>
                <button name="Login">
                    <span class="text text-1">Read More</span>
                    <span class="text text-2" aria-hidden="true">Read More</span>
                </button>
            </div>

        </div>

    </section>

    <!-- about section ends -->

    <!-- subjects section starts -->

    <section class="subjects">
        <h1 class="heading">Melayani</h1>

        <div class="box-container">

            <div class="box">
                <img src="https://img.freepik.com/premium-vector/oil-can-icon-design-element-illustration_645658-108.jpg?w=740"
                    alt="">
                <h3>Ganti Oli Mobil</h3>
                <p>Kualitas Baik Harga Menarik</p>
            </div>

            <div class="box">
                <img src="https://img.freepik.com/premium-vector/racing-car-pit-stop_951778-11612.jpg?w=740" alt="">
                <h3>Service Kecil</h3>
                <p>Membuat Mobil Berkualitas Baik</p>
            </div>

            <div class="box">
                <img src="https://img.freepik.com/free-vector/auto-service-car-repair-icon-set-car-service-garage-big-collection-repair-maintenance-inspection-parts-units-elements_1150-65764.jpg?t=st=1714127002~exp=1714130602~hmac=ad3319d6bc4449738f5fef9ac5751086064f7379aec32f6259467d6db8bee0fb&w=740"
                    alt="">
                <h3>Pembelian Sparepart</h3>
                <p>Harga Merakyat Kualitas Anti Karat</p>
            </div>

            <div class="box">
                <img src="https://img.freepik.com/premium-vector/racing-car-pit-stop_951778-11575.jpg?w=740" alt="">
                <h3>Service Besar</h3>
                <p>Mobil Rusak Menjadi Layak</p>
            </div>

        </div>

    </section>

    <!-- subject section ends -->

    <!-- teacher section starts -->

    <section class="teacher" id="teacher">

        <h1 class="heading">Mekanik Handal</h1>

        <div class="box-container">

            <div class="box">
                <div class="image">
                    <img src="https://images.pexels.com/photos/279949/pexels-photo-279949.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=1"
                        alt="">
                    <div class="share">
                        <a href="#" class="fab fa-facebook-f"></a>
                        <a href="#" class="fab fa-twitter"></a>
                        <a href="#" class="fab fa-instagram"></a>
                    </div>
                </div>
                <div class="content">
                    <h3>john deo</h3>
                    <span>instructor</span>
                </div>
            </div>

            <div class="box">
                <div class="image">
                    <img src="https://images.pexels.com/photos/3807120/pexels-photo-3807120.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=1"
                        alt="">
                    <div class="share">
                        <a href="#" class="fab fa-facebook-f"></a>
                        <a href="#" class="fab fa-twitter"></a>
                        <a href="#" class="fab fa-instagram"></a>
                    </div>
                </div>
                <div class="content">
                    <h3>john deo</h3>
                    <span>instructor</span>
                </div>
            </div>

            <div class="box">
                <div class="image">
                    <img src="https://images.pexels.com/photos/3807329/pexels-photo-3807329.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=1"
                        alt="">
                    <div class="share">
                        <a href="#" class="fab fa-facebook-f"></a>
                        <a href="#" class="fab fa-twitter"></a>
                        <a href="#" class="fab fa-instagram"></a>
                    </div>
                </div>
                <div class="content">
                    <h3>john deo</h3>
                    <span>instructor</span>
                </div>
            </div>

            <div class="box">
                <div class="image">
                    <img src="https://images.pexels.com/photos/4489794/pexels-photo-4489794.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=1"
                        alt="">
                    <div class="share">
                        <a href="#" class="fab fa-facebook-f"></a>
                        <a href="#" class="fab fa-twitter"></a>
                        <a href="#" class="fab fa-instagram"></a>
                    </div>
                </div>
                <div class="content">
                    <h3>john deo</h3>
                    <span>instructor</span>
                </div>
            </div>
        </div>

    </section>

    <!-- teacher section ends -->

    <!-- review section starts -->

    <section class="review" id="review">

        <h1 class="heading">review konsumen</h1>

        <div class="swiper review-slider">

            <div class="swiper-wrapper">

                <div class="swiper-slide slide">
                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Praesentium laudantium distinctio
                        dolore molestias facilis velit pariatur maiores debitis inventore.</p>
                    <div class="wrapper">
                        <div class="separator"></div>
                        <div class="separator"></div>
                        <div class="separator"></div>
                        <div class="separator"></div>
                        <div class="separator"></div>
                    </div>
                    <i class="fas fa-quote-right"></i>
                    <div class="user">
                        <img src="images/review-1.png" alt="">
                        <div class="user-info">
                            <h3>john deo</h3>
                            <div class="stars">
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star-half-alt"></i>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="swiper-slide slide">
                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Praesentium laudantium distinctio
                        dolore molestias facilis velit pariatur maiores debitis inventore.</p>
                    <div class="wrapper">
                        <div class="separator"></div>
                        <div class="separator"></div>
                        <div class="separator"></div>
                        <div class="separator"></div>
                        <div class="separator"></div>
                    </div>
                    <i class="fas fa-quote-right"></i>
                    <div class="user">
                        <img src="images/review-2.png" alt="">
                        <div class="user-info">
                            <h3>john deo</h3>
                            <div class="stars">
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star-half-alt"></i>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="swiper-slide slide">
                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Praesentium laudantium distinctio
                        dolore molestias facilis velit pariatur maiores debitis inventore.</p>
                    <div class="wrapper">
                        <div class="separator"></div>
                        <div class="separator"></div>
                        <div class="separator"></div>
                        <div class="separator"></div>
                        <div class="separator"></div>
                    </div>
                    <i class="fas fa-quote-right"></i>
                    <div class="user">
                        <img src="images/review-3.png" alt="">
                        <div class="user-info">
                            <h3>john deo</h3>
                            <div class="stars">
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star-half-alt"></i>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="swiper-slide slide">
                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Praesentium laudantium distinctio
                        dolore molestias facilis velit pariatur maiores debitis inventore.</p>
                    <div class="wrapper">
                        <div class="separator"></div>
                        <div class="separator"></div>
                        <div class="separator"></div>
                        <div class="separator"></div>
                        <div class="separator"></div>
                    </div>
                    <i class="fas fa-quote-right"></i>
                    <div class="user">
                        <img src="images/review-4.png" alt="">
                        <div class="user-info">
                            <h3>john deo</h3>
                            <div class="stars">
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star-half-alt"></i>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="swiper-slide slide">
                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Praesentium laudantium distinctio
                        dolore molestias facilis velit pariatur maiores debitis inventore.</p>
                    <div class="wrapper">
                        <div class="separator"></div>
                        <div class="separator"></div>
                        <div class="separator"></div>
                        <div class="separator"></div>
                        <div class="separator"></div>
                    </div>
                    <i class="fas fa-quote-right"></i>
                    <div class="user">
                        <img src="images/review-5.png" alt="">
                        <div class="user-info">
                            <h3>john deo</h3>
                            <div class="stars">
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star-half-alt"></i>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="swiper-slide slide">
                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Praesentium laudantium distinctio
                        dolore molestias facilis velit pariatur maiores debitis inventore.</p>
                    <div class="wrapper">
                        <div class="separator"></div>
                        <div class="separator"></div>
                        <div class="separator"></div>
                        <div class="separator"></div>
                        <div class="separator"></div>
                    </div>
                    <i class="fas fa-quote-right"></i>
                    <div class="user">
                        <img src="images/review-6.png" alt="">
                        <div class="user-info">
                            <h3>john deo</h3>
                            <div class="stars">
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star-half-alt"></i>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

        </div>

    </section>

    <!-- review section ends -->

    <!-- contact section starts -->

    <section class="contact" id="contact">

        <h1 class="heading">contact us</h1>

        <div class="row">
            <div class="image">
                <img src="images/contact.png" alt="">
            </div>
            <form action="" method="post">
                <h3>send us a message</h3>
                <input type="text" placeholder="name" name="nama" class="box">
                <input type="email" placeholder="email" name="email" class="box">
                <input type="number" placeholder="phone number" name="no_telepon" class="box">
                <textarea placeholder="message" class="box" cols="30" name="pesan" rows="10"></textarea>
                <button name="kirim">
                    <span class="text text-1">send message</span>
                    <span class="text text-2" aria-hidden="true">send message</span>
                </button>
            </form>
        </div>

    </section>

    <!-- contact section ends -->

    <!-- footer section stars -->

    <section class="footer">

        <div class="box-container">

            <div class="box">
                <h3>find us here</h3>
                <p>Lorem, ipsum dolor sit amet consectetur adipisicing elit. Illum beatae.</p>
                <div class="share">
                    <a href="#" class="fab fa-facebook-f"></a>
                    <a href="#" class="fab fa-twitter"></a>
                    <a href="#" class="fab fa-instagram"></a>
                    <a href="#" class="fab fa-linkedin"></a>
                </div>
            </div>

            <div class="box">
                <h3>contact us</h3>
                <p>+1234 587 1478</p>
                <a href="#" class="link">ninjashub4@gmail.com</a>
            </div>

            <div class="box">
                <h3>localization</h3>
                <p>230 points of the pines <br>
                    colorado springs <br>
                    united states</p>
            </div>

        </div>
    </section>

    <!-- footer section ends -->
    <script src="https://unpkg.com/swiper/swiper-bundle.min.js"></script>
    <!-- custom js -->
    <script src="Js/script.js"></script>
</body>

</html>