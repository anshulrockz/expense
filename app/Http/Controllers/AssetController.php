<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Asset;
use App\Vehicle;
use App\AssetCategory;
use App\SubAsset;
use Auth;

class AssetController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function index()
    {
    	$asset = Asset::user_all();
		return view('asset.index')->with('asset',$asset);
    }

    public function create()
    {
    	$asset_category = AssetCategory::all();
    	$voucher_no = Asset::lastid();
    	if(empty($voucher_no->id)) $voucher_no = 0;
    	else $voucher_no = $voucher_no->id;
    	$voucher_no = $voucher_no + 1;
    	$voucher_no = 'ASO'.$voucher_no;
        return view('asset.create')->with(array('asset_category' => $asset_category, 'voucher_no' => $voucher_no));
    }

    public function store(Request $request)
    {
        $this->validate($request,[
			'amount'=>'required|numeric',
		]);
		
		$asset = new Asset;
		
		$main_category_name = AssetCategory::find($request->asset_category)->pluck('name');
		$asset->main_category = $main_category_name[0];
		if(!empty($request->sub_asset))
		{
			$main_category_name = SubAsset::find($request->sub_asset)->pluck('name');
			$asset->sub_category = $main_category_name[0];
		}
		if(!empty($request->file('voucher_img')))
		{
			$image = $request->file('voucher_img');
			$image_name = time().'.'.$image->getClientOriginalExtension();
			$image->move(public_path('uploads/assets/'), $image_name);
		    $asset->voucher_img = $image_name;
		}

		$date = $request->expiry;
		$asset->expiry = date_format(date_create($date),"Y-m-d");

		$asset->code = $request->code;
		$asset->party_name = $request->party_name;
		$asset->subject = $request->subject;
		$asset->amount = $request->amount;
		$asset->remarks = $request->remarks;
		$asset->status = 1;
		$asset->user_sys = \Request::ip();
		$asset->updated_by = Auth::id();
		$asset->created_by = Auth::id();
		$result = $asset->save();
		
		$id = $asset->id;
		$asset = Asset::find($id);
		$asset->voucher_no = 'ASO'.$id;
		$result = $asset->save();
		
		if($request->category == 'vehicle')
		{
			$vehicle = new Vehicle;
			$date = $request->insurance;
			$vehicle->insurance = date_format(date_create($date),"Y-m-d");
			$date = $request->puc;
			$vehicle->puc = date_format(date_create($date),"Y-m-d");
			$vehicle->registration = $request->registration;
			$vehicle->voucher_no = $asset->voucher_no;
			$vehicle->parent_id = $asset->id;
			$vehicle->make = $request->vehicle_make;
			$result2 = $vehicle->save();
		}
		
		if($result){
			return back()->with('success', 'Record added successfully! Your asset ID:'.$asset->voucher_no);
		}
		else{
			return back()->with('error', 'Something went wrong!');
		}
    }

    public function show($id)
    {
        $asset = Asset::find($id);
        return view('asset.show')->with('asset', $asset);
    }

    public function edit($id)
    {
    	$asset_category = AssetCategory::all();
        $asset = Asset::find($id);
        $vehicle = Asset::find($id)->Vehicle;
        return view('asset.edit')->with(array('asset' => $asset, 'asset_category' => $asset_category, 'vehicle' => $vehicle));
    }

    public function update(Request $request, $id)
    {
        $this->validate($request,[
			'amount'=>'required|numeric',
			'asset_category'=>'required',
		]);
		
		$asset = Asset::find($id);

		$main_category_name = AssetCategory::all()->where('id',$request->asset_category)->pluck('name');
		$asset->main_category = $main_category_name[0];

		if(!empty($request->sub_asset))
		{
			$main_category_name = SubAsset::all()->where('id',$request->asset_category)->pluck('name');
			$asset->sub_category = $main_category_name[0];
		}
		if(!empty($request->file('voucher_img')))
		{
			$image = $request->file('voucher_img');
			$image_name = time().'.'.$image->getClientOriginalExtension();
			$image->move(public_path('uploads/assets/'), $image_name);
		    $asset->voucher_img = $image_name;
		}
		$date = $request->voucher_date;
		$asset->voucher_date = date_format(date_create($date),"Y-m-d");
		$date = $request->invoice_date;
		$asset->invoice_date = date_format(date_create($date),"Y-m-d");
		$date = $request->expiry;
		$asset->expiry = date_format(date_create($date),"Y-m-d");
		$asset->invoice_no = $request->invoice_no;
		$asset->vendor_name = $request->vendor;
		$asset->subject = $request->subject;
		$asset->amount = $request->amount;
		$asset->remarks = $request->remarks;
		$asset->status = 1;
		$asset->user_sys = \Request::ip();
		$asset->updated_by = Auth::id();
		$asset->created_by = Auth::id();
		$result = $asset->save();
		
		if($request->category == 'vehicle')
		{
			$vehicle = Asset::find($id)->Vehicle;
			$vehicle->parent_id = $asset->id;
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
        $asset = Asset::find($id)->delete();
        
        if($result){
			return redirect()->back()->with('success', 'Record deleted successfully!');
		}
		else{
			return redirect()->back()->with('error', 'Something went wrong!');
		}
    }
}
