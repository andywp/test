<?php 
include'header.php'; 
$error='';
$nota=false;
?>
<div class="content-wrapper">
<?php
$data=$system->db->getRow('select * from pembelian where pembelian_id='.$_GET['id']);
if(isset($_POST['simpan'])){	
	/* adodb_pr($_POST);  */  
	$notif='';
	if(empty($_POST['add_jenis'])){
		$notif.='<li>Pilih Jenis Penerima</li>';
	}
	if($_POST['add_jenis']=='Terima'){
		if(empty($_POST['add_jumlah_terima'])){
			$notif.='<li>Pilih masukan</li>';
		}
	}else{
		if(empty($_POST['add_keterangan'])){
			$notif.='<li>Masukan Keterangan</li>';
		}
	}
	if(!empty($notif)){
		$error=alert('error','<ul>'.$notif.'</ul>');
	}else{
		
		$jumlah_sisa=$system->db->getOne("select jumlah_sisa from cek where jenis='Terima' and pembelian_id='".$data['pembelian_id']."' order by cek_id DESC ");
		if($jumlah_sisa){
			$jumlah=$jumlah_sisa;
		}else{
			$jumlah=intval($data['jumlah']);
		}
		$_POST['add_jumlah_sisa']=$jumlah - $_POST['add_jumlah_terima'];
		$_POST['tanggal_terima']=date('Y-m-d');
		$_POST['pembelian_id']=$data['pembelian_id'];
		$query='';
		foreach($_POST as $key=>$val){
			if($key!='simpan'    ){
				$query.=str_replace('add_','  ',$key)."='".$val."',";
			}
		}
		 $query=' insert into cek set '.substr($query,1,-1);
		$simpan=$system->db->execute($query);
		/* $idNota = $system->db->insert_Id(); */
		if($simpan){
			$cekstok=$system->db->getOne('select stok from barang where barang_kode="'.$data['barang_kode'].'"');
			$updateStok=$cekstok+$_POST['add_jumlah_terima'];
			$Save=$system->db->execute("update barang set stok='".$updateStok."' where barang_kode='".$data['barang_kode']."'");
			if($_POST['add_jumlah_sisa']==0){
				$Save=$system->db->execute("update pembelian set status=1 where pembelian_id='".$data['pembelian_id']."'");
			}
			
			$error=alert('success','Data Berhasil Disimpan');
			$_POST=array();
			//echo '<script>window.location.href = "list-reg-sup.html?act=sukses";</script>'; 
		 }else{
			$error=alert('error','Opps Gagal menyimpan');
		}   
	}
}
/* adodb_pr($data); */
$sisa=$system->db->getOne("select jumlah_sisa from cek where jenis='Terima' and pembelian_id='".$data['pembelian_id']."' order by cek_id DESC ");
?>
<section class="content">
  <div class="box box-primary">
	<div class="box-header with-border">
	  <h3 class="box-title">Input Penerimaan Barang dari Suplayer</h3>
	</div>
	<?=  @$error ?>
	<table class="table table-striped">
	<tbody>
		<tr>
		  <td>No PO</td><td>:</td><td><?= $data['po']?></td>
		</tr>
		<tr>
		  <td>Tanggal</td><td>:</td><td><?= $data['tanggal_po']?></td>
		</tr>
		<tr>
		  <td>Kode Barang</td><td>:</td><td><?= $data['barang_kode']?></td>
		</tr>
		<tr>
		  <td>Kode Barang</td><td>:</td><td><?= $data['barang']?></td>
		</tr>
		<tr>
			<td>Jumlah</td></td><td>:</td><td><?= $data['jumlah']?>  </td>
		</tr>
	</tbody>
  </table>
  <?php if($sisa !=0){ ?>
	<form  role="form" method="POST" enctype="multipart/form-data" action="">
	<div class="box-body">
		<div class="form-group">
			<label>Pilih Jenis Terima</label>
			<select name="add_jenis" class="form-control">
				<option value="" >Pilih Jenis</option>
				<option value="Terima" >Terima</option>
				<option value="Tolak" >Tolak</option>
			</select>
		</div>		
		<div class="form-group"> 
		  <label>Jumlah Diterimah </label>
		   <input type="text" class="form-control" value="<?= !empty($_POST['add_jumlah_terima'])?$_POST['add_jumlah_terima']:''; ?>" name="add_jumlah_terima">
		</div>
		<div class="form-group"> 
		  <label>Keterangan </label>
		   <textarea name="add_keterangan" class="form-control"><?= !empty($_POST['add_keterangan'])?$_POST['add_keterangan']:''; ?></textarea>
		</div>
		<div class="box-footer">
			<button type="submit" name="simpan" class="btn btn-primary">Proses</button>
			<a href="permintaan.html" class="btn btn-info">Kembali</a>
		</div>
	  </div>
	</form>
  <?php } ?>
	<table class="table table-striped">
		<tbody>
		<tr>
		  <th width="40" >#</th>
		  <th>Tanggal</th>
		  <th>jenis</th>
		  <th>Jumlah Terima</th>
		  <th>Jumlah sisa</th>
		  <th>Kererangan</th>
		  <th class="text-center" >Act</th>
		</tr>
		<?php
			$cekData=$system->db->getAll('select * from cek where pembelian_id='.$data['pembelian_id']);
			/* adodb_pr($cekData); */
			$no=1;
			foreach($cekData as $r){
				echo '<tr>
						<td>'.$no.'</td>
						<td>'.$r['tanggal_terima'].'</td>
						<td>'.$r['jenis'].'</td>
						<td>'.$r['jumlah_terima'].'</td>
						<td>'.$r['jumlah_sisa'].'</td>
						<td>'.$r['keterangan'].'</td>
						<td><a href="cetak-nota.html?id=1" class="btn btn-block btn-success">Cetak Nota</a></td>
					</tr>';
				
				$no++;
			}
		?>
		</tbody>
	</table>
  </div>
</section>



</div>	
<?php include 'footer.php'; ?>