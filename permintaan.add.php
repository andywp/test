<?php 
include'header.php'; 
$error='';
$nota=false;
?>
<div class="content-wrapper">
<?php
if(isset($_POST['simpan'])){	
/* 	adodb_pr($_POST);   */
	$notif='';
	if(empty($_POST['add_barang_id'])){
		$notif.='<li>Pilih Barang</li>';
	}	
	if(empty($_POST['add_permintaan_jumlah'])){
		$notif.='<li>Pilih Masukan Jumlah Barang yang di ajukan</li>';
	}
	
	if(!empty($notif)){
		$error=alert('error','<ul>'.$notif.'</ul>');
	}else{
		/*generete kode barang totomatisa*/
		$latskode=$system->db->getOne("SELECT max(permintaan_no)  FROM permintaan where permintaan_no LIKE 'PER/".date('y/m/d')."/%' ");
		$kodeBarang = (int) substr($latskode, 13, 3);
		$kodeBarang++;
		$char = "PER/".date('y/m/d').'/';
		$kode= $char . sprintf("%03s", $kodeBarang);
		$_POST['add_permintaan_no']=$kode;
		$_POST['add_tanggal']=date('Y-m-d');
		$query='';
		foreach($_POST as $key=>$val){
			if($key!='simpan'){
				$query.=str_replace('add_','  ',$key)."='".$val."',";
			}
		}
		$query=' insert into permintaan set '.substr($query,1,-1);
		$simpan=$system->db->execute($query);
		/* $idNota = $system->db->insert_Id(); */
		if($simpan){
			
			$error=alert('success','Data Berhasil Disimpan');
			$_POST=array();
			$_GET=array();
			
			/* echo '<script>window.location.href = "print-nota-pengeluaran.html?id='.$idNota.'&add=1";</script>'; */
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


?>
<section class="content">
  <div class="box box-primary">
	<div class="box-header with-border">
	  <h3 class="box-title">Permintaan Barang</h3>
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
		  <label>Jumlah Permintaan </label>
		   <input type="text" class="form-control" value="<?= !empty($_POST['add_permintaan_jumlah'])?$_POST['add_permintaan_jumlah']:''; ?>" name="add_permintaan_jumlah">
		</div>
		
		<div class="box-footer">
			<button type="submit" name="simpan" class="btn btn-primary">Proses</button>
			<a href="permintaan.html" class="btn btn-info">Kembali</a>
		</div>
		
		
	  </div>
	 
	</form>
  </div>
</section>



</div>	
<?php include 'footer.php'; ?>