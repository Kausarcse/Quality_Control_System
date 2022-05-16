
<!-- <script src="chart_js/chartjs.js"></script> -->

<script src="https://cdn.jsdelivr.net/npm/chart.js@3.7.1/dist/chart.min.js"></script>

<script src="https://cdn.jsdelivr.net/npm/chartjs-plugin-stacked100@1.0.0"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/chartjs-plugin-datalabels/2.0.0-rc.1/chartjs-plugin-datalabels.min.js" 
        integrity="sha512-+UYTD5L/bU1sgAfWA0ELK5RlQ811q8wZIocqI7+K0Lhh8yVdIoAMEs96wJAIbgFvzynPm36ZCXtkydxu1cs27w==" 
        crossorigin="anonymous" 
        referrerpolicy="no-referrer">
</script>

<h2>Welcome to Chart dashboard</h2>

<canvas id="myChart" aria-label="chart" role="img" width="100" height="40"></canvas>


<script>

var xValues = ['Zim-1', 'Zim-2', 'Zim-3','Flatbed'];

var value_for_production_time = ['78.6','61.4','78.7','15.3'];

var value_for_change_overtime = ['38.2','55.1','41.3','67.7'];

var value_for_schedule_maintanance_time = ['','','','37.0'];

        
var value_for_electrical_breakdown_time = ['3.2','','',''];

var value_for_mechanical_breakdown_time = ['','3.5','',''];



var value_for_total_working_hours = ['120','120','120','120'];         

    
var ctx = document.getElementById('myChart').getContext('2d');
var myChart = new Chart(ctx, {
    type: 'bar',
    data: {
        labels: xValues,
        datasets: [
            {
                order: 2,
                data: value_for_production_time,
                backgroundColor: [
                    // 'rgba(150, 99, 132)',
                    'green'
                ],
                // borderColor: 'rgb(255, 99, 132)',
                hoverOffset: 5,
                borderWidth: 1,               
                label: 'Productive Time (Hr.)',
                yAxisID: 'atTimeInHours',

                datalabels:  {
                        labels: {
                        title: {
                            color: 'black',
                            anchor: 'end',
                            align: 'top',
                            offset: -40,

                        }
                    },

                font: {weight: 'bold'},
                // rotation: 270,

                }
            },
            {
                order: 2,
                data: value_for_change_overtime,
                backgroundColor: [
                    // 'rgba(255, 255, 132',
                    'pink', 
                ],
                // borderColor: 'rgb(150, 255, 150)',

                borderWidth: 1,               
                label: 'Change Over Time (Hr.)',
                yAxisID: 'atTimeInHours',

                datalabels:  {
                        labels: {
                        title: {
                            color: 'black',
                            anchor: 'end',
                            align: 'top',
                            offset: -20,

                        }
                    },
                font: {weight: 'bold'},
                // rotation: 270,

                }
            },
            {
                order: 2,
                data: value_for_electrical_breakdown_time,
                backgroundColor: [
                    // 'rgba(150, 99, 132)',
                    'yellow'
                ],
                // borderColor: 'rgb(255, 99, 132)',
                hoverOffset: 5,
                borderWidth: 1,               
                label: 'Electrical Breakdown Time (Hr.)',
                yAxisID: 'atTimeInHours',

                datalabels:  {
                        labels: {
                        title: {
                            color: 'black',
                            anchor: 'end',
                            align: 'top',
                            offset: -15,

                        }
                    },

                font: {weight: 'bold'},
                // rotation: 270,

                }
            },
            {
                order: 2,
                data: value_for_mechanical_breakdown_time,
                backgroundColor: [
                    // 'rgba(150, 99, 132)',
                    '#F6BE00'
                ],
                // borderColor: 'rgb(255, 99, 132)',
                hoverOffset: 5,
                borderWidth: 1,               
                label: 'Mechanical Breakdown Time (Hr.)',
                yAxisID: 'atTimeInHours',

                datalabels:  {
                        labels: {
                        title: {
                            color: 'black',
                            anchor: 'end',
                            align: 'top',
                            offset: -15,

                        }
                    },

                font: {weight: 'bold'},
                // rotation: 270,

                }
            },
            {
                order: 2,
                data: value_for_schedule_maintanance_time,
                backgroundColor: [
                    // 'rgba(150, 99, 132)',
                    'blue'
                ],
                // borderColor: 'rgb(255, 99, 132)',
                hoverOffset: 5,
                borderWidth: 1,               
                label: 'Schedule Maintanance (Hr.)',
                yAxisID: 'atTimeInHours',

                datalabels:  {
                        labels: {
                        title: {
                            color: 'black',
                            anchor: 'end',
                            align: 'top',
                            offset: -20,

                        }
                    },

                font: {weight: 'bold'},
                // rotation: 270,

                }
            },
            {
                order: 1,
                type: 'line',
                order: 1,
                data: value_for_total_working_hours,
                backgroundColor: [
                    // 'rgba(150, 99, 132)',
                    'red'
                ],
                borderColor: 'rgb(230, 50, 132)',
                hoverOffset: 5,
                borderWidth: 5,               
                label: 'Total Working (Hr.)',
                yAxisID: 'atTimeInHours',

                datalabels:  {
                        labels: {
                        title: {
                            color: 'black',
                            anchor: 'end',
                            align: 'top',
                            offset: 5,

                        }
                    },

                font: {weight: 'bold'},
                rotation: 0,

                }
            },
            
    ]
    },
    plugins: [ChartDataLabels],

    options: {
        layout: {
            padding: {
                left: 50,
                top: 50,
                right:50,
                bottom:50
            },
        },
        plugins: {
        
        title: {
                display: true,
                text: "M/C Wise Productive Time & Breakdown Time Summary",
                position: "top",
            },
            legend: {
                display: true,
                position: 'bottom',
            },
        
        },
        scales: {
            responsive: true,
            // y: {
            //     stacked: true,
            // },
            xAxes: {
                stacked: true,
            },

            atTimeInHours: {
                    order: 2,
                    stacked: true,
                    title: {
                        display: true,
                        text: "Time (Hr.)",
                    },
                    scaleLabel:{
                        display: true,
                        labelString: 'atTimeInHours'
                    },
                    type: 'linear',
                    position: 'left',
                    // grid: {display: false},
                    ticks: {
                        beginAtZero: false,
                        max: 120,
                        min: 0,
                        stepSize: 20
                    },
                },
     
        }
    }
});
</script>
 