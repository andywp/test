<?php 
include'header.php'; 
$error='';
?>
<div class="content-wrapper">
<?php
if(isset($_POST['simpan'])){	
	/* adodb_pr($_POST); */
	$notif='';
	if(empty($_POST['add_supplier'])){
		$notif.='<li>Nama Supplier Harus isi</li>';
	}
	if(empty($_POST['add_barang_id'])){
		$notif.='<li>Pilih Barang</li>';
	}
	if(empty($_POST['add_harga'])){
		$notif.='<li>Masukan Harga Persatuan</li>';
	}
	if(!empty($notif)){
		$error=alert('error','<ul>'.$notif.'</ul>');
	}else{
	
		$query='';
		foreach($_POST as $key=>$val){
			if($key!='simpan'){
				$query.=str_replace('add_','  ',$key)."='".$val."',";
			}
		}
		$query=' update supplier set '.substr($query,1,-1).' where supplier_id='.$_GET['id'];
		$simpan=$system->db->execute($query);
		if($simpan){
			$error=alert('success','Data Berhasil Disimpan');
			$_POST=array();
		}else{
			$error=alert('error','Opps Gagal menyimpan');
		}  
	}
}



$DataSup=$system->db->getRow('select * from supplier where supplier_id='.$_GET['id']);
$_POST['add_barang_id']=empty($_POST['add_barang_id'])?$DataSup['barang_id']:$_POST['add_barang_id'];
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
	  <h3 class="box-title">Edit Supplier</h3>
	</div>
		<?=  @$error ?>
	<form  role="form" method="POST" enctype="multipart/form-data" action="">
		<div class="box-body">
			<div class="form-group">
			  <label>Supplier</label>
			   <input type="text" class="form-control" value="<?= !empty($_POST['add_supplier'])?$_POST['add_supplier']:$DataSup['supplier']; ?>" name="add_supplier">
			</div>
			<div class="form-group">
				<label>Barang</label>
				<select name="add_barang_id" class="form-control">
					<option value="" >Pilih Barang</option>
					<?= $optionBRG ?>
				</select>
			</div>
			<div class="form-group"> 
			  <label>Harga per satuan @</label>
			   <input type="text" class="form-control" value="<?= !empty($_POST['add_harga'])?$_POST['add_harga']:$DataSup['harga']; ?>" name="add_harga">
			</div>
	  </div>
	  <div class="box-footer">
		<button type="submit" name="simpan" class="btn btn-primary">Simpan</button>
		<a href="supplier.html" class="btn btn-info">Kembali</a>
	  </div>
	</form>
  </div>

</section>
</div>	
<?php include 'footer.php'; ?>