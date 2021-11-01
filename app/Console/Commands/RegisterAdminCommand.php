<?php

namespace App\Console\Commands;

use App\User;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Hash;

class RegisterAdminCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     * Cette command sera utilisée en tant que: 
     * php artisan register:admin
     */
    protected $signature = 'register:admin';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Création d\'un administrateur';

    /**
     * User model.
     * @var objet
     */
    private $user;

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct(User $user)
    {
        parent::__construct();
        $this->user = $user;
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $details = $this->getDetails();
        if(empty($details)){
            error_log('Details array is empty!!!');
        }
        $this->user->role = TRUE;
        $admin = $this->user->createAdmin($details);

        $this->display($admin);
    }

    /**
     * Obtenir les données de l'admin
     * @return array
     */
    private function getDetails() : array
    {
        $details['last_name'] = $this->ask('Nom');
        $details['first_name'] = $this->ask('Prénom');
        $details['username'] = $this->ask('Username');
        $details['email'] = $this->ask('Email');
        $details['gender'] = $this->ask('Sexe');
        $details['role'] = 1;
        $details['password'] = $this->secret('Mot de Passe');
        $details['confirm_password'] = $this->secret('Confirmation Mot de Passe');

        while(!$this->isValidPassword($details['password'], $details['confirm_password'])){
            if(!$this->isRequiredLength($details['password']))
            {
                $this->error('Password must contain at least eight characters!');
            }

            if(!$this->isMatch($details['password'], $details['confirm_password']))
            {
                $this->error('Passwords don\'t match');
            }

            $details['password'] = $this->secret('Mot de Passe');
            $details['confirm_password'] = $this->secret('Confirmation Mot de Passe');
        }

        return $details;
    }

    /**
     * Afficher l'admin créé
     * 
     * @param array $admin
     * @return void
     */
    public function display(User $admin) : void
    {
        $header = ['Prénom', 'Nom', 'Username', 'Email', 'Role'];
        $role = $admin->role == 1 ? 'Admin' : 'User';
        $champs = [
            'Prénom' => $admin->first_name,
            'Nom' => $admin->last_name,
            'Username' => $admin->username,
            'Email' => $admin->email,
            'Role' => $role
        ];

        $this->info("L'administrateur est créé");
        $this->table($header, [$champs]);
    }

    /**
     * Check si le password est valid
     * @param string $password
     * @param string $confirmPassword
     * @return boolean
     */
    private function isValidPassword(string $password, string $confirmPassword) : bool
    {
        return $this->isRequiredLength($password, $confirmPassword)
        && $this->isMatch($password, $confirmPassword);

    }

    /**
     * Check si les passwords match
     * @param string $password
     * @param string $confirmPassword
     * @return boolean
     */
    private function isMatch(string $password, string $confirmPassword) : bool
    {
        return $password === $confirmPassword;
    }

    /**
     * Check si le password contient 8 caractères ou plus
     * @param string $password
     * @return boolean
     */
    private function isRequiredLength( string $password) : bool
    {
        return strlen($password) >= 8;
    }
}
/**
 * Ziani
 * Zainab
 * AdminGym
 * myopla.gym@gmail.com
 * F
 * GymAdmin2021
 */