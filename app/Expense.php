<?php

namespace App;

use DB;
use Auth;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Expense extends Model
{
    use SoftDeletes;
    protected $dates = ['deleted_at'];

	public static function lastid()
	{
		return DB::table('expenses')->orderBy('id', 'desc')->first();
	}

	public function UserDetails()
    {
        return $this->hasOne('App\User', 'id','created_by')->pluck('name');
    }

    public function ExpenseDetails()
    {
        return $this->hasMany('App\ExpenseDetail', 'expense_id');
    }
    
    public static function super_admin_all()
	{
		return DB::table('expenses')
			->select('expenses.*', 'users.name as user')
			->where([
			['expenses.deleted_at',null]
			])
            ->leftJoin('users', 'users.id', '=', 'expenses.created_by')
            ->orderBy('expenses.id', 'DESC')
            ->groupBy('expenses.id')
            ->get();
		
	}
	
	public static function workshop_all()
	{
		$company = Auth::user()->company_id;
		$workshop = Auth::user()->workshop_id;
		$id = Auth::user()->id;
		$user_type = Auth::user()->user_type;
		
			return DB::table('expenses')
			->select('expenses.*', 'users.name as user')
			->where([
			['users.company_id',$company],
			['users.workshop_id',$workshop],
			['users.id','=', $id],
			['users.id','!=', 1],
			['expenses.deleted_at',null]
			])
            ->leftJoin('users', 'users.id', '=', 'expenses.created_by')
            ->orderBy('expenses.id', 'DESC')
            ->get();
		
		
	}
	
	public static function user_all()
	{
		$company = Auth::user()->company_id;
		$id = Auth::user()->id;
		$user_type = Auth::user()->user_type;
		
			return DB::table('expenses')
			->select('expenses.*', 'users.name as user')
			->where([
			['users.company_id',$company],
			['expenses.created_by',$id],
			['expenses.deleted_at',null]
			])
            ->leftJoin('users', 'users.id', '=', 'expenses.created_by')
            ->orderBy('expenses.id', 'DESC')
            ->get();
		
		
	}
	
    public static function balance()
	{
		$id = Auth::user()->id;
		$deposits = DB::table('deposits')
			->select(DB::raw('sum(amount) as amt'))
			->where([
			['deposits.to_user',$id],
			['deposits.deleted_at',null]
			])
            ->first();
            
        $expenses = DB::table('expenses')
			->select(DB::raw('sum(expenses.amount) as expenses'))
			->where([
			['expenses.created_by',$id],
			['expenses.deleted_at',null]
			])
            ->first();
            
        return $deposits->amt - $expenses->expenses;
	}
	
    public static function expense_bar_chart()
	{
		$company = Auth::user()->company_id;
		$workshop = Auth::user()->workshop_id;
		$id = Auth::user()->id;
		$user_type = Auth::user()->user_type;

		if($user_type == 1){
			return DB::table('expense_details')
					->select( DB::raw('YEAR(expense_details.created_at) AS y'), DB::raw('MONTH(expense_details.created_at) AS m'), DB::raw('SUM(expense_details.cost) as total') )
					//->where( DB::raw('YEAR(created_at)'),"2018")
					->where([
						    [ DB::raw('YEAR(expense_details.created_at)'),"2018"],
						    ['expense_details.deleted_at', null],
							])
					->groupBy('y', 'm')
					->orderBy('m', 'asc')
					->get();
		}

		if($user_type == 3){
			return DB::table('expense_details')
					->select( DB::raw('YEAR(expense_details.created_at) AS y'), DB::raw('MONTH(expense_details.created_at) AS m'), DB::raw('SUM(expense_details.cost) as total') )
					//->where( DB::raw('YEAR(created_at)'),"2018")
					->where([
						    [ DB::raw('YEAR(expense_details.created_at)'),"2018"],
						    ['expense_details.deleted_at', null],
						    ['users.workshop_id', $workshop],
					    	//['users.id', $id]
							])
		            ->leftJoin('users', 'users.id', '=', 'expense_details.created_by')
					->groupBy('y', 'm')
					->orderBy('m', 'asc')
					->get();
		}

		else{
			return DB::table('expense_details')
					->select( DB::raw('YEAR(expense_details.created_at) AS y'), DB::raw('MONTH(expense_details.created_at) AS m'), DB::raw('SUM(expense_details.cost) as total') )
					//->where( DB::raw('YEAR(created_at)'),"2018")
					->where([
						    [ DB::raw('YEAR(expense_details.created_at)'),"2018"],
						    ['expense_details.deleted_at', null],
						    ['users.id', $id]
							])
		            ->leftJoin('users', 'users.id', '=', 'expense_details.created_by')
					->groupBy('y', 'm')
					->orderBy('m', 'asc')
					->get();
		}
	}

	public static function expense_pie_chart()
	{
		$company = Auth::user()->company_id;
		$workshop = Auth::user()->workshop_id;
		$id = Auth::user()->id;
		$user_type = Auth::user()->user_type;

		if($user_type == 1){
			return DB::table('expense_details')
				->select( "category1", "category2", "category3", DB::raw('SUM(cost) as total'), DB::raw('SUM(sgst) as sgst'), DB::raw('SUM(cgst) as cgst'), DB::raw('SUM(igst) as igst') )
				->where('deleted_at',null)
				->groupBy('category1', 'category2', 'category3')
				->get();
		}
		
		if($user_type == 3){
			return DB::table('expense_details')
				->select( "category1", "category2", "category3", DB::raw('SUM(cost) as total'), DB::raw('SUM(sgst) as sgst'), DB::raw('SUM(cgst) as cgst'), DB::raw('SUM(igst) as igst') )
				->where([
					    ['expense_details.deleted_at', null],
					    ['users.workshop_id', $workshop]
						])
	            ->leftJoin('users', 'users.id', '=', 'expense_details.created_by')
				->groupBy('category1', 'category2', 'category3')
				->get();
		}

		else{
			return DB::table('expense_details')
				->select( "category1", "category2", "category3", DB::raw('SUM(cost) as total'), DB::raw('SUM(sgst) as sgst'), DB::raw('SUM(cgst) as cgst'), DB::raw('SUM(igst) as igst') )
				->where([
					    ['expense_details.deleted_at', null],
					    ['users.workshop_id', $workshop],
					    ['users.id', $id]
						])
	            ->leftJoin('users', 'users.id', '=', 'expense_details.created_by')
				->groupBy('category1', 'category2', 'category3')
				->get();
		}
	}

	// public static function top_balance()
	// {
 //        return DB::table('deposits')
 //        ->select('to_user', DB::raw('sum(deposits.amount) as depo'), DB::raw('sum(expenses.amount) as exp'))
 //        ->groupBy('deposits.to_user')
 //        ->groupBy('expenses.created_by')
 //        ->leftJoin('expenses', 'deposits.to_user', '=', 'expenses.created_by')
	//     ->get();
	// }
}
