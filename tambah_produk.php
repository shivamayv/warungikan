<?php 
    session_start();
    include 'koneksi.php';
    if($_SESSION['status_login'] != true){
        echo '<script>window.location="login.php"</script>';
    }
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
            <h3>Tambah Data Produk</h3>
            <div class="box">
                <form action="" method="POST" enctype="multipart/form-data">
                    <select class="input-control" name="kategori" required>
                        <option value="">--Pilih--</option>
                        <?php 
                            $kategori = mysqli_query($conn, "SELECT * FROM tb_category ORDER BY category_id DESC");
                            while($r = mysqli_fetch_array($kategori)){
                        ?>
                        <option value="<?php echo $r['category_id'] ?>"><?php echo $r['category_name'] ?></option>
                        <?php } ?>
                    </select>

                    <input type="text" name="nama" class="input-control" placeholder="Nama Produk" required>
                    <input type="text" name="harga" class="input-control" placeholder="Harga" required>
                    <input type="file" name="gambar" class="input-control" required>
                    <textarea class="input-control" name="deskripsi" placeholder="Deskripsi Produk"></textarea><br>
                    <select class="input-control" name="status">
                        <option value="">--Pilih--</option>
                        <option value="1">Aktif</option>
                        <option value="0">Tidak Aktif</option>
                    </select>
                    <input type="datetime-local" name="date_created" class="input-control" required>
                    <input type="submit" name="submit" value="Submit" class="btn">
                </form>

                <?php 
					if(isset($_POST['submit'])){

                        /* print_r($_FILES['gambar']); */
                        // Menampung inputan dari form
                        $kategori       = $_POST['kategori'];
                        $nama           = $_POST['nama'];
                        $harga          = $_POST['harga'];
                        $deskripsi      = $_POST['deskripsi'];
                        $status         = $_POST['status'];
                        $date_created   = $_POST['date_created'];

                        // Mendapatkan tanggal dan waktu saat ini
                        $date_created = date("Y-m-d H:i:s"); 

                        // Menampung data File yang diupload
                        $filename = $_FILES['gambar']['name'];
                        $tmp_name = $_FILES['gambar']['tmp_name'];

                        $type1 = explode('.', $filename);
                        $type2 = $type1[1];

                        $newname = 'produk'.time().'.'.$type2;

                        // Menampung data format file yang diizinkan
                        $tipe_diizinkan = array('jpg', 'jpeg', 'png', 'gif');

                        // Validasi format file
                        if(!in_array($type2, $tipe_diizinkan)){
                            // jika format file tidak ada dalam tipe diizinkan
                            echo '<script>alert(Format file tidak diizinkan!)</script>';

                        }else{
                            // Jika format file sesuai dengan yang ada di dalam array tipe diizinkan
                            // Proses upload file + insert ke database
                            move_uploaded_file($tmp_name, './assets/produk/'.$newname);

                            $insert = mysqli_query($conn, "INSERT INTO tb_product VALUES (
                                                null, 
                                                '".$kategori."',
                                                '".$nama."',
                                                '".$harga."',
                                                '".$deskripsi."',
                                                '".$newname."',
                                                '".$status."', 
                                                '".$date_created."' ) ");
                            if($insert){
                                echo '<script>alert("Tambah data berhasil")</script>';
                                echo '<script>window.location="data_produk.php"</script>';
                            }else{
                                echo 'gagal '.mysqli_error($conn);
                            }
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