<?php
require '../../Database/dbooking.php';
if (isset($_POST['Booking'])) {
    if (booking($_POST) > 0) {
        echo "<script>
            alert('Booking berhasil dilakukan!');
            </script>";
        echo "<meta http-equiv='refresh' content='1;url = User.php'>";
    } else {
        echo mysqli_error($conn);
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link href="https://cdn.jsdelivr.net/npm/remixicon@3.4.0/fonts/remixicon.css" rel="stylesheet" />
    <link rel="stylesheet" href="../../Css/User.css" />
    <script src="https://kit.fontawesome.com/c856ca633a.js" crossorigin="anonymous"></script>
    <title>User Booking</title>
</head>

<body>
    <nav>
        <div class="nav__logo">Bengkel Mobil</div>
        <ul class="nav__links">
            <li class="link"><a href="User.php">Home</a></li>
            <li class="link"><a href="Antrian.php">Antrian</a></li>
            <li class="link"><a href="Payment.php">Pembayaran</a></li>
            <li class="link"><a href="Log Out.php">Log Out</a></li>

        </ul>
    </nav>
    <header class="section__container header__container">
        <div class="header__image__container">
            <div class="header__content">
                <h1>Booking Disini</h1>
                <p>Untuk Melakukan Service Silahkan Booking Disini</p>
            </div>
            <form action="" method="post">
                <div class="booking__container">
                    <div class="form__group">
                        <div class="input__group">
                            <input type="text" name="Nama" />
                            <label>Nama</label>
                        </div>
                        <p>Masukan Nama Mu</p>
                    </div>
                    <div class="form__group">
                        <div class="input__group">
                            <input type="text" name="Email" />
                            <label>Email</label>
                        </div>
                        <p>Masukan Email</p>
                    </div>
                    <div class="form__group">
                        <div class="input__group">
                            <input type="text" name="No_Telepon" />
                            <label>No Telepon</label>
                        </div>
                        <p>No Telepon</p>
                    </div>
                    <div class="form__group">
                        <div class="input__group">
                            <input type="date" name="Date" id="bookingDate" />
                        </div>
                        <p>Tanggal Booking</p>
                    </div>
                    <div class="form__group">
                        <div class="input__group">
                            <input type="time" name="Jam_Booking" id="bookingTime" />
                        </div>
                        <p>Jam Booking</p>
                    </div>
                    <div class="form__group">
                        <div class="input__group">
                            <select name="Jenis_Service">
                                <option value="Service Mobil">Service Mobil</option>
                                <option value="Ganti Oli">Ganti Oli</option>
                                <option value="Perawatan">Perawatan</option>
                                <option value="Pemeriksaan">Pemeriksaan</option>
                            </select>
                        </div>
                        <p>Pilih Jenis Service</p>
                    </div>
                    <div class="form__group">
                        <div class="input__group">
                            <select name="Lokasi_Service" id="lokasiService">
                            <option value="None"></option>
                                <option value="Dirumah">Service di Rumah</option>
                                <option value="Ditempat">Service di Tempat</option>
                            </select>
                        </div>
                        <p>Pilih Lokasi Service</p>
                    </div>
                    <div id="alamatGroup" class="form__group hidden">
                        <div class="input__group">
                            <input type="text" name="Alamat_Rumah" />
                            <label>Alamat Rumah</label>
                        </div>
                        <p>Masukan Alamat Rumah</p>
                    </div>
                    <button class="btn" name="Booking">BOOKING</button>
                </div>
            </form>
        </div>
    </header>
    <section class="section__container popular__container">
        <h2 class="section__header">Mobil Populer</h2>
        <div class="popular__grid">
            <div class="popular__card">
                <img src="https://images.unsplash.com/photo-1493238792000-8113da705763?q=80&w=1770&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D"
                    alt="Mobil Populer" />
                <div class="popular__content">
                    <div class="popular__card__header">
                        <h4>Mobil R8</h4>
                        <h4>$499</h4>
                    </div>
                    <p>Downtown, Toronto, Ontario, Canada</p>
                </div>
            </div>
            <div class="popular__card">
                <img src="https://images.unsplash.com/photo-1541443131876-44b03de101c5?q=80&w=1770&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D"
                    alt="popular hotel" />
                <div class="popular__content">
                    <div class="popular__card__header">
                        <h4>BMW</h4>
                        <h4>$549</h4>
                    </div>
                    <p>Paris, France</p>
                </div>
            </div>
            <div class="popular__card">
                <img src="https://images.unsplash.com/photo-1544636331-e26879cd4d9b?q=80&w=1974&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D"
                    alt="popular hotel" />
                <div class="popular__content">
                    <div class="popular__card__header">
                        <h4>The Peninsula</h4>
                        <h4>$599</h4>
                    </div>
                    <p>Hong Kong</p>
                </div>
            </div>
            <div class="popular__card">
                <img src="https://images.unsplash.com/photo-1603584173870-7f23fdae1b7a?q=80&w=1769&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D"
                    alt="popular hotel" />
                <div class="popular__content">
                    <div class="popular__card__header">
                        <h4>Atlantis The Palm</h4>
                        <h4>$449</h4>
                    </div>
                    <p>Dubai, United Arab Emirates</p>
                </div>
            </div>
            <div class="popular__card">
                <img src="https://images.unsplash.com/photo-1490641815614-b45106d6dd04?q=80&w=1770&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D"
                    alt="popular hotel" />
                <div class="popular__content">
                    <div class="popular__card__header">
                        <h4>The Ritz-Carlton</h4>
                        <h4>$649</h4>
                    </div>
                    <p>Tokyo, Japan</p>
                </div>
            </div>
            <div class="popular__card">
                <img src="https://images.unsplash.com/photo-1511407397940-d57f68e81203?q=80&w=1974&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D"
                    alt="popular hotel" />
                <div class="popular__content">
                    <div class="popular__card__header">
                        <h4>Marina Bay Sands</h4>
                        <h4>$549</h4>
                    </div>
                    <p>Singapore</p>
                </div>
            </div>
        </div>
    </section>

    <section class="client">
        <div class="section__container client__container">
            <h2 class="section__header">Rating Client</h2>
            <div class="client__grid">
                <div class="client__card">
                    <img src="https://images.unsplash.com/photo-1535713875002-d1d0cf377fde?q=80&w=1780&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D"
                        alt="client" />
                    <p>
                        The booking process was seamless, and the confirmation was
                        instant. I highly recommend WDM&Co for hassle-free hotel bookings.
                    </p>
                </div>
                <div class="client__card">
                    <img src="https://images.unsplash.com/photo-1633332755192-727a05c4013d?q=80&w=1780&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D"
                        alt="client" />
                    <p>
                        The website provided detailed information about hotel, including
                        amenities, photos, which helped me make an informed decision.
                    </p>
                </div>
                <div class="client__card">
                    <img src="https://plus.unsplash.com/premium_vector-1712592843366-1da87f548773?bg=FFFFFF&q=80&w=1800&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D"
                        alt="client" />
                    <p>
                        I was able to book a room within minutes, and the hotel exceeded
                        my expectations. I appreciate WDM&Co's efficiency and reliability.
                    </p>
                </div>
            </div>
        </div>
    </section>
    <footer class="footer">
        <div class="section__container footer__container">
            <div class="footer__col">
                <h3>WDM&Co</h3>
                <p>
                    WDM&Co is a premier hotel booking website that offers a seamless and
                    convenient way to find and book accommodations worldwide.
                </p>
                <p>
                    With a user-friendly interface and a vast selection of hotels,
                    WDM&Co aims to provide a stress-free experience for travelers
                    seeking the perfect stay.
                </p>
            </div>
            <div class="footer__col">
                <h4>Company</h4>
                <p>About Us</p>
                <p>Our Team</p>
                <p>Blog</p>
                <p>Book</p>
                <p>Contact Us</p>
            </div>
            <div class="footer__col">
                <h4>Legal</h4>
                <p>FAQs</p>
                <p>Terms & Conditions</p>
                <p>Privacy Policy</p>
            </div>
            <div class="footer__col">
                <h4>Resources</h4>
                <p>Social Media</p>
                <p>Help Center</p>
                <p>Partnerships</p>
            </div>
        </div>
        <div class="footer__bar">
            Copyright © 2023 Web Design Mastery. All rights reserved.
        </div>
    </footer>

    <script>
        const lokasiService = document.getElementById('lokasiService');
        const alamatGroup = document.getElementById('alamatGroup');

        lokasiService.addEventListener('change', function () {
            if (this.value === 'Dirumah') {
                alamatGroup.classList.remove('hidden');
            } else {
                alamatGroup.classList.add('hidden');
            }
        });
    </script>
</body>



</html>