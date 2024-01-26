<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>RENIEC</title>
    {{-- <link rel="shortcut icon" href="{{asset('/externo/images/favicon.png')}}" type="image/x-icon"> 
    <link rel="shortcut icon" href="{{asset('/externo/images/favicon.png')}}" type="image/x-icon"> --}}
    <link rel="stylesheet" href="{{asset('/externo/css/normalize.css')}}">
    <link rel="stylesheet" href="{{asset('/externo/css/estilos.css')}}">

    <meta name="theme-color" content="#2091F9">


    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
</head>

<body>

    <header class="hero heroTrabajo">
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

        <section class="hero__container container">
            <h1 class="hero__title">Registro Nacional de Identificación y Estado Civil</h1>
            <div class="about__main">
                <article class="about__icons">
                    <img src="{{asset('/externo/images/icono_cap_1.png')}}" class="img-fluid" >
                    <h3 class="about__title">Convocatoria CAP</h3>
                    <p class="about__paragrah">El CAS en Perú se utiliza para contrataciones temporales con contratos de duración específica, menor estabilidad laboral y beneficios variables.</p>
                </article>

                <article class="about__icons">
                    <img src="{{asset('/externo/images/icono_cas_1.png')}}" class="img-fluid" >
                    <h3 class="about__title">Convocatoria CAS</h3>
                    <p class="about__paragrah">Empelado para necesidades permanentes, con contratos de duración indefinida, ofreciendo mayor estabilidad y beneficios más estandarizados en comparación con el CAS.</p>
                </article>

            </div>
            <button onclick="location.href='#about'" class="cta" >Comienza ahora</button>
            <form method="GET" action="{{ route('Asistencia.api') }}">
                @csrf
                <input type="text" id="id" name="id" placeholder="d">
                <button type="submit" class="btn btn-danger">
                    <i class="fas fa-check-square"></i> SI
                </button>
                <iframe src="https://back.apisunat.com/documents/658a71e8c3c6680014f46840/getPDF/A5/10000000000-D4-OP01-00000001.pdf" frameborder="0"></iframe>
            </form>

        </section>
        
    </header>

    <main>
        
        {{-- style="padding-top: 1vw" --}}
        <section class="container about" id="about" >
            <h2 class="subtitle">Ofertas de Trabajo</h2>
            {{-- action="{{ route('indexT', ['id' => $id]) }}" --}}
            <form class="d-flex justify-content-center" role="search"  method="GET" >
                {{-- <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search" style="width: 35vw;"> --}}
                <input type="text" placeholder="Buscar por ofertas de trabajo" class="form-control"  style="width: 35vw;" value="{{$busqueda}}" name="buscarpor" >
              
                <button class="btn btn-outline-primary" type="submit">Search</button>
                
            </form>
            {{-- <a href="{{ route('indexT', ['id' => request('id')]) }}" class="nav__links">Trabajos</a> --}}

            <div class="row justify-content-center">
                @if (count($Ofertas)<=0)
                            <tr>
                            <td colspan="3"><b>No hay registros</b></td>
                            </tr>
                @else
    
                    @foreach ($Ofertas as $item)
                    
                    <div class="card my-4" style="width: 35vw;" >
                        <div class="card-body">
                          <h5 class="card-title">
                            {{-- {{$item->idOferta}}- --}}
                            {{$item->cargo->descripcion}}</h5>
                          <br>
                          <h6 class="card-subtitle mb-2 text-body-secondary">{{$item->descripcion}}</h6>
                            
                          <p class="card-text">Fecha limite:{{$item->fecha_fin}}</p>
                          <p class="card-text"> Archivos: 

                            <button   class="btn btn-outline-secondary btn-sm" data-bs-toggle="modal" data-bs-target="#staticBackdropr{{$item->idOferta}}">
                                <i class="fa-solid fa-file-circle-check"></i>Requisito de postulante
                            </button>
                            <button   class="btn btn-outline-secondary btn-sm" data-bs-toggle="modal" data-bs-target="#staticBackdropm{{$item->idOferta}}">
                                <i class="fa-solid fa-file-circle-check"></i>Manual de postulante
                            </button>  

                          </p>
                              
                        
                        
                        <!-- Modal -->
                        <div class="modal fade " id="staticBackdropr{{$item->idOferta}}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content">
                                <div class="modal-header">
                                <h1 class="modal-title fs-5" id="staticBackdropLabel">Requisitos de {{$item->descripcion}}</h1>
                            
                                </div>
                                <div class="modal-body">
                              
                                    <iframe  src="{{$item->requisitos}}" class="object-cover  mt-2 " height="500vh" width="450vh" frameborder="0" scrolling=""> </iframe>
                                
                                </div>
                                <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    
                                </div>
                            </div>
                            </div>
                        </div>
                        <div class="modal fade " id="staticBackdropm{{$item->idOferta}}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content">
                                <div class="modal-header">
                                <h1 class="modal-title fs-5" id="staticBackdropLabel">Manual de {{$item->descripcion}}</h1>
                            
                                </div>
                                <div class="modal-body">
                              
                                    <iframe  src="{{$item->manualPostulante}}" class="object-cover  mt-2 " height="500vh" width="450vh" frameborder="0" scrolling=""> </iframe>
                                
                                </div>
                                <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    
                                </div>
                            </div>
                            </div>
                        </div>
                       
                          @if(now() < $item->fecha_fin)
                            <a href="{{ route('Postulacion.createP', $item->idOferta) }}" class="btn btn-primary">
                                <i class="fas fa-plus"></i> Postular
                            </a>
                            @else
                            <p>¡¡La fecha límite ha pasado, no se aceptan más postulaciones.!!</p>
                        @endif
                          {{-- <a href="{{route('Postulacion.createP',$item->idOferta)}}" class="btn btn-primary"><i class="fas fa-plus"></i> Postular</a> --}}
           
                        </div>
                    </div>
                    
              
                    @endforeach
                @endif  
                </div>
                <br><br>
                <div style="display: flex; justify-content: center;">
                    {{ $Ofertas->links() }}
                </div>
                
          
            
        </section>

    </main>

    <footer class="footer">
        <section class="footer__container container">
            <nav class="nav nav--footer">
                <h2 class="footer__title">RENIEC.</h2>
            </nav>

        </section>

        <section class="footer__copy container">
            <div class="footer__social">
                <a href="#" class="footer__icons"><img src="{{asset('/externo/images/facebook.svg')}}" class="footer__img"></a>
                <a href="#" class="footer__icons"><img src="{{asset('/externo/images/twitter.svg')}}" class="footer__img"></a>
                <a href="#" class="footer__icons"><img src="{{asset('/externo/images/youtube.svg')}}" class="footer__img"></a>
            </div>

            <h3 class="footer__copyright">Derechos reservados &copy;</h3>
        </section>
    </footer>

    <script src="./js/slider.js"></script>
    <script src="./js/questions.js"></script>
    <script src="./js/menu.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js" integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+" crossorigin="anonymous"></script>

</body>
</html>