<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TicketController;



//shows all entries of table.
Route::get('/tickets', [TicketController::class, 'index'])->name('tickets.index');

//routes to show method, which finds selected ticket's id and displays it.
Route::get('/tickets/{id}/show', [TicketController::class, 'show'])->name('tickets.show');

//routes to edit method, page of which belongs to previously selected
Route::get('/tickets/{id}/edit', [TicketController::class, 'edit'])->name('tickets.edit');

//endpoint to put ticket changes in db
Route::put('tickets/{id}', [TicketController::class, 'update'])->name('tickets.update');

//routes to create method, then opens create page.
Route::get('/tickets/create', [TicketController::class, 'create'])->name('tickets.create');

//endpoint to post new ticket to db
Route::post('/tickets', [TicketController::class, 'store'])->name('tickets.store');


//I'm aware this nifty feature exists
// Route::resource('/tickets', TicketController::class);

//prevents being sent to wrongful link, could also send to
Route::fallback(function () {
    return redirect('/tickets');
});

