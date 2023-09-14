<div class="mobile-menu-overlay"></div>

<div class="main-container flex-grow-1">
    <div class="pd-ltr-20 xs-pd-20-10">
        <div class="min-height-200px">

            <!-- Header Tambah Pelanggan -->
            <div class="page-header">
                <div class="row">
                    <div class="col-md-6 col-sm-12">
                        <div class="title">
                            <h4>Form Purchase</h4>
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

            <div class="card-box p-5">
                <form method="POST" action="<?php echo base_url('admin/DataPeminjaman/C_Add_Peminjaman/TambahPeminjaman') ?>">


                    <div class="step-indicator">
                        <div class="step-number active-indicator">
                            1
                        </div>
                        <div class="step-number">
                            2
                        </div>
                        <div class="step-number">
                            3
                        </div>
                    </div>

                    <!-- Langkah 1 -->
                    <div class="step active-step" id="step1">

                        <div class="form-group row">
                            <div class="col-12 d-flex justify-content-center">
                                <h5>FORM REQUEST PURCHASE</h5>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="" class="col-sm-12 col-md-3 col-form-label" style="font-weight: bold;"> Nama Pegawai <span class="text-danger">*</span></label>
                            <div class="col-sm-12 col-md-9">
                                <select id="id_pegawai" name="id_pegawai" class="form-control">
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
                                <select id="id_stockBarang" name="id_stockBarang" class="form-control">
                                    <option value="">Pilih Barang :</option>
                                    <?php foreach ($StockBarang as $dataStock) : ?>
                                        <option value="<?php echo $dataStock['id_stockBarang']; ?>">
                                            <?php echo $dataStock['nama_barang']; ?>
                                        </option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                        </div>

                        <!-- Tombol "Next" untuk melanjutkan ke langkah berikutnya -->
                        <div class="form-group row">
                            <div class="col-sm-12 d-flex justify-content-end">
                                <button type="button" class="btn btn-primary mt-2 justify-content-end" onclick="nextStep(1)"> next</button>
                            </div>
                        </div>

                    </div>

                    <!-- Langkah 2 -->
                    <div class="step" id="step2">

                        <div class="form-group row">
                            <div class="col-12 d-flex justify-content-center">
                                <h5>FORM ORDER PURCHASE</h5>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="" class="col-sm-12 col-md-3 col-form-label" style="font-weight: bold;"> Nama Pegawai <span class="text-danger">*</span></label>
                            <div class="col-sm-12 col-md-9">
                                <select id="id_pegawai" name="id_pegawai" class="form-control">
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
                                <select id="id_stockBarang" name="id_stockBarang" class="form-control">
                                    <option value="">Pilih Barang :</option>
                                    <?php foreach ($StockBarang as $dataStock) : ?>
                                        <option value="<?php echo $dataStock['id_stockBarang']; ?>">
                                            <?php echo $dataStock['nama_barang']; ?>
                                        </option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-sm-12">
                                <div class="d-flex justify-content-end">
                                    <button type="button" class="btn btn-danger" onclick="nextStep(-1)">Kembali</button>
                                    <button type="button" class="btn btn-primary ml-2" onclick="nextStep(1)">Next</button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Langkah 3 -->
                    <div class="step" id="step3">

                        <div class="form-group row">
                            <label for="" class="col-sm-12 col-md-3 col-form-label" style="font-weight: bold;"> Nama Pegawai <span class="text-danger">*</span></label>
                            <div class="col-sm-12 col-md-9">
                                <select id="id_pegawai" name="id_pegawai" class="form-control">
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
                                <select id="id_stockBarang" name="id_stockBarang" class="form-control">
                                    <option value="">Pilih Barang :</option>
                                    <?php foreach ($StockBarang as $dataStock) : ?>
                                        <option value="<?php echo $dataStock['id_stockBarang']; ?>">
                                            <?php echo $dataStock['nama_barang']; ?>
                                        </option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-sm-12">
                                <div class="d-flex justify-content-end">
                                    <button type="button" class="btn btn-danger" onclick="nextStep(-1)">Kembali</button>
                                    <button type="submit" class="btn btn-success ml-2">Simpan</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>

        </div>
    </div>
</div>