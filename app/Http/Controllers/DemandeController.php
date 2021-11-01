<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Notification;
use Illuminate\Notifications\DatabaseNotification;

use App\Demande;
use App\User;

use App\Notifications\DemandesNotification;
use App\Notifications\StatusDemandesNotification;

use Carbon\Carbon;

class DemandeController extends Controller
{
    public function superadminDemandes(DatabaseNotification $notification = null){

        if ($notification != null){
            $notification->markAsRead();
        }
        $users = User::all();
        $demandes = array();
        foreach($users as $user){
            foreach($user->demandes as $demande){
                if($demande->pivot->etat == 'En cours'){
                    array_push($demandes, $demande);
                }                
            }
        }
       
        return view('superadmin.superadmin_demandes')->with('demandes', $demandes);
    }

    public function marquerDemandeRealisee($demande_id, $user_id, Request $request){
        //dd($request->id);
        $demande =  User::find($user_id)->demandes()
                                ->where('demande_id', $demande_id)
                                ->wherePivot('id', $request->id)
                                ->first();
        
        $demande_maker = User::find($user_id);
        $demande->pivot->etat = 'Réalisée';
        $demande->pivot->save();
        
        $demande->save();
        $demande_realisee = Demande::find($demande_id);
        $notification_time = Carbon::now()->format('Y-m-d H:i:s');
        
        Notification::send($demande_maker, new StatusDemandesNotification($demande_realisee->type_demande, $notification_time));
        return redirect(route('superadmin_demandes'));
    }

    public function getDemandesForm(DatabaseNotification $notification = null){
        if ($notification != null){
            $notification->markAsRead();
        }
        $user_demandes = Auth::user()->demandes()->get();
        $demandes = Demande::all();
        return view('demandes_form')->with('demandes', $demandes)
                                    ->with('user_demandes', $user_demandes);
    } 
 
    public function effectuerDemande(Request $request){
        //dd($notification);
        
        $this->validate($request, [
            'demande_id' => ['required'],
        ]);
        $user = Auth::user();
        $user->demandes()->attach($request->demande_id);
        $superadmin = User::where('role_id', 1)->first();
        $notification_time = Carbon::now()->format('Y-m-d H:i:s');
        $demande = Demande::find($request->demande_id);
        Notification::send($superadmin, 
                            new DemandesNotification($user->first_name, $user->last_name, 
                            $demande->type, $notification_time));
        
        return redirect(route('demandes'));
    }

    public function getGestionDemandes($id = null){
        //dd($id);
        $demande = new Demande();
        $demandes = Demande::all();
        if($id != NULL){
            $demande = Demande::find($id);
        }
        
        return view('admin.add_edit_demande')->with('demandes', $demandes)
                                        ->with('theDemande', $demande);;
    }

    public function postGestionDemandes(Request $request){

        
        $this->validate($request,[
            'type_demande' => ['required'],
        ]);
        if($request->id != NULL){
            $demande = Demande::find($request->id);
            $demande->update($request->all());
        }
        else{
            Demande::create($request->all());
        }
        
        return redirect(route('demandes_admin'));
    }

    public function destroy($id){
        $demande = Demande::findOrFail($id);
        $demande->delete();
        return redirect(route('demandes_admin'));
    }

    
}
