@extends('layouts.plantilla')

    @section('contenido')

        <h1>Panel de administración de marcas</h1>

        @if ( session('mensaje') )
            <div class="alert alert-success">
                {{ session('mensaje') }}
            </div>
        @endif

        <table class="table table-bordered table-striped table-hover">
            <thead class="thead-dark">
                <tr>
                    <th>#</th>
                    <th>Región</th>
                    <th colspan="2">
                        <a href="/agregarMarca" class="btn btn-dark">
                            Agregar
                        </a>
                    </th>
                </tr>
            </thead>
            <tbody>
        @foreach( $marcas as $marca )
                <tr>
                    <td>{{ $marca->idMarca }}</td>
                    <td>{{ $marca->mkNombre }}</td>
                    <td>
                        <a href="/modificarMarca" class="btn btn-outline-secondary">
                            Modificar
                        </a>
                    </td>
                    <td>
                        <a href="/eliminarMarca" class="btn btn-outline-secondary">
                            Eliminar
                        </a>
                    </td>
                </tr>
        @endforeach

            </tbody>
        </table>

        {{ $marcas->links() }}

    @endsection
