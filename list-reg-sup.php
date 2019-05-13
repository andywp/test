<?php 
include'header.php'; 
$error='';
if($_GET['id'] !='' && $_GET['status'] !='' ){
	$approve=($_GET['status']=='Terima')?1:0;	
	$query='update pembelian set approve="'.$approve='" where pembelian_id='.$_GET['id'];
	$simpan=$system->db->execute($query);
	if($simpan){
		$error=alert('success','Data Berhasil Disimpan');
	 }else{
		$error=alert('error','Opps Gagal menyimpan');
	}   
}
?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
	<?php
		$dataKelas=$system->db->getAll('select * from pembelian order by pembelian_id DESC');
		/* adodb_pr($dataKelas); */
		$tabel='';
		$no=1;
		foreach($dataKelas as $r){
			
			$status=($r['status']==0)?'Proses':'Selesai';
			$tabel.='<tr>
						<td>'.$no.'</td>
						<td>'.strtoupper($r['po']).'</td>
						<td>'.$r['tanggal_po'].'</td>
						<td> '.$r['barang_kode'].' '.$r['barang'].'</td>
						<td> '.$r['tanggal_permintaan'].'</td>
						<td>'.$r['jumlah'].'</td>
						<td>'.$r['harga_satuan'].'</td>
						<td>'.$r['total_haraga'].'</td>
						<td>'.$r['supplier'].'</td>
						<td>'.$status.'</td>
						<td><a href="list-reg-sup.html?id='.$r['pembelian_id'].'&status=Terima"><span class="label label-success">Terima</span></a></td>
						<td><a href="list-reg-sup.html?id='.$r['pembelian_id'].'$status=Tolak"><span class="label label-danger">Tolak</span></a></td>
					</tr>	';
			$no++;
		} 
	?>
    <!-- Main content -->
    <section class="content">
		<div class="box">
            <div class="box-header">
              <h3 class="box-title">Data Penawaran harga Suplayer</h3>
			  <div class="box-tools">
                <a href="permintaan.add.html" class="btn btn-block btn-primary"><i class="fa fa-plus"> Tambah</i></a>
              </div>
            </div>
            <!-- /.box-header -->
            <div class="box-body no-padding">
				<?= $error ?>
              <table class="table table-striped">
                <tbody>
				<tr>
                  <th width="40" >#</th>
                  <th>No PO</th>
                  <th>Tanggal PO</th>
                  <th>Permintan No</th>
                  <th>Barang</th>
                  <th>Tangga Permintaan</th>
                  <th>Jumlah </th>
				  <th>Harga @ </th>
                  <th>Total</th>
                  <th>Suplayer</th>
                  <th>Status</th>
                  <th class="text-center" colspan="2" >Act</th>
                  
                </tr>
                <?= $tabel ?>
				</tbody>
			  </table>
            </div>
            <!-- /.box-body -->
			<div class="box-footer clearfix">
				<?#= $peging ?>
			</div>
          </div>
    </section>
</div>
<?php include 'footer.php'; ?>