<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
//use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Input;
use App\Noticia;
use Image;
use Intervention\Image\ImageManager;

class artController extends Controller
{
    public function ver()
    {
    	$categ = DB::select("call mostrarCategorias()");
        $new_name = 'usuario.png';
        $estado = '';
    	return view('cargar_articulos')
            ->with('categorias' , $categ)
            ->with('fotoart',$new_name)
            ->with('estado',$estado);
    }


    function index()
    {
        return view('upload');
    }


    function upload(Request $request)
    {
         $this->validate($request, ['select_file'  => 'required|image|mimes:jpg,png,gif|max:2048']);

         $image = $request->file('select_file');

         if ($request->hasFile('select_file')) {
                $request->file('select_file')->store('public');
                $imagen = $request->file('select_file')->path();
        }

         $new_name = rand() . '.' . $image->getClientOriginalExtension();
         dd($new_name);

         $image->move(public_path('images'), $new_name);
         return back()->with('success', 'Image Uploaded Successfully')->with('path', $new_name);
    }




    public function form(Request $request) 
    {

        $categoria_seleccionada = $request->get('categorias');
        $id_clien = '2';
        $estado = '0';
    	//is method se usa para ver que metodo usa
    	//has se usa para saber si el texfield no esta vacio
    	if ($request->isMethod("POST") && $request->has("name") && $categoria_seleccionada!='0' && $request->hasFile('image')) {
    		//aca toma el valor de lo que se escrubio en el textfiel
    		//que su name era name
    		$nombre = $request->input("name");
            $descripcion = $request->input("desc");
            $categoria_seleccionada = $request->get('categorias');

            //$nombre_imagen = $id_clien.'_'.$image->getClientOriginalName();
            //$imagen_path = $request->file('image')->path();
            $this->validate($request, ['image'  => 'required|image|mimes:jpg,png,gif|max:2048']);
            $image = $request->file('image');
            $new_name = $id_clien.'_'.$image->getClientOriginalName();
            $image->move(public_path('images'), $new_name);
        
            $info = DB::select("call insertarArt(?,?,?,?,?,?)",[$nombre,$descripcion,123,$new_name,$categoria_seleccionada,$id_clien]);
            $categ = DB::select("call mostrarCategorias()");
            $estado = '1';

            return view('cargar_articulos',[
                'name' => $nombre,
                'descrip' => $descripcion,
                'categorias' => $categ,
                'categoria_seleccionada' => $categoria_seleccionada,
                'fotoart' => $new_name,
                'estado' => $estado
            ]);
    	}
    	else{
    		$estado = '0';
            $nombre = '';
            $descripcion = '';
            $categoria_seleccionada = '';
            $categ = DB::select("call mostrarCategorias()");
            $new_name = 'usuario.png';

            return view('cargar_articulos',[
                'name' => $nombre,
                'descrip' => $descripcion,
                'categorias' => $categ,
                'categoria_seleccionada' => $categoria_seleccionada,
                'fotoart' => $new_name,
                'estado' => $estado
            ]);
    	}

    }
}
