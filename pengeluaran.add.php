<?php 
include'header.php'; 
$error='';
$nota=false;
?>
<div class="content-wrapper">
<?php
if(isset($_POST['simpan'])){	
/* 	adodb_pr($_POST);  */
	$notif='';
	if(empty($_POST['add_barang_id'])){
		$notif.='<li>Pilih Barang</li>';
	}else{
		$cekStok=$system->db->getOne('select stok from  barang where barang_id='.$_POST['add_barang_id']);
		if($cekStok <  $_POST['add_jumlah_permintaan'] ){
			$notif.='<li>Stok tidak mencukupi, stok barang tersedian adalah <strong>'.$cekStok.'</strong> silahkan ajukan  <a href="pengeluaran.html" class="btn btn-info">Permintaan</a> </li>';
		}		
	}
	if(empty($_POST['add_jumlah_permintaan'])){
		$notif.='<li>Pilih Masukan Jumlah Barang yang akan dikeluarkan</li>';
	}
	if(empty($_POST['add_permintaan_dari'])){
		$notif.='<li>Masukan Nama user / Penerima</li>';
	}
	if(!empty($notif)){
		$error=alert('error','<ul>'.$notif.'</ul>');
	}else{
		/*generete kode barang totomatisa*/
		$latskode=$system->db->getOne("SELECT max(no_pengeluaran)  FROM pengeluaran where no_pengeluaran LIKE 'PGL/".date('y/m/d')."/%' ");
		$kodeBarang = (int) substr($latskode, 13, 3);
		$kodeBarang++;
		$char = "PGL/".date('y/m/d').'/';
		$kode= $char . sprintf("%03s", $kodeBarang);
		$_POST['add_no_pengeluaran']=$kode;
		$_POST['tanggal_pengajuan']=date('Y-m-d');

		$query='';
		foreach($_POST as $key=>$val){
			if($key!='simpan'){
				$query.=str_replace('add_','  ',$key)."='".$val."',";
			}
		}
		$query=' insert into pengeluaran set '.substr($query,1,-1);
		$simpan=$system->db->execute($query);
		$idNota = $system->db->insert_Id();
		if($simpan){
			/* $nota=true; */
			$error=alert('success','Data Berhasil Disimpan');
			$stok=($cekStok-$_POST['add_jumlah_permintaan']);
			$updateStok=' update barang set stok="'.$stok.'" where barang_id='.$_POST['add_barang_id'];
			$update=$system->db->execute($updateStok);
			$_POST=array();
			/* header("Location:print-nota-pengeluaran.html"); */
			echo '<script>window.location.href = "print-nota-pengeluaran.html?id='.$idNota.'&add=1";</script>';
		 }else{
			$error=alert('error','Opps Gagal menyimpan');
		}   
	}
}

$dataBRG=$system->db->getAll('select barang_id,barang_kode,barang from barang where 1');
$optionBRG='';
foreach($dataBRG as $r){
	$selected=(@$_POST['add_barang_id']==$r['barang_id'])?'selected':'';
	$optionBRG.='<option value="'.$r['barang_id'].'" '.$selected.' >'.$r['barang_kode'].' || '.$r['barang'].' </option>';
}

if(!$nota){
?>
<section class="content">
  <div class="box box-primary">
	<div class="box-header with-border">
	  <h3 class="box-title">Pengeluaran</h3>
	</div>
	<?=  @$error ?>
	<form  role="form" method="POST" enctype="multipart/form-data" action="">
	<div class="box-body">
		<div class="form-group">
			<label>Nama Barang</label>
			<select name="add_barang_id" class="form-control">
				<option value="" >Pilih Barang</option>
				<?= $optionBRG ?>
			</select>
		</div>
		<div class="form-group"> 
		  <label>Jumlah Barang dikeluarkan </label>
		   <input type="text" class="form-control" value="<?= !empty($_POST['add_jumlah_permintaan'])?$_POST['add_jumlah_permintaan']:''; ?>" name="add_jumlah_permintaan">
		</div>
		<div class="form-group"> 
		  <label>User / Penerima </label>
		   <input type="text" class="form-control" value="<?= !empty($_POST['permintaan_dari'])?$_POST['permintaan_dari']:''; ?>" name="add_permintaan_dari">
		</div>
		<div class="box-footer">
			<button type="submit" name="simpan" class="btn btn-primary">Proses</button>
			<a href="pengeluaran.html" class="btn btn-info">Kembali</a>
		</div>
		
		
	  </div>
	 
	</form>
  </div>
</section>
<?php }else{
$idNota;

$nota=$system->db->getRow('select * from pengeluaran where pengeluaran_id='.$idNota);	
	
	
	
?>
<section class="invoice">
   <div class="row">
        <div class="col-xs-12">
			<h2 class="page-header">
				Nota Pengeluaran Barang
				<small class="pull-right">Date: <?= date('d/m/Y') ?></small>
			</h2>
			<table class="table table-striped">
				<tr>
					<td><strong>No Pengeluaran</strong></td><td>:</td></td>
				</tr>
			
			<table>
	
	
		</div>
  </div>
</section>


<?php
}
?>


</div>	
<?php include 'footer.php'; ?>