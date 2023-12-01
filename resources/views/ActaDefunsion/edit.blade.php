@extends('dashboard')

@section('titulo', 'Editar acta de defunsion')

@section('contenido')
    <div class="container">
        <div class="shadow-lg py-4 bg-body-tertiary rounded "style="margin-top:18vh; margin-bottom:18vh">
            <h1 id="titulo" class="acta_title">Editar Acta de Defunción</h1>
            <form method="POST" action="{{ route('ActaDefunsion.update', $actaDefunsion->idActaPersona) }}">
                @method('PUT')
                @csrf
                <div class="row" style="width: 85%; margin: 0 auto">
                    <div class="form-group">
                        <label class="control-label">CODIGO</label>
                        <input type="text" class="form-control" style="color: blue" value="{{ $actaDefunsion->idActaPersona }}" disabled>
                    </div>
                    <div class="row">
                        <div class="col-8">
                            {{-- <div style="display: flex">
                                <div class="col col-6">
                                    <label class="control-label">Numero de libro</label>
                                    <select name="nroLibro" id="idLibro" 
                                        class="form-control @error('libro') is-invalid @enderror">
                                        @foreach($libros as $item)
                                        <option value="{{$item['idLibro'] }}" {{$item->idLibro==$acta->idLibro?'selected':''}}> Libro
                                            {{$item['nroLibro'] }}</option>
                                        @endforeach
                                    </select>
                                    @error('libro')
                                        <span class="invalid feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
    
                                <div class="col col-6">
                                    <label class="control-label">Numero de Folio</label>
                                    <select name="nroFolio" id="idFolio" 
                                        class="form-control @error('folio') is-invalid @enderror">
                                        @foreach($folios as $item)
                                            <option value="{{$item['idFolio'] }}" {{$item->idFolio==$acta->idFolio?'selected':''}}  > Folio 
                                            {{$item['nroFolio'] }}</option>
                                        @endforeach
                                    </select>
                                    @error('folio')
                                        <span class="invalid feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div> --}}
    
                            <div class="col-12 form-group">
                                <label class="control-label">Detalle de la Muerte</label>
                                <input type="text" class="form-control @error('observacion') is-invalid @enderror"
                                    value="{{ $acta->observacion }}" id="observacion" name="observacion">
                                @error('observacion')
                                    <span class="invalid feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
    
                            <div class="col-12 form-group">
                                <label class="control-label">Fecha de defuncion</label>
                                <input type="date" class="form-control @error('fecha_fallecido') is-invalid @enderror"
                                    id="fecha_fallecido" name="fecha_fallecido" value="{{$acta->ActaDefunsion->fecha_fallecido}}">
                                @error('fecha_fallecido')
                                    <span class="invalid feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                                
                            </div>
                            <div class="col-12 form-group">
                                <label class="control-label">Localidad</label>
                                <input type="text" class="form-control @error('localidad') is-invalid @enderror"
                                    placeholder="Ingrese lugar de fallecimiento" id="localidad" name="localidad" value="{{ $acta->localidad}}">
                                @error('localidad')
                                    <span class="invalid feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="col-12 form-group">
                                <label class="control-label">Lugar de fallecimiento</label>
                                <input type="text" class="form-control @error('lugar_ocurrencia') is-invalid @enderror"
                                    placeholder="Ingrese lugar de fallecimiento" id="lugar_ocurrencia" name="lugar_ocurrencia" value="{{ $acta->lugar_ocurrencia}}">
                                @error('lugar_ocurrencia')
                                    <span class="invalid feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="col-12 form-group">
                                <label class="control-label">Fallecido</label>
                                <select name="dniPersona" id="DNI"
                                    class="form-control @error('persona') is-invalid @enderror">
                                    @foreach($personas as $item)
                                        <option value="{{$item['DNI'] }}" {{$item->DNI==$actaDefunsion->DNI?'selected':''}}>
                                            {{$item['Nombres'] }}</option>
                                        @endforeach
    
                                </select>
                                @error('persona')
                                    <span class="invalid feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="col-12 form-group">
                                <label class="control-label">Solicitante de registro</label>
                                <select name="dniFamiliar" id="DNIf"
                                    class="form-control @error('persona') is-invalid @enderror">
                                    @foreach($personas as $item)
                                        <option value="{{$item['DNI'] }}" {{$item->DNI==$actaDefunsion2->DNI?'selected':''}}>
                                            {{$item['Nombres'] }}</option>
                                        @endforeach
    
                                </select>
                                @error('persona')
                                    <span class="invalid feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
    
                        <div class="col-4">
                            <div class="col-12">
                                <label class="control-label">Archivo de Defunsion</label>
                                <input type="file" class="form-control @error('archivo_defunsion') is-invalid @enderror"
                                    placeholder="Ingrese Archivo" id="archivo_defunsion" name="archivo_defunsion"
                                    value="{{ old('archivo_defunsion') }}" x-data="showImage()" @change="showPreview(event)">
                                <iframe src="{{ $acta->ficha->ruta_certificado }}" id="preview" class="object-cover h-32 mt-2 w-60"
                                    height="100%"> </iframe>
                                @error('archivo_defunsion')
                                    <span class="invalid feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div><br>
                            <div class="col-12">
                                <label class="control-label">Firma del declarante</label>
                                <input type="file" class="form-control @error('archivo_firma_declarante') is-invalid @enderror"
                                    placeholder="Ingrese Archivo" id="archivo_firma_declarante" name="archivo_firma_declarante"
                                    value="{{ old('archivo_firma_declarante') }}" x-data="showImage1()" @change="showPreview(event)">
                                <iframe src="{{$acta->ActaDefunsion->firma_declarante}}" id="preview" class="object-cover  mt-2 w-60" height="100%" > </iframe>
                            
                                @error('archivo_firma_declarante')
                                    <span class="invalid feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                                <br>
                            </div>
                        </div>
    
                    </div><br>
                    <div class="boton_div" style="margin-top: 3%">
                        <div>
                            <button class="btn btn-primary boton"><i class="fas fa-save"></i> GRABAR</button>
                        </div>
                        <div>
                            <a href="{{ route('ActaDefunsion.cancelar') }}" class="btn btn-danger boton"><i class="fas fa-ban"></i> CANCELAR</a>
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
        }
        setTimeout(mensaje,500);
    </script>
@endsection
