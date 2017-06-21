            <footer class="footer"> © 2017 HIDROANDES | Requisiciones. - Todos los Derechos Reservados. </footer>
</div>
</div>

    <!-- Mainly scripts -->
    <script src="<?php echo $ruta_base;?>assets/theme/js/jquery-2.1.1.js"></script>
    <script src="<?php echo $ruta_base;?>assets/theme/js/bootstrap.min.js"></script>
    <script src="<?php echo $ruta_base;?>assets/theme/js/plugins/metisMenu/jquery.metisMenu.js"></script>
    <script src="<?php echo $ruta_base;?>assets/theme/js/plugins/slimscroll/jquery.slimscroll.min.js"></script>

    <!-- Flot -->
    <script src="<?php echo $ruta_base;?>assets/theme/js/plugins/flot/jquery.flot.js"></script>
    <script src="<?php echo $ruta_base;?>assets/theme/js/plugins/flot/jquery.flot.tooltip.min.js"></script>
    <script src="<?php echo $ruta_base;?>assets/theme/js/plugins/flot/jquery.flot.spline.js"></script>
    <script src="<?php echo $ruta_base;?>assets/theme/js/plugins/flot/jquery.flot.resize.js"></script>
    <script src="<?php echo $ruta_base;?>assets/theme/js/plugins/flot/jquery.flot.pie.js"></script>

    <!-- Peity -->
    <script src="<?php echo $ruta_base;?>assets/theme/js/plugins/peity/jquery.peity.min.js"></script>
    <script src="<?php echo $ruta_base;?>assets/theme/js/demo/peity-demo.js"></script>

    <!-- Custom and plugin javascript -->
    <script src="<?php echo $ruta_base;?>assets/theme/js/inspinia.js"></script>
    <script src="<?php echo $ruta_base;?>assets/theme/js/plugins/pace/pace.min.js"></script>

    <!-- jQuery UI -->
    <script src="<?php echo $ruta_base;?>assets/theme/js/plugins/jquery-ui/jquery-ui.min.js"></script>

    <!-- GITTER -->
    <script src="<?php echo $ruta_base;?>assets/theme/js/plugins/gritter/jquery.gritter.min.js"></script>

    <!-- Sparkline -->
    <script src="<?php echo $ruta_base;?>assets/theme/js/plugins/sparkline/jquery.sparkline.min.js"></script>

    <!-- Sparkline demo data  -->
    <script src="<?php echo $ruta_base;?>assets/theme/js/demo/sparkline-demo.js"></script>

    <!-- ChartJS-->
    <script src="<?php echo $ruta_base;?>assets/theme/js/plugins/chartJs/Chart.min.js"></script>

    <!-- Toastr -->
    <script src="<?php echo $ruta_base;?>assets/theme/js/plugins/toastr/toastr.min.js"></script>


    <script>
        $(document).ready(function() {
            setTimeout(function() {
                toastr.options = {
                    closeButton: true,
                    progressBar: true,
                    showMethod: 'slideDown',
                    timeOut: 4000
                };
                toastr.success('Sistema de requisiciones', 'Bienvenido a HIDROANDES');

            }, 1300);

        });
    </script>
</body>

<!-- Mirrored from webapplayers.com/inspinia_admin-v2.6.2.1/index.html by HTTrack Website Copier/3.x [XR&CO'2014], Tue, 25 Oct 2016 05:31:23 GMT -->
</html>