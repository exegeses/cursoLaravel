<?php

namespace App\Http\Controllers;

use App\Categoria;
use Illuminate\Http\Request;

class CategoriaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categorias = Categoria::paginate(7);
        return view('adminCategorias', [ 'categorias'=>$categorias ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('agregarCategoria');
    }

    public function validar(Request $request)
    {
        $request->validate(
            [
                'catNombre'=>'required|min:2|max:50'
            ],
            [
                'catNombre.required'=>'El campo Nombre es obligatorio',
                'catNombre.min'=>'El campo Nombre debe tener al menos 2 caractéres',
                'catNombre.max'=>'El campo Nombre debe tener 50 caractéres como máximo'
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
        $catNombre = $request->input('catNombre');
        //validación
        $this->validar($request);

        //guardamos
        $Categoria = new Categoria;
        $Categoria->catNombre = $catNombre;
        $Categoria->save();

        return redirect('/adminCategorias')
                    ->with('mensaje', 'Categoría: '.$catNombre. ' agregada correctamente.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //obtenemos datos de la categoría
        $Categoria = Categoria::find($id);
        //retornamos la vista del form con esos datos
        return view('modificarCategoria',
                        [
                            'categoria'=>$Categoria
                        ]
                    );
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        //capturamos datos enviados por el form
        $catNombre = $request->input('catNombre');
        //validación
        $this->validar($request);

        //obtenemos datos de la categoría
        $Categoria = Categoria::find( $request->input('idCategoria') );
        //modificamos
        $Categoria->catNombre = $catNombre;
        $Categoria->save();
        //retornamos vista con mensaje de confirmación
        return redirect('adminCategorias')
                    ->with('mensaje', 'Categoría: '.$catNombre.' modificada correctamente.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
