<div class="mobile-menu-overlay"></div>

<div class="main-container flex-grow-1">
    <div class="pd-ltr-20 xs-pd-20-10">
        <div class="min-height-200px">
            <div class="page-header">

                <div class="row align-items-center justify-content-between">
                    <div class="col-12 col-lg-6 col-xl-6">
                        <div class="title">
                            <h4>Foto Peminjaman Barang</h4>
                        </div>
                        <nav aria-label="breadcrumb" role="navigation">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item">
                                    <a href="#">Foto Peminjaman</a>
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
                                <a class="dropdown-item" href="<?php echo base_url('admin/DataPeminjaman/C_AddFoto_Peminjaman') ?>">Tambah Foto</a>
                                <a class="dropdown-item" href="<?php echo base_url('admin/DataPeminjaman/C_Data_Peminjaman') ?>">Data Peminjaman</a>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="container card bg-secondary mt-2">
                    <form action="<?php echo base_url('admin/DataPeminjaman/C_Foto_Peminjaman') ?>" method="get">
                        <div class="row align-items-center justify-content-between p-2">

                            <div class="col-xl-6">
                                <label class="text-white fs-2" for="tahun">Tanggal : </label>

                                <input type="date" name="day" id="day" class="form-control" value="<?php if ($this->session->userdata('dayGET') == '') {
                                                                                                        echo $this->session->userdata('day');
                                                                                                    } else {
                                                                                                        echo $this->session->userdata('dayGET');
                                                                                                    } ?>">
                            </div>

                            <div class="col-6 col-xl-auto mt-2">
                                <button type="submit" class="btn btn-info mt-2 justify-content-start">Tampilkan</button>
                            </div>

                        </div>
                    </form>
                </div>
            </div>

            <!-- Table Data Pegawai -->
            <div class="card-box">
                <div class="container-fluid">
                    <div class="p-2" style="overflow-x: auto;">
                        <table id="fotopeminjaman" class="table table-bordered responsive nowrap" style="width: 100%;">
                            <thead>
                                <tr>
                                    <th width="5%">No</th>
                                    <th width="10%">Nama Pegawai</th>
                                    <th width="15%">Foto Peminjaman</th>
                                    <th width="10%">Foto Peminjaman</th>
                                    <th width="15%">Foto Pengembalian</th>
                                    <th width="10%">Foto Pengembalian</th>
                                    <th width="10%">Tanggal Peminjaman</th>
                                    <th width="10%">Tanggal Pengembalian</th>
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