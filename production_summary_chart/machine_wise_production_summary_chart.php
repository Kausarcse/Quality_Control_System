
<!-- <script src="chart_js/chartjs.js"></script> -->

<script src="https://cdn.jsdelivr.net/npm/chart.js@3.7.1/dist/chart.min.js"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/chartjs-plugin-datalabels/2.0.0-rc.1/chartjs-plugin-datalabels.min.js" 
        integrity="sha512-+UYTD5L/bU1sgAfWA0ELK5RlQ811q8wZIocqI7+K0Lhh8yVdIoAMEs96wJAIbgFvzynPm36ZCXtkydxu1cs27w==" 
        crossorigin="anonymous" 
        referrerpolicy="no-referrer">
</script>

<style>
    
</style>
<h2>Welcome to Chart dashboard</h2>

<canvas id="myChart" aria-label="chart" role="img" width="100" height="40"></canvas>

<script>

var xValues = ['Sun-3', 'Mon-6', 'Bab-1', 'Mon-5', 'Sun-2', 'Mon-2', 'Mon-7', 'Bab-2', 'Sun-1','Mon-4','Mon-1','Mon-3','Sun-4','Bab-3'];
var value_for_today = [67291, 59484, 24770, 26746, 29235, 54664, 36300, 32018, 30250, 40669, 19820, 14124, 32955, 25410];
var value_for_todate_total = [1186965, 1078996, 872960, 845857, 836930, 753564, 740464, 721567, 718493, 667844, 558729, 436996, 401116, 452575];
var value_for_current_avg_day = [53953, 49045, 39680, 38448, 38042, 34253, 33657, 32799, 32659, 30357, 25397, 19863, 18233, 15540];

var ctx = document.getElementById('myChart').getContext('2d');
var myChart = new Chart(ctx, {
    type: 'bar',
    data: {
        labels: xValues,
        datasets: [
            {
                data: value_for_today,
                backgroundColor: [
                    'rgba(0,128,0)',
                ],
                hoverOffset: 5,
                borderWidth: 1,               
                label: 'Today',
                yAxisID: 'today',

                datalabels:  {
                        labels: {
                        title: {
                            color: 'brown',
                            anchor: 'end',
                            align: 'top',
                            offset: -45,

                        }
                    },
                    // backgroundColor: 'yellow',
                    // boderColor: 'red',
                    borderWidth: 1,
                    // borderRadius: 5,
                    font: {weight: 'bold'},
                    padding: 0,
                    rotation: 270,
                    // backgroundColor: 'yellow',

                }
            },
            {
                data: value_for_todate_total,
                backgroundColor: [
                    'rgba(56, 123, 225)',
                ],
                hoverOffset: 5,
                borderWidth: 1,
                label: 'Todate Total',
                yAxisID: 'todateTotal',
                datalabels:  {
                        labels: {
                        title: {
                            color: 'black',
                            anchor: 'end',
                            align: 'top',
                            offset: -50,

                        }
                    },
                    // backgroundColor: 'yellow',
                    // boderColor: 'red',
                    borderWidth: 1,
                    // borderRadius: 5,
                    font: {weight: 'bold'},
                    padding: 0,
                    rotation: 270,
                    // backgroundColor: 'yellow',

                }
            },
            {
                data: value_for_current_avg_day,
                backgroundColor: [
                    'rgba(160,82,45)',
                ],
                hoverOffset: 5,
                borderWidth: 1,
                label: 'Current Avg/Day',
                yAxisID: 'today',
                datalabels:  {
                  
                        labels: {
                        title: {
                            color: 'white',
                            anchor: 'end',
                            align: 'top',
                            offset: -45,

                        }
                    },
                    // backgroundColor: 'yellow',
                    // borderColor: 'red',
                    borderWidth: 2,
                     borderRadius: 5,

                    font: {
                        weight: 'bold',
                    },
                    padding: 0,
                    rotation: 270,
                }
            }
        ]
    },
    plugins: [ChartDataLabels],

    options: {
        responsive: true,
        layout: {
            padding: {
                left: 50,
                top: 50,
                right:50,
                bottom:50
            },
        },
        interaction: {
            mode: 'index',
        },
        tooltips: {
            enabled: true,
        },
        scales: {
            today: {
                    title: {
                        display: true,
                        text: "Meters.",
                    },
                    scaleLabel:{
                        display: true,
                        labelString: 'today'
                    },
                    type: 'linear',
                    position: 'left',
                    // grid: {display: false},
                    ticks: {
                        beginAtZero: false,
                        // max: 200000,
                        min: 0,
                        stepSize: 20000
                    },
                },
                todateTotal: {
                    title: {
                        display: true,
                        text: "Meters.",
                    },
                    scaleLabel:{
                        display: true,
                        labelString: 'TodateTotal'
                    },
                    type: 'linear',
                    position: 'right',
                    grid: {display: false},
                    ticks: {
                        beginAtZero: false,
                       
                        // max: 1600000,
                        min: 0,
                        stepSize: 200000
                    }
                },
        },
        
       plugins:{
            title: {
                display: true,
                text: "M/C Wise Production Summary",
                position: "top",
            },
            legend: {
                display: true,
                position: 'bottom',
            },
       },

    },

});
</script>