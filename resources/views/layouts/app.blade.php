<!-- Author:- Anshul Agrawal -->
<!-- anshul.agrawal889@gmail.com -->
<!-- 9720044889 -->

<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=Edge">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <title>Expense</title>
    <!-- Favicon-->
    <link rel="icon" href="{{ asset('favicon.ico') }}" type="image/x-icon">

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Roboto:400,700&subset=latin,cyrillic-ext" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet" type="text/css">

    <!-- Bootstrap Core Css -->
    <link href="{{ asset('bsb/plugins/bootstrap/css/bootstrap.css') }}" rel="stylesheet">

    <!-- Waves Effect Css -->
    <link href="{{ asset('bsb/plugins/node-waves/waves.css') }}" rel="stylesheet" />

    <!-- Animation Css -->
    <link href="{{ asset('bsb/plugins/animate-css/animate.css') }}" rel="stylesheet" />

	<!-- Sweet Alert Css -->
    <link href="{{ asset('bsb/plugins/sweetalert/sweetalert.css') }}" rel="stylesheet" />
    
    <!-- Morris Chart Css-->
    <link href="{{ asset('bsb/plugins/morrisjs/morris.css') }}" rel="stylesheet" />

    <!-- Custom Css -->
    <link href="{{ asset('bsb/css/materialize.css') }}" rel="stylesheet">
    <link href="{{ asset('bsb/css/style.css') }}" rel="stylesheet">

    <!-- AdminBSB Themes. You can choose a theme from css/themes instead of get all themes -->
    <link href="{{ asset('bsb/css/themes/all-themes.css') }}" rel="stylesheet" />
    
    <!-- Jquery Core Js -->
    <script src="{{ asset('bsb/plugins/jquery/jquery.min.js') }}"></script>
    
</head>

<body class="theme-red">
    <!-- Page Loader -->
    <div class="page-loader-wrapper">
        <div class="loader">
            <div class="preloader">
                <div class="spinner-layer pl-red">
                    <div class="circle-clipper left">
                        <div class="circle"></div>
                    </div>
                    <div class="circle-clipper right">
                        <div class="circle"></div>
                    </div>
                </div>
            </div>
            <p>Please wait...</p>
        </div>
    </div>
    <!-- #END# Page Loader -->
    <!-- Overlay For Sidebars -->
    <div class="overlay"></div>
    <!-- #END# Overlay For Sidebars -->
    <!-- Search Bar -->
    <div class="search-bar">
        <div class="search-icon">
            <i class="material-icons">search</i>
        </div>
        <input type="text" placeholder="START TYPING...">
        <div class="close-search">
            <i class="material-icons">close</i>
        </div>
    </div>
    <!-- #END# Search Bar -->
    <!-- Top Bar -->
    <nav class="navbar">
        <div class="container-fluid">
            <div class="navbar-header">
                <a href="javascript:void(0);" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar-collapse" aria-expanded="false"></a>
                <a href="javascript:void(0); " class="bars"></a>
                <a class="navbar-brand" href="{{ url('/dashboard')}}">
                <img src="{{ asset('bsb/images/logo.png')}}" style="height: 55px;margin-top: -20px;display: inline-block;" alt="PLS Automobile Services Pvt. Ltd."><h4 style="display:inline;"> PLS Automobile Services Pvt. Ltd.</h4></a>
            </div>
            <div class="collapse navbar-collapse" id="navbar-collapse">
                <ul class="nav navbar-nav navbar-right">
                    <!-- Call Search ->
                    <li><a href="javascript:void(0); " class="js-search" data-close="true"><i class="material-icons">search</i></a></li>
                    <!-- #END# Call Search -->
                    <!-- Notifications ->
                    <li class="dropdown">
                        <a href="javascript:void(0); " class="dropdown-toggle" data-toggle="dropdown" role="button">
                            <i class="material-icons">notifications</i>
                            <span class="label-count">7</span>
                        </a>
                        <ul class="dropdown-menu">
                            <li class="header">NOTIFICATIONS</li>
                            <li class="body">
                                <ul class="menu">
                                    <li>
                                        <a href="javascript:void(0); ">
                                            <div class="icon-circle bg-light-green">
                                                <i class="material-icons">person_add</i>
                                            </div>
                                            <div class="menu-info">
                                                <h4>12 new members joined</h4>
                                                <p>
                                                    <i class="material-icons">access_time</i> 14 mins ago
                                                </p>
                                            </div>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="javascript:void(0); ">
                                            <div class="icon-circle bg-cyan">
                                                <i class="material-icons">add_shopping_cart</i>
                                            </div>
                                            <div class="menu-info">
                                                <h4>4 sales made</h4>
                                                <p>
                                                    <i class="material-icons">access_time</i> 22 mins ago
                                                </p>
                                            </div>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="javascript:void(0); ">
                                            <div class="icon-circle bg-red">
                                                <i class="material-icons">delete_forever</i>
                                            </div>
                                            <div class="menu-info">
                                                <h4><b>Nancy Doe</b> deleted account</h4>
                                                <p>
                                                    <i class="material-icons">access_time</i> 3 hours ago
                                                </p>
                                            </div>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="javascript:void(0); ">
                                            <div class="icon-circle bg-orange">
                                                <i class="material-icons">mode_edit</i>
                                            </div>
                                            <div class="menu-info">
                                                <h4><b>Nancy</b> changed name</h4>
                                                <p>
                                                    <i class="material-icons">access_time</i> 2 hours ago
                                                </p>
                                            </div>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="javascript:void(0); ">
                                            <div class="icon-circle bg-blue-grey">
                                                <i class="material-icons">comment</i>
                                            </div>
                                            <div class="menu-info">
                                                <h4><b>John</b> commented your post</h4>
                                                <p>
                                                    <i class="material-icons">access_time</i> 4 hours ago
                                                </p>
                                            </div>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="javascript:void(0); ">
                                            <div class="icon-circle bg-light-green">
                                                <i class="material-icons">cached</i>
                                            </div>
                                            <div class="menu-info">
                                                <h4><b>John</b> updated status</h4>
                                                <p>
                                                    <i class="material-icons">access_time</i> 3 hours ago
                                                </p>
                                            </div>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="javascript:void(0); ">
                                            <div class="icon-circle bg-purple">
                                                <i class="material-icons">settings</i>
                                            </div>
                                            <div class="menu-info">
                                                <h4>Settings updated</h4>
                                                <p>
                                                    <i class="material-icons">access_time</i> Yesterday
                                                </p>
                                            </div>
                                        </a>
                                    </li>
                                </ul>
                            </li>
                            <li class="footer">
                                <a href="javascript:void(0); ">View All Notifications</a>
                            </li>
                        </ul>
                    </li>
                    <!-- #END# Notifications -->
                    <!-- Tasks ->
                    <li class="dropdown">
                        <a href="javascript:void(0); " class="dropdown-toggle" data-toggle="dropdown" role="button">
                            <i class="material-icons">flag</i>
                            <span class="label-count">9</span>
                        </a>
                        <ul class="dropdown-menu">
                            <li class="header">TASKS</li>
                            <li class="body">
                                <ul class="menu tasks">
                                    <li>
                                        <a href="javascript:void(0); ">
                                            <h4>
                                                Footer display issue
                                                <small>32%</small>
                                            </h4>
                                            <div class="progress">
                                                <div class="progress-bar bg-pink" role="progressbar" aria-valuenow="85" aria-valuemin="0" aria-valuemax="100" style="width: 32%">
                                                </div>
                                            </div>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="javascript:void(0); ">
                                            <h4>
                                                Make new buttons
                                                <small>45%</small>
                                            </h4>
                                            <div class="progress">
                                                <div class="progress-bar bg-cyan" role="progressbar" aria-valuenow="85" aria-valuemin="0" aria-valuemax="100" style="width: 45%">
                                                </div>
                                            </div>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="javascript:void(0); ">
                                            <h4>
                                                Create new dashboard
                                                <small>54%</small>
                                            </h4>
                                            <div class="progress">
                                                <div class="progress-bar bg-teal" role="progressbar" aria-valuenow="85" aria-valuemin="0" aria-valuemax="100" style="width: 54%">
                                                </div>
                                            </div>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="javascript:void(0); ">
                                            <h4>
                                                Solve transition issue
                                                <small>65%</small>
                                            </h4>
                                            <div class="progress">
                                                <div class="progress-bar bg-orange" role="progressbar" aria-valuenow="85" aria-valuemin="0" aria-valuemax="100" style="width: 65%">
                                                </div>
                                            </div>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="javascript:void(0); ">
                                            <h4>
                                                Answer GitHub questions
                                                <small>92%</small>
                                            </h4>
                                            <div class="progress">
                                                <div class="progress-bar bg-purple" role="progressbar" aria-valuenow="85" aria-valuemin="0" aria-valuemax="100" style="width: 92%">
                                                </div>
                                            </div>
                                        </a>
                                    </li>
                                </ul>
                            </li>
                            <li class="footer">
                                <a href="javascript:void(0); ">View All Tasks</a>
                            </li>
                        </ul>
                    </li>
                    <!-- #END# Tasks -->
                    <!--<li class="pull-right"><a href="javascript:void(0); " class="js-right-sidebar" data-close="true"><i class="material-icons">more_vert</i></a></li>-->
					<li><!--a href="javascript:void(0); "><i class="material-icons">input</i>Sign Out</a-->
						<a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
							<i class="material-icons">input</i>
						</a>
						<form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
							{{ csrf_field() }}
						</form>
					</li>
				</ul>
            </div>
        </div>
    </nav>
    <!-- #Top Bar -->
    <section>
        <!-- Left Sidebar -->
        <aside id="leftsidebar" class="sidebar">
            <!-- User Info -->
            <div class="user-info">
                <div class="image">
                    <img src="{{ asset('bsb/images/user.png') }}" onerror="this.src='{{ asset('bsb/images/user.png')}}'" width="48" height="48" alt="User" />
                </div>
                <div class="info-container">
                    <div class="name" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">{{ auth::user()->name}}</div>
                    <div class="email">{{ auth::user()->email}}</div>
                    <div class="btn-group user-helper-dropdown">
                        <i class="material-icons" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">keyboard_arrow_down</i>
                        <ul class="dropdown-menu pull-right">
                            <li><a href="{{ url('users/'.Auth::id().'/edit')}}"><i class="material-icons">person</i>Profile</a></li>
                            <li role="seperator" class="divider"></li>
                            <li><a href="javascript:void(0); "><i class="material-icons">group</i>Followers</a></li>
                            <li><a href="javascript:void(0); "><i class="material-icons">shopping_cart</i>Sales</a></li>
                            <li><a href="javascript:void(0); "><i class="material-icons">favorite</i>Likes</a></li>
                            <li role="seperator" class="divider"></li>
                            <li><a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                            <i class="material-icons">input</i>
									Log Out
								</a>
								<form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
									{{ csrf_field() }}
								</form>
							</li>
                        </ul>
                    </div>
                </div>
            </div>
            <!-- #User Info -->
            <!-- Menu -->
            <div class="menu">
                <ul class="list">
                    <li class="header">MENU</li>
                    <li class="{{ Request::is('dashboard') ? 'active' : '' }}" >
                        <a href="{{ url('/dashboard') }}">
                            <i class="material-icons">dashboard</i>
                            <span>Dashboard</span>
                        </a>
                    </li>
                    @if(auth::user()->user_type == 2 || auth::user()->user_type == 3)
                    <li class="{{ Request::is('users') ? 'active' : '' }}" >
                        <a href="{{ url('/users') }}">
                            <i class="material-icons">perm_data_setting</i>
                            <span>Users</span>
                        </a>
                    </li>
                    @endif
                    @if(auth::user()->user_type == 1)
                    <li class="{{ Request::is('companies*', 'workshops*', 'designations*', 'expense-categories*', 'users*', 'taxes*', 'descriptions*', 'locations*', 'expense-categories*', 'purchase-categories*', 'asset-categories*', 'subassets') ? 'active' : '' }}">
                        <a href="javascript:void(0); " class="menu-toggle">
                            <i class="material-icons">perm_data_setting</i>
                            <span>Manage</span>
                        </a>
                        <ul class="ml-menu">
                            <li class="{{ Request::is('companies*') ? 'active' : '' }}" >
                                <a href="{{ url('companies') }}">
                                    <span>Companies</span>
                                </a>
                            </li>
                            <li class="{{ Request::is('locations*') ? 'active' : '' }}" >
                                <a href="{{ url('locations') }}">
                                    <span>Locations</span>
                                </a>
                            </li>
                            <li class="{{ Request::is('users*') ? 'active' : '' }}" >
                                <a href="{{ url('/users') }}">
                                    <span>Users</span>
                                </a>
                            </li>
                            <!-- <li class="{{ Request::is('locations*') ? 'active' : '' }}" >
                                <a href="{{ url('/locations') }}">
                                    <span>Locations</span>
                                </a>
                            </li> -->
                            <li class="{{ Request::is('designations*') ? 'active' : '' }}" >
                                <a href="{{ url('/designations') }}">
                                    <span>Designations</span>
                                </a>
                            </li>
                            <li class="{{ Request::is('taxes*') ? 'active' : '' }}" >
                                <a href="{{ url('/taxes') }}">
                                    <span>Taxes</span>
                                </a>
                            </li>
                            <li class="{{ Request::is('descriptions*') ? 'active' : '' }}" >
                                <a href="{{ url('/descriptions') }}">
                                    <span>Descriptions</span>
                                </a>
                            </li>
                        	<li class="{{ Request::is('expense-categories*') ? 'active' : '' }}" >
                                <a href="{{ url('expense-categories') }} ">
                                    <span>Expense Categories</span>
                                </a>
                                <!-- <ul class="ml-menu">
                                    <li class="{{ Request::is('expense-categories/supply-type*') ? 'active' : '' }}" >
                                        <a href="{{ url('expense-categories/supply-type') }} ">
                                            <span>Supply Type</span>
                                        </a>
                                    </li>
                                     <li class="{{ Request::is('expense-categories/supply-category*') ? 'active' : '' }}" >
                                        <a href="{{ url('expense-categories/supply-category') }} ">
                                            <span>Supply Category</span>
                                        </a>
                                    </li>
                                    <li class="{{ Request::is('expense-categories/expense-category*') ? 'active' : '' }}" >
                                        <a href="{{ url('expense-categories/expense-category') }} ">
                                            <span>Expense Category</span>
                                        </a>
                                    </li>
                                </ul> -->
                            </li>
                            <!-- <li class="{{ Request::is('purchase-categories*') ? 'active' : '' }}" >
                                <a class="menu-toggle">
                                    <span>Purchase Categories</span>
                                </a>
                                <ul class="ml-menu">
                                    <li class="{{ Request::is('purchase-categories*') ? 'active' : '' }}" >
                                        <a href="{{ url('/purchase-categories') }} ">
                                            <span>Purchase</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="{{ url('/subexpenses') }} ">
                                            <span>Sub Purchase</span>
                                        </a>
                                    </li>
                                </ul>
                            </li> -->
                            <li class="{{ Request::is('asset-categories*', 'subassets*') ? 'active' : '' }}" >
                                <a class="menu-toggle">
                                    <span>Asset Categories</span>
                                </a>
                                <ul class="ml-menu">
                                    <li class="{{ Request::is('asset-categories*') ? 'active' : '' }}" >
                                        <a href="{{ url('/asset-categories') }} ">
                                            <span>Asset</span>
                                        </a>
                                    </li>
                                    <li class="{{ Request::is('subassets*') ? 'active' : '' }}" >
                                        <a href="{{ url('/subassets') }} ">
                                            <span>Sub Asset</span>
                                        </a>
                                    </li>
                                </ul>
                            </li>
                        </ul>
                    </li>
                    @endif
                    @if(auth::user()->user_type <= 3)
                    <li class="{{ Request::is('deposits*') ? 'active' : '' }}" >
                        <a href="{{ url('/deposits') }}" >
                            <i class="material-icons">account_balance</i>
                            <span>Deposit</span>
                        </a>
                    </li>
                    @endif
                    <li class="{{ Request::is('expenses*') ? 'active' : '' }}" >
                        <a href="{{ url('/expenses') }}" >
                            <i class="material-icons">account_balance_wallet</i>
                            <span>Expense</span>
                        </a>
                    </li>
                    <!--<li>
                        <a href="javascript:void(0); " class="menu-toggle">
                            <i class="material-icons">trending_down</i>
                            <span>Expense</span>
                        </a>
                        <ul class="ml-menu">
                        	<!--<li>
                                <a href="javascript:void(0); " class="menu-toggle">
                                    <span>Fuel</span>
                                </a>
                                <ul class="ml-menu">
                                    <li>
                                        <a href="{{ url('/fuel/cng') }} ">
                                            <span>CNG</span>
                                        </a>
                                    </li>
                                </ul>
                            </li>
                            <li>
                                <a href="{{ url('/expenses/create') }}">
                                    <span>Expense</span>
                                </a>
                            </li>
                        </ul>
                    </li>-->
                    <li class="{{ Request::is('assets*') ? 'active' : '' }}">
                        <a href="javascript:void(0); " class="menu-toggle">
                            <i class="material-icons">business_center</i>
                            <span>Assets</span>
                        </a>
                        <ul class="ml-menu">
                            <li class="{{ Request::is('assets/new*') ? 'active' : '' }} ">
                                <a href="{{ url('/assets/new') }}" >
                                    <span>New</span>
                                </a>
                            </li>
                            <li class="{{ Request::is('assets/old*') ? 'active' : '' }} ">
                                <a href="{{ url('/assets/old') }}" >
                                    <span>Old</span>
                                </a>
                            </li>
                        </ul>
                    </li>
                    @if(auth::user()->user_type == 1 || auth::user()->user_type == 3)
                    <li class="{{ Request::is('report*' ) ? 'active' : '' }}" >
                        <a href="javascript:void(0); " class="menu-toggle">
                            <i class="material-icons">developer_board</i>
                            <span>Report</span>
                        </a>
                        <ul class="ml-menu">
                            <li class="{{ Request::is('report/deposits*') ? 'active' : '' }}" >
                                <a href="{{ url('/report/deposits') }}">
                                    <span>Deposit</span>
                                </a>
                            </li>
                            <li class="{{ Request::is('report/expenses*') ? 'active' : '' }}" >
                                <a href="{{ url('/report/expenses') }}">
                                    <span>Expense</span>
                                </a>
                            </li>
                            <li class="{{ Request::is('report/assets') ? 'active' : '' }}" >
                                <a href="{{ url('/report/assets') }}">
                                    <span>Asset</span>
                                </a>
                            </li>
                            <li class="{{ Request::is('report/assets/expiry*') ? 'active' : '' }}" >
                                <a href="{{ url('/report/assets/expiry') }}">
                                    <span>Asset Expiry</span>
                                </a>
                            </li>
                            <!-- <li class="{{ Request::is('report/ledgers') ? 'active' : '' }}" >
                                <a href="{{ url('/report/ledgers') }}">Ledger</a>
                            </li> -->
                            <!--<li>
                                <a href="{{ url('/report/overall') }}">Overall</a>
                            </li>-->
                        </ul>
                    </li>
                    @endif
                </ul>
            </div>
            <!-- #Menu -->
            <!-- Footer -->
            <div class="legal">
            	<div class="version">
                    Designed & Developed By
                </div>
                <div class="copyright">
                    <a href="http://techstreet.in/">Techstreet Solutions</a> &copy; {{date('Y')}} 
                </div>
            </div>
            <!-- #Footer -->
        </aside>
        <!-- #END# Left Sidebar -->
        <!-- Right Sidebar ->
        <aside id="rightsidebar" class="right-sidebar">
            <ul class="nav nav-tabs tab-nav-right" role="tablist">
                <li role="presentation" class="active"><a href="#skins" data-toggle="tab">SKINS</a></li>
                <li role="presentation"><a href="#settings" data-toggle="tab">SETTINGS</a></li>
            </ul>
            <div class="tab-content">
                <div role="tabpanel" class="tab-pane fade in active in active" id="skins">
                    <ul class="demo-choose-skin">
                        <li data-theme="red" class="active">
                            <div class="red"></div>
                            <span>Red</span>
                        </li>
                        <li data-theme="pink">
                            <div class="pink"></div>
                            <span>Pink</span>
                        </li>
                        <li data-theme="purple">
                            <div class="purple"></div>
                            <span>Purple</span>
                        </li>
                        <li data-theme="deep-purple">
                            <div class="deep-purple"></div>
                            <span>Deep Purple</span>
                        </li>
                        <li data-theme="indigo">
                            <div class="indigo"></div>
                            <span>Indigo</span>
                        </li>
                        <li data-theme="blue">
                            <div class="blue"></div>
                            <span>Blue</span>
                        </li>
                        <li data-theme="light-blue">
                            <div class="light-blue"></div>
                            <span>Light Blue</span>
                        </li>
                        <li data-theme="cyan">
                            <div class="cyan"></div>
                            <span>Cyan</span>
                        </li>
                        <li data-theme="teal">
                            <div class="teal"></div>
                            <span>Teal</span>
                        </li>
                        <li data-theme="green">
                            <div class="green"></div>
                            <span>Green</span>
                        </li>
                        <li data-theme="light-green">
                            <div class="light-green"></div>
                            <span>Light Green</span>
                        </li>
                        <li data-theme="lime">
                            <div class="lime"></div>
                            <span>Lime</span>
                        </li>
                        <li data-theme="yellow">
                            <div class="yellow"></div>
                            <span>Yellow</span>
                        </li>
                        <li data-theme="amber">
                            <div class="amber"></div>
                            <span>Amber</span>
                        </li>
                        <li data-theme="orange">
                            <div class="orange"></div>
                            <span>Orange</span>
                        </li>
                        <li data-theme="deep-orange">
                            <div class="deep-orange"></div>
                            <span>Deep Orange</span>
                        </li>
                        <li data-theme="brown">
                            <div class="brown"></div>
                            <span>Brown</span>
                        </li>
                        <li data-theme="grey">
                            <div class="grey"></div>
                            <span>Grey</span>
                        </li>
                        <li data-theme="blue-grey">
                            <div class="blue-grey"></div>
                            <span>Blue Grey</span>
                        </li>
                        <li data-theme="black">
                            <div class="black"></div>
                            <span>Black</span>
                        </li>
                    </ul>
                </div>
                <div role="tabpanel" class="tab-pane fade" id="settings">
                    <div class="demo-settings">
                        <p>GENERAL SETTINGS</p>
                        <ul class="setting-list">
                            <li>
                                <span>Report Panel Usage</span>
                                <div class="switch">
                                    <label><input type="checkbox" checked><span class="lever"></span></label>
                                </div>
                            </li>
                            <li>
                                <span>Email Redirect</span>
                                <div class="switch">
                                    <label><input type="checkbox"><span class="lever"></span></label>
                                </div>
                            </li>
                        </ul>
                        <p>SYSTEM SETTINGS</p>
                        <ul class="setting-list">
                            <li>
                                <span>Notifications</span>
                                <div class="switch">
                                    <label><input type="checkbox" checked><span class="lever"></span></label>
                                </div>
                            </li>
                            <li>
                                <span>Auto Updates</span>
                                <div class="switch">
                                    <label><input type="checkbox" checked><span class="lever"></span></label>
                                </div>
                            </li>
                        </ul>
                        <p>ACCOUNT SETTINGS</p>
                        <ul class="setting-list">
                            <li>
                                <span>Offline</span>
                                <div class="switch">
                                    <label><input type="checkbox"><span class="lever"></span></label>
                                </div>
                            </li>
                            <li>
                                <span>Location Permission</span>
                                <div class="switch">
                                    <label><input type="checkbox" checked><span class="lever"></span></label>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </aside>
        <!-- #END# Right Sidebar -->
    </section>
    
	<section class="content">
	@yield('content')
    </section> 

    <!-- Bootstrap Core Js -->
    <script src="{{ asset('bsb/plugins/bootstrap/js/bootstrap.js') }}"></script>
    
    <!-- Slimscroll Plugin Js -->
    <script src="{{ asset('bsb/plugins/jquery-slimscroll/jquery.slimscroll.js') }}"></script>

    <!-- Waves Effect Plugin Js -->
    <script src="{{ asset('bsb/plugins/node-waves/waves.js') }}"></script>

    <!-- Morris Plugin Js -->
    <script src="{{ asset('bsb/plugins/raphael/raphael.min.js') }}"></script>
    <script src="{{ asset('bsb/plugins/morrisjs/morris.js') }}"></script>

    <script src="{{ asset('bsb/plugins/chartjs/Chart.bundle.js') }}"></script>

    
    <!-- Custom Js -->
    <script src="{{ asset('bsb/js/admin.js') }}"></script>


</body>

</html>