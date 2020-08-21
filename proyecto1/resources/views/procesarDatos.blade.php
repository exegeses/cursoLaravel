@extends('layouts.plantilla')

    @section('contenido')

        <h1>Proceso de datos desde form</h1>

        <div class="bg-light border col-8 mx-auto p-4">

                Bienvenido {{ $nombre }} |

                @if( $anio < 2002 )
                    eres mayor
                @else
                    eres menor
                @endif

        </div>

    @endsection
