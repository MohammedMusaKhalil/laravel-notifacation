@extends('Admin.layouts.app')

@section('content')
<div class="container-fluid px-4">
    <h1 class="mt-4">Dashboard</h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item active">Dashboard / User Statistics</li>
    </ol>
    <div class="row">
        @foreach ($number_blocks as $block)
        <div class="col-xl-3 col-md-6">
            <div class="card bg-primary text-white mb-4">
                <div class="card-body">
                    <i class="fas fa-users fa-2x m-2"></i>
                    <span class="ml-3 display-6">{{ $block['number'] }}</span>
                    <div class="display-7">{{ $block['title'] }} </div>
                </div>
            </div>
        </div>
        @endforeach
    </div>



        @foreach ($list_blocks as $block)
        <div class="row">
            <div class="col-md-12">
                <h3>{{ $block['title'] }}</h3>
                <table class="table table-bordered table-striped">
                    <thead>
                    <tr>
                        <th>First_Name</th>
                        <th>Last_Name</th>
                        <th>Email</th>
                        <th>Last login at</th>
                    </tr>
                    </thead>
                    <tbody>
                    @forelse($block['entries'] as $entry)
                        <tr>
                            <td>{{ $entry->first_name }}</td>
                            <td>{{ $entry->last_name }}</td>
                            <td>{{ $entry->email }}</td>
                            <td>{{ $entry->last_login_at }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="3">{{ __('No entries found') }}</td>
                        </tr>
                    @endforelse
                    </tbody>
                </table>
            </div>
        </div>
        @endforeach

    <div class="container">
        <!-- Existing content for dashboard and number/list blocks -->

        <div class="card ">
            <div class="card-header">
                <i class="fas fa-chart-area me-1"></i>
                Users Chart Last 30 days
            </div>
            <div class="card-body">
                <canvas id="myAreaChart" width="100%" height="30"></canvas>
            </div>
        </div>
    </div>
</div>

@endsection


@section('title')
Dashboard - User Statistics
@endsection

@section('scripts')
<script>
// Set new default font family and font color to mimic Bootstrap's default styling
Chart.defaults.global.defaultFontFamily = '-apple-system,system-ui,BlinkMacSystemFont,"Segoe UI",Roboto,"Helvetica Neue",Arial,sans-serif';
Chart.defaults.global.defaultFontColor = '#292b2c';

// Area Chart Example
var ctx = document.getElementById("myAreaChart");
var myLineChart = new Chart(ctx, {
    type: 'line',
    data: {
        labels: @json($dates),  // Dynamically generated dates from the controller
        datasets: [{
            label: "User Logins",
            lineTension: 0.3,
            backgroundColor: "rgba(2,117,216,0.2)",
            borderColor: "rgba(2,117,216,1)",
            pointRadius: 5,
            pointBackgroundColor: "rgba(2,117,216,1)",
            pointBorderColor: "rgba(255,255,255,0.8)",
            pointHoverRadius: 5,
            pointHoverBackgroundColor: "rgba(2,117,216,1)",
            pointHitRadius: 50,
            pointBorderWidth: 2,
            data: @json($counts),  // Dynamically generated user counts
        }],
    },
    options: {
        scales: {
            xAxes: [{
                time: {
                    unit: 'date'
                },
                gridLines: {
                    display: false
                },
                ticks: {
                    maxTicksLimit: 7
                }
            }],
            yAxes: [{
                ticks: {
                    min: 0,
                    maxTicksLimit: 5
                },
                gridLines: {
                    color: "rgba(0, 0, 0, .125)",
                }
            }],
        },
        legend: {
            display: false
        }
    }
});
</script>
@endsection
