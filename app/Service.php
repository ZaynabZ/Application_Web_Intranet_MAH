<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\User;

class Service extends Model
{
    protected $table = 'services';

    protected $fillable = [
        'name'
    ];
 

    public function user(){
        return $this->hasMany('App\User');
    }


}
