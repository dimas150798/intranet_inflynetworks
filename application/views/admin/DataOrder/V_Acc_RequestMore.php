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

                <form method="POST" action="<?php echo base_url('admin/DataOrder/C_Acc_RequestMore/AccSave') ?>">

                    <div class="form-group row">
                        <div class="row">
                            <input type="hidden" class="form-control" name="id_purchase_order" value="<?php echo $id_purchase_order ?>" readonly>
                            <input type="hidden" class="form-control" name="no_purchase_order" value="<?php echo $this->session->userdata('no_purchase_order') ?>" readonly>
                            <input type="hidden" class="form-control" name="no_purchase_request" value="<?php echo $this->session->userdata('no_purchase_request') ?>" readonly>
                            <input type="hidden" class="form-control" name="id_stockBarang" value="<?php echo $id_stockBarang ?>" readonly>
                            <input type="hidden" class="form-control" name="id_barang" value="<?php echo $id_barang ?>" readonly>
                            <input type="hidden" class="form-control" name="id_pegawai_order" value="<?php echo $this->session->userdata('id_pegawai_order') ?>" readonly>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="" class="col-sm-12 col-md-3 col-form-label" style="font-weight: bold;"> Nama Pembelian<span class="text-danger">*</span></label>
                        <div class="col-sm-12 col-md-9">
                            <input class="form-control" value="<?php echo $nama_barang ?>" placeholder="" readonly>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="" class="col-sm-12 col-md-3 col-form-label" style="font-weight: bold;"> Nama Pegawai Order<span class="text-danger">*</span></label>
                        <div class="col-sm-12 col-md-9">
                            <input class="form-control" value="<?php echo $this->session->userdata('nama_pegawai') ?>" placeholder="" readonly>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="" class="col-sm-12 col-md-3 col-form-label" style="font-weight: bold;"> Tanggal Order<span class="text-danger">*</span></label>
                        <div class="col-sm-12 col-md-9">
                            <input class="form-control" type="date" name="tanggal_order" value="<?php echo $this->session->userdata('tanggal_order') ?>" readonly>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="" class="col-sm-12 col-md-3 col-form-label" style="font-weight: bold;"> Nama Toko / Supplier<span class="text-danger">*</span></label>
                        <div class="col-sm-12 col-md-9">
                            <input class="form-control" name="nama_supplier" value="<?php echo $this->session->userdata('nama_supplier') ?>" readonly>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="" class="col-sm-12 col-md-3 col-form-label" style="font-weight: bold;"> No Pesanan<span class="text-danger">*</span></label>
                        <div class="col-sm-12 col-md-9">
                            <input class="form-control" name="no_pesanan" value="<?php echo $this->session->userdata('no_pesanan') ?>" readonly>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="" class="col-sm-12 col-md-3 col-form-label" style="font-weight: bold;"> Harga Barang<span class="text-danger">*</span></label>
                        <div class="col-sm-12 col-md-9">
                            <input class="form-control" type="number" min="0" name="harga_barang" placeholder="Masukkan harga barang..." required>
                        </div>
                    </div>

                    <div class="form-group row">
                        <div class="col-sm-12 d-flex justify-content-end">
                            <button type="submit" class="btn btn-primary mr-2">Simpan</button>
                        </div>
                    </div>

                </form>
            </div>
            <!-- End Form Edit Customer -->


        </div>
    </div>
</div>