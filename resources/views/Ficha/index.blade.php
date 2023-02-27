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
            <input type="text" placeholder="Buscar por Tipo Ficha" class="form-control" value="{{$buscarpor}}" name="buscarpor" >
        </div>
    </form>

</div>
@endsection


@section('contenido')
        <div class="card">
            <div class="card-header">
                <h3 id="titulo" class="card-title">LISTADO DE FICHAS REGISTRADAS</h3>
            </div>
            <div class="card-body">
            <a href="{{route('Ficha.create')}}" class="btn btn-primary"><i class="fas fa-plus"></i>Nuevo FICHA</a>
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
                        <th scope="col">Fecha de Registro</th>
                        {{-- <th scope="col">Certificado</th> --}}
                        <th scope="col">Estado</th>
                        <th scope="col">Tipo de Ficha</th>
                        <th scope="col">Opciones</th>
                    </tr>
                    </thead>
                    <tbody>
                    @if (count($fichas)<=0)
                        <tr>
                            <td colspan="3"><b>No hay registros</b></td>
                        </tr>
                    @else
                        @foreach ($fichas as $item)
                            <tr>
                                <td>{{$item->idficha}}</td>
                                <td>{{$item->fecha_registro}}</td>
                               {{-- // <td>{{$item->tipo->nombre}}</td> --}}
                                <td>{{$item->estado}}</td>
                                <td>{{$item->nombre}}</td>
                                <td>
                                    <a href="{{ route('Ficha.edit',$item->idficha) }}" class="btn btn-info btn-sm"><i class="fas fa-edit"></i>Editar</a>
                                    <a  href="{{ route('Ficha.confirmar',$item->idficha) }}" class="btn btn-danger btn-sm"><i class="fas fa-trash"></i>Eliminar</a>
                                    {{-- <a href="{{ route('Ficha.crearActa',$item->idficha) }}" class="btn btn-info btn-sm"><i class="fas fa-edit"></i>Revisar</a> --}}
                                </td>
                            </tr>
                        @endforeach
                    @endif
                    </tbody>
                </table>
                {{$fichas->links()}}
            </div>

        </div>

</div>

@endsection


