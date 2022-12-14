<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
  <meta charset="utf-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />

  <title>InforMathic</title>

  <!-- GOOGLE FONTS -->
  <link href="https://fonts.googleapis.com/css?family=Montserrat:400,500|Poppins:400,500,600,700|Roboto:400,500" rel="stylesheet"/>
  <link href="https://cdn.materialdesignicons.com/3.0.39/css/materialdesignicons.min.css" rel="stylesheet" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <!-- PLUGINS CSS STYLE -->
  <link href="{{asset('admin/assets/plugins/toaster/toastr.min.css')}}" rel="stylesheet" />
  <link href="{{asset('admin/assets/plugins/nprogress/nprogress.css')}}" rel="stylesheet" />
  <link href="{{asset('admin/assets/plugins/flag-icons/css/flag-icon.min.css')}}" rel="stylesheet"/>
  <link href="{{asset('admin/assets/plugins/jvectormap/jquery-jvectormap-2.0.3.css')}}" rel="stylesheet" />
  <link href="{{asset('admin/assets/plugins/ladda/ladda.min.css" rel="stylesheet')}}" />
  <link href="{{asset('admin/assets/plugins/select2/css/select2.min.css" rel="stylesheet')}}" />
  <link href="{{asset('admin/assets/plugins/daterangepicker/daterangepicker.css" rel="stylesheet')}}" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <!-- SLEEK CSS -->
  <link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css.css">
  <link id="sleek-css" rel="stylesheet" href="{{asset('admin/assets/css/sleek.css')}}" />
  <!-- font awesome css-->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
   <!-- custom css -->
   <link href="{{asset('auth/assets/css/custom.css')}}" rel="stylesheet" />
  <!-- toaster css -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.css">

  <!-- FAVICON -->
  <link href="{{asset('admin/assets/img/favicon.png')}}" rel="shortcut icon" />


  <script src="assets/plugins/nprogress/nprogress.js"></script>
</head>


  <body class="sidebar-fixed sidebar-dark header-light header-fixed" id="body">

    <div class="mobile-sticky-body-overlay"></div>

    <div class="wrapper">
      
              <!--
          ====================================
          ——— LEFT SIDEBAR WITH FOOTER
          =====================================
        -->
     <!-- side bar -->
     @include('layouts.admin3.sidebar')
     <!-- side bar end -->

      

      <div class="page-wrapper">
                  <!-- Header -->
      <!-- navbar -->
      @include('layouts.admin3.navbar')
      <!-- navbar end -->


        <div class="content-wrapper">
          <div class="content">						 
      <!-- content -->
      @yield('content')
      <!-- end content -->
                  


      <footer class="footer mt-auto">
          <div class="copyright bg-white">
          @include('layouts.admin3.footer')
          </div>
      </footer>

      </div>
    </div>

    <script src=" http://www.position-absolute.com/creation/print/jquery.printPage.js"></script>

<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDCn8TFXGg17HAUcNpkwtxxyT9Io9B_NcM" defer></script>
<script src="{{asset('admin/assets/plugins/jquery/jquery.min.js')}}"></script>
<script src="{{asset('admin/assets/plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
<script src="{{asset('admin/assets/plugins/toaster/toastr.min.js')}}"></script>
<script src="{{asset('admin/assets/plugins/slimscrollbar/jquery.slimscroll.min.js')}}"></script>
<script src="{{asset('admin/assets/plugins/charts/Chart.min.js')}}"></script>
<script src="{{asset('admin/assets/plugins/ladda/spin.min.js')}}"></script>
<script src="{{asset('admin/assets/plugins/ladda/ladda.min.js')}}"></script>
<script src="{{asset('admin/assets/plugins/jquery-mask-input/jquery.mask.min.js')}}"></script>
<script src="{{asset('admin/assets/plugins/select2/js/select2.min.js')}}"></script>
<script src="{{asset('admin/assets/plugins/jvectormap/jquery-jvectormap-2.0.3.min.js')}}"></script>
<script src="{{asset('admin/assets/plugins/jvectormap/jquery-jvectormap-world-mill.js')}}"></script>
<script src="{{asset('admin/assets/plugins/daterangepicker/moment.min.js')}}"></script>
<script src="{{asset('admin/assets/plugins/daterangepicker/daterangepicker.js')}}"></script>
<script src="{{asset('admin/assets/plugins/jekyll-search.min.js')}}"></script>
<script src="{{asset('admin/assets/js/sleek.js')}}"></script>
<script src="{{asset('admin/assets/js/chart.js')}}"></script>
<script src="{{asset('admin/assets/js/date-range.js')}}"></script>
<script src="{{asset('admin/assets/js/map.js')}}"></script>
<script src="{{asset('admin/assets/js/custom.js')}}"></script>
<!-- custom js -->
<script src="{{asset('auth/assets/js/app.js')}}"></script>
<script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></scrip
  <!-- toaster js -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
  <!-- toaster script -->
  <script>
    @if(Session::has('message'))
    var type = "{{ Session ::get('alert_type','danger') }}"
    switch(type){
        case 'info':
        toastr.info("{{ Session ::get('message') }}");
        break;
        case 'success':
        toastr.success("{{ Session ::get('message') }}");
        break;
        case 'warning':
        toastr.warning("{{ Session ::get('message') }}");
        break;
        case 'error':
        toastr.error("{{ Session ::get('message') }}");
        break;
    }
    @endif
  </script>
  <!-- toaster script end --> 



  </body>
</html>
