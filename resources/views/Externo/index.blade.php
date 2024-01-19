<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>RENIEC</title>

    {{-- <link rel="shortcut icon" href="{{asset('/externo/images/favicon.png')}}" type="image/x-icon"> 
    <link rel="shortcut icon" href="{{asset('/externo/images/favicon.png')}}" type="image/x-icon"> --}}
    <link rel="stylesheet" href="{{ asset('/externo/css/normalize.css') }}">
    <link rel="stylesheet" href="{{ asset('/externo/css/estilos.css') }}">
    <meta name="theme-color" content="#2091F9">
    {{-- <link rel="stylesheet" href="{{asset('/assets/css/bootstrap.min.css')}}"> --}}

    {{-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous"> --}}

</head>

<body>

    <header class="hero">
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
                    @php
                        $id = ' ';
                    @endphp
                    <form action="{{ route('indexT') }}">
                        <button class="nav__links"
                            style="background-color: transparent;
                        border: none;
                ">
                            Trabajos
                        </button>
                    </form>
                    {{-- <a href="{{ route('indexT', ['id' => $id]) }}" class="nav__links">Trabajos</a> --}}
                </li>
                <li class="nav__items dropdown">
                    <a href="#" class="nav__links dropdown-toggle" id="navbarDropdown" role="button"
                        data-bs-toggle="dropdown" aria-expanded="false">
                        Consulta Actas
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="navbarDropdown" style="padding-left: 1vw">
                        <a class="dropdown-item" href="{{ route('ConsultaNacimiento') }}"
                            style="text-decoration: none">Acta Nacimiento</a>
                        <br>
                        <a class="dropdown-item" href="{{ route('ConsultaDefuncion') }}"
                            style="text-decoration: none;">Acta Defuncion</a>
                        <br>
                        <a class="dropdown-item" href="{{ route('ConsultaMatrimonio') }}"
                            style="text-decoration: none;">Acta Matrimonio</a>
                        <br>
                    </ul>
                </li>
                <li class="nav__items dropdown">
                    <a href="#" class="nav__links dropdown-toggle" id="dropDownSolicitud" role="button"
                        data-bs-toggle="dropdown" aria-expanded="false">
                        Solicitud DNI
                    </a>
                    <ul class="dropdown-menu2" aria-labelledby="dropDownSolicitud" style="padding-left: 1vw">
                        <a class="dropdown-item" href="{{ route('sol-duplicado.create') }}"
                            style="text-decoration: none">Solicitar Dni Por Duplicado</a>
                        <br>
                        <a class="dropdown-item" href="{{ route('ConsultaDefuncion') }}"
                            style="text-decoration: none;">Solicitar Dni por Renovacion</a>
                        <br>
                    </ul>
                </li>
               

                <li class="nav__items">
                    <a href="/login" class="nav__links">Ingresar</a>
                </li>

                <img src="{{ asset('/externo/images/close.svg') }}" class="nav__close">
            </ul>

            <div class="nav__menu">
                <img src="{{ asset('/externo/images/menu.svg') }}" class="nav__img">
            </div>
        </nav>

        <section class="hero__container container">
            <h1 class="hero__title">Registro Nacional de Identificación y Estado Civil</h1>
            <p class="hero__paragraph">Entidad gubernamental encargada de emitir documentos de identificación, como el
                DNI, y de registrar eventos vitales, como nacimientos y matrimonios, en países como Perú. Su función
                principal es mantener actualizado el registro civil de la población.</p>

        </section>
    </header>

    <main>
        <section class="container about">
            <h2 class="subtitle">¿Que hace RENIEC?</h2>

            <div class="about__main">
                <article class="about__icons">
                    <img src="{{ asset('/externo/images/shapes.svg') }}" class="about__icon">
                    <h3 class="about__title">DNI</h3>
                    <p class="about__paragrah">Lorem ipsum dolor sit amet consectetur, adipisicing elit. Quae tempore
                        porro eius facilis?</p>
                </article>

                <article class="about__icons">
                    <img src="{{ asset('/externo/images/estado.png') }}" class="about__icon">
                    <h3 class="about__title">Estado Civil</h3>
                    <p class="about__paragrah">Lorem ipsum dolor sit amet consectetur, adipisicing elit. Quae tempore
                        porro eius facilis?</p>
                </article>

                <article class="about__icons">
                    <img src="{{ asset('/externo/images/paint.svg') }}" class="about__icon">
                    <h3 class="about__title">Solitudes</h3>
                    <p class="about__paragrah">Lorem ipsum dolor sit amet consectetur, adipisicing elit. Quae tempore
                        porro eius facilis?</p>
                </article>
            </div>
        </section>

        <section class="testimony">
            <div class="testimony__container container">
                <img src="{{ asset('/externo/images/leftarrow.svg') }}" class="testimony__arrow" id="before">

                <section class="testimony__body testimony__body--show" data-id="1">
                    <div class="testimony__texts">
                        <h2 class="subtitle">Mi nombre es Liliana Alexandra, <span class="testimony__course">Directiva
                                de RENIEC</span></h2>
                        <p class="testimony__review">Lorem, ipsum dolor sit amet consectetur adipisicing elit. Ut est
                            esse, asperiores eaque totam nulla repudiandae quasi, deserunt culpa exercitationem
                            blanditiis laborum veniam laboriosam saepe reiciendis dolorem. Cum, ratione voluptatum!</p>
                    </div>

                    <figure class="testimony__picture">
                        <img src="{{ asset('/externo/images/face.jpg') }}" class="testimony__img">
                    </figure>
                </section>

                <section class="testimony__body" data-id="2">
                    <div class="testimony__texts">
                        <h2 class="subtitle">Mi nombre es Alejandra Perez, <span class="testimony__course">Jefa de
                                RRHH</span></h2>
                        <p class="testimony__review">Lorem, ipsum dolor sit amet consectetur adipisicing elit. Ut est
                            esse, asperiores eaque laborum veniam laboriosam saepe reiciendis dolorem. Cum, ratione
                            voluptatum!</p>
                    </div>

                    <figure class="testimony__picture">
                        <img src="{{ asset('/externo/images/face2.jpg') }}" class="testimony__img">
                    </figure>
                </section>

                <section class="testimony__body" data-id="3">
                    <div class="testimony__texts">
                        <h2 class="subtitle">Mi nombre es Karen Arteaga, <span class="testimony__course">Practicante
                                de RENIEC</span></h2>
                        <p class="testimony__review">Lorem, ipsum dolor sit amet consectetur adipisicing elit. Ut est
                            esse, niam laboriosam saepe reiciendis dolorem. Cum, ratione voluptatum!</p>
                    </div>

                    <figure class="testimony__picture">
                        <img src="{{ asset('/externo/images/face3.jpg') }}" class="testimony__img">
                    </figure>
                </section>

                <section class="testimony__body" data-id="4">
                    <div class="testimony__texts">
                        <h2 class="subtitle">Mi nombre es Kevin Ramirez, <span class="testimony__course">Encargado de
                                area de TI</span></h2>
                        <p class="testimony__review">Lorem, ipsum dolor sit amet consectetur adipisicing elit. Ut est
                            esse, niam laboriosam saepe reiciendis dolorem. Cum, ratione voluptatum!</p>
                    </div>

                    <figure class="testimony__picture">
                        <img src="{{ asset('/externo/images/face4.jpg') }}" class="testimony__img">
                    </figure>
                </section>


                <img src="{{ asset('/externo/images/rightarrow.svg') }}" class="testimony__arrow" id="next">
            </div>
        </section>

        <section class="questions container">
            <h2 class="subtitle">Preguntas frecuentes</h2>
            <p class="questions__paragraph">Lorem ipsum, dolor sit amet consectetur adipisicing elit. Ea, porro
                doloribus neque perspiciatis sapiente fuga.</p>

            <section class="questions__container">
                <article class="questions__padding">
                    <div class="questions__answer">
                        <h3 class="questions__title">¿Como solicito DNI?
                            <span class="questions__arrow">
                                <img src="{{ asset('/externo/images/arrow.svg') }}" class="questions__img">
                            </span>
                        </h3>
                        <div class="questions__show">

                        <div class="mb-3">
                            <div> <strong>Primera vez:</strong>   </div> 
                            Debes acudir a una oficina de RENIEC con dos fotos tamaño
                            carné.
                            Luego, debes llenar un formulario y pagar la tasa correspondiente.
                        </div>

                        <div class="mb-3">
                            <div> <strong>Renovación:</strong> </div>  Puedes hacerlo a través de la página web de RENIEC.
                            Necesitarás tu DNI actual y pagar la tasa de renovación.
                            Si tu DNI ha caducado, también necesitarás una foto tamaño carné.
                        </div>

                        <div class="mb-3">
                            <div> <strong>Duplicado:</strong>  </div>
                            Si has perdido tu DNI o ha sido robado, puedes solicitar un
                            duplicado en la página web de RENIEC.
                            Necesitarás pagar la tasa de duplicado.
                        </div>

                    </div>
                    </div>
                </article>

                <article class="questions__padding">
                    <div class="questions__answer">
                        <h3 class="questions__title">¿Como solicito copia de estado civil?
                            <span class="questions__arrow">
                                <img src="{{ asset('/externo/images/arrow.svg') }}" class="questions__img">
                            </span>
                        </h3>

                        <p class="questions__show">Lorem ipsum, dolor sit amet consectetur adipisicing elit. Quos
                            facere, quidem eum id excepturi assumenda explicabo nam accusamus veritatis voluptates
                            eveniet adipisci, dicta nihil nemo modi possimus officiis quam atque? Lorem ipsum, dolor sit
                            amet consectetur adipisicing elit. Quos facere, quidem eum id excepturi assumenda explicabo
                            nam accusamus veritatis voluptates eveniet adipisci, dicta nihil nemo modi possimus officiis
                            quam atque?</p>
                    </div>
                </article>

                <article class="questions__padding">
                    <div class="questions__answer">
                        <h3 class="questions__title">¿Como trabajo en RENIEC?
                            <span class="questions__arrow">
                                <img src="{{ asset('/externo/images/arrow.svg') }}" class="questions__img">
                            </span>
                        </h3>

                        <p class="questions__show">Lorem ipsum, dolor sit amet consectetur adipisicing elit. Quos
                            facere, quidem eum id excepturi assumenda explicabo nam accusamus veritatis voluptates
                            eveniet adipisci, dicta nihil nemo modi possimus officiis quam atque? Lorem ipsum, dolor sit
                            amet consectetur adipisicing elit. Quos facere, quidem eum id excepturi assumenda explicabo
                            nam accusamus veritatis voluptates eveniet adipisci, dicta nihil nemo modi possimus officiis
                            quam atque?</p>
                    </div>
                </article>
            </section>

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
                <a href="#" class="footer__icons"><img src="{{ asset('/externo/images/facebook.svg') }}"
                        class="footer__img"></a>
                <a href="#" class="footer__icons"><img src="{{ asset('/externo/images/twitter.svg') }}"
                        class="footer__img"></a>
                <a href="#" class="footer__icons"><img src="{{ asset('/externo/images/youtube.svg') }}"
                        class="footer__img"></a>
            </div>

            <h3 class="footer__copyright">Derechos reservados &copy;</h3>
        </section>
    </footer>
    {{-- <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script> --}}
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js"
        integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+" crossorigin="anonymous">
    </script>
    <script src="{{ asset('/externo/js/slider.js') }}"></script>
    <script src="{{ asset('/externo/js/questions.js') }}"></script>
    <script src="{{ asset('/externo/js/menu.js') }}"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var dropdownToggle = document.querySelector('.dropdown-toggle');
            var dropdownMenu = document.querySelector('.dropdown-menu');

            // Función para mostrar/ocultar el dropdown
            function toggleDropdown(event) {
                var isClickInsideDropdown = dropdownMenu.contains(event.target) || event.target === dropdownToggle;

                if (event.target === dropdownToggle) {
                    // Prevenir comportamiento por defecto y alternar la visibilidad
                    event.preventDefault();
                    dropdownMenu.classList.toggle('show');
                } else if (!isClickInsideDropdown && dropdownMenu.classList.contains('show')) {
                    // Ocultar el dropdown si se hace clic fuera de él
                    dropdownMenu.classList.remove('show');
                }
            }

            // Escuchar el evento de clic en el documento
            document.addEventListener('click', toggleDropdown);
        });
    </script>
</body>

</html>
