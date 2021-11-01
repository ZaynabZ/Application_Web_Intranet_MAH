<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\User;
use App\Service;
use App\Role;
use Session;
use Validator;

class UserController extends Controller
{
    /**
     * Get all users
     */
    public function index(){
       
        if(Auth::user()->isAdmin() || Auth::user()->isSuperAdmin()){
            $users = User::where('id', '!=' ,Auth::user()->id)->get();
            return view('admin.index', [
                'users'=> $users
            ]);
        }
        else return redirect('home');
         
     }
    
     /**
     * Get updating password form
     */
    public function updatePasswordForm(){
        return view('user.update_password');
    }

    /**
     * Get Authenticated user
     */
    public function profile(){
        $user = Auth::user();
        $m = Role::find($user->role_id)->role_name;
        return view('profile')
                    ->with('user', $user)
                    ->with('m', $m);
    }

    /**
     * Returns User creating form
     */
    public function create(){
       
        if(Auth::user()->isAdmin() || Auth::user()->isSuperAdmin()){
            $services = Service::all();
            $roles = Role::all();
            return view('admin.create_user')->with('services', $services)
                                            ->with('roles', $roles);
            
        }
        else return abort(403);
         
    }

    /**
     * Update user password
     * Done by a regular user
     * @param Request $request
     */
    public function updatePassword(Request $request){
        $validator = $request->validate([
            'old_password' => 'required|string|password',
            'new_password' => 'required|string|password|confirmed|min:8'
        ]);
        
        
        $userHashedPassword = Auth::user()->password;
        
        if (\Hash::check($request->old_password , $userHashedPassword )){
            if(!Hash::check($request->new_password , $userHashedPassword)){
                
                // $user = Auth::user();
                
                // $user->password = bcrypt($request->new_password);
                // $user->save();

                // return back()
                //        ->with('success','Mot de passe réinitialisé.');

                return "waa mareft lik";

            }
            else{
                // $message = "Le nouveau mot de passe ne peut pas être identique à l'ancien mot de passe";
                // return redirect()->back()->withErrors($message)->withInput();

                return "passwords match";
              }
        }
        else{
            // $messages = $validated->errors();
            //     return redirect()->back()->withErrors($messages)->withInput();
            return "wrong old password";
            
        }

    

    }

    /**
     * Create new user
     * @param Request $request
     */
    public function store(Request $request){
        
        if(Auth::user()->isAdmin() || Auth::user()->isSuperAdmin()){
            
            $this->validate($request,[
                'last_name' => ['required', 'string', 'max:255'],
                'first_name' => ['required', 'string', 'max:255'],
                'username' => ['required', 'string', 'max:255', 'unique:users'],
                'gender' => ['required'],
                'service_id' => ['required'],
                'role_id' => ['required'],
                'date_embauche' => ['required'],
                'matricule' => ['required', 'string', 'max:15', 'unique:users'],
                'solde' => ['required', 'numeric'],
                'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
                'password' => ['required', 'string', 'min:8', 'confirmed'],
            ]);
            $request['password'] =  Hash::make($request['password']);
            $user = User::create($request->all());
            
            return redirect(route('users'));
        }
         
    }

    /**
     * Show the form for updating the details of the specified user
     */
    public function edit($id){
        $user = User::find($id);
        $services = Service::all();
        $roles = Role::all();
        return view('admin.edit_user')->with('user', $user)->with('services', $services)
                                      ->with('roles', $roles);
    }


    /**
     * Update user details
     * @param Request $request
     * Done by the admin
     */
    public function update(Request $request, $id){
        if(Auth::user()->isAdmin() || Auth::user()->isSuperAdmin()){
            $this->validate($request,[
                'last_name' => ['required', 'string', 'max:255'],
                'first_name' => ['required', 'string', 'max:255'],
                'username' => ['required', 'string', 'max:255', 'unique:users,username,' . $id],
                'gender' => ['required'],
                'service_id' => ['required'],
                'role_id' => ['required'],
                'date_embauche' => ['required'],
                'matricule' => ['required', 'string', 'max:15', 'unique:users,matricule,' . $id],
                'solde' => ['required', 'numeric'],
                'email' => ['required', 'string', 'email', 'max:255', 'unique:users,email,' . $id],
            ]);

            $user = User::find($id);
            $user->update($request->all());
            return redirect()->route('users')
                            ->with('success','User updated successfully');
        }
        else{
            return response()->json(['error' => 'Accès non autorisé.'],403);
        }
        
    }


    public function destroy($id){

        $user = User::findOrFail($id);
        $user->delete();
        return redirect(route('users'));
    }

    
   

}
