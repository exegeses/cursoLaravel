<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

//Route::get( 'peticion', proceso );
Route::get( '/hola', function(){
    return 'Hola Mundo desde Laravel';
} );

Route::get('/inicio/{nombre}', function ($nombre){
    return view('inicio', [ 'nombre' => $nombre  ]);
});

#############################
### motor de plantillas blade
Route::view('/test', 'prueba');
Route::view('/form', 'formulario');
Route::post('/procesarDatos', function (){
    $nombre = $_POST['nombre']; // captura de dato desde form
    $anio = $_POST['anio'];
    /*
        falta pasar dato a la view
        y haremos usando un array asociativo
    */
    return view('procesarDatos',
                [
                    'nombre' => $nombre,
                    'anio' => $anio
                ]
            );
});

#################
## BASE DE DATOS usando RawSQL
Route::get('/regiones', function (){
    $regiones = DB::select(
                            'SELECT regID, regNombre
                                FROM regiones'
                          );
    return view('adminRegiones',
                        [ 'regiones'=> $regiones ]
                );
});

#listado de destinos
Route::get('/destinos', function (){
    $destinos = DB::select(
                            'SELECT
                                    destID, destNombre,
                                    d.regID, regNombre,
                                    destPrecio,
                                    destAsientos, destDisponibles
                                FROM destinos d, regiones r
                                WHERE d.regID = r.regID'
                        );
    return view('adminDestinos',
                    [ 'destinos' => $destinos ]
                );
});
# Raw SQL
####
/* select()
 * insert()
 * update()
 * delete()
 */
Route::view('/agregarRegion', 'agregarRegion');

Route::post('/agregarRegion', function (){
    $regNombre = $_POST['regNombre'];
    DB::insert(
                'INSERT INTO regiones
                        ( regNombre )
                    VALUES
                        ( ? )', [$regNombre]
    );

    return redirect('/regiones');
});

Route::get('/modificarRegion/{regID}', function ($regID){
    //obtenemos datos de la region
    $region = DB::select(
                            'SELECT regNombre, regID
                                FROM regiones
                                WHERE regID = :regID
                                ',  [ 'regID' => $regID ]
                            );

    //retornamos la vista pasando datos de la región
    return view('modificarRegion', [ 'region'=>$region ] );
});

Route::post('/modificarRegion', function(){
    //capturar datos enviados por el form

    // modificar

    //redirigir a adminRegiones + mensaje de ok

});
