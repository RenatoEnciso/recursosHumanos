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
                <input type="text" placeholder="Buscar por Solicitante" class="form-control" value="{{ $buscarpor }}"
                    name="buscarpor">
            </div>
        </form>
    </div>
@endsection
@section('contenido')
    <div class="card">
        <div class="card-header">
            <h3 id="titulo" class="card-title">LISTA DE SOLICITUDES - DNI AZUL POR PRIMERA VEZ</h3>
        </div>
        <div class="card-body">
            <a href="{{ route('sol-primera.create') }}" class="btn btn-primary">
                <i class="fas fa-plus"></i>Nueva Solicitud
            </a>
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
                        <th scope="col">Solicitante</th>
                        <th scope="col">DNI</th>
                        <th scope="col">Fecha Recepcion</th>
                        <th scope="col">Estado</th>
                        <th scope="col">Opciones</th>
                    </tr>
                </thead>
                <tbody>
                    @if (count($solicitudes) <= 0)
                        <tr>
                            <td colspan="3"><b>No hay registros</b></td>
                        </tr>
                    @else
                        @foreach ($solicitudes as $item)
                            <tr>
                                <td>{{ $item->idSolicitud }}</td>
                                <td>{{ $item->nombre_solicitante }}</td>
                                <td>{{ $item->DNI_Titular }}</td>
                                <td>{{ $item->solFecha }}</td>
                                <td>
                                    @if ($item->solEstado == 'Aceptado')
                                        <span class="badge font-size-10 bg-success"> {{ $item->solEstado }} </span>
                                    @elseif ($item->solEstado == 'Pendiente')
                                        <span class="badge font-size-10 bg-warning"> {{ $item->solEstado }} </span>
                                    @elseif ($item->solEstado == 'Rechazado')
                                        <span class="badge font-size-10 bg-danger"> {{ $item->solEstado }} </span>
                                    @else
                                        <span class="badge font-size-10 bg-warning"> {{ $item->solEstado }} </span>
                                    @endif
                                </td>
                                <td>
                                    <a href="{{ route('sol-primera.edit', $item->idSolicitud) }}"
                                        class="btn btn-primary btn-sm"><i class="fa "></i> Editar</a>
                                    <a href="{{ route('sol-primera.dni', $item->idSolicitud) }}"
                                        class="btn btn-primary btn-sm"><i class="fa "></i>Dni</a>

                                </td>
                            </tr>
                        @endforeach
                    @endif
                </tbody>
            </table>
            {{ $solicitudes->links() }}
        </div>

    </div>
@endsection
