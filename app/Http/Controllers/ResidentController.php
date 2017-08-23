<?php

namespace App\Http\Controllers;
use Auth;
use Illuminate\Http\Request;
use App\User;
use DB;


class ResidentController extends Controller
{
    public function blotter()
    {
        return view('resident.blotter');
    }

    public function businesspermit()
    {
        return view('resident.businesspermit');
    	
    }

    public function checkmessage()
    {
        return view('resident.checkmessage');
    	
    }

    public function clearance()
    {
        return view('resident.clearance');
    	
    }

    public function details()
    {
        return view('resident.details');
    	
    }


    public function location()
    {
        return view('resident.location');
    	
    }

    public function prerequisite()
    {
        return view('resident.prerequisite');
    	
    }


    public function requestcertificate()
    {
        return view('resident.requestcertificate');
    	
    }

    public function schedule()
    {
        return view('resident.schedule');
    	
    }

    public function socialpension()
    {
        return view('resident.socialpension');
    	
    }

    public function profile()
    {
        return view('resident.profile');
        
    }

    public function update_userLatLong($lat,$long,$id)
    {
        $user = User::find($id);
        $user->latitude = $lat;
        $user->longitude = $long;
        $user->save();  
    }

    public function profiles_pic()
    {
         $users = DB::table('users')
         ->where('role', '=', 'Resident')
        ->orderBy('id', 'desc') 
        ->get();
        return $users;

    }

    
}
