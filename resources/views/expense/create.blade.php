@extends('layouts.app')

@section('content')

<!-- Bootstrap Material Datetime Picker Css -->
<link href="{{ asset('bsb/plugins/bootstrap-material-datetimepicker/css/bootstrap-material-datetimepicker.css')}}" rel="stylesheet" />

<!-- Bootstrap Select Css -->
<link href="{{ asset('bsb/plugins/bootstrap-select/css/bootstrap-select.css')}}" rel="stylesheet" />

<!-- AJAX DD Selecter for Location Js -->
<script>

$(function(){
	$(".add-row").click(function(){
		var id = $('#expense_category_main').val(); 
		if(id != ''){
			$.ajax({
				type: "GET",
				url: "{{url('expense-categories/ajax')}}",
				data:'id='+id,
				success: function(data){
					var data = JSON.parse(data); 
					//console.log(data);
					var supply_type = data.supply_type; 
	                var category = data.supply_category;
	                var expense_category = data.name;
	                var sgst = 0;
		        	var cgst = 0;
		        	var igst = 0;
		        	var total_cost = 0; 
		        	var total_sgst = 0; 
		        	var total_cgst = 0; 
		        	var total_igst = 0; 
					var total_amount = 0; 
		        	//var type = $('#supply_type_main option:selected').text();
		        	//var category = $('#supply_category_main option:selected').text();
		        	var description = $('#description_main').val();
		        	var code = $('#code_main').val();
		        	var cost = $('#cost_main').val();
		        	var quantity = $('#quantity_main').val();
		        	var tax = $('#tax_main').val();
		        	
		        	if(cost < 0) cost = 0;
		        	if ($("#radio_1:checked").val() == '1') {
		                sgst = (cost*quantity*tax)/200;
						cgst = (cost*quantity*tax)/200;

						$('.sgst_tr').show();
						$('.cgst_tr').show();
						$('.igst_tr').hide();
		            }
					if ($("#radio_2:checked").val() == '2') {
		               igst = (cost*quantity*tax)/100;

		               	$('.sgst_tr').hide();
						$('.cgst_tr').hide();
						$('.igst_tr').show();
		            }
		            abt = parseFloat(cost*quantity);
				    amount = parseFloat(cost*quantity)+parseFloat(sgst)+parseFloat(cgst)+parseFloat(igst);
				    amount = parseFloat(amount).toFixed(2);

		        	var delBtn = '<button type="button" class="btn btn-danger btn-xs m-t-15 waves-effect delete-row"><i class="material-icons">remove_circle</i></button>';

		            var markup = '<tr><td>'+supply_type+'<input name="type[]" class="form-control " type="hidden" value="'+supply_type+'"  /></td><td>'+category+'<input name="category[]" class="form-control " type="hidden" value="'+category+'"  /></td><td>'+expense_category+'<input name="expense_category[]" class="form-control " type="hidden" value="'+expense_category+'"  /></td><td>'+description+'<input name="description[]" class="form-control " type="hidden" value="'+description+'"  /></td><td>'+code+'<input name="code[]" class="form-control " type="hidden" value="'+code+'"  /></td><td class="cost_td">'+cost+'<input name="cost[]" class="form-control cost1" type="hidden" value="'+cost+'"  /></td><td class="quantity_td">'+quantity+'<input name="quantity[]" class="form-control quantity" type="hidden" value="'+quantity+'"  /></td><td class="abt_td">'+abt+'<input name="abt[]" class="form-control abt" type="hidden" value="'+abt+'"  /></td> <td class="sgst_td"> '+sgst+'<input name="sgst[]" class="form-control sgst" type="hidden" value="'+sgst+'"  />  </td><td class="tax_amount_td">'+cgst+'<input name="cgst[]" class="form-control cgst" type="hidden" value="'+cgst+'" />  </td><td class="tax_amount_td">'+igst+' <input name="igst[]" class="form-control igst" type="hidden" value="'+igst+'"  />  </td> <td class="amount_td"> '+amount+' <input name="amount[]" class="form-control unamount1" type="hidden" value="'+amount+'" /> </td><td>'+delBtn+'</td></tr> ';
									  
		            $("table tbody").append(markup);

		            
		            $("input[class *= 'abt']").each(function(){
			        	total_cost += +$(this).val();
			    	}); 
		            $("input[class *= 'sgst']").each(function(){
			        	total_sgst += +$(this).val();
			    	});
			    	$("input[class *= 'cgst']").each(function(){
			        	total_cgst += +$(this).val();
			    	});
			    	$("input[class *= 'igst']").each(function(){
			        	total_igst += +$(this).val();
			    	});
			    	$("input[class *= 'unamount']").each(function(){
			    		total_amount += +$(this).val(); 
			    	});

			    	$('input#amount_before_tax').val(parseFloat(total_cost).toFixed(2));
			    	$('input#sgst_amount').val(parseFloat(total_sgst).toFixed(2));
			    	$('input#cgst_amount').val(parseFloat(total_cgst).toFixed(2));
			    	$('input#igst_amount').val(parseFloat(total_igst).toFixed(2));
					$('input#total_amount').val(parseFloat(total_amount).toFixed(2));

					$('.amount_before_tax_td').html(parseFloat(total_cost).toFixed(2));
			    	$('.sgst_amount_td').html(parseFloat(total_sgst).toFixed(2));
			    	$('.cgst_amount_td').html(parseFloat(total_cgst).toFixed(2));
			    	$('.igst_amount_td').html(parseFloat(total_igst).toFixed(2));
					$('.total_amount_td').html(parseFloat(total_amount).toFixed(2));

					$('#radio_1').prop('disabled',true);
		        	$('#radio_2').prop('disabled',true);
		        	$('.dataTable').show();

	        	}
			});
		}
    });

    $('.data-field').on('click', '.delete-row', function(e){
		e.preventDefault();
		
		$(this).closest("tr").remove();

		var total_cost = 0; 
    	var total_sgst = 0; 
    	var total_cgst = 0; 
    	var total_igst = 0; 
		var total_amount = 0;

		$("input[class *= 'abt']").each(function(){
        	total_cost += +$(this).val();
    	}); 
        $("input[class *= 'sgst']").each(function(){
        	total_sgst += +$(this).val();
    	});
    	$("input[class *= 'cgst']").each(function(){
        	total_cgst += +$(this).val();
    	});
    	$("input[class *= 'igst']").each(function(){
        	total_igst += +$(this).val();
    	});
    	$("input[class *= 'unamount']").each(function(){
    		total_amount += +$(this).val(); 
    	});

		$('input#amount_before_tax').val(parseFloat(total_cost).toFixed(2));
    	$('input#sgst_amount').val(parseFloat(total_sgst).toFixed(2));
    	$('input#cgst_amount').val(parseFloat(total_cgst).toFixed(2));
    	$('input#igst_amount').val(parseFloat(total_igst).toFixed(2));
		$('input#total_amount').val(parseFloat(total_amount).toFixed(2));

    	$('.amount_before_tax_td').html(parseFloat(total_cost).toFixed(2));
    	$('.sgst_amount_td').html(parseFloat(total_sgst).toFixed(2));
    	$('.cgst_amount_td').html(parseFloat(total_cgst).toFixed(2));
    	$('.igst_amount_td').html(parseFloat(total_igst).toFixed(2));
		$('.total_amount_td').html(parseFloat(total_amount).toFixed(2));
	}); 
});    



$(document).ready(function() {
	$('.sub_expense').hide();
	$('.purchase').hide();
	$('.expense').hide();
	$('.common').hide();
	$('.acc_no').hide();
	$('.ifsc').hide();
	$('.txn_no').hide();
	$('.dataTable').hide();
});

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
                <b>
	                @if($balance)
	                Balance({{$balance}})
	                @else
	                Bal- 0
	                @endif
                </b>
            </div>
            <div class="body">
                <form method="post" action="{{route('expenses.store')}}" enctype="multipart/form-data">
                	{{ csrf_field() }}
                	 <div class="row clearfix">
	                	<div class="col-sm-3">
	                		<label for="voucher_no">Voucher No.(auto)</label>
		                    <div class="form-group form-float">
		                        <div class="form-line ">
		                            <input type="text" id="voucher_no" name="voucher_no" class="form-control" placeholder="Enter voucher number" value="{{ $voucher_no }}" disabled>
		                        </div>
		                    </div>
	                    </div>
                	 	<div class="col-sm-3">
		                    <label for="voucher_date">Voucher Date</label>
		                    <div class="form-group form-float">
		                        <div class="form-line ">
		                            <input type="text" id="voucher_date" name="voucher_date" class="form-control datepicker" placeholder="Enter Date Of voucher" value="{{  date('d F Y') }}" disabled>
		                        </div>
		                    </div>
	                    </div>
	                    <div class="col-sm-3">
		                    <label for="invoice_no">Invoice No.</label>
		                    <div class="form-group form-float">
		                        <div class="form-line ">
		                            <input type="text" id="invoice_no" name="invoice_no" class="form-control" placeholder="Enter Invoice number" value="{{ old('invoice_no') }}" >
		                        </div>
		                    </div>
	                    </div>
	                    <div class="col-sm-3">
		                    <label for="invoice_date">Invoice Date</label>
		                    <div class="form-group form-float">
		                        <div class="form-line ">
		                            <input type="text" id="invoice_date" name="invoice_date" class="form-control datepicker" placeholder="Enter Date Of Invoice" value="{{ old('invoice_date') }}" >
		                        </div>
		                    </div>
	                    </div>
	                    <div class="col-sm-6 ">
		                    <label for="party_name">Seller Name</label>
		                    <div class="form-group form-float">
		                        <div class="form-line ">
		                            <input type="text" id="party_name" name="party_name" class="form-control" placeholder="Enter seller name" value="{{ old('party_name') }}" >
		                        </div>
		                    </div>
	                    </div>
	                    <div class="col-sm-6 ">
		                    <label for="party_gstin">Seller GSTIN</label>
		                    <div class="form-group form-float">
		                        <div class="form-line ">
		                            <input type="text" id="party_gstin" name="party_gstin" class="form-control" placeholder="Enter seller gstin " value="{{ old('party_gstin') }}" >
		                        </div>
		                    </div>
	                    </div>
	                    <div class="col-sm-6">
		                    <label for="mode">Mode Of Payment</label>
		                    <div class="form-group">
		                        <div class="form-line">
		                            <select class="form-control show-tick" id="mode" name="mode">
			                            <option value="Cash">Cash</option>
			                            <option value="Credit">Credit</option>
			                        </select>
		                        </div>
		                    </div>
	                    </div>
	                    <div class="col-sm-3 ">
		                    <label for="voucher_img">Upload Invoice</label>
		                    <div class="form-group form-float">
		                        <div class="form-line ">
	                                <div class="fallback">
	                                    <input name="voucher_img" id="voucher_img" class="form-control" type="file" placeholder="img only"  />
	                                </div>
			                    </div>
		                    </div>
	                    </div>
	                    <div class="col-sm-3 ">
	                    	<label>Invoice Type</label>
		                    <div class="form-line">
		                        <input name="group1" type="radio" id="radio_1" value="1" checked />
                                <label for="radio_1">GST</label>
                                <input name="group1" type="radio" id="radio_2" value="2" />
                                <label for="radio_2">IGST</label>
                                <input name="tax_type" id="tax_type" class="form-control" type="hidden" />
		                    </div>
		                </div>
	                </div>
	                <div class="row clearfix">
	                	<div class="col-sm-12" style="overflow:auto">
			                <table class="table table-bordered table-striped table-hover" >
		                        <thead>
		                            <tr>
		                                <th >Exp Cat.</th>
		                                <th >Description</th>
		                                <th >HSN/SAC</th>
		                                <th >Base Value</th>
		                                <th >Quantity</th>
		                                <th >Tax %</th>
		                                <th >Action</th>
		                            </tr>
		                        	<tr>
		                                <!-- <td>
						                    <div class="form-group ">
							                    <div class="form-line focused">
							                        <select class="form-control" id="supply_type_main">
							                        	<option value="" >select</option>
							                        	@foreach($expense_category as $list)
							                            <option value="{{$list->id}}">{{$list->name}}</option>
							                            @endforeach
							                            <option value="Service" >Service</option>
							                            <option value="Material" >Material</option> 
							                        </select>
						                    	</div>
					                    	</div>
		                                </td>
		                                <td>
						                    <div class="form-group ">
							                    <div class="form-line focused">
							                        <select class="form-control" id="supply_category_main">
							                            <option >select</option>
							                            <option value="Non-Workshop" >Non-Workshop</option> 
							                        </select>
						                    	</div>
					                    	</div>
		                                </td> -->
		                                <td>
						                    <div class="form-group">
							                    <div class="form-line focused">
							                        <select class="form-control show-tick" id="expense_category_main">
							                           <option value="" >select</option>
							                        	@foreach($expense_category as $list)
							                            <option value="{{$list->id}}">{{$list->name}}</option>
							                            @endforeach
							                        </select>
						                    	</div>
					                    	</div>
		                                </td>
		                                <td>
						                    <div class="form-group ">
							                    <div class="form-line focused">
							                        <select class="form-control show-tick" id="description_main" >
							                            @foreach($description as $list)
							                            <option value="{{$list->name}}">{{$list->name}}</option>
							                            @endforeach
							                        </select>
						                    	</div>
					                    	</div>
		                                </td>
		                                <td>
		                                	<div class="form-group form-float">
						                        <div class="form-line focused">
					                                <div class="fallback">
					                                    <input id="code_main" class="form-control" type="text" />
					                                </div>
							                    </div>
						                    </div>
					                	</td>
		                                <td  >
		                                	<div class="form-group form-float">
						                        <div class="form-line focused"> 
					                                <div class="fallback">
					                                    <input id="cost_main" class="form-control " type="text" />
					                                </div>
							                    </div>
						                    </div>
					                	</td>
		                                <td >
						                    <div class="form-group form-float">
							                    <div class="form-line focused"> 
					                                <div class="fallback">
					                                    <input id="quantity_main" class="form-control " type="text" />
					                                </div>
							                    </div>
					                    	</div>
		                                </td>
		                                <td >
						                    <div class="form-group form-float">
							                    <div class="form-line ">
							                        <select class="form-control show-tick " id="tax_main" >
							                            <option value="0">0</option>
							                            @foreach($tax as $list)
							                            <option value="{{$list->value}}">{{$list->value}}</option>
							                            @endforeach
							                        </select>
						                    	</div>
					                    	</div>
		                                </td>
		                                <td><button type="button" class="btn btn-xs btn-primary m-t-15 waves-effect add-row"><i class="material-icons">add_circle</i></button> </td>
		                            </tr>
		                        </thead>
		                    </table>
		                </div>
		            </div>
	                <div class="row clearfix">
	                	<div class="col-sm-12" style="overflow:auto">
			                <table class="table table-bordered table-striped table-hover dataTable" >
		                        <thead>
		                            <tr>
		                                <th >Supply Type</th>
		                                <th >Supply Cat.</th>
		                                <th >Exp Cat.</th>
		                                <th >Description</th>
		                                <th >HSN/SAC</th>
		                                <th >Base Value</th>
		                                <th >Quantity</th>
		                                <th >Amount</th>
		                                <th >SGST</th>
		                                <th >CGST</th>
		                                <th >IGST</th>
		                                <th >Total</th>
		                                <th >Action</th>
		                            </tr>
		                        </thead>
		                        <tbody class="data-field">
		                            
		                        </tbody>
		                        <tfoot class="final_amount">
		                            <tr>
		                            	<th colspan="11" style="text-align: right;">Amount Before Tax</th>
		                            	<td class="amount_before_tax_td">
		                                	<!-- <div class="form-group form-float">
						                        <div class="form-line">
					                                <div class="fallback"> -->
					                                    <input name="amount_before_tax" id="amount_before_tax" class="form-control" type="hidden" />
					                                <!-- </div>
							                    </div>
						                    </div> -->
					                	</td>
					                	<th></th>
		                            </tr>
		                            <tr class="sgst_tr">
		                            	<th colspan="11" style="text-align: right;">SGST Amount</th>
		                            	<td class="sgst_amount_td">
		                                	<!-- <div class="form-group form-float">
						                        <div class="form-line">
					                                <div class="fallback"> -->
					                                    <input name="sgst_amount" id="sgst_amount" class="form-control" type="hidden"  />
					                                <!-- </div>
							                    </div>
						                    </div> -->
					                	</td>
					                	<th></th>
		                            </tr>
		                            <tr class="cgst_tr">
		                            	<th colspan="11" style="text-align: right;">CGST Amount</th>
		                            	<td class="cgst_amount_td">
		                                	<!-- <div class="form-group form-float">
						                        <div class="form-line">
					                                <div class="fallback"> -->
					                                    <input name="cgst_amount" id="cgst_amount" class="form-control" type="hidden"  />
					                                <!-- </div>
							                    </div>
						                    </div> -->
					                	</td>
					                	<th></th>
		                            </tr>
		                            <tr class="igst_tr">
		                            	<th colspan="11" style="text-align: right;">IGST Amount</th>
		                            	<td class="igst_amount_td">
		                                	<!-- <div class="form-group form-float">
						                        <div class="form-line">
					                                <div class="fallback"> -->
					                                    <input name="igst_amount" id="igst_amount" class="form-control" type="hidden" />
					                                <!-- </div>
							                    </div>
						                    </div> -->
					                	</td>
					                	<th></th>
		                            </tr>
		                            <tr class="">
		                            	<th colspan="11" style="text-align: right;">Total Amount</th>
		                            	<td class="total_amount_td">
		                                	<!-- <div class="form-group form-float">
						                        <div class="form-line">
					                                <div class="fallback"> -->
					                                    <input name="total_amount" id="total_amount" class="form-control " type="hidden" />
					                                <!-- </div>
							                    </div>
						                    </div> -->
					                	</td>
					                	<th></th>
		                            </tr>
		                        </tfoot>
		                    </table>
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

<script>
$('.datepicker').bootstrapMaterialDatePicker({
    format: 'DD MMMM YYYY',
    clearButton: true,
    weekStart: 1,
    time: false
});
</script>
    
<!--<!-- Select Plugin Js ->
<script src="{{ asset('bsb/plugins/bootstrap-select/js/bootstrap-select.js')}}"></script>-->

@endsection
