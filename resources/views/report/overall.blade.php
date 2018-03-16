@extends('layouts.app')

@section('content')
<!-- JQuery DataTable Css -->
<link href="{{ asset('bsb/plugins/jquery-datatable/skin/bootstrap/css/dataTables.bootstrap.css') }}" rel="stylesheet"/>
    
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
                    <li class="active">Employee</li>
                </ol>
            </div>
        </div>
    </div>
</div>

<div class="row clearfix">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="card">
            <div class="header">
                <h2>
                    Expenses
                </h2>
            </div>
            <div class="body">
                <div class="table-responsive">
                    <table class="table table-bordered table-striped table-hover js-basic-example dataTable">
                        <thead>
                            <tr>
                                <th>Voucher</th>
                                <th>Invoice</th>
                                <th>Spent By</th>
                                <th>Expense Category</th>
                                <th>Subject</th>
                                <th>Amount</th>
                                <th>Voucher Date</th>
                            </tr>
                        </thead>
                        <tfoot>
                            <tr>
                                <th>Voucher</th>
                                <th>Invoice</th>
                                <th>Spent By</th>
                                <th>Expense Category</th>
                                <th>Subject</th>
                                <th>Amount</th>
                                <th>Voucher Date</th>
                            </tr>
                        </tfoot>
                        <tbody>
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
<script src="{{ asset('bsb/plugins/jquery-datatable/skin/bootstrap/js/dataTables.bootstrap.js') }}"></script>

<script src="{{ asset('bsb/js/pages/tables/jquery-datatable.js') }}"></script>

<script>
$(document).ready(function() {
$('.datatable').DataTable();
} );
</script>
@endsection
