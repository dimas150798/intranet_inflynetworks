<div class="mobile-menu-overlay"></div>

<div class="main-container flex-grow-1">
    <div class="pd-ltr-20 xs-pd-20-10">
        <div class="min-height-200px">

            <!-- Header Edit Customer -->
            <div class="page-header">
                <div class="row">
                    <div class="col-md-6 col-sm-12">
                        <div class="title">
                            <h4>Form Edit Data Terminasi</h4>
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
            <!-- Header End Edit Customer -->

            <!-- Form Edit Customer -->
            <div class="card-box p-5">

                <?php foreach ($DataCustomer as $data) : ?>
                    <form method="POST" action="<?php echo base_url('admin/DataTerminasi/C_Edit_Terminasi/EditSave') ?>">
                        <div class="form-group row">
                            <div class="row">
                                <input type="hidden" class="form-control" name="id_customer" id="id_customer" value="<?php echo $data['id_customer'] ?>" readonly>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="" class="col-sm-12 col-md-3 col-form-label" style="font-weight: bold;"> Nama Customer <span class="text-danger">*</span></label>
                            <div class="col-sm-12 col-md-9">
                                <input class="form-control" name="nama_customer" value="<?php echo $data['nama_customer'] ?>" placeholder="Masukkan Nama Customer..." />
                                <div class="bg-danger">
                                    <small class="text-white"><?php echo form_error('nama_customer'); ?></small>
                                </div>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="" class="col-sm-12 col-md-3 col-form-label" style="font-weight: bold;"> Nama Paket <span class="text-danger">*</span></label>
                            <div class="col-sm-12 col-md-9">
                                <select id="pembelian_paket" name="pembelian_paket" class="form-control" required>
                                    <option value="" disabled selected>Pilih Paket :</option>
                                    <?php foreach ($DataPaket as $dataPaket) : ?>
                                        <option value="<?php echo $dataPaket['nama_paket']; ?>" <?= $data['pembelian_paket'] == $dataPaket['nama_paket'] ? 'selected' : null ?>><?php echo $dataPaket['nama_paket']; ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="" class="col-sm-12 col-md-3 col-form-label" style="font-weight: bold;"> NIK <span class="text-danger">*</span></label>
                            <div class="col-sm-12 col-md-9">
                                <input class="form-control" name="nik_customer" value="<?php echo $data['nik_customer'] ?>" placeholder="Masukkan NIK Customer..." />
                                <div class="bg-danger">
                                    <small class="text-white"><?php echo form_error('nik_customer'); ?></small>
                                </div>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="" class="col-sm-12 col-md-3 col-form-label" style="font-weight: bold;"> Telephone <span class="text-danger">*</span></label>
                            <div class="col-sm-12 col-md-9">
                                <input class="form-control" name="tlp_customer" value="<?php echo $data['tlp_customer'] ?>" placeholder="Masukkan Telephone Customer..." />
                                <div class="bg-danger">
                                    <small class="text-white"><?php echo form_error('tlp_customer'); ?></small>
                                </div>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="" class="col-sm-12 col-md-3 col-form-label" style="font-weight: bold;"> Alamat Customer <span class="text-danger">*</span></label>
                            <div class="col-sm-12 col-md-9">
                                <input class="form-control" name="alamat_customer" value="<?php echo $data['alamat_customer'] ?>" placeholder="Masukkan Alamat Customer..." />
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
                                        <option value="<?php echo $dataKota['id_kota']; ?>" <?= $data['id_kota'] == $dataKota['id_kota'] ? 'selected' : null ?>><?php echo $dataKota['nama_kota']; ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="" class="col-sm-12 col-md-3 col-form-label" style="font-weight: bold;"> Kecamatan <span class="text-danger">*</span></label>
                            <div class="col-sm-12 col-md-9">
                                <select id="kecamatan" name="kecamatan" class="custom-select col-8" required>
                                    <option value="" disabled selected>Kecamatan :</option>
                                    <?php foreach ($DataKecamatan as $dataKecamatan) : ?>
                                        <option value="<?php echo $dataKecamatan['id_kecamatan']; ?>" <?= $data['id_kecamatan'] == $dataKecamatan['id_kecamatan'] ? 'selected' : null ?>><?php echo $dataKecamatan['nama_kecamatan']; ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="" class="col-sm-12 col-md-3 col-form-label" style="font-weight: bold;"> Kelurahan <span class="text-danger">*</span></label>
                            <div class="col-sm-12 col-md-9">
                                <select id="kelurahan" name="kelurahan" class="custom-select col-8" required>
                                    <option value="" disabled selected>Kelurahan :</option>
                                    <?php foreach ($DataKelurahan as $dataKelurahan) : ?>
                                        <option value="<?php echo $dataKelurahan['id_kelurahan']; ?>" <?= $data['id_kelurahan'] == $dataKelurahan['id_kelurahan'] ? 'selected' : null ?>><?php echo $dataKelurahan['nama_kelurahan']; ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="" class="col-sm-12 col-md-3 col-form-label" style="font-weight: bold;"> Tanggal Registrasi <span class="text-danger">*</span></label>
                            <div class="col-sm-12 col-md-9">
                                <input class="form-control" type="date" name="date" value="<?php echo $data['date'] ?>" />
                                <div class="bg-danger">
                                    <small class="text-white"><?php echo form_error('date'); ?></small>
                                </div>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="" class="col-sm-12 col-md-3 col-form-label" style="font-weight: bold;"> Tanggal Terminasi<span class="text-danger">*</span></label>
                            <div class="col-sm-12 col-md-9">
                                <input class="form-control" type="date" name="date_terminasi" value="<?php echo $data['date_terminasi'] ?>" />
                                <div class="bg-danger">
                                    <small class="text-white"><?php echo form_error('date_terminasi'); ?></small>
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
            <!-- End Form Edit Customer -->


        </div>
    </div>
</div>