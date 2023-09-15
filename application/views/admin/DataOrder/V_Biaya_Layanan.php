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

                <form method="POST" action="<?php echo base_url('admin/DataOrder/C_Biaya_Layanan/AccSave') ?>">

                    <div class="form-group row">
                        <div class="row">
                            <input type="hidden" class="form-control" name="id_purchase_order" value="<?php echo $this->session->userdata('id_purchase_order') ?>" readonly>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="" class="col-sm-12 col-md-3 col-form-label" style="font-weight: bold;"> Biaya Ongkir <span class="text-danger">*</span></label>
                        <div class="col-sm-12 col-md-9">
                            <input class="form-control" type="number" min="0" name="biaya_ongkir" placeholder="Masukkan Biaya Ongkir..." required>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="" class="col-sm-12 col-md-3 col-form-label" style="font-weight: bold;"> Biaya Penanganan <span class="text-danger">*</span></label>
                        <div class="col-sm-12 col-md-9">
                            <input class="form-control" type="number" min="0" name="biaya_penanganan" placeholder="Masukkan Biaya Penanganan..." required>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="" class="col-sm-12 col-md-3 col-form-label" style="font-weight: bold;"> Biaya Layanan <span class="text-danger">*</span></label>
                        <div class="col-sm-12 col-md-9">
                            <input class="form-control" type="number" min="0" name="biaya_layanan" placeholder="Masukkan Biaya Layanan..." required>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="" class="col-sm-12 col-md-3 col-form-label" style="font-weight: bold;"> Biaya Angsuran <span class="text-danger">*</span></label>
                        <div class="col-sm-12 col-md-9">
                            <input class="form-control" type="number" min="0" name="biaya_angsuran" placeholder="Masukkan Biaya Angsuran..." required>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="" class="col-sm-12 col-md-3 col-form-label" style="font-weight: bold;"> Biaya Lainnya <span class="text-danger">*</span></label>
                        <div class="col-sm-12 col-md-9">
                            <input class="form-control" type="number" min="0" name="biaya_lainnya" placeholder="Masukkan Biaya Lainnya..." required>
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