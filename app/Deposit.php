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
		
		return DB::table('deposits')
			->select('deposits.*', 'users.name as user')
			->where([
			['deposits.deleted_at',null]
			])
            ->leftJoin('users', 'users.id', '=', 'deposits.to_user')
            ->get();
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
}
