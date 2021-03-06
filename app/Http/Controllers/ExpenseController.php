<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Expense;
use App\ExpenseDetail;
use App\Deposit;
use App\Transaction;
use App\ExpenseCategory;
use App\PurchaseCategory;
use App\Description;
use App\Tax;
use App\SubExpense;
use Auth;

class ExpenseController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->expense = new Expense();
    }
    
    public function index()
    {
    	if(Auth::user()->user_type==1)
    	{
			$expense = Expense::super_admin_all();
			return view('expense.index')->with('expense',$expense);
		}
    	
    	
    	if(Auth::user()->user_type == 3)
    	{
			$expense = $this->expense->workshop_all();
			//$balance = $this->expense->balance(); //dd($expense);
	        return view('expense.index')->with('expense',$expense);
		}
		
		if(Auth::user()->user_type == 4)
    	{
			$expense = $this->expense->user_all();
			//$balance = $this->expense->balance(); //dd($expense);
	        return view('expense.index')->with('expense',$expense);
		}
    	
        
    }

    public function create()
    {
  //   	if(Auth::user()->user_type == 1)
  //   	{
  //   		$expense = Expense::super_admin_all();
	 //    	return view('expense.index')->with('expense',$expense);
		// }
		// else
  //   	{
	    	$expense_category = ExpenseCategory::all();
	    	$description = Description::all();
	    	$tax = Tax::all();
		// }
    	$balance = $this->expense->balance(); //dd($balance);
    	$voucher_no = $this->expense->lastid();
    	if(empty($voucher_no)) $voucher_no == 0;
    	else $voucher_no = $voucher_no->id;
    	$voucher_no = $voucher_no + 1;
    	$voucher_no = 'ET'.$voucher_no;
        return view('expense.create')->with(array( 'expense_category' => $expense_category, 'description' => $description, 'tax' => $tax, 'balance' => $balance, 'voucher_no' => $voucher_no));
    }

    public function store(Request $request)
    {
    	$this->validate($request,[
			'party_name'=>'required|max:255',
		]);
		//dd($request);
		$expense = new Expense;
		
		$date = $request->invoice_date;
		$expense->invoice_date = date_format(date_create($date),"Y-m-d");
		
		$expense->invoice_no = $request->invoice_no;
		$expense->party_name = $request->party_name;
		$expense->party_gstin = $request->party_gstin;
		$expense->mode = $request->mode;

		if(!empty($request->file('voucher_img')))
		{
			$image = $request->file('voucher_img');
			$image_name = time().'.'.$image->getClientOriginalExtension();
			$image->move(public_path('uploads/expenses/'), $image_name);
		    $expense->voucher_img = $image_name;
		}
		
		$expense->status = 1;
		$expense->user_sys = \Request::ip();
		$expense->updated_by = Auth::id();
		$expense->created_by = Auth::id();
		
		$result = $expense->save();
		
		$id = $expense->id;
		$amount = 0;
		$supply_type = $request->type;
		$supply_category = $request->category;
		$expense_category = $request->expense_category;
		$description = $request->description;
		$code = $request->code;
		$cost = $request->cost;
		$quantity = $request->quantity;
		$sgst = $request->sgst;
		$cgst = $request->cgst;
		$igst = $request->igst;

		for($i = 0; $i < count($cost); $i++){
			$expense_details = new ExpenseDetail;
			$expense_details->expense_id = $id;
			$expense_details->category1 = $supply_type[$i];
			$expense_details->category2 = $supply_category[$i];
			$expense_details->category3 = $expense_category[$i];
			$expense_details->description = $description[$i];
			$expense_details->code = $code[$i];
			$expense_details->cost = $cost[$i];
			$expense_details->quantity = $quantity[$i];
			$expense_details->sgst = $sgst[$i];
			$expense_details->cgst = $cgst[$i];
			$expense_details->igst = $igst[$i];
			$expense_details->user_sys = \Request::ip();
			$expense_details->updated_by = Auth::id();
			$expense_details->created_by = Auth::id();
			$expense_details->save();
			$amount += $cost[$i] + $sgst[$i] +  $cgst[$i] + $igst[$i];
		}
		
		$expense = Expense::find($id);
		$expense->voucher_no = 'ET'.$id;
		$expense->amount = $amount;
		$result = $expense->save();

		$transaction = new Transaction;
		$transaction->txn_voucher = $expense->voucher_no;
		$transaction->txn_date = $expense->voucher_date;
		$transaction->txn_type = $expense->main_category;
		$transaction->voucher_no = $expense->voucher_no;
		$transaction->voucher_date = $expense->voucher_date;
		$transaction->amt_deduct = $expense->amount;
		$transaction->user_sys = \Request::ip();
		$transaction->updated_by = Auth::id();
		$transaction->created_by = Auth::id();
		$transaction->particulars = Auth::user()->name.' spent '.$expense->amount.' to purchase '.$expense->subject;
		$result2 = $transaction->save();
		
		$id2 = $transaction->id;
		$transaction = Transaction::find($id2);
		$transaction->txn_id = 'TXN_'.$id2;
		$result2 = $transaction->save();
		
		if($result){
			return back()->with('success', 'Record added successfully! Your expense ID:'.$expense->voucher_no);
		}
		else{
			return back()->with('error', 'Something went wrong!');
		}
    }

    public function show($id)
    {
        $expense = Expense::find($id);
        $userdetails = Expense::find($id)->UserDetails();
        return view('expense.show')->with(array('expense' => $expense, 'userdetails' => $userdetails));
    }

    public function edit($id)
    {
    	$balance = $this->expense->balance();
    	$description = Description::all();
    	$tax = Tax::all();
    	$expense_category = ExpenseCategory::all();
    	$purchase_category = PurchaseCategory::all();
        $expense = Expense::find($id);
        $expense_details = Expense::find($id)->ExpenseDetails; //dd($expense_details);
        return view('expense.edit')->with(array('expense' => $expense, 'expense_category' => $expense_category, 'purchase_category' => $purchase_category, 'balance' => $balance, 'expense_details' => $expense_details, 'description' => $description, 'tax' => $tax) );
    }

    public function update(Request $request, $id)
    {
        $this->validate($request,[
			'party_name'=>'required|max:255',
		]);
		 dd($request);
		$expense = Expense::find($id);
		$date = $request->invoice_date;
		$expense->invoice_date = date_format(date_create($date),"Y-m-d");
		
		$expense->invoice_no = $request->invoice_no;
		$expense->party_name = $request->party_name;
		$expense->party_gstin = $request->party_gstin;
		$expense->mode = $request->mode;

		if(!empty($request->file('voucher_img')))
		{
			$image = $request->file('voucher_img');
			$image_name = time().'.'.$image->getClientOriginalExtension();
			$image->move(public_path('uploads/expenses/'), $image_name);
		    $expense->voucher_img = $image_name;
		}
		
		$expense->status = 1;
		$expense->user_sys = \Request::ip();
		$expense->updated_by = Auth::id();
		$expense->created_by = Auth::id();
		
		$result = $expense->save();

		$id = $expense->id;
		$amount = $expense->amount;
		$detailid = $request->detailid;
		$supply_type = $request->type;
		$supply_category = $request->category;
		$expense_category = $request->expense_category;
		$description = $request->description;
		$code = $request->code;
		$cost = $request->cost;
		$quantity = $request->quantity;
		$sgst = $request->sgst;
		$cgst = $request->cgst;
		$igst = $request->igst;

		for($i = 0; $i < count($cost); $i++){
			$expense_details = ExpenseDetail::find($detailid[$i]);
			$expense_details->expense_id = $id;
			$expense_details->category1 = $supply_type[$i];
			$expense_details->category2 = $supply_category[$i];
			$expense_details->category3 = $expense_category[$i];
			$expense_details->description = $description[$i];
			$expense_details->code = $code[$i];
			$expense_details->cost = $cost[$i];
			$expense_details->quantity = $quantity[$i];
			$expense_details->sgst = $sgst[$i];
			$expense_details->cgst = $cgst[$i];
			$expense_details->igst = $igst[$i];
			$expense_details->user_sys = \Request::ip();
			$expense_details->updated_by = Auth::id();
			$expense_details->created_by = Auth::id();
			$expense_details->save();
			$amount += $cost[$i] + $sgst[$i] +  $cgst[$i] + $igst[$i];
		}
		
//		$transaction = Transaction::find('ET13');dd($transaction);
//		$transaction->txn_date = $expense->voucher_date;
//		$transaction->txn_type = $expense->expense_category;
//		$transaction->voucher_no = $expense->voucher_no;
//		$transaction->voucher_date = $expense->voucher_date;
//		$transaction->amt_deduct = $expense->amount;
//		$transaction->user_sys = \Request::ip();
//		$transaction->updated_by = Auth::id();
//		$transaction->particulars = Auth::user()->name.' spent '.$expense->amount.' to purchase '.$expense->subject;
//		$result2 = $transaction->save();
		
		if($result){
			return redirect()->back()->with('success', 'Record updated successfully!');
		}
		else{
			return redirect()->back()->with('error', 'Something went wrong!');
		}
    }

    public function destroy($id)
    {
        $expense = Expense::find($id);
        $expense->status = 2;
        $result = $expense->save();
        
        if($result){
			return redirect()->back()->with('success', 'Record deleted successfully!');
		}
		else{
			return redirect()->back()->with('error', 'Something went wrong!');
		}
    }
}
