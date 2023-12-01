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
            <h3 id="titulo" class="card-title" style="text-align: center">DETALLE DE ACTAS SOLICITADAS</h3>
            <h3 style="color: aqua" class="card-title">SOLICITANTE: {{$Solicitud->Persona->Nombres." ".
                $Solicitud->Persona->Apellido_Paterno ." ". $Solicitud->Persona->Apellido_Materno}}</h3>
        </div>
        <div class="card-body">
        
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
                    <th scope="col">Nro</th>
                    <th scope="col">Tipo de Acta</th>
                    <th scope="col">Pertenece a</th>
                    <th scope="col">Fecha Registro</th>
                    <th scope="col">Lugar</th>
                    <th scope="col">Observacion</th>
                    <th scope="col">Documento </th>
                </tr>
                </thead>
                <tbody>
                    @if (count($LSolicitud)<=0)
                        <tr>
                            <td colspan="3"><b>No hay registros</b></td>
                        </tr>
                    @else
                        @foreach ($LSolicitud as $item)    
                            @if ($item->Acta->TipoActa->idTipoActa=='2')
                                @foreach ($item->Acta->Acta_Persona as $item1)
                                    <tr>
                                        @if ($item1->idActaPersona%2==0)
                                            <td>{{$itera=$itera+1}}</td>
                                            <td>{{$item->Acta->TipoActa->nombre}}</td>
                                            {{-- <td>{{$item->Nombres}}</td> --}}
                                            @foreach ($item->Acta->Acta_Persona as $item2)
                                                @if (($item1->Persona->DNI)!=($item2->Persona->DNI))
                                                    <td>{{$item1->Persona->Nombres." y ".$item2->Persona->Nombres }}</td> 
                                                @endif
                                            @endforeach
                                            <td>{{$item->Acta->fecha_registro}}</td>
                                            <td>{{$item->Acta->lugar_Acta}}</td>
                                            <td>{{$item->Acta->observacion}}</td>
                                            <td>
                                                <a href="{{ route('Solicitud.archivo',$item->idActa)}}" class="btn btn-primary btn-sm"><i class="fa fa-eye"></i> Ver Acta </a>
                                            </td>
                                        @endif 
                                    </tr>
                                @endforeach
                            
                            @else
                            <tr>
                                <td>{{$itera=$itera+1}}</td>
                                <td>{{$item->Acta->TipoActa->nombre}}</td>
                                @foreach ($item->Acta->Acta_Persona as $personita)
                                <td>{{$personita->Persona->Nombres}}</td>
                                @endforeach
                                <td>{{$item->Acta->fecha_registro}}</td>
                                <td>{{$item->Acta->lugar_Acta}}</td>
                                <td>{{$item->Acta->observacion}}</td>
                                <td>
                                    <a href="{{ route('Solicitud.archivo',$item->idActa)}}" class="btn btn-primary btn-sm"><i class="fa fa-eye"></i> Ver Acta </a>
                                </td>
                            </tr>
                            @endif  
                        @endforeach 
                    @endif
                                       

                </tbody>
            </table>
                 <button>
                <a href="{{route('Solicitud.index')}}" class="btn btn-warning"><i class="fa fa-undo"></i>Regresar</a>
                </button> 
            {{$LSolicitud->links()}}
        </div>
    </div>
@endsection