<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\User;
use App\Service ;


class Conge extends Model
{
    protected $table = 'conges';

    protected $fillable = [
        'id','user_id','service_id','motif','justification','date_debut','date_fin','etat'
    ];

        
    public function users(){
        return $this->belongsTo(User::class,'user_id');
    }


}
