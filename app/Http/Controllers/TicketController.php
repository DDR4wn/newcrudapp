<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;


use App\Models\Ticket;
class TicketController extends Controller
{
    public function index()
    {
        $ticketsFound = Ticket::all();
        return view('index', compact('ticketsFound'));
    }

    public function edit($id)
    {
        $ticket = Ticket::findOrFail($id);
        return view('edit', compact('ticket'));
    }

    public function show($id)
    {
        $ticket = Ticket::findOrFail($id);
        return view('show', compact('ticket'));
    }

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

    public function create()
    {
        return view('create'); // Create a view for the create page
    }

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

    public function destroy($id){
        //
    }
}

//insert into tickets(titel, omschrijving, uitgevoerd_op, aangemaakt_op)
//    VALUES  ('bol.com, koppeling', 'Bol.com wil graag een API koppeling.', null, '2022-08-12');
