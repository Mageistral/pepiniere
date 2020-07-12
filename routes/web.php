<?php

use App\Http\Controllers\FrontController;
use App\Models\Rootstock;
use App\Models\RootstocksVigours;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Route;

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

Route::get('/', 'FrontController@main');

Route::get('/{fruit_name}/{fruit_id}', 'FrontController@mainFruit')
     ->where('fruit_name', '^[a-z]+$')
     ->where('fruit_id', '^[0-9]+$');

Route::get('error', 'FrontController@error');

Route::get('test-model-snake', function() {
    dd(App::make('App\Models\Rootstock')->getTable());
});
Route::get('test-specs', function() {
    $f = new FrontController();
    $specs = $f->getAllSpecificities(Rootstock::all());
    $cats = $f->getAllCategories($specs);
    dd($cats);
});
Route::get('test-compute-vigour', function() {
    $rv = RootstocksVigours::find(10); // 200 à la base
    $rv->ratio = $rv->ratio;
    $rv->save();
    // dd( Rootstock::find(2)->vigours_as_source );
    // dd($cats);
});
Route::get('recompute-all-vigours', function() {
    $rootstocks = Rootstock::all();
    foreach ($rootstocks as $rootstock) {
        $rootstock->computeVigour();
        $rootstock->save();
    }
});
