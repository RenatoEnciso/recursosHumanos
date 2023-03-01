<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use App\Models\Rol;

class AdministradorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    
     const PAGINATION=5;
    public function index(Request $request)
    {
        $busqueda= $request->get('buscarpor');
        $usuarios=User::select('*')
        ->where('users.email','like','%'.$busqueda.'%')
        ->paginate($this::PAGINATION);
      //  $usuarios=User::all();
        return view('Usuarios.index',compact('usuarios','busqueda'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $roles=Rol::all();
       return view();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
       $usuario=User::findOrFail($id);
       return view('Usuarios.confirmar',compact('usuario'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $usuario=User::findOrFail($id);
        $roles=Rol::all();
        return view('Usuarios.edit',compact('usuario','roles'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
       $usuario= User::findOrFail($id);
       $usuario->name=$request->name;
       $usuario->password=Hash::make($request->password);
       $usuario->email=$request->email;
       $usuario->idRol=$request->idRol;
       $usuario->save();
       return redirect()->route('administrador.index')->with('datos','Registro Nuevo Actualizado ...!');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
       $usuario=User::findOrFail($id);
       $usuario->delete();
       return redirect()->route('administrador.index')->with('datos','Registro Eliminado ...!');
      
    }

    public function cancelar(){
        return redirect()->route('administrador.index')->with('datos','acciona cancelada...');
    }
}
