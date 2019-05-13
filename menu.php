<ul class="sidebar-menu" data-widget="tree">
	<li class="header">MAIN NAVIGATION</li>
	<li class="active"><a href="index_admin.html"><i class="fa fa-home"></i> Dashboard</a></li>
	<?php if($_SESSION['akses']=='gudang'){ ?>

		<li class="treeview">
		  <a href="#">
			<i class="fa fa-laptop"></i>
			<span>Master Data</span>
			<span class="pull-right-container">
			  <i class="fa fa-angle-left pull-right"></i>
			</span>
		  </a>
		  <ul class="treeview-menu">
			<li><a href="barang.html"><i class="fa fa-circle-o"></i> Barang</a></li>
			<li><a href="supplier.html"><i class="fa fa-circle-o"></i> Supplier</a></li>
		  </ul>
		</li>
		<li class=""><a href="pengeluaran.html"><i class="fa fa-laptop"></i> Pengeluaran Barang</a></li>		
		<li class="treeview">
		  <a href="#">
			<i class="fa fa-laptop"></i>
			<span>Permintaan</span>
			<span class="pull-right-container">
			  <i class="fa fa-angle-left pull-right"></i>
			</span>
		  </a>
		  <ul class="treeview-menu">
			<li ><a href="permintaan.html"><i class="fa fa-circle-o"></i> Permintaan Barang</a></li>
			<li><a href="penawaran-supplier.html"><i class="fa fa-circle-o"></i> Tambah Penawaran Supplier</a></li>
			<li><a href="list-reg-sup.html.html"><i class="fa fa-circle-o"></i> List Po Supplier</a></li>
			<li><a href="cek.html"><i class="fa fa-circle-o"></i> Cek Penerimaan Barang</a></li>
		  </ul>
		</li>
		
		
		
		<li class="treeview">
		  <a href="#">
			<i class="fa fa-edit"></i> <span>Akun</span>
			<span class="pull-right-container">
			  <i class="fa fa-angle-left pull-right"></i>
			</span>
		  </a>
		  <ul class="treeview-menu">
			<li><a href="logout.html"><i class="fa fa-circle-o"></i> Admin</a></li>
		  </ul>
		</li>
		
	<?php } ?>
</ul>


