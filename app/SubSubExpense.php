<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class SubSubExpense extends Model
{
    use SoftDeletes;
    protected $dates = ['deleted_at'];
    
    public function bookingdetails_ajax($booking_no,$refund_type)
	{
		if($refund_type == '1'){
			$booking_details = DB::table('booking')
			->select('booking.*',DB::raw('SUM(total_amount) as sub_total'),DB::raw('SUM(security_total) as security_total'),DB::raw('SUM(servicetax_total) as service_tax'),DB::raw('SUM(vat_total) as vat'))
			->where([
			['booking_no',$booking_no],
			['booking_status','2'],
			['booking.status','1']
			])
            ->leftJoin('bookingfacility', 'bookingfacility.booking_id', '=', 'booking.id')
            ->groupBy('booking.id')
            ->get();
		}
		else{
			$booking_details = DB::table('booking')
			->select('booking.*',DB::raw('SUM(total_amount) as sub_total'),DB::raw('SUM(security_total) as security_total'),DB::raw('SUM(servicetax_total) as service_tax'),DB::raw('SUM(vat_total) as vat'))
			->where([
			['booking_no',$booking_no],
			['booking_status','1'],
			['booking.status','1']
			])
            ->leftJoin('bookingfacility', 'bookingfacility.booking_id', '=', 'booking.id')
            ->groupBy('booking.id')
            ->get();
		}
		print_r(json_encode( array($booking_details)));
	}
}
