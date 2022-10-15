<?php

use App\Http\Controllers\PublicListController;
use App\Http\Controllers\SecretListController;
use App\Models\SecretList;
use Illuminate\Foundation\Application;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

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
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
    ]);
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return Inertia::render('Dashboard', [
            'lists'=> Auth::user()->SecretList()->get(),
        ]);
    })->name('dashboard');

    Route::post('/secretList/store', [SecretListController::class, 'store'])->name('List.store');
    Route::post('/secretList/{secretList}/show', [SecretListController::class, 'store'])->name('List.show');
    Route::post('/secretList/{secretList}/delete', [SecretListController::class, 'destroy'])->name('List.destroy');
    Route::post('/secretList/{secretList}/update', [SecretListController::class, 'update'])->name('List.update');
    //Generates the signed URL
    Route::get('/generateList/{secretList}', [SecretListController::class,'show'])->name('List.generateUrl');
});


//public routes

//get's the signed URL
Route::get('/list/{secretList}', [PublicListController::class, 'index'])->name('public.index');
Route::post('/secretList/{secretList}/update', [PublicListController::class, 'update'])->name('public.list.update');

