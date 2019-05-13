<?php 
include'header.php'; 
$error='';
?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
	<?php
		$dataKelas=$system->db->getAll("select * from barang order by barang ASC");
		$tabel='';
		$no=1;
		foreach($dataKelas as $r){
			$tabel.='<tr>
						<td>'.$no.'</td>
						<td>'.$r['barang_kode'].'</td>
						<td>'.strtoupper($r['barang']).'</td>
						<td>'.$r['stok'].'</td>
						<td>'.$r['satuan'].'</td>
						<td width="50" ><a href="barang.edit.html?id='.$r['barang_id'].'" class="btn btn-block btn-success"><i class="fa fa-edit"></i></a></td>
						
					</tr>	';
			$no++;
		}
	?>
    <!-- Main content -->
    <section class="content">
		<div class="box">
            <div class="box-header">
              <h3 class="box-title">Data Barang</h3>
			  <div class="box-tools">
                <a href="add.barang.html" class="btn btn-block btn-primary"><i class="fa fa-plus"> Tambah</i></a>
              </div>
            </div>
            <!-- /.box-header -->
            <div class="box-body no-padding">
				<?= $error ?>
              <table class="table table-striped">
                <tbody>
				<tr>
                  <th width="40" >#</th>
				  <th>Kode Barang</th>
                  <th>Nama Barang</th>
                  <th>Stok</th>
                  <th>Satuan</th>
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