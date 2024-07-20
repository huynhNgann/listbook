<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
class AdminController extends Controller
{
    function __construct(){

    }
    function index(){

    }
    function dashboard(){
        $user= Auth::user();
        return $user->role->name;
        //return view('dashboard.index');
    }
}
