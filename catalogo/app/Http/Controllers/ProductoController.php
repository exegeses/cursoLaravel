<?php

namespace App\Http\Controllers;

use App\Categoria;
use App\Marca;
use App\Producto;
use Illuminate\Http\Request;

class ProductoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //generamos listado de productos *
        $productos = Producto::with('relMarca', 'relCategoria')->paginate(8);

        //retornamos vista con datos
        return view('adminProductos', [ 'productos' => $productos ] );
    }


    public function validar(Request $request)
    {
        $request->validate(
            [
                'prdNombre'=>'required|min:3|max:70',
                'prdPrecio'=>'required|numeric|min:0',
                'prdPresentacion'=>'required|min:3|max:150',
                'prdStock'=>'required|integer|min:1',
                'prdImagen'=>'mimes:jpg,jpeg,png,gif,svg,webp|max:2048'
            ],
            [
                'prdNombre.required'=>'Complete el campo Nombre',
                'prdNombre.min'=>'Complete el campo Nombre con al menos 3 caractéres',
                'prdNombre.max'=>'Complete el campo Nombre con 70 caractéres como máxino',
                'prdPrecio.required'=>'Complete el campo Precio',
                'prdPrecio.numeric'=>'Complete el campo Precio con un número',
                'prdPrecio.min'=>'Complete el campo Precio con un número positivo',
                'prdPresentacion.required'=>'Complete el campo Presentación',
                'prdPresentacion.min'=>'Complete el campo Presentación con al menos 3 caractéres',
                'prdPresentacion.max'=>'Complete el campo Presentación con 150 caractérescomo máxino',
                'prdStock.required'=>'Complete el campo Stock',
                'prdStock.integer'=>'Complete el campo Stock con un número entero',
                'prdStock.min'=>'Complete el campo Stock con un número positivo',
                'prdImagen.mimes'=>'Debe ser una imagen',
                'prdImagen.max'=>'Debe ser una imagen de 2MB como máximo'
            ]
        );
    }

    /**
     * Sube un archivo de imagen si fue enviada
     *
     * @param  \Illuminate\Http\Request  $request
     * @return string $prdImagen
     * */

    public function subirImagen(Request $request)
    {
        //si no enviaron archivo
        $prdImagen = 'noDisponible.jpg';

        //si enviaron archivo
        if( $request->file('prdImagen') ){
            //renombrar archivo
                # time().extension
            $prdImagen = time().'.'.$request->file('prdImagen')->clientExtension();

            //subir imagen a directorio productos
            $request->file('prdImagen')
                            ->move( public_path('productos/'), $prdImagen );
        }
        return $prdImagen;
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //obttenemos listados de marcas y categorias
        $marcas = Marca::all();
        $categorias = Categoria::all();

        return view('agregarProducto',
            [
                'marcas' => $marcas,
                'categorias' => $categorias
            ]
        );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //validacion
        $this->validar($request);

        //subir imagen
        $prdImagen = $this->subirImagen($request);

        //instanciar + guardar

        //redirigir con mensaje de ok
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Producto  $producto
     * @return \Illuminate\Http\Response
     */
    public function show(Producto $producto)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Producto  $producto
     * @return \Illuminate\Http\Response
     */
    public function edit(Producto $producto)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Producto  $producto
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Producto $producto)
    {
        //
    }

    public function confirmarBaja($id)
    {
        $Producto = Producto::with('relCategoria','relMarca')->find($id);

        return view('eliminarProducto', ['producto'=>$Producto]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Producto  $producto
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $Producto = Producto::find($request->input('idProducto'));
        $prdNombre = $Producto->prdNombre;
        //$Producto->delete();
        return redirect('/adminProductos')
                ->with('mensaje', 'Producto: '.$prdNombre.' eliminado correctamente');
    }
}
