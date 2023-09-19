<div class="mobile-menu-overlay"></div>

<div class="main-container flex-grow-1">
    <div class="pd-ltr-20 xs-pd-20-10">
        <div class="min-height-200px">

            <!-- Header Edit Customer -->
            <div class="page-header">
                <div class="row">
                    <div class="col-md-6 col-sm-12">
                        <div class="title">
                            <h4>Form Purchase Order</h4>
                        </div>
                        <nav aria-label="breadcrumb" role="navigation">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item">
                                    <a href="#">Data Order</a>
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

                <?php foreach ($DoneOrder as $data) : ?>
                    <form method="POST" action="<?php echo base_url('admin/DataOrder/C_Done_Order/OrderSave') ?>">
                        <div class="form-group row">
                            <div class="row">
                                <input type="hidden" class="form-control" name="id_purchase_order" value="<?php echo $data['id_purchase_order'] ?>" readonly>
                                <input type="hidden" class="form-control" name="id_stockBarang" value="<?php echo $data['id_stockBarang'] ?>" readonly>
                                <input type="hidden" class="form-control" name="id_barang" value="<?php echo $data['id_barang'] ?>" readonly>
                                <input type="hidden" class="form-control" name="keterangan" value="<?php echo $data['keterangan'] ?>" readonly>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="" class="col-sm-12 col-md-3 col-form-label" style="font-weight: bold;"> Nama Barang <span class="text-danger">*</span></label>
                            <div class="col-sm-12 col-md-9">
                                <input class="form-control bg-info text-white fw-bold" name="nama_barang" value="<?php echo $data['nama_barang'] ?>" readonly />
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="" class="col-sm-12 col-md-3 col-form-label" style="font-weight: bold;"> No Pesanan <span class="text-danger">*</span></label>
                            <div class="col-sm-12 col-md-9">
                                <input class="form-control bg-info text-white fw-bold" name="no_pesanan" value="<?php echo $data['no_pesanan'] ?>" readonly />
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="" class="col-sm-12 col-md-3 col-form-label" style="font-weight: bold;"> Nama Toko / Supplier <span class="text-danger">*</span></label>
                            <div class="col-sm-12 col-md-9">
                                <input class="form-control bg-info text-white fw-bold" name="nama_supplier" value="<?php echo $data['nama_supplier'] ?>" readonly />
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="" class="col-sm-12 col-md-3 col-form-label" style="font-weight: bold;"> Jumlah Order <span class="text-danger">*</span></label>
                            <div class="col-sm-12 col-md-9">
                                <input class="form-control bg-info text-white fw-bold" name="jumlah_order" value="<?php echo $data['jumlah_order'] ?>" readonly />
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="" class="col-sm-12 col-md-3 col-form-label" style="font-weight: bold;"> Harga Barang <span class="text-danger">*</span></label>
                            <div class="col-sm-12 col-md-9">
                                <input class="form-control bg-info text-white fw-bold" type="number" name="harga_barang" value="<?php echo $data['harga_barang'] ?>" readonly />
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="" class="col-sm-12 col-md-3 col-form-label" style="font-weight: bold;"> Tanggal Diterima <span class="text-danger">*</span></label>
                            <div class="col-sm-12 col-md-9">
                                <input class="form-control" type="date" name="tanggal_diterima" value="" required />
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="" class="col-sm-12 col-md-3 col-form-label" style="font-weight: bold;"> Pegawai Yang Menerima <span class="text-danger">*</span></label>
                            <div class="col-sm-12 col-md-9">
                                <select id="id_pegawai" name="id_pegawai" class="form-control" required>
                                    <option value="">Pilih Pegawai :</option>
                                    <?php foreach ($DataPegawai as $dataPegawai) : ?>
                                        <option value="<?php echo $dataPegawai['id_pegawai']; ?>">
                                            <?php echo $dataPegawai['nama_pegawai']; ?>
                                        </option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="" class="col-sm-12 col-md-3 col-form-label" style="font-weight: bold;"> Status Order <span class="text-danger">*</span></label>
                            <div class="col-sm-12 col-md-9">
                                <select id="id_status" name="id_status" class="form-control" required>
                                    <option value="">Pilih Status :</option>
                                    <?php foreach ($DataStatus as $dataStatus) : ?>
                                        <option value="<?php echo $dataStatus['id_status']; ?>">
                                            <?php echo $dataStatus['nama_status']; ?>
                                        </option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                        </div>

                        <div class=" form-group row">
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