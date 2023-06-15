<?php 
    session_start();
    include 'koneksi.php';
    if($_SESSION['status_login'] != true){
        echo '<script>window.location="login.php"</script>';
    }

    $produk = mysqli_query($conn, "SELECT * FROM tb_product WHERE product_id = '".$_GET['id']."' ");
    if(mysqli_num_rows($produk) == 0){
        echo '<script>window.location="data_produk.php"</script>';
    }
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
    <script src="https://cdn.ckeditor.com/4.14.0/standard/ckeditor.js"></script>
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
            <h3>Edit Data Produk</h3>
            <div class="box">
                <form action="" method="POST" enctype="multipart/form-data">
                    <select class="input-control" name="kategori" required>
                        <option value="">--Pilih--</option>
                        <?php 
                            $kategori = mysqli_query($conn, "SELECT * FROM tb_category ORDER BY category_id DESC");
                            while($r = mysqli_fetch_array($kategori)){
                        ?>
                        <option value="<?php echo $r['category_id'] ?>" <?php echo ($r['category_id'] == $p->category_id)?'selected':''; ?>><?php echo $r['category_name'] ?></option>
                        <?php } ?>
                    </select>

                    <input type="text" name="nama" class="input-control" placeholder="Nama Produk" value="<?php echo $p->product_name ?>" required>
                    <input type="text" name="harga" class="input-control" placeholder="Harga" value="<?php echo $p->product_price ?>" required>
                    
                    <img src="assets/produk/<?php echo $p->product_image ?>" width="150px">
                    <input type="hidden" name="foto" value="<?php echo $p->product_image ?>">
                    <input type="file" name="gambar" class="input-control">
                    <textarea class="input-control" name="deskripsi" placeholder="Deskripsi Produk"><?php echo $p->product_description ?></textarea><br>
                    <select class="input-control" name="status">
                        <option value="">--Pilih--</option>
                        <option value="1" <?php echo ($p->product_status == 1)? 'selected':''; ?>>Aktif</option>
                        <option value="0" <?php echo ($p->product_status == 0)? 'selected':''; ?>>Tidak Aktif</option>
                    </select>
                    <input type="datetime-local" name="date_created" class="input-control" value="<?php echo $p->date_created ?>" required>
                    <input type="submit" name="submit" value="Submit" class="btn">
                </form>

                <?php 
                    if(isset($_POST['submit'])){
                        // data inputan dari form
                        $kategori       = $_POST['kategori'];
                        $nama           = $_POST['nama'];
                        $harga          = $_POST['harga'];
                        $deskripsi      = $_POST['deskripsi'];
                        $status         = $_POST['status'];
                        $date_created   = $_POST['date_created'];
                        $foto           = $_POST['foto'];

                        // Mendapatkan tanggal dan waktu saat ini
                        $date_created = date("Y-m-d H:i:s");

                        // data gambar baru
                        $filename = $_FILES['gambar']['name'];
                        $tmp_name = $_FILES['gambar']['tmp_name'];

                        $type1 = explode('.', $filename);
                        $type2 = $type1[1];

                        $newname = 'produk'.time().'.'.$type2;

                        // Menampung data format file yang diizinkan
                        $tipe_diizinkan = array('jpg', 'jpeg', 'png', 'gif');

                        // jika admin ganti gambar
                        if($filename != ''){
                            
                            // Validasi format file
                            if(!in_array($type2, $tipe_diizinkan)){
                                // jika format file tidak ada dalam tipe diizinkan
                                echo '<script>alert(Format file tidak diizinkan!)</script>';

                            }else{
                                unlink('./assets/produk/'.$foto);
                                move_uploaded_file($tmp_name, './assets/produk/'.$newname);
                                $namagambar = $newname;
                            }

                        }else{
                            // jika admin tidak ganti gambar
                            $namagambar = $foto;
                        }

                        // query update data produk
                        $update = mysqli_query($conn, "UPDATE tb_product SET
                                                category_id = '".$kategori."',
                                                product_name = '".$nama."',
                                                product_price = '".$harga."',
                                                product_description = '".$deskripsi."',
                                                product_status = '".$status."',
                                                product_image = '".$namagambar."',
                                                date_created = '".$date_created."'
                                                WHERE product_id = '".$p->product_id."' ");
                        if($update){
                            echo '<script>alert("Ubah data berhasil")</script>';
                            echo '<script>window.location="data_produk.php"</script>';
                        }else{
                            echo 'gagal '.mysqli_error($conn);
                        }
                    }
                ?>

            </div>
        </div>
    </div>

    <!-- Footer -->
    <footer>
        <div class="container">
            <small>Copyright &copy; 2023 - WarungIkan</small>
        </div>
    </footer>
    <script>
        CKEDITOR.replace( 'deskripsi' );
    </script>
</body>
</html>