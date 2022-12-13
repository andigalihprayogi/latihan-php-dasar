<?php 
require '../function.php';
$keyword = $_GET["keyword"];
$mahasiswa = query( "SELECT * FROM mahasiswa1 WHERE 
	nama LIKE '%$keyword%' OR
	nrp LIKE '%$keyword%' OR
	email LIKE '%$keyword%' OR
	jurusan LIKE '%$keyword%'
	");

// var_dump($mahasiswa)

 ?>

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