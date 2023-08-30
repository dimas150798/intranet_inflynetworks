<div class="mobile-menu-overlay"></div>

<div class="main-container flex-grow-1">
    <div class="pd-ltr-20 xs-pd-20-10">
        <div class="min-height-200px">

            <!-- Header Tambah Pelanggan -->
            <div class="page-header">
                <div class="row">
                    <div class="col-md-6 col-sm-12">
                        <div class="title">
                            <h4>Form Tambah Customer</h4>
                        </div>
                        <nav aria-label="breadcrumb" role="navigation">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item">
                                    <a href="<?php echo base_url('admin/DataCustomer/C_Data_Customer') ?>">Data Customer</a>
                                </li>
                                <li class="breadcrumb-item active" aria-current="page">
                                    Form
                                </li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
            <!-- Header End Tambah Pelanggan -->

            <!-- Form Tambah Pelanggan -->
            <div class="card-box p-5">
                <form method="POST" action="<?php echo base_url('admin/DataCustomer/C_Add_Customer/TambahCustomer') ?>" enctype="multipart/form-data">

                    <div class="form-group row">
                        <label for="" class="col-sm-12 col-md-3 col-form-label" style="font-weight: bold;"> Nama Customer <span class="text-danger">*</span></label>
                        <div class="col-sm-12 col-md-9">
                            <input class="form-control" name="nama_customer" placeholder="Masukkan Nama Customer..." />
                            <div class="bg-danger">
                                <small class="text-white"><?php echo form_error('nama_customer'); ?></small>
                            </div>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="" class="col-sm-12 col-md-3 col-form-label" style="font-weight: bold;"> Nama Paket <span class="text-danger">*</span></label>
                        <div class="col-sm-12 col-md-9">
                            <select id="pembelian_paket" name="pembelian_paket" class="form-control" required>
                                <option value="">Pilih Paket :</option>
                                <?php foreach ($DataPaket as $dataPaket) : ?>
                                    <option value="<?php echo $dataPaket['nama_paket']; ?>">
                                        <?php echo $dataPaket['nama_paket']; ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="" class="col-sm-12 col-md-3 col-form-label" style="font-weight: bold;"> NIK <span class="text-danger">*</span></label>
                        <div class="col-sm-12 col-md-9">
                            <input class="form-control" name="nik_customer" placeholder="Masukkan NIK Customer..." />
                            <div class="bg-danger">
                                <small class="text-white"><?php echo form_error('nik_customer'); ?></small>
                            </div>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="" class="col-sm-12 col-md-3 col-form-label" style="font-weight: bold;"> Telephone <span class="text-danger">*</span></label>
                        <div class="col-sm-12 col-md-9">
                            <input class="form-control" name="tlp_customer" placeholder="Masukkan Telephone Customer..." />
                            <div class="bg-danger">
                                <small class="text-white"><?php echo form_error('tlp_customer'); ?></small>
                            </div>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="" class="col-sm-12 col-md-3 col-form-label" style="font-weight: bold;"> Alamat Customer <span class="text-danger">*</span></label>
                        <div class="col-sm-12 col-md-9">
                            <input class="form-control" name="alamat_customer" placeholder="Masukkan Alamat Customer..." />
                            <div class="bg-danger">
                                <small class="text-white"><?php echo form_error('alamat_customer'); ?></small>
                            </div>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="" class="col-sm-12 col-md-3 col-form-label" style="font-weight: bold;"> Kota / Kabupaten <span class="text-danger">*</span></label>
                        <div class="col-sm-12 col-md-9">
                            <select id="kota" name="kota" class="custom-select col-8" required>
                                <option value="" disabled selected>Kota / Kabupaten :</option>
                                <?php foreach ($DataKota as $dataKota) : ?>
                                    <option value="<?php echo $dataKota['id_kota']; ?>">
                                        <?php echo $dataKota['nama_kota']; ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="" class="col-sm-12 col-md-3 col-form-label" style="font-weight: bold;"> Kecamatan <span class="text-danger">*</span></label>
                        <div class="col-sm-12 col-md-9">
                            <select id="kecamatan" name="kecamatan" disabled="" class="custom-select col-8" required>
                                <option value="">Kecamatan :</option>
                            </select>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="" class="col-sm-12 col-md-3 col-form-label" style="font-weight: bold;"> Kelurahan <span class="text-danger">*</span></label>
                        <div class="col-sm-12 col-md-9">
                            <select id="kelurahan" name="kelurahan" disabled="" class="custom-select col-8" required>
                                <option value="">Kelurahan :</option>
                            </select>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="" class="col-sm-12 col-md-3 col-form-label" style="font-weight: bold;"> Tanggal <span class="text-danger">*</span></label>
                        <div class="col-sm-12 col-md-9">
                            <input class="form-control" type="date" name="date" />
                            <div class="bg-danger">
                                <small class="text-white"><?php echo form_error('date'); ?></small>
                            </div>
                        </div>
                    </div>

                    <div class="form-group row">
                        <div class="col-sm-12 d-flex justify-content-end">
                            <button type="submit" class="btn btn-success mt-2 justify-content-end"><i class="bi bi-plus-circle"></i> Simpan</button>
                        </div>
                    </div>
                </form>
            </div>
            <!-- End Form Tambah Pelanggan -->


        </div>
    </div>
</div>