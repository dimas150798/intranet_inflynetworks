<div class="mobile-menu-overlay"></div>

<div class="main-container flex-grow-1">
    <div class="pd-ltr-20 xs-pd-20-10">
        <div class="min-height-200px">
            <div class="page-header">

                <div class="row align-items-center justify-content-between">
                    <div class="col-12 col-lg-6 col-xl-6">
                        <div class="title">
                            <h4>Data Stock Barang Aktivasi</h4>
                        </div>
                        <nav aria-label="breadcrumb" role="navigation">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item">
                                    <a href="#">Data Barang</a>
                                </li>
                                <li class="breadcrumb-item active" aria-current="page">
                                    Table
                                </li>
                            </ol>
                        </nav>
                    </div>

                    <div class="col-12 col-lg-auto col-xl-auto mt-2">
                        <div class="dropdown">
                            <a class="btn btn-info dropdown-toggle" href="#" role="button" data-toggle="dropdown">
                                Fitur
                            </a>
                            <div class="dropdown-menu dropdown-menu-right">
                                <a class="dropdown-item" href="<?php echo base_url('admin/StockBarangAll/C_Stock_BarangAll') ?>">Semua Barang</a>
                                <a class="dropdown-item" href="<?php echo base_url('admin/StockBarangAktivasi/C_Barang_Aktivasi') ?>">Barang Aktivasi</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Table Data Pegawai -->
            <div class="card-box">
                <div class="container-fluid">
                    <div class="p-2" style="overflow-x: auto;">
                        <table id="barangaktivasi" class="table table-bordered responsive nowrap" style="width: 100%;">
                            <thead>
                                <tr>
                                    <th width="5%">No</th>
                                    <th width="20%">Nama Barang</th>
                                    <th width="10%">Stock</th>
                                    <th width="10%">Mutasi</th>
                                    <th width="10%">Rusak</th>
                                    <th width="15%">Last Restock</th>
                                    <th width="15%">Last Mutasi</th>
                                    <th width="15%">Action</th>
                                </tr>
                            </thead>
                        </table>
                    </div>
                </div>
            </div>
            <!-- End Table Data Pegawai -->

        </div>
    </div>
</div>