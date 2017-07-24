            <footer class="footer"> © 2017 HIDROANDES | Requisiciones. - Todos los Derechos Reservados. </footer>
</div>
</div>

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
<script>
    function cerrar() {
        $("#alerta-msg").fadeOut(1000);
        $("#alerta-msg").addClass("collapse");
    }

    function cerrarmodal() {
        $("#ventanaVer").html('');
    }
</script>
</body>

<!-- Mirrored from webapplayers.com/inspinia_admin-v2.6.2.1/index.html by HTTrack Website Copier/3.x [XR&CO'2014], Tue, 25 Oct 2016 05:31:23 GMT -->
</html>