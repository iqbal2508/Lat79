<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>GoPrinter | Tambah Printer</title>

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
        <div class="section-title">
            Tambah Product
        </div>
        <div class="container">
    <form action="" method="post" enctype="multipart/form-data">
        <label for="name">Nama Printer</label>
        <input type="text" id="name" name="name" class="form-control" placeholder="Nama Printer">

        <label for="harga">Harga Printer</label>
        <input type="number" id="harga" name="price" class="form-control" placeholder="Harga Printer">

        <label for="spesifikasi">Spesifikasi Printer</label>
        <textarea name="spesifikasi" class="form-control" maxlength="50" id="spesifikasi" cols="30" rows="10"></textarea>

        <label for="harga">Gambar Printer</label>
        <input type="file" id="harga" name="image" class="form-control" placeholder="Harga Printer">

        <label for="stok">Stok Printer</label>
        <input type="number" id="stok" name="stok" class="form-control" placeholder="Stok Printer">

        <input type="submit" name="submit" class="btn-success" value="Submit">
    </form>
</div>

<?php 
if (isset($_POST['submit'])) {
    include "../database/koneksi.php";

    $nama = $_POST['name'];
    $harga = $_POST['price'];
    $spesifikasi = $_POST['spesifikasi'];
    $stok = $_POST['stok'];

    $namaFile = $_FILES['image']['name'];
    $namaSementara = $_FILES['image']['tmp_name'];
    $dirUpload = "../img-product/";

    $terupload = move_uploaded_file($namaSementara, $dirUpload.$namaFile);

    $query = mysqli_query($koneksi, "INSERT INTO printer_tb (NamaPrinter,HargaPrinter,SpesifikasiPrinter,GambarPrinter,stok) VALUES('$nama' , '$harga' , '$spesifikasi' , '$namaFile', '$stok')");

    if ($query) {
        header("location:index.php");
    }
}
?>


    <!-- FontAwesome -->
    <script src="https://kit.fontawesome.com/b8d1f961b1.js" crossorigin="anonymous"></script>

    <!-- Iconify -->
    <script src="https://code.iconify.design/2/2.2.0/iconify.min.js"></script>
</body>
</html>