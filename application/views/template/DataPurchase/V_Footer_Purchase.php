<div class="footer-wrap pd-20 mb-20 bg-white mt-4">
    <div>Copyright &copy; My Infly Networks 2023</div>
</div>


<!-- welcome modal end -->
<!-- js -->
<script src="<?php echo base_url(); ?>vendors/scripts/core.js"></script>
<script src="<?php echo base_url(); ?>vendors/scripts/script.min.js"></script>
<script src="<?php echo base_url(); ?>vendors/scripts/process.js"></script>
<script src="<?php echo base_url(); ?>vendors/scripts/layout-settings.js"></script>
<script src="<?php echo base_url(); ?>assets/plugins/jquery-steps/jquery.steps.js"></script>
<script src="<?php echo base_url(); ?>vendors/scripts/steps-setting.js"></script>

<script src="<?php echo base_url(); ?>assets/plugins/datatables/js/jquery.dataTables.min.js"></script>
<script src="<?php echo base_url(); ?>assets/plugins/datatables/js/dataTables.bootstrap4.min.js"></script>
<script src="<?php echo base_url(); ?>assets/plugins/datatables/js/dataTables.responsive.min.js"></script>
<script src="<?php echo base_url(); ?>assets/plugins/datatables/js/responsive.bootstrap4.min.js"></script>

<!-- buttons for Export datatable -->
<script src="<?php echo base_url(); ?>assets/plugins/datatables/js/dataTables.buttons.min.js"></script>
<script src="<?php echo base_url(); ?>assets/plugins/datatables/js/buttons.bootstrap4.min.js"></script>
<script src="<?php echo base_url(); ?>assets/plugins/datatables/js/buttons.print.min.js"></script>
<script src="<?php echo base_url(); ?>assets/plugins/datatables/js/buttons.html5.min.js"></script>
<script src="<?php echo base_url(); ?>assets/plugins/datatables/js/buttons.flash.min.js"></script>
<script src="<?php echo base_url(); ?>assets/plugins/datatables/js/pdfmake.min.js"></script>
<script src="<?php echo base_url(); ?>assets/plugins/datatables/js/vfs_fonts.js"></script>

<!-- Datatable Setting js -->
<script src="<?php echo base_url(); ?>vendors/scripts/datatable-setting.js"></script>

<!-- Google Tag Manager (noscript) -->
<noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-NXZMQSS" height="0" width="0" style="display: none; visibility: hidden"></iframe></noscript>
<!-- End Google Tag Manager (noscript) -->

<!-- sweet alert 2 -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.27/dist/sweetalert2.all.min.js"></script>

<!-- Select2 -->
<script src="<?php echo base_url(); ?>assets/scripts/select2.min.js"></script>

<script>
    var currentStep = 1; // Menyimpan langkah saat ini

    // Fungsi untuk berpindah antar langkah
    function nextStep(step) {
        var steps = document.querySelectorAll('.step');
        steps[currentStep - 1].style.display = 'none'; // Sembunyikan langkah saat ini

        // Mengganti warna indikator langkah yang aktif
        var indicators = document.querySelectorAll('.step-number');
        indicators[currentStep - 1].classList.remove('active-indicator');
        currentStep += step; // Tambahkan atau kurangkan langkah saat ini sesuai tombol yang ditekan

        // Mengecek jika berada pada langkah terakhir
        if (currentStep > steps.length) {
            currentStep = steps.length;
        }

        // Mengecek jika berada pada langkah pertama
        if (currentStep < 1) {
            currentStep = 1;
        }

        // Menampilkan langkah yang sesuai
        steps[currentStep - 1].style.display = 'block';

        // Mengganti warna indikator langkah yang aktif
        indicators[currentStep - 1].classList.add('active-indicator');
    }
</script>


<!-- Ajax Show Data Request -->
<script>
    $(document).ready(function() {
        $('#datarequest').DataTable({
            "autoFill": true,
            "pagingType": 'numbers',
            "searching": true,
            "paging": true,
            "stateSave": true,
            "processing": true,
            "serverside": true,
            "ajax": {
                "url": "<?= base_url('admin/DataRequest/C_Data_Request/GetDataAjax'); ?>",
            },
            "bDestroy": true
        })
    })
</script>

<!-- Ajax Show Data Order -->
<script>
    $(document).ready(function() {
        $('#dataorder').DataTable({
            "autoFill": true,
            "pagingType": 'numbers',
            "searching": true,
            "paging": true,
            "stateSave": true,
            "processing": true,
            "serverside": true,
            "ajax": {
                "url": "<?= base_url('admin/DataOrder/C_Data_Order/GetDataAjax'); ?>",
            },
            "bDestroy": true
        })
    })
</script>

<!-- Ajax Show Data Foto Peminjaman Barang -->
<script>
    $(document).ready(function() {
        $('#fotopeminjaman').DataTable({
            "autoFill": true,
            "pagingType": 'numbers',
            "searching": true,
            "paging": true,
            "stateSave": true,
            "processing": true,
            "serverside": true,
            "ajax": {
                "url": "<?= base_url('admin/DataPeminjaman/C_Foto_Peminjaman/GetDataAjax'); ?>",
            },
            "bDestroy": true
        })
    })
</script>


<!-- Alert Berhasil -->
<script>
    <?php if ($this->session->flashdata('berhasil_icon')) { ?>
        var toastMixin = Swal.mixin({
            toast: true,
            icon: 'success',
            title: 'General Title',
            animation: false,
            position: 'top-right',
            showConfirmButton: false,
            timer: 2000,
            timerProgressBar: true,
            didOpen: (toast) => {
                toast.addEventListener('mouseenter', Swal.stopTimer)
                toast.addEventListener('mouseleave', Swal.resumeTimer)
            }
        });

        toastMixin.fire({
            animation: true,
            title: '<?php echo $this->session->flashdata('berhasil_title') ?>'
        });

    <?php } ?>
</script>

<!-- Alert Gagal -->
<script>
    <?php if ($this->session->flashdata('gagal_icon')) { ?>
        var toastMixin = Swal.mixin({
            toast: true,
            icon: 'warning',
            title: 'General Title',
            animation: false,
            position: 'top-right',
            showConfirmButton: false,
            timer: 2000,
            timerProgressBar: true,
            didOpen: (toast) => {
                toast.addEventListener('mouseenter', Swal.stopTimer)
                toast.addEventListener('mouseleave', Swal.resumeTimer)
            }
        });

        toastMixin.fire({
            animation: true,
            title: '<?php echo $this->session->flashdata('gagal_title') ?>'
        });

    <?php } ?>
</script>

<!-- Edit Order -->
<script>
    function EditOrder(parameter_id) {
        Swal.fire({
            title: 'Yakin Melakukan Edit Data Order ?',
            // text: "Jumlah Stock Barang Akan Bertambah",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Ya, Edit Order!'
        }).then((result) => {
            if (result.isConfirmed) {
                window.location.href = "<?php echo site_url('admin/DataOrder/C_Edit_Order/EditOrder') ?>/" + parameter_id;
            }
        })
    }
</script>

<!-- Done Order -->
<script>
    function DoneOrder(parameter_id) {
        Swal.fire({
            title: 'Yakin Melakukan Penerimaan Barang ?',
            // text: "Jumlah Stock Barang Akan Bertambah",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Ya, Terima Barang!'
        }).then((result) => {
            if (result.isConfirmed) {
                window.location.href = "<?php echo site_url('admin/DataOrder/C_Done_Order/DoneOrder') ?>/" + parameter_id;
            }
        })
    }
</script>

<!-- ACC Order -->
<script>
    function ACCOrder(parameter_id) {
        Swal.fire({
            title: 'Yakin Melakukan ACC Barang ?',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Ya, ACC Barang!'
        }).then((result) => {
            if (result.isConfirmed) {
                window.location.href = "<?php echo site_url('admin/DataOrder/C_Acc_Request/AccRequest'); ?>/" + parameter_id;
            }
        })
    }
</script>

<!-- Kode JavaScript untuk menampilkan SweetAlert saat button "Selesai" ditekan -->
<script>
    document.getElementById("selesaiButton").addEventListener("click", function() {
        Swal.fire({
            title: "Konfirmasi",
            text: "Apakah Anda yakin ingin menyelesaikan tindakan ini?",
            icon: "warning",
            showCancelButton: true,
            confirmButtonText: "Ya",
            cancelButtonText: "Batal",
        }).then((result) => {
            if (result.isConfirmed) {
                // Tempatkan kode untuk menavigasi ke halaman tujuan di sini
                window.location.href = "<?php echo site_url('admin/DataOrder/C_Data_Order') ?>";

            }
        });
    });
</script>

<!-- Button Search  -->
<script type="text/javascript">
    // Satuan pada nama barang
    $('#id_satuan').each(function() {
        $(this).select2({
            placeholder: 'Pilih Satuan',
            theme: 'bootstrap-5',
            dropdownParent: $(this).parent(),
        });
    });

    // Kategori Peralatan nama barang
    $('#id_peralatan').each(function() {
        $(this).select2({
            placeholder: 'Pilih Kategori',
            theme: 'bootstrap-5',
            dropdownParent: $(this).parent(),
        });
    });

    // Kondisi Barang 
    $('#id_keadaanbarang').each(function() {
        $(this).select2({
            placeholder: 'Pilih Keadaan Barang',
            theme: 'bootstrap-5',
            dropdownParent: $(this).parent(),
        });
    });

    // Nama Pegawai
    $('#id_pegawai').each(function() {
        $(this).select2({
            placeholder: 'Pilih Nama Pegawai',
            theme: 'bootstrap-5',
            dropdownParent: $(this).parent(),
        });
    });

    // Nama Customer
    $('#id_customer').each(function() {
        $(this).select2({
            placeholder: 'Pilih Nama Customer',
            theme: 'bootstrap-5',
            dropdownParent: $(this).parent(),
        });
    });

    // Kode Barang
    $('#kode_barang').each(function() {
        $(this).select2({
            placeholder: 'Pilih SN Modem',
            theme: 'bootstrap-5',
            dropdownParent: $(this).parent(),
        });
    });

    // Adaptor
    $('#adaptor').each(function() {
        $(this).select2({
            placeholder: 'Pilih Adaptor',
            theme: 'bootstrap-5',
            dropdownParent: $(this).parent(),
        });
    });

    // Adaptor
    $('#id_stockBarang').each(function() {
        $(this).select2({
            placeholder: 'Pilih Nama Barang',
            theme: 'bootstrap-5',
            dropdownParent: $(this).parent(),
        });
    });

    // Id Barang
    $('#id_barang').each(function() {
        $(this).select2({
            placeholder: 'Pilih Nama Barang',
            theme: 'bootstrap-5',
            dropdownParent: $(this).parent(),
        });
    });

    // Id Barang
    $('#id_pegawai_request').each(function() {
        $(this).select2({
            placeholder: 'Pilih Nama Pegawai',
            theme: 'bootstrap-5',
            dropdownParent: $(this).parent(),
        });
    });

    // Id Barang
    $('#id_status').each(function() {
        $(this).select2({
            placeholder: 'Pilih Status Order',
            theme: 'bootstrap-5',
            dropdownParent: $(this).parent(),
        });
    });

    // Id Barang
    $('#nama_pembelian').each(function() {
        $(this).select2({
            placeholder: 'Pilih Nama Pembelian',
            theme: 'bootstrap-5',
            dropdownParent: $(this).parent(),
        });
    });
</script>

</body>


</html>