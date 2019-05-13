
<?php 
include'header.php'; 
$error='';
$data=$system->db->getRow('select a.* , b.barang_kode,barang,satuan from pengeluaran as a, barang as b where a.barang_id=b.barang_id and a.pengeluaran_id='.$_GET['id']);


?>
<div class="content-wrapper">
<section class="invoice">

  <div class="box box-primary">
	<div class="box-header with-border">
	  <h3 class="box-title">Pengeluaran</h3>
	</div>
	
	<h2 class="page-header">
		Nota Pengeluaran Barang
		<small class="pull-right">Date: <?= date('d/m/Y') ?></small>
	</h2>
	<table class="table table-striped">
		<tr>
			<td><strong>No Pengeluaran</strong></td><td>:</td><td><?= $data['no_pengeluaran'] ?></td>
		</tr>
		<tr>
			<td><strong>Tanggal Pengeluaran</strong></td><td>:</td><td><?= $data['tanggal_pengajuan'] ?></td>
		</tr>
		<tr>
			<td><strong>Nama Barang</strong></td><td>:</td><td><?= $data['barang'] ?> || <?= $data['barang_kode'] ?>   </td>
		</tr>
		<tr>
			<td><strong>Jumlah</strong></td><td>:</td><td><?= $data['jumlah_permintaan'] ?> .<?= $data['satuan'] ?>   </td>
		</tr>
		<tr>
			<td><strong>Pengajuan Dari</strong></td><td>:</td><td><?= $data['permintaan_dari'] ?> </td>
		</tr>

	</table>
	
  </div>
  	<div class="box-footer">
			<button type="submit" name="simpan" class="btn btn-primary">Print</button>
			<a href="pengeluaran.html" class="btn btn-info">kembali</a>
	</div>
</section>
</div>	
<?php include 'footer.php'; ?>