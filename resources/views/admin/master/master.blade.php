<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0' name='viewport' />
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <meta name="robots" content="noindex, nofollow" />

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title')</title>

    <!-- Styles -->
    <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/light-bootstrap-dashboard.css') }}" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href="{{ asset('css/prtkl.css') }}?ver=18" rel="stylesheet">
    <script src="{{ asset('js/jquery.min.js') }}"></script>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/6.6.9/sweetalert2.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/6.6.9/sweetalert2.min.js"></script>

   <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.12.4/css/bootstrap-select.min.css"/>



    <link rel="shortcut icon" type="image/x-icon" href="{{asset('img/fav.ico')}}">
   

 

 
</head>
<body>

        
        @include('admin.partials.sidebar')

         <div class="main-panel">
            
                @include('admin.partials.head')
           

            <div class="content">
                <div class="container-fluid">

                    <div class="row">
                        <div class="col-md-12">
                            <div class="card row">
                                <div class="content">
                                @yield('content')
                                </div>
                            </div>
                        </div>        
                    </div>
                </div>
            </div>
      </div>
    <!-- Scripts -->

    <script src="{{ asset('js/jquery-ui.min.js') }}"></script>
    <script src="{{ asset('js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('js/jquery.validate.min.js') }}"></script>

        <script src="{{ asset('js/moment.min.js') }}"></script>
        <script src="{{ asset('js/moment-with-locales.js') }}"></script>

        <script src="{{ asset('js/bootstrap-datetimepicker.js') }}"></script>
        <script src="{{ asset('js/bootstrap-datetimepicker.tr.js') }}"></script>
    <script src="{{ asset('js/bootstrap-selectpicker.js') }}"></script>


    <script src="{{ asset('js/jquery.datatables.js') }}?ver=4"></script>
     <script src="https://cdn.datatables.net/buttons/1.5.1/js/dataTables.buttons.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
  <script src="https://cdn.datatables.net/buttons/1.5.1/js/buttons.html5.min.js"></script>
  
  



    



    <script src="{{ asset('js/light-bootstrap-dashboard.js') }}"></script>
    <script src="{{ asset('js/main.js') }}"></script>
    <script src="{{ asset('js/demo.js') }}"></script>


        <script type="text/javascript">
            $('.datetimepicker').datetimepicker({
                format: 'dd/mm/yyyy',
                language: 'tr'
            });

        </script>




     <script type="text/javascript">

        $().ready(function(){

            // Init Sliders
            demo.initFormExtendedSliders();

            // Init DatetimePicker
            demo.initFormExtendedDatetimepickers();
        });
    </script>




    <script type="text/javascript">
    $().ready(function(){
        lbd.checkFullPageBackgroundImage();

        setTimeout(function(){
            // after 1000 ms we add the class animated to the login/register card
            $('.card').removeClass('card-hidden');
        }, 700)
    });
</script>










</body>
</html>
