<?php

use Master\jadwal_pelatihan;
use Master\peserta;
use Master\Menu;

include('autoload.php');
include('Config/Database.php');

$menu = new Menu();
$jadwal_pelatihan = new jadwal_pelatihan($dataKoneksi);

//$jadwal_pelatihan ->tambah()
$target = @$_GET['target'];
$act = @$_GET['act']
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Web</title>
    <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.css">
    <script src="assets/bootstrap/js/bootstrap.bundle.min.js"></script>
</head>

<body>
    <div class="container">
        <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
            <div class="container-fluid">
                <a href="#" class="navbar-brand">PEMBERDAYAAN NELAYAN</a>
                <button type="button" class="navbar-toggler" data-bs-toggle="collapse" data-bs-target="#MyMenu" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="MyMenu">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                        <?php
                        foreach ($menu->topMenu() as $r) {
                        ?>
                            <li class="nav-item">
                                <a href="<?php echo $r['link']; ?>" class="nav-link">
                                    <?php echo $r['text']; ?>
                                </a>
                            </li>
                        <?php
                        }
                        ?>
                    </ul>
                </div>
            </div>
        </nav>
        <br>
        <div class="content">
            <h5>Content <?php echo strtoupper($target); ?></h5>

            <?php
            if (!isset($target) or $target == "home") {
                echo "Selamat Datang, Di Dinas Peternakan dan Perikanan Kab. Situbondo";
                //====start content jadwal_pelatihan====
            } elseif ($target == "jadwal_pelatihan") {
                if ($act == "tambah_jadwal_pelatihan") {
                    echo $jadwal_pelatihan->tambah();
                } elseif ($act == "simpan_jadwal_pelatihan") {
                    if ($jadwal_pelatihan->simpan()) {
                        echo "<script>
                        alert ('Data Tersimpan')
                        window.location.href = '?target=jadwal_pelatihan'
                        </script>";
                    } else {
                        echo "<script>
                        alert ('Data Gagal Tersimpan')
                        window.location.href = '?target=jadwal_pelatihan'
                        </script>";
                    }
                } elseif ($act == "edit_jadwal_pelatihan") {
                    $id = $_GET['id'];
                    echo $jadwal_pelatihan->edit($id);
                } elseif ($act == "update_jadwal_pelatihan") {
                    if ($jadwal_pelatihan->update()) {
                        echo "<script>
                        alert ('Data Diupdate')
                        window.location.href = '?target=jadwal_pelatihan'
                        </script>";
                    } else {
                        echo "<script>
                        alert ('Data Gagal Diupdate')
                        window.location.href = '?target=jadwal_pelatihan'
                        </script>";
                    }
                } elseif ($act == "delete_jadwal_pelatihan") {
                    $id = $_GET['id'];
                    if ($jadwal_pelatihan->delete($id)) {
                        echo "<script>
                        alert ('Data Dihapus')
                        window.location.href = '?target=jadwal_pelatihan'
                        </script>";
                    } else {
                        echo "<script>
                        alert ('Data Gagal Dihapus')
                        window.location.href = '?target=jadwal_pelatihan'
                        </script>";
                    }
                } else {
                    echo $jadwal_pelatihan->index();
                }
                //====start Content peserta====
            } elseif ($target == "peserta") {
                if ($act == "tambah_peserta") {
                    echo $peserta->tambah();
                } elseif ($act == "simpan_peserta") {
                    if ($peserta->simpan()) {
                        echo "<script>
                        alert ('Data Tersimpan')
                        window.location.href = '?target=peserta'
                        </script>";
                    } else {
                        echo "<script>
                        alert ('Data Gagal Tersimpan')
                        window.location.href = '?target=peserta'
                        </script>";
                    }
                } elseif ($act == "edit_peserta") {
                    $id = $_GET['id'];
                    echo $peserta->edit($id);
                } elseif ($act == "update_peserta") {
                    if ($peserta->update()) {
                        echo "<script>
                        alert ('Data Diupdate')
                        window.location.href = '?target=peserta'
                        </script>";
                    } else {
                        echo "<script>
                        alert ('Data Gagal Diupdate')
                        window.location.href = '?target=peserta'
                        </script>";
                    }
                } elseif ($act == "delete_peserta") {
                    $id = $_GET['id'];
                    if ($peserta->delete($id)) {
                        echo "<script>
                        alert ('Data Dihapus')
                        window.location.href = '?target=peserta'
                        </script>";
                    } else {
                        echo "<script>
                        alert ('Data Gagal Dihapus')
                        window.location.href = '?target=peserta'
                        </script>";
                    }
                } else {
                    echo $peserta->index();
                }
            } 
            ?>