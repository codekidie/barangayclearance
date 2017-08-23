<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\UploadRequest;
use App\Http\Requests\EditProfileRequest;
use App\User;
use DB;
use HTML;
use Session;
use Auth;

class AdminController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function profile($username)
    { 
        return view('profile');
    }
    
   public function blotter()
    {
      return view('blotter');
    }


   public function credentials()
    {

      if (Auth::user()->role == 'Barangay Captain') {
                        $data['users'] = DB::table('users')
                        ->where('role', '=', 'Barangay Captain')
                        ->orWhere('role', '=', 'Admin')
                        ->orderBy('id', 'desc')
                        ->limit(8)
                        ->get();

      }elseif (Auth::user()->role == 'Admin') {
                        $data['users'] = DB::table('users')
                        ->where('role', '=', 'Staff')
                        ->orWhere('role', '=', 'Clerk')
                        ->orderBy('id', 'desc')
                        ->limit(8)
                        ->get();
      }

      elseif (Auth::user()->role == 'Clerk') {
                         $data['users'] = DB::table('users')
                        ->where('role', '=', 'Purok leader')
                        ->orderBy('id', 'desc')
                        ->limit(8)
                        ->get();
      }

      elseif (Auth::user()->role == 'Staff') {
                        $data['users'] = DB::table('users')
                        ->where('role', '=', 'Purok leader')
                        ->orderBy('id', 'desc')
                        ->limit(8)
                        ->get();
      }

      elseif (Auth::user()->role == 'Purok leader') {
          $data['users'] = DB::table('users')
          ->where('role', '=', 'Resident')
          ->orderBy('id', 'desc')
          ->limit(8)
          ->get();
      }
       
        return view('credentials',$data);
    }

    public function purokLeaderLocation()
    {
        $data['pl'] = DB::table('users')
            ->where('role', '=', 'Purok leader')
            ->orderBy('id', 'desc')
            ->get();
         return view('purokleaderlocation',$data);
             
    }

     public function announcement()
    {
        return view('announcement');
    }

     public function receiveletter()
    {
        return view('receiveletter');
    }


     public function setappointment()
    {
        return view('setappointment');
    }

    public function uploadSubmit(UploadRequest $request)
    {   


          if ($request->photos) {
                  foreach ($request->photos as $photo) {
                        $user =  User::create([
                              'firstname' => $request->firstname,
                              'middlename' => $request->middlename,
                              'lastname' => $request->lastname,
                              'email' => $request->email,
                              'role' => $request->role,
                              'latitude' => $request->latitude,
                              'longitude' => $request->longitude,
                              'profilepic' => $photo->store('photos'),
                              'username' => $request->username,
                              'password' => bcrypt($request->password),
                          ]);
                       if ($user) {
                           $filename = $photo->store('photos');
                           Session::flash('msg', 'Credential successfully added to the database');
                        } 
                  }
          }else{
                $user =  User::create([
                      'firstname' => $request->firstname,
                      'middlename' => $request->middlename,
                      'lastname' => $request->lastname,
                      'email' => $request->email,
                      'role' => $request->role,
                      'latitude' => $request->latitude,
                      'longitude' => $request->longitude,
                      'username' => $request->username,
                      'password' => bcrypt($request->password),
                  ]);
               if ($user) {
                   Session::flash('msg', 'Credential successfully added to the database');
                } 
          }
      }

    public function editprofile(EditProfileRequest $request)
    {   


      if ($request->photos) {
              foreach ($request->photos as $photo) {
                    $user =  User::find($request->id);
                    $user->firstname  = $request->firstname;
                    $user->middlename = $request->middlename;
                    $user->lastname   = $request->lastname;
                    $user->email      = $request->email;
                    $user->profilepic = $photo->store('photos');
                    $user->username   = $request->username;

                    if (!empty($request->password)) {
                           $user->password   = bcrypt($request->password);
                    }
               

                   if ($user->save()) {
                       $filename = $photo->store('photos');
                       Session::flash('msg', 'Profile successfully updated');
                    } 
              }
      }else{
                    $user =  User::find($request->id);
                    $user->firstname  = $request->firstname;
                    $user->middlename = $request->middlename;
                    $user->lastname   = $request->lastname;
                    $user->email      = $request->email;
                    $user->username   = $request->username;
                    if (!empty($request->password)) {
                           $user->password   = bcrypt($request->password);
                    }

           if ($user->save()) {
               Session::flash('msg', 'Profile successfully updated');
            } 
      }
        

        return redirect('admin/user/'.$request->username);
        
    }
}
