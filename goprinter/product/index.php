<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>GoPrinter | Data Printer</title>

    <link rel="stylesheet" href="../css/side.css">
    <link rel="stylesheet" href="../css/prouk.css">
</head>
<body>
    <?php 
        
        include "../database/koneksi.php";
        
        if (isset($_GET['id'])) {
            $id = htmlspecialchars($_GET['id']);

            $query = "DELETE FROM printer_tb WHERE idPrinter='$id'";
            $result = mysqli_query($koneksi, $query);

            if ($result) {
                header("Location: index.php");
            }else {
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
            <li class="active">
                <a href="index.php"><span class="iconify icon-brand" data-icon="bi:printer-fill"></span> &nbsp;Printers</a>
            </li>
            <li>
                <a href="../transaksi"><i class="fas fa-cart-arrow-down"></i> &nbsp;Transaksi</a>
            </li>
            <li>
                <a href="../logout.php" onclick="return confirm('Apakah Kamu Yakin Ingin Keluar ?')"><i class="fa-solid fa-arrow-right-from-bracket"></i> &nbsp;Logout</a>
            </li>
        </ul>
    </div>
    <main>
        <div class="section-title">
            Data Printer
        </div>
        <div class="search-form">
    <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="GET">
        <input type="text" name="keyword" placeholder="Search by name...">
        <button type="submit" name="search"><i class="fas fa-search"></i></button>
    </form>
</div>

        <div class="row">
            <div class="card mt-5">
                <a href="tambah.php" class="btn btn-warning">Tambah Product</a>
                <div class="table-responsive">
                    <table border="1px">
                        <tr>
                            <th>No</th>
                            <th>Nama</th>
                            <th>Foto</th>
                            <th>Spesifikasi</th>
                            <th>Harga</th>
                            <th>Stok</th>
                            <th>Action</th>
                        </tr>
                        <?php 
                        
                        include "../database/koneksi.php";

                        $query = "SELECT * FROM printer_tb ORDER BY idPrinter ASC";
                        $result = mysqli_query($koneksi, $query);
                        $no = 1;
                        while ($data = mysqli_fetch_array($result))  { ?>
                            <tr>
                                <td><?php echo $no++; ?></td>
                                <td><?php echo $data['NamaPrinter'] ?></td>
                                <td><img src="../img-product/<?= $data[
                                'GambarPrinter'
                            ] ?>" alt="" width="70"></td>
                                <td><?php echo $data['SpesifikasiPrinter'] ?></td>
                                <td>
                                    <?php 
                                        $harga = $data['HargaPrinter'];
                                        echo "Rp." . number_format($harga);
                                    ?>
                                </td>
                                <td><?php echo $data['stok'] ?></td> <!-- New row -->
                                <td>
                                    <a href="edit.php?id=<?php echo htmlspecialchars($data['idPrinter']); ?>" class="btn-edit">Edit</a>
                                    <a href="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>?id=<?php echo $data['idPrinter']; ?>" class="btn-delete" onclick="return confirm('Apakah Anda yakin akan menghapus data ini?')">Delete</a>

                                </td>
                            </tr>
                        <?php 
                        }
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