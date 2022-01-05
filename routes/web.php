<?php

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



Route::get('/dashboard', function () {
    return view('layouts.dashboard');
});

Auth::routes([
    'register' => false
]);

Route::get('/', function () {
    return redirect(route('login'));
});

//Route::get('/', [App\Http\Controllers\DashboardController::class, 'index'])->name('dashboard.index');



Route::group(['prefix' => 'dashboard', 'middleware' => ['auth', 'throttle:60,1']], function () {
    Route::get('/', [App\Http\Controllers\DashboardController::class, 'index'])->name('dashboard.index');
    Route::group(['prefix' => 'filemanager'], function () {
        Route::get('/folder', [App\Http\Controllers\FileManagerController::class, 'index'])->name('filemanager.index');
        \UniSharp\LaravelFilemanager\Lfm::routes();
    });
    Route::get('/profile', [App\Http\Controllers\ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [App\Http\Controllers\ProfileController::class, 'update'])->name('profile.update');

    Route::get('/password', [App\Http\Controllers\PasswordController::class, 'edit'])->name('password.edit');
    Route::patch('/password', [App\Http\Controllers\PasswordController::class, 'updatePassword'])->name('password.updatePassword');

    //Roles Route
    Route::get('/roles/select', [App\Http\Controllers\RoleController::class, 'select'])->name('roles.select');
    Route::resource('/roles', \App\Http\Controllers\RoleController::class);

    //User Route
    Route::resource('/users', \App\Http\Controllers\UserController::class);

    //Banner Route
    Route::resource('/banners', \App\Http\Controllers\BannerController::class);

    //City Route
    Route::get('/city/select', [App\Http\Controllers\CityController::class, 'select'])->name('city.select');
    Route::resource('/city', \App\Http\Controllers\CityController::class);

    //Region Route
    Route::get('/region/select', [App\Http\Controllers\RegionController::class, 'select'])->name('region.select');
    Route::resource('/region', \App\Http\Controllers\RegionController::class);

    //Category Post Route
    Route::get('/categories-post/select', [App\Http\Controllers\CategoriesPostController::class, 'select'])->name('categoriespost.select');
    Route::resource('/categories-post', App\Http\Controllers\CategoriesPostController::class);

    //Tag Post Route
    Route::get('/tags/select', [App\Http\Controllers\TagController::class, 'select'])->name('tags.select');
    Route::resource('/tags', App\Http\Controllers\TagController::class);

    //Post Route
    Route::resource('/posts', App\Http\Controllers\PostController::class);

    //Category Gallery Route
    Route::get('/categories-gallery/select', [App\Http\Controllers\CategoriesGalleryController::class, 'select'])->name('categoriesgallery.select');
    Route::resource('/categories-gallery', App\Http\Controllers\CategoriesGalleryController::class);

    //Gallery Route
    Route::resource('/gallery', App\Http\Controllers\GalleryController::class);

    //Partner Route
    Route::resource('/partner', App\Http\Controllers\PartnerController::class);

    //Market Route
    Route::get('/markets/select', [App\Http\Controllers\MarketController::class, 'select'])->name('markets.select');
    Route::resource('/market', App\Http\Controllers\MarketController::class);

    //Category Food Route
    Route::get('/categories-food/select', [App\Http\Controllers\CategoriesFoodController::class, 'select'])->name('categoriesfood.select');
    Route::resource('/categories-food', App\Http\Controllers\CategoriesFoodController::class);

    //Stall Route
    Route::delete('/deleteimagestall/{id}',  [App\Http\Controllers\StallController::class, 'deleteimagestall'])->name('stall.deleteimagestall');
    Route::resource('/stall', App\Http\Controllers\StallController::class);

    //Rental Route
    Route::delete('/deleteimage/{id}',  [App\Http\Controllers\RentalController::class, 'deleteimage'])->name('rental.deleteimage');
    Route::resource('/rental', App\Http\Controllers\RentalController::class);

    //Promo Route
    Route::resource('/promo', App\Http\Controllers\PromoController::class);
    Route::resource('/banner-promo', App\Http\Controllers\BannerPromoController::class);

    //Catalog Route
    Route::resource('/catalog', App\Http\Controllers\CatalogController::class);

    // Meta Route
    Route::resource('/metas', App\Http\Controllers\MetaController::class);

    //Flash News Route
    Route::resource('/flash-news', App\Http\Controllers\FlashNewsController::class);

    //File Manager Route 
    Route::group(['prefix' => 'filemanager'], function () {
        Route::get('/folder', [App\Http\Controllers\FileManagerController::class, 'index'])->name('filemanager.index');
        \UniSharp\LaravelFilemanager\Lfm::routes();
    });

    //Category Team Route
    Route::get('/categories-team/select', [App\Http\Controllers\CategoriesTeamController::class, 'select'])->name('categoriesteam.select');
    Route::resource('/categories-team', \App\Http\Controllers\CategoriesTeamController::class);

    //Team Route
    Route::resource('/team', \App\Http\Controllers\TeamController::class);
});
