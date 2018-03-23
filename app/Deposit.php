<?php

namespace App;

use DB;
use Auth;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Deposit extends Model
{
    use SoftDeletes;
    protected $dates = ['deleted_at'];


    public function UserDetails()
    {
        return $this->hasOne('App\User', 'id','to_user');
    }
    
    public static function all_deposits()
	{
		$company = Auth::user()->company_id;
		$workshop = Auth::user()->workshop_id;
		$id = Auth::user()->id;
		$user_type = Auth::user()->user_type;
		

        if($user_type == 4){
			return DB::table('deposits')
			->select('deposits.*', 'users.name as user')
			->where([
			['deposits.deleted_at',null],
					    ['users.workshop_id', $workshop],
					    ['deposits.to_user', $id],
					    ['users.id', $id]
						])
	            ->leftJoin('users', 'users.id', '=', 'deposits.to_user')
				->get();
		}

		else{
		return DB::table('deposits')
			->select('deposits.*', 'users.name as user')
			->where([
			['deposits.deleted_at',null]
			])
            ->leftJoin('users', 'users.id', '=', 'deposits.to_user')
            ->get();
		}
	}
	
	public static function workshop_deposits()
	{
		$id = Auth::user()->id;
		$company = Auth::user()->company_id;
		$workshop = Auth::user()->workshop_id;
		
		return DB::table('deposits')
			->select('deposits.*', 'users.name as user')
			->where([
			['users.company_id',$company],
			['users.workshop_id',$workshop],
			['deposits.created_by',$id],
			['deposits.deleted_at',null]
			])
            ->leftJoin('users', 'users.id', '=', 'deposits.to_user')
            ->get();
	}

	public static function deposit_bar_chart()
	{
		$company = Auth::user()->company_id;
		$workshop = Auth::user()->workshop_id;
		$id = Auth::user()->id;
		$user_type = Auth::user()->user_type;

		if($user_type == 1){
			return DB::table('deposits')
				->select( DB::raw('YEAR(created_at) AS y'), DB::raw('MONTH(created_at) AS m'), DB::raw('SUM(amount) as total') )
				->where( DB::raw('YEAR(created_at)'), "=","2018")
				->groupBy('y', 'm')
					->orderBy('m', 'asc')
				->get();
		}

		if($user_type == 3){
			return DB::table('deposits')
				->select( DB::raw('YEAR(deposits.created_at) AS y'), DB::raw('MONTH(deposits.created_at) AS m'), DB::raw('SUM(deposits.amount) as total') )
				->where([
					    ['deposits.deleted_at', null],
					    ['users.workshop_id', $workshop],
					    //['users.id', $id]
						])
	            ->leftJoin('users', 'users.id', '=', 'deposits.to_user')
				->groupBy('y', 'm')
				->get();
		}

		if($user_type == 4){
			return DB::table('deposits')
				->select( DB::raw('YEAR(deposits.created_at) AS y'), DB::raw('MONTH(deposits.created_at) AS m'), DB::raw('SUM(deposits.amount) as total') )
				->where([
					    ['deposits.deleted_at', null],
					    ['users.workshop_id', $workshop],
					    ['deposits.to_user', $id],
					    ['users.id', $id]
						])
	            ->leftJoin('users', 'users.id', '=', 'deposits.to_user')
				->groupBy('y', 'm')
					->orderBy('m', 'asc')
				->get();
		}
	}

	public static function deposit_table()
	{
		return DB::table('deposits')
				->where( DB::raw('YEAR(created_at)'), "=","2018")
				->groupBy('y', 'm')
				->get();
	}
}
