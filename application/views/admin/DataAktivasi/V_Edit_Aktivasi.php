<div class="mobile-menu-overlay"></div>

<div class="main-container flex-grow-1">
    <div class="pd-ltr-20 xs-pd-20-10">
        <div class="min-height-200px">

            <!-- Header Edit Aktivasi -->
            <div class="page-header">
                <div class="row">
                    <div class="col-md-6 col-sm-12">
                        <div class="title">
                            <h4>Form Edit Data Aktivasi</h4>
                        </div>
                        <nav aria-label="breadcrumb" role="navigation">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item">
                                    <a href="#">Data Aktivasi</a>
                                </li>
                                <li class="breadcrumb-item active" aria-current="page">
                                    Form
                                </li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
            <!-- Header End Edit Aktivasi -->

            <!-- Form Edit Aktivasi -->
            <div class="card-box p-5">

                <?php foreach ($DataAktivasi as $data) : ?>
                    <form method="POST" action="<?php echo base_url('admin/DataAktivasi/C_Edit_Aktivasi/EditSave') ?>">
                        <div class="form-group row">
                            <div class="row">
                                <input type="hidden" class="form-control" name="id_aktivasi" id="id_aktivasi" value="<?php echo $data['id_aktivasi'] ?>" readonly>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="" class="col-sm-12 col-md-3 col-form-label" style="font-weight: bold;"> Nama Customer <span class="text-danger">*</span></label>
                            <div class="col-sm-12 col-md-9">
                                <input class="form-control" name="nama_customer" value="<?php echo $data['nama_customer'] ?>" placeholder="Masukkan Nama Customer..." readonly />
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="" class="col-sm-12 col-md-3 col-form-label" style="font-weight: bold;"> Nama Barang <span class="text-danger">*</span></label>
                            <div class="col-sm-12 col-md-9">
                                <input class="form-control" name="kode_barang" value="<?php echo $data['nama_barang'] ?>" placeholder="Masukkan Nama Customer..." readonly />
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="" class="col-sm-12 col-md-3 col-form-label" style="font-weight: bold;"> SN Modem <span class="text-danger">*</span></label>
                            <div class="col-sm-12 col-md-9">
                                <input class="form-control" name="kode_barang" value="<?php echo $data['kode_barang'] ?>" placeholder="Masukkan Nama Customer..." />
                                <div class="bg-danger">
                                    <small class="text-white"><?php echo form_error('kode_barang'); ?></small>
                                </div>
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-sm-12 d-flex justify-content-end">
                                <button type="submit" class="btn btn-success mt-2 justify-content-end"><i class="bi bi-plus-circle"></i> Simpan</button>
                            </div>
                        </div>

                    </form>
                <?php endforeach; ?>
            </div>
            <!-- End Form Edit Aktivasi -->


        </div>
    </div>
</div>