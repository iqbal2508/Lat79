<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>GoPrinter | Update Printer</title>

    <link rel="stylesheet" href="../css/side.css">
    <link rel="stylesheet" href="../css/tambah-product.css">
</head>
<body>
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
    <?php
            include '../database/koneksi.php';
            $id = $_GET['id'];
            $data = mysqli_query($koneksi,"select * from printer_tb where idPrinter ='$id'");
            while($d = mysqli_fetch_array($data)){
        ?>

        <div class="section-title">
            Update Product <?php echo $d['NamaPrinter'] ?>
        </div>
        <div class="container">
            <form action="" method="post" enctype="multipart/form-data">
                <label for="name">Nama Printer</label>
                <input type="text" id="name" name="name" class="form-control" value="<?php echo $d['NamaPrinter'] ?>"
                    placeholder="Nama Printer">

                <label for="harga">Harga Printer</label>
                <input type="number" id="harga" name="price" class="form-control"
                    value="<?php echo $d['HargaPrinter'] ?>" placeholder="Harga Printer">

                <label for="spesifikasi">Spesifikasi Printer</label>
                <textarea name="spesifikasi" class="form-control" maxlength="50" id="spesifikasi" cols="30"
                    rows="5"><?php echo $d['SpesifikasiPrinter'] ?></textarea>

                <label for="harga">Gambar Printer</label>
                <input type="file" id="harga" name="image" class="form-control">

                <label for="harga">Stok Printer</label>
                <input type="number" id="stok" name="stok" class="form-control"
                    value="<?php echo $d['stok'] ?>" placeholder="Stok Printer">


                <input type="submit" class="btn-success" name="submit" value="Submit">
            </form>
        </div>
        <?php 
            }
        ?>

        <?php 
        
        if (isset($_POST['submit'])) {
            include "../database/koneksi.php";

            $id = $_GET['id'];
            $nama = $_POST['name'];
            $harga = $_POST['price'];
            $spesifikasi = $_POST['spesifikasi'];
            //stok
            $stok = $_POST['stok'];

            $namaFile = $_FILES['image']['name'];

            if ($namaFile != "") {
                $dirUpload = "../img-product/";
                $namaSementara = $_FILES['image']['tmp_name'];
                $terupload = move_uploaded_file($namaSementara, $dirUpload.$namaFile);
                //stok
                $query = mysqli_query($koneksi, "UPDATE printer_tb SET NamaPrinter='$nama', HargaPrinter='$harga' , SpesifikasiPrinter='$spesifikasi', GambarPrinter='$namaFile', stok='$stok' WHERE idPrinter='$id'");
            }else {
                $query = mysqli_query($koneksi, "UPDATE printer_tb SET NamaPrinter='$nama', HargaPrinter='$harga' , SpesifikasiPrinter='$spesifikasi' , stok='$stok' WHERE idPrinter='$id'");
            }

            if ($query) {
                header("location:index.php?pesan=insert");
            }
        }
    ?>

    <!-- FontAwesome -->
    <script src="https://kit.fontawesome.com/b8d1f961b1.js" crossorigin="anonymous"></script>

    <!-- Iconify -->
    <script src="https://code.iconify.design/2/2.2.0/iconify.min.js"></script>
</body>
</html>