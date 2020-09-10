@extends('layouts.plantilla')

    @section('contenido')

        <h1>Modificación de una categoría</h1>

        <div class="alert bg-light border col-8 mx-auto p-4">
            <form action="/modificarCategoria" method="post">
                @csrf
                @method('patch')
                <input type="text" name="catNombre"
                       value="{{ $categoria->catNombre }}"
                       placeholder="Ingrese nombre de categoría"
                       class="form-control">
                <input type="hidden" name="idCategoria"
                       value="{{ $categoria->idCategoria }}">
                <button class="btn btn-dark mt-3">
                    Modificar categoría
                </button>
            </form>
        </div>

        @if( $errors->any() )
            <div class="alert alert-danger col-8 mx-auto">
                <ul>
                    @foreach( $errors->all() as $error )
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

    @endsection
