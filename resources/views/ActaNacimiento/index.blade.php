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
            <input type="text" placeholder="Buscar por apellido" class="form-control" value="{{$buscarpor}}" name="buscarpor" >
        </div>
    </form>

</div>
@endsection
@section('contenido')

        <div class="card">
            <div class="card-header">
                <h3 id="titulo" class="card-title">LISTADO DE ACTAS DE NACIMIENTO</h3>
            </div>
            <div class="card-body">
            <a href="{{route('ActaNacimiento.create')}}" class="btn btn-primary"><i class="fas fa-plus"></i>Nuevo Registro</a>
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
                        <th scope="col">Apellidos y Nombres</th>
                        <th scope="col">Fecha_Nacimiento</th>
                        <th scope="col">Lugar de Nacimiento</th>
                        <th scope="col">DNI</th>
                        <th scope="col">Opciones</th>
                    </tr>
                    </thead>
                    <tbody>
                    @if (count($ActaNacimiento)<=0)
                        <tr>
                        <td colspan="3"><b>No hay registros</b></td>
                        </tr>
                        @else

                    @foreach ($ActaNacimiento as $item)
                        <tr>
                        <td>{{$item->idActa}}</td>
                        <td>{{$item->Apellido_Paterno . " " . $item->Apellido_Materno." ".$item->Nombres}}</td>
                        <td>{{$item->fecha_Acta}}</td>
                        <td>{{$item->lugar_Acta}}</td>
                        <td>{{$item->DNI}}</td>
                        <td>
                            <br>
                            <a href="{{ route('ActaNacimiento.archivo',$item->idActaPersona)}}" class="btn btn-primary btn-sm"><i class="fa fa-eye"></i>Ver</a>
                            <a href="{{ route('ActaNacimiento.generada',$item->idActaPersona)}}" class="btn btn-primary btn-sm"><i class="fa fa-eye"></i>Generar</a>
                            <a href="{{ route('ActaNacimiento.edit',$item->idActaPersona) }}" class="btn btn-info btn-sm"><i class="fas fa-edit"></i>Editar</a>
                            <a  href="{{ route('ActaNacimiento.confirmar',$item->idActaPersona) }}" class="btn btn-danger btn-sm"><i class="fas fa-trash"></i>Eliminar</a>
                        </td>
                        </tr>
                    @endforeach
                    @endif
                    </tbody>
                </table>
                {{$ActaNacimiento->links()}}
            </div>

        </div>

</div>

@endsection
