@extends('layouts.admin_app')
@section('styles')

@endsection
@section('content')
<div class="row">
            <div class="col-lg-3 col-md-6 col-sm-6">
              <div class="card  mb-2">
                <div class="card-header p-3 pt-2">
                  <div class="icon icon-lg icon-shape bg-gradient-dark shadow-dark shadow text-center border-radius-xl mt-n4 position-absolute">
                    <i class="material-icons opacity-10">weekend</i>
                  </div>
                  <div class="text-end pt-1">
                    <p class="text-sm mb-0 text-capitalize">Daily Income</p>
                    <h4 class="mb-0">{{ $dailyTotal }} MMK</h4>
                  </div>
                </div>
                <hr class="dark horizontal my-0">
                <div class="card-footer p-3">
                  {{-- <p class="mb-0"><span class="text-success text-sm font-weight-bolder">+55% </span>than last week</p> --}}
                </div>
              </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-6 mt-sm-0 mt-4">
              <div class="card  mb-2">
                <div class="card-header p-3 pt-2">
                  <div class="icon icon-lg icon-shape bg-gradient-primary shadow-primary shadow text-center border-radius-xl mt-n4 position-absolute">
                    <i class="material-icons opacity-10">leaderboard</i>
                  </div>
                  <div class="text-end pt-1">
                    <p class="text-sm mb-0 text-capitalize">Weekly Income</p>
                    <h4 class="mb-0">{{ $weeklyTotal }} MMK</h4>
                  </div>
                </div>
                <hr class="dark horizontal my-0">
                <div class="card-footer p-3">
                  {{-- <p class="mb-0"><span class="text-success text-sm font-weight-bolder">+3% </span>than last month</p> --}}
                </div>
              </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-6 mt-lg-0 mt-4">
              <div class="card  mb-2">
                <div class="card-header p-3 pt-2 bg-transparent">
                  <div class="icon icon-lg icon-shape bg-gradient-success shadow-success text-center border-radius-xl mt-n4 position-absolute">
                    <i class="material-icons opacity-10">store</i>
                  </div>
                  <div class="text-end pt-1">
                    <p class="text-sm mb-0 text-capitalize ">Monthly Income</p>
                    <h4 class="mb-0 ">{{ $monthlyTotal }} MMK</h4>
                  </div>
                </div>
                <hr class="horizontal my-0 dark">
                <div class="card-footer p-3">
                  {{-- <p class="mb-0 "><span class="text-success text-sm font-weight-bolder">+1% </span>than yesterday</p> --}}
                </div>
              </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-6 mt-lg-0 mt-4">
              <div class="card ">
                <div class="card-header p-3 pt-2 bg-transparent">
                  <div class="icon icon-lg icon-shape bg-gradient-info shadow-info text-center border-radius-xl mt-n4 position-absolute">
                    <i class="material-icons opacity-10">person_add</i>
                  </div>
                  <div class="text-end pt-1">
                    <p class="text-sm mb-0 text-capitalize ">Yearly Income </p>
                    <h4 class="mb-0 ">{{ $yearlyTotal }} MMK</h4>
                  </div>
                </div>
                <hr class="horizontal my-0 dark">
                <div class="card-footer p-3">
                  {{-- <p class="mb-0 ">Just updated</p> --}}
                </div>
              </div>
            </div>
          </div>
          {{-- second row start --}}
          {{-- <div class="row mt-5">
            <div class="col-lg-3 col-md-6 col-sm-6">
              <div class="card  mb-2">
                <div class="card-header p-3 pt-2">
                  <div class="icon icon-lg icon-shape bg-gradient-dark shadow-dark shadow text-center border-radius-xl mt-n4 position-absolute">
                    <i class="material-icons opacity-10">weekend</i>
                  </div>
                  <div class="text-end pt-1">
                    <p class="text-sm mb-0 text-capitalize">Bookings</p>
                    <h4 class="mb-0">281</h4>
                  </div>
                </div>
                <hr class="dark horizontal my-0">
                <div class="card-footer p-3">
                  <p class="mb-0"><span class="text-success text-sm font-weight-bolder">+55% </span>than last week</p>
                </div>
              </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-6 mt-sm-0 mt-4">
              <div class="card  mb-2">
                <div class="card-header p-3 pt-2">
                  <div class="icon icon-lg icon-shape bg-gradient-primary shadow-primary shadow text-center border-radius-xl mt-n4 position-absolute">
                    <i class="material-icons opacity-10">leaderboard</i>
                  </div>
                  <div class="text-end pt-1">
                    <p class="text-sm mb-0 text-capitalize">Today's Users</p>
                    <h4 class="mb-0">2,300</h4>
                  </div>
                </div>
                <hr class="dark horizontal my-0">
                <div class="card-footer p-3">
                  <p class="mb-0"><span class="text-success text-sm font-weight-bolder">+3% </span>than last month</p>
                </div>
              </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-6 mt-lg-0 mt-4">
              <div class="card  mb-2">
                <div class="card-header p-3 pt-2 bg-transparent">
                  <div class="icon icon-lg icon-shape bg-gradient-success shadow-success text-center border-radius-xl mt-n4 position-absolute">
                    <i class="material-icons opacity-10">store</i>
                  </div>
                  <div class="text-end pt-1">
                    <p class="text-sm mb-0 text-capitalize ">Revenue</p>
                    <h4 class="mb-0 ">34k</h4>
                  </div>
                </div>
                <hr class="horizontal my-0 dark">
                <div class="card-footer p-3">
                  <p class="mb-0 "><span class="text-success text-sm font-weight-bolder">+1% </span>than yesterday</p>
                </div>
              </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-6 mt-lg-0 mt-4">
              <div class="card ">
                <div class="card-header p-3 pt-2 bg-transparent">
                  <div class="icon icon-lg icon-shape bg-gradient-info shadow-info text-center border-radius-xl mt-n4 position-absolute">
                    <i class="material-icons opacity-10">person_add</i>
                  </div>
                  <div class="text-end pt-1">
                    <p class="text-sm mb-0 text-capitalize ">Followers</p>
                    <h4 class="mb-0 ">+91</h4>
                  </div>
                </div>
                <hr class="horizontal my-0 dark">
                <div class="card-footer p-3">
                  <p class="mb-0 ">Just updated</p>
                </div>
              </div>
            </div>
          </div> --}}
          {{-- second row end --}}
          {{-- pie chart start --}}
          <div class="row mt-3">
        <div class="col-md-6">
          <h5 class="mb-0">Pie Charts</h5>
          <p class="text-sm mb-0">
            Charts on this page use Chart.js - Simple yet flexible JavaScript charting for designers & developers.
          </p>
        </div>
      </div>
      <div class="row mt-4">
        <div class="col-lg-4 col-sm-6">
          <div class="card h-100">
            <div class="card-header pb-0 p-3">
              <div class="d-flex justify-content-between">
                <h6 class="mb-0">Channels</h6>
                <button type="button" class="btn btn-icon-only btn-rounded btn-outline-secondary mb-0 ms-2 btn-sm d-flex align-items-center justify-content-center" data-bs-toggle="tooltip" data-bs-placement="bottom" title="" data-bs-original-title="See traffic channels">
                  <i class="material-icons text-sm">priority_high</i>
                </button>
              </div>
            </div>
            <div class="card-body pb-0 p-3 mt-4">
              <div class="row">
                <div class="col-7 text-start">
                  <div class="chart">
                    <canvas id="chart-pie" class="chart-canvas" height="200"></canvas>
                  </div>
                </div>
                <div class="col-5 my-auto">
                  <span class="badge badge-md badge-dot me-4 d-block text-start">
                    <i class="bg-info"></i>
                    <span class="text-dark text-xs">DailyIncome</span>
                  </span>
                  <span class="badge badge-md badge-dot me-4 d-block text-start">
                    <i class="bg-primary"></i>
                    <span class="text-dark text-xs">WeeklyIncome</span>
                  </span>
                  <span class="badge badge-md badge-dot me-4 d-block text-start">
                    <i class="bg-dark"></i>
                    <span class="text-dark text-xs">MonthlyIncome</span>
                  </span>
                  <span class="badge badge-md badge-dot me-4 d-block text-start">
                    <i class="bg-secondary"></i>
                    <span class="text-dark text-xs">YEarlyIncome</span>
                  </span>
                </div>
              </div>
            </div>
            <div class="card-footer pt-0 pb-0 p-3 d-flex align-items-center">
              <div class="w-60">
                <p class="text-sm">
                  More than <b>1,200,000</b> sales are made using referral marketing, and <b>700,000</b> are from social media.
                </p>
              </div>
              <div class="w-40 text-end">
                <a class="btn bg-light mb-0 text-end" href="javascript:;">Read more</a>
              </div>
            </div>
          </div>
        </div>
        <div class="col-lg-8 col-sm-6 mt-sm-0 mt-4">
          <div class="card">
            <div class="card-header pb-0 p-3">
              <div class="d-flex justify-content-between">
                <h6 class="mb-0">Revenue</h6>
                <button type="button" class="btn btn-icon-only btn-rounded btn-outline-secondary mb-0 ms-2 btn-sm d-flex align-items-center justify-content-center" data-bs-toggle="tooltip" data-bs-placement="left" data-bs-original-title="See which ads perform better">
                  <i class="material-icons text-sm">priority_high</i>
                </button>
              </div>
              <div class="d-flex align-items-center">
                <span class="badge badge-md badge-dot me-4">
                  <i class="bg-primary"></i>
                  <span class="text-dark text-xs">Facebook Ads</span>
                </span>
                <span class="badge badge-md badge-dot me-4">
                  <i class="bg-dark"></i>
                  <span class="text-dark text-xs">Google Ads</span>
                </span>
              </div>
            </div>
            <div class="card-body p-3">
              <div class="chart">
                <canvas id="chart-line" class="chart-canvas" height="300"></canvas>
              </div>
            </div>
          </div>
        </div>
      </div>
          {{-- pie chart end --}}
          {{-- third row --}}
          
          {{-- third row --}}
          {{-- fourth row --}}
          <div class="row mt-5">
        <div class="col-md-6">
          <h5 class="mb-0">Charts</h5>
          <p class="text-sm mb-0">
            Charts on this page use Chart.js - Simple yet flexible JavaScript charting for designers & developers.
          </p>
        </div>
      </div>
           <div class="row mb-4 mt-5">
            <div class="col-lg-4 col-md-6 mt-4 mb-4">
              <div class="card z-index-2 ">
                <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2 bg-transparent">
                  <div class="bg-gradient-primary shadow-primary border-radius-lg py-3 pe-1">
                    <div class="chart">
                      <canvas id="chart-bars" class="chart-canvas" height="170"></canvas>
                    </div>
                  </div>
                </div>
                <div class="card-body">
                  <h6 class="mb-0 ">DailyIncome</h6>
                  <p class="text-sm ">Last Campaign Performance</p>
                  <hr class="dark horizontal">
                  <div class="d-flex ">
                    <i class="material-icons text-sm my-auto me-1">schedule</i>
                    <p class="mb-0 text-sm"> campaign sent 2 days ago </p>
                  </div>
                </div>
              </div>
            </div>
            {{-- add more col --}}
            {{-- add more col --}}
          </div>
          {{-- fourth row end --}}
@endsection
@section('scripts')
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script src="{{ asset('admin_app/assets/js/plugins/chartjs.min.js')}}"></script>
{{-- pie chart --}}
<script>
    var ctx1 = document.getElementById("chart-line").getContext("2d");
    var ctx2 = document.getElementById("chart-pie").getContext("2d");
    //var ctx3 = document.getElementById("chart-bar").getContext("2d");

    // Fetch monthly totals
async function fetchMonthlyTotals() {
    const response = await fetch('/admin/month-with-name-income-json');
    const data = await response.json();
    return data.monthlyTotals;
}

// Render monthly chart
async function renderMonthlyChart() {
    const monthlyTotalsData = await fetchMonthlyTotals();

    const monthNames = ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"];
    let labels = monthNames;
    let amounts = []; 

    // Fill data for all months of the year
    for(let month of monthNames) {
        amounts.push(monthlyTotalsData[month] || 0);
    }

    var ctx1 = document.getElementById("chart-line").getContext("2d");

    new Chart(ctx1, {
        type: "line",
        data: {
            labels: labels,
            datasets: [{
                label: "Monthly Totals",
                tension: 0,
                pointRadius: 5,
                pointBackgroundColor: "#e91e63",
                pointBorderColor: "transparent",
                borderColor: "#e91e63",
                borderWidth: 4,
                backgroundColor: "transparent",
                fill: true,
                data: amounts,
                maxBarThickness: 6
            }],
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: {
                    display: false,
                }
            },
            interaction: {
                intersect: false,
                mode: 'index',
            },
            scales: {
                y: {
                    grid: {
                        drawBorder: false,
                        display: true,
                        drawOnChartArea: true,
                        drawTicks: false,
                        borderDash: [5, 5],
                        color: '#c1c4ce5c'
                    },
                    ticks: {
                        display: true,
                        padding: 10,
                        color: '#9ca2b7',
                        font: {
                            size: 14,
                            weight: 300,
                            family: "Roboto",
                            style: 'normal',
                            lineHeight: 2
                        },
                    }
                },
                x: {
                    grid: {
                        drawBorder: false,
                        display: true,
                        drawOnChartArea: true,
                        drawTicks: true,
                        borderDash: [5, 5],
                        color: '#c1c4ce5c'
                    },
                    ticks: {
                        display: true,
                        color: '#9ca2b7',
                        padding: 10,
                        font: {
                            size: 14,
                            weight: 300,
                            family: "Roboto",
                            style: 'normal',
                            lineHeight: 2
                        },
                    }
                },
            },
        }
    });
}

// Call the render function when the page loads
renderMonthlyChart();

    // Pie chart
    $(document).ready(function() {
    // Make an AJAX call to get the data
    $.get('/admin/daily-income-json', function(response) {
        // The JSON data: response
        var dailyTotal = response.dailyTotal;
        var weeklyTotal = response.weeklyTotal;
        var monthlyTotal = response.monthlyTotal;
        var yearlyTotal = response.yearlyTotal;

        // Initiate the pie chart with fetched data
        var ctx2 = document.getElementById("chart-pie").getContext("2d");

        new Chart(ctx2, {
            type: "pie",
            data: {
                labels: ['DailyIncome', 'WeeklyIncome', 'MonthlyIncome', 'YEarlyIncome'],
                datasets: [{
                    label: "Income",
                    backgroundColor: ['#17c1e8', '#e91e63', '#3A416F', '#a8b8d8'],
                    data: [dailyTotal, weeklyTotal, monthlyTotal, yearlyTotal]
                }],
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        display: false,
                    }
                },
                interaction: {
                    intersect: false,
                    mode: 'index',
                },
                scales: {
                    y: {
                        grid: {
                            drawBorder: false,
                            display: false,
                            drawOnChartArea: false,
                            drawTicks: false,
                            color: '#c1c4ce5c'
                        },
                        ticks: {
                            display: false
                        }
                    },
                    x: {
                        grid: {
                            drawBorder: false,
                            display: false,
                            drawOnChartArea: false,
                            drawTicks: false,
                            color: '#c1c4ce5c'
                        },
                        ticks: {
                            display: false,
                        }
                    },
                },
            }
        });
    });
});
</script>
{{-- pie chart end --}}

<script>
 async function fetchDailyTotals() {
    const response = await fetch('/admin/daily-with-name-income-json');
    const data = await response.json();
    return data.dailyTotals;
}

async function renderChart() {
    const dailyTotalsData = await fetchDailyTotals();

    // Map numbers to day names
    const dayNames = ["S", "M", "T", "W", "T", "F", "S"];
    let labels = [];
    let amounts = [];

    // Fill data for entire week ensuring order from Sunday to Saturday
    for(let i=1; i <= 7; i++) {
        labels.push(dayNames[i-1]);
        amounts.push(dailyTotalsData[i] || 0);  // If there's no data for a day, default to 0
    }

    var ctx = document.getElementById("chart-bars").getContext("2d");

    new Chart(ctx, {
        type: "bar",
        data: {
            labels: labels,
            datasets: [{
                label: "Sales",
                tension: 0.4,
                borderWidth: 0,
                borderRadius: 4,
                borderSkipped: false,
                backgroundColor: "rgba(255, 255, 255, .8)",
                data: amounts,
                maxBarThickness: 6
            }],
        },
        options: {
        responsive: true,
        maintainAspectRatio: false,
        plugins: {
          legend: {
            display: false,
          }
        },
        interaction: {
          intersect: false,
          mode: 'index',
        },
        scales: {
          y: {
            grid: {
              drawBorder: false,
              display: true,
              drawOnChartArea: true,
              drawTicks: false,
              borderDash: [5, 5],
              color: 'rgba(255, 255, 255, .2)'
            },
            ticks: {
              suggestedMin: 0,
              suggestedMax: 500,
              beginAtZero: true,
              padding: 10,
              font: {
                size: 14,
                weight: 300,
                family: "Roboto",
                style: 'normal',
                lineHeight: 2
              },
              color: "#fff"
            },
          },
          x: {
            grid: {
              drawBorder: false,
              display: true,
              drawOnChartArea: true,
              drawTicks: false,
              borderDash: [5, 5],
              color: 'rgba(255, 255, 255, .2)'
            },
            ticks: {
              display: true,
              color: '#f8f9fa',
              padding: 10,
              font: {
                size: 14,
                weight: 300,
                family: "Roboto",
                style: 'normal',
                lineHeight: 2
              },
            }
          },
        },
      },
    });
   
}

// Call the render function when the page loads
renderChart();
</script>
{{-- first chart end --}}
@endsection