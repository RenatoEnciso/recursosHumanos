@extends('dashboard')

@section('titulo', 'Editar acta de defunsion')

@section('contenido')
    <div class="container">
        <div class="shadow-lg py-4 bg-body-tertiary rounded "style="margin-top:18vh" >
            <h1 id="titulo" class="acta_title">Editar Horario</h1>
            <form method="POST" action="{{ route('Horario.update', $Horario->idHorario) }}">
                @method('PUT')
                @csrf
   
                <div class="row justify-content-center">
                    <div class="col-2 form-group">
                        <label class="control-label">Codigo</label>
                        <input type="text" class="form-control" style="color: blue" value="{{ $Horario->idHorario }}" disabled>
                    </div>
                
                    <div class="col-3 form-group">
                                  
                        <label for="dia" class="control-label">Días:</label>
                        <select id="dia" name="dia"  class="form-control dias">
                            
                            <option value="1" {{$Horario->dia==1?'selected':''}}>Lunes</option>
                            <option value="2" {{$Horario->dia==2?'selected':''}}>Martes</option>
                            <option value="3" {{$Horario->dia==3?'selected':''}}>Miercoles</option>
                            <option value="4" {{$Horario->dia==4?'selected':''}}>Jueves</option>
                            <option value="5" {{$Horario->dia==5?'selected':''}}>Viernes</option>
                            <option value="6" {{$Horario->dia==6?'selected':''}}>Sabado</option>
                            <option value="7" {{$Horario->dia==7?'selected':''}}>Domingo</option>
                            <!-- Agrega más opciones según sea necesario -->
                        </select>
            
                  
                    </div>
                </div>
                <div class="row justify-content-center">
                    
                    <div class="col-3 form-group">
                        <label for="horaVariable1" class="control-label">Hora inicio:</label>
                        <input type="time" id="horaVariable1" name="hora_inicio" class="form-control @error('hora_inicio') is-invalid @enderror" value={{$Horario->hora_inicio}} >
                    </div> 
                    @error('hora_inicio')
                                            <span class="invalid feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror

                                        
                    <div class="col-3 form-group">
                        <label for="horaVariable2" class="control-label">Hora fin:</label>
                        <input type="time" id="horaVariable2" name="hora_fin" class="form-control @error('hora_fin') is-invalid @enderror" value={{$Horario->hora_fin}}>
                    </div> 
                    @error('hora_fin')
                                            <span class="invalid feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                </div>
                
                        

                        
                <div class="boton_div">
                    <div>
                        <button class="btn btn-primary boton"><i class="fas fa-save"></i> GRABAR</button>
                    </div>
                    <div>
                        <a href="{{ route('Horario.cancelar') }}" class="btn btn-danger boton"><i class="fas fa-ban"></i> CANCELAR</a>
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
        }
        setTimeout(mensaje,500);
    </script>
@endsection
