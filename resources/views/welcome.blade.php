@extends('layouts.basic')
@section('body')
<!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">
        <style>
            html, body {
                background-color: #F44336;
                font-weight: 200;
                height: 100vh;
                margin: 0;
            }

            .full-height {
                height: 100vh;
            }

            .flex-center {
                align-items: center;
                display: flex;
                justify-content: center;
            }

            .position-ref {
                position: relative;
            }

            .top-right {
                position: absolute;
                right: 10px;
                top: 18px;
            }
			.top-left {
                position: absolute;
                left: 10px;
                top: 18px;
            }

            .content {
                text-align: center;
            }

            .title {
                font-size: 90px;
				color: white;
                font-family: 'Raleway', sans-serif;
            }

            
			
			

            .m-b-md {
                margin-bottom: 30px;
            }
        </style>
    </head>
    <body>
        <div class="flex-center position-ref full-height">
            
            <div class="content">
                <div class="title m-b-md">
                    Expense Tracker
                </div>
				@if (Route::has('login'))
					<div class="links">
						@auth
							<a class="btn btn-default btn-lg waves-effect" href="{{ url('/dashboard') }}"><b>Dashboard</b></a>
							<a class="btn btn-default btn-lg waves-effect" href="{{ route('logout') }}"
								onclick="event.preventDefault();
										 document.getElementById('logout-form').submit();">
								<b>Logout</b>
							</a>

							<form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
								{{ csrf_field() }}
							</form>
						@else
							<a class="btn btn-default btn-lg waves-effect" href="{{ route('login') }}"><b>Login</b></a>
						@endauth
					</div>
				@endif
            </div>
        </div>
    @endsection
