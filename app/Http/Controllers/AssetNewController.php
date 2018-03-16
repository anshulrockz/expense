<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\AssetNew;
use App\Location;
use App\Vehicle;
use App\AssetCategory;
use App\SubAsset;
use Auth;

class AssetNewController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function index()
    {
    	$asset_new = AssetNew::user_all();
		return view('asset-new.index')->with('asset',$asset_new);
    }

    public function create()
    {
    	$workshop = Location::all();
    	$asset_new_category = AssetCategory::all();
    	$voucher_no = AssetNew::lastid(); 
    	if(empty($voucher_no->id)) $voucher_no = 0;
    	else $voucher_no = $voucher_no->id;
    	$voucher_no = $voucher_no + 1;
    	$voucher_no = 'AST'.$voucher_no;
        return view('asset-new.create')->with(array('asset_category' => $asset_new_category, 'voucher_no' => $voucher_no, 'workshop' => $workshop));
    }

    public function store(Request $request)
    {	
    	$this->validate($request,[
			'amount'=>'required|numeric',
		]);

		$asset_new = new AssetNew;
		
		$main_category_name = AssetCategory::find($request->asset_category)->pluck('name');
		$asset_new->main_category = $main_category_name[0];

		if(!empty($request->sub_asset))
		{
			$main_category_name = SubAsset::find($request->asset_category)->pluck('name');
			$asset_new->sub_category = $main_category_name[0];
		}
		
		if(!empty($request->file('voucher_img')))
		{
			$image = $request->file('voucher_img');
			$image_name = time().'.'.$image->getClientOriginalExtension();
			$image->move(public_path('uploads/assets/'), $image_name);
		    $asset_new->voucher_img = $image_name;
		}

		$date = $request->make;
		$asset_new->make = date_format(date_create($date),"Y-m-d");
		$date = $request->invoice_date;
		$asset_new->invoice_date = date_format(date_create($date),"Y-m-d");
		$date = $request->expiry;
		$asset_new->expiry = date_format(date_create($date),"Y-m-d");
		$asset_new->invoice_no = $request->invoice_no;
		$asset_new->vendor_name = $request->party_name;
		$asset_new->vendor_gstin = $request->gstin;
		$asset_new->code = $request->code;
		$asset_new->location = $request->location;
		$asset_new->model = $request->model;
		$asset_new->amount = $request->base_amount;
		$asset_new->base_amount = $request->base_amount;
		$asset_new->tax_value = $request->tax;
		$asset_new->remarks = $request->remarks;
		$asset_new->status = 1;
		$asset_new->user_sys = \Request::ip();
		$asset_new->updated_by = Auth::id();
		$asset_new->created_by = Auth::id();
		$result = $asset_new->save();
		
		$id = $asset_new->id;
		$asset_new = AssetNew::find($id);
		$asset_new->voucher_no = 'AST'.$id;
		$result = $asset_new->save();
		
		if($request->asset_category == 2)
		{
			$vehicle = new Vehicle;
			$vehicle->asset_id = $asset_new->id;
			$date = $request->insurance;
			$vehicle->insurance = date_format(date_create($date),"Y-m-d");
			$date = $request->puc;
			$vehicle->puc = date_format(date_create($date),"Y-m-d");
			$vehicle->registration = $request->registration;
			$vehicle->voucher_no = $asset_new->voucher_no;
			$result2 = $vehicle->save();
		}
		
		if($result){
			return back()->with('success', 'Record added successfully! Your asset ID:'.$asset_new->voucher_no);
		}
		else{
			return back()->with('error', 'Something went wrong!');
		}
    }

    public function show($id)
    {
        $asset_new = AssetNew::find($id);
        return view('asset-new.show')->with('asset', $asset_new);
    }

    public function edit($id)
    {
    	$location = Location::all();
    	$asset_new_category = AssetCategory::all();
        $asset_new = AssetNew::find($id);
        $vehicle = AssetNew::find($id)->Vehicle;
        return view('asset-new.edit')->with(array('location' => $location, 'asset' => $asset_new, 'asset_category' => $asset_new_category, 'vehicle' => $vehicle));
    }

    public function update(Request $request, $id)
    {
        $this->validate($request,[
			'amount'=>'required|numeric',
		]);
		
		$asset_new = AssetNew::find($id);
		$main_category_name = AssetCategory::all()->where('id',$request->asset_category)->pluck('name');
		$asset_new->main_category = $main_category_name[0];
		if(!empty($request->sub_asset))
		{
			$main_category_name = SubAssetNew::all()->where('id',$request->asset_category)->pluck('name');
			$asset_new->sub_category = $main_category_name[0];
		}
		if(!empty($request->file('voucher_img')))
		{
			$image = $request->file('voucher_img');
			$image_name = time().'.'.$image->getClientOriginalExtension();
			$image->move(public_path('uploads/assets/'), $image_name);
		    $asset_new->voucher_img = $image_name;
		}
		$date = $request->make;
		$asset_new->make = date_format(date_create($date),"Y-m-d");
		$date = $request->invoice_date;
		$asset_new->invoice_date = date_format(date_create($date),"Y-m-d");
		$date = $request->expiry;
		$asset_new->expiry = date_format(date_create($date),"Y-m-d");
		$asset_new->invoice_no = $request->invoice_no;
		$asset_new->vendor_name = $request->party_name;
		$asset_new->vendor_gstin = $request->gstin;
		$asset_new->code = $request->code;
		$asset_new->location = $request->location;
		$asset_new->model = $request->model;
		$asset_new->amount = $request->base_amount;
		$asset_new->base_amount = $request->base_amount;
		$asset_new->tax_value = $request->tax;
		$asset_new->remarks = $request->remarks;
		$asset_new->user_sys = \Request::ip();
		$asset_new->updated_by = Auth::id();
		$asset_new->created_by = Auth::id();
		$result = $asset_new->save();
		
		if($request->category == 'vehicle')
		{
			$vehicle = AssetNew::find($id)->Vehicle;
			$vehicle->parent_id = $asset_new->id;
			$vehicle->registration = $request->registration;
			$vehicle->make = $request->vehicle_make;
			$date = $request->insurance;
			$vehicle->insurance = date_format(date_create($date),"Y-m-d");
			$date = $request->puc;
			$vehicle->puc = date_format(date_create($date),"Y-m-d");
			$result2 = $vehicle->save();
		}
		
		if($result){
			return redirect()->back()->with('success', 'Record updated successfully!');
		}
		else{
			return redirect()->back()->with('error', 'Something went wrong!');
		}
    }

    public function destroy($id)
    {
        $asset_new = AssetNew::find($id)->delete();
        
        if($result){
			return redirect()->back()->with('success', 'Record deleted successfully!');
		}
		else{
			return redirect()->back()->with('error', 'Something went wrong!');
		}
    }
}
