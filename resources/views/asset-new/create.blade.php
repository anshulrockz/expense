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
			if (id == 2) 
			$('.vehicle').show();
			else
			$('.vehicle').hide();

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
		else{
			$('.sub_asset').hide();
			$('#sub_asset option').remove();
		}
	});
});

$(document).ready(function() {
	$('.vehicle').hide();
	$('.sub_asset').hide();

	$('.vehicle').on('keyup', '#tax', function(e){
		e.preventDefault();
	    var cost = $('#base_amount').val();
		var tax = $('#tax').val();
		if(cost < 1) cost = 0;
		if(tax < 1) tax = 0;
		total_tax = (cost*tax)/100;
	    total_amount = parseFloat(cost)+parseFloat(total_tax);

    	$('#total_tax').val(parseFloat(total_tax).toFixed(2));
		$('#total_amount').val(parseFloat(total_amount).toFixed(2));
		//alert(total_tax);
	});

	$('.vehicle').on('keyup', '#base_amount', function(e){
		e.preventDefault();
	    var cost = $('#base_amount').val();
		var tax = $('#tax').val();
		if(cost < 1) cost = 0;
		if(tax < 1) tax = 0;
		total_tax = (cost*tax)/100;
	    total_amount = parseFloat(cost)+parseFloat(total_tax);

    	$('#total_tax').val(parseFloat(total_tax).toFixed(2));
		$('#total_amount').val(parseFloat(total_amount).toFixed(2));
		//alert(total_tax);
	});
});

</script>

<div class="row clearfix">
	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="card">
        	<div class="header">
                <h2>
                    Asset New
                </h2>
            </div>
            <div class="body">
                <ol class="breadcrumb breadcrumb-bg-pink">
                    <li><a href="{{ url('/dashboard') }}">Home</a></li>
                    <li><a href="{{ url('/assets/new') }}">Asset New</a></li>
                    <li class="active">Create</li>
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
                <form method="post" action="{{route('new.store')}}" enctype="multipart/form-data">
                	{{ csrf_field() }}
                	 <div class="row clearfix">
	                	<div class="col-sm-3">
		                    <label for="voucher_no">Asset No.(auto)</label>
		                    <div class="form-group">
		                        <div class="form-line">
		                            <input type="text" id="voucher_no" name="voucher_no" class="form-control" placeholder="Enter voucher number" value="{{ $voucher_no }}" disabled>
		                        </div>
		                    </div>
	                    </div>
                	 	<div class="col-sm-3">
		                    <label for="voucher_date">Date</label>
		                    <div class="form-group">
		                        <div class="form-line">
		                            <input type="text" id="voucher_date" name="voucher_date" class="form-control datepicker" placeholder="Enter Date Of voucher" value="{{  date('d F Y') }}" disabled>
		                        </div>
		                    </div>
	                    </div>
	                    <div class="col-sm-3">
		                    <label for="invoice_no">Invoice No.</label>
		                    <div class="form-group">
		                        <div class="form-line">
		                            <input type="text" id="invoice_no" name="invoice_no" class="form-control" placeholder="Enter Invoice number" value="{{ old('invoice_no') }}" >
		                        </div>
		                    </div>
	                    </div>
	                    <div class="col-sm-3">
		                    <label for="invoice_date">Invoice Date</label>
		                    <div class="form-group">
		                        <div class="form-line">
		                            <input type="text" id="invoice_date" name="invoice_date" class="form-control datepicker" placeholder="Enter Date Of Invoice" value="{{ old('invoice_date') }}" >
		                        </div>
		                    </div>
	                    </div>
	                    <div class="col-sm-6 ">
		                    <label for="party_name">Party Name</label>
		                    <div class="form-group">
		                        <div class="form-line">
		                            <input type="text" id="party_name" name="party_name" class="form-control" placeholder="Enter party name" value="{{ old('party_name') }}" >
		                        </div>
		                    </div>
	                    </div>
	                    <div class="col-sm-6 ">
		                    <label for="gstin">Party GSTIN</label>
		                    <div class="form-group">
		                        <div class="form-line">
		                            <input type="text" id="gstin" name="gstin" class="form-control" placeholder="Enter party gstin" value="{{ old('gstin') }}" >
		                        </div>
		                    </div>
	                    </div>
	                </div>
	                <div class="row clearfix ">
	                	<div class="col-sm-6 ">
		                    <label for="amount">Amount</label>
		                    <div class="form-group">
		                        <div class="form-line">
		                            <input type="text" id="amount" name="amount" class="form-control" placeholder="Enter amount no" value="{{ old('amount') }}" >
		                        </div>
		                    </div>
	                    </div>
	                	<div class="col-sm-3 ">
		                    <label for="location">Location</label>
		                    <div class="form-group">
			                    <div class="form-line">
			                        <select class="form-control show-tick" id="location" name="location">
			                            <option value="" >-- Please select location --</option>
			                            @foreach($workshop as $list)
			                            <option value="{{$list->name}}">{{$list->name}}</option>
			                            @endforeach
			                        </select>
		                    	</div>
	                    	</div>
	                    </div>
	                	<div class="col-sm-3 ">
		                    <label for="asset_category">Asset Category</label>
		                    <div class="form-group">
			                    <div class="form-line">
			                        <select class="form-control show-tick" id="asset_category" name="asset_category">
			                            <option value="" >-- Please select asset category --</option>
			                            @foreach($asset_category as $list)
			                            <option value="{{$list->id}}">{{$list->name}}</option>
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
			                            <option value="" >-- Please select sub category --</option>
			                           
			                        </select>
		                    	</div>
	                    	</div>
	                    </div>
	                </div>
	                <div class="row clearfix ">
	                    <div class="col-sm-3 ">
		                    <label for="model">Model</label>
		                    <div class="form-group">
		                        <div class="form-line">
		                            <input type="text" id="model" name="model" class="form-control" placeholder="Enter model or asset name" value="{{ old('model') }}" >
		                        </div>
		                    </div>
	                    </div>
	                    <div class="col-sm-3 ">
		                    <label for="code">HSN/SAC</label>
		                    <div class="form-group">
		                        <div class="form-line">
		                            <input type="text" id="code" name="code" class="form-control" placeholder="Enter HSN code" value="{{ old('code') }}" >
		                        </div>
		                    </div>
	                    </div>
	                    <div class="col-sm-3 ">
		                    <label for="make">Make</label>
		                    <div class="form-group">
		                        <div class="form-line">
		                            <input type="text" id="make" name="make" class="form-control datepicker" placeholder="Enter make asset name" value="{{ old('make') }}" >
		                        </div>
		                    </div>
	                    </div>
	                	<div class="col-sm-3 ">
		                    <label for="expiry">Expiry Date</label>
		                    <div class="form-group">
		                        <div class="form-line">
		                            <input type="text" id="expiry" name="expiry" class="form-control datepicker" placeholder="Enter expiry/warranty/validity date" value="{{ old('expiry') }}" required>
		                        </div>
		                    </div>
	                    </div>
	                    <!-- <div class="col-sm-6 ">
		                    <label for="amount">Amount</label>
		                    <div class="form-group">
		                        <div class="form-line">
		                            <input type="text" id="amount" name="amount" class="form-control" placeholder="Enter amount" value="{{ old('amount') }}" required>
		                        </div>
		                    </div>
	                    </div> -->
	                    <!-- <div class="col-sm-6">
	                    	<label for=""> </label>
			                <div class="form-group">
			                    <div class="demo-radio-button">
	                                <input name="category" type="checkbox" id="radio_1" value="vehicle" 
	                                @if(old('category')== 'purchase') checked @endif />
	                                <label for="radio_1"><b>Is asset a vehicle?</b></label>
	                            </div>
	                        </div>
	                    </div> -->
	                </div>
	                <div class="row clearfix vehicle">
	                	<div class="col-sm-3 ">
		                    <label for="base_amount">Base Amount</label>
		                    <div class="form-group">
		                        <div class="form-line">
		                            <input type="text" id="base_amount" name="base_amount" class="form-control" placeholder="Enter base amount no" value="{{ old('base_amount') }}" >
		                        </div>
		                    </div>
	                    </div>
	                    <div class="col-sm-3 ">
		                    <label for="tax">Tax %</label>
		                    <div class="form-group">
		                        <div class="form-line">
		                            <input type="text" id="tax" name="tax" class="form-control" placeholder="Enter tax no" value="{{ old('tax') }}" >
		                        </div>
		                    </div>
	                    </div>
	                    <div class="col-sm-3 ">
		                    <label for="total_tax">Tax Value</label>
		                    <div class="form-group">
		                        <div class="form-line">
		                            <input type="text" id="total_tax" name="total_tax" class="form-control" placeholder="Enter total_tax no" value="{{ old('total_tax') }}" >
		                        </div>
		                    </div>
	                    </div>
	                    <div class="col-sm-3 ">
		                    <label for="total_amount">Total Amount</label>
		                    <div class="form-group">
		                        <div class="form-line">
		                            <input type="text" id="total_amount" name="total_amount" class="form-control" placeholder="Enter total_amount no" value="{{ old('total_amount') }}" >
		                        </div>
		                    </div>
	                    </div>
	                    <div class="col-sm-3 ">
		                    <label for="registration">Registration No.</label>
		                    <div class="form-group">
		                        <div class="form-line">
		                            <input type="text" id="registration" name="registration" class="form-control" placeholder="Enter registration no" value="{{ old('registration') }}" >
		                        </div>
		                    </div>
	                    </div>
	                    <div class="col-sm-3 ">
		                    <label for="insurance">Insurance Validity</label>
		                    <div class="form-group">
		                        <div class="form-line">
		                            <input type="text" id="insurance" name="insurance" class="form-control datepicker" placeholder="Enter insurance validity" value="{{ old('insurance') }}" >
		                        </div>
		                    </div>
	                    </div>
	                    <div class="col-sm-3 ">
		                    <label for="puc">PUC Validity</label>
		                    <div class="form-group">
		                        <div class="form-line">
		                            <input type="text" id="puc" name="puc" class="form-control datepicker" placeholder="Enter puc validity" value="{{ old('puc') }}" >
		                        </div>
		                    </div>
	                    </div>
	                </div>
	                <div class="row clearfix">
	                    <div class="col-sm-6 ">
		                    <label for="voucher_img">Upload Invoice</label>
		                    <div class="form-group">
		                        <div class="form-line">
	                                <div class="fallback">
	                                    <input name="voucher_img" id="voucher_img" class="form-control" type="file" placeholder="img only"  />
	                                </div>
			                    </div>
		                    </div>
	                    </div>
	                    <div class="col-sm-6">
		                    <label for="remarks">Remark</label>
		                    <div class="form-group">
		                        <div class="form-line">
		                            <textarea id="remarks" name="remarks" rows="1" class="form-control no-resize auto-growth" placeholder="Remarks if any... (press ENTER for more lines)">{{ old('remarks') }}</textarea>
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
    
<!--<!-- Select Plugin Js ->
<script src="{{ asset('bsb/plugins/bootstrap-select/js/bootstrap-select.js')}}"></script>-->

@endsection
