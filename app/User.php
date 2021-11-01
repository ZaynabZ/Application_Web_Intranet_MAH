<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Eloquent\SoftDeletes;



class User extends Authenticatable
{
    use Notifiable;
    use SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'last_name', 
        'first_name', 
        'username', 
        'gender', 
        'service_id', 
        'role_id',
        'matricule',
        'solde', 
        'email', 
        'date_embauche',
        'password', 
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];



    /**
     * Les reservations que l'utilisateur a effectué.
     */
    public function reservations()
    {
        return $this->belongsToMany(Reservation::class, 'user_reservation');
    }

    public function service(){
        return $this->belongsTo('App\Service');
    }

    public function role(){
        return $this->belongsTo('App\Role');
    }



    
    public function conges(){
        return $this->belongsToMany(Conge::class);
    }

        
    public function isSuperAdmin()
    {
        return $this->role->role_name == 'SuperAdmin';
    }

    public function isAdmin()
    {
        return $this->role->role_name == 'Admin';
    }

    public function demandes(){
        return $this->belongsToMany(Demande::class)->withTimestamps()->withPivot('id', 'etat');
    }


    public function isSupervisor() {
        return $this->role->role_name == 'Supervisor';
    }

    public function isUser()
    {
        return $this->role->role_name == 'Agent';
    }

    /**
     * Création de l'admin
     * @param array $details
     * @return array
     */
    public function createAdmin(array $details) : self
    {
        // $role = '';

        // if( !$this->adminExists()){
        //     $role = 'admin';
        // }

        return User::create([
            'last_name' => $details['last_name'],
            'first_name' => $details['first_name'],            
            'username' => $details['username'],
            'gender' => $details['gender'],
            'role' => 1,
            'email' => $details['email'],
            'password' => Hash::make($details['password']),
        ]);

    }

    /**
     * Checks if admin exists
     * @return integer
     */
    public function adminExists() : int{

        return self::where('role', 1)->count();
    }   



    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
}
