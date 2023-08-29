<div class="mobile-menu-overlay"></div>

<div class="main-container">
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
            <div class="pd-20 card-box mb-30">
                <form method="POST" action="<?php echo base_url('admin/DataCustomer/C_Add_Customer/TambahCustomer') ?>" enctype="multipart/form-data">
                    <!-- Nama Customer -->
                    <div class=" form-group row">
                        <label class="col-sm-12 col-md-2 col-form-label">Nama Customer </label>
                        <div class="col-sm-12 col-md-10">
                            <input class="form-control" name="nama_customer" placeholder="Masukkan nama customer" />
                            <div class="bg-danger">
                                <small class="text-white"><?php echo form_error('nama_customer'); ?></small>
                            </div>
                        </div>
                    </div>
                    <!-- NIK Customer -->
                    <div class="form-group row">
                        <label class="col-sm-12 col-md-2 col-form-label">NIK </label>
                        <div class="col-sm-12 col-md-10">
                            <input class="form-control" name="nik_customer" placeholder="Masukkan No Induk Customer..." />
                            <div class="bg-danger">
                                <small class="text-white"><?php echo form_error('nik'); ?></small>
                            </div>
                        </div>
                    </div>
                    <!-- Pembelian Paket -->
                    <div class="form-group row">
                        <label class="col-sm-12 col-md-2 col-form-label">Pembelian Paket </label>
                        <div class="col-sm-12 col-md-10">
                            <!-- <input class="form-control" name="pembelian_paket" placeholder="Pilih Paket..." /> -->
                            <select name="nama_paket" id="id_paket" class="form-control" required>
                                <option value="">Pilih Paket :</option>
                                <?php foreach ($DataPaket as $dataPaket) : ?>
                                    <option value="<?php echo $dataPaket['id_paket']; ?>">
                                        <?php echo $dataPaket['nama_paket']; ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                            <div class="bg-danger">
                                <small class="text-white"><?php echo form_error('pembelian_paket'); ?></small>
                            </div>
                        </div>
                    </div>
                    <!-- Nomor Customer -->
                    <div class="form-group row">
                        <label class="col-sm-12 col-md-2 col-form-label">Telephon</label>
                        <div class="col-sm-12 col-md-10">
                            <input class="form-control" name="tlp_customer" placeholder="Masukkan No Telephon..." />
                            <div class="bg-danger">
                                <small class="text-white"><?php echo form_error('tlp_customer'); ?></small>
                            </div>
                        </div>
                    </div>
                    <!-- Alamat Customer -->
                    <div class="form-group row">
                        <label class="col-sm-12 col-md-2 col-form-label">Alamat</label>
                        <div class="col-sm-12 col-md-10">
                            <input class="form-control" name="alamat_customer" placeholder="Masukkan Alamat..." />
                            <div class="bg-danger">
                                <small class="text-white"><?php echo form_error('alamat_customer'); ?></small>
                            </div>
                        </div>
                    </div>
                    <!-- <div class="form-group row">
                        <label class="col-sm-12 col-md-2 col-form-label">Pendidikan</label>
                        <div class="col-sm-12 col-md-10">
                            <select name="pendidikan_customer" class="custom-select col-12">
                                <option disabled selected>Pilih Pendidikan</option>
                                <option value="SMA/SMK/MA">SMA/SMK/MA</option>
                                <option value="D3">D3</option>
                                <option value="D4">D4</option>
                                <option value="S1">S1</option>
                                <option value="S2">S2</option>
                            </select>
                            <div class="bg-danger">
                                <small class="text-white"><?php echo form_error('pendidikan_customer'); ?></small>
                            </div>
                        </div>
                    </div> -->
                    <!-- Tanggal Registrasi -->
                    <div class="form-group row">
                        <label class="col-sm-12 col-md-2 col-form-label">Tanggal Registrasi</label>
                        <div class="col-sm-12 col-md-10">
                            <input class="form-control" type="date" name="date" placeholder="Tanggal Masuk..." />
                            <div class="bg-danger">
                                <small class="text-white"><?php echo form_error('date'); ?></small>
                            </div>
                        </div>
                    </div>
                    <!-- Kode Barang -->
                    <div class="form-group row">
                        <label class="col-sm-12 col-md-2 col-form-label">Kode Barang</label>
                        <div class="col-sm-12 col-md-10">
                            <input class="form-control" name="kode_barang" placeholder="Masukkan Kode Barang..." />
                            <div class="bg-danger">
                                <small class="text-white"><?php echo form_error('kode_barang'); ?></small>
                            </div>
                        </div>
                    </div>
                    <!-- Kode Barang STB -->
                    <div class="form-group row">
                        <label class="col-sm-12 col-md-2 col-form-label">Kode Barang STB</label>
                        <div class="col-sm-12 col-md-10">
                            <input class="form-control" name="kode_barang_stb" placeholder="Masukkan Kode Barang STB..." />
                            <div class="bg-danger">
                                <small class="text-white"><?php echo form_error('gaji'); ?></small>
                            </div>
                            <div class="bg-danger">
                                <small class="text-white"><?php echo form_error('kode_barang_stb'); ?></small>
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