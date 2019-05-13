<?php 
include'header.php'; 
$error='';
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
						<td>'.$r['jumlah'].'</td>
						<td>'.$r['supplier'].'</td>
						<td>'.$status.'</td>
						<td><a href="imput-pernerimaan.html?id='.$r['pembelian_id'].'"><span class="label label-success">Terima Barang</span></a></td>
						
					</tr>	';
			$no++;
		} 
	?>
    <!-- Main content -->
    <section class="content">
		<div class="box">
            <div class="box-header">
              <h3 class="box-title">Data Penerimaan Barang Dari Suplayer</h3>
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
                  <th>Barang</th>
                  <th>Jumlah </th>
                  <th>Suplayer</th>
                  <th>Status</th>
                  <th  >Act</th>
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