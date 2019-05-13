<?php 
include'header.php'; 
$error='';
$nota=false;
?>
<div class="content-wrapper">
<?php
$data=$system->db->getRow('select a.* , b.barang_kode,barang,satuan from permintaan as a, barang as b where a.barang_id=b.barang_id and a.permintaan_id='.$_GET['id']);
if(isset($_POST['simpan'])){	
	/* adodb_pr($_POST);    */
	$notif='';
	if(empty($_POST['add_supplier_id'])){
		$notif.='<li>Pilih Suplayer</li>';
	}	
	if(!empty($notif)){
		$error=alert('error','<ul>'.$notif.'</ul>');
	}else{
		
		$sup=$system->db->getRow("select * from supplier where supplier_id=".$_POST['add_supplier_id']);
		/*generete kode barang totomatisa*/
		$latskode=$system->db->getOne("SELECT max(po)  FROM permintaan where po LIKE 'PO/".date('y/m/d')."/%' ");
		$kodeBarang = (int) substr($latskode, 12, 3);
		$kodeBarang++;
		$char = "PO/".date('y/m/d').'/';
		$kode= $char . sprintf("%03s", $kodeBarang);
		$_POST['add_po']=$kode;
		$_POST['add_tanggal_po']=date('Y-m-d');
		$_POST['add_barang_kode']=$data['barang_kode'];
		$_POST['add_permintaan_no']=$data['permintaan_no'];
		$_POST['add_barang']=$data['barang'];
		$_POST['add_jumlah']=$data['permintaan_jumlah'].' '.$data['satuan'];
		$_POST['add_tanggal_permintaan']=$data['tanggal'];
		$_POST['add_supplier']=$sup['supplier'];
		$_POST['add_harga_satuan']=$sup['harga'];
		$_POST['add_total_haraga']=($sup['harga'] * $data['permintaan_jumlah']);

		$query='';
		foreach($_POST as $key=>$val){
			if($key!='simpan' && $key !='add_supplier_id'   ){
				$query.=str_replace('add_','  ',$key)."='".$val."',";
			}
		}
		$query=' insert into pembelian set '.substr($query,1,-1);
		$simpan=$system->db->execute($query);
		/* $idNota = $system->db->insert_Id(); */
		if($simpan){
			
			$error=alert('success','Data Berhasil Disimpan');
			$_POST=array();
			echo '<script>window.location.href = "list-reg-sup.html?act=sukses";</script>'; 
		 }else{
			$error=alert('error','Opps Gagal menyimpan');
		}   
	}
}





$dataBRG=$system->db->getAll('select * from supplier where barang_id='.$data['barang_id'].' order by harga asc ');
$optionBRG='';
foreach($dataBRG as $r){
	$selected=(@$_POST['add_supplier_id']==$r['supplier_id'])?'selected':'';
	$optionBRG.='<option value="'.$r['supplier_id'].'" '.$selected.' >'.$r['supplier'].' || Rp. '.$r['harga'].' </option>';
}


/* adodb_pr($data); */
?>
<section class="content">
  <div class="box box-primary">
	<div class="box-header with-border">
	  <h3 class="box-title">Permintaan Barang Ke Suplayer</h3>
	</div>
	<?=  @$error ?>
	<table class="table table-striped">
	<tbody>
		<tr>
		  <td>No Permintaan</td><td>:</td><td><?= $data['permintaan_no']?></td>
		</tr>
		<tr>
		  <td>Tanggal</td><td>:</td><td><?= $data['tanggal']?></td>
		</tr>
		<tr>
		  <td>Kode Barang</td><td>:</td><td><?= $data['barang_kode']?></td>
		</tr>
		<tr>
		  <td>Kode Barang</td><td>:</td><td><?= $data['barang']?></td>
		</tr>
		<tr>
			<td>Jumlah</td></td><td>:</td><td><?= $data['permintaan_jumlah']?> . <?= $data['satuan']?> </td>
		</tr>
	</tbody>
  </table>
	<form  role="form" method="POST" enctype="multipart/form-data" action="">
	<div class="box-body">
		<div class="form-group">
			<label>Pilih Suplayer</label>
			<select name="add_supplier_id" class="form-control">
				<option value="" >Pilih Suplayer</option>
				<?= $optionBRG ?>
			</select>
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