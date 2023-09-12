<?php
if (!function_exists('changeDateFormat')) {
    function changeDateFormat($format = 'd-m-Y', $givenDate = null)
    {
        return date($format, strtotime($givenDate));
    }
}
?>

<div class="main-container flex-grow-1">
    <!-- <div class="mobile-menu-overlay"></div> -->

    <div class="page-header">

        <div class="row align-items-center justify-content-between">
            <div class="col-xl-6">
                <div class="title">
                    <h4>Detail Foto Peminjaman Dan Pengembalian</h4>
                </div>
                <nav aria-label="breadcrumb" role="navigation">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item">
                            <a href="#">Detail Foto</a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">
                            Informasi
                        </li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>

    <div class="card-box p-4">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <h4 class="text-center"><?php echo $NamaPegawai ?></h4>
                    <h4 class="text-center">
                        <?php echo ($TanggalPeminjaman == NULL) ? '<span class="text-danger">DATA KOSONG</span>' : changeDateFormat('d-m-Y', $TanggalPeminjaman); ?> /
                        <?php echo ($TanggalPengembalian == NULL) ? '<span class="text-danger">DATA KOSONG</span>' : changeDateFormat('d-m-Y', $TanggalPengembalian); ?>
                    </h4>
                </div>
            </div>
            <div class="row mt-3">
                <div class="col-12 col-lg-6 col-xl-6">
                    <div class="col-12 d-flex justify-content-center">
                        <label for="" class="col-form-label" style="font-weight: bold;"> Foto Peminjaman <span class="text-danger">*</span></label>
                    </div>
                    <div class="col-12 d-flex justify-content-center">
                        <?php if ($FotoPeminjaman1 != NULL && file_exists('./assets/photo_peminjaman/' . $FotoPeminjaman1)) : ?>
                            <img src="<?php echo base_url() . 'assets/photo_peminjaman/' . $FotoPeminjaman1 ?>" style="width: 280px; height: 280px;" alt="Gambar Peminjaman">
                        <?php else : ?>
                            <img src="<?php echo base_url() . 'assets/photo/image_tidakada.jpg' ?>" style="width: 280px; height: 280px;" alt="Gambar Pengganti">
                        <?php endif; ?>
                    </div>
                </div>
                <div class="col-12 col-lg-6 col-xl-6">
                    <div class="col-12 d-flex justify-content-center">
                        <label for="" class="col-form-label" style="font-weight: bold;"> Foto Peminjaman <span class="text-danger">*</span></label>
                    </div>
                    <div class="col-12 d-flex justify-content-center">
                        <?php if ($FotoPeminjaman2 != NULL && file_exists('./assets/photo_peminjaman/' . $FotoPeminjaman2)) : ?>
                            <img src="<?php echo base_url() . 'assets/photo_peminjaman/' . $FotoPeminjaman2 ?>" style="width: 280px; height: 280px;" alt="Gambar Peminjaman">
                        <?php else : ?>
                            <img src="<?php echo base_url() . 'assets/photo/image_tidakada.jpg' ?>" style="width: 280px; height: 280px;" alt="Gambar Pengganti">
                        <?php endif; ?>
                    </div>
                </div>
            </div>
            <div class="row mt-3">
                <div class="col-12 col-lg-6 col-xl-6">
                    <div class="col-12 d-flex justify-content-center">
                        <label for="" class="col-form-label" style="font-weight: bold;"> Foto Pengembalian <span class="text-danger">*</span></label>
                    </div>
                    <div class="col-12 d-flex justify-content-center">
                        <?php if ($FotoPengembalian1 != NULL && file_exists('./assets/photo_peminjaman/' . $FotoPengembalian1)) : ?>
                            <img src="<?php echo base_url() . 'assets/photo_peminjaman/' . $FotoPengembalian1 ?>" style="width: 280px; height: 280px;" alt="Gambar Peminjaman">
                        <?php else : ?>
                            <img src="<?php echo base_url() . 'assets/photo/image_tidakada.jpg' ?>" style="width: 280px; height: 280px;" alt="Gambar Pengganti">
                        <?php endif; ?>
                    </div>
                </div>
                <div class="col-12 col-lg-6 col-xl-6">
                    <div class="col-12 d-flex justify-content-center">
                        <label for="" class="col-form-label" style="font-weight: bold;"> Foto Pengembalian <span class="text-danger">*</span></label>
                    </div>
                    <div class="col-12 d-flex justify-content-center">
                        <?php if ($FotoPengembalian2 != NULL && file_exists('./assets/photo_peminjaman/' . $FotoPengembalian2)) : ?>
                            <img src="<?php echo base_url() . 'assets/photo_peminjaman/' . $FotoPengembalian2 ?>" style="width: 280px; height: 280px;" alt="Gambar Peminjaman">
                        <?php else : ?>
                            <img src="<?php echo base_url() . 'assets/photo/image_tidakada.jpg' ?>" style="width: 280px; height: 280px;" alt="Gambar Pengganti">
                        <?php endif; ?>
                    </div>
                </div>
            </div>

        </div>
    </div>

</div>