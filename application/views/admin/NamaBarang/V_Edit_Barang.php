<div class="mobile-menu-overlay"></div>

<div class="main-container flex-grow-1">
    <div class="pd-ltr-20 xs-pd-20-10">
        <div class="min-height-200px">

            <!-- Header Edit Nama Barang -->
            <div class="page-header">
                <div class="row">
                    <div class="col-md-6 col-sm-12">
                        <div class="title">
                            <h4>Form Edit Nama Barang</h4>
                        </div>
                        <nav aria-label="breadcrumb" role="navigation">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item">
                                    <a href="<?php echo base_url('admin/NamaBarang/C_Nama_Barang') ?>">Data Barang</a>
                                </li>
                                <li class="breadcrumb-item active" aria-current="page">
                                    Form
                                </li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
            <!-- Header End Edit Nama Barang -->

            <!-- Form Edit Nama Barang -->
            <div class="card-box p-5">

                <?php foreach ($DataBarang as $data) : ?>
                    <form method="POST" action="<?php echo base_url('admin/NamaBarang/C_Edit_Barang/EditSave') ?>">
                        <div class="form-group row">
                            <div class="row">
                                <input type="hidden" class="form-control" name="id_barang" id="id_barang" value="<?php echo $data['id_barang'] ?>" readonly>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="" class="col-sm-12 col-md-3 col-form-label" style="font-weight: bold;"> Nama Barang <span class="text-danger">*</span></label>
                            <div class="col-sm-12 col-md-9">
                                <input class="form-control" name="nama_barang" value="<?php echo $data['nama_barang'] ?>" placeholder="Masukkan Nama Barang..." />
                                <div class="bg-danger">
                                    <small class="text-white"><?php echo form_error('nama_barang'); ?></small>
                                </div>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="" class="col-sm-12 col-md-3 col-form-label" style="font-weight: bold;"> Nama Satuan <span class="text-danger">*</span></label>
                            <div class="col-sm-12 col-md-9">
                                <select id="id_satuan" name="id_satuan" class="form-control" required>
                                    <option value="" disabled selected>Pilih Satuan :</option>
                                    <?php foreach ($DataSatuan as $dataSatuan) : ?>
                                        <option value="<?php echo $dataSatuan['id_satuan']; ?>" <?= $data['id_satuan'] == $dataSatuan['id_satuan'] ? 'selected' : null ?>><?php echo $dataSatuan['nama_satuan']; ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="" class="col-sm-12 col-md-3 col-form-label" style="font-weight: bold;"> Jenis Peralatan <span class="text-danger">*</span></label>
                            <div class="col-sm-12 col-md-9">
                                <select id="id_peralatan" name="id_peralatan" class="form-control" required>
                                    <option value="" disabled selected>Jenis Peralatan :</option>
                                    <?php foreach ($DataPeralatan as $dataPeralatan) : ?>
                                        <option value="<?php echo $dataPeralatan['id_peralatan']; ?>" <?= $data['id_peralatan'] == $dataPeralatan['id_peralatan'] ? 'selected' : null ?>><?php echo $dataPeralatan['kategori_peralatan']; ?></option>
                                    <?php endforeach; ?>
                                </select>
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
            <!-- End Form Edit Nama Barang -->


        </div>
    </div>
</div>