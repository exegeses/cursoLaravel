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

Route::get('/mostrar/{x}/{y}', function($region, $subregion){
    $mensaje = 'Region: '.$region.'<br>';
    $mensaje .= 'Subregión: '.$subregion;
    return $mensaje;
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
Route::get('/destinos-OLD', function (){
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

    return redirect('/regiones')
        ->with('mensaje', 'Región: '.$regNombre.' agregada correctamente');;
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
    $regID = $_POST['regID'];
    $regNombre = $_POST['regNombre'];
    // modificar
    DB::update(
                'UPDATE regiones
                    SET regNombre = ?
                    WHERE regID = ?', [ $regNombre, $regID  ]
            );
    //redirigir a adminRegiones + mensaje de ok (flashing)
    return redirect('/regiones')
            ->with('mensaje', 'Región: '.$regNombre.' modificada correctamente');
});
#############################
#### Fluent Query Builder
Route::get( '/destinos', function(){
    //$destinos = DB::table('destinos')->get(); // cómo fetchAll()
    //$destinos = DB::table('destinos')
      //                  ->where('destID', 8)
      //                  ->first();  //  cómo fetch()
    $destinos = DB::table('destinos as d')
                    ->join('regiones as r', 'd.regID', '=', 'r.regID')
                    ->get();

    return view('adminDestinos',
                    [ 'destinos' => $destinos ]
                );
} );

Route::get('/agregarDestino', function(){
    //obtener listado de regiones
    $regiones = DB::table('regiones')->get();

    //retornarmos vista + le pasamos regiones
    return view('formAgregarDestino',
                    [ 'regiones' => $regiones ]
    );
});

Route::post('/agregarDestino', function (){
    //capturar datos
    $destNombre = $_POST['destNombre'];
    $regID = $_POST['regID'];
    $destPrecio = $_POST['destPrecio'];
    $destAsientos = $_POST['destAsientos'];
    $destDisponibles = $_POST['destDisponibles'];

    //insertar en table
    DB::table('destinos')->insert(
            [
                'destNombre' => $destNombre,
                'destPrecio' => $destPrecio,
                'regID' => $regID,
                'destAsientos' => $destAsientos,
                'destDisponibles' => $destDisponibles
            ]
    );
    //reporte
    return redirect('/destinos')
            ->with(
                [
                    'mensaje'=>'Destino: '.$destNombre.' agregado correctamente'
                ]
            );
});

Route::get('/modificarDestino/{destID}', function ($destID){
    //obtenemos datos del destino
    $destino = DB::table('destinos as d')
                ->join('regiones as r', 'd.regID', '=', 'r.regID')
                ->where('destID',$destID)
                ->first();

    //obtenemos listado de regiones
    $regiones = DB::table('regiones')->get();

    //retornamos form + pasamos datos del destino + listado de destinos
    return view('formModificarDestino',
                [
                    'destino' => $destino,
                    'regiones' => $regiones
                ]
            );
});

Route::post('/modificarDestino', function(){
    //capturamos datos
    $destNombre = $_POST['destNombre'];
    $regID = $_POST['regID'];
    $destPrecio = $_POST['destPrecio'];
    $destAsientos = $_POST['destAsientos'];
    $destDisponibles = $_POST['destDisponibles'];
    $destID = $_POST['destID'];

    //modificar
    DB::table('destinos')
            ->where('destID', $destID)
            ->update(
                [
                    'destNombre' => $destNombre,
                    'destPrecio' => $destPrecio,
                    'regID' => $regID,
                    'destAsientos' => $destAsientos,
                    'destDisponibles' => $destDisponibles
                ]
            );
    //retornar + informe ok
    return redirect('/destinos')
        ->with(
            [
                'mensaje'=>'Destino: '.$destNombre.' modificado correctamente'
            ]
        );
});
