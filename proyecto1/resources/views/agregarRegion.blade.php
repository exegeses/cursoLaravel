@extends('layouts.plantilla')

    @section('contenido')
        <h1>Alta de una nueva región</h1>

        <div class="bg-light p-4 border col-8 mx-auto">
            <form action="/agregarRegion" method="post">
                @csrf
                Nombre de la región: <br>
                <input type="text" name="regNombre" class="form-control">
                <br>
                <button class="btn btn-dark">Agregar región</button>
                <a href="/adminRegiones" class="btn btn-outline-secondary">
                    volver
                </a>
            </form>
        </div>

    @endsection
