<?php

namespace App;

use DB;
use Auth;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Asset extends Model
{
    use SoftDeletes;
    protected $dates = ['deleted_at'];
    
    public function Vehicle()
    {
        return $this->hasOne('App\Vehicle', 'asset_id','id');
    }
	
	public static function user_all()
	{
		$company = Auth::user()->company_id;
		$id = Auth::user()->id;
		$user_type = Auth::user()->user_type;
		
			return DB::table('assets')
			->select('assets.*', 'users.name as user')
			->where([
			['users.company_id',$company],
			['assets.created_by',$id],
			['assets.deleted_at',null]
			])
            ->leftJoin('users', 'users.id', '=', 'assets.created_by')
            ->get();
		
		
	}
	
	public static function lastid()
	{
		return DB::table('assets')->orderBy('id', 'desc')->first();
	}

	public static function asset_detail()
	{
		return DB::table('assets')
				->select( "main_category", "sub_category", DB::raw('SUM(amount) as total') )
				->groupBy('main_category', 'sub_category')
				->get();
	}
}
