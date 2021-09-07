<div>
    <div class="bg-body-light">
        <div class="content content-full">
            <div class="d-flex flex-column flex-sm-row justify-content-sm-between align-items-sm-center py-2 text-center text-sm-left">
                <div class="flex-sm-fill">
                    <h1 class="h3 font-w700 mb-2">
                        Dashboard
                    </h1>
                    <h2 class="h6 font-w500 text-muted mb-0">
                        Welcome back, {{ Auth::user()->name }}.{{--  - ({{ Auth::user()->getRoleNames()->implode(',') }}) --}}
                    </h2>
                </div>
                <div class="mt-3 mt-sm-0 ml-sm-3">
                    <button type="button" class="btn btn-sm btn-alt-primary">
                        {{ $start_date.' - '. $end_date }}
                    </button>
                    <div class="dropdown d-inline-block">
                        <button type="button" class="btn btn-sm btn-alt-primary" id="dropdown-analytics-overview" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="fa fa-fw fa-calendar-alt"></i>
                            @if (is_int($duration))
                            Last {{ $duration }} days
                            @else
                            {{ $duration }}
                            @endif
                            <i class="fa fa-fw fa-angle-down"></i>
                        </button>
                        <div class="dropdown-menu dropdown-menu-right font-size-sm" aria-labelledby="dropdown-analytics-overview">
                            <a class="dropdown-item font-w500" value="1" href="javascript:void(0)" wire:click="selectedDuration(7)">Last 7 days</a>
                            <a class="dropdown-item font-w500" value="1" href="javascript:void(0)" wire:click="selectedDuration(30)">Last 30 days</a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item font-w500" value="1" href="javascript:void(0)" wire:click="selectedDuration('{{ date('F') }}')">This Month</a>
                            <a class="dropdown-item font-w500" value="1" href="javascript:void(0)" wire:click="selectedDuration('{{ date('F',strtotime(date('F')." last month")) }}')">Last Month</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="content" wire:init="selectedDuration">
        <div class="row row-deck">
            <div class="col-sm-6 col-xl-3">
                <div class="block block-rounded d-flex flex-column">
                    <div class="block-content block-content-full flex-grow-1 d-flex justify-content-between align-items-center">
                        <dl class="mb-0">
                            <span class="text-muted" wire:loading>Loading...</span>
                            <dt class="font-size-h2 font-w700" wire:loading.remove>{{ $total }}</dt>
                            <dd class="text-muted mb-0">Total Appointments</dd>
                        </dl>
                        <div class="item item-rounded bg-body">
                            <i class="far fa-calendar-alt font-size-h3 text-primary"></i>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-6 col-xl-3">
                <div class="block block-rounded d-flex flex-column">
                    <div class="block-content block-content-full flex-grow-1 d-flex justify-content-between align-items-center">
                        <dl class="mb-0">
                            <span class="text-muted" wire:loading>Loading...</span>
                            <dt class="font-size-h2 font-w700" wire:loading.remove>{{ $scheduled }}</dt>
                            <dd class="text-muted mb-0">Scheduled Appointments</dd>
                        </dl>
                        <div class="item item-rounded bg-body">
                            <i class="far fa-calendar-alt font-size-h3 text-primary"></i>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-6 col-xl-3">
                <div class="block block-rounded d-flex flex-column">
                    <div class="block-content block-content-full flex-grow-1 d-flex justify-content-between align-items-center">
                        <dl class="mb-0">
                            <span class="text-muted" wire:loading>Loading...</span>
                            <dt class="font-size-h2 font-w700" wire:loading.remove>{{ $today_appointments }}</dt>
                            <dd class="text-muted mb-0">Today Appointments</dd>
                        </dl>
                        <div class="item item-rounded bg-body">
                            <i class="far fa-calendar-alt font-size-h3 text-primary"></i>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-6 col-xl-3">
                <div class="block block-rounded d-flex flex-column">
                    <div class="block-content block-content-full flex-grow-1 d-flex justify-content-between align-items-center">
                        <dl class="mb-0">
                            <span class="text-muted" wire:loading>Loading...</span>
                            <dt class="font-size-h2 font-w700" wire:loading.remove>{{ $customers }}</dt>
                            <dd class="text-muted mb-0">New Unique Customers</dd>
                        </dl>
                        <div class="item item-rounded bg-body">
                            <i class="fa fa-users font-size-h3 text-primary"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-xl-8 d-flex flex-column">
                <div class="block block-rounded flex-grow-1 d-flex flex-column" wire:ignore>
                    <div class="block-header block-header-default">
                        <h3 class="block-title">Appointments Summary</h3>
                        <div class="block-options">
                            <button type="button" class="btn-block-option" data-toggle="block-option" data-action="state_toggle" data-action-mode="demo">
                                <i class="si si-refresh"></i>
                            </button>
                            <button type="button" class="btn-block-option">
                                <i class="si si-settings"></i>
                            </button>
                        </div>
                    </div>
                    <div class="block-content block-content-full flex-grow-1 d-flex align-items-center">
                        <canvas id="appointment-chartjs"></canvas>
                    </div>
                    <div class="block-content bg-body-light">
                        <div class="row items-push text-center w-100">
                            <div class="col-sm-4">
                                <dl class="mb-0">
                                    <dt class="font-size-h3 font-w700">
                                        <i class="fa fa-arrow-up font-size-lg text-success"></i> 2.5%
                                    </dt>
                                    <dd class="text-muted mb-0">Customer Growth</dd>
                                </dl>
                            </div>
                            <div class="col-sm-4">
                                <dl class="mb-0">
                                    <dt class="font-size-h3 font-w700">
                                        <i class="fa fa-arrow-up font-size-lg text-success"></i> 3.8%
                                    </dt>
                                    <dd class="text-muted mb-0">Page Views</dd>
                                </dl>
                            </div>
                            <div class="col-sm-4">
                                <dl class="mb-0">
                                    <dt class="font-size-h3 font-w700">
                                        <i class="fa fa-arrow-up font-size-lg text-success"></i> 1.7%
                                    </dt>
                                    <dd class="text-muted mb-0">New Products</dd>
                                </dl>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-4 d-flex flex-column">
                <div class="row row-deck flex-grow-1">
                    <div class="col-md-6 col-xl-12">
                        <div class="block block-rounded d-flex flex-column" wire:ignore.self>
                            <div class="block-content block-content-full flex-grow-1 d-flex justify-content-between">
                                <dl class="mb-0">
                                    <dt class="font-size-h2 font-w700">{{ collect($current_week)->sum() }}</dt>
                                    <dd class="text-muted mb-0">Total Appointments</dd>
                                </dl>
                                <div>
                                    @if ($result < 0)
                                    @php
                                        $caret = 'fa-caret-down';
                                        $class = 'text-danger bg-danger-light';
                                        $rgb   = '210,108,122';
                                        $color = '#D26C7A';
                                    @endphp
                                    @else
                                    @php
                                        $caret = 'fa-caret-up';
                                        $class = 'text-success bg-success-light';
                                        $rgb   = '70,195,123';
                                        $color = '#46C37B';
                                    @endphp
                                    @endif
                                    <div class="d-inline-block px-2 py-1 rounded-lg font-size-sm font-w600 {{ $class }}">
                                        <i class="fa {{ $caret }} mr-1"></i>
                                        {{ $result }}%
                                    </div>
                                </div>
                            </div>
                            <div class="block-content p-1 text-center overflow-hidden" wire:ignore.self>
                                <span class="js-sparkline"></span>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 col-xl-12">
                        <div class="block block-rounded d-flex flex-column" wire:ignore>
                            <div class="block-content block-content-full flex-grow-1 d-flex justify-content-between">
                                <dl class="mb-0">
                                    <dt class="font-size-h2 font-w700">{{ number_format(rand(1,5000)) }}</dt>
                                    <dd class="text-muted mb-0">Total Orders</dd>
                                </dl>
                                <div>
                                    <div class="d-inline-block px-2 py-1 rounded-lg font-size-sm font-w600 text-danger bg-danger-light">
                                        <i class="fa fa-caret-down mr-1"></i>
                                        2.2%
                                    </div>
                                </div>
                            </div>
                            <div class="block-content p-1 text-center overflow-hidden">
                                <!-- Sparkline Line: Orders -->
                                <span class="js-sparkline"></span>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 col-xl-12">
                        <div class="block block-rounded d-flex flex-column" wire:ignore>
                            <div class="block-content block-content-full flex-grow-1 d-flex justify-content-between">
                                <dl class="mb-0">
                                    <dt class="font-size-h2 font-w700">{{ number_format(rand(1,5000)) }}</dt>
                                    <dd class="text-muted mb-0">Total Orders</dd>
                                </dl>
                                <div>
                                    <div class="d-inline-block px-2 py-1 rounded-lg font-size-sm font-w600 text-danger bg-danger-light">
                                        <i class="fa fa-caret-down mr-1"></i>
                                        2.2%
                                    </div>
                                </div>
                            </div>
                            <div class="block-content p-1 text-center overflow-hidden">
                                <!-- Sparkline Line: Orders -->
                                <span class="js-sparkline"></span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
Chart.defaults.global.defaultFontColor              = '#495057';
Chart.defaults.scale.gridLines.color                = 'transparent';
Chart.defaults.scale.gridLines.zeroLineColor        = 'transparent';
Chart.defaults.scale.ticks.beginAtZero              = true;
Chart.defaults.global.elements.line.borderWidth     = 0;
Chart.defaults.global.elements.point.radius         = 0;
Chart.defaults.global.elements.point.hoverRadius    = 0;
Chart.defaults.global.tooltips.cornerRadius         = 3;
Chart.defaults.global.legend.labels.boxWidth        = 12;

var ctx = document.getElementById('appointment-chartjs').getContext('2d');
var myChart = new Chart(ctx, {
    type: 'bar',
    data: {
        labels: ['SUN', 'MON', 'TUE', 'WED', 'THU', 'FRI', 'SAT'],
        datasets: [
            {
                label: 'Last Week',
                fill: true,
                backgroundColor: 'rgba(81, 121, 214, .25)',
                borderColor: 'transparent',
                pointBackgroundColor: 'rgba(81, 121, 214, 1)',
                pointBorderColor: '#fff',
                pointHoverBackgroundColor: '#fff',
                pointHoverBorderColor: 'rgba(81, 121, 214, 1)',
                data: [Math.floor(Math.random() * 50) + 1,Math.floor(Math.random() * 50) + 1,Math.floor(Math.random() * 50) + 1,Math.floor(Math.random() * 50) + 1,Math.floor(Math.random() * 50) + 1,Math.floor(Math.random() * 50) + 1,Math.floor(Math.random() * 50) + 1]
            }
        ]
    },
    options: {
        scales: {
            yAxes: [{
                ticks: {
                    beginAtZero: true,
                    callback: function(value) {if (value % 1 === 0) {return value;}}
                }
            }]
        }
    }
});

window.addEventListener('livewire:load', function () {
    
})

window.addEventListener('updateChart', event => {
    var result = 20;
    if (result < 0) {
        var color = '#D26C7A';
        var rgb = '210,108,122'
    } else {
        var color = '#46C37B';
        var rgb = '70,195,123'
    }
    console.log(event.detail.current_week);
    jQuery('.js-sparkline').sparkline(event.detail.current_week, {
        type: 'line',
        width: '100%',
        height: "70px",
        lineColor: "rgba("+rgb+", .4)",
        fillColor: "rgba("+rgb+", .15)",
        spotColor: "transparent",
        minSpotColor: "transparent",
        maxSpotColor: "transparent",
        highlightSpoColor: color,
        highlightLineColor: color,
        tooltipSuffix: "Appointments"
    });
})
</script>
@endpush