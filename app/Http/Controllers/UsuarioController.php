<?php

namespace App\Http\Controllers;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class UsuarioController extends Controller
{
    public function index(){
        return view('index');
    }


    public function update($id, Request $request){
        $usuario=User::findOrFail($id);
        if($request->hasFile('file_fotoPerfil')){
            $archivo=$request->file('file_fotoPerfil')->store('archivosFotoPerfil','public');
            $urlFoto = Storage::url($archivo);
            $usuario->fotoPerfil=$urlFoto;
        }else{
            $usuario->fotoPerfil="../assets/img/profile.jpg";
        }
        $usuario->save();
        return redirect()->route('usuario.index');
    }

/*    
    public function edit($id){
        $usuario=User::findOrFail($id);
        return view('perfil', compact('usuario'));
    }

    public function store(Request $request){
        
        if($request->hasFile('file_fotoPerfil')){
            $archivo=$request->file('file_fotoPerfil')->store('archivosFotoPerfil','public');
            $urlFoto = Storage::url($archivo);
        }else{
            $urlFoto="../assets/img/profile.jpg";
        }
        return redirect()->route('usuario.index');
    }
*/
    

}










