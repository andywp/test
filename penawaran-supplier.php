<?php 
include'header.php'; 
$error='';
?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
	<?php
		$dataKelas=$system->db->getAll('select a.* , b.barang_kode,barang,satuan from permintaan as a, barang as b where a.barang_id=b.barang_id order by a.permintaan_id DESC');
		$tabel='';
		$no=1;
		foreach($dataKelas as $r){
			
			$status=($r['status']==0)?'Proses':'Selesai';
			$act=($r['status']==0)?'<a href="form-per-suplayer.html?id='.$r['permintaan_id'].'" class="btn btn-block btn-success">Buat Penawaran</a>':'Selesai';
			$tabel.='<tr>
						<td>'.$no.'</td>
						<td>'.strtoupper($r['permintaan_no']).'</td>
						<td>'.$r['tanggal'].'</td>
						<td> '.$r['barang_kode'].'</td>
						<td> '.$r['barang'].'</td>
						<td>'.$r['permintaan_jumlah'].' / '.$r['satuan'].'</td>
						<td>'.$status.'</td>
						<td>'.$act.'</td>
						
					</tr>	';
			$no++;
		} 
	?>
    <!-- Main content -->
    <section class="content">
		<div class="box">
            <div class="box-header">
              <h3 class="box-title">Data Permintaan Ke Supplier</h3>
			</div>
            <!-- /.box-header -->
            <div class="box-body no-padding">
				<?= $error ?>
              <table class="table table-striped">
                <tbody>
				<tr>
                  <th width="40" >#</th>
                  <th>No Permintaan</th>
                  <th>Tanggal</th>
                  <th>Kode Barang</th>
                  <th>Nama Barang</th>
                  <th>Jumlah Permintaan</th>
                  <th>Status</th>
                  <th class="text-center" >Act</th>
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