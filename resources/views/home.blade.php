@extends('layouts.app')

@section('content')

<div class="row clearfix">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="card">
            <div class="header">
                <h2>
                    DASHBOARD
                </h2>
            </div>
        </div>
    </div>
</div>

            <!-- <div class="row clearfix">
                <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                    <div class="info-box bg-pink hover-expand-effect">
                        <div class="icon">
                            <i class="material-icons">playlist_add_check</i>
                        </div>
                        <div class="content">
                            <div class="text">ALL USERS</div>
                            <div class="number count-to" data-from="0" data-to="125" data-speed="15" data-fresh-interval="20"></div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                    <div class="info-box bg-cyan hover-expand-effect">
                        <div class="icon">
                            <i class="material-icons">help</i>
                        </div>
                        <div class="content">
                            <div class="text">TODAY EXPENSES</div>
                            <div class="number count-to" data-from="0" data-to="257" data-speed="1000" data-fresh-interval="20"></div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                    <div class="info-box bg-light-green hover-expand-effect">
                        <div class="icon">
                            <i class="material-icons">forum</i>
                        </div>
                        <div class="content">
                            <div class="text">TODAY DEPOSITS</div>
                            <div class="number count-to" data-from="0" data-to="243" data-speed="1000" data-fresh-interval="20"></div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                    <div class="info-box bg-orange hover-expand-effect">
                        <div class="icon">
                            <i class="material-icons">person_add</i>
                        </div>
                        <div class="content">
                            <div class="text">TODAY ASSETS</div>
                            <div class="number count-to" data-from="0" data-to="1225" data-speed="1000" data-fresh-interval="20"></div>
                        </div>
                    </div>
                </div>
            </div> -->

<div class="row clearfix">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="card">
            <div class="header">
                <h2>BAR CHART</h2>
            </div>
            <div class="body">
                <canvas id="bar_chart" height="150"></canvas>
            </div>
        </div>
    </div>
</div>

<div class="row clearfix">
    <!-- <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
        <div class="card">
            <div class="header">
                <h2>
                    Balance Remaining
                </h2>
            </div>
            <div class="body">
                <div class="table-responsive">
                    <table class="table table-bordered table-striped table-hover js-basic-example dataTable">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Balance</th>
                                <th>Last Expense date</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <th></th>
                                <th></th>
                                <th></th>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div> -->
    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
        <div class="card">
            <div class="header">
                <h2>
                    Deposits
                </h2>
            </div>
            <div class="body">
                <div class="table-responsive">
                    <table class="table table-bordered table-striped table-hover js-basic-example dataTable">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Amount</th>
                                <th>Date</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($deposits_2 as $key => $value)
                            <tr>
                                <td>{{ $value->user }}</td>
                                <td>{{ $value->amount }}</td>
                                <td>{{date_format(date_create($value->created_at),"d-m-y")}}</td>
                            </tr>
                            @endforeach 
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row clearfix">
    <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
        <div class="card">
            <div class="header">
                <h2>Expense</h2>
            </div>
            <div class="body">
                <canvas id="pie_chart1" height="150"></canvas>
            </div>
        </div>
    </div>
    <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
        <div class="card">
            <div class="header">
                <h2>Asset</h2>
            </div>
            <div class="body">
                <canvas id="pie_chart2" height="150"></canvas>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
$(function () {
    new Chart(document.getElementById("bar_chart").getContext("2d"), getChartJs('bar'));
    new Chart(document.getElementById("pie_chart1").getContext("2d"), getChartJs('pie1'));
    new Chart(document.getElementById("pie_chart2").getContext("2d"), getChartJs('pie2'));
});
function getChartJs(type) {
    var config = null;
    if (type === 'bar') {
        config = {
            type: 'bar',
            data: {
                labels: [
                    @foreach($expenses as $key => $value)
                        @if($value->m ==1 ) "January",
                        @elseif($value->m ==2 ) "February",
                        @elseif($value->m ==3 ) "March",
                        @elseif($value->m ==4 ) "April", 
                        @elseif($value->m ==5 ) "May", 
                        @elseif($value->m ==6 ) "June", 
                        @elseif($value->m ==7 ) "July", 
                        @elseif($value->m ==8 ) "August", 
                        @elseif($value->m ==9 ) "September", 
                        @elseif($value->m ==10) "October", 
                        @elseif($value->m ==11) "November", 
                        @elseif($value->m ==12) "December"
                        @endif
                     @endforeach 
                ],
                datasets: [{
                    label: "Total expense",
                    data: [
                    @foreach($expenses as $key => $value)
                        {{ $value->total }},
                    @endforeach 
                    ],
                    backgroundColor: 'rgba(0, 188, 212, 0.8)'
                }, {
                        label: "Total Deposits",
                        data: [
                        @foreach($deposits as $key => $value)
                            {{ $value->total }},
                        @endforeach 
                    ],
                        backgroundColor: 'rgba(233, 30, 99, 0.8)'
                    }]
            },
            options: {
                responsive: true,
                legend: false
            }
        }
    }
    else if (type === 'pie1') {
        config = {
            type: 'pie',
            data: {
                datasets: [{
                    data: [
                            @foreach($expense_pc as $key => $value)
                                {{ $value->total }},
                            @endforeach 
                            ],
                    backgroundColor: [
                        "rgb(233, 30, 99)",
                        "rgb(255, 193, 7)",
                        "rgb(0, 188, 212)",
                        "rgb(0, 200, 212)",
                        "rgb(0, 188, 200)",
                        "rgb(200, 188, 212)",
                        "rgb(0, 150, 212)",
                        "rgb(0, 188, 150)",
                        "rgb(150, 195, 74)"
                    ],
                }],
                labels: [
                    @foreach($expense_pc as $key => $value)
                        "{{ $value->category1 }} @if(!empty($value->category2)) {{ $value->category2 }} @endif @if(!empty($value->category1)) {{ $value->category3 }} @endif " ,
                    @endforeach
                ]
            },
            options: {
                responsive: true,
                legend: false
            }
        }
    }
    else if (type === 'pie2') {
        config = {
            type: 'pie',
            data: {
                datasets: [{
                    data: [
                            @foreach($asset_old as $key => $value)
                                {{ $value->total }},
                            @endforeach 
                            @foreach($asset_new as $key => $value)
                                {{ $value->total }},
                            @endforeach 
                        ],
                    backgroundColor: [
                        "rgb(233, 30, 99)",
                        "rgb(255, 193, 7)",
                        "rgb(0, 188, 212)",
                        "rgb(139, 195, 74)",
                        "rgb(0, 195, 74)",
                        "rgb(139, 0, 74)",
                        "rgb(139, 195, 0)",
                        "rgb(150, 195, 74)",
                        "rgb(139, 200, 74)",
                        "rgb(139, 195, 100)",
                    ],
                }],
                labels: [
                    @foreach($asset_old as $key => $value)
                        "Old {{ $value->main_category }} @if(!empty($value->sub_category)) {{ $value->sub_category }} @endif " ,
                    @endforeach
                    @foreach($asset_new as $key => $value)
                        "{{ $value->main_category }} @if(!empty($value->sub_category)) {{ $value->sub_category }} @endif " ,
                    @endforeach 
                ]
            },
            options: {
                responsive: true,
                legend: false
            }
        }
    }
    return config;
}

</script>

@endsection
