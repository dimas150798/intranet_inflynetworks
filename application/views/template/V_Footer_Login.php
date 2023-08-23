    <!-- js -->
    <script src="<?php echo base_url(); ?>vendors/scripts/core.js"></script>
    <script src="<?php echo base_url(); ?>vendors/scripts/script.min.js"></script>
    <script src="<?php echo base_url(); ?>vendors/scripts/process.js"></script>
    <script src="<?php echo base_url(); ?>vendors/scripts/layout-settings.js"></script>

    <!-- add sweet alert js & css in footer -->
    <script src="<?php echo base_url(); ?>assets/plugins/sweetalert2/sweetalert2.all.js"></script>
    <script src="<?php echo base_url(); ?>assets/plugins/sweetalert2/sweet-alert.init.js"></script>

    <script src="<?php echo base_url(); ?>vendors/SweetAlert2/sweetalert2.all.min.js"></script>


    <!-- Google Tag Manager (noscript) -->
    <noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-NXZMQSS" height="0" width="0" style="display: none; visibility: hidden"></iframe></noscript>
    <!-- End Google Tag Manager (noscript) -->

    <!-- Alert Gagal -->
    <script>
        <?php if ($this->session->flashdata('LoginGagal_icon')) { ?>
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
                title: '<?php echo $this->session->flashdata('LoginGagal_title') ?>',
                icon: '<?php echo $this->session->flashdata('LoginGagal_icon') ?>'
            });

        <?php } ?>
    </script>
    </body>

    </html>