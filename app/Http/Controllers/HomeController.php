<?php

/***************************************************
 ******* Developed By:- Anshul Agrawal *************
 ******* Email:- anshul.agrawal889@gmail.com *******
 ******* Phone:- 9720044889 ************************
 ***************************************************/

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Expense;
use App\Deposit;
use App\Asset;
use App\AssetNew;

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
        $expenses = Expense::expense_bar_chart(); 
        $expense_pc = Expense::expense_pie_chart(); 
        $deposits = Deposit::deposit_bar_chart(); 
        $asset_old = Asset::assetold_pie_chart();
        $asset_new = AssetNew::assetnew_pie_chart(); 
        $deposits_2 = Deposit::all_deposits()->take(10);
        // $top_balance = Expense::top_balance()->take(10); dd($top_balance);
        return view('home')->with(array('expenses' => $expenses, 'deposits' => $deposits, 'asset_old' => $asset_old, 'asset_new' => $asset_new, 'expense_pc' => $expense_pc, 'deposits_2' => $deposits_2, ));
    }
}
