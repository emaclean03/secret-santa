<?php

namespace App\Http\Controllers;

use App\Models\SecretList;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;

class PublicListController extends Controller
{
    public function index(Request $request, SecretList $secretList)
    {
        if (! $request->hasValidSignature()) {
            abort(401);
        }

        return Inertia::render('PublicSecretList/index', [
            'list'=> $secretList,
            'participants'=>$secretList->participant()->get(),
        ]);
    }

    public function update(Request $request, SecretList $secretList)
    {

    }
}
