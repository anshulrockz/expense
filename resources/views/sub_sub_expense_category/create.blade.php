@extends('layouts.app')

@section('content')

<!-- Bootstrap Select Css -->
<link href="{{ asset('bsb/plugins/bootstrap-select/css/bootstrap-select.css')}}" rel="stylesheet" />

<!-- AJAX DD Selecter for Sub Expense Js -->
<script>
$(function(){
$(".search").change(function(){
	var id = $(this).val();
	if(id != ''){
		$.ajax({
			type: "GET",
			url: "{{url('/subsubexpenses/ajax')}}",
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
		            $('#sub_expenses').append(selOpts);
				}
				else{
					$('#sub_expenses option').remove();
				}
			}
		});
	}
});
});
</script>

<div class="row clearfix">
	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="card">
        	<div class="header">
                <h2>
                    Sub Sub Expense Category
                </h2>
            </div>
            <div class="body">
                <ol class="breadcrumb breadcrumb-bg-pink">
                    <li><a href="{{ url('/dashboard') }}">Home</a></li>
                    <li><a href="{{ url('/subsubexpenses') }}">Sub Sub Expense Category</a></li>
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
                <form method="post" action="{{route('subsubexpenses.store')}}">
                	{{ csrf_field() }}
                	<div class="row clearfix">
	                	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
		                    <label for="expense_category">Expense Category</label>
		                    <div class="form-group">
		                        <select class="form-control show-tick search" id="expense_category" name="expense_category">
		                            <option value="">-- Please select expense category --</option>
		                            @foreach($expense_category as $list)
		                            <option value="{{$list->id}}">{{$list->name}}</option>
		                            @endforeach
		                        </select>
		                    </div>
		                </div>
		            	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 sub_expenses">
		                    <label for="sub_expenses">Sub Expense Category</label>
		                    <div class="form-group">
		                        <select class="form-control show-tick" id="sub_expenses" name="sub_expenses">
		                            <option value="">-- Please select sub expense category --</option>
		                        </select>
		                    </div>
		                </div>
		            	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 ">
		                    <label for="name">Name</label>
		                    <div class="form-group">
		                        <div class="form-line">
		                            <input type="text" id="name" name="name" class="form-control" placeholder="Enter expense category name" value="{{ old('name') }}" >
		                        </div>
		                    </div>
		                </div>
		            	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 ">
		                    <label for="description">Description</label>
		                    <div class="form-group">
		                        <div class="form-line">
		                            <textarea id="description" name="description" rows="1" class="form-control no-resize auto-growth" placeholder="Enter description(press ENTER for more lines)">{{ old('description') }}</textarea>
		                        </div>
		                    </div>
		                </div>
                    </div>
                    <button type="submit" class="btn btn-primary m-t-15 waves-effect">Save</button>
                </form>
            </div>
        </div>
    </div>
</div>


@endsection
