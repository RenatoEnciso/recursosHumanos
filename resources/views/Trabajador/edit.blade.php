@extends('dashboard')

@section('titulo', 'Editar acta de defunsion')

@section('contenido')

    <div class="container ">


        <div class="shadow-lg py-4 bg-body-tertiary rounded" style="margin-top:8vh">
            <h1 id="titulo" class="acta_title">Editar Trabajador</h1>
            
            <form method="POST" action="{{ route('Trabajador.update', $Trabajador->idTrabajador) }}" >
                @method('PUT')
                @csrf
                <div class="col-12">
                    <div class="row justify-content-center">
                        
                        
                        <div class="col-8 form-group">
                            <label class="control-label">Trabajador</label>
                            <input type="text" class="form-control @error('idTrabajador') is-invalid @enderror" 
                            value="{{$Trabajador->idTrabajador}} " 
                            id="idTrabajador" 
                            name="idTrabajador" readonly >
                            @error('idTrabajador')
                                <span class="invalid feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>     
                       
                        <div class="row justify-content-center" id="form-new-worker">
                            <div class="col-3 form-group">
                                <label class="control-label">Persona</label>
                                {{-- <select name="DNI" id="DNI" class="form-control @error('DNI') is-invalid @enderror"  >
                                    @foreach ($personas as $item)
                                        <option value="{{ $item->DNI}}"
                                            {{$item->DNI==$entrevista->Postulacion->DNI?'selected':''}}
                                            >{{ $item->DNI}}</option> 
                                    @endforeach
                                </select> --}}
                                <input type="text" class="form-control @error('DNI') is-invalid @enderror" value="{{$Trabajador->DNI}}" id="seguro" 
                                    name="DNI" readonly >
                                @error('DNI')
                                    <span class="invalid feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                 @enderror
                   
                            
                            </div>
                            <div class="col-2 form-group">
                                <label class="control-label">Fondo</label>
                                <select name="ONP" id="ONP" class="form-control" >
                                
                                    <option value="1" 
                                    {{$Trabajador->ONP==1?'selected':''}}
                                    >ONP</option> 
                                    <option value="0"
                                    {{$Trabajador->ONP==0?'selected':''}}
                                    >AFP</option> 
                               
                                    {{-- <option value="5">5</option> 
                                    <option >6</option>  --}}
                                </select>
                            </div>
                            <div class="col-3 form-group">
                                <label class="control-label">Seguro</label>
                                <input type="text" class="form-control @error('seguro') is-invalid @enderror" value="{{$Trabajador->seguro}}" id="seguro" 
                                    name="seguro" >
                                @error('seguro')
                                    <span class="invalid feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                 @enderror
                            </div>

                            
                            
                            <div class="row justify-content-center">
                
                
                           
                                <div class="col-4 form-group">
                                    <label class="control-label">Direccion</label>
                                
                                    <input type="text" class="form-control @error('direccion') is-invalid @enderror"  value="{{$Trabajador->direccion}}" id="direccion" 
                                        name="direccion" >
                                    @error('direccion')
                                        <span class="invalid feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>

                                
                                
                                {{-- </div>
                                <div class="row justify-content-center">--}}
                    
                    
                                <div class="col-4 form-group">
                                    <label class="control-label">Email address</label>
                                    <input type="email" class="form-control @error('correoPersonal') is-invalid @enderror"   name="correoPersonal" id="correoPersonal" value="{{$Trabajador->correoPersonal}}" >
                                    @error('correoPersonal')
                                        <span class="invalid feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
            
                                <div class="col-4 form-group">
                                    <label class="control-label">Teléfono</label>
                                
                                    <input type="text" class="form-control @error('telefono') is-invalid @enderror"  id="telefono" 
                                        name="telefono" value="{{$Trabajador->telefono}}">
                                    @error('telefono')
                                        <span class="invalid feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        
                        
                        
                    </div>
                   
                </div>

                <div class="boton_div">
                    <div>
                        <button class="btn btn-primary boton"><i class="fas fa-save"></i> GRABAR</button>
                    </div>
                    <div>
                        <a href="{{ route('Trabajador.cancelar') }}" class="btn btn-danger boton"><i class="fas fa-ban"></i> CANCELAR</a>
                    </div>
                </div>
            </form>  
        </div>
    </div>
    <script>
        function showImage() {
            return {
                showPreview(event) {
                    if (event.target.files.length > 0) {
                        var src = URL.createObjectURL(event.target.files[0]);
                        var preview = document.getElementById("preview");
                        preview.src = src;
                        preview.style.display = "block";
                    }
                }
            }
        }
        function showImage1() {
            return {
                showPreview(event) {
                    if (event.target.files.length > 0) {
                        var src = URL.createObjectURL(event.target.files[0]);
                        var preview = document.getElementById("preview1");
                        preview.src = src;
                        preview.style.display = "block";
                    }
                }
            }
        }
    </script>
    <script>
        

        function mensaje() {
        $('#DNI').select2();
        $('#DNIf').select2();
        $('#idLibro').select2();
        $('#idFolio').select2();
        $("#idCargo").select2({
        dropdownAutoWidth : true
        });
        }
        setTimeout(mensaje,500);

    </script>
@endsection
