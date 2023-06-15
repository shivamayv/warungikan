<?php 
    error_reporting(0);
    include 'koneksi.php';

    $contact = mysqli_query($conn, "SELECT admin_name, admin_address, admin_telp FROM tb_admin WHERE admin_id = 1");
    $a = mysqli_fetch_object($contact);

    $produk = mysqli_query($conn, "SELECT * FROM tb_product WHERE product_id = '".$_GET['id']."' ");
    $p = mysqli_fetch_object($produk);
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
            <h1><a href="index.php">WarungIkan</a></h1>
            <ul>
            <li><a href="index.php">Home</a></li>
                <li><a href="produk.php">Produk</a></li>
                <li><a href="#contact">Contact</a></li>
                <li><a href="search.php">Cari <i class="fas fa-magnifying-glass"></i></a></li>
            </ul>
        </div>
    </header>

    <!-- Search -->
    <div class="search">
        <div class="container">
            <form action="produk.php">
                <input type="text" name="search" placeholder="Cari Produk" value="<?php echo $_GET['search'] ?>">
                <input type="hidden" name="kat" value="<?php echo $_GET['kat'] ?>">
                <input type="submit" name="cari" value="Cari Produk">
            </form>
        </div>
    </div>

    <!-- Detail Produk -->
    <div class="section">
        <div class="container">
            <h3>Detail Produk</h3>
            <div class="box">
                <div class="col-2">
                    <img src="assets/produk/<?php echo $p->product_image ?>" width="100%">
                </div>
                <div class="col-2">
                    <h3><?php echo $p->product_name ?></h3>
                    <h4>Rp. <?php echo number_format($p->product_price) ?></h4>
                    <p>
                        <strong>Deskripsi :</strong><br>
                        <?php echo $p->product_description ?>
                    </p>
                    <p><a href="https://api.whatsapp.com/send?phone=<?php echo $a->admin_telp ?>&text=Hai, saya tertarik dengan produk Anda." target="_blank">Pesan Sekarang</a></p>
                </div>
            </div>
        </div>
    </div>

    <!-- Footer -->
    <div class="footer" id="contact">
        <div class="container">
            <h4>Alamat</h4>
            <p><?php echo $a->admin_address ?></p>

            <h4>Developed by</h4>
            <p><?php echo $a->admin_name ?></p>

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