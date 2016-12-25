<?php

namespace App\Http\Controllers;

use App\User;
use App\Http\Requests;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;


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

    public function account()
    {
        return view('account',  ['user' => Auth::user()]);
    }

    public function getAccountSettings(){
        return view('account_settings', ['user' => Auth::user()]);
    }

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
    
   public function getUserImage($filename){
       $file = Storage::disk('public')->get($filename);
       return new Response($file, 200);
   }

}
