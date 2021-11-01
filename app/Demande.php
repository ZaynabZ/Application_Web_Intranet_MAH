<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Demande extends Model
{
    protected $table = 'demandes';

    protected $fillable = [
        'type_demande',
    ];
    
    public function users(){
        return $this->belongsToMany(User::class);
    }
}
