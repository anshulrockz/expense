<?php

if (! function_exists('date_dfy')) {
    function date_dfy($date){
		if($date == '' || $date == '0000-00-00' || $date == '0000-00-00 00:00:00'){
			return '';
		}
		else{
			return date_format(date_create($date),"d-F-Y");
		}
	}
}