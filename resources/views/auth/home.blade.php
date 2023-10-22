<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro civil</title>
    <link rel="shortcut icon" href="{{URL::asset('images/logo.png')}}">
    <script src="{{asset('assets/js/plugin/webfont/webfont.min.js')}}"></script>
    <script>
        WebFont.load({
            google: {"families":["Lato:300,400,700,900"]},
            custom: {"families":["Flaticon", "Font Awesome 5 Solid", "Font Awesome 5 Regular", "Font Awesome 5 Brands", "simple-line-icons"],
            urls: [' /assets/css/fonts.min.css']},
            active: function() {sessionStorage.fonts = true;}
        });
    </script>
    <script languague='javascript'>
        function openOverlay() {
            div = document.getElementById('overlay');
            div.style.display = 'block';
        }

        function closeOverlay() {
            div = document.getElementById('overlay');
            div.style.display = 'none';
        }

        function openLogIn() {
            closeSignIn();
            openOverlay();
            div = document.getElementById('login');
            div.style.display = 'block';
        }

        function closeLogIn() {
            closeOverlay();
            div = document.getElementById('login');
            div.style.display = 'none';
        }

        function openSignIn() {
            closeLogIn();
            openOverlay();
            div = document.getElementById('signin');
            div.style.display = 'block';
        }

        function closeSignIn() {
            closeOverlay();
            div = document.getElementById('signin');
            div.style.display = 'none';
        }
    </script>
</head>
<body>
    <div class="container">
        <nav>
            <div class="navContent">
                <abbr title='Acceder'>
                    <a href="javascript:openLogIn();">
                        <i class='fas fa-user-circle'></i>
                    </a>
                </abbr>
            </div>
        </nav>
        <main>
            <h1>Registro civil</h1>
            <section>
                <p>Conjunto de procesos y herramientas que permiten registrar y certificar los hechos vitales de las personas, como el nacimiento, el matrimonio y la defunción.</p> <br>
                <p style='text-align: center'><img src="{{URL::asset('images/logo.png')}}"></p>
            </section>
            <article>
                <h2>Citas</h2>
                <section>
                    <p><i class='fas fa-calendar-check'></i></p> <br>
                    <p>Permite a los usuarios solicitar y gestionar sus citas para realizar trámites relacionados con el registro civil, como la expedición o renovación del DNI, la inscripción de un nacimiento, matrimonio o defunción, o la solicitud de una partida o certificado.</p>
                </section>
            </article>
            <article>
                <h2>Consultas</h2>
                <section>
                    <p><i class='fas fa-comment-dots'></i></p> <br>
                    <p>Permite a los usuarios consultar el estado de sus trámites, el historial de sus actos registrales, o acceder a información estadística sobre el registro civil.</p>
                </section>       
            </article>
            <article>
                <h2>Gestión de DNI</h2>
                <section>
                    <p><i class='fas fa-id-card'></i></p> <br>
                    <p>Permite a los funcionarios del registro civil emitir, renovar, anular o modificar los documentos nacionales de identidad de los ciudadanos, así como verificar su autenticidad y vigencia.</p>
                </section>
            </article>
            <article>
                <h2>Recursos humanos</h2>
                <section>
                    <p><i class='fas fa-users'></i></p> <br>
                    <p>Permite a los administradores del registro civil gestionar el personal, las nóminas, las vacaciones, las licencias, las evaluaciones y las capacitaciones de los funcionarios que trabajan en el registro civil.</p>
                </section>
            </article>
            <article>
                <h2>Gestión de actas</h2>
                <section>
                    <p><i class='fas fa-file-alt'></i></p> <br>
                    <p>Permite a los funcionarios del registro civil inscribir, modificar, anular o expedir las partidas o certificados de nacimiento, matrimonio y defunción de las personas, así como validar su legalidad y conformidad con la normativa vigente.</p>
                </section>
            </article>
            <footer>
                <br> <p>Promoción XXV de Ingeniería de Sistemas</p>
            </footer>
            
        </main>
        <div class='overlay' id='overlay'></div>
        <div class='card' id='login'>
            <div style='display: flex; flex-direction: row; justify-content: space-between; align-items: center'>
                <h2>Iniciar sesión</h2>
                <a href="javascript:closeLogIn();">Cancelar</a>
            </div>
            <div style='text-align: center'>
                <i style='font-size: 34px; color: var(--colorAux)' class='fas fa-user-circle'></i> <br> <br>
                <span>Para usar el sistema de registro civil de RENIEC, inicie sesión.</span>
            </div>
            <form action="{{ route('login') }}" method="POST">
                @csrf
                <div style='display: flex; flex-direction: row; justify-content: space-between; align-items: center; max-width: 320px; gap: 20px'>
                    <label style='color: var(--labelSecondary)' for='email'>CORREO</label>
                    <input type='email' name='email' id='email' placeholder='Ingresar correo electrónico' required />
                </div>
                <div style='display: flex; flex-direction: row; justify-content: space-between; align-items: center; max-width: 320px; gap: 20px'>
                    <label style='color: var(--labelSecondary)' for='email'>CLAVE</label>
                    <input type='password' name='password' id='password' placeholder='Ingresar clave' required />
                </div>
                <div style='text-align: center'>
                    <input style='height: 50px; padding: 0 20px; background: var(--colorBlue); color: white; border: 0; border-radius: 12px; font-size: 17px' type='submit' value='Continuar'>
                </div>
                <div style='text-align: center'>
                    <a href="javascript:openSignIn();">Registrar nuevo usuario</a>
                </div>
            </form>
        </div>
        <div class='card' id='signin'>
            <div style='display: flex; flex-direction: row; justify-content: space-between; align-items: center'>
                <h2>Registrar</h2>
                <a href="javascript:closeSignIn();">Cancelar</a>
            </div>
            <div style='text-align: center'>
                <i style='font-size: 34px; color: var(--colorAux)' class='fas fa-user-plus'></i> <br> <br>
                <span>Crea una cuenta para usar el sistema de registro civil de RENIEC.</span>
            </div>
            <form action="{{ route('register') }}" method="POST">
                @csrf
                <div style='display: flex; flex-direction: row; justify-content: space-between; align-items: center; max-width: 320px; gap: 20px'>
                    <label style='color: var(--labelSecondary)' for='name'>NOMBRE</label>
                    <input type='text' name='name' id='name' placeholder='Ingresar nombres completos' required />
                </div>
                <div style='display: flex; flex-direction: row; justify-content: space-between; align-items: center; max-width: 320px; gap: 20px'>
                    <label style='color: var(--labelSecondary)' for='email'>CORREO</label>
                    <input type='email' name='email' id='email' placeholder='Ingresar correo electrónico' required />
                </div>
                <div style='display: flex; flex-direction: row; justify-content: space-between; align-items: center; max-width: 320px; gap: 20px'>
                    <label style='color: var(--labelSecondary)' for='idRol'>ROL</label>
                    <select name="idRol">
                        <option disabled selected>Rol</option>
                        <option value="1">Mesa de partes</option>
                        <option value="2">Registrador</option>
                        <option value="3">Administrador</option>
                        <option value="4">Administrador del sistema</option>
                    </select>
                </div>
                <div style='display: flex; flex-direction: row; justify-content: space-between; align-items: center; max-width: 320px; gap: 20px'>
                    <label style='color: var(--labelSecondary)' for='email'>CLAVE</label>
                    <input type='password' name='password' id='password' placeholder='Ingresar clave' required />
                </div>
                <div style='display: flex; flex-direction: row; justify-content: space-between; align-items: center; max-width: 320px; gap: 20px'>
                    <label style='color: var(--labelSecondary)' for='password_confirmation'>CONFIRMAR CLAVE</label>
                    <input type='password' name='password_confirmation' id='password_confirmation' placeholder='Ingresar clave nuevamente' required />
                </div>
                <div style='text-align: center'>
                    <input style='height: 50px; padding: 0 20px; background: var(--colorBlue); color: white; border: 0; border-radius: 12px; font-size: 17px' type='submit' value='Continuar'>
                </div>
                <div style='text-align: center'>
                    <a href="javascript:openLogIn();">Iniciar sesión</a>
                </div>
            </form>
        </div>
    </div>
</body>
<style type="text/css">
    :root {
        --colorAux: #a23b35;
        --colorBlue: #007AFF;
        --labelPrimary: #000000;
        --labelSecondary: rgba(60,60,67,.6);
        --labelTertiary: rgba(60,60,67,.3);
        --labelQuaternary: rgba(60,60,67,.18);
        --bgPrimary: rgba(253,251,255, .8);
        --bgSecondary: rgba(253,251,255, .72);
        --bgTertiary: rgba(253,251,255, .6);
        --bgQuaternary: rgba(253,251,255, .45)
    }
    @media (prefers-color-scheme: dark) {
        :root {
            --colorAux: #a86c64;
            --colorBlue: #0A84FF;
            --labelPrimary: #FFFFFF;
            --labelSecondary: rgba(235,235,245,.6);
            --labelTertiary: rgba(235,235,245,.3);
            --labelQuaternary: rgba(235,235,245,.16);
            --bgPrimary: rgba(37, 37, 37, .55);
            --bgSecondary: rgba(37, 37, 37, .7);
            --bgTertiary: rgba(37, 37, 37, .82);
            --bgQuaternary: rgba(37, 37, 37, .9)
        }
    }
    html {
        background: var(--bgPrimary)
    }
    body {
        font-family: system-ui, 'Segoe UI', Roboto, Helvetica, Arial, sans-serif, 'Apple Color Emoji', 'Segoe UI Emoji', 'Segoe UI Symbol';
        color: var(--labelPrimary);
        background: linear-gradient(217deg, rgba(162, 59, 53, .84), rgba(255, 0, 0, 0) 70.71%), linear-gradient(127deg, rgba(7, 100, 126, .84), rgba(0, 255, 0, 0) 70.71%), linear-gradient(336deg, rgba(167, 173, 175, .84), rgba(0, 0, 255, 0) 70.71%);
        background: linear-gradient(217deg, rgba(162, 59, 53, .84), rgba(255, 0, 0, 0) 70.71%), linear-gradient(127deg, rgba(7, 100, 126, .84), rgba(0, 255, 0, 0) 70.71%), linear-gradient(336deg, rgba(167, 173, 175, .84), rgba(0, 0, 255, 0) 70.71%);
        margin: 0;
        padding: 0
    }
    .container {
        width: 100%;
        height: 100%;
        background: var(--bgPrimary)
    }
    nav {
        font-size: 22px;
        padding: 20px;
        background: var(--bgSecondary);
        backdrop-filter: blur(25px);
        position: sticky;
        top: 0
    }
    .navContent {
        text-align: right;
        max-width: 640px;
        margin: 0px auto
    }
    main {
        max-width: 640px;
        margin: 0 auto;
        padding: 20px
    }
    section {
        border-radius: 20px;
        padding: 20px;
    }
    main section {
        background: var(--bgTertiary)
    }
    article section {
        background: var(--bgQuaternary)
    }
    section i {
        font-size: 22px;
        color: var(--colorAux)
    }
    footer {
        color: var(--labelSecondary)
    }
    h1 {
        font-size: 34px
    }
    h2 {
        font-size: 20px;
        font-weight: normal
    }
    p {
        margin: 0
    }
    a {
        text-decoration: none;
        color: var(--labelPrimary)
    }
    .card {
        display: none;
        background: var(--bgSecondary);
        backdrop-filter: blur(25px);
        position: fixed;
        width: 100%;
        bottom: 0
    }
    .card div {
        max-width: 640px;
        margin: 20px auto;
        padding-left: 20px;
        padding-right: 20px
    }
    .card h2 {
        margin: 0;
    }
    .card a {
        text-decoration: none;
        color: var(--colorBlue)
    }
    input {
        background: transparent;
        border: 0;
        outline: none;
        color: var(--labelPrimary);
        font-size: 17px;
        max-width: 240px;
        caret-color: var(--colorBlue)
    }
    input::placeholder {
        color: var(--labelTertiary);
    }
    select {
        background: transparent;
        border: 0;
        outline: none;
        color: var(--labelPrimary);
        font-size: 17px;
        max-width: 212px
    }
    .overlay {
        display: none;
        background: var(--bgTertiary);
        position: fixed;
        height: 100%;
        width: 100%;
        top: 0
    }
</style>
</html>