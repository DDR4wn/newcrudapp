<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Ticket extends Model
{
    use HasFactory;

    // table that belongs to the model.
    protected $table = 'tickets';
    protected $fillable = [
        'id', // Auto incremented pk
        'titel',  //non nullable VARCHAR(64)
        'omschrijving', //nullable varchar(128)
        'aangemaakt_op', //non nullable datetime
        'uitgevoerd_op' // datetime
    ];

    //I don't want it to automatically give the current timestamp along with it, as all i need to show are when it was finished/created and not edited.
    public $timestamps = false;
}
