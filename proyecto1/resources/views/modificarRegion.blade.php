@extends('layouts.plantilla')

    @section('contenido')
        <h1>Modificación de una región</h1>

        <div class="bg-light p-4 border col-8 mx-auto">
            <form action="/modificarRegion" method="post">
                @csrf
                Nombre de la región: <br>
                <input type="text" name="regNombre"
                       value="{{ $region[0]->regNombre }}"
                       class="form-control">
                <input type="hidden" name="regID"
                       value="{{ $region[0]->regID }}">
                <br>
                <button class="btn btn-dark">Modificar región</button>
                <a href="/adminRegiones" class="btn btn-outline-secondary">
                    volver
                </a>
            </form>
        </div>

    @endsection
