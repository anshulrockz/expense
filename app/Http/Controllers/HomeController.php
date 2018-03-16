<?php

/***************************************************
 ******* Developed By:- Anshul Agrawal *************
 ******* Email:- anshul.agrawal889@gmail.com *******
 ******* Phone:- 9720044889 ************************
 ***************************************************/

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    
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
}
