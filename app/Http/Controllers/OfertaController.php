<?php

namespace App\Http\Controllers;




use App\Models\Oferta;
use App\Models\Cargo;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class OfertaController extends Controller
{
    
    const PAGINATION=7;

    public function index(Request $request){
        $busqueda=$request->get('busqueda');
        // return $busqueda;
        $Ofertas=Oferta::where('descripcion','like','%'.$busqueda.'%')
        ->where('estado','=','1')
        ->paginate($this::PAGINATION);
        
        return view('Oferta.index',compact('Ofertas','busqueda'));
    }

    public function create()
    {
        // if (Auth::user()->Oferta=='Encargado contrato'){   //boteon registrar
            $cargos = Cargo::all();
            $fecha_actual=Carbon::now();
            $fecha_actual->setLocale('es'); 
            $fecha_actual->setTimezone('America/Lima');
            // return $fecha_actual;
            return view('Oferta.create',compact('cargos','fecha_actual'));
        // } else{
        //     return redirect()->route('Oferta.index')->with('datos','..::No tiene Acceso ..::');
        // }
    }

    public function store(Request $request)
    {
        // Carbon::
        // return $request->all
        $data=request()->validate([
            'descripcion'=>'required|max:30',
            // 'fecha_inicio'=>'required',
            'fecha_inicio' => 'required|after_or_equal:yesterday',
            'fecha_fin'=>'required|before_or_equal:'.Carbon::parse($request->fecha_inicio)->addMonth(1)->format('Y-m-d'),
        //    'archivo_nacimiento'=>'required',
           
        ],
        [
          
            'descripcion.max'=>'Máximo 30 carácteres para la descripcion',
            'fecha_inicio.required'=>'Ingrese una fecha de inicio',
            // 'fecha_inicio.after_or_equal'=>'No se permite fechas menores a la actual',
            'fecha_fin.required'=>'Ingrese una fecha de fin',
            // 'lugar_nacimiento.max'=>'Máximo 30 carácteres para el lugar de Nacimiento',
           // 'archivo_nacimiento.required'=>'Ingrese el archivo de la Acta de Nacimiento',
        ]);
            $data=request()->validate([
                    ]);
                    $Oferta=new Oferta();
                    $Oferta->descripcion=$request->descripcion;
                    $Oferta->fecha_inicio=$request->fecha_inicio;
                    $Oferta->fecha_fin=$request->fecha_fin;
                    $Oferta->idCargo=$request->idCargo;
                    $Oferta->monto=$request->monto;
                    $Oferta->estado='1';
                    $Oferta->save();
                    return redirect()->route('Oferta.index')->with('datos','Registrados exitosamente...');
    }

    public function edit($id)
    {
        // if (Auth::user()->Oferta=='Encargado contrato'){ //boton editar
            $Oferta=Oferta::findOrFail($id);
            $cargos = Cargo::all();
            $fecha_actual=Carbon::now();
            $fecha_actual->setLocale('es'); 
            $fecha_actual->setTimezone('America/Lima');
            $fecha_actual=$fecha_actual->toDateString();
            // return $fecha_actual;
            return view('Oferta.edit',compact('Oferta','cargos','fecha_actual'));
        // }else{
        //     return redirect()->route('Oferta.index')->with('datos','..::No tiene Acceso ..::');
        // }
    }

    public function update(Request $request, $id)
    {
        $data=request()->validate([
            'descripcion'=>'required|max:30',
            // 'fecha_inicio'=>'required',
            'fecha_inicio' => 'required|after_or_equal:yesterday',
            'fecha_fin'=>'required|before_or_equal:'.Carbon::parse($request->fecha_inicio)->addMonth(1)->format('Y-m-d'),
            // 'descripcion'=>'required|max:30',
            // // 'fecha_inicio'=>'required',
            // 'fecha_inicio' => 'required|after_or_equal:yesterday',
        //     'fecha_fin'=>'required|before_or_equal:'.Carbon::parse($request->fecha_inicio)->addMonth(1)->format('Y-m-d'),
        // //    'archivo_nacimiento'=>'required',
           
        ],
        [
          
        //     'descripcion.max'=>'Máximo 30 carácteres para la descripcion',
        //     'fecha_inicio.required'=>'Ingrese una fecha de inicio',
        //     // 'fecha_inicio.after_or_equal'=>'No se permite fechas menores a la actual',
        //     'fecha_fin.required'=>'Ingrese una fecha de fin',
        //     // 'lugar_nacimiento.max'=>'Máximo 30 carácteres para el lugar de Nacimiento',
        //    // 'archivo_nacimiento.required'=>'Ingrese el archivo de la Acta de Nacimiento',
        ]);
        $Oferta=Oferta::findOrFail($id);
        $Oferta->descripcion=$request->descripcion;
        $Oferta->fecha_inicio=$request->fecha_inicio;
        $Oferta->fecha_fin=$request->fecha_fin;
        $Oferta->idCargo=$request->idCargo;
        $Oferta->monto=$request->monto;
        $Oferta->save();
        return redirect()->route('Oferta.index')->with('datos','Registro Actualizado exitosamente...');
    }

    public function destroy($id)
    {
            $Oferta=Oferta::findOrFail($id);
            $Oferta->estado='0';
            $Oferta->save();
            return redirect()->route('Oferta.index')->with('datos','Registro Eliminado..');
    }


    public function confirmar($id){
        // if (Auth::user()->Oferta=='Encargado contrato'){ //boton eliminar
            $Oferta=Oferta::findOrFail($id);
            return view('Oferta.confirmar',compact('Oferta'));
        // }else{
        //     return redirect()->route('Oferta.index')->with('datos','..::No tiene Acceso ..::');
        // }
    }


    public function cancelar(){
        return redirect()->route('Oferta.index')->with('datos','acciona cancelada...');
    }
    // public function DniRepetido($dni_comprobar){
    //     $Ofertas=Oferta::all();
    //     if(count($Ofertas)==0){
    //         return false;
    //     }else{
    //         foreach($Ofertas as $Oferta){
    //             if($Oferta->$DNI==$dni_comprobar){
    //                 return true;
    //                 break;
    //             }
    //         }
    //         return false;
    //     }
    // }

}
