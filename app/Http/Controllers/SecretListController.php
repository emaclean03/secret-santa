<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreSecretListRequest;
use App\Http\Requests\UpdateSecretListRequest;
use App\Jobs\SendEmailJob;
use App\Models\Participant;
use App\Models\SecretList;
use Exception;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Redirect;
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
     * @param \App\Http\Requests\StoreSecretListRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(StoreSecretListRequest $request)
    {

        $list = SecretList::create([
            'list_name' => $request->listName,
            'name' => Auth::user()->name,
            'email' => Auth::user()->email,
            'user_id' => Auth::user()->id,
            'list_budget' => $request->listBudget,
            'event_date' => $request->eventDate,
        ]);


        foreach ($request->participantNames as $name) {
            $participant = Participant::make([
                'full_name' => $name['name'],
            ]);
            $list->participant()->save($participant);
        }

        Auth::user()->SecretList()->attach($list);


        return Redirect::back()->banner('Successfully created ' . $list->list_name);

    }

    /**
     * Display the specified resource.
     *
     * @param \App\Models\SecretList $secretList
     * @return \Inertia\Response
     */
    public function show(SecretList $secretList)
    {
        return Inertia::render('AuthenticatedSecretList/SecretList', [
            'list' => $secretList,
            'participants' => $secretList->participant()->with('parent')->get(),
            'signedUrl' => URL::signedRoute('public.index', $secretList->id)
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Models\SecretList $secretList
     * @return \Illuminate\Http\Response
     */
    public function edit(SecretList $secretList)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \App\Http\Requests\UpdateSecretListRequest $request
     * @param \App\Models\SecretList $secretList
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateSecretListRequest $request, SecretList $secretList)
    {
        $secretList->participant()->where('id', $request->participantId)->delete();
        return Redirect::back()->banner('Successfully deleted participant');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\SecretList $secretList
     * @return \Illuminate\Http\Response
     */
    public function destroy(SecretList $secretList)
    {
        try {
            $secretList->delete();
        } catch (Exception $e) {
            Log::error('Error deleting list: ' . $e->getMessage());
        }

        return redirect('dashboard')->banner('Successfully deleted the list');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\SecretList $secretList
     * @return \Illuminate\Http\JsonResponse
     */
    public function drawParticipants(SecretList $secretList)
    {
        $participants = $secretList->participant()->get();
        $usedPeople = [];

        foreach ($participants as $person) {
            //This person has no email, we need emails!
            if ($person->email === null || $person->email === '') {
                return Redirect::back()->dangerBanner('Please ensure an email is set for ' . $person->full_name);
            }
            $randomPerson = $participants->random();
            while ($randomPerson->id === $person->id || in_array($randomPerson->id, $usedPeople)) {
                $randomPerson = $participants->random();
            }
            $person->participant_id = $randomPerson->id;
            $person->save();
            $usedPeople[] = $randomPerson->id;
        }
      //  $secretList->update(['has_been_drawn' => true]);

        try {
            $participants = $secretList->participant()->with('parent')->get();
            SendEmailJob::dispatch($participants, $secretList);
        } catch (Exception $e) {
            Log::info($e->getMessage());
        }
        return Redirect::back()->banner('Successfully drawn names. Emails have been dispatched.');
    }
}

