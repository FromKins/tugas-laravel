<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Five Code Development</title>


    <link rel="stylesheet" href="{!! asset('css/vendor.css') !!}" />
    <link rel="stylesheet" href="{!! asset('css/app.css') !!}" />
    <link rel="stylesheet" href="{!! asset('css/custom.css') !!}" />
    <link rel="stylesheet" href="{!! asset('css/sweetalert.css') !!}" />
   <!--  <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/datatables/1.10.16/css/dataTables.bootstrap.min.css"> -->
   <link rel="stylesheet" href="{!! asset('css/dataTables.bootstrap.min.css') !!}">

    <link rel="stylesheet" href="{!! asset('css/datepicker3.css') !!}" />
    <!-- <link rel="stylesheet" href="https://cdn.datatables.net/buttons/1.0.3/css/buttons.dataTables.min.css"> -->
    <link rel="stylesheet" href="{!! asset('css/buttons.dataTables.min.css') !!}">
    @stack('styles')
</head>
<body>
<!-- Page wrapper -->
        @include('layouts.header')
         <!-- Wrapper-->
          <div id="wrapper">
        <!-- Navigation -->
        @include('layouts.navigation')

        <!-- Page wraper -->
        <div id="page-wrapper" class="white-bg">

            <!-- Page wrapper -->
            @include('layouts.topnavbar')

            <!-- Main view  -->
            @yield('content')

            <!-- Footer -->
            @include('layouts.footer')

        </div>
        <!-- End page wrapper-->

    </div>
    <!-- End wrapper-->
    
<script src="{!! asset('js/jquery-3.1.1.min.js') !!}"></script>
<script src="{!! asset('js/bootstrap.min.js') !!}"></script>
<script src="{!! asset('js/jquery.metisMenu.js') !!}"></script>
<script src="{!! asset('js/jquery.slimscroll.min.js') !!}"></script>
<script src="{!! asset('js/sweetalert.min.js') !!}"></script>

<script src="{!! asset('js/app.js') !!}" type="text/javascript"></script>


<!-- <script src="//cdnjs.cloudflare.com/ajax/libs/datatables/1.10.19/js/jquery.dataTables.js"></script> -->
<script src="{!! asset('js/jquery.dataTables.js') !!}" type="text/javascript"></script>
<!-- <script src="//cdnjs.cloudflare.com/ajax/libs/datatables/1.10.16/js/dataTables.bootstrap.min.js"></script> -->
<script src="{!! asset('js/dataTables.bootstrap.min.js') !!}"></script>

<script src="{!! asset('js/bootstrap-datepicker.js') !!}"></script>

<!-- <script src="https://cdn.datatables.net/buttons/1.5.2/js/dataTables.buttons.min.js"></script> -->
<script src="{!! asset('js/dataTables.buttons.min.js') !!}"></script>

<!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script> -->
<script src="{!! asset('js/jszip.min.js') !!}"></script>


<!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/pdfmake.min.js"></script> -->
<script src="{!! asset('js/pdfmake.min.js') !!}"></script>


<!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/vfs_fonts.js"></script> -->
<script src="{!! asset('js/vfs_fonts.js') !!}"></script>


<!-- <script src="https://cdn.datatables.net/buttons/1.5.2/js/buttons.html5.min.js"></script> -->
<script src="{!! asset('js/buttons.html5.min.js') !!}"></script>




<!-- <script src="https://cdn.datatables.net/buttons/1.2.1/js/buttons.print.min.js"></script> -->
<script src="{!! asset('js/buttons.print.min.js') !!}"></script>
@stack('scripts')
@show

</body>
</html>
