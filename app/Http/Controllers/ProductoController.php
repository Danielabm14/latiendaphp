<?php

namespace App\Http\Controllers;

use App\Models\Producto;
use App\Models\Categoria;
use App\Models\Marca;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ProductoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        echo "aqui va a ir el catalogo de productos";
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $marcas=Marca::all();
        $categorias=Categoria::all();
        // mostrar la vista de nuevo producto
        return view('productos.create')
        ->with('categorias', $categorias)
        -> with('marcas', $marcas);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $r)
    {
        //examinar el archivo cargado
        /*echo'<pre>';
        var_dump($r->imagen);
        echo'</pre>';
        */

        //validaciones 
        //1. establecer reglas de validacion

        $reglas=[
            "nombre"    => 'required|alpha|unique:productos,nombre',
            "desc"      => 'required|min:5|max:20',
            "precio"    => 'required|numeric',
            "imagen"    => 'required|image',
            "marca"     => 'required',
            "categoria" => 'required'
        ];

        //2. crear el objeto validador 
        $v=Validator::make($r->all(), $reglas);

        //3. validar
        if($v->fails()){
            //si la validacion fallo
            //redirigirme a la vista de create (ruta: productos/create)
            return redirect('productos/create')
                 ->withErrors($v);
        }else{
            //validacion exitosa
    
        $archivo=$r->imagen;
        //obtener nombre del archivo
    $nombre_archivo = ($archivo->getClientOriginalName());

        // establecer la ubicacion de guardado del archivo
        $ruta = (public_path()."/img");

        //mover el archivo de imagen a la ubicacion y nombre deseados
        $archivo->move($ruta, $nombre_archivo);

        //Crear nuevo producto
        $p = new Producto ();

        //Asignar atributos del producto 
        $p->nombre = $r->nombre;
        $p->desc =$r->desc;
        $p->precio = $r->precio;
        $p->marca_id =$r->marca;    
        $p->categoria_id = $r->categoria;
        $p->imagen = $nombre_archivo;
        //Grabar productos 
        $p->save();
       return redirect('productos/create')
            ->with('mensajito', 'producto registrado correctamente');
        }
    }
    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Producto  $producto
     * @return \Illuminate\Http\Response
     */
    public function show($producto)
    {
        echo "aqui va el detalle del producto con id: $producto";
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Producto  $producto
     * @return \Illuminate\Http\Response
     */
    public function edit( $producto)
    {
        echo"aqui va el formulario para actualizar el producto ";
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Producto  $producto
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Producto $producto)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Producto  $producto
     * @return \Illuminate\Http\Response
     */
    public function destroy(Producto $producto)
    {
        //
    }
}
