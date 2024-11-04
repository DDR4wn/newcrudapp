<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;


use App\Models\Ticket;
class TicketController extends Controller
{
    /**
     * Finds all tickets within ticket table and passes them to the index view as an array where they're displayed.
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Foundation\Application
     */
    public function index()
    {
        $ticketsFound = Ticket::all();
        return view('index', compact('ticketsFound'));
    }

    /**
     * Navigates by ticket id to the edit ticket form.
     *
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Foundation\Application
     */
    public function edit($id)
    {
        $ticket = Ticket::findOrFail($id);
        return view('edit', compact('ticket'));
    }

    /**
     * Navigates to a display of the ticket which belongs to the id.
     *
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Foundation\Application
     */
    public function show($id)
    {
        $ticket = Ticket::findOrFail($id);
        return view('show', compact('ticket'));
    }

    /**
     * Validates given form data and looks for matching id in database. If found, updates the desired values.
     * Redirects user to the show page of the now updated ticket.
     *
     * @param Request $request
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, $id)
    {

        $request->validate([
            'titel' => 'required|string|max:64',
            'omschrijving' => 'required|string|max:128',
            'uitgevoerd_op' => 'nullable|date', // optional date field
        ]);


        $ticket = Ticket::findOrFail($id);
        $ticket->update($request->only(['titel', 'omschrijving', 'uitgevoerd_op']));

        return redirect()->route('tickets.show', ['id' => $ticket->id]);

    }

    /**
     * navigates to form for creating a new ticket.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Foundation\Application
     */
    public function create()
    {
        return view('create');
    }

    /**
     * Validates user-entered information, adds timestamp of creation and stores the newly created ticket in the database.
     *
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'titel' => 'required|string|max:255',
            'omschrijving' => 'required|string',
        ]);

        //set current timestamp to now as ticket is being made now.
        $validatedData['aangemaakt_op'] = now();

        Ticket::create($validatedData);

        return redirect()->route('tickets.index');
    }
}

//insert into tickets(titel, omschrijving, uitgevoerd_op, aangemaakt_op)
//VALUES  ('bol.com, koppeling', 'Bol.com wil graag een API koppeling.', null, '2022-08-12');
