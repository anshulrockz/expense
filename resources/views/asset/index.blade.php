@extends('layouts.app')

@section('content')

<!-- Bootstrap Select Css -->
<link href="{{ asset('bsb/plugins/bootstrap-select/css/bootstrap-select.css')}}" rel="stylesheet" />
<link href="https://cdn.datatables.net/1.10.16/css/jquery.dataTables.min.css" rel="stylesheet"/>
<link href="https://cdn.datatables.net/fixedheader/3.1.3/css/fixedHeader.dataTables.min.css" rel="stylesheet"/>
    
<div class="row clearfix">
	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="card">
        	<div class="header">
                <h2>
                    Asset Old
                </h2>
            </div>
            <div class="body">
                <ol class="breadcrumb breadcrumb-bg-pink">
                    <li><a href="{{ url('/dashboard') }}">Home</a></li>
                    <li class="active">Asset Old</li>
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
                    All
                </h2>
                
                <a class="btn btn-primary waves-effect header-dropdown m-r--5" href="{{ url('/assets/old/create')}}">Add New</a>
            </div>
            <div class="body">
                <div class="table-responsive">
                    <table class="table table-bordered table-striped table-hover js-basic-example dataTable">
                        <thead>
                            <tr>
                                <th>Asset ID</th>
                                <th>Asset Category</th>
                                <th>Model</th>
                                <th>Amount</th>
                                <th>Warranty Date</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <!--<tfoot>
                            <tr>
                                <th>Asset ID</th>
                                <th>Puchased By</th>
                                <th>Asset Category</th>
                                <th>Model</th>
                                <th>Amount</th>
                                <th>Invoice Date</th>
                                <th>Expiry Date</th>
                                <th>Action</th>
                            </tr>
                        </tfoot>-->
                        <tbody>
                        	@foreach( $asset as $key=>$list)
                            <tr>
                            	<td>{{ $list->voucher_no }}</td>
                                <td>{{$list->main_category}}
	                                @if(!empty($list->sub_assets))
	                            	- {{$list->sub_assets}}
	                            	@endif
                                </td>
                                <td>{{$list->subject}}</td>
                                <td>{{$list->amount}}</td>
                                <td>{{date_format(date_create($list->expiry),"d-m-Y")}}</td>
                                <td>
                                    <!-- <a href="{{ url('/assets/old/'.$list->id)}}" class="btn btn-sm btn-success"> View </a> -->
                                    <a href="{{ url('/assets/old/'.$list->id.'/edit')}}" class="btn btn-sm btn-info"> <i class="material-icons">edit</i> </a>
                                    <form style="display: inline;" method="post" action="{{route('new.destroy',$list->id)}}">
				                        {{ csrf_field() }}
				                        {{ method_field('DELETE') }}
				                        <button onclick="return confirm('Are you sure you want to delete?');" type="submit" class="btn btn-sm btn-danger"><i class="material-icons">delete</i></button>
				                    </form>
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

<!-- Select Plugin Js -->
    <script src="{{ asset('bsb/plugins/bootstrap-select/js/bootstrap-select.js')}}"></script>

<script>
$(document).ready(function() {
    $('.dataTable').DataTable( {
        "order": [[ 1, "desc" ]],
        fixedHeader: {
            header: true,
            headerOffset: $('#navbar-collapse').height()
        }
    } );
} );
</script>

@endsection
