<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>RENIEC</title>
    <meta content='width=device-width, initial-scale=1.0, shrink-to-fit=no' name='viewport' />
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">

</head>
<body >
    <!-- Encabezado -->
    <nav class="navbar  navbar-expand-lg navbar-light bg-primary">
        <a class="navbar-brand" href="{{route('solicitudDNI.inicio')}}">
            <img src="{{asset("images/Logo-Login.png")}}" alt="logo" class="navbar-brand" style="width:145px; padding-left: 10px" >
        </a>
        <div class="text-white text-center">
            <h4><b>DNI POR PRIMERA VEZ </b></h4>
        </div>

        {{-- <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item active">
                    <a class="nav-link" href="#">Inicio</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Acerca de</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Contacto</a>
                </li>
            </ul>
        </div> --}}
    </nav>

    <main class="container"  style="background-color: #f0f0f0;">
        <!-- Contenido principal -->
        <h1> Estimado Usuario,</h1>
        <p>Para realizar tu servicio en línea, primero debes autenticarte, selecciona el tipo de autenticación.</p>
        <form action="{{route('solicitudDNI.validar')}}"  method="POST">
           @csrf
            <div class="form-row">
                <h3><b>Datos Personales</b></h3>
            </div>
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="idDni" >Numero de DNI</label>
                    <input type="text" class="form-control" id="idDni" name="dni">
                    @error('dni')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group col-md-6">
                    <label for="idFechaNacimiento">Fecha de Nacimiento</label>
                    <input type="date" class="form-control" id="idFechaNacimiento" name="fechaNacimiento">
                    @error('fechaNacimiento')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <div class="form-row">
                <h3><b>Lugar de Nacimiento</b></h3>
            </div>
            <div class="form-row">
                <div class="form-group col-md-4">
                    <label for="idDepa">Departamento</label>
                    <input type="text" class="form-control" id="idDepa" name="departamento">
                    @error('departamento')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group col-md-4">
                    <label for="idProv">Provincia</label>
                    <input type="text" class="form-control" id="idProv" name="provincia">
                    @error('provincia')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group col-md-4">
                    <label for="idDis">Distrito</label>
                    <input type="text" class="form-control" id="idDis" name="distrito">
                    @error('distrito')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            {{-- <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="inputCity">City</label>
                    <input type="text" class="form-control" id="inputCity">
                </div>
                <div class="form-group col-md-4">
                    <label for="inputState">State</label>
                    <select id="inputState" class="form-control">
                    <option selected>Choose...</option>
                    <option>...</option>
                    </select>
                </div>
                <div class="form-group col-md-2">
                    <label for="inputZip">Zip</label>
                    <input type="text" class="form-control" id="inputZip">
                </div>
            </div>
            <div class="form-group">
            <div class="form-check">
                <input class="form-check-input" type="checkbox" id="gridCheck">
                <label class="form-check-label" for="gridCheck">
                Check me out
                </label>
            </div>
            </div> --}}
            <div class="d-flex flex-row justify-content-around">
                <button type="submit" class="btn btn-primary">Validar</button>
                <button type="submit" class="btn btn-warning">Atras</button>
            </div>
            <div >
                @if (session('respuesta'))
                <div class="alert alert-warning alert-dismissible fade show mt-3 emergente" role="alert" style="color: white; background-color: rgb(183, 178, 31)" >
                    {{session('respuesta')}}
                </div>
                @endif
            </div>
        </form>
    </main>

    <footer class="text-center py-4 bg-secondary fixed-bottom">
       <div class="text-white">
        <p>Ingeniería de Software II © 2023 - Geronimo Dionicio Percy</p>
       </div>
    </footer>

    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
</body>
</html>