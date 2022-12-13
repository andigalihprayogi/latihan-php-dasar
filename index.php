<?php 
session_start();

if (!isset($_SESSION["login"])) {
	# code...
	header("Location: login.php");
	exit;
}
// menghubungkan dengan file function.php
require 'function.php';

// pagination

// konfigurasi

$jumlahdataperhalaman = 3;

$jumlahdata = count(query("SELECT * FROM mahasiswa1"));
$jumlahhalaman = ceil($jumlahdata / $jumlahdataperhalaman);
// if (isset($_GET["halaman"])) {
// 	$halamanaktif = $_GET["halaman"];
// }else{
// 	$halamanaktif = 1;
// }
$halamanaktif =(isset($_GET["halaman"])) ? $_GET["halaman"] : 1;
// var_dump($halamanaktif);
$awalData = ($jumlahdataperhalaman * $halamanaktif) - $jumlahdataperhalaman;
//

$mahasiswa = query("SELECT * FROM mahasiswa1 LIMIT $awalData,$jumlahdataperhalaman");
// var_dump($mahasiswa)

// tombol cari ditekan 

if (isset($_POST["cari"])) {
	$mahasiswa = cari($_POST["keyword"]);
}

 ?>

<!DOCTYPE html>
<html>
<head>
	<title>Pertemuan 9(Admin)</title>
	<style type="text/css">
		img {
			height: 100px;
			width: 100px;
		}

		.loader{
			width: 25px;
			height: 25px;
			position: absolute;
			top: 140px;
			display: none;
		}
		@media print{
			.logout{
				display: none;
			}
			.tambah{
				display: none;
			}
			.cari{
				display: none; 
			}
		}
	</style>
	<script  src="js/query.js"></script>
	<script  src="js/script2.js"></script>

</head>
<body>

	<a href="logout.php" class="logout">logout</a>
<h1>Daftar Mahasiswa</h1>

<a href="tambah.php" class="tambah">Tambah data mahasiswa</a>
<br><br>

<form action="" method="post">
	<input type="text" name="keyword" size="40" autofocus placeholder="masukkan keyword pencarian" autocomplete="off" id="keyword" class="cari">
	<button type="submit" name="cari" id="tombol-cari">Cari</button>

	<img src="gambar/loader.gif" class="loader">
</form>

<!-- pindah halaman -->
<a href="?halaman=1">awal</a>
<?php if( $halamanaktif > 1 ) : ?>
	<a href="?halaman=<?= $halamanaktif - 1; ?>">&laquo;</a>
<?php endif; ?>

<!-- mambuat navigasi -->
<?php for($i = 1; $i <= $jumlahhalaman; $i++) : ?>
	<?php if($i == $halamanaktif): ?>
		<a href="?halaman=<?= $i;?>" style="font-weight: bold;"> <?= $i; ?> </a>
	<?php else: ?>
		<a href="?halaman=<?= $i;?>"> <?= $i; ?> </a>
	<?php endif; ?>
<?php endfor; ?>
<!-- pindah halaman -->
<?php if( $halamanaktif < $jumlahhalaman ) : ?>
	<a href="?halaman=<?= $halamanaktif + 1; ?>">&raquo;</a>
<?php endif; ?>




<br>
<div id="container">
<table border="1" cellpadding="10" cellspacing="0">
	<tr>
	<th>No.</th>
	<th>Aksi</th>
	<th>Gambar</th>
	<th>NRP</th>
	<th>Nama</th>
	<th>Email</th>
	<th>Jurusan</th>
</tr>
<!-- menggunakan  i karena ketika salah satu data di database hilang maka akan kacau nilai idnya -->
<?php $i = 1; ?>
<?php foreach ( $mahasiswa as $row): ?>
<tr>
	<td><?php echo $i ?></td>
	<td>
		<a href="ubah.php?id=<?= $row["id"]; ?>">ubah</a>
		<a href="hapus.php?id=<?= $row["id"]; ?>" onclick="return confirm('yakin?')">hapus</a>
	</td>
	<td><img src="gambar/<?php echo $row["gambar"] ?>"></td>
	<td><?php echo $row["nrp"] ?></td>
	<td><?php echo $row["nama"] ?></td>
	<td><?php echo $row["email"] ?></td>
	<td><?php echo $row["jurusan"]?></td>
</tr>
<?php $i++ ?>
<?php endforeach; ?>
</table>
</div>


</body>
</html>