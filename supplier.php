<?php 
include'header.php'; 
$error='';
?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
	<?php
		$dataKelas=$system->db->getAll("select a.* , b.barang,satuan,barang_kode from supplier as a, barang as b where a.barang_id=b.barang_id order by a.supplier_id DESC");
		$tabel='';
		$no=1;
		foreach($dataKelas as $r){
			$tabel.='<tr>
						<td>'.$no.'</td>
						<td>'.strtoupper($r['supplier']).'</td>
						<td> '.$r['barang_kode'].' || '.$r['barang'].'</td>
						<td>'.$r['harga'].' / '.$r['satuan'].'</td>
						<td width="50" ><a href="supplier.edit.html?id='.$r['supplier_id'].'" class="btn btn-block btn-success"><i class="fa fa-edit"></i></a></td>
						
					</tr>	';
			$no++;
		}
	?>
    <!-- Main content -->
    <section class="content">
		<div class="box">
            <div class="box-header">
              <h3 class="box-title">Data Supplier</h3>
			  <div class="box-tools">
                <a href="supplier.add.html" class="btn btn-block btn-primary"><i class="fa fa-plus"> Tambah</i></a>
              </div>
            </div>
            <!-- /.box-header -->
            <div class="box-body no-padding">
				<?= $error ?>
              <table class="table table-striped">
                <tbody>
				<tr>
                  <th width="40" >#</th>
                  <th>Nama Supplier</th>
                  <th>Barang</th>
                  <th>Harga</th>
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