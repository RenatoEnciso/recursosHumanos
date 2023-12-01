
<x-app-layout>
<!DOCTYPE html>
    <html lang="en">
    <head>
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <title>RENIEC</title>
       
        <link rel="stylesheet" href="{{asset('/css/estilos.css')}}">
        
        <link rel="stylesheet" href="{{asset('/externo/css/normalize.css')}}">
     
        <link rel="stylesheet" href="{{asset('/externo/css/estilos.css')}}">
        <link rel="stylesheet" href="{{asset('/assets/css/atlantis.min.css')}}">
        
        <meta name="theme-color" content="#2091F9">
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
       
        

        <!-- CSS Just for demo purpose, don't include it in your project -->
        <link rel="stylesheet" href="{{asset('/assets/css/demo.css')}}">
        
    </head>

<body>

    <header class="hero hero1">
        <nav class="nav container">
            <div class="nav__logo">
                <h2 class="nav__title">RENIEC</h2>
            </div>

            <ul class="nav__link nav__link--menu">
                <li class="nav__items">
                    <a href="/" class="nav__links">Inicio</a>
                </li>
                <li class="nav__items">
                    <a href="#" class="nav__links">Contacto</a>
                </li>
                <li class="nav__items">
                    <a href="/trabajo" class="nav__links">Trabajos</a>
                </li>
                <li class="nav__items">
                    <a href="/login" class="nav__links">Ingresar</a>
                </li>

                <img src="{{asset('/externo/images/close.svg')}}" class="nav__close">
            </ul>

            <div class="nav__menu">
                <img src="{{asset('/externo/images/menu.svg')}}" class="nav__img">
            </div>
        </nav>

    </header>

    <main>
    <div class="content">
        <div class="container">
            <div class="shadow-lg py-4 bg-body-tertiary rounded" style="margin-top:8vh">
                
                <h1 id="titulo" class="acta_title">Registro Postulación</h1>
                <form method="POST" action="{{ route('Postulacion.store') }}" enctype="multipart/form-data">
                    @csrf
                <div class="row justify-content-center">
                    <ul class="nav nav-tabs" id="myTab" role="tablist">
                        <li class="nav-item" role="presentation">
                        <button class="nav-link active" id="profile-tab" data-bs-toggle="tab" data-bs-target="#profile-tab-pane" type="button" role="tab" aria-controls="profile-tab-pane" aria-selected="false">1 Datos Personales y CV</button>
                        </li>
                        <li class="nav-item" role="presentation">
                        <button class="nav-link" id="contact-tab" data-bs-toggle="tab" data-bs-target="#contact-tab-pane" type="button" role="tab" aria-controls="contact-tab-pane" aria-selected="false">2 Educación y experiencia laboraal</button>
                        </li>
                
                    </ul>
                </div>
                <div class="tab-content" id="myTabContent">
            
                    <div class="tab-pane fade show active" id="profile-tab-pane" role="tabpanel" aria-labelledby="profile-tab" tabindex="0">
                        
                        <div class="row justify-content-center">
                            <div class="col-4">
                                <div class="row justify-content-center">
                                    {{-- <div class="col-4 form-group">
                                        <label class="control-label">Curriculum</label>
                                        <input type="file" class="form-control @error('curriculum') is-invalid @enderror"
                                            placeholder="Ingrese curriculum"  name="curriculum">
                                        @error('curriculum')
                                            <span class="invalid feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div> --}}
                                    <div class="col form-group">
                                        <label class="control-label">Oferta</label>
                                        <select name="idOferta" id="idOferta" class="form-control" readonly >
                                            @foreach ($ofertas as $item)
                                            <option value="{{ $item->idOferta}}"
                                                {{$oferta->idOferta==$item->idOferta?'selected':''}}
                                                >{{ $item->descripcion }}</option> 
                                            @endforeach
                                            {{-- <option value="5">5</option> 
                                            <option >6</option>  --}}
                                        </select>
                                        
                                    </div>
                                    
                                </div>
                                <div class="row justify-content-center">
                        
                        
                                    <div class="col form-group">
                                        <label class="control-label">Fecha</label>
                                        <input type="date" class="form-control @error('fecha') is-invalid @enderror" value="" id="fecha" 
                                            name="fecha" >
                                        @error('fecha')
                                            <span class="invalid feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                
                                    <div class="col form-group">
                                        <label class="control-label">Persona</label>
                                        <select name="DNI" id="DNI" class="form-control @error('DNI') is-invalid @enderror"  >
                                            @foreach ($personas as $item)
                                                <option value="{{ $item->DNI}}">{{ $item->DNI}}</option> 
                                            @endforeach
                                        </select>
                                        @error('DNI')
                                            <span class="invalid feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    
                                </div>
                            
                            </div>
                            <div class="col-4">
                                <div class="row justify-content-center">
                        
                        
                                    <div class="col-6 form-group">
                                        <label class="control-label">Email address</label>
                                        <input type="email" class="form-control @error('email') is-invalid @enderror" id="floatingInput"  name="email" id="email" >
                                        @error('email')
                                            <span class="invalid feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                
                                    <div class="col-6 form-group">
                                        <label class="control-label">Teléfono</label>
                                    
                                        <input type="text" class="form-control @error('telefono') is-invalid @enderror" value="" id="telefono" 
                                            name="telefono" >
                                        @error('telefono')
                                            <span class="invalid feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    
                                </div>
                                {{-- <div class="col-12">
                                    <label class="control-label">Archivo de Nacimiento</label>
                                    <input type="file" class="form-control @error('archivo_nacimiento') is-invalid @enderror"
                                        placeholder="Ingrese Archivo" id="archivo_nacimiento" name="archivo_nacimiento"
                                        value="{{ old('archivo_nacimiento') }}" x-data="showImage()" @change="showPreview(event)">
                                    @error('archivo_nacimiento')
                                        <span class="invalid feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                    <iframe id="preview"   class="object-cover h-32 mt-2 w-60" height="400vh"> </iframe>
                                    <br>
                                </div> --}}
                                <div class="row justify-content-center">

                                    <div class="col-12 form-group">
                                        <label class="control-label">Curriculum</label>
                                        <input type="file" class="form-control @error('curriculum') is-invalid @enderror"
                                        placeholder="Ingrese curriculum" id="curriculum" name="curriculum"
                                        value="{{ old('curriculum') }}" x-data="showImage()" @change="showPreview(event)">
                                    @error('curriculum')
                                        <span class="invalid feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                    <iframe id="preview"   class="object-cover h-32 mt-2 w-60" height="400vh" width="100%" style="display: none"> </iframe>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="boton_div">
                            <div class="col-8 form-group flex">
                                <div>
                                    <button onclick="document.getElementById('contact-tab').click();" type="button" role="tab"class="btn btn-primary boton">Siguiente</button>
                                
                                </div>

                            </div>
                        </div>
                        
                    </div>
                    <div class="tab-pane fade" id="contact-tab-pane" role="tabpanel" aria-labelledby="contact-tab" tabindex="0">
                        <div class="row justify-content-center">
        
                            <div class="col-4 form-group">
                                <label class="control-label">Titulo</label>
                            
                                <input type="text" class="form-control @error('titulo') is-invalid @enderror" value="" id="tituloo" 
                                    name="titulo" >
                                @error('titulo')
                                    <span class="invalid feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror

                            </div>
                            <div class="col-4 form-group">
                                <label class="control-label">Pais</label>
                            
                                <input type="text" class="form-control" value="" id="pais" 
                                    name="pais" >
                                @error('pais')
                                    <span class="invalid feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>   
                        <div class="row justify-content-center">
                            <div class="col-4 form-group">
                                <label class="control-label">Institución</label>
                            
                                <input type="text" class="form-control @error('institucion') is-invalid @enderror" value="" id="institucion" 
                                    name="institucion" >
                                @error('institucion')
                                    <span class="invalid feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="col-4 form-group">
                                <label class="control-label">Area de estudio</label>
                            
                                <input type="text" class="form-control @error('areaEstudio') is-invalid @enderror" value="" id="areaEstudio" 
                                    name="areaEstudio" >
                                @error('areaEstudio')
                                    <span class="invalid feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>  
                        <div class="row justify-content-center"> 
                            <div class="col-4 form-group">
                                <label class="control-label">Nivel de estudio</label>
                            
                                <input type="text" class="form-control @error('nivelEstudio') is-invalid @enderror" value="" id="nivelEstudio" 
                                    name="nivelEstudio" >
                                    @error('nivelEstudio')
                                    <span class="invalid feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="col-4 form-group">
                                <label class="control-label">Estado de estudio</label>
                            
                                <input type="text" class="form-control @error('estadoEstudio') is-invalid @enderror" value="" id="estadoEstudio" 
                                    name="estadoEstudio" >
                                @error('estadoEstudio')
                                    <span class="invalid feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            
                        </div>
                
                
                        <div class="boton_div">
                            <div class="col-8 form-group flex">
                                <div>
                                    <button class="btn btn-primary boton"><i class="fas fa-save"></i> GUARDAR</button>
                                </div>
                                <div></div>
                                <div>
                                    <a href="/Oferta" class="btn btn-danger boton"><i class="fas fa-ban"></i> CANCELAR</a>
                                    {{-- <a href="{{route('Entrevista.cancelar') }}" class="btn btn-danger boton"><i class="fas fa-ban"></i> CANCELAR</a> --}}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
                </form>
            </div>
        </div>
    </div>

    

</main>

<footer class="footer">
    <section class="footer__container container">
        <nav class="nav nav--footer">
            <h2 class="footer__title">RENIEC.</h2>
        </nav>

    </section>

    <section class="footer__copy container">
        <div class="footer__social row justify-content-center">
            <a href="#" class="footer__icons"><img src="{{asset('/externo/images/facebook.svg')}}" class="footer__img"></a>
            <a href="#" class="footer__icons"><img src="{{asset('/externo/images/twitter.svg')}}" class="footer__img"></a>
            <a href="#" class="footer__icons"><img src="{{asset('/externo/images/youtube.svg')}}" class="footer__img"></a>
        </div>
      

        <h3 class="footer__copyright">Derechos reservados &copy;</h3>
        {{-- <div class="footer__social row justify-content-center">
            <h3 class="footer__copyright">Derechos reservados &copy;</h3>
        </div> --}}
    </section>
</footer>

<script>
    function showImage() {
        return {
            showPreview(event) {
                if (event.target.files.length > 0) {
                    var src = URL.createObjectURL(event.target.files[0]);
                    var preview = document.getElementById("preview");
                    preview.src = src;
                    preview.style.display = "block";
                }
            }
        }
    }
</script>
<script>
    function mensaje() {
    $('#DNI').select2();
    $('#idLibro').select2();
    $('#idFolio').select2();
    }
    setTimeout(mensaje,100);
</script>
<script src="{{asset('/externo/js/slider.js')}}"></script>
<script src="{{asset('/externo/js/questions.js')}}"></script>
<script src="{{asset('/externo/js/menu.js')}}"></script>
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