<?php 
include'header.php'; 
$error='';
?>
<div class="content-wrapper">
<?php
if(isset($_POST['simpan'])){	
	/* adodb_pr($_POST); */
	$notif='';
	if(empty($_POST['add_barang'])){
		$notif.='<li>Nama Barang Harus isi</li>';
	}
	if(empty($_POST['add_satuan'])){
		$notif.='<li>Pilih satuan</li>';
	}
	if(!empty($notif)){
		$error=alert('error','<ul>'.$notif.'</ul>');
	}else{
		/*generete query insert*/
		$query='';
		foreach($_POST as $key=>$val){
			if($key!='simpan'){
				$query.=str_replace('add_','  ',$key)."='".$val."',";
			}
		}
		$query=' update barang set '.substr($query,1,-1).' where barang_id='.$_GET['id'];
		$simpan=$system->db->execute($query);
		if($simpan){
			$error=alert('success','Data Barang di Ubah');
			$_POST=array();
		}else{
			$error=alert('error','Opps Gagal menyimpan');
		}   
	}
}

$row=$system->db->getRow('select * from barang where barang_id='.$_GET['id']);
/* adodb_pr($row); */
@$_POST['add_satuan']=$row['satuan'];

?>
<section class="content">
  <div class="box box-primary">
	<div class="box-header with-border">
	  <h3 class="box-title">Edit Barang</h3>
	</div>
		<?=  @$error ?>
	<form  role="form" method="POST" enctype="multipart/form-data" action="">
		<div class="box-body">
			<div class="form-group">
			  <label>Kode Barang</label>
			  <input type="text" class="form-control disabled" value="<?= @$row['barang_kode'] ?>"  disabled >
			</div>
			<div class="form-group">
			  <label>Nama Barang</label>
			   <input type="text" class="form-control" value="<?= !empty(@$_POST['add_barang'])?$_POST['add_barang']:$row['barang']; ?>" name="add_barang">
			</div>
			<div class="form-group">
			  <label>Stok Awal</label>
			  <input type="text" class="form-control disabled" value="<?= @$row['stok'] ?>"  disabled >
			</div>
			<div class="form-group">
			  <label>Satuan</label>
			  <select name="add_satuan" class="form-control">
				<option value="" >Pilih Satuan</option>
				<option value="Kilogram" <?= (@$_POST['add_satuan']=='Kilogram')?'selected':''; ?>>Kilogram</option>
				<option value="Liter" <?= (@$_POST['add_satuan']=='Liter')?'selected':''; ?> >Liter</option>
				<option value="Buah" <?= (@$_POST['add_satuan']=='Buah')?'selected':''; ?> >Buah</option>
			  </select>
			</div>
	  </div>
	  <div class="box-footer">
		<button type="submit" name="simpan" class="btn btn-primary">Ubah</button>
		<a href="barang.html" class="btn btn-info">Kembali</a>
	  </div>
	</form>
  </div>

</section>
</div>	
<?php include 'footer.php'; ?>