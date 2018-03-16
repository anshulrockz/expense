@extends('layouts.app')

@section('content')

<!-- Bootstrap Select Css -->
<link href="{{ asset('bsb/plugins/bootstrap-select/css/bootstrap-select.css')}}" rel="stylesheet" />

<!-- JQuery DataTable Css -->
<link href="{{ asset('bsb/plugins/jquery-datatable/skin/bootstrap/css/dataTables.bootstrap.css') }}" rel="stylesheet"/>

<!-- Bootstrap Material Datetime Picker Css -->
<link href="{{ asset('bsb/plugins/bootstrap-material-datetimepicker/css/bootstrap-material-datetimepicker.css') }}" rel="stylesheet" />



<div class="row clearfix">
	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="card">
        	<div class="header">
                <h2 id="header">
                    Expense Report
                </h2>
                <button class="btn btn-primary waves-effect header-dropdown m-r--5" onclick="PrintDiv()" >Print</button>
            </div>
            <div class="body">
                <div class="row ">
                    <div class="col-sm-12">
                        <ol class="breadcrumb breadcrumb-bg-pink">
                            <li><a href="{{ url('/dashboard') }}">Home</a></li>
                            <li class="active">Expense Report</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row clearfix">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="card">
            <div class="body">
                <div class="row ">
                    <div class="col-sm-4">
                        <label for="name">Form</label>
                        <div class="form-group">
                            <div class="form-line">
                                <input type="text" id="min" class="datepicker form-control" placeholder="Please choose a from date...">
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <label for="name">To</label>
                        <div class="form-group">
                            <div class="form-line">
                                <input type="text" id="max" class="datepicker form-control" placeholder="Please choose a to date...">
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <label for="name"></label>
                        <div class="form-inline">
                            <button id="find" class="btn btn-primary waves-effect header-dropdown m-r--5" >Find</button>
                            <!-- <select class="form-control show-tick" id="category" name="category">
                                <option value="">-- Please select category --</option>
                            </select> -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row clearfix">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="card">
            <div class="body">
                <div class="table-responsive">
                    <table class="table table-bordered table-striped table-hover datatable">
                        <thead>
                            <tr>
                                <th>Voucher</th>
                                <th>Invoice</th>
                                <th>Spent By</th>
                                <th>Expense Category</th>
                                <th>Subject</th>
                                <th>Amount</th>
                                <th>Voucher Date</th>
                                <th>Created at</th>
                            </tr>
                        </thead>
                        <tbody id="TableData">
                        	@foreach( $report as $key=>$list)
                            <tr>
                            	<td>{{ $list->voucher_no }}</td>
                            	<td>{{ $list->invoice_no }}</td>
                                <td>{{$list->user}}</td>
                                <td>{{$list->category}}
                                @if(!empty($list->main_category))
                                	- {{$list->main_category}}
                                @endif
                                @if(!empty($list->sub_expenses))
                            	- {{$list->sub_expenses}}
                            	@endif
                                </td>
                                <td>{{$list->subject}}</td>
                                <td>{{$list->amount}}</td>
                                <td>{{date_format(date_create($list->voucher_date),"d F Y")}}</td>
                                <td>{{date_format(date_create($list->created_at),"d F Y")}}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>


<!-- Select Plugin Js -->
    <script src="{{ asset('bsb/plugins/bootstrap-select/js/bootstrap-select.js')}}"></script>

<!-- Jquery DataTable Plugin Js -->


<script src="{{ asset('bsb/plugins/jquery-datatable/jquery.dataTables.js') }}"></script>
<script src="{{ asset('bsb/plugins/jquery-datatable/skin/bootstrap/js/dataTables.bootstrap.js') }}"></script>
<!-- Moment Plugin Js -->
<script src="{{ asset('bsb/plugins/momentjs/moment.js')}}"></script>

<!-- Bootstrap Material Datetime Picker Plugin Js -->
<script src="{{ asset('bsb/plugins/bootstrap-material-datetimepicker/js/bootstrap-material-datetimepicker.js') }}"></script>



<script>
	$(document).ready(function() {
		document.title = $("#header").html();
        //$('.datatable').DataTable();
        $('.datepicker').bootstrapMaterialDatePicker({
          format: 'DD MMMM YYYY',
                clearButton: true,
                weekStart: 1,
                time: false,
                autoclose: true
         });
	} );

	function PrintDiv() {
	  	var w = window.open();
	  	var header = $("#header").html();
	  	var data = $(".dataTable").html();
	  	w.document.title = $("#header").html();
	  	$(w.document.body).html("<h1 style='text-align:center;'>"+header+"</h1><table style='text-align:left;width:100%'>"+data+"</table>");
	    w.print();
	}
</script>

<script type="text/javascript" language="javascript" >

$.fn.dataTable.ext.search.push(
    function( settings, data, dataIndex ) {
        var min = parseInt( $('#start_date1').val(), 10 );
        var max = parseInt( $('#end_date1').val(), 10 );
        var age = parseFloat( data[6] ) || 0; // use data for the age column
 
        if ( ( isNaN( min ) && isNaN( max ) ) ||
             ( isNaN( min ) && age <= max ) ||
             ( min <= age   && isNaN( max ) ) ||
             ( min <= age   && age <= max ) )
        {
            return true;
        }
        return false;
    }
);

$.fn.dataTable.ext.search.push(
                function( settings, data, dataIndex ) {
                    var array=[];
                    var today = new Date();
                    var dd = today.getDate();
                    var mm = today.getMonth() + 1;
                    var yyyy = today.getFullYear();
                     
                    if (dd<10)
                    dd = '0'+dd;
                     
                    if (mm<10)
                    mm = '0'+mm;
                     
                                today = yyyy+'-'+mm+'-'+dd;
                     
                    if ($('#min').val() == '' && $('#max').val() == '') {
                    return true;
                    }
                     if ($('#min').val() != '' || $('#max').val() != '') {
                    var iMin_temp = $('#min').val();
                     if (iMin_temp == '') {
                       iMin_temp = '2009-01-23';
 
                     }
                     
                     var iMax_temp = $('#max').val();
                     if (iMax_temp == '') {
                      iMax_temp = '2015-05-01';
                       array.push(iMax_temp.substr(0,10));
                       
 
                    }
                     
                    var arr_min = iMin_temp.split("-");
                    var arr_max = iMax_temp.split("-");
                    var arr_date = data[1].split("-");
           
                            var iMin = new Date(arr_min[2], arr_min[0], arr_min[1], 0, 0, 0, 0);
                    var iMax = new Date(arr_max[2], arr_max[0], arr_max[1], 0, 0, 0, 0);
                    var iDate = new Date(arr_date[2], arr_date[0], arr_date[1], 0, 0, 0, 0);
                     
                    if ( iMin == "" && iMax == "" )
                    {
                        return true;
                    }
                    else if ( iMin == "" && iDate < iMax )
                    {
                        return true;
                    }
                    else if ( iMin <= iDate && "" == iMax )
                    {
                        return true;
                    }
                    else if ( iMin <= iDate && iDate <= iMax )
                    {
                        return true;
                    }
                                         
                    return false;
                    }
                }
            );
 


$(document).ready(function() {

    var table = $('.datatable').DataTable( {
        "columnDefs": [
            {
                "targets": [ 7 ],
                "visible": false,
                //"searchable": false
            },
        ]
    } );
     
    // Event listener to the two range filtering inputs to redraw on input
    $('#min, #max').keyup( function() {
        table.draw();
    } );
} );
</script>
<script type="text/javascript" language="javascript" >
// fetch_data('no');

 function fetch_data(table_name, start_date='', end_date='')
 {
    $('.datatable').DataTable().destroy();
    var dataTable = $('.datatable').DataTable({
    "processing" : true,
    "serverSide" : true,
    "order" : [],
    "ajax" : {
    url:"{{ url('/report/datatable') }}",
    type:"GET",
    data:{
     table_name:table_name, start_date:start_date, end_date:end_date
    }
   }
  });
 }

 $('#111').click(function(){
  var start_date = $('#start_date').val();
  var end_date = $('#end_date').val();
  if(start_date != '' && end_date !='')
  {
   //$('.datatable').DataTable().destroy();
   fetch_data('expense', start_date, end_date);
  }
  else
  {
   alert("Both Dates are Required");
  }
 }); 
</script>

@endsection
