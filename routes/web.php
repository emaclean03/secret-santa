<?php

use App\Http\Controllers\ParticipantsController;
use App\Http\Controllers\PublicListController;
use App\Http\Controllers\SecretListController;
use App\Models\Participant;
use App\Models\SecretList;
use Illuminate\Foundation\Application;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
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
| Hacktober
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
            'lists'=> SecretList::all(),
        ]);
    })->name('dashboard');

    Route::post('/secretList/store', [SecretListController::class, 'store'])->name('List.store');
    Route::get('/secretList/{secretList}/show', [SecretListController::class, 'show'])->name('List.show');
    Route::post('/secretList/{secretList}/delete', [SecretListController::class, 'destroy'])->name('List.destroy');
    Route::post('/secretList/{secretList}/update', [SecretListController::class, 'update'])->name('List.update');

    //Add a participant to an existing secret list
    Route::post('/participants/{secretList}/store', [ParticipantsController::class, 'store'])->name('Participant.store');

    //Drawing
    Route::post('/secretList/{secretList}/draw', [SecretListController::class, 'drawParticipants'])->name('List.drawParticipants');


    //Update a participant
    Route::post('/participants/{participant}/updateFullName', [ParticipantsController::class, 'updateFullName'])->name('Participant.updateFullName');
    Route::post('/participants/{participant}/updateEmail', [ParticipantsController::class, 'updateEmail'])->name('Participant.updateEmail');
    Route::post('/participants/{participant}/updateExcludeParticipant', [ParticipantsController::class, 'updateExcludeParticipant'])->name('Participant.updateExcludeParticipant');
});


//public routes

//get's the signed URL and returns the public facing index
Route::get('/list/{secretList}', [PublicListController::class, 'index'])->name('public.index');

Route::post('/participants/{participant}/updatePublic', [ParticipantsController::class, 'updatePublic'])->name('public.participant.updateEmail');

//Unsubscribe from emails
Route::get('/unsubscribe/{participant}', function (Request $request, Participant $participant) {
    if (! $request->hasValidSignature()) {
        abort(401);
    }

    $participant->email = null;
    $participant->save();

    echo 'We have removed your email from our email list and will no longer be participating in the Mystery Drawing.';

})->name('public.unsubscribe');