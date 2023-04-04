<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>GoPrinter | Transaksi</title>

    <link rel="stylesheet" href="../css/side.css">
    <link rel="stylesheet" href="../css/prouk.css">
</head>
<body>
    <?php
    include '../database/koneksi.php';

    if (isset($_GET['id'])) {
        $id = htmlspecialchars($_GET['id']);

        $query = "DELETE FROM printer_tb WHERE idPrinter='$id'";
        $result = mysqli_query($koneksi, $query);

        if ($result) {
            header('Location: index.php');
        } else {
            echo "<script>alert('Produk Gagal Dihapus')</script>";
        }
    }
    ?>
    <div class="sidebar">
        <h4 class="sidebar-brand">GoPrinter</h4>
        <ul>
            <li>
                <a href="../admin/dashboard.php"><i class="fas fa-tachometer-alt-average"></i> &nbsp;Dashboard</a>
            </li>
            <li>
                <a href="../product/index.php"><span class="iconify icon-brand" data-icon="bi:printer-fill"></span> &nbsp;Printers</a>
            </li>
            <li class="active">
                <a href="index.php"><i class="fas fa-cart-arrow-down"></i> &nbsp;Transaksi</a>
            </li>
            <li>
                <a href="../logout.php" onclick="return confirm('Apakah Kamu Yakin Ingin Keluar ?')"><i class="fa-solid fa-arrow-right-from-bracket"></i> &nbsp;Logout</a>
            </li>
        </ul>
    </div>
    <main>
        <div class="section-title">
            Data Transaksi
        </div>
        <div class="row">
            <div class="card mt-5">
                <div class="table-responsive">
                <table>
                    <tr>
                        <th>No</th>
                        <th>Product</th>
                        <th>Customer</th>
                        <th>Quantity</th>
                        <th>Harga</th>
                        <th>subtotal</th>
                        <th>Status</th>
                        <th>Aksi</th>
                    </tr>
                    <?php
                    include '../database/koneksi.php';

                    $query = 'SELECT transaksi.subtotal, transaksi.Jumlah, transaksi.idTransaksi, transaksi.status ,  transaksi.UserIdUser2, user.Username, printer_tb.NamaPrinter, printer_tb.HargaPrinter FROM transaksi INNER JOIN user ON transaksi.UserIdUser2 = user.idUser INNER JOIN printer_tb ON transaksi.Printer_tblIdPrinter = printer_tb.idPrinter';
                    
                    $result = mysqli_query($koneksi, $query);


                    $no = 1;
                    while ($data = mysqli_fetch_object($result)) { ?>

                    <tr>
                        <td><?= $no++ ?></td>
                        <td><?= $data->NamaPrinter ?></td>
                        <td><?= $data->Username ?></td>
                        <td><?= $data->Jumlah ?></td>
                        <td><?= number_format($data->HargaPrinter) ?></td>
                        <td><?= number_format($data->subtotal) ?></td>
                        <?php 
    if ($data->status == 1) {
?>
        <td><span class="badge-warning">Sedang Menunggu Konfirmasi</span></td>
<?php 
    } else if ($data->status == 2) {
?>
        <td><span class="badge-success">Produk Sedang Dikirim</span></td>
<?php 
    } else if ($data->status == 3) {
?>
        <td><span class="badge-danger">Produk Gagal Dikirim</span></td>
<?php 
    }
    
?>
<td>
    <form method="POST" action="hapus_transaksi.php">
        <input type="hidden" name="idTransaksi" value="<?= $data->idTransaksi ?>">
        <button type="submit" onclick="return confirm('Apakah Anda yakin ingin menghapus transaksi ini?')" class="btn btn-danger btn-sm">
            Hapus
        </button>
    </form>
</td>


                    </tr>
                    
                    

                    <?php }
                    ?>
                    
                </table>
                </div>
            </div>
        </div>
    </main>

    <!-- FontAwesome -->
    <script src="https://kit.fontawesome.com/b8d1f961b1.js" crossorigin="anonymous"></script>

    <!-- Iconify -->
    <script src="https://code.iconify.design/2/2.2.0/iconify.min.js"></script>
</body>
</html>