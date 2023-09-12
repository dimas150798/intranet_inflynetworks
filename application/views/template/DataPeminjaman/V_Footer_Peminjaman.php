<div class="footer-wrap pd-20 mb-20 bg-white mt-4">
    <div>Copyright &copy; My Infly Networks 2023</div>
</div>


<!-- welcome modal end -->
<!-- js -->
<script src="<?php echo base_url(); ?>vendors/scripts/core.js"></script>
<script src="<?php echo base_url(); ?>vendors/scripts/script.min.js"></script>
<script src="<?php echo base_url(); ?>vendors/scripts/process.js"></script>
<script src="<?php echo base_url(); ?>vendors/scripts/layout-settings.js"></script>
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

<!-- Ajax Show Data Peminjaman Barang -->
<script>
    $(document).ready(function() {
        $('#datapeminjaman').DataTable({
            "autoFill": true,
            "pagingType": 'numbers',
            "searching": true,
            "paging": true,
            "stateSave": true,
            "processing": true,
            "serverside": true,
            "ajax": {
                "url": "<?= base_url('admin/DataPeminjaman/C_Data_Peminjaman/GetDataAjax'); ?>",
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

<!-- Barang Kembali -->
<script>
    function BarangKembali(parameter_id) {
        Swal.fire({
            title: 'Yakin Melakukan Pengembalian Barang ?',
            text: "Jumlah Stock Barang Akan Bertambah",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Ya, Kembali Barang!'
        }).then((result) => {
            if (result.isConfirmed) {
                window.location.href = "<?php echo site_url('admin/DataPeminjaman/C_Barang_Kembali/BarangKembali') ?>/" + parameter_id;
            }
        })
    }
</script>

<!-- Barang Kembali -->
<script>
    function FotoBarangKembali(parameter_id) {
        Swal.fire({
            title: 'Yakin Melakukan Input Data Foto ?',
            text: "Foto Akan Terupload Dan Merubah Status",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Ya, Upload Foto!'
        }).then((result) => {
            if (result.isConfirmed) {
                window.location.href = "<?php echo site_url('admin/DataPeminjaman/C_AddFoto_Pengembalian/FotoPengembalian') ?>/" + parameter_id;
            }
        })
    }
</script>


<!-- Delete Data Nama Barang -->
<script>
    function DeleteNamaBarang(parameter_id) {
        Swal.fire({
            title: 'Yakin Melakukan Delete Data ?',
            text: "Data yang dihapus tidak akan kembali",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Ya, Hapus Data!'
        }).then((result) => {
            if (result.isConfirmed) {
                window.location.href = "<?php echo site_url('admin/NamaBarang/C_Delete_Barang/DeleteBarang') ?>/" + parameter_id;
            }
        })
    }
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
</script>

</body>


</html>