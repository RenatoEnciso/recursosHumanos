@extends('dashboard')

@section('titulo','INICIO')
@section('buscar')
<div class="collapse" id="search-nav">
    <form class="navbar-left navbar-form nav-search mr-md-3" method="GET" role="search">
        <div class="input-group">
            <div class="input-group-prepend">
                <button type="submit" class="btn btn-search pr-1">
                    <i class="fa fa-search search-icon"></i>
                </button>
            </div>
            <input type="text" placeholder="Buscar por DNI" class="form-control" value="{{$buscarpor}}" name="buscarpor" >
        </div>
    </form>

</div>
@endsection
@section('contenido')

            <div class="card">
                <div class="card-header">
                    <h3 id="titulo" class="card-title">LISTADO DE SOLICITUDES</h3>
                </div>
                <div class="card-body">
                <a href="{{route('Solicitud.create')}}" class="btn btn-primary"><i class="fas fa-plus"></i>Nuevo Registro</a>

                <div id="mensaje">
                    @if (session('datos'))
                    <div class="alert alert-warning alert-dismissible fade show mt-3 emergente" role="alert" style="color: white; background-color: rgb(183, 178, 31)" >
                        {{session('datos')}}
                    </div>
                    @endif
                </div>
                    <table class="table">
                        <thead>
                        <tr>
                            <th scope="col">Codigo</th>
                            <th scope="col">Fecha de solicitud</th>
                            <th scope="col">Observacion</th>
                            <th scope="col">DNI Solicitante</th>
                            <th scope="col">Solicitante</th>
                            <th scope="col">Opciones</th>
                        </tr>
                        </thead>
                        <tbody>
                        @if (count($Solicitud)<=0)
                            <tr>
                            <td colspan="3"><b>No hay registros</b></td>
                            </tr>
                        @else

                            @foreach ($Solicitud as $item)
                                <tr>
                                    <td>{{$item->idSolicitud}}</td>
                                    <td>{{$item->fechaSolicitud}}</td>
                                    <td>{{$item->observacion}}</td>
                                    <td>{{$item->DNISolicitante}}</td>
                                    <td>{{$item->Apellido_Paterno . " " . $item->Apellido_Materno." ".$item->Nombres}}</td>
                                    <td>
                                        <br>
                                        @if ($item->pago==0)
                                            <a href="{{ route('Solicitud.archivoGenerado',$item->idSolicitud)}}" class="btn btn-primary btn-sm"><i class="fa "></i> Generar Orden</a>
                                            <a href="{{ route('Solicitud.ingresarPago',$item->idSolicitud)}}" class="btn btn-primary btn-sm"><i class="fa "></i> Ingresar Pago</a>
                                        @else
                                        <a href="{{ route('Solicitud.detalle',$item->idSolicitud)}}" class="btn btn-primary btn-sm"><i class="fa fa-eye"></i> Detalle </a>
                                        <a href="{{ route('Solicitud.comprobanteGenerado',$item->idSolicitud)}}" class="btn btn-primary btn-sm"><i class="fa "></i> Generar Comprobante de Pago</a>
                                        @endif
                                        <a href="{{ route('Solicitud.edit',$item->idSolicitud) }}" class="btn btn-info btn-sm"><i class="fas fa-edit"></i>Editar</a>
                                        <a href="{{ route('Solicitud.confirmar',$item->idSolicitud) }}" class="btn btn-danger btn-sm"><i class="fas fa-trash"></i>Eliminar</a>
                                    </td>
                                </tr>
                            @endforeach
                        @endif
                        </tbody>
                    </table>
                    {{$Solicitud->links()}}
                </div>
            </div>


@endsection
