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
use Illuminate\Support\Facades\DB;

Route::post('/map/zone/store',function (\Illuminate\Http\Request $request){

    try{
        $points = $request->get('points');
        $res = \App\Zone::create([
            'polygon' => $points
        ]);
        return ["msg" => $res];
    }catch (Exception $ex) {
        return ['exp' => $ex];
    }

});

Route::get('/all',function(){
    $query = \App\Zone::where('id',3)->get();
    return $query;
});

Route::get('/map/item',function(){
    $res = \App\Zone::create([
        'polygon' => \DB::raw("GeomFromText('POLYGON((31.36753147859411 29.97596614896632,31.36753147859411 29.97596614896632))')")
    ]);

    return ['rest'=>$res];
});
