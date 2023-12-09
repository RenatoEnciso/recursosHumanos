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

        <div class="card">
            <div class="card-header">
                <h3 id="titulo"  class="card-title">ENTREVISTAS</h3>
            </div>
            <div class="card-body">
            {{-- <a href="{{route('Entrevista.create')}}" class="btn btn-primary"><i class="fas fa-plus"></i>Nuevo Registro</a> --}}
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
                        <th scope="col">Postulación</th>
                        <th scope="col">DNI</th>
                        <th scope="col">Nombre</th>
                        <th scope="col">Fecha</th>
                        <th scope="col">Observacion</th>
                        <th scope="col">Estado</th>
                        <th scope="col">Opciones</th>
                    </tr>
                    </thead>
                    <tbody>
                    @if (count($Entrevistas)<=0)
                        <tr>
                        <td colspan="3"><b>No hay registros</b></td>
                        </tr>
                        @else

                    @foreach ($Entrevistas as $item)
    
                        <tr>
                        
                        <td>{{$item->idEntrevista}}</td>
                        <td>{{$item->Postulacion->oferta->descripcion}}</td>
                        {{-- <td>{{$item->idPostulacion}}</td> --}}
                        <td>{{$item->Postulacion->DNI}}</td>
                        <td>{{$item->Postulacion->persona->Apellido_Paterno}} {{$item->Postulacion->persona->Apellido_Materno}} {{$item->Postulacion->persona->Nombres}}</td>
                        
                        <td>{{$item->fecha}}</td>
                        <td>{{$item->observacion}}</td>
                        <td>
                            
                            @if ($item->estadoEntrevista==1)
                           
                            <i class="fa-solid fa-check"></i> 
                             {{-- Aprobado --}}
                        @else
                    
                             <i class="fa-solid fa-xmark"></i> 
                             {{-- Rechazado --}}
                        @endif
                        
                            </td>
                        <td>
                            
                            {{-- <a href="{{ route('ActaDefunsion.archivo',$item->idActaPersona)}}" class="btn btn-primary btn-sm"><i class="fa fa-eye"></i>Ver</a> --}}
                           
                            <a href="{{ route('Entrevista.edit',$item->idEntrevista) }}" class="btn btn-info btn-sm"><i class="fas fa-edit"></i>Editar</a>
                            <a href="{{ route('Contrato.createP',$item->idEntrevista) }}" class="btn btn-info btn-sm"><i class="fa-solid fa-file-signature"></i>Contratar</a>
                            {{-- <a href="{{ route('Entrevista.confirmar',$item->idEntrevista) }}" class="btn btn-danger btn-sm"><i class="fas fa-trash"></i>Eliminar</a> --}}
                            
                            <button   class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#staticBackdrop{{$item->idEntrevista}}">
                                <i class="fas fa-trash"></i>Eliminar
                              </button>
                      
                            
                            
                              <!-- Modal -->
                              <div class="modal fade " id="staticBackdrop{{$item->idEntrevista}}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered">
                                  <div class="modal-content">
                                    <div class="modal-header">
                                      <h1 class="modal-title fs-5" id="staticBackdropLabel">Eliminar Postulación</h1>
                                      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <span>
                                        Codigo : {{$item->idEntrevista}}
                                      <br> Postulante: {{$item->Postulacion->DNI}}
                                      <br> Observación:  {{$item->observacion}}
                                        </span>
                                      
                                    </div>
                                    <div class="modal-footer">
                                      <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                     
                                      <form method="POST" action="{{route('Entrevista.destroy',$item->idEntrevista)}}">
                                        @method('delete')
                                        @csrf
                                            <button class="btn btn-danger"><i class="fas fa-check-square"></i> SI</button>
                                        </form>
                                    </div>
                                  </div>
                                </div>
                              </div>
                            {{-- <a href="" class="btn btn-info btn-sm"><i class="fas fa-edit"></i>Editar</a>
                            <a href="" class="btn btn-danger btn-sm"><i class="fas fa-trash"></i>Eliminar</a> --}}
                        </td>
                        </tr>
                      
                        
                    @endforeach
                    @endif
                    </tbody>
                </table>
                {{$Entrevistas->links()}}
            </div>
            <!-- /.card-body -->
            <!-- /.card-footer-->
        </div>


@endsection
