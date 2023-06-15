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
            <h3>Data Produk</h3>
            <div class="box">
                <p><a href="tambah_produk.php">Tambah Data</a></p>
                <table border="1" cellspacing="0" class="table">
                    <thead>
                        <tr>
                            <th width="60px">No.</th>
                            <th>Kategori</th>
                            <th>Nama Produk</th>
                            <th>Harga</th>
                            <th>Gambar</th>
                            <th>Status</th>
                            <th>Tanggal Ditambahkan</th>
                            <th width="150px">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                            $no = 1;
                            $produk = mysqli_query($conn, "SELECT * FROM tb_product LEFT JOIN tb_category USING (category_id) ORDER BY product_id DESC");
                            if(mysqli_num_rows($produk) > 0){
                            while($row = mysqli_fetch_array($produk)){
                        ?> 
                        <tr>
                            <td><?php echo $no++ ?></td>
                            <td><?php echo $row['category_name'] ?></td>
                            <td><?php echo $row['product_name'] ?></td>
                            <td>Rp. <?php echo number_format($row['product_price'])?></td>
                            <td><a href="assets/produk/<?php echo $row['product_image'] ?>" target="_blank"> <img src="assets/produk/<?php echo $row['product_image'] ?>" width="50px"></a></td>
                            <td><?php echo ($row['product_status'] == 0)? 'Tidak Aktif':'Aktif'; ?></td>
                            <td><?php echo $row['date_created'] ?></td>
                            <td>
                                <button class="btn"><a href="edit_produk.php?id=<?php echo $row['product_id'] ?>">Edit</a></button>
                                <button class="btn"><a href="proses_hapus.php?idp=<?php echo $row['product_id'] ?>" onclick="return confirm('Yakin ingin hapus?')">Hapus</a></button>
                            </td>
                        </tr>
                        <?php }}else{ ?> 
                            <tr>
                                <td colspan="9">Tidak ada data</td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Footer -->
    <footer>
        <div class="container">
            <small>Copyright &copy; 2023 - WarungIkan</small>
        </div>
    </footer>
</body>
</html>