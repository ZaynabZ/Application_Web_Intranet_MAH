<?php

namespace App\Http\Controllers;
use App\Reservation;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Auth;

class ReservationController extends Controller
{
    /**
     * Display a listing of the reservations.
     * 
     * @return \Illuminate\Http\Response
     */
    public function index(){
        $reservations = Reservation::all('user_id', 'reservation_time');
        return response()->json($reservations, 200);
         
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request){
        $request->validate([
            'user_id' => 'required',
            'reservation_time' => 'required|date_format:Y-m-d H:i:s',
        ]);
        Reservation::create($request->all());
        return response()->json($request->all(), 200);
        
    }

    public function show($user_id){
        
        $reservations = Reservation::where('user_id', $user_id)->get(['user_id', 'reservation_time']);
        
        return response()->json($reservations, 200);
    }

    /**
     * Delete a reservation.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($reservation_time)
    {
        $reservation = Reservation::where('reservation_time', $reservation_time)
                                    ->where('user_id', Auth::user()->id)->firstOrFail();
        return Reservation::destroy($reservation->id);
    }
}
