@extends('layouts.app')

@section('content')

<!-- Bootstrap Material Datetime Picker Css -->
<link href="{{ asset('bsb/plugins/bootstrap-material-datetimepicker/css/bootstrap-material-datetimepicker.css')}}" rel="stylesheet" />

<!-- Bootstrap Select Css -->
<link href="{{ asset('bsb/plugins/bootstrap-select/css/bootstrap-select.css')}}" rel="stylesheet" />
<link href="{{ asset('bsb/css/datatable-style.css')}}" rel="stylesheet" />

<link href="https://cdn.datatables.net/1.10.16/css/jquery.dataTables.min.css" rel="stylesheet"/>
<link href="https://cdn.datatables.net/fixedheader/3.1.3/css/fixedHeader.dataTables.min.css" rel="stylesheet"/>

<div class="row clearfix">
	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="card">
        	<div class="header">
                <h2>
                    Report
                </h2>
            </div>
            <div class="body">
                <ol class="breadcrumb breadcrumb-bg-pink">
                    <li><a href="{{ url('/dashboard') }}">Home</a></li>
                    <li class="active">Reports</li>
                </ol>
            </div>
        </div>
    </div>
</div>

<div class="row clearfix">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="card">
            <div class="header">
                <h2 id="header">
                    Assets Expiry
                </h2>
                <!-- <button class="btn btn-primary waves-effect header-dropdown m-r--5" id="print" >Print</button> -->
            </div>
            <div class="body">
                <div class="row clearfix">
                    <div class="col-lg-1 col-md-1 col-sm-1 col-xs-1 form-control-label">
                        <label for="email_address_2">From</label>
                    </div>
                    <div class="col-lg-3 col-md-3 col-sm-3 col-xs-3">
                        <div class="form-group">
                            <!-- <div class="form-line"> -->
                                <input type="text" id="start" class="datepicker form-control" placeholder="Please choose a from date...">
                            <!-- </div> -->
                        </div>
                    </div>
                    <div class="col-lg-1 col-md-1 col-sm-1 col-xs-1 form-control-label">
                        <label for="email_address_2">To</label>
                    </div>
                    <div class="col-lg-3 col-md-2 col-sm-3 col-xs-3">
                        <div class="form-group">
                            <!-- <div class="form-line"> -->
                                <input type="text" id="end" class="datepicker form-control" placeholder="Please choose a from date...">
                            <!-- </div> -->
                        </div>
                    </div>
                </div>
                <div class="table-responsive">
                    <table class="table table-bordered table-striped table-hover datatable">
                       <thead class="print-header">
                            <tr>
                                <th>Id</th>
                                <th>Date</th>
                                <th>Voucher</th>
                                <th>Purchased By</th>
                                <th>Expense Category</th>
                                <th>Model/Item</th>
                                <th>Amount</th>
                                <th>Voucher Date</th>
                                <th>Expiry Date</th>
                                <th>Expiry days</th>
                            </tr>
                        </thead>
                        <tfoot style="display: table-header-group;">
                            <tr>
                                <th>Id</th>
                                <th>Date</th>
                                <th>Voucher</th>
                                <th>Purchased By</th>
                                <th>Expense Category</th>
                                <th>Model/Item</th>
                                <th>Amount</th>
                                <th>Voucher Date</th>
                                <th>Warranty Date</th>
                                <th>Expiry days</th>
                            </tr>
                        </tfoot>
                        <tbody class="print-body">
                        	@foreach( $report as $key=>$list)
                            <tr>
                                <td>{{date_format(date_create($list->created_at),"m/d/y")}}</td>
                                <td>{{ $list->voucher_no }}</td>
                                <td>{{$list->user}}</td>
                                <td>
                                
                                	{{$list->main_category}}
                                @if(!empty($list->sub_expenses))
                            	- {{$list->sub_expenses}}
                            	@endif
                                </td>
                                <td>{{$list->subject}}</td>
                                <td>{{$list->amount}}</td>
                                <td>{{date_format(date_create($list->voucher_date),"d-m-Y")}}</td>
                                <td>{{date_format(date_create($list->expiry),"d-m-Y")}}</td>
                                <td>@php
                                		$date1=date_create($list->expiry);
										$date2=date_create(date("y-m-d"));
										$diff=date_diff($date2,$date1);
										$date = $diff->format("%a days");
                                	@endphp 
                                	@if(date_create($list->expiry) > date_create(date("y-m-d"))) 
                                		Expiring in {{$date}}
                                	@else
                                		Expired
                                	@endif
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Jquery DataTable Plugin Js -->
<script src="{{ asset('bsb/plugins/jquery-datatable/jquery.dataTables.js') }}"></script>
<script src="https://cdn.datatables.net/fixedheader/3.1.3/js/dataTables.fixedHeader.min.js"></script>
<script src="{{ asset('bsb/plugins/jquery-datatable/skin/bootstrap/js/dataTables.bootstrap.js') }}"></script>
<script src="{{ asset('bsb/plugins/jquery-datatable/extensions/export/dataTables.buttons.min.js') }}"></script>
<script src="{{ asset('bsb/plugins/jquery-datatable/extensions/export/buttons.flash.min.js') }}"></script>
<script src="{{ asset('bsb/plugins/jquery-datatable/extensions/export/jszip.min.js') }}"></script>
<script src="{{ asset('bsb/plugins/jquery-datatable/extensions/export/pdfmake.min.js') }}"></script>
<script src="{{ asset('bsb/plugins/jquery-datatable/extensions/export/vfs_fonts.js') }}"></script>
<script src="{{ asset('bsb/plugins/jquery-datatable/extensions/export/buttons.html5.min.js') }}"></script>
<script src="{{ asset('bsb/plugins/jquery-datatable/extensions/export/buttons.print.min.js') }}"></script>

<!-- Moment Plugin Js -->
<script src="{{ asset('bsb/plugins/momentjs/moment.js')}}"></script>

<!-- Bootstrap Material Datetime Picker Plugin Js -->
<script src="{{ asset('bsb/plugins/bootstrap-material-datetimepicker/js/bootstrap-material-datetimepicker.js')}}"></script>

<!-- Select Plugin Js -->
<script src="{{ asset('bsb/plugins/bootstrap-select/js/bootstrap-select.js')}}"></script>

<script>
$('.datepicker').bootstrapMaterialDatePicker({
    format: 'MM/DD/YY',
    clearButton: true,
    weekStart: 1,
    time: false
});
</script>

<script>

var normalizeDate = function(dateString) {
  var date = new Date(dateString);
  var normalized = date.getFullYear() + '' + (("0" + (date.getMonth() + 1)).slice(-2)) + '' + ("0" + date.getDate()).slice(-2);
  return normalized;
}

$.fn.dataTable.ext.search.push(
    function( settings, data, dataIndex ) {
        var start = normalizeDate( $('#start').val() );
        var end = normalizeDate( $('#end').val() );
        var colDate = normalizeDate( data[1] ) || 0;
 
        if ( ( isNaN( start ) && isNaN( end ) ) ||
             ( isNaN( start ) && colDate <= end ) ||
             ( start <= colDate && isNaN( end ) ) ||
             ( start <= colDate && colDate <= end )
        ) 
        {
            return true;
        }
        
        return false;
    }
);
 
$(document).ready(function() {
    document.title = $("#header").html();
    var table = $('.datatable').DataTable({
        dom: 'Bfrtip',
        responsive: true,
        buttons: [
             //'copy', 'csv',
             'excel', 'pdf', 'print'
        ],
        "order": [[ 0, "desc" ]],
        fixedHeader: {
            header: true,
            headerOffset: $('#navbar-collapse').height()
        },
        initComplete: function () {
            this.api().columns().every( function () {
                var column = this;
                var select = $('<select><option value=""></option></select>')
                    .appendTo( $(column.footer()).empty() )
                    .on( 'change', function () {
                        var val = $.fn.dataTable.util.escapeRegex(
                            $(this).val()
                        );
 
                        column
                            .search( val ? '^'+val+'$' : '', true, false )
                            .draw();
                    } );
 
                column.data().unique().sort().each( function ( d, j ) {
                    select.append( '<option value="'+d+'">'+d+'</option>' )
                } );
            } );
        }
    });
     
    table.column( 0 ).visible( false );
     
    $('#start, #end').change( function() {
        table.draw();
    } );
} );

</script>

<script type="text/javascript">
    
$('#print').click( function() {
    var w = window.open();
    var title = $("#header").html();
    var header = $(".print-header").html();
    var body = $(".print-body").html();
    w.document.title = $("#header").html();
    $(w.document.body).html("<h1 style='text-align:center;text-transform:uppercase;'>"+title+"</h1><table style='text-align:left;width:100%'>"+header+body+"</table>");
    w.print();
});

</script>

@endsection
