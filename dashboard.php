<?php 
    session_start();
    if($_SESSION['status_login'] != true){
        echo '<script>window.location="login.php"</script>';
    }

    include 'koneksi.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>WarungIkan</title>
    <link rel="stylesheet" type="text/css" href="assets/css/style.css">
    <link href="https://fonts.googleapis.com/css2?family=Quicksand&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="assets/fontawesome/css/all.css">
</head>
<body>
    <!-- Header -->
    <header>
        <div class="container">
            <h1><a href="dashboard.php">WarungIkan</a></h1>
            <ul>
                <li><a href="dashboard.php">Dashboard</a></li>
                <li><a href="profil.php">Profil</a></li>
                <li><a href="data_kategori.php">Data Kategori</a></li>
                <li><a href="data_produk.php">Data Produk</a></li>
                <li><a href="hero.php">Panel Hero</a></li>
                <li><a href="logout.php">Logout</a></li>
            </ul>
        </div>
    </header>

    <!-- Content -->
    <div class="section">
        <div class="container">
            <h3>Dashboard</h3>
            <div class="box">
                <h4>Selamat Datang <?php echo $_SESSION['a_global']->admin_name ?> di WarungIkan</h4>
            </div>
        </div>
    </div>

    <!-- Kategori -->
    <div class="section">
        <div class="container">
            <h3>Kategori</h3>
            <div class="box">
                <?php 
                    $kategori = mysqli_query($conn, "SELECT * FROM tb_category ORDER BY category_id DESC");

                    if(mysqli_num_rows($kategori) > 0){
                        while($k = mysqli_fetch_array($kategori)){
                ?>
                        <a href="produk.php?kat=<?php echo $k['category_id'] ?>">
                            <div class="col-5">
                                <i class="fas fa-rectangle-list fa-3x"></i>
                                <p><?php echo $k['category_name'] ?></p>
                            </div>
                        </a>
                <?php }}else{ ?>
                    <p>Kategori tidak ada</p>
                <?php } ?>
            </div>
        </div>
    </div>

    <!-- New Product -->
    <div class="section" id="katalog">
        <div class="container">
            <h3>Produk Terbaru</h3>
            <div class="box">
                <?php
                    $produk = mysqli_query($conn, "SELECT * FROM tb_product WHERE product_status = 1 ORDER BY product_id DESC LIMIT 8");
                    
                    if(mysqli_num_rows($produk) > 0){
                        while($p = mysqli_fetch_array($produk)){
                ?>
                    <a href="detail_produk.php?id=<?php echo $p['product_id'] ?>">
                        <div class="col-4">
                            <img src="assets/produk/<?php echo $p['product_image'] ?>" alt="">
                            <p class="nama"><?php echo substr($p['product_name'], 0, 30) ?></p>
                            <p class="harga">Rp. <?php echo number_format($p['product_price']) ?></p>
                        </div>
                    </a>
                <?php }}else{ ?>
                    <p>Produk tidak ada</p>
                <?php } ?>
            </div>
        </div>
    </div>

    <!-- Footer -->
    <div class="footer" id="contact">
        <div class="container">
            <h4>Alamat</h4>
            <p>Jl. Yudhistira Desa Karangasem RT. 21 RW. 04 Plumbon-Cirebon, 45155</p>

            <h4>Developed by</h4>
            <p>Shiva May Vazri</p>

            <h4>Contact</h4>
            <a class="icon" href="https://www.linkedin.com/in/shiva-may-vazri-2865ab254/" target="_blank"><i class="fa-brands fa-linkedin"></i></a>
            <a class="icon" href="https://github.com/shivamayv" target="_blank"><i class="fa-brands fa-github"></i></a>
            <a class="icon" href="https://api.whatsapp.com/send?phone=6289516757859" target="_blank"><i class="fa-brands fa-whatsapp"></i></a>
            <a class="icon" href="https://www.instagram.com/shvamayyy/" target="_blank"><i class="fa-brands fa-instagram"></i></a>
            <a class="icon" href="mailto:shivamay0105@gmail.com" target="_blank"><i class="fa-solid fa-envelope"></i></a>

            <br>
            <small>Copyright &copy; 2023 WarungIkan - Shiva May Vazri | FSWD 1</small>
        </div>
    </div>
</body>
</html>