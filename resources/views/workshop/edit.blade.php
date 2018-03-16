 @extends('layouts.app')

@section('content')
<!-- Bootstrap Select Css -->
<link href="{{ asset('bsb/plugins/bootstrap-select/css/bootstrap-select.css')}}" rel="stylesheet" />

<div class="row clearfix">
	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="card">
            <div class="header">
                <h2>
                    Workshop
                </h2>
            </div>
            <div class="body">
                <ol class="breadcrumb breadcrumb-bg-pink">
                    <li><a href="{{ url('/dashboard') }}">Home</a></li>
                    <li><a href="{{ url('/workshops') }}">Workshop</a></li>
                    <li class="active">Create New</li>
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
                <form method="post" action="{{ route('workshops.store') }}">
                	{{ csrf_field() }}
                    <label for="name">Company</label>
                    <div class="form-group">
                        <select class="form-control show-tick" id="company" name="company">
                            <option value="">-- Please select company --</option>
                            @foreach($company as $list)
                            <option value="{{$list->id}}">{{$list->name}}</option>
                            @endforeach
                        </select>
                    </div>
                    <label for="name">Name</label>
                    <div class="form-group">
                        <div class="form-line">
                            <input type="text" id="name" value="{{ old('name') }}" name="name" class="form-control" placeholder="Enter workshop name">
                        </div>
                    </div>
                    <label for="code">Code</label>
                    <div class="form-group">
                        <div class="form-line">
                            <input type="text" id="code" value="{{ old('code') }}" name="code" class="form-control" placeholder="Enter Workshop code">
                        </div>
                    </div>
                    
                    <label for="mobile">Mobile</label>
                    <div class="form-group">
                        <div class="form-line">
                            <input type="number" id="mobile" value="{{ old('mobile') }}" name="mobile" class="form-control" placeholder="Enter mobile number">
                        </div>
                    </div>
                    <label for="phone">Phone</label>
                    <div class="form-group">
                        <div class="form-line">
                            <input type="text" id="phone" value="{{ old('phone') }}" name="phone" class="form-control" placeholder="Enter phone number">
                        </div>
                    </div>
                    <label for="email">Email</label>
                    <div class="form-group">
                        <div class="form-line">
                            <input type="text" id="email" value="{{ old('email') }}" name="email" class="form-control" placeholder="Enter email id">
                        </div>
                    </div>
                    <label for="address">Address</label>
                    <div class="form-group">
                        <div class="form-line">
                            <textarea id="address" value="{{ old('email') }}" name="address" rows="1" class="form-control no-resize auto-growth" placeholder="Enter address of workshop (press ENTER for more lines)"></textarea>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary m-t-15 waves-effect">Save</button>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Select Plugin Js -->
<script src="{{ asset('bsb/plugins/bootstrap-select/js/bootstrap-select.js')}}"></script>

@endsection
