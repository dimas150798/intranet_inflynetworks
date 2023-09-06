<div class="mobile-menu-overlay"></div>

<div class="main-container flex-grow-1">
    <div class="pd-ltr-20 xs-pd-20-10">
        <div class="min-height-200px">

            <!-- Header Detail Aktivasi -->
            <div class="page-header">
                <div class="row">
                    <div class="col-md-6 col-sm-12">
                        <div class="title">
                            <h4>Form Detail Aktivasi Barang</h4>
                        </div>
                        <nav aria-label="breadcrumb" role="navigation">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item">
                                    <a href="#">Data Barang</a>
                                </li>
                                <li class="breadcrumb-item active" aria-current="page">
                                    Form
                                </li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
            <!-- Header End Detail Aktivasi -->

            <!-- Form Detail Aktivasi -->
            <div class="card-box p-5">

                <?php foreach ($DataStock as $data) : ?>
                    <form method="POST" action="<?php echo base_url('admin/StockBarangAktivasi/C_Detail_Aktivasi/TambahBarangAktivasi') ?>">
                        <div class="form-group row">
                            <div class="row">
                                <input type="hidden" class="form-control" name="id_stockBarang" id="id_stockBarang" value="<?php echo $data['id_stockBarang'] ?>" readonly>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="" class="col-sm-12 col-md-3 col-form-label" style="font-weight: bold;"> Nama Barang <span class="text-danger">*</span></label>
                            <div class="col-sm-12 col-md-9">
                                <input class="form-control" name="nama_barang" value="<?php echo $data['nama_barang'] ?>" placeholder="Masukkan Nama Barang..." readonly />
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="" class="col-sm-12 col-md-3 col-form-label" style="font-weight: bold;"> SN Modem <span class="text-danger">*</span></label>
                            <div class="col-sm-12 col-md-9">
                                <input class="form-control" name="kode_barang" value="" placeholder="Masukkan SN Modem..." />
                                <div class="bg-danger">
                                    <small class="text-white"><?php echo form_error('kode_barang'); ?></small>
                                </div>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="" class="col-sm-12 col-md-3 col-form-label" style="font-weight: bold;"> Keadaan Barang <span class="text-danger">*</span></label>
                            <div class="col-sm-12 col-md-9">
                                <select id="id_keadaanbarang" name="id_keadaanbarang" class="form-control">
                                    <option value="">Pilih Kondisi Barang :</option>
                                    <?php foreach ($KeadaanBarang as $dataKeadaan) : ?>
                                        <option value="<?php echo $dataKeadaan['id_keadaanbarang']; ?>">
                                            <?php echo $dataKeadaan['nama_keadaan']; ?>
                                        </option>
                                    <?php endforeach; ?>
                                </select>
                                <div class="bg-danger">
                                    <small class="text-white"><?php echo form_error('id_keadaanbarang'); ?></small>
                                </div>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="" class="col-sm-12 col-md-3 col-form-label" style="font-weight: bold;"> Tanggal Input Data<span class="text-danger">*</span></label>
                            <div class="col-sm-12 col-md-9">
                                <input class="form-control" type="date" name="tanggal" value="" />
                                <div class="bg-danger">
                                    <small class="text-white"><?php echo form_error('tanggal'); ?></small>
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
            <!-- End Form Detail Aktivasi -->


        </div>
    </div>
</div>