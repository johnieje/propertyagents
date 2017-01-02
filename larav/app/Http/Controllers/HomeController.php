<?php

namespace App\Http\Controllers;

use App\User;
use App\Http\Requests;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use Hash;


class HomeController extends Controller
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

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('home');
    }

    public function getUsersList(){
      $users = User::orderBy('created_at', 'DESC')->paginate(10); 
      return view('users', ['users' => $users,'user' => Auth::user()]);
    }

    public function account()
    {
        return view('account',  ['user' => Auth::user()]);
    }

    public function getAccountSettings(){
        return view('account_settings', ['user' => Auth::user()]);
    }
/*
    public function postUpdateAccount(Request $request){
        $this->validate($request, [
            'name' => 'required|max:255'
        ]);
        
        $user = Auth::user();
        $user->name = $request['name'];
        
        if($request->hasFile('image')){
             //check for avatar here
           $file = $request->file('image');
           $file_name = $user->name . '-' . $user->id . '-' .'.jpg';
           $user->avatar = $file_name;
           Storage::disk('public')->put($file_name, File::get($file));
           //return redirect()->route('account');
        }
        $user->update();
        return redirect()->route('account');
   }
*/    
    public function getUserImage($filename){
       $file = Storage::disk('public')->get($filename);
       return new Response($file, 200);
    }

    public function postAccountUpdate(Request $request){
      $this->validate($request, [
         'name' => 'required|max:255'
      ]);
      //$password = null;  
      $user = Auth::user();
      if($request['current_password']){
        if(Hash::check($request['current_password'], $user->password)){
          $this->validate($request, [
            'new_password' => 'required|min:6',
            'confirm_password' => 'required|same:new_password'
            ]);
          //$password = $request['new_password'];
          $user->password = bcrypt($request['new_password']);
        }else{
          $message_fail = "Current password is not the same as registered password. Please try again!";
          return redirect()->route('account-settings')->with(['message-fail' => $message_fail, 'user' => Auth::user()]);
        }
        
      }
     
      if($request->hasFile('image')){
        
        $file = $request->file('image');
        $file_name = $user->name . '-' . $user->id . '-' .'.jpg';
        $user->avatar = $file_name;
        Storage::disk('public')->put($file_name, File::get($file));
        
      }
      
      $user->name = $request['name'];

      if($user->update()){
          $message_success = "Your account information has been successfully updated";
          return redirect()->route('account-settings')->with(['message-success' => $message_success]);
      };
      return false; 
   }

   public function getImageDelete($filename){
       $user = Auth::user();
       $file = User::where('avatar', $filename)->first();
       if($file){
           $default_avatar = 'default.jpg';
           $user->avatar = $default_avatar;
           
           $user->update();
           Storage::disk('public')->delete($filename);
       }
       
       return redirect()->route('account');
   }

   public function getDeleteAccount($id){
      $user = Auth::user();
        
        if($user->delete()){ //delete user
          return redirect()->route('home');
        }
        
      return false;
    }

}
