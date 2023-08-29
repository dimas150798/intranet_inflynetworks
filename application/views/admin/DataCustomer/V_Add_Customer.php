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

                            <div class="row mt-3">
                                <div class="col-sm-4">
                                    <label for="name_pppoe" class="form-label" style="font-weight: bold;"> Name PPPOE : <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" name="name_pppoe" id="name_pppoe" value="" placeholder="Masukkan nama pelanggan...">
                                    <div class="bg-danger">
                                        <small class="text-white"><?php echo form_error('name_pppoe'); ?></small>
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <label for="password_pppoe" class="form-label" style="font-weight: bold;"> Password PPPOE : <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" name="password_pppoe" id="password_pppoe" value="" placeholder="Masukkan nama pelanggan...">
                                    <div class="bg-danger">
                                        <small class="text-white"><?php echo form_error('password_pppoe'); ?></small>
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <label for="phone_customer" class="form-label" style="font-weight: bold;"> No. Telephone : <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" name="phone_customer" id="phone_customer" value="" placeholder="Masukkan nama pelanggan...">
                                    <div class="bg-danger">
                                        <small class="text-white"><?php echo form_error('phone_customer'); ?></small>
                                    </div>
                                </div>
                            </div>

                            <div class="row mt-3">
                                <div class="col-sm-4">
                                    <label for="id_paket" class="form-label" style="font-weight: bold;"> Paket : <span class="text-danger">*</span></label>
                                    <select id="id_paket" name="id_paket" class="form-control" required>
                                        <option value="">Pilih Paket :</option>
                                        <?php foreach ($DataPaket as $dataPaket) : ?>
                                            <option value="<?php echo $dataPaket['id_paket']; ?>">
                                                <?php echo $dataPaket['nama_paket']; ?>
                                            </option>
                                        <?php endforeach; ?>
                                    </select>
                                    <div class="bg-danger">
                                        <small class="text-white"><?php echo form_error('id_paket'); ?></small>
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <label for="id_area" class="form-label" style="font-weight: bold;"> Kode DP dan Area : <span class="text-danger">*</span></label>
                                    <select id="id_area" name="id_area" class="form-control" required>
                                        <option value="">Pilih Area :</option>
                                        <?php foreach ($DataArea as $dataArea) : ?>
                                            <option value="<?php echo $dataArea['id_area']; ?>">
                                                <?php echo $dataArea['nama_area']; ?>
                                            </option>
                                        <?php endforeach; ?>
                                    </select>
                                    <div class="bg-danger">
                                        <small class="text-white"><?php echo form_error('id_area'); ?></small>
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <label for="id_sales" class="form-label" style="font-weight: bold;"> Sales : <span class="text-danger">*</span></label>
                                    <select id="id_sales" name="id_sales" class="form-control" required>
                                        <option value="">Pilih Sales :</option>
                                        <?php foreach ($DataSales as $dataSales) : ?>
                                            <option value="<?php echo $dataSales['id_sales']; ?>">
                                                <?php echo $dataSales['nama_sales']; ?>
                                            </option>
                                        <?php endforeach; ?>
                                    </select>
                                    <div class="bg-danger">
                                        <small class="text-white"><?php echo form_error('id_sales'); ?></small>
                                    </div>
                                </div>
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