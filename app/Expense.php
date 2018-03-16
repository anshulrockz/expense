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
}
