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
use Storage;

use App\Certification;
use App\Clearance;
use App\Socialpension;
use App\Businesspermit;


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

    public function approval()
    {   

        $data['clearance'] =  Clearance::all();
        $data['certification'] =  Certification::all();
        $data['socialpension'] =  Socialpension::all();
        $data['businesspermit'] =  Businesspermit::all();

        return view('approval',$data);
    }

    public function clearanceapproval($id,$status)
    {
       

        if ($status == 'approved') {
            $c = Clearance::find($id);
            $c->status = 'approved';
            $c->save();
             Session::flash('msg', 'Clearance approved');
        }else{
            $c = Clearance::find($id);
            $c->status = 'reject';
            $c->save();
             Session::flash('msg', 'Clearance rejected');
        }

         $data['clearance'] =  Clearance::all();
        $data['certification'] =  Certification::all();
        $data['socialpension'] =  Socialpension::all();
        $data['businesspermit'] =  Businesspermit::all();

        return view('approval',$data);

    }

    public function businesspermitapproval($id,$status)
    {
         if ($status == 'approved') {
            $c = Businesspermit::find($id);
            $c->approval_status = 'approved';
            $c->save();
             Session::flash('msg', 'Business permit approved');
        }else{
            $c = Businesspermit::find($id);
            $c->approval_status = 'reject';
            $c->save();
             Session::flash('msg', 'Business permit rejected');
        }

        $data['clearance'] =  Clearance::all();
        $data['certification'] =  Certification::all();
        $data['socialpension'] =  Socialpension::all();
        $data['businesspermit'] =  Businesspermit::all();

        return view('approval',$data);
    }

    public function certificationapproval($id,$status)
    {
         if ($status == 'approved') {
            $c = Certification::find($id);
            $c->status = 'approved';
            $c->save();
             Session::flash('msg', 'Certification  approved');
        }else{
            $c = Certification::find($id);
            $c->status = 'reject';
            $c->save();
             Session::flash('msg', 'Certification  rejected');
        }

        $data['clearance'] =  Clearance::all();
        $data['certification'] =  Certification::all();
        $data['socialpension'] =  Socialpension::all();
        $data['businesspermit'] =  Businesspermit::all();

        return view('approval',$data);
    }

    public function socialpensionapproval($id,$status)
    {
         if ($status == 'approved') {
            $c = Socialpension::find($id);
            $c->approval_status = 'approved';
            $c->save();
             Session::flash('msg', 'Socialpension  approved');
        }else{
            $c = Socialpension::find($id);
            $c->approval_status = 'reject';
            $c->save();
             Session::flash('msg', 'Socialpension  rejected');
        }

        $data['clearance'] =  Clearance::all();
        $data['certification'] =  Certification::all();
        $data['socialpension'] =  Socialpension::all();
        $data['businesspermit'] =  Businesspermit::all();

        return view('approval',$data);
    }

    

    public function notifications()
    {
        return view('notifications');
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
                    
                    Storage::delete($user->profilepic);

                    $user->profilepic = $photo->store('photos');
                    $user->username   = $request->username;

                    if (!empty($request->password)) {
                           $user->password   = bcrypt($request->password);
                    }
               

                   if ($user->save()) {
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
