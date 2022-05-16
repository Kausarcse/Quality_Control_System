<?php
session_start();
require_once("login/db_session_chk.php");
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <title>Noman Group</title>
  <link rel="icon" href="img/ZnZ.jpg" type="image/icon type">

  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="jq-css/jquery-ui.css">
  <link rel="stylesheet" href="bs-css/bootstrap.min.css">
<!--   <link rel="stylesheet" href="https://cdn.datatables.net/1.10.25/css/jquery.dataTables.min.css"> -->

  <link rel="stylesheet" href="bs-css/dataTables.bootstrap.css">
  <link rel="stylesheet" href="fa-css/css/font-awesome.min.css">
  <link rel="stylesheet" href="bs-css/datatable.min.css">
  <link rel="stylesheet" href="bs-css/bootstrap-datetimepicker.css">
  <link rel="stylesheet" href="bs-css/bootstrap-datetimepicker.min.css">

  
  <script src="jq-js/jquery-3.5.1.min.js"></script>

<!--   <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
  <script src="https://cdn.datatables.net/1.10.25/js/jquery.dataTables.min.js"></script> -->
  
  <script src="jq-js/jquery-ui.js"></script>
  <script src="jq-js/jquery.dataTable.min.js"></script>
  <script src="jq-js/html2pdf.bundle.min.js"></script>
  <script src="jq-js/jspdf.umd.min.js"></script>
  <script src="jq-js/jquery.table2excel.min.js"></script>

  <script src="jq-js/jszip.min.js"></script>
  <script src="jq-js/dataTables.buttons.min.js"></script>
  <script src="jq-js/pdfmake.min.js"></script>
  <script src="jq-js/vfs_fonts.js"></script>
  <script src="jq-js/buttons.html5.min.js"></script>
  <script src="jq-js/buttons.print.min.js"></script>
  
  
  <script src="bs-js/bootstrap.min.js"></script> <!-- for bootstrap -->
  <script src="bs-js/datatable.min.js"></script> <!-- for data table -->
  <script src="bs-js/datatable.fixedHeader.min.js"></script> <!-- for 
  data table -->
  <script src="bs-js/ddtf.js"></script> <!-- for data table -->
  
  <script src="js_barcode/js_barcode.all.min.js"></script> <!-- for barcode -->
  <!-- <script src="bs-js/datatables.fixedcolumns.min.js"></script> --> <!-- for data table -->

<!-- For Date -->
  <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
<!--   <link rel="stylesheet" href="/resources/demos/style.css">
  <script src="https://code.jquery.com/jquery-1.12.4.js"></script> -->
  <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>


<!--   For AUTOCOMPLETE -->

<!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/chosen/1.8.7/chosen.min.css"> -->

<link rel="stylesheet" href="bs-css/chosen_min.css">
<script src="bs-js/chosen_jquery_min.js"></script>  

 <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/chosen/1.8.7/chosen.jquery.min.js"></script> -->

 <!-- for select 2 -->

 <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<!--  for Data Table Button  -->



  <script src="https://cdn.datatables.net/1.10.25/js/jquery.dataTables.min.js"></script> <!-- for data table -->
  <script src="https://cdn.datatables.net/buttons/1.7.1/js/dataTables.buttons.min.js"></script> <!-- for data table -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script> <!-- for data table -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script> <!-- for data table -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script> <!-- for data table -->
  <script src="https://cdn.datatables.net/buttons/1.7.1/js/buttons.html5.min.js"></script> <!-- for data table -->
  <script src="https://cdn.datatables.net/buttons/1.7.1/js/buttons.print.min.js"></script> <!-- for data table -->

<!-- for datatable CSS -->
    <link rel="stylesheet" href="bs-css/dataTables.bootstrap.css">
    <link rel="stylesheet" href="bs-css/datatable.min.css">

  <!-- This section is for jQuery Autocomplete Select/Combobox -->  
  
<!--   
  <link rel="stylesheet" href="autocomplete_combobox/style.css">
  <link rel="stylesheet" href="autocomplete_combobox/jquery_combobox.css">
  <script src="autocomplete_combobox/jquery_combobox.js"></script>
-->

  <style>
  
		html, body 
		{
			height: 100%;
		}
	

		#accordion .ui-accordion-content /* Just to make Accordion content as transparent */
		{
			  background:none;

		}


@import url('https://fonts.googleapis.com/css?family=Abel|Abril+Fatface|Alegreya|Arima+Madurai|Dancing+Script|Dosis|Merriweather|Oleo+Script|Overlock|PT+Serif|Pacifico|Playball|Playfair+Display|Share|Unica+One|Vibur');
/* End Fonts */

/* //////////////////////////////////////////// */
/* //////////////////////////////////////////// */


.input-item {
    background: #fff;
    color: #333;
    padding: 14.5px 0px 15px 9px;
    border-radius: 5px 0px 0px 5px;
}



/* Show/hide password Font Icon */
#eye {
    background: #fff;
    color: #333;
  
    margin: 5.9px 0 0 0;
    margin-left: -20px;
    padding: 15px 9px 19px 0px;
    border-radius: 0px 5px 5px 0px;
  
    float: right;
    position: relative;
    right: 1%;
    top: -.2%;
    z-index: 5;
    
    cursor: pointer;
}
/* inputs form  */
input[class="form-input"]{
    width: 240px;
    height: 50px;
  
    margin-top: 2%;
    padding: 15px;
    
    font-size: 16px;
    font-family: 'Abel', sans-serif;
    color: #5E6472;
  
    outline: none;
    border: none;
  
    border-radius: 0px 5px 5px 0px;
    transition: 0.2s linear;
    
}
input[id="txt-input"] {width: 250px;}
/* focus  */
input:focus {
    transform: translateX(-2px);
    border-radius: 5px;
}

/* //////////////////////////////////////////// */
/* //////////////////////////////////////////// */

/* input[type="text"] {min-width: 250px;} */
/* buttons  */

/* Submits */
.submits {
    width: 48%;
    display: inline-block;
    /* float: left;     */
    margin-left: 2%;
}



/* buttons hover */
/* button:hover {
    transform: translatey(3px);
    box-shadow: none;
}

/* buttons hover Animation */
/* button:hover {
    animation: ani9 0.4s ease-in-out infinite alternate;
}
@keyframes ani9 {
    0% {
        transform: translateY(3px);
    }
    100% {
        transform: translateY(5px);
    } */
/* }  */


  </style>
  
  <script>
  
	  $( function() 
	  {
			$("#accordion").accordion(
			{
					 heightStyle: "content", //another are heightStyle: "fill or auto",
					 collapsible: true
			}
			);
	  } 
	  );
	  
	  $( "#accordion" ).accordion( "option", "animate", 400 );
	  
  	 //});
	 $(".accordion_menu").css({"color":"#C8D7E1","color":"#fff"});
		
	  function load_page(page_to_be_loaded)
	  {
		$("#row_for_display_bar").empty();
		$("#row_for_display_bar").load(page_to_be_loaded);
	  }

    
	  
  </script>
</head>
<body style="zoom: 90%" class="hold-transition skin-blue sidebar-mini">

   <!-- <div class="container"> -->
    <div class="container-fluid" style="height:100%;background-color:#F8F8F8; overflow:hidden"> <!-- .container-fluid for width: 100% across all viewport and device sizes. -->
         <input type="hidden" name="kausar" value="kausar">  
		  <div class="row" style="height:100%; width: 100%" id='single_row_for_whole_page'> <!-- Whole Screen has a single ROW  -->
            	<!-- Start of Menu Area -->
				<?php
				
					require_once('left_side_menu_bar/left_side_menu_bar_with_user_access.php');
				
				?>	
				<!-- End of Menu Area -->

            	<!-- Start of Content Area -->
          
        <div id="area_of_content" class="col-sm-9 col-md-9 col-lg-9" style="padding-left: 0px;">
               
					<?php
				
						require_once('content_area/top_bar.php');
						require_once('content_area/display_section.php');
           
					?>	

              <?php
                require_once('footer/footer.php');

              ?>

				</div>   <!-- End of <div id="area_of_content" class="col-sm-9 col-md-9 col-lg-9" > -->
				
                <!-- End of Content Area -->
     
       
          </div> <!-- End of <div class="row"> -->
         
    </div> <!-- End of <div class="container-fluid" style="height:100%;">  -->
     
    
</body>
</html>
