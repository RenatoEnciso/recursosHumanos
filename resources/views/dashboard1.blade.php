<x-app-layout>
    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <title>RENIEC</title>
        <meta content='width=device-width, initial-scale=1.0, shrink-to-fit=no' name='viewport' />
        <link rel="icon" href="{{asset('/img/login/logo.png')}}" type="image/x-icon"/>
        <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
        <script src="https://kit.fontawesome.com/7920972db5.js" crossorigin="anonymous"></script>
        <link rel="stylesheet" href="select2-dark-adminlte-theme.css">
        <!-- Fonts and icons -->
        <script src="{{asset('assets/js/plugin/webfont/webfont.min.js')}}"></script>
        <script>
            WebFont.load({
                google: {"families":["Lato:300,400,700,900"]},
                custom: {"families":["Flaticon", "Font Awesome 5 Solid", "Font Awesome 5 Regular", "Font Awesome 5 Brands", "simple-line-icons"], urls: [' /assets/css/fonts.min.css']},
                active: function() {
                    sessionStorage.fonts = true;
                }
            });
        </script>
<style>
    .select2-container--default .select2-selection--single{
    background-color:transparent !important;
  }
</style>
        <!-- Custom fonts for this template-->
        <link href="/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
        <link
            href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
            rel="stylesheet">

        <!-- CSS Files -->
        {{-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous"> --}}
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
        <link rel="stylesheet" href="{{asset('/css/estilos.css')}}">

        <link rel="stylesheet" href="{{asset('/assets/css/bootstrap.min.css')}}">
        <link rel="stylesheet" href="{{asset('/assets/css/atlantis.min.css')}}">


        <!-- CSS Just for demo purpose, don't include it in your project -->
        <link rel="stylesheet" href="{{asset('/assets/css/demo.css')}}">
        
    </head>

        
    body > div.wrapper > div.main-panel > div > div
    
        <script src=" /assets/js/core/jquery.3.2.1.min.js"></script>
        <script src=" /assets/js/core/popper.min.js"></script>
        <script src=" /assets/js/core/bootstrap.min.js"></script>
        <script src="https://code.jquery.com/jquery-3.2.1.js"></script>
        <!-- jQuery UI -->
        <script src=" /assets/js/plugin/jquery-ui-1.12.1.custom/jquery-ui.min.js"></script>
        <script src=" /assets/js/plugin/jquery-ui-touch-punch/jquery.ui.touch-punch.min.js"></script>
        <!-- jQuery Vector Maps -->
        <script src=" /assets/js/plugin/jqvmap/jquery.vmap.min.js"></script>
        <script src=" /assets/js/plugin/jqvmap/maps/jquery.vmap.world.js"></script>

        <!-- jQuery Scrollbar -->
        <script src=" /assets/js/plugin/jquery-scrollbar/jquery.scrollbar.min.js"></script>
            <!-- jQuery Sparkline -->
        <script src=" /assets/js/plugin/jquery.sparkline/jquery.sparkline.min.js"></script>

        <!-- Chart JS -->
        <script src=" /assets/js/plugin/chart.js/chart.min.js"></script>



        <!-- Chart Circle -->
        <script src=" /assets/js/plugin/chart-circle/circles.min.js"></script>

        <!-- Datatables -->
        <script src=" /assets/js/plugin/datatables/datatables.min.js"></script>

        <!-- Bootstrap Notify -->
        <script src=" /assets/js/plugin/bootstrap-notify/bootstrap-notify.min.js"></script>



        <!-- Sweet Alert -->
        <script src=" /assets/js/plugin/sweetalert/sweetalert.min.js"></script>

        <!-- Atlantis JS -->
        <script src=" /assets/js/atlantis.min.js"></script>

        <!-- Atlantis DEMO methods, don't include it in your project! -->
        <script src=" /assets/js/setting-demo.js"></script>
        <script src=" /assets/js/demo.js"></script>
        <script>
            $('#lineChart').sparkline([102,109,120,99,110,105,115], {
                type: 'line',
                height: '70',
                width: '100%',
                lineWidth: '2',
                lineColor: 'rgba(255, 255, 255, .5)',
                fillColor: 'rgba(255, 255, 255, .15)'
            });

            $('#lineChart2').sparkline([99,125,122,105,110,124,115], {
                type: 'line',
                height: '70',
                width: '100%',
                lineWidth: '2',
                lineColor: 'rgba(255, 255, 255, .5)',
                fillColor: 'rgba(255, 255, 255, .15)'
            });

            $('#lineChart3').sparkline([105,103,123,100,95,105,115], {
                type: 'line',
                height: '70',
                width: '100%',
                lineWidth: '2',
                lineColor: 'rgba(255, 255, 255, .5)',
                fillColor: 'rgba(255, 255, 255, .15)'
            });
        </script>
         <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>


         <script type="text/javascript">
             $(document).ready(function() {
                 setTimeout(function() {
                     $(".emergente").fadeOut(1000);
            

                 },2000);
             });
         </script>
         <script type="text/javascript">
           
                setTimeout(function() {

                    document.getElementById('inicio').click();
                    document.getElementById('inicio1').click();
                    document.getElementById('inicio2').click();
                },1);
            ;
        </script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
        </body>
    </html>
</x-app-layout>
