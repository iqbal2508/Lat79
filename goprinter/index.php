<?php 
session_start();

if(!isset($_SESSION['cart'])){
    $_SESSION['cart'] = array();
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>GoPrinter</title>

    <!-- Root CSS -->
    <link rel="stylesheet" href="css/rot.css">

    <!-- Style CSS -->
    <link rel="stylesheet" href="css/hom.css">
    

</head>
<body>

    <!-- Navbar -->
    <nav class="navbar">
        <div class="navbar-brand">
            <span class="iconify icon-brand" data-icon="bi:printer-fill"></span>
            <h4 class="text-brand">GoPrinter</h4>
            
            
        </div>
        <ul class="navbar-nav">
            <li class="nav-item">
                <a href="order/" class="nav-link"><span class="iconify" data-icon="iconoir:shopping-bag-check"></span></a>
                <span class="badge">
                    <?php 
                    
                    if (isset($_SESSION['username'])) {

                        $id = $_SESSION['id_user'];

                        include 'database/koneksi.php';

                        $sql = "SELECT transaksi.subtotal, transaksi.Jumlah, transaksi.idTransaksi, transaksi.status ,  transaksi.UserIdUser2, user.Username, printer_tb.NamaPrinter, printer_tb.HargaPrinter FROM transaksi INNER JOIN user ON transaksi.UserIdUser2 = user.idUser INNER JOIN printer_tb ON transaksi.Printer_tblIdPrinter = printer_tb.idPrinter WHERE UserIdUser2 = '$id'";
                        $excute = mysqli_query($koneksi, $sql);
                        $result = mysqli_num_rows($excute);

                        echo $result;

                    } else {

                        echo 0;

                    }
                    ?>
                </span>
            </li>
            <li class="nav-item">
                <a href="cart/" class="nav-link"><span class="iconify" data-icon="clarity:shopping-cart-line"></span></a>
                <span class="badge"><?= count($_SESSION['cart']); ?></span>
            </li>
            <?php

            if (isset($_SESSION['username'])) {
                if ($_SESSION['username'] == 'admin') {
                    echo '
                        <li class="nav-item dropdown">
                            <a href="javascript:void(0)" class="dropbtn"><span class="iconify icon-user" data-icon="carbon:user-avatar"></span>'. $_SESSION['username'] .'</a>
                            <div class="dropdown-content">
                                <a href="admin/dashboard.php">Dashboard</a>
                            </div>
                        </li>
                    ';
                } else {
                    echo '
                        <li class="nav-item dropdown">
                            <a href="javascript:void(0)" class="dropbtn"><span class="iconify icon-user" data-icon="carbon:user-avatar"></span>'. $_SESSION['username'] .'</a>
                            <div class="dropdown-content">
                                <a href="logout.php" >Logout</a>
                            </div>
                        </li>
                    ';
                }
            } else {
                echo '
                        <li class="nav-item">
                            <a href="login/" class="nav-link" ><span class="iconify" data-icon="mdi:login-variant"></span></a>
                        </li>
                    ';
            }
            ?>            
        </ul>
    </nav>
    <!-- End Navbar -->

    <!-- Banner -->
    <!-- Malachi - Collection Banners -->
<div class="full-width-conatiner">
  <div class="collection-banner-conatiner">
    <div class="sixteen columns collection-banner intestinal-health clearfix">
    <!--Do Not copy top part -->

      <!-- Prebiotic Banner -->
      

          <div class="jarrow-category-banner prebiotic-health-css-banner">
                <div class="jcb-left color-white ">
                  <h1 class="caps-lock sans-serif raleway font-bold size-60">Prebiotics</h1>
                  <h2 class="sans-serif raleway font-bold size-40 border-top">PREBIOTICS TO ACCOMPANY  JARROW PROBIOTICS</h2>
                  <p class="sans-serif raleway font-normal border-top">Jarrow’s prebiotics utilize Inulin FOS, and XOS + GOS to promote beneficial microorganisms in the intestines to further promote digestive health.</p>
               
                </div>
                <div id="badge">SAVE NOW!</div>
                <div class="jcb-right">
                  <div class="white-glow"></div>
                  <img class="prebiotic-health-cb-pic" src="img-product/banner.png" alt="" />
                  <!-- <div class="black-shadow">
                </div>
                  <div class="black-shadow-2">
                </div> -->
              </div>
            </div>

<!--Do Not COPY Bottom Part!! -->      
    </div>
  </div>
</div>
    <!-- End Banner -->

    <!-- Section Title -->
    <div class="container">
        <div class="section-title">
            <h3>New Printers</h3>
            <form action="" method="get" class="form-search">
  <input type="text" name="search" placeholder="Search...">
  <button type="submit"><span class="iconify" data-icon="bi:search"></span></button>
</form>
        </div>
    </div>
    <!-- End Section Title -->

    <!-- Content -->
    <div class="container">
        <div class="row-card">
           <?php
include 'database/koneksi.php';
$search = isset($_GET['search']) ? $_GET['search'] : '';
$query = "SELECT * FROM printer_tb WHERE NamaPrinter LIKE '%$search%' ORDER BY idPrinter DESC";
$result = mysqli_query($koneksi, $query);
if (mysqli_num_rows($result) > 0) {
  while ($data = mysqli_fetch_array($result)) {
?>
<div class="card">
  <div class="card-image">
    <img src="img-product/<?= $data['GambarPrinter'] ?>" alt="">
  </div>
  <div class="card-body">
  <h4 class="title-product"><?= $data['NamaPrinter'] ?></h4>
  
  <p class="price-product"><?= 'Rp.' . number_format($data['HargaPrinter']) ?></p>
  <?php
  $stok = $data['stok'];
  if ($stok == 0) {
    // hapus data printer_tb berdasarkan idPrinter jika stok 0
    $queryHapusPrinter = "DELETE FROM printer_tb WHERE idPrinter = '".$data['idPrinter']."'";
    $resultHapusPrinter = mysqli_query($koneksi, $queryHapusPrinter);
  }
?>
<p class="stock-product">Stock: <?= $stok ?></p>

  <a href="cart/index.php?id=<?php echo $data['idPrinter']; ?>&action=add" class="btn-add-to-cart">Add To Cart <span class="iconify icon-to-cart" data-icon="ic:outline-add-shopping-cart"></span></a>
</div>

</div>
<?php
  }
} else {
  echo '<p>No product found.</p>';
}
?>

        </div>
    </div>
    <!-- End Content -->

    <!-- Iconify -->
    <script src="https://code.iconify.design/2/2.2.0/iconify.min.js"></script>

</body>
</html>