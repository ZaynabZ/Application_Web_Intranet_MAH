<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Candidat extends Model
{
    protected $table = 'candidats';

    protected $fillable = [
        'nom_candidat',
        'prenom_candidat',
        'emplacement'
    ];

}
