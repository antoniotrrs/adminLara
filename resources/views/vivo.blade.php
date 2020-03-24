<!DOCTYPE html>
<!--
This is a starter template page. Use this page to start your new project from
scratch. This page gets rid of all links and provides the needed markup only.
-->
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta http-equiv="x-ua-compatible" content="ie=edge">

  <title>Administrador | COMEFAENL</title>

  <!-- Font Awesome Icons -->
  <link rel="stylesheet" href="{{url('/dashboard/plugins/fontawesome-free/css/all.min.css')}}">
  <!-- Theme style -->
  <link rel="stylesheet" href="{{url('/dashboard/dist/css/adminlte.min.css')}}">
  <!-- Google Font: Source Sans Pro -->
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
  <!-- Toastr -->
  <link rel="stylesheet" href="{{ url('dashboard/plugins/toastr/toastr.min.css') }}">
<style>

#labelswitch {
  margin-right: 30px;
}
@media (max-width: 575.98px) {

#labelswitch {
  margin-right: 0px;
}
}

</style>
</head>
<body class="hold-transition sidebar-mini">
<div class="wrapper">

  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#"><i class="fas fa-bars"></i></a>
      </li>

    </ul>

  </nav>
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    @yield('sidebar',View::make('sidebar'));
  </aside>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h4 class="m-0 text-dark"></h4>
          </div><!-- /.col -->

        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <div class="content">
      <div class="container-fluid">
        <div class="row">

          <!-- /.col-md-6 -->
          <div class="col-md-5">


            <div class="card card-info card-outline">
              <div class="card-header">
                <h5 class="card-title m-0">Iniciar Sesión en Vivo</h5>
              </div>
              <div class="card-body">
                <div class="row">
                  @if($live)
                    <input value="{{$live->id}}" type="hidden" id="idu" >
                    @else
                    <input value="0" type="hidden" id="idu">
                  @endif
                  <div class="col-md-12"><label id="labelswitch" style="font-weight: 500;">Habilitar botón en la aplicación:  </label>
                    @if($live)
                    <input type="checkbox" name="my-checkbox"  id="livecheck" checked data-bootstrap-switch data-off-color="default" data-on-color="success">
                    @else
                    <input type="checkbox" name="my-checkbox" id="livecheck" data-bootstrap-switch data-off-color="default" data-on-color="success">
                  @endif</div>

                </div>
              </div>
            </div>
          </div>
          <!-- /.col-md-3 -->




        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

  <!-- Main Footer -->
  <footer class="main-footer">
    <!-- To the right -->
    <div class="float-right d-none d-sm-inline">
      version 2.0
    </div>
    <!-- Default to the left -->
    <strong>Powered by <a href="https://www.bats.com.mx">BATS</a>.</strong> All rights reserved.
  </footer>
</div>
<!-- ./wrapper -->



<!-- jQuery -->
<script src="{{ url('dashboard/plugins/jquery/jquery.min.js')}}"></script>
<!-- Bootstrap 4 -->
<script src="{{ url('dashboard/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<!-- AdminLTE App -->
<script src="{{ url('dashboard/dist/js/adminlte.min.js') }}"></script>
<!-- Toastr -->
<script src="{{ url('dashboard/plugins/toastr/toastr.min.js') }}"></script>
<!-- Bootstrap Switch -->
<script src="{{ url('dashboard/plugins/bootstrap-switch/js/bootstrap-switch.min.js') }}"></script>

<script type="text/javascript">

  $(function() {


    $("input[data-bootstrap-switch]").each(function(){

      $(this).bootstrapSwitch('state', $(this).prop('checked'));

    });

  $('#livecheck').on('switchChange.bootstrapSwitch', function (event, state) {

      if (state) {
        var online = 1;
      }else{
        var online = 0;
      }

      var urll = "{{url('/api/iniciarlive')}}";
      var idu = $("#idu").val();

      $.ajax({
        method: 'POST',
        url: urll,
        data: {
            'online': online,
            'idu' : idu,
        },
        dataType: 'json',
        success: function(data){
            console.log(data);
        }
    });
  });





});

</script>

</body>
</html>
