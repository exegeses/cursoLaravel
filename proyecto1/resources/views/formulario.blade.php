@extends('layouts.plantilla')

    @section('contenido')

        <h1>Formulario de envío</h1>

        <div class="bg-light border col-8 mx-auto p-4">

            <form action="/procesarDatos" method="post">
                @csrf

                Nombre: <br>
                <input type="text" name="nombre" class="form-control">
                <br>
                <button class="btn btn-dark btn-block">Enviar datos</button>
            </form>
        </div>

    @endsection
