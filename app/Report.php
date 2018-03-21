<?php

namespace App;

use DB;
use Carbon\Carbon;
use Auth;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Report extends Model
{
    use SoftDeletes;
    protected $dates = ['deleted_at'];
    
    public static function all_deposits()
	{
		$company = Auth::user()->company_id;
		$workshop = Auth::user()->workshop_id;
		$user_id = Auth::user()->id;
		
		if(Auth::user()->user_type == 1)
		{
			return DB::table('deposits')
				->select('deposits.*', 'users.name as user')
				->where([
				['users.company_id',$company],
				['deposits.deleted_at',null]
				])
	            ->leftJoin('users', 'users.id', '=', 'deposits.to_user')
	            //->leftJoin('users', 'users.id', '=', 'deposits.created_by')
	            ->get();
		}
		
		if(Auth::user()->user_type == 2)
		{
			return DB::table('deposits')
				->select('deposits.*', 'users.name as user')
				->where([
				['users.company_id',$company],
				['users.workshop_id',$workshop],
				['deposits.deleted_at',null]
				])
	            ->leftJoin('users', 'users.id', '=', 'deposits.to_user')
	            ->get();
		}
		
		if(Auth::user()->user_type == 3)
		{
			return DB::table('deposits')
				->select('deposits.*', 'users.name as user')
				->where([
				['users.company_id',$company],
				['users.workshop_id',$workshop],
				['users.id',$user_id],
				['deposits.deleted_at',null]
				])
	            ->leftJoin('users', 'users.id', '=', 'deposits.to_user')
	            ->get();
		}
	}
	
	public static function all_assets()
	{
		$company = Auth::user()->company_id;
		$workshop = Auth::user()->workshop_id;
		$user_id = Auth::user()->id;
		
		if(Auth::user()->user_type == 1)
		{
			return DB::table('assets')
				->select('assets.*', 'users.name as user')
				->where([
				['users.company_id',$company],
				['assets.deleted_at',null]
				])
	            ->leftJoin('users', 'users.id', '=', 'assets.created_by')
	            ->get();
		}
		
		if(Auth::user()->user_type == 2)
		{
			return DB::table('assets')
				->select('assets.*', 'users.name as user')
				->where([
				['users.company_id',$company],
				['users.workshop_id',$workshop],
				['assets.deleted_at',null]
				])
	            ->leftJoin('users', 'users.id', '=', 'assets.created_by')
	            ->get();
		}
		
		if(Auth::user()->user_type == 3)
		{
			return DB::table('assets')
				->select('assets.*', 'users.name as user')
				->where([
				['users.company_id',$company],
				['users.workshop_id',$workshop],
				['users.id',$user_id],
				['assets.deleted_at',null]
				])
	            ->leftJoin('users', 'users.id', '=', 'assets.created_by')
	            ->get();
		}
	}

	public static function all_asset_news()
	{
		$company = Auth::user()->company_id;
		$workshop = Auth::user()->workshop_id;
		$user_id = Auth::user()->id;
		
		if(Auth::user()->user_type == 1)
		{
			return DB::table('asset_news')
				->select('asset_news.*', 'users.name as user')
				->where([
				['users.company_id',$company],
				['asset_news.deleted_at',null]
				])
	            ->leftJoin('users', 'users.id', '=', 'asset_news.created_by')
	            ->get();
		}
		
		if(Auth::user()->user_type == 2)
		{
			return DB::table('asset_news')
				->select('asset_news.*', 'users.name as user')
				->where([
				['users.company_id',$company],
				['users.workshop_id',$workshop],
				['asset_news.deleted_at',null]
				])
	            ->leftJoin('users', 'users.id', '=', 'asset_news.created_by')
	            ->get();
		}
		
		if(Auth::user()->user_type == 3)
		{
			return DB::table('asset_news')
				->select('asset_news.*', 'users.name as user')
				->where([
				['users.company_id',$company],
				['users.workshop_id',$workshop],
				['users.id',$user_id],
				['asset_news.deleted_at',null]
				])
	            ->leftJoin('users', 'users.id', '=', 'asset_news.created_by')
	            ->get();
		}
	}
	
	public static function all_assets_expiry()
	{
		$company = Auth::user()->company_id;
		$workshop = Auth::user()->workshop_id;
		$user_id = Auth::user()->id;
		//$startDate = Carbon::now()->format('Y-m-d');
		$endDate = Carbon::now()->addMonths(1)->format('Y-m-d');
		
		if(Auth::user()->user_type == 1)
		{
			return DB::table('assets')
				->select('assets.*', 'users.name as user')
				->where([
				['users.company_id',$company],
				['assets.deleted_at',null],
				['assets.expiry','<=',$endDate],
				])
        		//->whereBetween('assets.expiry', [$startDate, $endDate])
	            ->leftJoin('users', 'users.id', '=', 'assets.created_by')
	            ->get();
		}
		
		if(Auth::user()->user_type == 2)
		{
			return DB::table('assets')
				->select('assets.*', 'users.name as user')
				->where([
				['users.company_id',$company],
				['users.workshop_id',$workshop],
				['assets.expiry','<=',$endDate],
				['assets.deleted_at',null]
				])
        		//->whereBetween('assets.expiry', [$startDate, $endDate])
	            ->leftJoin('users', 'users.id', '=', 'assets.created_by')
	            ->get();
		}
		
		if(Auth::user()->user_type == 3)
		{
			return DB::table('assets')
				->select('assets.*', 'users.name as user')
				->where([
				['users.company_id',$company],
				['users.workshop_id',$workshop],
				['users.id',$user_id],
				['assets.expiry','<=',$endDate],
				['assets.deleted_at',null]
				])
        		//->whereBetween('assets.expiry', [$startDate, $endDate])
        		->orderBy('assets.expiry')
	            ->leftJoin('users', 'users.id', '=', 'assets.created_by')
	            ->get();
		}
	}
	
	public static function all_expenses()
	{
		$company = Auth::user()->company_id;
		$workshop = Auth::user()->workshop_id;
		$user_id = Auth::user()->id;
		
		if(Auth::user()->user_type == 1)
		{
			return DB::table('expenses')
				->select('expenses.*', 'expense_details.*', 'users.name as user')
				->where([
				['users.company_id',$company],
				['expenses.deleted_at',null]
				])
	            ->leftJoin('users', 'users.id', '=', 'expenses.created_by')
	            ->leftJoin('expense_details', 'expense_details.expense_id', '=', 'expenses.id')
	            ->get();
		}
		
		if(Auth::user()->user_type == 2)
		{
			return DB::table('expenses')
				->select('expenses.*', 'expense_details.*', 'users.name as user')
				->where([
				['users.company_id',$company],
				['users.workshop_id',$workshop],
				['expenses.deleted_at',null]
				])
	            ->leftJoin('users', 'users.id', '=', 'expenses.created_by')
	            ->leftJoin('expense_details', 'expense_details.expense_id', '=', 'expenses.id')
	            ->get();
		}
		
		if(Auth::user()->user_type == 3)
		{
			return DB::table('expenses')
				->select('expenses.*', 'expense_details.*', 'users.name as user')
				->where([
				['users.company_id',$company],
				['users.workshop_id',$workshop],
				['users.id',$user_id],
				['expenses.deleted_at',null]
				])
	            ->leftJoin('users', 'users.id', '=', 'expenses.created_by')
	            ->leftJoin('expense_details', 'expense_details.expense_id', '=', 'expenses.id')
	            ->get();
		}
	}
	
	public static function all_transaction()
	{
		$company = Auth::user()->company_id;
		$workshop = Auth::user()->workshop_id;
		$user_id = Auth::user()->id;
		
		if(Auth::user()->user_type == 1)
		{
			return DB::table('transactions')
				->select('transactions.*', 'users.name as user')
				->where([
				['users.company_id',$company],
				['transactions.deleted_at',null]
				])
	            ->leftJoin('users', 'users.id', '=', 'transactions.created_by')
	            //->leftJoin('users', 'users.id', '=', 'transactions.created_by')
	            ->get();
		}
		
		if(Auth::user()->user_type == 2)
		{
			return DB::table('transactions')
				->select('transactions.*', 'users.name as user')
				->where([
				['users.company_id',$company],
				['users.workshop_id',$workshop],
				['transactions.deleted_at',null]
				])
	            ->leftJoin('users', 'users.id', '=', 'transactions.created_by')
	            ->get();
		}
		
		if(Auth::user()->user_type == 3)
		{
			return DB::table('transactions')
				->select('transactions.*', 'users.name as user')
				->where([
				['users.company_id',$company],
				['users.workshop_id',$workshop],
				['users.id',$user_id],
				['transactions.deleted_at',null]
				])
	            ->leftJoin('users', 'users.id', '=', 'transactions.created_by')
	            ->get();
		}
	}

	
}
