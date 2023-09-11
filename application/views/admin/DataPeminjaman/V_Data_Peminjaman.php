<div class="mobile-menu-overlay"></div>

<div class="main-container flex-grow-1">
    <div class="pd-ltr-20 xs-pd-20-10">
        <div class="min-height-200px">
            <div class="page-header">

                <div class="row align-items-center justify-content-between">
                    <div class="col-12 col-lg-6 col-xl-6">
                        <div class="title">
                            <h4>Data Peminjaman Barang Engineer</h4>
                        </div>
                        <nav aria-label="breadcrumb" role="navigation">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item">
                                    <a href="#">Data Peminjaman</a>
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
                                <a class="dropdown-item" href="<?php echo base_url('admin/DataPeminjaman/C_Add_Peminjaman') ?>">Tambah Peminjaman</a>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="container card bg-secondary mt-2">
                    <form action="<?php echo base_url('admin/DataPeminjaman/C_Data_Peminjaman') ?>" method="get">
                        <div class="row align-items-center justify-content-between p-2">

                            <div class="col-xl-6">
                                <label class="text-white fs-2" for="tahun">Tanggal : </label>

                                <input type="date" name="day" id="day" class="form-control" value="<?php if (isset($dayGET) && $dayGET != '') {
                                                                                                        echo $dayGET;
                                                                                                    } else {
                                                                                                        echo $day;
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
                        <table id="datapeminjaman" class="table table-bordered responsive nowrap" style="width: 100%;">
                            <thead>
                                <tr>
                                    <th width="5%">No</th>
                                    <th width="15%">Nama Barang</th>
                                    <th width="15%">Nama Pegawai</th>
                                    <th width="15%">Tanggal</th>
                                    <th width="10%">Jumlah</th>
                                    <th width="15%">Keterangan</th>
                                    <th width="10%">Status</th>
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