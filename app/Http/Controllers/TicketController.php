<?php

namespace App\Http\Controllers;

use App\Models\Ticket;
class TicketController extends Controller
{
    public function index(){
        $ticketsFound = Ticket::all();
        return view('ticketsystem', compact('ticketsFound'));
    }

    public function store(){
        $newTicket = new Ticket();
        return view('ticketsystem', compact('newTicket'));
    }

    public function show($id){

    }

    public function update($id){

    }

    public function destroy($id){

    }
}

//insert into tickets(titel, omschrijving, uitgevoerd_op, aangemaakt_op)
//    VALUES  ('bol.com, koppeling', 'Bol.com wil graag een API koppeling.', null, '2022-08-12');
