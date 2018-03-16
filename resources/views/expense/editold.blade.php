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
	$("#expense_category").change(function(){
		var id = $(this).val();
		if(id != ''){
			$.ajax({
				type: "GET",
				url: "{{url('/subexpenses/ajax')}}",
				data:'id='+id,
				success: function(data){
					var data = JSON.parse(data);
					var selOpts = "";
					if(data.length >0){					
						console.log(data);
			            for (i=0;i<data.length;i++)
			            {
			                var id = data[i].id; 
			                var val = data[i].name;
			                selOpts += "<option value='"+id+"'>"+val+"</option>";
			            }
			            $('.sub_expense').show();
			            $('#sub_expense').append(selOpts);
					}
					else{
						$('.sub_expense').hide();
						$('#sub_expense option').remove();
					}
				}
			});
		}
	});
});

$( document ).ready(function() {
    $("#form input").prop("disabled", true);
    $("#form select").prop("disabled", true);
    $("#form textarea").prop("disabled", true);
    $("#form-save").prop("disabled", true);
});

$(function() {
    $("#form-edit").click(function() {
     	$("#form input").prop("disabled", false);
     	$("#form select").prop("disabled", false);
    	$("#form textarea").prop("disabled", false);
    	$("#form-save").prop("disabled", false);
    });
});

$(document).ready(function() {
	$('.purchase').hide();
	$('.expense').hide();
	if ($("#radio_1:checked").val() == 'purchase') {
                $('.purchase').show();
            }
	if ($("#radio_2:checked").val() == 'expense') {
                $('.expense').show();
            }
            
	
	$("#radio_1").click(function() {
		
		$('.purchase').show();
		$('.expense').hide();
	});
	$("#radio_2").click(function(){
		
		$('.expense').show();
		$('.purchase').hide();
    });
});
function paymentMode(mode){
	if(mode == '3'){
		$('.acc_no').show();
		$('.ifsc').show();
		$('.txn_no').show();
	}
	else if(mode == '2'){
		$('.txn_no').show();
		$('.acc_no').hide();
		$('.ifsc').hide();
	}
	else if(mode == '1'){
		$('.txn_no').hide();
		$('.acc_no').hide();
		$('.ifsc').hide();
	}
	else{
		$('.acc_no').hide();
		$('.ifsc').hide();;
		$('.txn_no').hide();
	}
}
</script>

<div class="row clearfix">
	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="card">
        	<div class="header">
                <h2>
                    Expense
                </h2>
            </div>
            <div class="body">
                <ol class="breadcrumb breadcrumb-bg-pink">
                    <li><a href="{{ url('/dashboard') }}">Home</a></li>
                    <li><a href="{{ url('/expenses') }}">Expense</a></li>
                    <li><a href="{{ url('/expenses/'.$expense->id) }}">{{$expense->voucher_no}}</a></li>
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
            	<form id="form" method="post" action="{{route('expenses.update',$expense->id)}}" enctype="multipart/form-data">
                	{{ csrf_field() }}
	                {{ method_field('PUT') }}
                	 <div class="row clearfix">
	                	<div class="col-sm-6">
		                    <label for="voucher_no">Voucher No.(auto)</label>
		                    <div class="form-group">
		                        <div class="form-line">
		                            <input type="text" id="voucher_no" name="voucher_no" class="form-control" placeholder="Enter voucher number" value="{{ $expense->voucher_no }}" disabled>
		                        </div>
		                    </div>
	                    </div>
                	 	<div class="col-sm-6">
		                    <label for="voucher_date">Voucher Date</label>
		                    <div class="form-group">
		                        <div class="form-line">
		                            <input type="text" id="voucher_date" name="voucher_date" class="form-control datepicker" placeholder="Enter Date Of voucher" value="{{  date_format(date_create($expense->voucher_date), 'd F Y') }}" required>
		                        </div>
		                    </div>
	                    </div>
	                </div>
	                <div class="row clearfix">
	                    <div class="col-sm-6">
		                    <label for="invoice_no">Invoice No.</label>
		                    <div class="form-group">
		                        <div class="form-line">
		                            <input type="text" id="invoice_no" name="invoice_no" class="form-control " placeholder="Enter Invoice number" value="{{ $expense->invoice_no }}" >
		                        </div>
		                    </div>
	                    </div>
	                    <div class="col-sm-6">
		                    <label for="invoice_date">Invoice Date</label>
		                    <div class="form-group">
		                        <div class="form-line">
		                            <input type="text" id="invoice_date" name="invoice_date" class="form-control datepicker" placeholder="Enter Date Of Invoice" value="{{ date_format(date_create($expense->invoice_date), 'd F Y') }}" >
		                        </div>
		                    </div>
	                    </div>
	                    <div class="col-sm-6 ">
		                    <label for="subject">Subject</label>
		                    <div class="form-group">
		                        <div class="form-line">
		                            <input type="text" id="subject" name="subject" class="form-control" placeholder="Enter subject or item name" value="{{ $expense->subject }}" >
		                        </div>
		                    </div>
	                    </div>
	                    <div class="col-sm-6 ">
		                    <label for="vendor">Vendor Name</label>
		                    <div class="form-group">
		                        <div class="form-line">
		                            <input type="text" id="vendor" name="vendor" class="form-control" placeholder="Enter vendor name" value="{{ $expense->vendor_name }}" >
		                        </div>
		                    </div>
	                    </div>
	                    <div class="col-sm-6 ">
		                    <label for="amount">Amount</label>
		                    <div class="form-group">
		                        <div class="form-line">
		                            <input type="text" id="amount" name="amount" class="form-control" placeholder="Enter amount" value="{{ $expense->amount }}" required>
		                        </div>
		                    </div>
	                    </div>
	                    <div class="col-sm-6 ">
		                    <label for="voucher_img">Upload Invoice/Voucher</label>
		                    <div class="form-group">
		                        <div class="form-line">
	                                <div class="fallback">
	                                    <input name="voucher_img" id="voucher_img" class="form-control" type="file" placeholder="img only" value="{{ old('voucher_img') }}" />
	                                </div>
			                    </div>
		                    </div>
	                    </div>
	                </div>
	                <div class="row clearfix">
	                    <div class="col-sm-6">
			                <div class="form-group">
			                    <div class="demo-radio-button">
	                                <input name="category" type="radio" id="radio_1" value="purchase" 
	                                @if( $expense->category== 'purchase') checked @endif />
	                                <label for="radio_1">Purchase Category</label>
	                            </div>
	                        </div>
	                    </div>
	                	<div class="col-sm-6">
			                <div class="form-group">
			                    <div class="demo-radio-button">
	                                <input name="category" type="radio" id="radio_2" value="expense"
	                                @if( $expense->category== 'expense' ) checked @endif />
	                                <label for="radio_2">Expense Category</label>
	                            </div>
		                    </div>
	                    </div>
	                </div>
	                <div class="row clearfix expense">
	                    <div class="col-sm-6 expense_category">
		                    <label for="expense_category">Expense Category</label>
		                    <div class="form-group">
			                    <div class="form-line">
			                        <select class="form-control show-tick" id="expense_category" name="expense_category">
			                            <option value="" >{{ $expense->main_category }}</option>
			                            @foreach($expense_category as $list)
			                            <option value="{{$list->id}}">{{$list->name}}</option>
			                            @endforeach
			                        </select>
		                    	</div>
	                    	</div>
	                    </div>
	                    <div class="col-sm-6 sub_expense">
		                    <label for="sub_expense">Sub Expense Category</label>
		                    <div class="form-group">
			                    <div class="form-line">
			                        <select class="form-control show-tick" id="sub_expense" name="sub_expense" >
			                            <option value="">{{ $expense->sub_expense }}</option>
			                            
			                        </select>
		                    	</div>
	                    	</div>
	                    </div>
	                </div>
	                <div class="row clearfix purchase">
	                    <div class="col-sm-6 purchase_category">
		                    <label for="expense_category">Purchase Category</label>
		                    <div class="form-group">
			                    <div class="form-line">
			                        <select class="form-control" id="purchase_category" name="purchase_category">
			                            <option value="" >{{ $expense->main_category }}</option>
			                           	@foreach($purchase_category as $list)
			                            <option value="{{$list->id}}">{{$list->name}}</option>
			                            @endforeach
			                        </select>
		                    	</div>
	                    	</div>
	                    </div>
	                </div>
	                <div class="row clearfix">
	                	<div class="col-sm-12">
		                    <label for="description">Description</label>
		                    <div class="form-group">
		                        <div class="form-line">
		                            <textarea id="description" name="description" rows="1" class="form-control no-resize auto-growth" placeholder="Description if any... (press ENTER for more lines)">{{ $expense->description }}</textarea>
		                        </div>
		                    </div>
	                    </div>
	                    <div class="col-sm-12">
		                    <label for="remarks">Remark</label>
		                    <div class="form-group">
		                        <div class="form-line">
		                            <textarea id="remarks" name="remarks" rows="1" class="form-control no-resize auto-growth" placeholder="Remarks if any... (press ENTER for more lines)">{{ $expense->remarks }}</textarea>
		                        </div>
		                    </div>
	                    </div>
	                </div>
	                @php
                		$date1=date_create($list->created_at);
						$date2=date_create(date("y-m-d"));
						$diff=date_diff($date2,$date1);
						$date = $diff->format("%a days");
                	@endphp 
                	@if($date<2) 
                	<div class="row clearfix">
	                	<div class="col-sm-6">
	                		<button type="submit" id="form-save" class="btn btn-primary waves-effect">Save</button>
	                		<button type="button" id="form-edit" class="btn btn-primary waves-effect">Edit</button>
	                	</div>
	                </div>
                	@endif
                </form>
            </div>
        </div>
    </div>
</div>

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
