<?php 
include'header.php'; 
$error='';
?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
	<?php
		$dataKelas=$system->db->getAll('select a.* , b.barang_kode,barang,satuan from pengeluaran as a, barang as b where a.barang_id=b.barang_id order by a.pengeluaran_id DESC');
		$tabel='';
		$no=1;
		foreach($dataKelas as $r){
			$tabel.='<tr>
						<td>'.$no.'</td>
						<td>'.strtoupper($r['no_pengeluaran']).'</td>
						<td>'.$r['tanggal_pengajuan'].'</td>
						<td> '.$r['barang_kode'].'</td>
						<td> '.$r['barang'].'</td>
						<td>'.$r['jumlah_permintaan'].' / '.$r['satuan'].'</td>
						<td> '.$r['permintaan_dari'].'</td>
						<td width="50" ><a href="print-nota-pengeluaran.html?id='.$r['pengeluaran_id'].'" class="btn btn-block btn-success"><i class="fa fa-print"></i></a></td>
						
					</tr>	';
			$no++;
		} 
	?>
    <!-- Main content -->
    <section class="content">
		<div class="box">
            <div class="box-header">
              <h3 class="box-title">Data Pengeluaran Barang</h3>
			  <div class="box-tools">
                <a href="pengeluaran.add.html" class="btn btn-block btn-primary"><i class="fa fa-plus"> Tambah</i></a>
              </div>
            </div>
            <!-- /.box-header -->
            <div class="box-body no-padding">
				<?= $error ?>
              <table class="table table-striped">
                <tbody>
				<tr>
                  <th width="40" >#</th>
                  <th>No Pengeluaran</th>
                  <th>Tanggal Pengajuan</th>
                  <th>Kode Barang</th>
                  <th>Nama Barang</th>
                  <th>Jumlah</th>
                  <th>Permintaan Dari</th>
                  
                  <th colspan="2" class="text-center" >Ation</th>
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