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
                <h3  id="titulo" class="card-title">LISTADO DE ACTAS DE MATRIMONIO</h3>
            </div>
            <div class="card-body">

                <a href="{{route('ActaMatrimonio.create')}}" class="btn btn-primary"><i class="fas fa-plus"></i>Nuevo Registro</a>


                <div id="mensaje">
                    @if (session('datos'))
                        <div class="alert alert-dismissible fade show mt-3 emergente" role="alert" style="color: white; background-color: rgb(183, 178, 31)" >
                            {{session('datos')}}
                        </div>
                    @endif
                </div>

                <table class="table" style="text-align: center">
                    <thead>
                        <tr>
                            <th scope="col">Codigo Acta</th>
                            <th scope="col">Esposa</th>
                            <th scope="col">Esposo</th>
                            <th scope="col">Fecha Matrimonio</th>
                            <th scope="col">Lugar de Matrimonio</th>
                            <th scope="col">Opciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if (count($ActaMatrimonio)<=0)
                            <tr>
                                <td colspan="3"><b>No hay registros</b></td>
                            </tr>
                        @else
                            @foreach ($ActaMatrimonio as $item1)
                                @if ($item1->Persona->sexo=='F')
                                    <tr>
                                        <td>{{$item1->Acta->idActa}}</td>
                                        <td>{{$item1->Persona->Nombres." ".$item1->Persona->Apellido_Paterno }}</td>
                                        @foreach ($ActaMatrimonio as $item2)
                                            @if (($item1->Acta->idActa)==($item2->Acta->idActa) && ($item1->Persona->DNI)!=($item2->Persona->DNI))
                                                <td>{{$item2->Persona->Nombres." ".$item2->Persona->Apellido_Paterno }}</td>
                                            @endif
                                        @endforeach
                                        <td>{{$item1->Acta->fecha_Acta}}</td>
                                        <td>{{$item1->Acta->lugar_Acta}}</td>
                                        <td>
                                            <a href="{{ route('ActaMatrimonio.archivo',$item1->idActaPersona)}}" class="btn btn-primary btn-sm"><i class="fa fa-eye"></i>Ver</a>
                                            <a href="{{ route('ActaMatrimonio.edit',$item1->idActaPersona) }}" class="btn btn-info btn-sm"><i class="fas fa-edit"></i>Editar</a>
                                            <a href="{{ route('ActaMatrimonio.confirmar',$item1->idActaPersona) }}" class="btn btn-danger btn-sm"><i class="fas fa-trash"></i>Eliminar</a>
                                        </td>
                                    </tr>
                                @endif
                            @endforeach
                        @endif
                    </tbody>
                </table>
                {{$ActaMatrimonio->links()}}
            </div>
            <!-- /.card-body -->
            <div class="card-footer">
            Footer
            </div>
            <!-- /.card-footer-->
        </div>


</div>

@endsection
