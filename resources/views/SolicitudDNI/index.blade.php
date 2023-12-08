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
                    <h3 id="titulo" class="card-title">DNI AZUL POR PRIMERA VEZ</h3>
                </div>
                <div class="card-body">
                <a href="{{route('solicitud-dni.create')}}" class="btn btn-primary"><i class="fas fa-plus"></i>Nuevo Registro</a>

                <div id="mensaje">
                    @if (session('notifica'))
                    <div class="alert alert-warning alert-dismissible fade show mt-3 emergente" role="alert" style="color: white; background-color: rgb(183, 178, 31)" >
                        {{session('notifica')}}
                    </div>
                    @endif
                </div>
                    <table class="table">
                        <thead>
                        <tr>
                            <th scope="col">Codigo</th>
                            <th scope="col">Nombres</th>
                            <th scope="col">Apellidos</th>
                            <th scope="col">Fecha</th>
                            <th scope="col">Estado</th>
                            <th scope="col">Opciones</th>
                        </tr>
                        </thead>
                        <tbody>
                         @if (count($solicitudes)<=0)
                            <tr>
                            <td colspan="3"><b>No hay registros</b></td>
                            </tr>
                        @else

                            @foreach ($solicitudes as $item)
                                <tr>
                                    <td>{{$item->idSolicitud}}</td>
                                    <td>{{$item->Persona->Nombres}}</td>
                                    <td>{{$item->Persona->Apellido_Paterno." ".$item->Persona->Apellido_Materno}}</td>
                                    <td>{{$item->solFecha}}</td>
                                    <td>
                                        <span class="badge bg-success font-size-10">{{$item->solEstado}}</span>
                                    </td>
                                    <td>
                                            <a href="{{ route('solicitud-dni.edit',$item->idSolicitud)}}" class="btn btn-primary btn-sm"><i class="fa "></i> Editar</a>
                                            <a href="{{ route('solicitud-dni.review',$item->idSolicitud)}}" class="btn btn-primary btn-sm"><i class="fa "></i>Revisar</a>
                                            <a href="{{ route('solicitud-dni.dni',$item->idSolicitud)}}" class="btn btn-primary btn-sm"><i class="fa "></i>Dni</a>
                                      
                                            {{-- @if ($item->pago==0)
                                        @else
                                        <a href="{{ route('Solicitud.detalle',$item->idSolicitud)}}" class="btn btn-primary btn-sm"><i class="fa fa-eye"></i> Detalle </a>
                                        <a href="{{ route('Solicitud.comprobanteGenerado',$item->idSolicitud)}}" class="btn btn-primary btn-sm"><i class="fa "></i> Generar Comprobante de Pago</a>
                                        @endif 
                                        <a href="{{ route('Solicitud-dni.edit',$item->idSolicitud) }}" class="btn btn-info btn-sm"><i class="fas fa-edit"></i>Editar</a>
                                        <a href="{{ route('Solicitud-dni.confirmar',$item->idSolicitud) }}" class="btn btn-danger btn-sm"><i class="fas fa-trash"></i>Eliminar</a> --}}
                                    </td> 
                                </tr>
                            @endforeach
                        @endif
                        </tbody>
                    </table>
                     {{$solicitudes->links()}}
                </div>
            
            </div>
@endsection
