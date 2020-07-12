<?php

// --------------------------
// Custom Backpack Routes
// --------------------------
// This route file is loaded automatically by Backpack\Base.
// Routes you generate using Backpack\Generators will be placed here.

use Illuminate\Support\Facades\Route;

Route::group([
    'prefix'     => config('backpack.base.route_prefix', 'admin'),
    'middleware' => ['web', config('backpack.base.middleware_key', 'admin')],
    'namespace'  => 'App\Http\Controllers\Admin',
], function () { // custom admin routes
    Route::crud('rootstock', 'RootstockCrudController');
    Route::crud('fruit', 'FruitCrudController');
    Route::crud('region', 'RegionCrudController');
    Route::crud('developer', 'DeveloperCrudController');
    Route::crud('rootstocksVigours', 'RootstocksVigoursCrudController');
    Route::crud('level', 'LevelCrudController');
    Route::crud('specificityCategory', 'SpecificityCategoryCrudController');
    Route::crud('specificity', 'SpecificityCrudController');
    Route::crud('rootstockSpecificityLevel', 'RootstockSpecificityLevelCrudController');
    Route::crud('variety', 'VarietyCrudController');
}); // this should be the absolute last line of this file