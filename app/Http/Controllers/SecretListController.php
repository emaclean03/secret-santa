<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreSecretListRequest;
use App\Http\Requests\UpdateSecretListRequest;
use App\Models\Participant;
use App\Models\SecretList;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\URL;
use Inertia\Inertia;

class SecretListController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreSecretListRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreSecretListRequest $request)
    {
      $list = SecretList::create([
           'list_name' => 'This is a test',
           'name' => Auth::user()->name,
           'email' => Auth::user()->email,
           'user_id' => Auth::user()->id,
       ]);


        foreach ($request->participantNames as $name){
           $participant = Participant::make([
               'full_name'=>$name['name'],
           ]);
           $list->participant()->save($participant);
        }

        Auth::user()->SecretList()->attach($list);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\SecretList  $secretList
     * @return \Inertia\Response
     */
    public function show(SecretList $secretList)
    {
        return Inertia::render('AuthenticatedSecretList/SecretList', [
            'list'=> $secretList,
            'participants'=>$secretList->participant()->get(),
            'signedUrl'=>URL::signedRoute('public.generateUrl', $secretList->id)
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\SecretList  $secretList
     * @return \Illuminate\Http\Response
     */
    public function edit(SecretList $secretList)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateSecretListRequest  $request
     * @param  \App\Models\SecretList  $secretList
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateSecretListRequest $request, SecretList $secretList)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\SecretList  $secretList
     * @return \Illuminate\Http\Response
     */
    public function destroy(SecretList $secretList)
    {
        $secretList->delete();
    }
}
