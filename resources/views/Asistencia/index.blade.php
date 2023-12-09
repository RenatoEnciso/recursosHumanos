<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Face detection on the browser using javascript !</title>
  <script defer src="{{asset('/asistencia/face-api.min.js')}}"></script>
  <script defer src="{{asset('/asistencia/web.js')}}"></script>
  <link rel="stylesheet"  href="{{asset('/asistencia/style.css')}}">
</head>
<body>
  @if (session('datos'))
                <div class="alert alert-warning alert-dismissible fade show mt-3 emergente" role="alert" style="color: white; background-color: rgb(183, 178, 31) ">
                    {{session('datos')}}
                </div>
                @endif
  <video id="video" width="600" height="450" autoplay>
            'idContrato' => 'required|exists:Contrato,idContrato',
    <form method="POST" action="{{ route('Asistencias.store') }}" enctype="multipart/form-data">
      @csrf
      <input type="text" value="{{Auth::user()->id}}" name="id" id="id" readonly>
      
      <select name="idContrato" id="idContrato" class="form-control @error('idContrato') is-invalid @enderror"  >
                       
        @foreach ($contratos as $item)
                            <option value="{{$item->idContrato}}"
                                {{Auth::user()->id = $item->idTrabajador?'selected':''}}
                                >{{$item->trabajador->DNI}}-{{ $item->trabajador->persona->Nombres}} {{ $item->trabajador->persona->Apellido_Paterno}} {{ $item->trabajador->persona->Apellido_Materno}}</option> 
                        @endforeach
    </select>

      <div class="col-4 form-group">
        <label class="control-label">Registro</label>
        <input type="date" class="form-control" id="fechaRegistro" name="fechaRegistro" value="{{ date('Y-m-d') }}">
      </div>


      <div class="col-3 form-group">
        <label for="horaRegistroEntrada" class="control-label">Hora inicio:</label>
        <input type="time" id="horaRegistroEntrada" name="horaRegistroEntrada" class="form-control @error('horaRegistroEntrada') is-invalid @enderror" >
    
                     @error('horaRegistroEntrada')
                            <span class="invalid feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
      </div> 
                        
      <div class="col-3 form-group">
        <label for="horaVariable2" class="control-label">Hora fin:</label>
        <input type="time" id="horaVariable2" name="horaRegistroSalida" class="form-control @error('horaRegistroSalida') is-invalid @enderror">
    
                        @error('horaRegistroSalida')
                            <span class="invalid feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
      </div> 



      @foreach ($usuarios as $item)
        <input type="text" value="{{$item->id}}" name="archivos"  readonly>
      @endforeach
      <button id="btnAsistencia">ASISTENCIA </button>
    </form>
</body>
</html>
