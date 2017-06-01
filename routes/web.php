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

    $res = DB::table('zone')->insert(
        array(
            'polygon'     =>   "GeomFromText('POLYGON((31.36753147859411 29.97596614896632,31.36753147859411 29.97596614896632))',0)"
        )
    );
    return $res;
//    $polycoords = "INSERT INTO  'zone` (  `polygon` )
//VALUES (
//GEOMFROMTEXT( 'polygon(
//(39.593254951279626 -119.2415714263916,
// 39.596231192849004 -119.2441463470459,
// 39.59742165367196 -119.2287826538086,
// 39.601786501640284 -119.24200057983398,
// 39.604497859585535 -119.23067092895508,
// 39.60608494668563 -119.23830986022949,
// 39.593254951279626 -119.2415714263916)))'))";
//    $result = DB::raw('GeomFromText(\'POLYGON('.$polycoords.')\');

//    DB::raw("INSERT INTO zone ('polygon', 'created_at', 'updated_at') VALUES (INSERT INTO `zgoMap`.`zone` (`id`, `polygon`, `created_at`, `updated_at`) VALUES (NULL, GeomFromText('POLYGON((31.36753147859411 29.97596614896632,31.37704249141983 29.97139955695229,31.39108710522393 29.97143992706165,31.39976169403131 29.97214936062918,31.41602249779077 29.96952129093473,31.42310554318841 29.97003391000997,31.43059285316837 29.9707382168464,31.43950372077378 29.97161015157772,31.446467499927 29.97230788872903,31.45184590708535 29.97486691230406,31.46032248203688 29.97531142060642,31.467526426976 29.97054084645724,31.47353564236753 29.96650895413893,31.48400706377413 29.95985176486366,31.49555808481764 29.95322016245858,31.49992320331422 29.95109533689144,31.50359773116471 29.94955922516613,31.50494862291293 29.97380073142309,31.51182580433643 29.97675166143872,31.53806013442498 29.99035037742867,31.53517839229507 29.99823214259419,31.52308196973162 30.0116107275499,31.53056241291996 30.02431263327387,31.52832067991469 30.0370417376763,31.52562757499622 30.04073271656583,31.5383447490547 30.05856803661489,31.54152404475153 30.07148142659928,31.53790931497329 30.08805614815982,31.51999145193043 30.08785745574176,31.50513284866899 30.08522717425438,31.49060359419499 30.0864052500907,31.47338979102927 30.08606584899567,31.45859762284662 30.08116546632579,31.44268513561069 30.07974473190951,31.43185468082785 30.07726589636477,31.41544788073617 30.06140071748932,31.40798080090505 30.05163395821404,31.40070458149106 30.0172474343796,31.39881317328457 30.00455281308362,31.39082204092872 29.99660033228181,31.38034341365496 29.99254020016399,31.37187244140882 29.98906879593762,31.36632837173136 29.98537603992986,31.36753147859411 29.97596614896632))',0),NULL,NULL)")
////    $result = DB::insert( DB::raw("INSERT INTO users ('name','email','password') VALUES('osama','osamamohsen@gmail.com','123456')"));
//    return ['res' => $result];
//    try{
//        $points = $request->get('points');
//        $polygon = "'\'POLYGON((";
//        $polygon .= $points[0]['lat'].' '.$points[0]['lng'];
//        foreach(range(1,sizeof($points) -1 ) as $index){
//            $polygon .= ','.$points[$index]['lat'].' '.$points[$index]['lng'];
//        }
//        $polygon .= "))\',0";
////        $results = DB::select( DB::raw("INSERT INTO zone ('polygon', 'created_at', 'updated_at') VALUES (INSERT INTO `zgoMap`.`zone` (`id`, `polygon`, `created_at`, `updated_at`) VALUES (NULL, GeomFromText('POLYGON((31.36753147859411 29.97596614896632,31.37704249141983 29.97139955695229,31.39108710522393 29.97143992706165,31.39976169403131 29.97214936062918,31.41602249779077 29.96952129093473,31.42310554318841 29.97003391000997,31.43059285316837 29.9707382168464,31.43950372077378 29.97161015157772,31.446467499927 29.97230788872903,31.45184590708535 29.97486691230406,31.46032248203688 29.97531142060642,31.467526426976 29.97054084645724,31.47353564236753 29.96650895413893,31.48400706377413 29.95985176486366,31.49555808481764 29.95322016245858,31.49992320331422 29.95109533689144,31.50359773116471 29.94955922516613,31.50494862291293 29.97380073142309,31.51182580433643 29.97675166143872,31.53806013442498 29.99035037742867,31.53517839229507 29.99823214259419,31.52308196973162 30.0116107275499,31.53056241291996 30.02431263327387,31.52832067991469 30.0370417376763,31.52562757499622 30.04073271656583,31.5383447490547 30.05856803661489,31.54152404475153 30.07148142659928,31.53790931497329 30.08805614815982,31.51999145193043 30.08785745574176,31.50513284866899 30.08522717425438,31.49060359419499 30.0864052500907,31.47338979102927 30.08606584899567,31.45859762284662 30.08116546632579,31.44268513561069 30.07974473190951,31.43185468082785 30.07726589636477,31.41544788073617 30.06140071748932,31.40798080090505 30.05163395821404,31.40070458149106 30.0172474343796,31.39881317328457 30.00455281308362,31.39082204092872 29.99660033228181,31.38034341365496 29.99254020016399,31.37187244140882 29.98906879593762,31.36632837173136 29.98537603992986,31.36753147859411 29.97596614896632))',0),NULL,NULL)") );
//        return ["msg" => $polygon];
//
//        \App\Zone::create(['polygon' => $polygon]);
//        return ["msg" => $polygon];
//    }catch (Exception $ex){
//        return ['exp' => $ex];
//    }

});