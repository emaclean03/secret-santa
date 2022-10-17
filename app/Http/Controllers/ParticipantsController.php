<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreParticipantsRequest;
use App\Http\Requests\UpdateParticipantsRequest;
use App\Models\Participant;
use Inertia\Inertia;

class ParticipantsController extends Controller
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
     * @param  \App\Http\Requests\StoreParticipantsRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreParticipantsRequest $request)
    {
        //
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
     * @param  \App\Http\Requests\UpdateParticipantsRequest  $request
     * @param  \App\Models\Participant  $participants
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateParticipantsRequest $request, Participant $participants)
    {
        //
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
