<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Product;
use App\Models\Sale;
use App\Models\Client;

class AuthController extends Controller
{
    public function index() {
        if (Auth::check() === true) {
            $lastProducts = Product::latest()->get();
            $lastSale = Sale::latest()->first();
            $lastClient = Client::latest()->first();

            return view('dashboard.index', ['lastProducts' => $lastProducts, 'lastSale' => $lastSale, 'lastClient' => $lastClient]);
        } else {
            return redirect('/dashboard/login');
        }
    }

    public function loginForm() {
        $user = User::all();
        if ($user->isEmpty()) {
            return redirect('/dashboard/createuser');
        } else {
            return view('dashboard.login');
        }
    }

    public function createUser() {
        return view('dashboard.createuser');
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
