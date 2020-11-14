<!-- js -->
<script src="<?= base_url('assets/vendors/scripts/core.js'); ?>"></script>
<script src="<?= base_url('assets/vendors/scripts/script.min.js'); ?>"></script>
<script src="<?= base_url('assets/vendors/scripts/process.js'); ?>"></script>
<script src="<?= base_url('assets/vendors/scripts/layout-settings.js'); ?>"></script>
<!-- <script src="<?= base_url('assets/plugins/apexcharts/apexcharts.min.js'); ?>"></script> -->
<!-- datatable -->
<script src="<?= base_url('assets/plugins/datatables/js/jquery.dataTables.min.js'); ?>"></script>
<script src="<?= base_url('assets/plugins/datatables/js/dataTables.bootstrap4.min.js'); ?>"></script>
<script src="<?= base_url('assets/plugins/datatables/js/dataTables.responsive.min.js'); ?>"></script>
<script src="<?= base_url('assets/plugins/datatables/js/responsive.bootstrap4.min.js'); ?>"></script>
<!-- buttons for Export datatable -->
<script src="<?= base_url(); ?>assets/plugins/datatables/js/dataTables.buttons.min.js"></script>
<script src="<?= base_url(); ?>assets/plugins/datatables/js/buttons.bootstrap4.min.js"></script>
<script src="<?= base_url(); ?>assets/plugins/datatables/js/buttons.print.min.js"></script>
<script src="<?= base_url(); ?>assets/plugins/datatables/js/buttons.html5.min.js"></script>
<script src="<?= base_url(); ?>assets/plugins/datatables/js/buttons.flash.min.js"></script>
<!-- <script src="<?= base_url(); ?>assets/plugins/datatables/js/pdfmake.min.js"></script> -->
<script src="<?= base_url(); ?>assets/plugins/datatables/js/vfs_fonts.js"></script>

<!-- <script src="src/plugins/highcharts-6.0.7/code/highcharts.js"></script>
<script src="src/plugins/highcharts-6.0.7/code/highcharts-more.js"></script> -->

<!-- <script src="<?= base_url('assets/vendors/scripts/datatable-setting.js'); ?>"></script> -->
<script>
    var base_url = '<?php echo base_url() ?>';
</script>
<!-- <script src="<?= base_url('assets/vendors/scripts/dashboard.js'); ?>"></script> -->
<script src="<?= base_url('assets/js/penjualan.js'); ?>"></script>
<script src="<?= base_url('assets/js/penjualan-edit.js'); ?>"></script>
<!-- test -->
<script>
    $(document).ready(function() {
        $('#dataTable').DataTable({
            "ordering": false
        });


        // alert leaves page
        formmodified = 0;
        $('form *').change(function() {
            formmodified = 1;
        });
        window.onbeforeunload = confirmExit;

        function confirmExit() {
            if (formmodified == 1) {
                return "Test?";
            }
        }
        $("button[type='submit']").click(function() {
            formmodified = 0;
        });

    });
</script>

<script>
    $(function() {
        $('.int').on('input', function() {
            this.value = this.value
                .replace(/[^\d]/g, ''); // numbers and decimals only

        });
    });
</script>

</body>

</html>