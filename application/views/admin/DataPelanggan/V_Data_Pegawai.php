	<div class="mobile-menu-overlay"></div>

	<div class="main-container">
		<div class="pd-ltr-20 xs-pd-20-10">
			<div class="min-height-200px">
				<div class="page-header">

					<div class="row align-items-center justify-content-between">
						<div class="col-xl-6">
							<div class="title">
								<h4>Data Pegawai</h4>
							</div>
							<nav aria-label="breadcrumb" role="navigation">
								<ol class="breadcrumb">
									<li class="breadcrumb-item">
										<a href="#">Data Pegawai</a>
									</li>
									<li class="breadcrumb-item active" aria-current="page">
										Table
									</li>
								</ol>
							</nav>
						</div>

						<div class="col-6 col-xl-auto mt-2">
							<div class="dropdown">
								<a class="btn btn-info dropdown-toggle" href="#" role="button" data-toggle="dropdown">
									Fitur
								</a>
								<div class="dropdown-menu dropdown-menu-right">
									<a class="dropdown-item" href="<?php echo base_url('admin/DataPegawai/C_Add_Pegawai') ?>">Tambah Pegawai</a>
								</div>
							</div>
						</div>
					</div>
				</div>

				<!-- Table Data Pegawai -->
				<div class="card-box mb-30">
					<div class="container-fluid">
						<div class="pd-20">
							<h4 class="text-blue text-center">Data Pegawai - Infly Networks</h4>
						</div>
						<div class="pb-20">
							<table id="example" class="table table-bordered responsive nowrap" style="width: 100%;">
								<thead>
									<tr>
										<th width="5%">No</th>
										<th width="20%">Nama Pegawai</th>
										<th width="20%">NIK Pegawai</th>
										<th width="20%">Telepon</th>
										<th width="20%">Jabatan</th>
										<th width="15%">Action</th>
									</tr>
								</thead>
							</table>


						</div>
					</div>
					<!-- End Table Data Pegawai -->


				</div>