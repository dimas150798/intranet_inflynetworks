<div class="mobile-menu-overlay"></div>

<div class="main-container flex-grow-1">
    <div class="pd-ltr-20 xs-pd-20-10">
        <div class="min-height-200px">

            <!-- Header Tambah Pelanggan -->
            <div class="page-header">
                <div class="row">
                    <div class="col-md-6 col-sm-12">
                        <div class="title">
                            <h4>Form Edit Data Pegawai</h4>
                        </div>
                        <nav aria-label="breadcrumb" role="navigation">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item">
                                    <a href="<?php echo base_url('admin/DataPegawai/C_Data_Pegawai') ?>">Data Pegawai</a>
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
            <div class="pd-20 card-box mb-30">

                <?php foreach ($DataPegawai as $data) : ?>
                    <form method="POST" action="<?php echo base_url('admin/DataPegawai/C_Edit_Pegawai/EditPegawaiSave') ?>" enctype="multipart/form-data">
                        <div class="form-group row">
                            <div class="row">
                                <input type="hidden" class="form-control" name="id_pegawai" id="id_pegawai" value="<?php echo $data['id_pegawai'] ?>" readonly>
                            </div>
                        </div>
                        <div class=" form-group row">
                            <label class="col-sm-12 col-md-2 col-form-label">Nama Pegawai </label>
                            <div class="col-sm-12 col-md-10">
                                <input class="form-control" name="nama_pegawai" value="<?php echo $data['nama_pegawai'] ?>" placeholder="Masukkan nama pegawai..." />
                                <div class="bg-danger">
                                    <small class="text-white"><?php echo form_error('nama_pegawai'); ?></small>
                                </div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-12 col-md-2 col-form-label">NIK </label>
                            <div class="col-sm-12 col-md-10">
                                <input class="form-control" name="nik" value="<?php echo $data['NIK'] ?>" placeholder="Masukkan No Induk Karyawan..." />
                                <div class="bg-danger">
                                    <small class="text-white"><?php echo form_error('nik'); ?></small>
                                </div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-12 col-md-2 col-form-label">Telephon</label>
                            <div class="col-sm-12 col-md-10">
                                <input class="form-control" name="no_telpon" value="<?php echo $data['no_telpon'] ?>" placeholder="Masukkan No Telephon..." />
                                <div class="bg-danger">
                                    <small class="text-white"><?php echo form_error('no_telpon'); ?></small>
                                </div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-12 col-md-2 col-form-label">Alamat</label>
                            <div class="col-sm-12 col-md-10">
                                <input class="form-control" name="alamat_pegawai" value="<?php echo $data['alamat_pegawai'] ?>" placeholder="Masukkan Alamat..." />
                                <div class="bg-danger">
                                    <small class="text-white"><?php echo form_error('alamat_pegawai'); ?></small>
                                </div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-12 col-md-2 col-form-label">Pendidikan</label>
                            <div class="col-sm-12 col-md-10">
                                <select name="pendidikan_pegawai" class="custom-select col-12" value="<?php echo $data['pendidikan_pegawai'] ?>">
                                    <option disabled selected>Pilih Pendidikan</option>
                                    <option value="SMA/SMK/MA" <?php if ($data['pendidikan_pegawai'] === 'SMA/SMK/MA') echo 'selected'; ?>>SMA/SMK/MA</option>
                                    <option value="D3" <?php if ($data['pendidikan_pegawai'] === 'D3') echo 'selected'; ?>>D3</option>
                                    <option value="D4" <?php if ($data['pendidikan_pegawai'] === 'D4') echo 'selected'; ?>>D4</option>
                                    <option value="S1" <?php if ($data['pendidikan_pegawai'] === 'S1') echo 'selected'; ?>>S1</option>
                                    <option value="S2" <?php if ($data['pendidikan_pegawai'] === 'S2') echo 'selected'; ?>>S2</option>
                                </select>
                                <div class="bg-danger">
                                    <small class="text-white"><?php echo form_error('pendidikan_pegawai'); ?></small>
                                </div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-12 col-md-2 col-form-label">Jabatan</label>
                            <div class="col-sm-12 col-md-10">
                                <input class="form-control" name="jabatan" value="<?php echo $data['jabatan'] ?>" placeholder="Masukkan Jabatan..." />
                                <div class="bg-danger">
                                    <small class="text-white"><?php echo form_error('jabatan'); ?></small>
                                </div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-12 col-md-2 col-form-label">Tanggal Masuk</label>
                            <div class="col-sm-12 col-md-10">
                                <input class="form-control date-picker" name="tanggal_masuk" value="<?php echo $data['tanggal_masuk'] ?>" placeholder="Tanggal Masuk..." />
                                <div class="bg-danger">
                                    <small class="text-white"><?php echo form_error('tanggal_masuk'); ?></small>
                                </div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-12 col-md-2 col-form-label">Gaji</label>
                            <div class="col-sm-12 col-md-10">
                                <input class="form-control" name="gaji" value="<?php echo $data['gaji'] ?>" placeholder="Masukkan Gaji..." />
                                <div class="bg-danger">
                                    <small class="text-white"><?php echo form_error('gaji'); ?></small>
                                </div>
                            </div>
                        </div>
                        <!-- <div class="form-group row">
                            <label class="col-sm-12 col-md-2 col-form-label">Foto </label>
                            <div class="col-sm-12 col-md-10">
                                <input type="file" name="photo" accept="image/*" class="form-control-file form-control height-auto">
                                <?php if (!empty($data['photo'])) : ?>
                                    <p>Photo: <?php echo $data['photo']; ?></p>
                                <?php endif; ?>
                                <div class="bg-danger">
                                    <small class="text-white"><?php echo form_error('photo'); ?></small>
                                </div>
                            </div>
                        </div> -->
                        <div class="form-group row">
                            <div class="col-sm-12 d-flex justify-content-end">
                                <button type="submit" class="btn btn-success mt-2 justify-content-end"><i class="bi bi-plus-circle"></i> Simpan</button>
                            </div>
                        </div>
                    </form>
                <?php endforeach; ?>
            </div>
            <!-- End Form Tambah Pelanggan -->


        </div>
    </div>
</div>