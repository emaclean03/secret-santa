<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreParticipantsRequest;
use App\Http\Requests\UpdateParticipantsEmailRequest;
use App\Http\Requests\UpdateParticipantsFullNameRequest;
use App\Models\Participant;
use App\Models\SecretList;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\URL;
use Inertia\Inertia;

class ParticipantsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Inertia\Response
     */
    public function index(SecretList $secretList)
    {
        return Inertia::render('AuthenticatedSecretList/DrawParticipants', [
            'list' => $secretList,
            'participants' => $secretList->participant()->get(),
        ]);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\SecretList $secretList
     * @return \Illuminate\Http\Response
     */
    public function drawParticipants(SecretList $secretList): \Illuminate\Http\Response
    {
        return '';
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
     * @param  \App\Http\Requests\StoreParticipantsRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreParticipantsRequest $request, SecretList $secretList)
    {
        $participant = Participant::make(['full_name'=>$request->full_name]);
        $secretList->participant()->save($participant);
        return Redirect::back()->banner('Successfully added ' . $request->full_name);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Participant  $participants
     * @return \Illuminate\Http\Response
     */
    public function show(Participant $participants)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Participant  $participants
     * @return \Illuminate\Http\Response
     */
    public function edit(Participant $participants)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateParticipantsFullNameRequest  $request
     * @param  \App\Models\Participant  $participants
     * @return \Illuminate\Http\Response
     */
    public function updateFullName(UpdateParticipantsFullNameRequest $request, Participant $participant)
    {
        $participant->update(['full_name'=>$request->fullName]);
        return Redirect::back()->banner('Successfully updated participant');
    }
/**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateParticipantsEmailRequest  $request
     * @param  \App\Models\Participant  $participants
     * @return \Illuminate\Http\Response
     */
    public function updateEmail(UpdateParticipantsEmailRequest $request, Participant $participant)
    {
        $participant->update(['email'=>$request->email]);
        return Redirect::back()->banner('Successfully updated participant');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Participant  $participants
     * @return \Illuminate\Http\Response
     */
    public function destroy(Participant $participants)
    {
        //
    }
}
