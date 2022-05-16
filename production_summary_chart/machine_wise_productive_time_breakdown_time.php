<?php 
include('../login/db_connection_class.php');
$obj = new DB_Connection_Class();
$obj->connection();
?>

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

                            <div class="form-group form-group-sm" id="form-group_for_to_date" style="margin-right:0px; margin-top:10px; color:#00008B;">
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

                            <div class="form-group form-group-sm" id="form-group_for_to_date" style="margin-right:0px; margin-top:10px; color:#00008B;">
                                <label class="control-label col-sm-4 " for="machine">Select Machine :</label>
                                <div class="col-sm-5" style="padding-right: 0">
                                    <select  class="form-control " id="machine" name="machine" multiple="multiple">
                                        <option select="selected" value="select">Select Machine</option>
                                        <?php 
                                            $sql = 'select DISTINCT machine_name from `machine_name`';
                                            $result= mysqli_query($con,$sql) or die(mysqli_error($con));
                                            while( $row = mysqli_fetch_array( $result))
                                            {
                                                echo '<option value="'.$row['machine_name'].'">'.$row['machine_name'].'</option>';
                                            }
                                        ?>
                                    </select>
                                    <script>
                                        $("#machine").select2({
                                            placeholder: "Select Machine",
                                            theme: "classic",
                                            selectOnClose: true,
                                            closeOnSelect: true,
                                            allowClear: true
                                        });
                                    </script>
                                </div>
                            </div>

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


<?php
    $a = 'hello world';
?>

<script>

function date_wise_productivity_chart()
{

        //var url_encoded_form_data = $("#date_wise_productivity_chart_form").serialize();

        var machine = $("#machine").val(); 
        var from_date = $("#from_date").val(); 
        var to_date = $("#to_date").val(); 
        var machines = machine.toString();

        var from_date = document.getElementById('from_date').value;
        var to_date = document.getElementById('to_date').value;

        var total_date = 'From '+from_date+' To '+to_date;
        // alert(total_date);
        var total_working_hour;
        var production_date; 
        var value_for_change_overtime;
        var value_for_electrical_breakdown_time;
        var value_for_Mechanical_breakdown_time;
        var value_for_schedule_maintanance_time;
        var value_for_production_time;
        var value_for_production_quantity;

         $.ajax({
                    url: 'production_summary_chart/machine_wise_productive_time_breakdown_chart_data_table.php',
                    type: 'post',
                    dataType: 'json',
                    //dataType: 'text',
                    data: {machine:machines, from_date:from_date, to_date:to_date},
                    success: function( data, textStatus, jQxhr )
                    {
                                //alert(data);
                                machine_name = data.machine_name;
                                // value_for_change_overtime  = parseFloat(data.value_for_change_overtime).toFixed(0);
                                value_for_change_overtime  = data.value_for_change_overtime;
                                value_for_breakdown_time  = data.value_for_breakdown_time;
                                value_for_schedule_maintanance_time  = data.value_for_schedule_maintanance_time;
                                value_for_production_time  = data.value_for_production_time;
                                value_for_total_time  = data.value_for_total_time;

                                // alert(machine_name);
                                // exit();

                             chart_maker(machine_name,value_for_change_overtime,value_for_breakdown_time,value_for_schedule_maintanance_time,value_for_production_time,value_for_total_time, total_date);

                    },
                    error: function( jqXhr, textStatus, errorThrown )
                    {
                            //console.log( errorThrown );
                            alert(errorThrown);
                    }
             }); // End of $.ajax({
}


function chart_maker(machine_name,value_for_change_overtime,value_for_breakdown_time,value_for_schedule_maintanance_time,value_for_production_time,value_for_total_time, total_date)
 {
    //start chart

    
    var xValues = machine_name;

    var value_for_production_time = value_for_production_time;

    var value_for_change_overtime = value_for_change_overtime;

    var value_for_schedule_maintanance_time = value_for_schedule_maintanance_time;

            
    var value_for_electrical_breakdown_time = value_for_breakdown_time;

    var value_for_mechanical_breakdown_time = ['','','',''];

    var value_for_total_working_hours = value_for_total_time;  

    var value_for_total_working_day = value_for_total_working_hours / 24;  

    // Setup Block

    const data = {
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
                                        label: 'Planed Change Over Breakdown (Hr.)',
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
                            };

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
                                    text: "M/C Wise Productive Time & Breakdown Time Summary",
                                    position: "top",
                                    font: {
                                            size: 32
                                        }
                                },
                                subtitle: {
                                            display: true,
                                            text: ['Total Working Days: ' + value_for_total_working_day,'Total Working Hr. : '+ value_for_total_working_hours,'Date : '+ total_date],

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
                    };

// Render Block
                        
const myChart = new Chart(document.getElementById('myChart').getContext('2d'), config);

  
    //end chart
}

</script>
 