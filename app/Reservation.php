<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Reservation extends Model
{

    protected $table = 'user_reservation';

    protected $fillable = [
        'reservation_time', 'user_id'
        
    ];

    /**
     * Les utilisateurs qui ont effectué la réservation.
     */
    // public function users()
    // {
    //     return $this->belongsToMany(User::class, 'user_reservation');
    // }
}
