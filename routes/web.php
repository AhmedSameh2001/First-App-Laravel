<?php

use App\Http\Controllers\SliderController;
use App\Http\Controllers\PortfiloController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\ClintController;
use App\Http\Controllers\TestimonialController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Route::get('/', function () {
//     return view('welcome');
// });

// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');

// Route::middleware('auth')->group(function () {
//     Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
//     Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
//     Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
// });

// require __DIR__.'/auth.php';

    Route::view('/','BazzarLayout.starter')->name('home');

Route::prefix('bazzar/admin')->group(function(){

    // Route::view('/sliders','BazzarLayout.SliderLayout.index')->name('slider.index');
    // Route::view('/clints','BazzarLayout.ClintLayout.index')->name('clint.index');
    // Route::view('/portfolio','BazzarLayout.PortfolioLayout.index')->name('portfolio.index');
    // Route::view('/service','BazzarLayout.ServiceLayout.index')->name('service.index');
    // Route::view('/testimonial','BazzarLayout.TestimonialLayout.index')->name('testimonial.index');

    // Route::post('/sliders-create',[SliderController::class,'create'])->name('slider.create');
    // Route::view('/clints-create','BazzarLayout.ClintLayout.create')->name('clint.create');
    // Route::view('/portfolio-create','BazzarLayout.PortfolioLayout.create')->name('portfolio.create');
    // Route::view('/service-create','BazzarLayout.ServiceLayout.create')->name('service.create');
    // Route::view('/testimonial-create','BazzarLayout.TestimonialLayout.create')->name('testimonial.create');

    // Route::view('/sliders-destroy/{id}','BazzarLayout.SliderLayout.destroy')->name('slider.destroy');
    // Route::view('/clints-destroy/{id}','BazzarLayout.ClintLayout.destroy')->name('clint.destroy');
    // Route::view('/portfolio-destroy/{id}','BazzarLayout.PortfolioLayout.destroy')->name('portfolio.destroy');
    // Route::view('/service-destroy/{id}','BazzarLayout.ServiceLayout.destroy')->name('service.destroy');
    // Route::view('/testimonial-destroy/{id}','BazzarLayout.TestimonialLayout.destroy')->name('testimonial.destroy');

    // Route::view('/sliders-edit/{id}','BazzarLayout.SliderLayout.edit')->name('slider.edit');
    // Route::view('/clints-edit/{id}','BazzarLayout.ClintLayout.edit')->name('clint.edit');
    // Route::view('/portfolio-edit/{id}','BazzarLayout.PortfolioLayout.edit')->name('portfolio.edit');
    // Route::view('/service-edit/{id}','BazzarLayout.ServiceLayout.edit')->name('service.edit');
    // Route::view('/testimonial-edit/{id}','BazzarLayout.TestimonialLayout.edit')->name('testimonial.edit');

    Route::resource('sliders', SliderController::class);
    Route::resource('clints', ClintController::class);
    Route::resource('portfilo', PortfiloController::class);
    Route::resource('testimonial', TestimonialController::class);
    Route::resource('services', ServiceController::class);
});
