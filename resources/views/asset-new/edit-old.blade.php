@extends('layouts.app')

@section('content')
<!-- Bootstrap Material Datetime Picker Css -->
<link href="{{ asset('bsb/plugins/bootstrap-material-datetimepicker/css/bootstrap-material-datetimepicker.css')}}" rel="stylesheet" />

<!-- Bootstrap Select Css -->
<link href="{{ asset('bsb/plugins/bootstrap-select/css/bootstrap-select.css')}}" rel="stylesheet" />

<!-- Dropzone Css -->
<link href="{{ asset('bsb/plugins/dropzone/dropzone.css')}}" rel="stylesheet"/>

<!-- AJAX DD Selecter for Location Js -->
<script>
$(function(){
	$("#asset_category").change(function(){
		var id = $(this).val();
		if(id != ''){
			$.ajax({
				type: "GET",
				url: "{{url('/subassets/ajax')}}",
				data:'id='+id,
				success: function(data){
					var data = JSON.parse(data);
					var selOpts = "";
					if(data.length >0){				
						$('#sub_asset option').remove();	
						console.log(data);
			            for (i=0;i<data.length;i++)
			            {
			                var id = data[i].id; 
			                var val = data[i].name;
			                selOpts += "<option value='"+id+"'>"+val+"</option>";
			            }
			            $('.sub_asset').show();
			            $('#sub_asset').append(selOpts);
					}
					else{
						$('.sub_asset').hide();
						$('#sub_asset option').remove();
					}
				}
			});
		}
	});
});

$(document).ready(function() {
	
	if ($('#radio_1').is(':checked'))
	{
		$('.vehicle').show();
		$("#registration").removeAttr('disabled','disabled');	
		$("#vehicle_make").removeAttr('disabled','disabled');	
		$("#puc").removeAttr('disabled','disabled');	
		$("#insurance").removeAttr('disabled','disabled');	
	}
	else
	{
		$('.vehicle').hide();
		$("#registration").attr('disabled','disabled');	
		$("#vehicle_make").attr('disabled','disabled');	
		$("#puc").attr('disabled','disabled');	
		$("#insurance").attr('disabled','disabled');
	}
		
	
	$("#radio_1").click(function() {
		if ($('#radio_1').is(':checked')) 
			$('.vehicle').show();
		else
			$('.vehicle').hide();
	});
});
</script>

<div class="row clearfix">
	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="card">
        	<div class="header">
                <h2>
                    Asset
                </h2>
            </div>
            <div class="body">
                <ol class="breadcrumb breadcrumb-bg-pink">
                    <li><a href="{{ url('/dashboard') }}">Home</a></li>
                    <li><a href="{{ url('/assets') }}">Asset</a></li>
                    <li><a href="{{ url('/assets/'.$asset->id) }}">{{$asset->voucher_no}}</a></li>
                    <li class="active">Edit</li>
                </ol>
            </div>
        </div>
    </div>
</div>

<div class="row clearfix">
	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
		@include('layouts.flashmessage')
	</div>
</div>

<div class="row clearfix">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="card">
            <div class="header">
                <h2>
                    Details
                </h2>
            </div>
            <div class="body">
            	<form method="post" action="{{route('new.update',$asset->id)}}" enctype="multipart/form-data">
                	{{ csrf_field() }}
	                {{ method_field('PUT') }}
                	 <div class="row clearfix">
	                	<div class="col-sm-6">
		                    <label for="voucher_no">Voucher No.(auto)</label>
		                    <div class="form-group">
		                        <div class="form-line">
		                            <input type="text" id="voucher_no" name="voucher_no" class="form-control" placeholder="Enter voucher number" value="{{ $asset->voucher_no }}" disabled>
		                        </div>
		                    </div>
	                    </div>
                	 	<div class="col-sm-6">
		                    <label for="voucher_date">Voucher Date</label>
		                    <div class="form-group">
		                        <div class="form-line">
		                            <input type="text" id="voucher_date" name="voucher_date" class="form-control datepicker" placeholder="Enter Date Of voucher" value="{{  date_format(date_create($asset->voucher_date), 'd F Y') }}" required>
		                        </div>
		                    </div>
	                    </div>
	                </div>
	                <div class="row clearfix">
	                    <div class="col-sm-6">
		                    <label for="invoice_no">Invoice No.</label>
		                    <div class="form-group">
		                        <div class="form-line">
		                            <input type="text" id="invoice_no" name="invoice_no" class="form-control " placeholder="Enter Invoice number" value="{{ $asset->invoice_no }}" >
		                        </div>
		                    </div>
	                    </div>
	                    <div class="col-sm-6">
		                    <label for="invoice_date">Invoice Date</label>
		                    <div class="form-group">
		                        <div class="form-line">
		                            <input type="text" id="invoice_date" name="invoice_date" class="form-control datepicker" placeholder="Enter Date Of Invoice" value="{{ date_format(date_create($asset->invoice_date), 'd F Y') }}" >
		                        </div>
		                    </div>
	                    </div>
	                    <div class="col-sm-6 ">
		                    <label for="subject">Model</label>
		                    <div class="form-group">
		                        <div class="form-line">
		                            <input type="text" id="subject" name="subject" class="form-control" placeholder="Enter subject or item name" value="{{ $asset->model }}" >
		                        </div>
		                    </div>
	                    </div>
	                    <div class="col-sm-6 ">
		                    <label for="vendor">Party Name</label>
		                    <div class="form-group">
		                        <div class="form-line">
		                            <input type="text" id="vendor" name="vendor" class="form-control" placeholder="Enter vendor name" value="{{ $asset->vendor_name }}" >
		                        </div>
		                    </div>
	                    </div>
	                    <div class="col-sm-6 ">
		                    <label for="amount">Amount</label>
		                    <div class="form-group">
		                        <div class="form-line">
		                            <input type="text" id="amount" name="amount" class="form-control" placeholder="Enter amount" value="{{ $asset->amount }}" required>
		                        </div>
		                    </div>
	                    </div>
	                    <div class="col-sm-6 ">
		                    <label for="voucher_img">Upload Invoice/Voucher</label>
		                    <div class="form-group">
		                        <div class="form-line">
	                                <div class="fallback">
	                                    <input name="voucher_img" id="voucher_img" class="form-control" type="file" placeholder="img only" value="{{ $asset->voucher_img }}" />
	                                </div>
			                    </div>
		                    </div>
	                    </div>
	                </div>
	                <div class="row clearfix">
	                    <div class="col-sm-6 ">
		                    <label for="asset_category">Asset Category</label>
		                    <div class="form-group">
			                    <div class="form-line">
			                        <select class="form-control show-tick" id="asset_category" name="asset_category">
			                            <option value="" >-- Please select asset category --</option>
			                            @foreach($asset_category as $list)
			                            <option value="{{$list->id}}" @if($list->name == $asset->main_category) selected="selected" @endif >{{$list->name}}</option>
			                            @endforeach
			                        </select>
		                    	</div>
	                    	</div>
	                    </div>
	                	<div class="col-sm-6 sub_asset">
		                    <label for="sub_asset">Sub Category</label>
		                    <div class="form-group">
			                    <div class="form-line">
			                        <select class="form-control show-tick" id="sub_asset" name="sub_asset">
			                        	<option value="" >{{ $asset->sub_category }}</option>
			                            
			                        </select>
		                    	</div>
	                    	</div>
	                    </div>
	                     <div class="col-sm-6">
	                    	<label for=""> </label>
			                <div class="form-group">
			                    <div class="demo-radio-button">
	                                <input name="category" type="checkbox" id="radio_1" value="vehicle" 
	                                @if(!empty($vehicle)) checked @endif />
	                                <label for="radio_1"><b>Is asset a vehicle?</b></label>
	                            </div>
	                        </div>
	                    </div>
	                </div>
	                <div class="row clearfix vehicle">
	                    <div class="col-sm-6 ">
		                    <label for="registration">Registration No.</label>
		                    <div class="form-group">
		                        <div class="form-line">
		                            <input type="text" id="registration" name="registration" class="form-control" placeholder="Enter registration no"  @if(!empty($vehicle->registration)) value="{{ $vehicle->registration }}" @endif >
		                        </div>
		                    </div>
	                    </div>
	                    <div class="col-sm-6 ">
		                    <label for="vehicle_make">Vehicle Make(YYYY)</label>
		                    <div class="form-group">
		                        <div class="form-line">
		                            <input type="text" id="vehicle_make" name="vehicle_make" class="form-control" placeholder="Enter vehicle make" @if(!empty($vehicle->make)) value="{{ $vehicle->make }}" @endif >
		                        </div>
		                    </div>
	                    </div>
	                    <div class="col-sm-6 ">
		                    <label for="insurance">Insurance Validity</label>
		                    <div class="form-group">
		                        <div class="form-line">
		                            <input type="text" id="insurance" name="insurance" class="form-control datepicker" placeholder="Enter insurance validity" @if(!empty($vehicle->insurance)) value="{{ date_format(date_create($vehicle->insurance), 'd F Y') }}" @endif >
		                        </div>
		                    </div>
	                    </div>
	                    <div class="col-sm-6 ">
		                    <label for="puc">PUC Validity</label>
		                    <div class="form-group">
		                        <div class="form-line">
		                            <input type="text" id="puc" name="puc" class="form-control datepicker" placeholder="Enter puc validity"  @if(!empty($vehicle->puc)) value="{{ date_format(date_create($vehicle->puc), 'd F Y') }}" @endif >
		                        </div>
		                    </div>
	                    </div>
	                </div>
	                <div class="row clearfix">
	                	<div class="col-sm-6 ">
		                    <label for="expiry">Expiry Date</label>
		                    <div class="form-group">
		                        <div class="form-line">
		                            <input type="text" id="expiry" name="expiry" class="form-control datepicker" placeholder="Enter expiry/warranty/validity date" value="{{ date_format(date_create($asset->expiry), 'd F Y') }}" >
		                        </div>
		                    </div>
	                    </div>
	                    <div class="col-sm-6">
		                    <label for="remarks">Remark</label>
		                    <div class="form-group">
		                        <div class="form-line">
		                            <textarea id="remarks" name="remarks" rows="1" class="form-control no-resize auto-growth" placeholder="Remarks if any... (press ENTER for more lines)">{{ $asset->remarks }}</textarea>
		                        </div>
		                    </div>
	                    </div>
	                </div>
	                <div class="row clearfix">
	                	<div class="col-sm-6">
	                		<button type="submit" class="btn btn-primary m-t-15 waves-effect">Save</button>
	                	</div>
	                </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Moment Plugin Js -->
<script src="{{ asset('bsb/plugins/momentjs/moment.js')}}"></script>

<!-- Bootstrap Material Datetime Picker Plugin Js -->
<script src="{{ asset('bsb/plugins/bootstrap-material-datetimepicker/js/bootstrap-material-datetimepicker.js')}}"></script>

<!-- Dropzone Plugin Js -->
<script src="{{ asset('bsb/plugins/dropzone/dropzone.js')}}"></script>

<script>
	$('.datepicker').bootstrapMaterialDatePicker({
        format: 'DD MMMM YYYY',
        clearButton: true,
        weekStart: 1,
        time: false
    });
    
    Dropzone.options.frmFileUpload = {
        paramName: "file",
        maxFilesize: 2
    };
</script>
    
@endsection
