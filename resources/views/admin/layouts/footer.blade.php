<footer class="main-footer">
    <!-- To the right -->
    <div class="pull-right hidden-xs">
        Licenced to: <a href="#"> Company</a>
    </div>
    <!-- Default to the left -->
    <strong>Copyright &copy; 2019 <a href="#">Youngminds</a>.</strong> All rights reserved.
    <!-- REQUIRED JS SCRIPTS -->
@yield('js')

    <!-- jQuery 3 -->
    <script src={{url("lib/jquery/dist/jquery.js")}}></script>
    <!-- Bootstrap 3.3.7 -->
    <script src={{url("lib/bootstrap/dist/js/bootstrap.min.js")}}></script>
    <!-- AdminLTE App -->
    <script src={{url("dist/js/adminlte.min.js")}}></script>
    <script src={{url("dist/js/jquery.jscroll.js")}}></script>

    <script src={{url("lib/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js")}}></script>
    <!-- datetimepicker -->
    <script src={{url("plugins/iCheck/icheck.min.js")}}></script>
    <!-- HighChart -->
    <script src={{url("lib/HighCharts/code/js/highcharts.js")}}></script>
    <!-- DataTables -->
    <script src={{url("lib/datatables.net/js/jquery.dataTables.min.js")}}></script>
    <script src={{url("lib/datatables.net-bs/js/dataTables.bootstrap.min.js")}}></script>
    <script src={{url("plugins/bootstrap-toggle/js/bootstrap-toggle.js")}}></script>
    <script src={{url("plugins/select2/dist/js/select2.full.js")}}></script>

    <script>
        $(function () {
            $('#example1').DataTable()
            $('#example2').DataTable()
            $('#example3').DataTable()
            $('#example4').DataTable({
                'paging'      : true,
                'lengthChange': false,
                'searching'   : true,
                'ordering'    : true,
                'info'        : true,
                'autoWidth'   : true
            })
        })
    </script>


    <script>
        //Date picker
        $('#datepicker').datepicker({
            autoclose: true,
            format: 'yy-mm-dd'
        })
        $('#email_date').datepicker({
            autoclose: true
        })
    </script>



    <script>
        //Date picker
        $('#datepicker1').datepicker({
            autoclose: true
        })
    </script>
    <script>
        //Date picker
        $('#datepicker2').datepicker({
            autoclose: true
        })
    </script>
    <script>
        //Date picker
        $('#datepicker3').datepicker({
            autoclose: true
        })
    </script>

    <script>

        //iCheck for checkbox and radio inputs
        $('input[type="checkbox"].minimal, input[type="radio"].minimal').iCheck({
            checkboxClass: 'icheckbox_minimal-blue',
            radioClass   : 'iradio_minimal-blue'
        })
        //Red color scheme for iCheck
        $('input[type="checkbox"].minimal-red, input[type="radio"].minimal-red').iCheck({
            checkboxClass: 'icheckbox_minimal-red',
            radioClass   : 'iradio_minimal-red'
        })
        //Flat red color scheme for iCheck
        $('input[type="checkbox"].flat-red, input[type="radio"].flat-red').iCheck({
            checkboxClass: 'icheckbox_flat-green',
            radioClass   : 'iradio_flat-green'
        })

    </script>

</footer>