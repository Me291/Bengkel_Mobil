<?php
session_start();
$conn = new mysqli("localhost", "root", "", "service_car");
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://unpkg.com/bootstrap@5.3.2/dist/css/bootstrap.min.css">
    <title>Document</title>
</head>

<body>
    <!-- Invoice 1 - Bootstrap Brain Component -->
    <section class="py-3 py-md-5">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-12 col-lg-9 col-xl-8 col-xxl-7">
                    <div class="row gy-3 mb-3">
                        <div class="col-6">
                            <h2 class="text-uppercase text-endx m-0">Invoice</h2>
                        </div>
                        <div class="col-12">
                            <h4>From</h4>
                            <address>
                                <strong>BootstrapBrain</strong><br>
                                875 N Coast Hwybr<br>
                                Laguna Beach, California, 92651<br>
                                United States<br>
                                Phone: (949) 494-7695<br>
                                Email: email@domain.com
                            </address>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-12 col-sm-6 col-md-8">
                            <h4>Bill To</h4>
                            <?php
                            // Ambil informasi alamat dari tabel invoice berdasarkan ID
                            $id_invoice = $_GET['id']; // Pastikan Anda memiliki ID yang benar
                            $query_alamat = $conn->query("SELECT * FROM invoice WHERE id = '$id_invoice'");
                            $data_alamat = $query_alamat->fetch_assoc();

                            // Tampilkan informasi alamat menggunakan variabel yang berisi data dari tabel invoice
                            ?>
                            <address>
                                <strong><?php echo $data_alamat['nama']; ?></strong><br>
                                Phone: <?php echo $data_alamat['no_telepon']; ?><br>
                                Email: <?php echo $data_alamat['email']; ?>
                            </address>

                        </div>
                        <div class="col-12 col-sm-6 col-md-4">
                            <h4 class="row">
                                <span class="col-6">Invoice #</span>
                                <span class="col-6 text-sm-end">INT-001</span>
                            </h4>
                            <div class="row">
                                <span class="col-6">Account</span>
                                <span class="col-6 text-sm-end"><?php echo uniqid(); ?></span>
                                <span class="col-6">Order ID</span>
                                <span class="col-6 text-sm-end"><?php echo uniqid(); ?></span>
                                <span class="col-6">Invoice Date</span>
                                <span class="col-6 text-sm-end"><?php echo date('Y-m-d'); ?></span>
                                <span class="col-6">Due Date</span>
                                <span
                                    class="col-6 text-sm-end"><?php echo date('Y-m-d', strtotime('+7 days')); ?></span>
                            </div>

                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-12">
                            <div class="table-responsive">
                                <table class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th scope="col" class="text-uppercase">No</th>
                                            <th scope="col" class="text-uppercase">Nama Barang</th>
                                            <th scope="col" class="text-uppercase text-end">Merk</th>
                                            <th scope="col" class="text-uppercase text-end">Jumlah</th>
                                            <th scope="col" class="text-uppercase text-end">Harga</th>
                                            <th scope="col" class="text-uppercase text-end">Harga Total</th>
                                        </tr>
                                    </thead>
                                    <tbody class="table-group-divider">
                                        <?php
                                        $nomor = 1;
                                        $id_user = $_GET['id'];
                                        $ambil = $conn->query("SELECT * FROM data_barang WHERE id_user = '$id_user'");
                                        $total_harga_semua_barang = 0;
                                        $total_harga_ppn = 0;

                                        while ($pecah = $ambil->fetch_assoc()) {
                                            $sub_harga = $pecah['harga'] * $pecah['jumlah'];
                                            $total_harga_semua_barang += $sub_harga;
                                            $total_harga_ppn += ($sub_harga * 0.02); // Hitung total PPN sekitar 2%
                                            ?>
                                            <tr>
                                                <th scope="row"><?php echo $nomor; ?></th>
                                                <td><?php echo $pecah['nama_barang']; ?></td>
                                                <td><?php echo $pecah['merk']; ?></td>
                                                <td class="text-end"><?php echo $pecah['jumlah']; ?></td>
                                                <td class="text-end"><?php echo 'Rp.' . number_format($pecah['harga']); ?>
                                                </td>
                                                <td class="text-end"><?php echo 'Rp.' . number_format($sub_harga); ?></td>
                                            </tr>
                                            <?php
                                            $nomor++;
                                        }

                                        $total_harga = $total_harga_semua_barang + $total_harga_ppn;
                                        ?>
                                        <tr>
                                            <td colspan="5" class="text-end">PPN (2%)</td>
                                            <td class="text-end"><?php echo 'Rp.' . number_format($total_harga_ppn); ?>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td colspan="4" class="text-end text-uppercase">Total</td>
                                            <td class="text-end" colspan="2">
                                                <?php echo 'Rp.' . number_format($total_harga); ?>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12 text-end">
                            <button type="submit" class="btn btn-primary mb-3">Download Invoice</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</body>

</html>