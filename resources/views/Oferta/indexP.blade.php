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
            <input type="text" placeholder="Buscar por descripcion" class="form-control" value="{{$busqueda}}" name="busqueda" >
        </div>
    </form>

</div>
@endsection

@section('contenido')
<!-- Button trigger modal -->

        <div class="card">
            <div class="card-header">
                <h3 id="titulo"  class="card-title">OFERTAS</h3>
            </div>
            
        

            <div id="mensaje">
                @if (session('datos'))
                <div class="alert alert-warning alert-dismissible fade show mt-3 emergente" role="alert" style="color: white; background-color: rgb(183, 178, 31) ">
                    {{session('datos')}}
                </div>
                @endif
            </div>
            <div class="row justify-content-center">
            @if (count($Ofertas)<=0)
                        <tr>
                        <td colspan="3"><b>No hay registros</b></td>
                        </tr>
            @else

                @foreach ($Ofertas as $item)
                
                <div class="card my-4" style="width: 30vw;" >
                    <div class="card-body">
                      <h5 class="card-title">{{$item->idOferta}}-{{$item->cargo->descripcion}}</h5>
                      <br>
                      <h6 class="card-subtitle mb-2 text-body-secondary">{{$item->descripcion}}</h6>
             
                      <p class="card-text">Vacantes:{{$item->numerovacantes}}</p>
                      <p class="card-text">Fecha limite:{{$item->fecha_fin}}</p>
                      <a href="{{route('Postulacion.createP',$item->idOferta)}}" class="btn btn-primary"><i class="fas fa-plus"></i> Postular</a>
       
                    </div>
                </div>
          
                @endforeach
            @endif  
            </div>
                
                {{$Ofertas->links()}}
            </div>
            <!-- /.card-body -->
            <!-- /.card-footer-->
        </div>

@endsection
