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
            <input type="text" placeholder="Buscar por trabajador" class="form-control" value="{{$busqueda}}" name="busqueda" >
        </div>
    </form>

</div>
@endsection

@section('contenido')

        <div class="card">
            <div class="card-header">
                <h3 id="titulo"  class="card-title">PAGOS</h3>
            </div>
            <div class="card-body">
            <a href="{{route('Pago.create')}}" class="btn btn-primary"><i class="fas fa-plus"></i>Nuevo Registro</a>
            <div id="mensaje">
                @if (session('datos'))
                <div class="alert alert-warning alert-dismissible fade show mt-3 emergente" role="alert" style="color: white; background-color: rgb(183, 178, 31) ">
                    {{session('datos')}}
                </div>
                @endif
            </div>
            

                <table class="table" style="text-align: center">
                    <thead>
                    <tr>
                        <th scope="col">Codigo</th>                  
                        <th scope="col">Trabajador</th>
                        <th scope="col">Fecha</th>
                        <th scope="col">periodo</th>
                        <th scope="col">Monto</th>
                        <th scope="col">Opciones</th>
                    </tr>
                    </thead>
                    <tbody>
                    @if (count($Pagos)<=0)
                        <tr>
                        <td colspan="3"><b>No hay registros</b></td>
                        </tr>
                        @else
                    @foreach ($Pagos as $item)
                        <tr>
                        <td>{{$item->idPago}}</td>
                        
                        <td>{{$item->contrato->trabajador->persona->Apellido_Paterno}} {{$item->contrato->trabajador->persona->Apellido_Materno}} {{$item->contrato->trabajador->persona->Nombres}}
                            {{-- , DNI:{{$item->trabajador->DNI}}  --}}
                        </td>
                        <td>{{$item->fechaRegistro}}</td>
                        <td>{{$item->periodo}}</td>
                        <td>{{$item->ingresos - $item->descuentos - $item->aportes}}</td>
                        
                        </tr>
                      
                        
                    @endforeach
                    @endif
                    </tbody>
                </table>
                {{$Pagos->links()}}
            </div>
            <!-- /.card-body -->
            <!-- /.card-footer-->
        </div>


@endsection
