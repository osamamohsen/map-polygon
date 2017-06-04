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

Route::get('/map', function () {
    return view('map.map');
});

Route::post('/map/zone/store',function (\Illuminate\Http\Request $request){
    try{
        $res = \App\Zone::create($request->all());
        return ["msg" => $res];
    }catch (Exception $ex) {
        return ['exp' => $ex];
    }
});

Route::get('/all',function(){
    $query = \App\Zone::where('id',2)->get();
    return $query;
});

Route::post('/map/polygons',function (){
    $polygons = \App\Zone::all();
    return ['polygons' => $polygons];
});