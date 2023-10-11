<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\NoteController;

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


Route::prefix('notes')
->middleware('auth') //middleware(['auth']) 配列でも可
->controller(NoteController::class)
->name('notes.')
->group(function(){
    Route::get('/', 'index')->name('index');
    Route::get('/create', 'create')->name('create');
    Route::post('/', 'store')->name('store');
    Route::get('/edit/{id}', 'edit')->name('edit');
    Route::get('/edit_tag/{tag_id}', 'edit_tag')->name('edit_tag');
    Route::post('/{id}', 'update')->name('update');
    Route::post('/back/{id}', 'back')->name('back');
    Route::post('/destroy/{id}', 'destroy')->name('destroy');
    Route::post('/dust/{id}', 'dust')->name('dust');
    Route::post('/edit_page_dust/{id}', 'edit_page_dust')->name('edit_page_dust');
    Route::get('/dust_item', 'dust_item')->name('dust_item');
   
});


Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
