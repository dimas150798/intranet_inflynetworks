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
                    <h4>Data Aktivasi</h4>
                </div>
                <nav aria-label="breadcrumb" role="navigation">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item">
                            <a href="#">Data Aktivasi</a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">
                            Informasi
                        </li>
                    </ol>
                </nav>
            </div>

            <!-- <div class="col-6 col-xl-auto mt-2">
                <div class="dropdown">
                    <a class="btn btn-info dropdown-toggle" href="#" role="button" data-toggle="dropdown">
                        Fitur
                    </a>
                    <div class="dropdown-menu dropdown-menu-right">
                        <a class="dropdown-item" href="<?php echo base_url('admin/DataCustomer/C_Add_Customer') ?>">Tambah Customer</a>
                    </div>
                </div>
            </div> -->
        </div>
    </div>

    <div class="card-box p-4">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <h4 class="text-center"><?php echo $NamaBarang ?></h4>
                </div>
            </div>
            <div class="row mt-3">
                <div class="col-12 col-lg-4 col-xl-4">
                    <label for="" class="col-form-label" style="font-weight: bold;"> Nama Customer <span class="text-danger">*</span></label>
                    <input class="form-control bg-info text-center" style="font-weight: bold; font-size: 15px;" type="text" value="<?php echo $NamaCustomer ?>" readonly>
                </div>
                <div class="col-12 col-lg-4 col-xl-4">
                    <label for="" class="col-form-label" style="font-weight: bold;"> SN Modem <span class="text-danger">*</span></label>
                    <input class="form-control bg-info text-center" style="font-weight: bold; font-size: 15px;" type="text" value="<?php echo $KodeBarang ?>" readonly>
                </div>
                <div class="col-12 col-lg-4 col-xl-4">
                    <label for="" class="col-form-label" style="font-weight: bold;"> Tanggal Aktivasi <span class="text-danger">*</span></label>
                    <input class="form-control bg-info text-center" style="font-weight: bold; font-size: 15px;" type="text" value="<?php echo changeDateFormat('d-m-Y', $TanggalAktivasi) ?>" readonly>
                </div>
            </div>
            <div class="row mt-3">
                <div class="col-12 col-lg-4 col-xl-4">
                    <label for="" class="col-form-label" style="font-weight: bold;"> Patch Cord Hitam UPC Outdor <span class="text-danger">*</span></label>
                    <input class="form-control bg-info text-center" style="font-weight: bold; font-size: 15px;" type="text" value="<?php echo $Hitam_UPC_Outdoor ?>" readonly>
                </div>
                <div class="col-12 col-lg-4 col-xl-4">
                    <label for="" class="col-form-label" style="font-weight: bold;"> Patch Cord Kuning APC (Hijau) <span class="text-danger">*</span></label>
                    <input class="form-control bg-info text-center" style="font-weight: bold; font-size: 15px;" type="text" value="<?php echo $Kuning_APC_Hijau ?>" readonly>
                </div>
                <div class="col-12 col-lg-4 col-xl-4">
                    <label for="" class="col-form-label" style="font-weight: bold;"> Patch Cord Kuning UPC (Biru) <span class="text-danger">*</span></label>
                    <input class="form-control bg-info text-center" style="font-weight: bold; font-size: 15px;" type="text" value="<?php echo $Kuning_UPC_Biru ?>" readonly>
                </div>
            </div>
        </div>
    </div>

</div>