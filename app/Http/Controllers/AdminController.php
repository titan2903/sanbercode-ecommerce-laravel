<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Session;

class AdminController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $admins = User::where('type', 1)->get();
        return view('pages-admin.admins.index', compact('admins'));
    }

    public function logout()
    {
        Session::flush();
        
        Auth::logout();

        return redirect('login');
    }


    public function dashboard()
    {
        return view('layouts.master-admin');
    }
}
