@extends('layouts.plantilla')

    @section('contenido')

        <h1>Alta de una nueva categoría</h1>

        <div class="alert bg-light border col-8 mx-auto p-4">
            <form action="/agregarCategoria" method="post">
                @csrf
                <input type="text" name="catNombre"
                       placeholder="Ingrese nombre de categoría"
                       class="form-control">
                <button class="btn btn-dark mt-3">
                    Agregar categoría
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
