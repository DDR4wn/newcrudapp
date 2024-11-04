<?php

namespace App\Http\Controllers;
use Exception;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;


use App\Models\Ticket;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\ValidationException;

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
     * Logs the validation info, and the update status.
     *
     *
     * @param Request $request
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, $id)
    {

        //try catch to log success/failure of validation info.
        try {
            $validatedData = $request->validate([
                'titel' => 'required|string|max:64',
                'omschrijving' => 'nullable|string|max:128',
                'uitgevoerd_op' => 'nullable|date',
            ]);

            Log::info('Ticket validation successful', [
                'titel' => $validatedData['titel'],
                'omschrijving' => $validatedData['omschrijving'] ?? null,
                'uitgevoerd_op' => $validatedData['uitgevoerd_op'] ?? null,
            ]);
        }
        catch (ValidationException $e) {
            Log::error('Ticket validation failed', [
                //errors() from the validationexception class to get validation information
                'errors' => $e->errors()
            ]);
        }

        // find ticket to update.
        $ticket = Ticket::findOrFail($id);

        //try catch to log success/failure of db ticket update.
        try {
            // update the ticket with the request data
            $ticket->update($request->only(['titel', 'omschrijving', 'uitgevoerd_op']));

            // log sucessful update
            Log::info('Ticket updated successfully', [
                'ticket_id' => $ticket->id,
                'updated_data' => $request->only(['titel', 'omschrijving', 'uitgevoerd_op']),
            ]);

        } catch (Exception $e) {
            // log errors
            Log::error('Failed to update ticket', [
                'ticket_id' => $id,
                'error' => $e->getMessage(),
            ]);
        }

        return redirect()->route('tickets.show', ['id' => $ticket->id]);

    }

    /**
     * navigates to form for creating a new ticket.
     *
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Foundation\Application
     */
    public function create()
    {
        return view('create');
    }

    /**
     * Validates user-entered information, adds timestamp of creation and stores the newly created ticket in the database.
     * Logs the validation info, the creation status, and the database storing status.
     *
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        //trycatch block to ensure information is gathered on validating,creating the ticket and storing the ticket in db.
        try {
            $validatedData = $request->validate([
                'titel' => 'required|string|max:255',
                'omschrijving' => 'nullable|string',
            ]);

            // check if the ticket's entered info is succesfully validated. If so, the validated version should match the original
            Log::info('Ticket validation successful', [
                'titel' => $validatedData['titel'],
                'omschrijving' => $validatedData['omschrijving'] ?? null,
            ]);
        }
        catch (ValidationException $e) {
            Log::error('Ticket validation failed', [
                //use errors(), specific to the validationexception class.
                'errors' => $e->errors()
            ]);
        }

        //set current timestamp to now as ticket is being made now.
        $validatedData['aangemaakt_op'] = now();


        //try catch to log ticket db creation sucess/failure.
        try {
            $ticket = Ticket::create($validatedData);

            Log::info('New ticket created successfully', [
                'ticket_id' => $ticket->id,
                'titel' => $ticket->titel,
                'aangemaakt_op' => $ticket->aangemaakt_op,
            ]);

        }
        catch (\Exception $e) {
            Log::error('Ticket creation failed', [
                'errors' => $e->getMessage()
            ]);
        }

        return redirect()->route('tickets.index');
    }
}
