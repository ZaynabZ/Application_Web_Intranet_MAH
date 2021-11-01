<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Conge;
use App\User;
use App\Role;
use App\Service;
use Auth;
use Illuminate\Notifications\DatabaseNotification;
use App\Notifications\PostLeaveNotification;
use App\Notifications\responseLeaveNotification;


class CongeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(DatabaseNotification $nf = null)
    {
        $conges = Conge::all();
        if ($nf != null){
            $nf->markAsRead();
        }
        return view('myleaves' ,[
            'leaves' => $conges
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {


    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $conge = new Conge();

        $request->validate([
            'date_debut' => 'required|date_format:Y-m-d H:i:s',
            'date_fin' => 'required|date_format:Y-m-d H:i:s',

        ]);
        $id_service = Auth::user()->service_id;
        $conge->user_id=Auth::user()->id;
        $conge->service_id= $id_service;
        $conge->motif=$request->motif;
        $conge->justification=$request->justification;
        $conge->date_debut=$request->date_debut;
        $conge->date_fin=$request->date_fin;
        $conge->etat='En Cours' ;

        $conge->save();

        // notifications
        $sup = User::where('role_id',3)->where('service_id',$id_service)->get() ;
        $supadmin =  User::where('role_id',1)->get() ;
   

        foreach ($sup  as $user){
            $user->notify(new PostLeaveNotification($conge,auth()->user()));
        }

        
        foreach ($supadmin  as $user){
            $user->notify(new PostLeaveNotification($conge,auth()->user()));
        }

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id,DatabaseNotification $nf = null)
    {
        
            $conges = Conge::where('user_id', $id)->get();
            if ($nf != null){
                $nf->markAsRead();
            }
            
            return view('myleaves',['leaves'=>$conges]);
            // dd($conges);
     
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {

    
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id,$d,$user_id)
    {
        $conge = Conge::findOrFail($id);
        
        if ($d == 0) {
            $conge->etat = 'Rejetée';
        }else if($d == 1){
            $conge->etat = 'Validée';
        };

        $conge->update();
        $user =  User::findOrFail($user_id);
        $user->notify(new responseLeaveNotification($user_id));

        return redirect()->back()->with('success', 'your message,here');;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $conge = Conge::findOrFail($id);
        $conge->delete();
        return redirect(route('myleaves',Auth::user()->id));
    }
}
