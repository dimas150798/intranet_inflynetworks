<div class="mobile-menu-overlay"></div>

<div class="main-container flex-grow-1">
    <div class="pd-ltr-20 xs-pd-20-10">
        <div class="min-height-200px">

            <!-- Header Tambah Pelanggan -->
            <div class="page-header">
                <div class="row">
                    <div class="col-md-6 col-sm-12">
                        <div class="title">
                            <h4>Form Tambah Request Purchase</h4>
                        </div>
                        <nav aria-label="breadcrumb" role="navigation">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item">
                                    <a href="#">Data Purchase</a>
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
                <form method="POST" action="<?php echo base_url('admin/DataPurchase/C_Add_Request/TambahRequest') ?>">

                    <input type="hidden" class="form-control" name="no_purchase_request" value="<?php echo $this->M_DataRequest->InvoiceRequest() ?>" readonly>
                    <input type="hidden" class="form-control" name="no_purchase_order" value="<?php echo $this->M_DataOrder->InvoiceOrder() ?>" readonly>

                    <div class="form-group row">
                        <label for="" class="col-sm-12 col-md-3 col-form-label" style="font-weight: bold;"> Nama Pegawai Request <span class="text-danger">*</span></label>
                        <div class="col-sm-12 col-md-9">
                            <select id="id_pegawai_request" name="id_pegawai_request" class="form-control" required>
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
                        <label for="" class="col-sm-12 col-md-3 col-form-label" style="font-weight: bold;"> Nama Barang <span class="text-danger">*</span></label>
                        <div class="col-sm-12 col-md-9">
                            <select id="id_barang" name="id_barang" class="form-control" required>
                                <option value="">Pilih Barang :</option>
                                <?php foreach ($StockBarang as $dataStock) : ?>
                                    <option value="<?php echo $dataStock['id_barang']; ?>">
                                        <?php echo $dataStock['nama_barang']; ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="" class="col-sm-12 col-md-3 col-form-label" style="font-weight: bold;"> Tanggal Request<span class="text-danger">*</span></label>
                        <div class="col-sm-12 col-md-9">
                            <input class="form-control" type="date" name="tanggal_request" placeholder="" required>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="" class="col-sm-12 col-md-3 col-form-label" style="font-weight: bold;"> Jumlah Request<span class="text-danger">*</span></label>
                        <div class="col-sm-12 col-md-9">
                            <input class="form-control" type="number" name="jumlah_request" min="0" placeholder="Masukkan jumlah request..." required>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="" class="col-sm-12 col-md-3 col-form-label" style="font-weight: bold;"> Keterangan Request<span class="text-danger">*</span></label>
                        <div class="col-sm-12 col-md-9">
                            <input class="form-control" name="keterangan" placeholder="Masukkan keterangan request..." required>
                        </div>
                    </div>

                    <div class="form-group row">
                        <div class="col-sm-12 d-flex justify-content-end">
                            <button type="submit" class="btn btn-primary justify-content-end"> Simpan</button>
                        </div>
                    </div>

                </form>
            </div>
            <!-- End Form Tambah Pelanggan -->


        </div>
    </div>
</div>