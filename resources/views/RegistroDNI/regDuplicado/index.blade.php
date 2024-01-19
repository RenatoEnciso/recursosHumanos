@extends('dashboard')

@section('titulo', 'INICIO')
@section('buscar')
    <div class="collapse" id="search-nav">
        <form class="navbar-left navbar-form nav-search mr-md-3" method="GET" role="search">
            <div class="input-group">
                <div class="input-group-prepend">
                    <button type="submit" class="btn btn-search pr-1">
                        <i class="fa fa-search search-icon"></i>
                    </button>
                </div>
                <input type="text" placeholder="Buscar por DNI" class="form-control" value="{{ $buscarpor }}"
                    name="buscarpor">
            </div>
        </form>
    </div>
@endsection
@section('Notificacion')
    @if (Auth::user()->idRol == 2)
        <li class="nav-item dropdown hidden-caret">
            <a class="nav-link dropdown-toggle" href="#" id="notifDropdown" role="button" data-toggle="dropdown"
                aria-haspopup="true" aria-expanded="false">
                <i class="fa fa-bell"></i>
                <span class="notification">{{ count($solicitudes) }}</span>
            </a>
            <ul class="dropdown-menu notif-box animated fadeIn" aria-labelledby="notifDropdown">
                <li>
                    <div class="dropdown-title">
                        @if (count($solicitudes) == 0)
                            No tienes solicitudes por Registrar
                        @else
                            Tienes {{ count($solicitudes) }} solicitudes por Registrar
                        @endif

                    </div>
                </li>
                <li>
                    <div class="notif-scroll scrollbar-outer">
                        @foreach ($solicitudes as $item)
                            <div class="notif-center">
                                <a href="{{ route('reg-primera.createValido', $item->idSolicitud) }}">
                                    <div class="notif-icon notif-primary"> <i class="fa fa-user-plus"></i> </div>
                                    <div class="notif-content">
                                        <span class="block">
                                            Solicitud pendite para registrar
                                        </span>
                                        <span class="time">{{ $item->solFecha }}</span>
                                    </div>
                                </a>
                            </div>
                        @endforeach

                    </div>
                </li>
                <li>
                    <a class="see-all" href="javascript:void(0);">Ver todas las solicitudes pendientes<i
                            class="fa fa-angle-right"></i> </a>
                </li>
            </ul>
        </li>
    @endif
@endsection
@section('contenido')
    <div class="card">
        <div class="card-header">
            <h3 id="titulo" class="card-title">LISTA DE REGISTROS DE DNIS DUPLICADOS</h3>
        </div>
        <div class="card-body">
            <div id="mensaje">
                @if (session('notifica'))
                    <div class="alert alert-warning alert-dismissible fade show mt-3 emergente" role="alert"
                        style="color: white; background-color: rgb(183, 178, 31)">
                        {{ session('notifica') }}
                    </div>
                @endif
            </div>
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">Codigo</th>
                        <th scope="col">Nombres</th>
                        <th scope="col">Apellidos</th>
                        <th scope="col">Fecha de Registro</th>
                        <th scope="col">Estado</th>
                        <th scope="col">Opciones</th>
                    </tr>
                </thead>
                <tbody>
                    @if (count($registros) <= 0)
                        <tr>
                            <td colspan="3"><b>No hay registros</b></td>
                        </tr>
                    @else
                        @foreach ($registros as $item)
                            <tr>
                                <td>{{ $item->idRegistro }}</td>
                                <td>{{ $item->Persona->Nombres }}</td>
                                <td>{{ $item->Persona->Apellido_Paterno . ' ' . $item->Persona->Apellido_Materno }}</td>
                                <td>{{ $item->regFecha }}</td>
                                <td>
                                    @if ($item->regEstado == 0)
                                        <span class="badge font-size-10 bg-warning"> Pendiente </span>
                                    @elseif ($item->regEstado == 1)
                                        <span class="badge font-size-10 bg-success"> Registrado </span>
                                    @endif
                                </td>
                                <td>
                                    <a href="{{ route('reg-primera.edit', $item->idRegistro) }}"
                                        class="btn btn-primary btn-sm"><i class="fa "></i> Editar</a>
                                    <a href="{{ route('reg-primera.dni', $item->idRegistro) }}"
                                        class="btn btn-primary btn-sm"><i class="fa "></i>Genera Dni</a>
                                </td>
                            </tr>
                        @endforeach
                    @endif
                </tbody>
            </table>
            {{ $registros->links() }}
        </div>

    </div>
@endsection
