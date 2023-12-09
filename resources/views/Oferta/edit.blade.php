@extends('dashboard')

@section('titulo', 'Editar acta de defunsion')

@section('contenido')

    <div class="container ">


        <div class="shadow-lg py-4 bg-body-tertiary rounded" style="margin-top:8vh">
            <h1 id="titulo" class="acta_title">Editar Oferta</h1>
            
            <form method="POST" action="{{ route('Oferta.update', $Oferta->idOferta) }}" >
                @method('PUT')
                @csrf
                <div class="row justify-content-center">
                    <ul class="nav nav-tabs" id="myTab" role="tablist">
                        <li class="nav-item" role="presentation">
                        <button class="nav-link active" id="profile-tab" data-bs-toggle="tab" data-bs-target="#profile-tab-pane" type="button" role="tab" aria-controls="profile-tab-pane" aria-selected="false">1 Oferta </button>
                        </li>
                        <li class="nav-item" role="presentation">
                        <button class="nav-link" id="contact-tab" data-bs-toggle="tab" data-bs-target="#contact-tab-pane" type="button" role="tab" aria-controls="contact-tab-pane" aria-selected="false">2 Archivos</button>
                        </li>
                
                    </ul>
                </div>
                
                <div class="tab-content" id="myTabContent">
          
                    <div class="tab-pane fade show active" id="profile-tab-pane" role="tabpanel" aria-labelledby="profile-tab" tabindex="0">
                       
                        <div class="row justify-content-center ">
                            <div class="col-2 form-group">
                                <label class="control-label">Codigo</label>
                                <input type="text" class="form-control" style="color: blue" value="{{ $Oferta->idOferta }}" disabled>
                            </div>
                            <div class="col-6 form-group">
                                <label class="control-label">Descripción</label>
                                <textarea  type="text" class="form-control @error('descripcion') is-invalid @enderror"
                                    placeholder="Ingrese descripcion"  name="descripcion" >{{$Oferta->descripcion}}</textarea >
                                @error('descripcion')
                                    <span class="invalid feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="row justify-content-center">
                            <div class="col-4 form-group">
                                <label class="control-label">Fecha de inicio</label>
                            
                                @if ($fecha_actual>=$Oferta->fecha_inicio)
                            
                                    <input type="date" class="form-control"  id="fecha_inicio" 
                                    name="fecha_inicio"  value="{{$Oferta->fecha_inicio}}" readonly>
                                @else
                                    <input type="date" class="form-control"  id="fecha_inicio" 
                                    name="fecha_inicio"  value="{{$Oferta->fecha_inicio}}">
                                @endif
                                
                            </div>
                            <div class="col-4 form-group">
                                <label class="control-label">Fecha de fin</label>
                                <input type="date" class="form-control" value="{{$Oferta->fecha_fin}}" id="fecha_fin" 
                                    name="fecha_fin" >
                            </div>
                        </div>
                
                        <div class="row justify-content-center">
                            <div class="col-4 form-group">
                                <label class="control-label" >Cargo</label>
                                <select name="idCargo" id="idCargo" class="form-control">
                                    @foreach ($cargos as $item)
                                    <option value="{{ $item->idCargo}}"  
                                        {{$Oferta->idCargo==$item->idCargo?'selected':''}}>
                                        {{ $item->descripcion }}</option> 
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-2 form-group">
                                <label class="control-label">Monto(S/.)</label>
                                <input type="text" class="form-control @error('monto') is-invalid @enderror"
                                    placeholder="Ingrese monto"  name="monto" value="{{$Oferta->monto}}"> 
                                @error('monto')
                                    <span class="invalid feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="col-2 form-group">
                                <label class="control-label" >Tipo</label>
                                <select name="convocatoria" id="convocatoria" class="form-control" readonly>
                             
                                    <option value="1" {{$Oferta->convocatoria==1?'selected':''}}>CAS</option> 
                                        <option value="2" {{$Oferta->convocatoria==2?'selected':''}}>Práctica</option> 
                        
                                </select>
                            </div>
                            <div class="boton_div">
                                <div class="col-8 form-group flex">
                                    <div>
                                        <button onclick="document.getElementById('contact-tab').click();" type="button" role="tab"class="btn btn-primary boton">Siguiente</button>
                                    
                                    </div>
        
                                </div>
                            </div>

                        </div>
                    </div>

                    <div class="tab-pane fade" id="contact-tab-pane" role="tabpanel" aria-labelledby="contact-tab" tabindex="0"> 
                        <div class="row justify-content-center">

                            <div class="col-4 form-group">
                                <label class="control-label">Requisitos de postulante</label>
                                <input type="file" class="form-control @error('requisitos') is-invalid @enderror"
                                placeholder="Ingrese requisito" id="requisitos" name="requisitos"
                                value="{{ old('requisitos') }}" x-data="showImage()" @change="showPreview(event)" >
                            @error('requisitos')
                                <span class="invalid feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                            <iframe id="preview" src="{{$Oferta->requisitos}}"  class="object-cover h-32 mt-2 " height="400vh"  width="100%" ></iframe> </iframe>
                            </div>
                            
                            <div class="col-4 form-group">
                                <label class="control-label">Manual de postulante</label>
                                <input type="file" class="form-control @error('manualPostulante') is-invalid @enderror"
                                placeholder="Ingrese manual de postulante" id="manualPostulante" name="manualPostulante"
                                value="{{ old('manualPostulante') }}" x-data="showImage1()" @change="showPreview(event)">
                            @error('manualPostulante')
                                <span class="invalid feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                            <iframe id="preview1"   class="object-cover h-32 mt-2 " height="400vh"  width="100%" src="{{$Oferta->manualPostulante}}"> </iframe>
                            </div>
                        </div>
            


                        <div class="boton_div">
                            <div class="col-8 form-group flex">
                                <div>
                                    <button class="btn btn-primary boton"><i class="fas fa-save"></i> GUARDAR</button>
                                </div>
                                <div></div>
                                <div>
                                    <a href="/Oferta" class="btn btn-danger boton"><i class="fas fa-ban"></i> CANCELAR</a>
                                    {{-- <a href="{{route('Oferta.cancelar') }}" class="btn btn-danger boton"><i class="fas fa-ban"></i> CANCELAR</a> --}}
                                </div>
                            </div>
                        </div>
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
