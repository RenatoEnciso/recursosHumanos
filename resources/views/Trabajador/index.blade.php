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
                <h3 id="titulo"  class="card-title">TRABAJADORES</h3>
            </div>
            <div class="card-body">
            {{-- <a href="{{route('Trabajador.create')}}" class="btn btn-primary"><i class="fas fa-plus"></i> Nuevo registro</a> --}}
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

                        <th scope="col" style="font-weight: bold;">Seguro</th>
                        <th scope="col"style="font-weight: bold;">Tipo de aporte</th>
                        <th scope="col"style="font-weight: bold;">DNI</th>
                        <th scope="col"style="font-weight: bold;">Direccion</th>
                        <th scope="col"style="font-weight: bold;">Telefono</th>
                        <th scope="col"style="font-weight: bold;">Correo</th>
       
                        <th scope="col"style="font-weight: bold;">Opciones</th>
                    </tr>
                    </thead>
                    <tbody>
                    @if (count($Trabajadores)<=0)
                        <tr>
                        <td colspan="3"><b>No hay registros</b></td>
                        </tr>
                        @else

                    @foreach ($Trabajadores as $item)
                        <tr>

                        <td >{{$item->seguro}}</td>
                        <td>@if ($item->ONP==1)
                            ONP
                        @else
                            AFP
                        @endif
                           </td>
                        <td>{{$item->DNI}}</td>
                        <td>{{$item->direccion}}</td>
                        <td>{{$item->telefono}}</td>
                        <td>{{$item->correoPersonal}}</td>
                        {{-- <td> --}}
                        {{-- <button   class="btn btn-outline-secondary btn-sm" data-bs-toggle="modal" data-bs-target="#staticBackdropr{{$item->idTrabajador}}">
                            <i class="fa-solid fa-file-circle-check"></i>Requisito de postulante
                        </button>
                        <button   class="btn btn-outline-secondary btn-sm" data-bs-toggle="modal" data-bs-target="#staticBackdropm{{$item->idTrabajador}}">
                            <i class="fa-solid fa-file-circle-check"></i>Manual de postulante
                        </button> --}}
                        
                        
                        <!-- Modal -->
                        {{-- <div class="modal fade " id="staticBackdropr{{$item->idTrabajador}}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content">
                                <div class="modal-header">
                                <h1 class="modal-title fs-5" id="staticBackdropLabel">Requisitos de {{$item->descripcion}}</h1>
                            
                                </div>
                                <div class="modal-body">
                              
                                    <iframe  src="{{$item->requisitos}}" class="object-cover  mt-2 " height="500vh" width="450vh" frameborder="0" scrolling=""> </iframe>
                                
                                </div>
                                <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    
                                </div>
                            </div>
                            </div>
                        </div>
                        <div class="modal fade " id="staticBackdropm{{$item->idTrabajador}}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content">
                                <div class="modal-header">
                                <h1 class="modal-title fs-5" id="staticBackdropLabel">Manual de {{$item->descripcion}}</h1>
                            
                                </div>
                                <div class="modal-body">
                              
                                    <iframe  src="{{$item->manualPostulante}}" class="object-cover  mt-2 " height="500vh" width="450vh" frameborder="0" scrolling=""> </iframe>
                                
                                </div>
                                <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    
                                </div>
                            </div>
                            </div>
                        </div> --}}
                        {{-- </td> --}}
                        <td >
{{--                             
                            <td><button   class="btn btn-outline-secondary btn-sm" data-bs-toggle="modal" data-bs-target="#staticBackdropp{{$item->idContrato}}">
                                <i class="fa-solid fa-file-circle-check"></i>
                            </button>
                    
                            
                            
                            <!-- Modal -->
                            <div class="modal fade " id="staticBackdropp{{$item->idContrato}}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered">
                                <div class="modal-content">
                                    <div class="modal-header">
                                    <h1 class="modal-title fs-5" id="staticBackdropLabel">Contrato de  {{$item->DNI}}-{{$item->persona->nombres}}</h1>
                                
                                    </div>
                                    <div class="modal-body">
                                  
                                        <iframe  src="{{$item->archivoContrato}}" class="object-cover  mt-2 " height="500vh" width="450vh" frameborder="0" scrolling=""> </iframe>
                                    
                                    </div>
                                    <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        
                                    </div>
                                </div>
                                </div>
                            </div> --}}
                     
                            <a href="{{ route('Trabajador.edit',$item->idTrabajador) }}" class="btn btn-info btn-sm"><i class="fas fa-edit"></i>Editar</a>
                            {{-- <a href="{{ route('ActaDefunsion.archivo',$item->idActaPersona)}}" class="btn btn-primary btn-sm"><i class="fa fa-eye"></i>Ver</a> --}}
                           
                            {{-- <a href="{{ route('Trabajador.edit',$item->idTrabajador) }}" class="btn btn-info btn-sm"><i class="fas fa-edit"></i>Editar</a>
                            <a href="{{ route('Trabajador.confirmar',$item->idTrabajador) }}" class="btn btn-danger btn-sm"><i class="fas fa-trash"></i>Eliminar</a> --}}
                            {{-- <a href="" class="btn btn-info btn-sm"><i class="fas fa-edit"></i>Editar</a> --}}
                            {{-- <div class="modal-dialog modal-dialog-centered">
                                HOLA
                            </div> --}}
                            {{-- <a href="{{ route('Trabajador.confirmar',$item->idTrabajador) }}" class="btn btn-danger btn-sm"><i class="fas fa-trash"></i>Eliminar</a> --}}

                            <button   class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#staticBackdrop{{$item->idTrabajador}}">
                                <i class="fas fa-trash"></i>Eliminar
                              </button>
                      
                            
                            
                              <!-- Modal -->
                              <div class="modal fade " id="staticBackdrop{{$item->idTrabajador}}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered">
                                  <div class="modal-content">
                                    <div class="modal-header">
                                      <h1 class="modal-title fs-5" id="staticBackdropLabel">Eliminar Trabajador</h1>
                                      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <span>
                                            Codigo : {{$item->idTrabajador}}
                                      {{-- <br> Cargo: {{$item->Cargo->descripcion}}
                                      <br> Monto: S/.{{$item->monto}} --}}
                                        </span>
                                      
                                    </div>
                                    <div class="modal-footer">
                                      <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                     
                                      <form method="POST" action="{{route('Trabajador.destroy',$item->idTrabajador)}}">
                                        @method('delete')
                                        @csrf
                                            <button class="btn btn-danger"><i class="fas fa-check-square"></i> SI</button>
                                        </form>
                                    </div>
                                  </div>
                                </div>
                              </div>
                        </td>
                        </tr>
                      
                        
                    @endforeach
                    @endif
                    </tbody>
                </table>
                {{$Trabajadores->links()}}
            </div>
            <!-- /.card-body -->
            <!-- /.card-footer-->
        </div>

@endsection
