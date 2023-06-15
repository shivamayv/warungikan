<?php 

    include 'koneksi.php';

    if(isset($_GET['idk'])){
        $delete = mysqli_query($conn, "DELETE FROM tb_category WHERE category_id = '".$_GET['idk']."' ");
        echo '<script>window.location="data_kategori.php"</script>';
    }

    if(isset($_GET['idp'])){
        $produk = mysqli_query($conn, "SELECT product_image FROM tb_product WHERE product_id = '".$_GET['idp']."' ");
        $p = mysqli_fetch_object($produk);

        unlink('./assets/produk/'.$p->product_image);

        $delete = mysqli_query($conn, "DELETE FROM tb_product WHERE product_id = '".$_GET['idp']."' ");
        echo '<script>window.location="data_produk.php"</script>';
    }

    if(isset($_GET['idh'])){
        $hero = mysqli_query($conn, "SELECT banner FROM tb_carousels WHERE id_crs = '".$_GET['idh']."' ");
        $h = mysqli_fetch_object($hero);

        unlink('./assets/hero/'.$h->banner);

        $delete = mysqli_query($conn, "DELETE FROM tb_carousels WHERE id_crs = '".$_GET['idh']."' ");
        echo '<script>window.location="hero.php"</script>';
    }

?>