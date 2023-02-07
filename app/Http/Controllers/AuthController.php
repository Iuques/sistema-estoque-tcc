<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class AuthController extends Controller
{
    public function index() {
        if (Auth::check() === true) {
            $lastProduct = DB::table('products')->latest()->first();
            $lastSale = DB::table('sales')->latest()->first();
            $lastClient = DB::table('clients')->latest()->first();

            return view('dashboard.index', ['lastProduct' => $lastProduct, 'lastSale' => $lastSale, 'lastClient' => $lastClient]);
        } else {
            return redirect('/dashboard/login');
        }
    }

    public function loginForm() {
        $user = User::all();
        if ($user->isEmpty()) {
            return view('dashboard.login')->with('cadastra', true);
        } else {
            return view('dashboard.login')->with('cadastra', false);
        }
    }

    public function loginDo(Request $request) {
        $credentials = ['email' => $request->email, 'password' => $request->password];
        if ($request->remember) {
            $remember = true;
        } else {
            $remember = false;
        }
        
        if (Auth::attempt($credentials, $remember)) {
            return redirect('/dashboard');
        } else {
            return redirect()->back()->withInput()->withErrors(['Dados não conferem']);
        }
    }

    public function storeUser(Request $request) {
        $user = new User;

        $user->name = $request->name;
        $user->surname = $request->surname;
        $user->email = $request->email;
        $user->password = bcrypt($request->password);
        $user->type = $request->type;

        $user->save();

        return redirect('/');
    }

    public function logout(){
        Auth::logout();
        return redirect('/dashboard');
    }
}
