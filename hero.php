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
            <h3>Data Slider</h3>
            <div class="box">
                <p><a href="tambah_hero.php">Tambah Hero</a></p>
                <table border="1" cellspacing="0" class="table">
                    <thead>
                        <tr>
                            <th width="60px">No.</th>
                            <th>Nama Produk</th>
                            <th>Gambar</th>
                            <th>Status</th>
                            <th width="150px">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                            $no = 1;
                            $hero = mysqli_query($conn, "SELECT * FROM tb_carousels ORDER BY id_crs DESC");
                            if(mysqli_num_rows($hero) > 0){
                            while($row = mysqli_fetch_array($hero)){
                        ?> 
                        <tr>
                            <td><?php echo $no++ ?></td>
                            <td><?php echo $row['name_crs'] ?></td>
                            <td><a href="assets/hero/<?php echo $row['banner'] ?>" target="_blank"> <img src="assets/hero/<?php echo $row['banner'] ?>" width="100px"></a></td>
                            <td><?php echo ($row['is_active'] == 0)? 'Tidak Aktif':'Aktif'; ?></td>
                            <td>
                                <button class="btn"><a href="edit_hero.php?id=<?php echo $row['id_crs'] ?>">Edit</a></button>
                                <button class="btn"><a href="proses_hapus.php?idh=<?php echo $row['id_crs'] ?>" onclick="return confirm('Yakin ingin hapus?')">Hapus</a></button>
                            </td>
                        </tr>
                        <?php }}else{ ?> 
                            <tr>
                                <td colspan="5">Tidak ada data</td>
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