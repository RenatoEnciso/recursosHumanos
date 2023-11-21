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

        <body data-background-color="dark">
            <div class="wrapper">
                <div class="main-header">
                    <!-- Logo Header -->
                    <div class="logo-header" data-background-color="dark2">

                        <a href="{{route('dashboard')}}" class="logo">
                            <img src="{{asset("images/Logo-Login.png")}}" alt="navbar brand" class="navbar-brand" style="width:145px; padding-left: 10px" >
                        </a>
                        <button class="navbar-toggler sidenav-toggler ml-auto" type="button" data-toggle="collapse" data-target="collapse" aria-expanded="false" aria-label="Toggle navigation">
                            <span class="navbar-toggler-icon">
                                <i class="icon-menu"></i>
                            </span>
                        </button>
                        <button class="topbar-toggler more"><i class="icon-options-vertical"></i></button>
                        <div class="nav-toggle">
                            <button class="btn btn-toggle toggle-sidebar">
                                <i class="icon-menu"></i>
                            </button>
                        </div>
                    </div>
                    <!-- End Logo Header -->

                    <!-- Navbar Header -->
                    <nav class="navbar navbar-header navbar-expand-lg" data-background-color="dark">

                        <div class="container-fluid">
                            @yield('buscar')
                            <ul class="navbar-nav topbar-nav ml-md-auto align-items-center">
                                <li class="nav-item toggle-nav-search hidden-caret">
                                    <a class="nav-link" data-toggle="collapse" href="#search-nav" role="button" aria-expanded="false" aria-controls="search-nav">
                                        <i class="fa fa-search"></i>
                                    </a>
                                </li>

                                @yield('Notificacion')
                               
                                {{-- Menu deplegable de Usuario --}}
                                <li class="nav-item dropdown hidden-caret">
                                    <a class="dropdown-toggle profile-pic" data-toggle="dropdown" href="#" aria-expanded="false">
                                        <div class="avatar-sm">
                                            @if(is_null(Auth::user()->fotoPerfil))
                                                <img src="{{asset('/assets/img/profile.jpg')}}" alt="Foto de perfil" class="avatar-img rounded-circle">
                                                
                                            @else
                                                <img src="{{ Auth::user()->fotoPerfil }}" alt="Foto de perfil" class="avatar-img rounded-circle">
                                            @endif
                                        </div>
                                    </a>
                                    <ul class="dropdown-menu dropdown-user animated fadeIn">
                                        <div class="dropdown-user-scroll scrollbar-outer">
                                            <li>
                                                <div class="user-box">
                                                    <div class="avatar-lg" >
                                                        @if(is_null(Auth::user()->fotoPerfil))
                                                            <img src="{{asset('/assets/img/profile.jpg')}}" alt="Foto de perfil" width="70px" height="250px" class="avatar-img rounded-circle">
                                                            
                                                        @else
                                                            <img src="{{ Auth::user()->fotoPerfil }}" alt="Foto de perfil" width="70px" height="250px" class="avatar-img rounded-circle">
                                                        @endif
                                                    </div>
                                                    <div class="u-text">
                                                        <h2>{{ Auth::user()->name }}</h2>
                                                        <p class="text-muted">{{ Auth::user()->email }}</p>

                                                        <form action="{{route('usuario.update',Auth::user()->id)}}" method="POST" enctype="multipart/form-data">
                                                            @method('PUT')
                                                            @csrf
                                                            <div class="d-flex">
                                                                <label for="archivo" class="bg-success editar_foto">Editar foto</label>
                                                                <input type="file" name="file_fotoPerfil" style="display: none" id="archivo" class="">
                                                                <button class="btn btn-warning p-2 mx-1">Guardar</button>
                                                            </div>

                                                        </form>

                                                        {{-- <a href="{{route('usuario.edit', Auth::user()->id)}}" class="btn btn-xs btn-secondary btn-sm">Editar Foto</a>
                                                         --}}
                                                    </div>
                                                </div>
                                            </li>
                                            <li>
                                                <div class="dropdown-divider"></div>
                                                <a class="dropdown-item" href="{{route('indexU')}}"  >
                                                    <i class="  fa-sm fa-fw mr-2 text-gray-400"></i>
                                                    Listar Empleados
                                                </a>
                                                <div class="dropdown-divider"></div>
                                                <a class="dropdown-item btn btn-danger" href="#" data-toggle="modal" data-target="#logoutModal">
                                                    <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                                                    <span> SALIR </span>
                                                </a>
                                            </li>
                                        </div>
                                    </ul>
                                </li>

                            </ul>
                        </div>
                    </nav>
                    <!-- End Navbar -->
                </div>

                <!-- Sidebar -->
                <div class="sidebar sidebar-style-2" data-background-color="dark2" >
                    <div class="sidebar-wrapper scrollbar scrollbar-inner">
                        <div class="sidebar-content">
                            <div class="user">
                                <div class="avatar-sm float-left mr-2" style="margin-top:15%">
                                    @if(is_null(Auth::user()->fotoPerfil))
                                        <img src="{{asset('/assets/img/profile.jpg')}}" alt="Foto de perfil" width="70px" height="250px" class="avatar-img rounded-circle">
                                        
                                    @else
                                        <img src="{{ Auth::user()->fotoPerfil }}" alt="Foto de perfil" width="70px" height="250px" class="avatar-img rounded-circle">
                                    @endif
                                </div>
                                <div class="info">
                                    <a href="{{route('dashboard')}}" class="nav-link">
                                        <span>
                                            <span>Nombre:</span>
                                            <span><b style="color: white">{{ Auth::user()->name }}</b></span>
                                            <span>Cargo:</span>
                                            <span class="user-level" style="color: white">{{ Auth::user()->rol->nombreRol}}</span>
                                        </span>
                                    </a>
                                </div>
                            </div>
                            <ul class="nav nav-primary">

                                @if (Auth::user()->idRol==5)
                                <li class="nav-item">
                                    <a href="{{route('Ficha.index')}}">
                                        <i class="fa-solid fa-users" ></i>
                                        <p>Gestión de Usuario</p>
                                    </a>
                                </li>
                                @endif
                                @if (Auth::user()->idRol==1)
                                <li class="nav-item">
                                    <a href="{{route('Ficha.index')}}">
                                        <i class="fas fa-id-card"></i>
                                        <p>Ficha de Registro</p>
                                    </a>
                                </li>
                                @endif
                                    
                                @if (Auth::user()->idRol==2)
                                <li class="nav-item">
                                    <a data-toggle="collapse" href="#base">
                                        <i class="far fa-file-alt"></i>
                                        <p>Actas</p>
                                        <span class="caret"></span>
                                    </a>
                                    <div class="collapse" id="base">
                                        <ul class="nav nav-collapse">
                                            <li>
                                                <a href="{{route('ActaNacimiento.index')}}">
                                                    <span class="sub-item">Acta de Nacimiento</span>
                                                </a>
                                            </li>
                                            <li>
                                                <a href="{{route('ActaMatrimonio.index')}}">
                                                    <span class="sub-item">Acta de Matrimonio</span>
                                                </a>
                                            </li>
                                            <li>
                                                <a href="{{route('ActaDefunsion.index')}}">
                                                    <span class="sub-item">Acta de Defuncion</span>
                                                </a>
                                            </li>
                                            
                                        </ul>
                                    </div>
                                </li>

                                <li class="nav-item">
                                    <a  href="{{route('Solicitud.index')}}">
                                        <i class="fas fa-id-card"></i>
                                        <p>Solicitud</p>
                                    </a>

                                </li>
                     
                                    
                                @endif
                                
                                <li class="nav-item">
                                    <a href="{{route('Persona.index')}}">
                                        <i class="fas fa-user-edit"></i>
                                        <p>Persona</p>
                                    </a>
                                </li>
                                @if (Auth::user()->idRol==2)
                                <li class="nav-item">
                                    <a href="{{route('solicitud-dni.index')}}">
                                        <i class="fas fa-user-edit"></i>
                                        <p>Solicitudes Dnis</p>
                                    </a>
                                </li> 
                                @endif

                                @if (Auth::user()->idRol==4)
                                    <li class="nav-item">
                                        <a href="{{route('administrador.index')}}">
                                            <i class="fas fa-user-edit"></i>
                                            <p>Usuarios</p>
                                        </a>
                                    </li> 

                                @endif
                                {{-- Primer sprint de gestion personal --}}
                                @if (Auth::user()->idRol==5)
                                <li class="nav-item">
                                    <a href="{{route('Cargo.index')}}">
                                        <i class="fa-regular fa-address-card"></i>
                                        <p class="sub-item">Cargo</p>
                                    </a>
                                </li>
                                @endif
                                @if (Auth::user()->idRol==5)
                                <li class="nav-item"> 
                                    <a href="{{route('Oferta.index')}}">
                                        <i class="fa-regular fa-address-book"></i>
                                        <p class="sub-item">Oferta</p>
                                    </a>
                                </li>
                                @endif
                                @if (Auth::user()->idRol==5)
                                <li class="nav-item">
                                    <a href="{{route('Postulacion.index')}}">
                                        {{-- <i class="fa-solid fa-address-book"></i>
                                        <i class="fa fa-person-chalkboard"></i> --}}
                                        <i class="fa-solid fa-person-chalkboard"></i>
                                        <p class="sub-item">Postulación</p>
                                    </a>
                                </li>
                                @endif
                                @if (Auth::user()->idRol==5)
                                <li class="nav-item">
                                    <a href="{{route('Entrevista.index')}}">
                                        <i class="fa-sharp fa-solid fa-laptop-file"></i>
                                        <p class="sub-item">Entrevista</p>
                                    </a>
                                </li>
                                @endif
                                {{-- Fin Primer sprint de gestion personal --}}
                                {{-- Segundo sprint de gestion personal --}}
                                @if (Auth::user()->idRol==5)
                                <li class="nav-item">
                                    {{-- <a href="{{route('Horario.index')}}">
                                        <i class="fa-sharp fa-solid fa-laptop-file"></i>
                                        <p class="sub-item">Horario</p>
                                    </a> --}}
                                </li>
                                @endif

                                {{-- Fin Segundo sprint de gestion personal --}}
                                











                                @if (Auth::user()->idRol<4)
                                <li class="nav-item">
                                    {{-- <a  href="{{route('reporte.create')}}">
                                        <i class="fas fa-id-card"></i>
                                        <p>Reportes</p>
                                    </a> --}}
                                </li>
                                @endif

                                
                                
                            </ul>

                        </div>
                    </div>

                </div>
                <!-- End Sidebar -->

                <div class="main-panel">
                    <div class="content">
                        @yield('contenido')
                        <a href="https://wa.me/917700319?text=Me%20gustaría%20obtener%20infor%20precio%20del%20Auto" class="whatsapp" target="_blank"> <i class="fa fa-whatsapp whatsapp-icon"></i></a>

                    </div>
                    <footer class="footer">
                        <div class="container-fluid">

                            <div class="copyright d-block mx-auto">
                                2022, Hecho <i class="fa fa-heart heart text-danger"></i> por G10-ING. DE REQUERIMIENTOS</a>
                            </div>
                        </div>
                    </footer>
                </div>

                <!-- Custom template | don't include it in your project! -->
                <div class="custom-template">
                    <div class="title">Settings</div>
                    <div class="custom-content">
                        <div class="switcher">
                            <div class="switch-block">
                                <h4>Theme</h4>
                                <div class="btnSwitch">

                                    <button type="button" class="selected  changeBackgroundColor changeLogoHeaderColor changeSideBarColor changeTopBarColor" id="inicio" data-color="white" click></button>
                                    <button type="button" class="changeBackgroundColor changeLogoHeaderColor changeSideBarColor changeTopBarColor"  data-color="dark"></button>
                                </div>
                            </div>
                            <div class="switch-block">
                                <h4>Logo Header</h4>
                                <div class="btnSwitch">
                                    <button type="button" class="changeLogoHeaderColor" data-color="dark"></button>
                                    <button type="button" class="changeLogoHeaderColor" data-color="blue"></button>
                                    <button type="button" class="changeLogoHeaderColor" data-color="purple"></button>
                                    <button type="button" class="changeLogoHeaderColor" data-color="light-blue"></button>
                                    <button type="button" class="changeLogoHeaderColor" data-color="green"></button>
                                    <button type="button" class="changeLogoHeaderColor" data-color="orange"></button>
                                    <button type="button" class="changeLogoHeaderColor" data-color="red"></button>
                                    <button type="button" class="changeLogoHeaderColor" data-color="white"></button>
                                    <br/>
                                    <button type="button" class="selected changeLogoHeaderColor" data-color="dark2" id="inicio1"></button>
                                    <button type="button" class="changeLogoHeaderColor" data-color="blue2"></button>
                                    <button type="button" class="changeLogoHeaderColor" data-color="purple2"></button>
                                    <button type="button" class="changeLogoHeaderColor" data-color="light-blue2"></button>
                                    <button type="button" class="changeLogoHeaderColor" data-color="green2"></button>
                                    <button type="button" class="changeLogoHeaderColor" data-color="orange2"></button>
                                    <button type="button" class="changeLogoHeaderColor" data-color="red2"></button>
                                </div>
                            </div>
                            <div class="switch-block">
                                <h4>Navbar Header</h4>
                                <div class="btnSwitch">
                                    <button type="button" class="selected changeTopBarColor" data-color="dark"></button>
                                    <button type="button" class="changeTopBarColor" data-color="blue"></button>
                                    <button type="button" class="changeTopBarColor" data-color="purple"></button>
                                    <button type="button" class="changeTopBarColor" data-color="light-blue"></button>
                                    <button type="button" class="changeTopBarColor" data-color="green"></button>
                                    <button type="button" class="changeTopBarColor" data-color="orange"></button>
                                    <button type="button" class="changeTopBarColor" data-color="red"></button>
                                    <button type="button" class="changeTopBarColor" data-color="white"></button>
                                    <br/>
                                    <button type="button" class="changeTopBarColor" data-color="dark2"></button>
                                    <button type="button" class="changeTopBarColor" data-color="blue2"></button>
                                    <button type="button" class="changeTopBarColor" data-color="purple2"></button>
                                    <button type="button" class="changeTopBarColor" data-color="light-blue2"></button>
                                    <button type="button" class="changeTopBarColor" data-color="green2"></button>
                                    <button type="button" class="changeTopBarColor" data-color="orange2"></button>
                                    <button type="button" class="changeTopBarColor" data-color="red2"></button>
                                </div>
                            </div>
                            <div class="switch-block">
                                <h4>Sidebar</h4>
                                <div class="btnSwitch">
                                    <button type="button" class="changeSideBarColor" data-color="white"></button>
                                    <button type="button" class="changeSideBarColor" data-color="dark"></button>
                                    <button type="button" class="selected changeSideBarColor" data-color="dark2" id="inicio2"></button>
                                </div>
                            </div>
                            <div class="switch-block">
                                <h4>Background</h4>
                                <div class="btnSwitch">
                                    <button type="button" class="changeBackgroundColor" data-color="bg2" ></button>
                                    <button type="button" class="changeBackgroundColor " data-color="bg1"></button>
                                    <button type="button" class="changeBackgroundColor" data-color="bg3"></button>
                                    <button type="button" class="selected changeBackgroundColor" data-color="dark"></button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="custom-toggle">
                        <i class="flaticon-settings"></i>
                    </div>
                </div>
                <!-- End Custom template -->
            </div>

            <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
                        <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>
                    <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
                    <div class="modal-footer">
                        <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf

                            <x-dropdown-link :href="route('logout')"
                                    onclick="event.preventDefault();
                                                this.closest('form').submit();">
                                {{ __('salir') }}
                            </x-dropdown-link>
                        </form>
                    </div>
                </div>
            </div>
        </div>
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
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" 
        integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous">
    </script>
    
</body>
</html>
</x-app-layout>