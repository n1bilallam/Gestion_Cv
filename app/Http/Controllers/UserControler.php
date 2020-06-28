<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\User;

use Auth;

class UserControler extends Controller
{
    
    public function __construct(){
        $this->middleware('auth');
    }

    public function index(){
        if (Auth::user()->is_admin) {
            $listeUsers = User::all();
        }

        return view('users.users',['users' =>$listeUsers]);

    }

     public function create(){
    	return view('users.create');
    }

    public function store(Request $request){
    	
    	$user = new User();

        $user->name = $request->input('name');
        $user->email = $request->input('email');
        $user->password = Hash::make($request->input('password'));
        $user->is_admin = $request->input('permession');
     

        
        $user->save();
        session()->flash('success',"l'utilisateur à été bien enregisttré !!");
        return redirect('users');

    }


}
