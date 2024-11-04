<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Ticket extends Model
{
    // HasFactory is used to create instances.
    use HasFactory;

    // table that belongs to the model.
    protected $table = 'tickets';
    protected $fillable = [
        'id', // Auto incremented INTEGER pk
        'titel',  //non nullable VARCHAR(64)
        'omschrijving', //nullable varchar(128)
        'aangemaakt_op', //non nullable TEXT(datetime datetime isn't supported in sqlite)
        'uitgevoerd_op' // TEXT(datetime datetime isn't supported in sqlite)
    ];

    //I don't want it to automatically give the current timestamp along with it,
    // as all i need to show are when it was finished/created and not edited.
    public $timestamps = false;
}
