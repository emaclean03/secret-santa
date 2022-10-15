<?php

namespace App\Http\Controllers;

use App\Models\SecretList;
use Illuminate\Http\Request;
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
     switch ($request->field){
         case 'full_name':
             $secretList->participant()->where('id', $request->id)->update(['full_name'=>$request->value]);
             break;
         case 'email':
             $secretList->participant()->where('id', $request->id)->update(['email'=>$request->value]);
             break;
     }
    }
}
