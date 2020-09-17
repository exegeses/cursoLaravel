@extends('layouts.plantilla')

    @section('contenido')

        <h1>Baja de un producto</h1>

        <div class="row alert bg-light border-danger col-8 mx-auto p-2">
            <div class="col">
                <img src="/productos/{{ $producto->prdImagen }}" class="img-thumbnail">
            </div>
            <div class="col text-danger align-self-center">
            <form action="/eliminarProducto" method="post">
                @csrf
                @method('delete')
                <h2>{{ $producto->prdNombre }}</h2>
                Categoría: {{ $producto->relCategoria->catNombre }} <br>
                Marca:  {{ $producto->relMarca->mkNombre }} <br>
                Presentación: {{ $producto->prdPresentacion }} <br>
                Precio: ${{ $producto->prdPrecio }}

                <input type="hidden" name="idProducto"
                       value="{{ $producto->idProducto }}">
                <button class="btn btn-danger btn-block my-3">Confirmar baja</button>
                <a href="/adminProductos" class="btn btn-outline-secondary btn-block">
                    Volver a panel
                </a>

            </form>
            </div>
        </form>

            <script>
                Swal.fire({
                    title: '¿Desea eliminar el producto?',
                    text: "Esta acción no se puede deshacer.",
                    type: 'error',
                    showCancelButton: true,
                    cancelButtonColor: '#8fc87a',
                    cancelButtonText: 'No, no lo quiero eliminar',
                    confirmButtonColor: '#d00',
                    confirmButtonText: 'Si, lo quiero eliminar'
                }).then((result) => {
                    if (!result.value) {
                        //redirección a adminProductos
                        window.location = '/adminProductos'
                    }
                })
            </script>


    @endsection
