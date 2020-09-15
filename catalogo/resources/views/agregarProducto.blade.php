@extends('layouts.plantilla')

@section('contenido')


        <h1>Alta de un nuevo producto</h1> 

        <div class="alert bg-light p-3 border">
            <form action="/agregarProducto" method="post" enctype="multipart/form-data">
                @csrf
                Nombre: <br>
                <input type="text" name="prdNombre" class="form-control">
                <br>
                Precio: <br>
                <div class="input-group mb-2">
                    <div class="input-group-prepend">
                        <div class="input-group-text">$</div>
                    </div>
                    <input type="number" name="prdPrecio" class="form-control">
                </div>
                <br>
                Marca: <br>
                <select name="idMarca" class="form-control" required>
                    <option value="">Seleccione una marca</option>
                </select>
                <br>
                Categoría: <br>
                <select name="idCategoria" class="form-control" required>
                    <option value="">Seleccione una Categoría</option>
                </select>
                <br>
                Presentacion: <br>
                <textarea name="prdPresentacion" class="form-control"></textarea>
                <br>
                Stock: <br>
                <input type="number" name="prdStock" class="form-control" min="0">
                <br>
                Imagen: <br>
                <input type="file" name="prdImagen" class="form-control">
                <br>
                <input type="submit" value="Agregar Producto" class="btn btn-secondary mb-3">
                <a href="/adminProductos" class="btn btn-light mb-3">Volver al panel de Productos</a>
            </form>

        </div>

   @endsection

