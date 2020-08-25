@extends('layouts.plantilla')

    @section('contenido')
        <h1>Panel de administración de destinos</h1>

        <table class="table table-border table-hover table-striped">
            <thead class="thead-dark">
            <tr>
                <th>Destino</th>
                <th>Región</th>
                <th>Precio</th>
                <th>Asientos</th>
                <th>Disponibles</th>
                <th colspan="2">
                    <a href="" class="btn btn-dark">
                        Agregar
                    </a>
                </th>
            </tr>
            </thead>
            <tbody>

            <tr>
                <td>destino</td>
                <td>region</td>
                <td>precio</td>
                <td>asi</td>
                <td>disp</td>
                <td>
                    <a href="" class="btn btn-outline-secondary">
                        Modificar
                    </a>
                </td>
                <td>
                    <a href="" class="btn btn-outline-secondary">
                        Eliminar
                    </a>
                </td>
            </tr>

            </tbody>
        </table>
    @endsection
