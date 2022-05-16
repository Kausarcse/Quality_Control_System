
<!-- <script src="chart_js/chartjs.js"></script> -->

<script src="https://cdn.jsdelivr.net/npm/chart.js@3.7.1/dist/chart.min.js"></script>

<script src="https://cdn.jsdelivr.net/npm/chartjs-plugin-stacked100@1.0.0"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/chartjs-plugin-datalabels/2.0.0-rc.1/chartjs-plugin-datalabels.min.js" 
        integrity="sha512-+UYTD5L/bU1sgAfWA0ELK5RlQ811q8wZIocqI7+K0Lhh8yVdIoAMEs96wJAIbgFvzynPm36ZCXtkydxu1cs27w==" 
        crossorigin="anonymous" 
        referrerpolicy="no-referrer">
</script>

<!-- <h2>Welcome to Chart dashboard</h2> -->

<body>
    <div class="col-sm-12 col-md-12 col-lg-12" id="myscroll" style="height: 750px;">
        <div class="panel panel-default" id="div_table">
            <div id="element">
                <div class="form-group form-group-sm" id="datewise_filter_machines">
                    <form class="form-horizontal" action="" method="POST" name="date_wise_productivity_chart_form" id="date_wise_productivity_chart_form">

                        <table class="table table-bordered">
                            <thead>
                            <tr>
                                <td style="text-align: center; font-size: 25px; color: black; font-weight: bold; border: 1px solid">
                                    Date Wise Productivity, Productive Time & Downtime
                                </td>

                            </tr>
                            </thead>
                        </table>

                        <div class="container container-fluid">
                                <div class="form-group form-group-sm" id="form-group_for_feom_date" style="margin-right:0px; color:#00008B;">
                                    <label class="control-label col-sm-4" for="from_date">From Date :</label>
                                    <div class="col-sm-5" style="padding-right: 0">
                                        <input type="text" class="form-control" id="from_date" name="from_date" placeholder="Please provide from date">
                                    </div>
                                    <div class="col-sm-1" style="padding-left: 0">
                                        <span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>
                                    </div>
                                </div>

                                <div class="form-group form-group-sm" id="form-group_for_to_date" style="margin-right:0px; color:#00008B;">
                                    <label class="control-label col-sm-4 " for="to_date">To Date :</label>
                                    <div class="col-sm-5" style="padding-right: 0">
                                        <input type="text" id="to_date" class="form-control" name="to_date" placeholder="Please Provide to date">
                                    </div>

                                    <div class="col-sm-1" style="padding-left: 0px">
                                        <span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>
                                    </div>
                                </div>

                                <script>
                                                $( function() 
                                                {
                                                    //$( "#from_date" ).datepicker({ dateFormat: 'dd-mm-yy' });
                                                    $( "#from_date" ).datepicker({ dateFormat: 'd-M-yy' });
                                                } );

                                                $( function() 
                                                {
                                                    $( "#to_date" ).datepicker({ dateFormat: 'd-M-yy' });
                                                } );
                                            </script>
                                <div class="col-lg-12" style="margin-top: 20px;">
                                    <button type="button" class="btn btn-primary" onclick="date_wise_productivity_chart()">Date wise productivity chart</button>
                                </div>                                
                        </div>
                    </form>
                </div>
            </div>
            <canvas id="myChart" aria-label="chart" role="img" width="100" height="40"></canvas>

        </div>
    </div>

    
</body>

<script>

function date_wise_productivity_chart()
{
    // document.getElementById('div_for_exprot_data_for_pp_progress_report').style.display = 'block';

		var url_encoded_form_data = $("#date_wise_productivity_chart_form").serialize(); 

        var from_date = document.getElementById('from_date').value;
        var to_date = document.getElementById('to_date').value;

        var total_date = 'From '+from_date+' To '+to_date;
        // alert(total_date);

        var production_date; 
        var value_for_change_overtime;
        var value_for_breakdown_time;
        var value_for_planed_change_over_time;
        var value_for_production_time;
        var value_for_production_quantity;

         $.ajax({
			 		url: 'production_summary_chart/datewise_productivity_chart_data_table.php',
			 		//dataType: 'text',
			 		type: 'post',
			 		//contentType: 'application/x-www-form-urlencoded',
                    //contentType: 'application/json',
                    dataType: 'json',
			 		data: url_encoded_form_data,
			 		success: function( data, textStatus, jQxhr )
			 		{
			 				    //alert(data);
                                
                                production_date = data.production_date;
                                value_for_change_overtime  = data.value_for_change_overtime;
                                value_for_breakdown_time  = data.value_for_breakdown_time;
                                value_for_planed_change_over_time  = data.value_for_planed_change_over_time;
                                value_for_production_time  = data.value_for_production_time;
                                value_for_production_quantity  = data.value_for_production_quantity;

                                value_for_machine_name = 'Machine Name';
                                //alert(value_for_planed_change_over_time);
                                //exit();

                             chart_maker(production_date, value_for_machine_name, value_for_change_overtime,value_for_breakdown_time,value_for_planed_change_over_time,value_for_production_time,value_for_production_quantity, total_date);

			 		},
			 		error: function( jqXhr, textStatus, errorThrown )
			 		{
			 				//console.log( errorThrown );
			 				alert(errorThrown);
			 		}
			 }); // End of $.ajax({

        // var xValues = [
        //         'April-1', 'April-2', 'April-3', 'April-4', 'April-5', 'April-6', 'April-7', 'April-8', 'April-9','April-10',
        //         'April-11', 'April-12', 'April-13', 'April-14', 'April-15', 'April-16', 'April-17', 'April-18', 'April-19','April-20',
        //         'April-21', 'April-22', 'April-23', 'April-24', 'April-25', 'April-26', 'April-27', 'April-28', 'April-29','April-30',
        //     ];
            //  alert(xValues);
           
}


function chart_maker(production_date, value_for_machine_name, value_for_change_overtime,value_for_breakdown_time,value_for_planed_change_over_time,value_for_production_time,value_for_production_quantity, total_date)
 {
    //start chart
                        // Setup Block
                        const data = {
                                        labels: production_date,
                                        datasets: [
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
                                            data: value_for_breakdown_time,
                                            backgroundColor: [
                                                // 'rgba(150, 99, 132)',
                                                '#ff6699'
                                            ],
                                            // borderColor: 'rgb(255, 99, 132)',
                                            hoverOffset: 5,
                                            borderWidth: 1,               
                                            label: 'Breakdown Time (Hr.)',
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
                                            data: value_for_planed_change_over_time,
                                            backgroundColor: [
                                                // 'rgba(150, 99, 132)',
                                                'blue'
                                            ],
                                            // borderColor: 'rgb(255, 99, 132)',
                                            hoverOffset: 5,
                                            borderWidth: 1,               
                                            label: 'Planed Change Over Time (Hr.)',
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
                                            data: value_for_production_time,
                                            backgroundColor: [
                                                // 'rgba(150, 99, 132)',
                                                '#00b300'
                                            ],
                                            // borderColor: 'rgb(255, 99, 132)',
                                            hoverOffset: 5,
                                            borderWidth: 1,               
                                            label: 'Production Time (Hr.)',
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
                                            rotation: 270,

                                            }
                                        },

                                        {
                                            type: 'line',
                                            order: 1,
                                            data: value_for_production_quantity,
                                            backgroundColor: [
                                                // 'rgba(150, 99, 132)',
                                                '#ff0000'
                                            ],
                                            borderColor: '#ff0000',
                                            hoverOffset: 5,
                                            borderWidth: 5,               
                                            label: 'Production (Mtr.)',
                                            yAxisID: 'production_qty',

                                            datalabels:  {
                                                    labels: {
                                                    title: {
                                                        color: 'white',
                                                        anchor: 'end',
                                                        align: 'top',
                                                        offset: -40,

                                                    }
                                                },

                                            font: {weight: 'bold'},
                                            rotation: 300,

                                            }
                                        },
                                    ]
                                };   // data

                                // logoImage Plugins Block

                        const logo = new Image();
                        logo.src = 'img/znz_home_logo.jpg';

                        const logoImage = {
                            id: 'logoImage',
                            beforeDraw(chart, args, options){
                                const {ctx, chartArea: {top, bottom, left, right}} = chart;
                                console.log(ctx.canvas.offsetWidth);
                                console.log(ctx.canvas.offsetHeight);

                                const logoWidth = 100;
                                const logoHeight = 90;
                                ctx.save();
                                if(logo.complete)
                                {
                                    // ctx.drawImage(logo, 10, position y, width img, height img)
                                    ctx.drawImage(logo, 1240, 40, logoWidth, logoHeight);
                                }
                                else
                                {
                                    logo.onload = () => chart.draw();
                                }
                                ctx.restore();
                            }
                        };

                        // Config Block

                        const config = {
                                            type: 'bar',
                                            data,
                                            plugins: [ChartDataLabels, logoImage],

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
                                                        text: "Date Wise Productivity, Productive Time & Downtime",
                                                        position: "top",
                                                        font: {
                                                                size: 32
                                                            }
                                                    },
                                                    
                                                subtitle: {
                                                            display: true,
                                                            // text: ['User Name: <?php //echo $user_name; ?>', 'Date: <?php //echo $date; ?>'],
                                                            text: ['M/C Name: '+value_for_machine_name,'Date : '+total_date],

                                                            position: "top",
                                                            align: 'start',
                                                            color: 'green',
                                                            padding: {
                                                                        bottom: 30
                                                                    },
                                                            font: {
                                                                    size: 18,
                                                                    weight: 'bold'
                                                                }
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
                                                                max: 24,
                                                                min: 0,
                                                                stepSize: 4
                                                            },
                                                        },
                                                        production_qty: {
                                                            order: 1,
                                                            title: {
                                                                display: true,
                                                                text: "Qty (Mtr.)",
                                                            },
                                                            scaleLabel:{
                                                                display: true,
                                                                labelString: 'productionQty'
                                                            },
                                                            type: 'linear',
                                                            position: 'right',
                                                            ticks: {
                                                                beginAtZero: false,
                                                                min: 0,
                                                                stepSize: 5000
                                                            }, 
                                                        }
                                                }
                                            }
                                        };   // config

                        // Render Block
                        
                        const myChart = new Chart(document.getElementById('myChart').getContext('2d'), config);

                    // var ctx = document.getElementById('myChart').getContext('2d');
                    // var myChart = new Chart(ctx, {
                        
                    // });


                //end chart
}

</script>
 