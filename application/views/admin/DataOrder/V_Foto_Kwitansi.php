<div class="mobile-menu-overlay"></div>

<div class="main-container flex-grow-1">
    <div class="pd-ltr-20 xs-pd-20-10">
        <div class="min-height-200px">

            <div class="page-header">
                <div class="row">
                    <div class="col-md-6 col-sm-12">
                        <div class="title">
                            <h4>Foto Kwitansi Pembelian</h4>
                        </div>
                        <nav aria-label="breadcrumb" role="navigation">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item">
                                    <a href="#">Data Order</a>
                                </li>
                                <li class="breadcrumb-item active" aria-current="page">
                                    Foto
                                </li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>


            <div class="card-box p-5">
                <div class="container">
                    <h4>Nota Pembelian</h4>
                    <?php foreach ($DataKwitansi as $data) : ?>
                        <div class="row">
                            <div class="col-12 mt-2">
                                <img src="<?php echo base_url() . 'assets/photo_purchase/' . $data['foto_order'] ?>" style="width: 300px; height: 600px;" alt="Gambar Peminjaman">
                            </div>
                            <div class="col-12 mt-2">
                                <!-- Add a download button -->
                                <a href="<?php echo base_url() . 'assets/photo_purchase/' . $data['foto_order'] ?>" download="downloaded_photo.jpg">
                                    <button class="btn btn-primary">Download Nota</button>
                                </a>
                            </div>
                        </div>

                    <?php endforeach; ?>
                </div>
                </form>
            </div>



        </div>
    </div>
</div>