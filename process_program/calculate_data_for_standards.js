
/*function Color fastness to Crocking()
{ 
    var field_for_tolerance = document.getElementById("field_for_tolerance").value;
    var field_for_math_operator = document.getElementById("field_for_math_operator").value;

    if (field_for_math_operator == '≥') 
    {
        

        document.getElementById("field_for_minimum_value").value = field_for_tolerance;
        document.getElementById("field_for_maximum_value").value = 5;
    }

    else if (field_for_math_operator == '>') 
    {
        

        document.getElementById("field_for_minimum_value").value  = parseFloat(field_for_tolerance) + 0.5;
        document.getElementById("field_for_maximum_value").value = 5;
    }

    else if (field_for_math_operator == '<') 
    {
        

        document.getElementById("field_for_minimum_value").value = 0;
        document.getElementById("field_for_maximum_value").value =parseFloat(field_for_tolerance)-0.5;
    }

    else
    {
        

        document.getElementById("field_for_minimum_value").value = 0;
        document.getElementById("field_for_maximum_value").value = field_for_tolerance;
    }

}*/

/*function math_calculation_for_all()
{
  var field_for_value = parseFloat(document.getElementById("field_for_value").value);
      var field_for_tolerance = parseFloat(document.getElementById("field_for_tolerance").value);
      var field_for_math_operator = document.getElementById("field_for_math_operator").value;

      if (field_for_math_operator == '±') 
      {
          
          var tolarance = ((field_for_tolerance * field_for_value) / 100);
          var tol_cal_value2 = field_for_value + tolarance;
          var tol_cal_value1 = field_for_value - tolarance;

          document.getElementById("field_for_minimum_value").value = tol_cal_value1.toFixed(5);
          document.getElementById("field_for_maximum_value").value = tol_cal_value2.toFixed(5);
      }

      if (field_for_math_operator == "+")
      {
          

          var tolarance = ((field_for_tolerance * field_for_value) / 100);
          var tol_cal_value2 = field_for_value + tolarance;

          document.getElementById("field_for_minimum_value").value = field_for_value;
          document.getElementById("field_for_maximum_value").value = tol_cal_value2.toFixed(5);
      }

      if (field_for_math_operator == '-')
      {
          

          var tolarance = ((field_for_tolerance * field_for_value) / 100);
          var tol_cal_value2 = field_for_value - tolarance;

          document.getElementById("field_for_maximum_value").value = field_for_value;
          document.getElementById("field_for_minimum_value").value = tol_cal_value2.toFixed(5);
      }

      else if (field_for_math_operator == '≥') 
    {
        

        document.getElementById("field_for_minimum_value").value = field_for_tolerance;
        document.getElementById("field_for_maximum_value").value = 5;
    }

    else if (field_for_math_operator == '>') 
    {
        

        document.getElementById("field_for_minimum_value").value = field_for_tolerance+ 1;
        document.getElementById("field_for_maximum_value").value = 5;
    }

    else if (field_for_math_operator == '<') 
    {
        

        document.getElementById("field_for_minimum_value").value = 0;
        document.getElementById("field_for_maximum_value").value =  field_for_tolerance- 1;
    }

    else
    {
        

        document.getElementById("field_for_minimum_value").value = 0;
        document.getElementById("field_for_maximum_value").value = field_for_tolerance;
    }
}
*/


function color_fastness()
{ 
       var test_method_name = document.getElementById("test_method_name").value;
       var field_for_value = document.getElementById("field_for_value").value;
       var field_for_tolerance = document.getElementById("field_for_tolerance").value;
       var field_for_math_operator = document.getElementById("field_for_math_operator").value;


  if(test_method_name == "AATCC")
  {

      if (field_for_math_operator == '±') 
      {
          
          var tolarance = ((field_for_tolerance * field_for_value) / 100);
          var tol_cal_value2 = field_for_value + tolarance;
          var tol_cal_value1 = field_for_value - tolarance;

          document.getElementById("field_for_minimum_value").value = tol_cal_value1.toFixed(5);
          document.getElementById("field_for_maximum_value").value = tol_cal_value2.toFixed(5);
      }

      if (field_for_math_operator == "+")
      {
          

          var tolarance = ((field_for_tolerance * field_for_value) / 100);
          var tol_cal_value2 = field_for_value + tolarance;

          document.getElementById("field_for_minimum_value").value = field_for_value;
          document.getElementById("field_for_maximum_value").value = tol_cal_value2.toFixed(5);
      }

      if (field_for_math_operator == '-')
      {
          

          var tolarance = ((field_for_tolerance * field_for_value) / 100);
          var tol_cal_value2 = field_for_value - tolarance;

          document.getElementById("field_for_maximum_value").value = field_for_value;
          document.getElementById("field_for_minimum_value").value = tol_cal_value2.toFixed(5);
      }
  }  //end of if

  else
  {
     if (field_for_math_operator == '±') 
      {
          
          var tolarance = ((field_for_tolerance * field_for_value) / 100);
          var tol_cal_value2 = field_for_value + tolarance;
          var tol_cal_value1 = field_for_value - tolarance;

          document.getElementById("field_for_minimum_value").value = tol_cal_value1.toFixed(5);
          document.getElementById("field_for_maximum_value").value = tol_cal_value2.toFixed(5);
      }

      if (field_for_math_operator == "+")
      {
          

          var tolarance = ((field_for_tolerance * field_for_value) / 100);
          var tol_cal_value2 = field_for_value + tolarance;

          document.getElementById("field_for_minimum_value").value = field_for_value;
          document.getElementById("field_for_maximum_value").value = tol_cal_value2.toFixed(5);
      }

      if (field_for_math_operator == '-')
      {
          

          var tolarance = ((field_for_tolerance * field_for_value) / 100);
          var tol_cal_value2 = field_for_value - tolarance;

          document.getElementById("field_for_maximum_value").value = field_for_value;
          document.getElementById("field_for_minimum_value").value = tol_cal_value2.toFixed(5);
      }
  } //end of else


}






function color_fastness_to_rubbing()
{ 



    var test_method_name = document.getElementById("test_method_name").value;
    var field_for_tolerance = document.getElementById("field_for_tolerance").value;
    var field_for_math_operator = document.getElementById("field_for_math_operator").value;
  if(test_method_name == "AATCC")
  {
    //if (field_for_math_operator == '≥') 
    if (field_for_math_operator == '>=') 
    {
        

        document.getElementById("field_for_minimum_value").value = field_for_tolerance;
        document.getElementById("field_for_maximum_value").value = 5;
    }

    else if (field_for_math_operator == '>') 
    {
        

        document.getElementById("field_for_minimum_value").value  = parseFloat(field_for_tolerance) + 0.5;
        document.getElementById("field_for_maximum_value").value = 5;
    }

    else if (field_for_math_operator == '<') 
    {
        

        document.getElementById("field_for_minimum_value").value = 0;
        document.getElementById("field_for_maximum_value").value =parseFloat(field_for_tolerance)-0.5;
    }

    else
    {
        

        document.getElementById("field_for_minimum_value").value = 0;
        document.getElementById("field_for_maximum_value").value = field_for_tolerance;
    }
  }  /*end of if(test_method_name== "AATC")*/

  else
  {
      if (field_for_math_operator == '≥') 
    {
        

        document.getElementById("field_for_minimum_value").value = field_for_tolerance;
        document.getElementById("field_for_maximum_value").value = 6;
    }

    else if (field_for_math_operator == '>') 
    {
        

        document.getElementById("field_for_minimum_value").value  = parseFloat(field_for_tolerance) + 0.5;
        document.getElementById("field_for_maximum_value").value = 6;
    }

    else if (field_for_math_operator == '<') 
    {
        

        document.getElementById("field_for_minimum_value").value = 0;
        document.getElementById("field_for_maximum_value").value =parseFloat(field_for_tolerance)-0.5;
    }

    else
    {
        

        document.getElementById("field_for_minimum_value").value = 0;
        document.getElementById("field_for_maximum_value").value = field_for_tolerance;
    }
  }
    

}



function flame_intensity_cal()
{ 
      var flame_intensity_value = parseFloat(document.getElementById("flame_intensity_value").value);
      var flame_intensity_tolerance_value = parseFloat(document.getElementById("flame_intensity_tolerance_value").value);
      var flame_intensity_tolerance_range_math_operator = document.getElementById("flame_intensity_tolerance_range_math_operator").value;

      if (flame_intensity_tolerance_range_math_operator == '±') 
      {
          
          var tolarance = ((flame_intensity_tolerance_value * flame_intensity_value) / 100);
          var flame_intensity_tol_cal_value2 = flame_intensity_value + tolarance;
          var flame_intensity_tol_cal_value1 = flame_intensity_value - tolarance;

          document.getElementById("flame_intensity_min_value").value = flame_intensity_tol_cal_value1.toFixed(5);
          document.getElementById("flame_intensity_max_value").value = flame_intensity_tol_cal_value2.toFixed(5);
      }

      if (flame_intensity_tolerance_range_math_operator == "+")
      {
          

          var tolarance = ((flame_intensity_tolerance_value * flame_intensity_value) / 100);
          var flame_intensity_tol_cal_value2 = flame_intensity_value + tolarance;

          document.getElementById("flame_intensity_min_value").value = flame_intensity_value;
          document.getElementById("flame_intensity_max_value").value = flame_intensity_tol_cal_value2.toFixed(5);
      }

      if (flame_intensity_tolerance_range_math_operator == '-')
      {
          

          var tolarance = ((flame_intensity_tolerance_value * flame_intensity_value) / 100);
          var flame_intensity_tol_cal_value2 = flame_intensity_value - tolarance;

          document.getElementById("flame_intensity_max_value").value = flame_intensity_value;
          document.getElementById("flame_intensity_min_value").value = flame_intensity_tol_cal_value2.toFixed(5);
      }
}

function bath_temperature_cal()
{
  var bath_temperature = parseFloat(document.getElementById("bath_temperature").value);
      var bath_temperature_tolerance_value = parseFloat(document.getElementById("bath_temperature_tolerance_value").value);
      var bath_temperature_tolerance_range_math_operator = document.getElementById("bath_temperature_tolerance_range_math_operator").value;

      if (bath_temperature_tolerance_range_math_operator == '±') 
      {
          
          var tolarance = ((bath_temperature_tolerance_value * bath_temperature) / 100);
          var bath_temperature_tol_cal_value2 = bath_temperature + tolarance;
          var bath_temperature_tol_cal_value1 = bath_temperature - tolarance;

          document.getElementById("bath_temperature_min_value").value = bath_temperature_tol_cal_value1.toFixed(5);
          document.getElementById("bath_temperature_max_value").value = bath_temperature_tol_cal_value2.toFixed(5);
      }

      if (bath_temperature_tolerance_range_math_operator == "+")
      {
          

          var tolarance = ((bath_temperature_tolerance_value * bath_temperature) / 100);
          var bath_temperature_tol_cal_value2 = bath_temperature + tolarance;

          document.getElementById("bath_temperature_min_value").value = bath_temperature;
          document.getElementById("bath_temperature_max_value").value = bath_temperature_tol_cal_value2.toFixed(5);
      }

      if (bath_temperature_tolerance_range_math_operator == '-')
      {
          

          var tolarance = ((bath_temperature_tolerance_value * bath_temperature) / 100);
          var bath_temperature_tol_cal_value2 = bath_temperature - tolarance;

          document.getElementById("bath_temperature_max_value").value = bath_temperature;
          document.getElementById("bath_temperature_min_value").value = bath_temperature_tol_cal_value2.toFixed(5);
      }
}



//machine_speed
function machine_speed_cal()
{ 
    var machine_speed = parseFloat(document.getElementById("machine_speed").value);
      var machine_speed_tolerance_value = parseFloat(document.getElementById("machine_speed_tolerance_value").value);
      var machine_speed_tolerance_range_math_operator = document.getElementById("machine_speed_tolerance_range_math_operator").value;

      if (machine_speed_tolerance_range_math_operator == '±') 
      {
          
          var tolarance = ((machine_speed_tolerance_value * machine_speed) / 100);
          var machine_speed_tol_cal_value2 = machine_speed + tolarance;
          var machine_speed_tol_cal_value1 = machine_speed - tolarance;

          document.getElementById("machine_speed_min_value").value = machine_speed_tol_cal_value1.toFixed(5);
          document.getElementById("machine_speed_max_value").value = machine_speed_tol_cal_value2.toFixed(5);
      }

      if (machine_speed_tolerance_range_math_operator == "+")
      {
          

          var tolarance = ((machine_speed_tolerance_value * machine_speed) / 100);
          var machine_speed_tol_cal_value2 = machine_speed + tolarance;

          document.getElementById("machine_speed_min_value").value = machine_speed;
          document.getElementById("machine_speed_max_value").value = machine_speed_tol_cal_value2.toFixed(5);
      }

      if (machine_speed_tolerance_range_math_operator == '-')
      {
          

          var tolarance = ((machine_speed_tolerance_value * machine_speed) / 100);
          var machine_speed_tol_cal_value2 = machine_speed - tolarance;

          document.getElementById("machine_speed_max_value").value = machine_speed;
          document.getElementById("machine_speed_min_value").value = machine_speed_tol_cal_value2.toFixed(5);
      }
}

//PH
function ph_cal()
{
  var ph = parseFloat(document.getElementById("ph").value);
      var bath_ph_tolerance_value = parseFloat(document.getElementById("bath_ph_tolerance_value").value);
      var ph_tolerance_range_math_operator = document.getElementById("ph_tolerance_range_math_operator").value;

      if (ph_tolerance_range_math_operator == '±') 
      {
          
          var tolarance = ((bath_ph_tolerance_value * ph) / 100);
          var ph_tol_cal_value2 = ph + tolarance;
          var ph_tol_cal_value1 = ph - tolarance;

          document.getElementById("bath_ph_min_value").value = ph_tol_cal_value1.toFixed(5);
          document.getElementById("bath_ph_max_value").value = ph_tol_cal_value2.toFixed(5);
      }

      if (ph_tolerance_range_math_operator == "+")
      {
          

          var tolarance = ((bath_ph_tolerance_value * ph) / 100);
          var ph_tol_cal_value2 = ph + tolarance;

          document.getElementById("bath_ph_min_value").value = ph;
          document.getElementById("bath_ph_max_value").value = ph_tol_cal_value2.toFixed(5);
      }

      if (ph_tolerance_range_math_operator == '-')
      {
          

          var tolarance = ((bath_ph_tolerance_value * ph) / 100);
          var ph_tol_cal_value2 = ph - tolarance;

          document.getElementById("bath_ph_max_value").value = ph;
          document.getElementById("bath_ph_min_value").value = ph_tol_cal_value2.toFixed(5);
      }
}

	/*function absorbency_calculate()
	{

	    var absorbency_value = parseFloat(document.getElementById("absorbency_value").value);
      var absorbency_tolerance_value = parseFloat(document.getElementById("absorbency_tolerance_value").value);

    var tolarance = ((absorbency_tolerance_value * absorbency_value) / 100);
          var absorbency_cal_value2 = absorbency_value + tolarance;
          var absorbency_cal_value1 = absorbency_value - tolarance;

          document.getElementById("absorbency_min_value").value = absorbency_cal_value1.toFixed(5);
          document.getElementById("absorbency_max_value").value = absorbency_cal_value2.toFixed(5);
	}*/


//Defining Standard for Finishing Process

function cf_to_rubbing_dry_cal()
{ 
    var cf_to_rubbing_dry_tolerance_value = document.getElementById("cf_to_rubbing_dry_tolerance_value").value;
    var cf_to_rubbing_dry_tolerance_range_math_operator = document.getElementById("cf_to_rubbing_dry_tolerance_range_math_operator").value;

    if (cf_to_rubbing_dry_tolerance_range_math_operator == '≥') 
    {
        

        document.getElementById("cf_to_rubbing_dry_min_value").value = cf_to_rubbing_dry_tolerance_value;
        document.getElementById("cf_to_rubbing_dry_max_value").value = 5;
    }

    else if (cf_to_rubbing_dry_tolerance_range_math_operator == '>') 
    {
        

        document.getElementById("cf_to_rubbing_dry_min_value").value  = parseFloat(cf_to_rubbing_dry_tolerance_value) + 0.5;
        document.getElementById("cf_to_rubbing_dry_max_value").value = 5;
    }

    else if (cf_to_rubbing_dry_tolerance_range_math_operator == '<') 
    {
        

        document.getElementById("cf_to_rubbing_dry_min_value").value = 0;
        document.getElementById("cf_to_rubbing_dry_max_value").value =parseFloat(cf_to_rubbing_dry_tolerance_value)-0.5;
    }

    else
    {
        

        document.getElementById("cf_to_rubbing_dry_min_value").value = 0;
        document.getElementById("cf_to_rubbing_dry_max_value").value = cf_to_rubbing_dry_tolerance_value;
    }

}


function cf_to_rubbing_wet_cal()
{
    var cf_to_rubbing_wet_tolerance_value = document.getElementById("cf_to_rubbing_wet_tolerance_value").value;
    var cf_to_rubbing_wet_tolerance_range_math_operator = document.getElementById("cf_to_rubbing_wet_tolerance_range_math_operator").value;

    if (cf_to_rubbing_wet_tolerance_range_math_operator == '≥') 
    {
        

        document.getElementById("cf_to_rubbing_wet_min_value").value = cf_to_rubbing_wet_tolerance_value;
        document.getElementById("cf_to_rubbing_wet_max_value").value = 5;
    }

    else if (cf_to_rubbing_wet_tolerance_range_math_operator == '>') 
    {
        

        document.getElementById("cf_to_rubbing_wet_min_value").value = parseFloat(cf_to_rubbing_wet_tolerance_value)+0.5;
        document.getElementById("cf_to_rubbing_wet_max_value").value = 5;
    }

    else if (cf_to_rubbing_wet_tolerance_range_math_operator == '<') 
    {
        

        document.getElementById("cf_to_rubbing_wet_min_value").value = 0;
        document.getElementById("cf_to_rubbing_wet_max_value").value = parseFloat(cf_to_rubbing_wet_tolerance_value)-0.5;
    }
    else
    {
        

        document.getElementById("cf_to_rubbing_wet_min_value").value = 0;
        document.getElementById("cf_to_rubbing_wet_max_value").value = cf_to_rubbing_wet_tolerance_value;
    }

}

function warp_yarn_count_cal()
{
      var warp_yarn_count_value = parseFloat(document.getElementById("warp_yarn_count_value").value);
      var warp_yarn_count_tolerance_value = parseFloat(document.getElementById("warp_yarn_count_tolerance_value").value);
      var warp_yarn_count_tolerance_range_math_operator = document.getElementById("warp_yarn_count_tolerance_range_math_operator").value;

      if (warp_yarn_count_tolerance_range_math_operator == '±') 
      {
          
          var tolarance = ((warp_yarn_count_tolerance_value * warp_yarn_count_value) / 100);
          var flame_intensity_tol_cal_value2 = warp_yarn_count_value + tolarance;
          var flame_intensity_tol_cal_value1 = warp_yarn_count_value - tolarance;

          document.getElementById("warp_yarn_count_min_value").value = flame_intensity_tol_cal_value1.toFixed(5);
          document.getElementById("warp_yarn_count_max_value").value = flame_intensity_tol_cal_value2.toFixed(5);
      }

      if (warp_yarn_count_tolerance_range_math_operator == "+")
      {
          

          var tolarance = ((warp_yarn_count_tolerance_value * warp_yarn_count_value) / 100);
          var flame_intensity_tol_cal_value2 = warp_yarn_count_value + tolarance;

          document.getElementById("warp_yarn_count_min_value").value = warp_yarn_count_value;
          document.getElementById("warp_yarn_count_max_value").value = flame_intensity_tol_cal_value2.toFixed(5);
      }

      if (warp_yarn_count_tolerance_range_math_operator == '-')
      {
          

          var tolarance = ((warp_yarn_count_tolerance_value * warp_yarn_count_value) / 100);
          var flame_intensity_tol_cal_value2 = warp_yarn_count_value - tolarance;

          document.getElementById("warp_yarn_count_max_value").value = warp_yarn_count_value;
          document.getElementById("warp_yarn_count_min_value").value = flame_intensity_tol_cal_value2.toFixed(5);
      }
}



function weft_yarn_count_cal()
{
      var weft_yarn_count_value = parseFloat(document.getElementById("weft_yarn_count_value").value);
      var weft_yarn_count_tolerance_value = parseFloat(document.getElementById("weft_yarn_count_tolerance_value").value);
      var weft_yarn_count_tolerance_range_math_operator = document.getElementById("weft_yarn_count_tolerance_range_math_operator").value;

      if (weft_yarn_count_tolerance_range_math_operator == '±') 
      {
          
          var tolarance = ((weft_yarn_count_tolerance_value * weft_yarn_count_value) / 100);
          var flame_intensity_tol_cal_value2 = weft_yarn_count_value + tolarance;
          var flame_intensity_tol_cal_value1 = weft_yarn_count_value - tolarance;

          document.getElementById("weft_yarn_count_min_value").value = flame_intensity_tol_cal_value1.toFixed(5);
          document.getElementById("weft_yarn_count_max_value").value = flame_intensity_tol_cal_value2.toFixed(5);
      }

      if (weft_yarn_count_tolerance_range_math_operator == "+")
      {
          

          var tolarance = ((weft_yarn_count_tolerance_value * weft_yarn_count_value) / 100);
          var flame_intensity_tol_cal_value2 = weft_yarn_count_value + tolarance;

          document.getElementById("weft_yarn_count_min_value").value = weft_yarn_count_value;
          document.getElementById("weft_yarn_count_max_value").value = flame_intensity_tol_cal_value2.toFixed(5);
      }

      if (weft_yarn_count_tolerance_range_math_operator == '-')
      {
          

          var tolarance = ((weft_yarn_count_tolerance_value * weft_yarn_count_value) / 100);
          var flame_intensity_tol_cal_value2 = weft_yarn_count_value - tolarance;

          document.getElementById("weft_yarn_count_max_value").value = weft_yarn_count_value;
          document.getElementById("weft_yarn_count_min_value").value = flame_intensity_tol_cal_value2.toFixed(5);
      }

  }


  function mass_per_unit_per_area_cal()
  {
      var mass_per_unit_per_area_value = parseFloat(document.getElementById("mass_per_unit_per_area_value").value);
      var mass_per_unit_per_area_tolerance_range_math_operator = parseFloat(document.getElementById("mass_per_unit_per_area_tolerance_range_math_operator").value);
      var mass_per_unit_per_area_tolerance_value = document.getElementById("mass_per_unit_per_area_tolerance_value").value;

     

      var positive_tolarance = ( (mass_per_unit_per_area_value * mass_per_unit_per_area_tolerance_range_math_operator) / 100 );
      var negative_tolarance = ( (mass_per_unit_per_area_value * mass_per_unit_per_area_tolerance_value) / 100 );

      var mass_per_unit_per_area_tol_cal_value2 = mass_per_unit_per_area_value + positive_tolarance;
      var mass_per_unit_per_area_tol_cal_value1 = mass_per_unit_per_area_value - negative_tolarance;

      document.getElementById("mass_per_unit_per_area_min_value").value = mass_per_unit_per_area_tol_cal_value1.toFixed(5);
      document.getElementById("mass_per_unit_per_area_max_value").value = mass_per_unit_per_area_tol_cal_value2.toFixed(5);
      

      if(isNaN(document.getElementById("mass_per_unit_per_area_tolerance_range_math_operator").value))
      {
          number_alert("mass_per_unit_per_area_tolerance_range_math_operator");
          return false;
      }

      if(isNaN(document.getElementById("mass_per_unit_per_area_tolerance_value").value))
      {
          number_alert("mass_per_unit_per_area_tolerance_value");
          return false;
      }
  }



function no_of_threads_in_warp_cal()
{
     var no_of_threads_in_warp_value = parseFloat(document.getElementById("no_of_threads_in_warp_value").value);
      var no_of_threads_in_warp_tolerance_value = parseFloat(document.getElementById("no_of_threads_in_warp_tolerance_value").value);
      var no_of_threads_in_warp_tolerance_range_math_operator = document.getElementById("no_of_threads_in_warp_tolerance_range_math_operator").value;

      if (no_of_threads_in_warp_tolerance_range_math_operator == '±') 
      {
          
          

          document.getElementById("no_of_threads_in_warp_min_value").value = no_of_threads_in_warp_value - no_of_threads_in_warp_tolerance_value;
          document.getElementById("no_of_threads_in_warp_max_value").value = no_of_threads_in_warp_value + no_of_threads_in_warp_tolerance_value;
      }

      if (no_of_threads_in_warp_tolerance_range_math_operator == "+")
      {
          


          document.getElementById("no_of_threads_in_warp_min_value").value = no_of_threads_in_warp_value;
          document.getElementById("no_of_threads_in_warp_max_value").value = no_of_threads_in_warp_value + no_of_threads_in_warp_tolerance_value;
      }

      if (no_of_threads_in_warp_tolerance_range_math_operator == '-')
      {
          

          document.getElementById("no_of_threads_in_warp_min_value").value = no_of_threads_in_warp_value;
          document.getElementById("no_of_threads_in_warp_max_value").value = no_of_threads_in_warp_value - no_of_threads_in_warp_tolerance_value;
      }

}

function no_of_threads_in_weft_cal()
{
     var no_of_threads_in_weft_value = parseFloat(document.getElementById("no_of_threads_in_weft_value").value);
      var no_of_threads_in_weft_tolerance_value = parseFloat(document.getElementById("no_of_threads_in_weft_tolerance_value").value);
      var no_of_threads_in_weft_tolerance_range_math_operator = document.getElementById("no_of_threads_in_weft_tolerance_range_math_operator").value;

      if (no_of_threads_in_weft_tolerance_range_math_operator == '±') 
      {
          
         

          document.getElementById("no_of_threads_in_weft_min_value").value = no_of_threads_in_weft_value - no_of_threads_in_weft_tolerance_value;
          document.getElementById("no_of_threads_in_weft_max_value").value = no_of_threads_in_weft_value + no_of_threads_in_weft_tolerance_value;
      }

      if (no_of_threads_in_weft_tolerance_range_math_operator == "+")
      {
          

          

          document.getElementById("no_of_threads_in_weft_min_value").value = no_of_threads_in_weft_value;
          document.getElementById("no_of_threads_in_weft_max_value").value = no_of_threads_in_weft_value + no_of_threads_in_weft_tolerance_value;
      }

      if (no_of_threads_in_weft_tolerance_range_math_operator == '-')
      {
          

          document.getElementById("no_of_threads_in_weft_min_value").value = no_of_threads_in_weft_value;
          document.getElementById("no_of_threads_in_weft_max_value").value = no_of_threads_in_weft_value - no_of_threads_in_weft_tolerance_value;
      }

}

function no_of_threads_in_warp_cal_for_finishing()
{
      var no_of_threads_in_warp_value = parseFloat(document.getElementById("no_of_threads_in_warp_value").value);
      var no_of_threads_in_warp_tolerance_value = parseFloat(document.getElementById("no_of_threads_in_warp_tolerance_value").value);
      var no_of_threads_in_warp_tolerance_range_math_operator = document.getElementById("no_of_threads_in_warp_tolerance_range_math_operator").value;

      if (no_of_threads_in_warp_tolerance_range_math_operator == '±') 
      {
          
          var tolarance = ((no_of_threads_in_warp_tolerance_value * no_of_threads_in_warp_value) / 100);
          var tol_cal_value2 = no_of_threads_in_warp_value + tolarance;
          var tol_cal_value1 = no_of_threads_in_warp_value - tolarance;

          document.getElementById("no_of_threads_in_warp_min_value").value = tol_cal_value1.toFixed(5);
          document.getElementById("no_of_threads_in_warp_max_value").value = tol_cal_value2.toFixed(5);
      }

      if (no_of_threads_in_warp_tolerance_range_math_operator == "+")
      {
          

          var tolarance = ((no_of_threads_in_warp_tolerance_value * no_of_threads_in_warp_value) / 100);
          var tol_cal_value2 = no_of_threads_in_warp_value + tolarance;

          document.getElementById("no_of_threads_in_warp_min_value").value = no_of_threads_in_warp_value;
          document.getElementById("no_of_threads_in_warp_max_value").value = tol_cal_value2.toFixed(5);
      }

      if (no_of_threads_in_warp_tolerance_range_math_operator == '-')
      {
          

          var tolarance = ((no_of_threads_in_warp_tolerance_value * no_of_threads_in_warp_value) / 100);
          var tol_cal_value2 = no_of_threads_in_warp_value - tolarance;

          document.getElementById("no_of_threads_in_warp_max_value").value = no_of_threads_in_warp_value;
          document.getElementById("no_of_threads_in_warp_min_value").value = tol_cal_value2.toFixed(5);
      }
}

function no_of_threads_in_weft_cal_for_finishing()
{
      var no_of_threads_in_weft_value = parseFloat(document.getElementById("no_of_threads_in_weft_value").value);
      var no_of_threads_in_weft_tolerance_value = parseFloat(document.getElementById("no_of_threads_in_weft_tolerance_value").value);
      var no_of_threads_in_weft_tolerance_range_math_operator = document.getElementById("no_of_threads_in_weft_tolerance_range_math_operator").value;

      if (no_of_threads_in_weft_tolerance_range_math_operator == '±') 
      {
          
          var tolarance = ((no_of_threads_in_weft_tolerance_value * no_of_threads_in_weft_value) / 100);
          var tol_cal_value2 = no_of_threads_in_weft_value + tolarance;
          var tol_cal_value1 = no_of_threads_in_weft_value - tolarance;

          document.getElementById("no_of_threads_in_weft_min_value").value = tol_cal_value1.toFixed(5);
          document.getElementById("no_of_threads_in_weft_max_value").value = tol_cal_value2.toFixed(5);
      }

      if (no_of_threads_in_weft_tolerance_range_math_operator == "+")
      {
          

          var tolarance = ((no_of_threads_in_weft_tolerance_value * no_of_threads_in_weft_value) / 100);
          var tol_cal_value2 = no_of_threads_in_weft_value + tolarance;

          document.getElementById("no_of_threads_in_weft_min_value").value = no_of_threads_in_weft_value;
          document.getElementById("no_of_threads_in_weft_max_value").value = tol_cal_value2.toFixed(5);
      }

      if (no_of_threads_in_weft_tolerance_range_math_operator == '-')
      {
          

          var tolarance = ((no_of_threads_in_weft_tolerance_value * no_of_threads_in_weft_value) / 100);
          var tol_cal_value2 = no_of_threads_in_weft_value - tolarance;

          document.getElementById("no_of_threads_in_weft_max_value").value = no_of_threads_in_weft_value;
          document.getElementById("no_of_threads_in_weft_min_value").value = tol_cal_value2.toFixed(5);
      }
}
function surface_fuzzing_and_pilling_cal()
{
 var surface_fuzzing_and_pilling_tolerance_value = document.getElementById("surface_fuzzing_and_pilling_tolerance_value").value;
    var surface_fuzzing_and_pilling_tolerance_range_math_operator = document.getElementById("surface_fuzzing_and_pilling_tolerance_range_math_operator").value;

    if (surface_fuzzing_and_pilling_tolerance_range_math_operator == '≥') 
    {
        

        document.getElementById("surface_fuzzing_and_pilling_min_value").value = parseFloat(surface_fuzzing_and_pilling_tolerance_value);
        document.getElementById("surface_fuzzing_and_pilling_max_value").value = 5;
    }

    else if (surface_fuzzing_and_pilling_tolerance_range_math_operator == '>') 
    {
        

        document.getElementById("surface_fuzzing_and_pilling_min_value").value = parseFloat(surface_fuzzing_and_pilling_tolerance_value) + 0.5;
        document.getElementById("surface_fuzzing_and_pilling_max_value").value = 5;
    }

    else if (surface_fuzzing_and_pilling_tolerance_range_math_operator == '<') 
    {
        

        document.getElementById("surface_fuzzing_and_pilling_min_value").value = 0 ;
        document.getElementById("surface_fuzzing_and_pilling_max_value").value = parseFloat(surface_fuzzing_and_pilling_tolerance_value) - 0.5;
    }

    else
    {
        

        document.getElementById("surface_fuzzing_and_pilling_min_value").value = 0;
        document.getElementById("surface_fuzzing_and_pilling_max_value").value = parseFloat(surface_fuzzing_and_pilling_tolerance_value);
    }
}

function tensile_properties_in_warp()
{
 var tensile_properties_in_warp_value_tolerance_value = document.getElementById("tensile_properties_in_warp_value_tolerance_value").value;
    var tensile_properties_in_warp_value_tolerance_range_math_operator = document.getElementById("tensile_properties_in_warp_value_tolerance_range_math_operator").value;

    if (tensile_properties_in_warp_value_tolerance_range_math_operator == '≥') 
    {
        

        document.getElementById("tensile_properties_in_warp_value_min_value").value = tensile_properties_in_warp_value_tolerance_value;
        document.getElementById("tensile_properties_in_warp_value_max_value").value = 3000;
    }
    else if (tensile_properties_in_warp_value_tolerance_range_math_operator == '>') 
    {
        

        document.getElementById("tensile_properties_in_warp_value_min_value").value = parseFloat(tensile_properties_in_warp_value_tolerance_value) + 1;
        document.getElementById("tensile_properties_in_warp_value_max_value").value = 3000;
    }
    
    else if (tensile_properties_in_warp_value_tolerance_range_math_operator == '<') 
    {
        

        document.getElementById("tensile_properties_in_warp_value_min_value").value = 0;
        document.getElementById("tensile_properties_in_warp_value_max_value").value = parseFloat(tensile_properties_in_warp_value_tolerance_value)-1;
    }


    else
    {
        

        document.getElementById("tensile_properties_in_warp_value_min_value").value = 0;
        document.getElementById("tensile_properties_in_warp_value_max_value").value = tensile_properties_in_warp_value_tolerance_value;
    }
}

function tensile_properties_in_weft()
{
    var tensile_properties_in_weft_value_tolerance_value = document.getElementById("tensile_properties_in_weft_value_tolerance_value").value;
    var tensile_properties_in_weft_value_tolerance_range_math_operator = document.getElementById("tensile_properties_in_weft_value_tolerance_range_math_operator").value;

    if (tensile_properties_in_weft_value_tolerance_range_math_operator == '≥') 
    {
        

        document.getElementById("tensile_properties_in_weft_value_min_value").value = tensile_properties_in_weft_value_tolerance_value;
        document.getElementById("tensile_properties_in_weft_value_max_value").value = 3000;
    }

    else if (tensile_properties_in_weft_value_tolerance_range_math_operator == '>') 
    {
        

        document.getElementById("tensile_properties_in_weft_value_min_value").value = parseFloat(tensile_properties_in_weft_value_tolerance_value) + 1;
        document.getElementById("tensile_properties_in_weft_value_max_value").value = 3000;
    }

    else if (tensile_properties_in_weft_value_tolerance_range_math_operator == '<') 
    {
        

        document.getElementById("tensile_properties_in_weft_value_min_value").value = 0;
        document.getElementById("tensile_properties_in_weft_value_max_value").value = parseFloat(tensile_properties_in_weft_value_tolerance_value) - 1;
    }

    else
    {
        

        document.getElementById("tensile_properties_in_weft_value_min_value").value = 0;
        document.getElementById("tensile_properties_in_weft_value_max_value").value = parseFloat(tensile_properties_in_weft_value_tolerance_value);
    }
}

function tear_force_in_warp_cal()
{
 var tear_force_in_warp_value_tolerance_value = document.getElementById("tear_force_in_warp_value_tolerance_value").value;
    var tear_force_in_warp_value_tolerance_range_math_operator = document.getElementById("tear_force_in_warp_value_tolerance_range_math_operator").value;

    if (tear_force_in_warp_value_tolerance_range_math_operator == '≥') 
    {
        

        document.getElementById("tear_force_in_warp_value_min_value").value = tear_force_in_warp_value_tolerance_value;
        document.getElementById("tear_force_in_warp_value_max_value").value = 10000;
    }

    else if (tear_force_in_warp_value_tolerance_range_math_operator == '>') 
    {
        

        document.getElementById("tear_force_in_warp_value_min_value").value = parseFloat(tear_force_in_warp_value_tolerance_value) + 1;
        document.getElementById("tear_force_in_warp_value_max_value").value = 10000;
    }

    else if (tear_force_in_warp_value_tolerance_range_math_operator == '<') 
    {
        

        document.getElementById("tear_force_in_warp_value_min_value").value = 0;
        document.getElementById("tear_force_in_warp_value_max_value").value = parseFloat(tear_force_in_warp_value_tolerance_value) - 1;
    }

    else
    {
        

        document.getElementById("tear_force_in_warp_value_min_value").value = 0;
        document.getElementById("tear_force_in_warp_value_max_value").value = parseFloat(tear_force_in_warp_value_tolerance_value);
    }
}

function tear_force_in_weft_cal()
{
 var tear_force_in_weft_value_tolerance_value = document.getElementById("tear_force_in_weft_value_tolerance_value").value;
    var tear_force_in_weft_value_tolerance_range_math_operator = document.getElementById("tear_force_in_weft_value_tolerance_range_math_operator").value;

    if (tear_force_in_weft_value_tolerance_range_math_operator == '≥') 
    {
        

        document.getElementById("tear_force_in_weft_value_min_value").value = tear_force_in_weft_value_tolerance_value;
        document.getElementById("tear_force_in_weft_value_max_value").value = 10000;
    }

    else if (tear_force_in_weft_value_tolerance_range_math_operator == '>') 
    {
        

        document.getElementById("tear_force_in_weft_value_min_value").value = parseFloat(tear_force_in_weft_value_tolerance_value) + 1;
        document.getElementById("tear_force_in_weft_value_max_value").value = 10000;
    }

    else if (tear_force_in_weft_value_tolerance_range_math_operator == '<') 
    {
        

        document.getElementById("tear_force_in_weft_value_min_value").value = 0;
        document.getElementById("tear_force_in_weft_value_max_value").value = parseFloat(tear_force_in_weft_value_tolerance_value) - 1;
    }

    else
    {
        

        document.getElementById("tear_force_in_weft_value_min_value").value = 0;
        document.getElementById("tear_force_in_weft_value_max_value").value = tear_force_in_weft_value_tolerance_value;
    }
}

function seam_strength_in_warp_cal()
{
 var seam_strength_in_warp_value_tolerance_value = document.getElementById("seam_strength_in_warp_value_tolerance_value").value;
    var seam_strength_in_warp_value_tolerance_range_math_operator = document.getElementById("seam_strength_in_warp_value_tolerance_range_math_operator").value;

    if (seam_strength_in_warp_value_tolerance_range_math_operator == '≥') 
    {
        

        document.getElementById("seam_strength_in_warp_value_min_value").value = seam_strength_in_warp_value_tolerance_value;
        document.getElementById("seam_strength_in_warp_value_max_value").value = 3000;
    }

    else if (seam_strength_in_warp_value_tolerance_range_math_operator == '>') 
    {
        

        document.getElementById("seam_strength_in_warp_value_min_value").value = parseFloat(seam_strength_in_warp_value_tolerance_value) + 1;
        document.getElementById("seam_strength_in_warp_value_max_value").value = 3000;
    }

    else if (seam_strength_in_warp_value_tolerance_range_math_operator == '<') 
    {
        

        document.getElementById("seam_strength_in_warp_value_min_value").value = 0;
        document.getElementById("seam_strength_in_warp_value_max_value").value =  parseFloat(seam_strength_in_warp_value_tolerance_value) - 1;
    }

    else
    {
        

        document.getElementById("seam_strength_in_warp_value_min_value").value = 0;
        document.getElementById("seam_strength_in_warp_value_max_value").value = seam_strength_in_warp_value_tolerance_value;
    }
}




function seam_strength_in_weft_cal()
{
 var seam_strength_in_weft_value_tolerance_value = document.getElementById("seam_strength_in_weft_value_tolerance_value").value;
    var seam_strength_in_weft_value_tolerance_range_math_operator = document.getElementById("seam_strength_in_weft_value_tolerance_range_math_operator").value;

    if (seam_strength_in_weft_value_tolerance_range_math_operator == '≥') 
    {
        

        document.getElementById("seam_strength_in_weft_value_min_value").value = seam_strength_in_weft_value_tolerance_value;
        document.getElementById("seam_strength_in_weft_value_max_value").value = 3000;
    }

    else if (seam_strength_in_weft_value_tolerance_range_math_operator == '>') 
    {
        

        document.getElementById("seam_strength_in_weft_value_min_value").value = parseFloat(seam_strength_in_weft_value_tolerance_value) + 1;
        document.getElementById("seam_strength_in_weft_value_max_value").value = 3000;
    }

    else if (seam_strength_in_weft_value_tolerance_range_math_operator == '<') 
    {
        

        document.getElementById("seam_strength_in_weft_value_min_value").value = 0;
        document.getElementById("seam_strength_in_weft_value_max_value").value = parseFloat(seam_strength_in_weft_value_tolerance_value) - 1;
    }

    else
    {
        

        document.getElementById("seam_strength_in_weft_value_min_value").value = 0;
        document.getElementById("seam_strength_in_weft_value_max_value").value = seam_strength_in_weft_value_tolerance_value;
    }
}


function seam_properties_seam_strength_iso_astm_d_in_warp_cal()
{
 var seam_properties_seam_strength_iso_astm_d_in_warp_tolerance_value = document.getElementById("seam_properties_seam_strength_iso_astm_d_in_warp_tolerance_value").value;
    var seam_properties_seam_strength_iso_astm_d_in_warp_tol_range_op = document.getElementById("seam_properties_seam_strength_iso_astm_d_in_warp_tol_range_op").value;

    if (seam_properties_seam_strength_iso_astm_d_in_warp_tol_range_op == '≥') 
    {
        

        document.getElementById("seam_properties_seam_strength_iso_astm_d_in_warp_min_value").value = seam_properties_seam_strength_iso_astm_d_in_warp_tolerance_value;
        document.getElementById("seam_properties_seam_strength_iso_astm_d_in_warp_max_value").value = 3000;
    }

    else if (seam_properties_seam_strength_iso_astm_d_in_warp_tol_range_op == '>') 
    {
        

        document.getElementById("seam_properties_seam_strength_iso_astm_d_in_warp_min_value").value = parseFloat(seam_properties_seam_strength_iso_astm_d_in_warp_tolerance_value) + 1;
        document.getElementById("seam_properties_seam_strength_iso_astm_d_in_warp_max_value").value = 3000;
    }

    else if (seam_properties_seam_strength_iso_astm_d_in_warp_tol_range_op == '<') 
    {
        

        document.getElementById("seam_properties_seam_strength_iso_astm_d_in_warp_min_value").value = 0;
        document.getElementById("seam_properties_seam_strength_iso_astm_d_in_warp_max_value").value =  parseFloat(seam_properties_seam_strength_iso_astm_d_in_warp_tolerance_value) - 1;
    }

    else
    {
        

        document.getElementById("seam_properties_seam_strength_iso_astm_d_in_warp_min_value").value = 0;
        document.getElementById("seam_properties_seam_strength_iso_astm_d_in_warp_max_value").value = seam_properties_seam_strength_iso_astm_d_in_warp_tolerance_value;
    }
}

function seam_properties_seam_strength_iso_astm_d_in_weft_cal()
{
 var seam_properties_seam_strength_iso_astm_d_in_weft_tolerance_value = document.getElementById("seam_properties_seam_strength_iso_astm_d_in_weft_tolerance_value").value;
    var seam_properties_seam_strength_iso_astm_d_in_weft_tol_range_op = document.getElementById("seam_properties_seam_strength_iso_astm_d_in_weft_tol_range_op").value;

    if (seam_properties_seam_strength_iso_astm_d_in_weft_tol_range_op == '≥') 
    {
        

        document.getElementById("seam_properties_seam_strength_iso_astm_d_in_weft_min_value").value = seam_properties_seam_strength_iso_astm_d_in_weft_tolerance_value;
        document.getElementById("seam_properties_seam_strength_iso_astm_d_in_weft_max_value").value = 3000;
    }

    else if (seam_properties_seam_strength_iso_astm_d_in_weft_tol_range_op == '>') 
    {
        

        document.getElementById("seam_properties_seam_strength_iso_astm_d_in_weft_min_value").value = parseFloat(seam_properties_seam_strength_iso_astm_d_in_weft_tolerance_value) + 1;
        document.getElementById("seam_properties_seam_strength_iso_astm_d_in_weft_max_value").value = 3000;
    }

    else if (seam_properties_seam_strength_iso_astm_d_in_weft_tol_range_op == '<') 
    {
        

        document.getElementById("seam_properties_seam_strength_iso_astm_d_in_weft_min_value").value = 0;
        document.getElementById("seam_properties_seam_strength_iso_astm_d_in_weft_max_value").value =  parseFloat(seam_properties_seam_strength_iso_astm_d_in_weft_tolerance_value) - 1;
    }

    else
    {
        

        document.getElementById("seam_properties_seam_strength_iso_astm_d_in_weft_min_value").value = 0;
        document.getElementById("seam_properties_seam_strength_iso_astm_d_in_weft_max_value").value = seam_properties_seam_strength_iso_astm_d_in_weft_tolerance_value;
    }
}

function abrasion_resistance_c_change_cal()
{
 var abrasion_resistance_c_change_value_tolerance_value = document.getElementById("abrasion_resistance_c_change_value_tolerance_value").value;
    var abrasion_resistance_c_change_value_math_op = document.getElementById("abrasion_resistance_c_change_value_math_op").value;

    if (abrasion_resistance_c_change_value_math_op == '≥') 
    {
        

        document.getElementById("abrasion_resistance_c_change_value_min_value").value = abrasion_resistance_c_change_value_tolerance_value;
        document.getElementById("abrasion_resistance_c_change_value_max_value").value = 5;
    }

    else if (abrasion_resistance_c_change_value_math_op == '≥') 
    {
        

        document.getElementById("abrasion_resistance_c_change_value_min_value").value = abrasion_resistance_c_change_value_tolerance_value;
        document.getElementById("abrasion_resistance_c_change_value_max_value").value = 5;
    }

    else if (abrasion_resistance_c_change_value_math_op == '≥') 
    {
        

        document.getElementById("abrasion_resistance_c_change_value_min_value").value = abrasion_resistance_c_change_value_tolerance_value;
        document.getElementById("abrasion_resistance_c_change_value_max_value").value = 5;
    }

    else
    {
        

        document.getElementById("abrasion_resistance_c_change_value_min_value").value = 0;
        document.getElementById("abrasion_resistance_c_change_value_max_value").value = abrasion_resistance_c_change_value_tolerance_value;
    }
}

function mass_loss_in_abrasion_cal()
{
 var mass_loss_in_abrasion_test_value_tolerance_value = document.getElementById("mass_loss_in_abrasion_test_value_tolerance_value").value;
    var mass_loss_in_abrasion_test_value_tolerance_range_math_operator = document.getElementById("mass_loss_in_abrasion_test_value_tolerance_range_math_operator").value;

    if (mass_loss_in_abrasion_test_value_tolerance_range_math_operator == '≥') 
    {
        

        document.getElementById("mass_loss_in_abrasion_test_value_min_value").value = mass_loss_in_abrasion_test_value_tolerance_value;
        document.getElementById("mass_loss_in_abrasion_test_value_max_value").value = 5;
    }

    else if (mass_loss_in_abrasion_test_value_tolerance_range_math_operator == '>') 
    {
        

        document.getElementById("mass_loss_in_abrasion_test_value_min_value").value = parseFloat(mass_loss_in_abrasion_test_value_tolerance_value) + 0.5;
        document.getElementById("mass_loss_in_abrasion_test_value_max_value").value = 5;
    }

    else if (mass_loss_in_abrasion_test_value_tolerance_range_math_operator == '<') 
    {
        

        document.getElementById("mass_loss_in_abrasion_test_value_min_value").value = 0;
        document.getElementById("mass_loss_in_abrasion_test_value_max_value").value = parseFloat(mass_loss_in_abrasion_test_value_tolerance_value) - 0.5;
    }

    else
    {
        

        document.getElementById("mass_loss_in_abrasion_test_value_min_value").value = 0;
        document.getElementById("mass_loss_in_abrasion_test_value_max_value").value = mass_loss_in_abrasion_test_value_tolerance_value;
    }
}


function formaldehyde_content_Cal()
{
 var formaldehyde_content_tolerance_value = document.getElementById("formaldehyde_content_tolerance_value").value;
    var formaldehyde_content_tolerance_range_math_operator = document.getElementById("formaldehyde_content_tolerance_range_math_operator").value;

    if (formaldehyde_content_tolerance_range_math_operator == '≥') 
    {
        

        document.getElementById("formaldehyde_content_min_value").value = formaldehyde_content_tolerance_value;
        document.getElementById("formaldehyde_content_max_value").value = 5;
    }
    else if (formaldehyde_content_tolerance_range_math_operator == '>') 
    {
        

        document.getElementById("formaldehyde_content_min_value").value = parseFloat(formaldehyde_content_tolerance_value) + 0.5;
        document.getElementById("formaldehyde_content_max_value").value = 5;
    }
    else if (formaldehyde_content_tolerance_range_math_operator == '<') 
    {
        

        document.getElementById("formaldehyde_content_min_value").value = 0;
        document.getElementById("formaldehyde_content_max_value").value = parseFloat(formaldehyde_content_tolerance_value) - 0.5;
    }

    else
    {
        

        document.getElementById("formaldehyde_content_min_value").value = 0;
        document.getElementById("formaldehyde_content_max_value").value = formaldehyde_content_tolerance_value;
    }
}

function wicking_test_cal()
{
 var wicking_test_tolerance_value = document.getElementById("wicking_test_tolerance_value").value;
    var wicking_test_tol_range_math_op = document.getElementById("wicking_test_tol_range_math_op").value;

    if (wicking_test_tol_range_math_op == '≥') 
    {
        

        document.getElementById("wicking_test_min_value").value = wicking_test_tolerance_value;
        document.getElementById("wicking_test_max_value").value = 5;
    }
    else if (wicking_test_tol_range_math_op == '>') 
    {
        

        document.getElementById("wicking_test_min_value").value = parseFloat(wicking_test_tolerance_value) + 0.5 ;
        document.getElementById("wicking_test_max_value").value = 5;
    }
    else if (wicking_test_tol_range_math_op == '<') 
    {
        

        document.getElementById("wicking_test_min_value").value = 0;
        document.getElementById("wicking_test_max_value").value =  parseFloat(wicking_test_tolerance_value) + 0.5 ;
    }

    else
    {
        

        document.getElementById("wicking_test_min_value").value = 0;
        document.getElementById("wicking_test_max_value").value = wicking_test_tolerance_value;
    }
}

function cf_to_dry_cleaning_color_change_cal()
{
 var cf_to_dry_cleaning_color_change_tolerance_value = document.getElementById("cf_to_dry_cleaning_color_change_tolerance_value").value;
    var cf_to_dry_cleaning_color_change_tolerance_range_math_operator = document.getElementById("cf_to_dry_cleaning_color_change_tolerance_range_math_operator").value;

    if (cf_to_dry_cleaning_color_change_tolerance_range_math_operator == '≥') 
    {
        

        document.getElementById("cf_to_dry_cleaning_color_change_min_value").value = cf_to_dry_cleaning_color_change_tolerance_value;
        document.getElementById("cf_to_dry_cleaning_color_change_max_value").value = 5;
    }

    else  if (cf_to_dry_cleaning_color_change_tolerance_range_math_operator == '>') 
    {
        

        document.getElementById("cf_to_dry_cleaning_color_change_min_value").value = parseFloat(cf_to_dry_cleaning_color_change_tolerance_value) + 0.5;
        document.getElementById("cf_to_dry_cleaning_color_change_max_value").value = 5;
    }

    else  if (cf_to_dry_cleaning_color_change_tolerance_range_math_operator == '<') 
    {
        

        document.getElementById("cf_to_dry_cleaning_color_change_min_value").value = 0;
        document.getElementById("cf_to_dry_cleaning_color_change_max_value").value = parseFloat(cf_to_dry_cleaning_color_change_tolerance_value) - 0.5;
    }

    else
    {
        

        document.getElementById("cf_to_dry_cleaning_color_change_min_value").value = 0;
        document.getElementById("cf_to_dry_cleaning_color_change_max_value").value = cf_to_dry_cleaning_color_change_tolerance_value;
    }
}


function cf_to_dry_cleaning_staining_cal()
{
 var cf_to_dry_cleaning_staining_tolerance_value = document.getElementById("cf_to_dry_cleaning_staining_tolerance_value").value;
    var cf_to_dry_cleaning_staining_tolerance_range_math_operator = document.getElementById("cf_to_dry_cleaning_staining_tolerance_range_math_operator").value;

    if (cf_to_dry_cleaning_staining_tolerance_range_math_operator == '≥') 
    {
        

        document.getElementById("cf_to_dry_cleaning_staining_min_value").value = cf_to_dry_cleaning_staining_tolerance_value;
        document.getElementById("cf_to_dry_cleaning_staining_max_value").value = 5;
    }

    else if (cf_to_dry_cleaning_staining_tolerance_range_math_operator == '>') 
    {
        

        document.getElementById("cf_to_dry_cleaning_staining_min_value").value = parseFloat(cf_to_dry_cleaning_staining_tolerance_value) + 0.5;
        document.getElementById("cf_to_dry_cleaning_staining_max_value").value = 5;
    }

    else if (cf_to_dry_cleaning_staining_tolerance_range_math_operator == '<') 
    {
        

        document.getElementById("cf_to_dry_cleaning_staining_min_value").value = 0;
        document.getElementById("cf_to_dry_cleaning_staining_max_value").value = parseFloat(cf_to_dry_cleaning_staining_tolerance_value) - 0.5;
    }


    else
    {
        

        document.getElementById("cf_to_dry_cleaning_staining_min_value").value = 0;
        document.getElementById("cf_to_dry_cleaning_staining_max_value").value = cf_to_dry_cleaning_staining_tolerance_value;
    }
}

function cf_to_washing_color_change_cal()
{
    var cf_to_washing_color_change_tolerance_value = document.getElementById("cf_to_washing_color_change_tolerance_value").value;
    var cf_to_washing_color_change_tolerance_range_math_operator = document.getElementById("cf_to_washing_color_change_tolerance_range_math_operator").value;

    if (cf_to_washing_color_change_tolerance_range_math_operator == '≥') 
    {
        

        document.getElementById("cf_to_washing_color_change_min_value").value = cf_to_washing_color_change_tolerance_value;
        document.getElementById("cf_to_washing_color_change_max_value").value = 5;
    }

    else if (cf_to_washing_color_change_tolerance_range_math_operator == '>') 
    {
        

        document.getElementById("cf_to_washing_color_change_min_value").value = parseFloat(cf_to_washing_color_change_tolerance_value) + 0.5;
        document.getElementById("cf_to_washing_color_change_max_value").value = 5;
    }

    else if (cf_to_washing_color_change_tolerance_range_math_operator == '<') 
    {
        

        document.getElementById("cf_to_washing_color_change_min_value").value = 0;
        document.getElementById("cf_to_washing_color_change_max_value").value = parseFloat(cf_to_washing_color_change_tolerance_value) - 0.5;
    }

    else
    {
        
        document.getElementById("cf_to_washing_color_change_min_value").value = 0;
        document.getElementById("cf_to_washing_color_change_max_value").value = cf_to_washing_color_change_tolerance_value;
    }
}


function cf_to_washing_staining_cal()
{
 var cf_to_washing_staining_tolerance_value = document.getElementById("cf_to_washing_staining_tolerance_value").value;
    var cf_to_washing_staining_tolerance_range_math_operator = document.getElementById("cf_to_washing_staining_tolerance_range_math_operator").value;

    if (cf_to_washing_staining_tolerance_range_math_operator == '≥') 
    {
        

        document.getElementById("cf_to_washing_staining_min_value").value = cf_to_washing_staining_tolerance_value;
        document.getElementById("cf_to_washing_staining_max_value").value = 5;
    }

    else if (cf_to_washing_staining_tolerance_range_math_operator == '>') 
    {
        

        document.getElementById("cf_to_washing_staining_min_value").value = parseFloat(cf_to_washing_staining_tolerance_value)+0.5;
        document.getElementById("cf_to_washing_staining_max_value").value = 5;
    }

    else if (cf_to_washing_staining_tolerance_range_math_operator == '<') 
    {
        

        document.getElementById("cf_to_washing_staining_min_value").value = 0;
        document.getElementById("cf_to_washing_staining_max_value").value = parseFloat(cf_to_washing_staining_tolerance_value) - 0.5;
    }

    else
    {
        

        document.getElementById("cf_to_washing_staining_min_value").value = 0;
        document.getElementById("cf_to_washing_staining_max_value").value = cf_to_washing_staining_tolerance_value;
    }
}



function cf_to_washing_cross_staining_cal()
{
 var cf_to_washing_cross_staining_tolerance_value = document.getElementById("cf_to_washing_cross_staining_tolerance_value").value;
    var cf_to_washing_cross_staining_tolerance_range_math_operator = document.getElementById("cf_to_washing_cross_staining_tolerance_range_math_operator").value;

    if (cf_to_washing_cross_staining_tolerance_range_math_operator == '≥') 
    {
        

        document.getElementById("cf_to_washing_cross_staining_min_value").value = cf_to_washing_cross_staining_tolerance_value;
        document.getElementById("cf_to_washing_cross_staining_max_value").value = 5;
    }

    else if (cf_to_washing_cross_staining_tolerance_range_math_operator == '>') 
    {
        

        document.getElementById("cf_to_washing_cross_staining_min_value").value = parseFloat(cf_to_washing_cross_staining_tolerance_value) + 0.5;
        document.getElementById("cf_to_washing_cross_staining_max_value").value = 5;
    }

    else if (cf_to_washing_cross_staining_tolerance_range_math_operator == '<') 
    {
        

        document.getElementById("cf_to_washing_cross_staining_min_value").value = 0;
        document.getElementById("cf_to_washing_cross_staining_max_value").value = parseFloat(cf_to_washing_cross_staining_tolerance_value) - 0.5;
    }


    else
    {
        

        document.getElementById("cf_to_washing_cross_staining_min_value").value = 0;
        document.getElementById("cf_to_washing_cross_staining_max_value").value = cf_to_washing_cross_staining_tolerance_value;
    }
}


function water_absorption_b_wash_thirty_sec_cal()
{
 var water_absorption_b_wash_thirty_sec_tolerance_value = document.getElementById("water_absorption_b_wash_thirty_sec_tolerance_value").value;
    var water_absorption_b_wash_thirty_sec_tolerance_range_math_op = document.getElementById("water_absorption_b_wash_thirty_sec_tolerance_range_math_op").value;

    if (water_absorption_b_wash_thirty_sec_tolerance_range_math_op == '≥') 
    {
        

        document.getElementById("water_absorption_b_wash_thirty_sec_min_value").value = water_absorption_b_wash_thirty_sec_tolerance_value;
        document.getElementById("water_absorption_b_wash_thirty_sec_max_value").value = 500;
    }

    else if (water_absorption_b_wash_thirty_sec_tolerance_range_math_op == '>') 
    {
        

        document.getElementById("water_absorption_b_wash_thirty_sec_min_value").value = parseFloat(water_absorption_b_wash_thirty_sec_tolerance_value) + 1;
        document.getElementById("water_absorption_b_wash_thirty_sec_max_value").value = 500;
    }

    else if (water_absorption_b_wash_thirty_sec_tolerance_range_math_op == '<') 
    {
        

        document.getElementById("water_absorption_b_wash_thirty_sec_min_value").value = 0;
        document.getElementById("water_absorption_b_wash_thirty_sec_max_value").value = parseFloat(water_absorption_b_wash_thirty_sec_tolerance_value) - 1;
    }


    else
    {
        

        document.getElementById("water_absorption_b_wash_thirty_sec_min_value").value = 0;
        document.getElementById("water_absorption_b_wash_thirty_sec_max_value").value = water_absorption_b_wash_thirty_sec_tolerance_value;
    }
}

function water_absorption_b_wash_max_cal()
{
 var water_absorption_b_wash_max_tolerance_value = document.getElementById("water_absorption_b_wash_max_tolerance_value").value;
    var water_absorption_b_wash_max_tolerance_range_math_op = document.getElementById("water_absorption_b_wash_max_tolerance_range_math_op").value;

    if (water_absorption_b_wash_max_tolerance_range_math_op == '≥') 
    {
        

        document.getElementById("water_absorption_b_wash_max_min_value").value = water_absorption_b_wash_max_tolerance_value;
        document.getElementById("water_absorption_b_wash_max_max_value").value = 500;
    }

    else if (water_absorption_b_wash_max_tolerance_range_math_op == '>') 
    {
        

        document.getElementById("water_absorption_b_wash_max_min_value").value = parseFloat(water_absorption_b_wash_max_tolerance_value) + 1;
        document.getElementById("water_absorption_b_wash_max_max_value").value = 500;
    }

    else if (water_absorption_b_wash_max_tolerance_range_math_op == '<') 
    {
        

        document.getElementById("water_absorption_b_wash_max_min_value").value = 0;
        document.getElementById("water_absorption_b_wash_max_max_value").value = parseFloat(water_absorption_b_wash_max_tolerance_value) - 1;
    }


    else
    {
        

        document.getElementById("water_absorption_b_wash_max_min_value").value = 0;
        document.getElementById("water_absorption_b_wash_max_max_value").value = water_absorption_b_wash_max_tolerance_value;
    }
}


function water_absorption_a_wash_thirty_sec_cal()
{
 var water_absorption_a_wash_thirty_sec_tolerance_value = document.getElementById("water_absorption_a_wash_thirty_sec_tolerance_value").value;
    var water_absorption_a_wash_thirty_sec_tolerance_range_math_op = document.getElementById("water_absorption_a_wash_thirty_sec_tolerance_range_math_op").value;

    if (water_absorption_a_wash_thirty_sec_tolerance_range_math_op == '≥') 
    {
        

        document.getElementById("water_absorption_a_wash_thirty_sec_min_value").value = water_absorption_a_wash_thirty_sec_tolerance_value;
        document.getElementById("water_absorption_a_wash_thirty_sec_max_value").value = 500;
    }

    else if (water_absorption_a_wash_thirty_sec_tolerance_range_math_op == '>') 
    {
        

        document.getElementById("water_absorption_a_wash_thirty_sec_min_value").value = parseFloat(water_absorption_a_wash_thirty_sec_tolerance_value) + 1;
        document.getElementById("water_absorption_a_wash_thirty_sec_max_value").value = 500;
    }

    else if (water_absorption_a_wash_thirty_sec_tolerance_range_math_op == '<') 
    {
        

        document.getElementById("water_absorption_a_wash_thirty_sec_min_value").value = 0;
        document.getElementById("water_absorption_a_wash_thirty_sec_max_value").value = parseFloat(water_absorption_a_wash_thirty_sec_tolerance_value) - 1;
    }


    else
    {
        

        document.getElementById("water_absorption_a_wash_thirty_sec_min_value").value = 0;
        document.getElementById("water_absorption_a_wash_thirty_sec_max_value").value = water_absorption_a_wash_thirty_sec_tolerance_value;
    }
}



function cf_to_perspiration_acid_color_change_cal()
{
 var cf_to_perspiration_acid_color_change_tolerance_value = document.getElementById("cf_to_perspiration_acid_color_change_tolerance_value").value;
var cf_to_perspiration_acid_color_change_tolerance_range_math_op = document.getElementById("cf_to_perspiration_acid_color_change_tolerance_range_math_op").value;

    if (cf_to_perspiration_acid_color_change_tolerance_range_math_op == '≥') 
    {
        

        document.getElementById("cf_to_perspiration_acid_color_change_min_value").value = cf_to_perspiration_acid_color_change_tolerance_value;
        document.getElementById("cf_to_perspiration_acid_color_change_max_value").value = 5;
    }

    else if (cf_to_perspiration_acid_color_change_tolerance_range_math_op == '>') 
    {
        

        document.getElementById("cf_to_perspiration_acid_color_change_min_value").value = parseFloat(cf_to_perspiration_acid_color_change_tolerance_value) + 0.5;
        document.getElementById("cf_to_perspiration_acid_color_change_max_value").value = 5;
    }
    else  if (cf_to_perspiration_acid_color_change_tolerance_range_math_op == '<') 
    {
        

        document.getElementById("cf_to_perspiration_acid_color_change_min_value").value = 0;
        document.getElementById("cf_to_perspiration_acid_color_change_max_value").value = parseFloat(cf_to_perspiration_acid_color_change_tolerance_value) - 0.5;
    }

    else
    {
        

        document.getElementById("cf_to_perspiration_acid_color_change_min_value").value = 0;
        document.getElementById("cf_to_perspiration_acid_color_change_max_value").value = cf_to_perspiration_acid_color_change_tolerance_value;
    }
}

function cf_to_perspiration_acid_staining_cal()
{
 var cf_to_perspiration_acid_staining_value = document.getElementById("cf_to_perspiration_acid_staining_value").value;
    var cf_to_perspiration_acid_staining_tolerance_range_math_operator = document.getElementById("cf_to_perspiration_acid_staining_tolerance_range_math_operator").value;

    if (cf_to_perspiration_acid_staining_tolerance_range_math_operator == '≥') 
    {
        

        document.getElementById("cf_to_perspiration_acid_staining_min_value").value = cf_to_perspiration_acid_staining_value;
        document.getElementById("cf_to_perspiration_acid_staining_max_value").value = 5;
    }

    else if (cf_to_perspiration_acid_staining_tolerance_range_math_operator == '>') 
    {
        

        document.getElementById("cf_to_perspiration_acid_staining_min_value").value = parseFloat(cf_to_perspiration_acid_staining_value) + 0.5;
        document.getElementById("cf_to_perspiration_acid_staining_max_value").value = 5;
    }

    else  if (cf_to_perspiration_acid_staining_tolerance_range_math_operator == '<') 
    {
        

        document.getElementById("cf_to_perspiration_acid_staining_min_value").value = 0;
        document.getElementById("cf_to_perspiration_acid_staining_max_value").value = parseFloat(cf_to_perspiration_acid_staining_value) - 0.5;
    }

    else
    {
        

        document.getElementById("cf_to_perspiration_acid_staining_min_value").value = 0;
        document.getElementById("cf_to_perspiration_acid_staining_max_value").value = cf_to_perspiration_acid_staining_value;
    }
}


function cf_to_perspiration_acid_cross_staining_cal()
{
 var cf_to_perspiration_acid_cross_staining_tolerance_value = document.getElementById("cf_to_perspiration_acid_cross_staining_tolerance_value").value;
    var cf_to_perspiration_acid_cross_staining_tolerance_range_math_op = document.getElementById("cf_to_perspiration_acid_cross_staining_tolerance_range_math_op").value;

    if (cf_to_perspiration_acid_cross_staining_tolerance_range_math_op == '≥') 
    {
        

        document.getElementById("cf_to_perspiration_acid_cross_staining_min_value").value = cf_to_perspiration_acid_cross_staining_tolerance_value;
        document.getElementById("cf_to_perspiration_acid_cross_staining_max_value").value = 5;
    }

    else if (cf_to_perspiration_acid_cross_staining_tolerance_range_math_op == '>') 
    {
        

        document.getElementById("cf_to_perspiration_acid_cross_staining_min_value").value = parseFloat(cf_to_perspiration_acid_cross_staining_tolerance_value) + 0.5;
        document.getElementById("cf_to_perspiration_acid_cross_staining_max_value").value = 5;
    }

    else if (cf_to_perspiration_acid_cross_staining_tolerance_range_math_op == '<') 
    {
        

        document.getElementById("cf_to_perspiration_acid_cross_staining_min_value").value = 0;
        document.getElementById("cf_to_perspiration_acid_cross_staining_max_value").value = parseFloat(cf_to_perspiration_acid_cross_staining_tolerance_value) - 0.5;
    }

    else
    {
        

        document.getElementById("cf_to_perspiration_acid_cross_staining_min_value").value = 0;
        document.getElementById("cf_to_perspiration_acid_cross_staining_max_value").value = cf_to_perspiration_acid_cross_staining_tolerance_value;
    }
}


function cf_to_perspiration_alkali_color_change_cal()
{
 var cf_to_perspiration_alkali_color_change_tolerance_value = document.getElementById("cf_to_perspiration_alkali_color_change_tolerance_value").value;
    var cf_to_perspiration_alkali_color_change_tolerance_range_math_op = document.getElementById("cf_to_perspiration_alkali_color_change_tolerance_range_math_op").value;

    if (cf_to_perspiration_alkali_color_change_tolerance_range_math_op == '≥') 
    {
        

        document.getElementById("cf_to_perspiration_alkali_color_change_min_value").value = cf_to_perspiration_alkali_color_change_tolerance_value;
        document.getElementById("cf_to_perspiration_alkali_color_change_max_value").value = 5;
    }

    else if (cf_to_perspiration_alkali_color_change_tolerance_range_math_op == '>') 
    {
        

        document.getElementById("cf_to_perspiration_alkali_color_change_min_value").value = parseFloat(cf_to_perspiration_alkali_color_change_tolerance_value) + 0.5;
        document.getElementById("cf_to_perspiration_alkali_color_change_max_value").value = 5;
    }

    else if (cf_to_perspiration_alkali_color_change_tolerance_range_math_op == '<') 
    {
        

        document.getElementById("cf_to_perspiration_alkali_color_change_min_value").value = 0;
        document.getElementById("cf_to_perspiration_alkali_color_change_max_value").value = parseFloat(cf_to_perspiration_alkali_color_change_tolerance_value) - 0.5;
    }

    else
    {
        

        document.getElementById("cf_to_perspiration_alkali_color_change_min_value").value = 0;
        document.getElementById("cf_to_perspiration_alkali_color_change_max_value").value = cf_to_perspiration_alkali_color_change_tolerance_value;
    }
}


function cf_to_perspiration_alkali_staining_cal()
{
 var cf_to_perspiration_alkali_staining_tolerance_value = document.getElementById("cf_to_perspiration_alkali_staining_tolerance_value").value;
    var cf_to_perspiration_alkali_staining_tolerance_range_math_op = document.getElementById("cf_to_perspiration_alkali_staining_tolerance_range_math_op").value;

    if (cf_to_perspiration_alkali_staining_tolerance_range_math_op == '≥') 
    {
        

        document.getElementById("cf_to_perspiration_alkali_staining_min_value").value = cf_to_perspiration_alkali_staining_tolerance_value;
        document.getElementById("cf_to_perspiration_alkali_staining_max_value").value = 5;
    }

    else if (cf_to_perspiration_alkali_staining_tolerance_range_math_op == '>') 
    {
        

        document.getElementById("cf_to_perspiration_alkali_staining_min_value").value = parseFloat(cf_to_perspiration_alkali_staining_tolerance_value) + 0.5;
        document.getElementById("cf_to_perspiration_alkali_staining_max_value").value = 5;
    }
    else if (cf_to_perspiration_alkali_staining_tolerance_range_math_op == '<') 
    {
        

        document.getElementById("cf_to_perspiration_alkali_staining_min_value").value = 0;
        document.getElementById("cf_to_perspiration_alkali_staining_max_value").value =  parseFloat(cf_to_perspiration_alkali_staining_tolerance_value) - 0.5;
    }

    else
    {
        

        document.getElementById("cf_to_perspiration_alkali_staining_min_value").value = 0;
        document.getElementById("cf_to_perspiration_alkali_staining_max_value").value = cf_to_perspiration_alkali_staining_tolerance_value;
    }
}

function cf_to_perspiration_alkali_cross_staining_cal()
{
 var cf_to_perspiration_alkali_cross_staining_tolerance_value = document.getElementById("cf_to_perspiration_alkali_cross_staining_tolerance_value").value;
    var cf_to_perspiration_alkali_cross_staining_tolerance_range_math_op = document.getElementById("cf_to_perspiration_alkali_cross_staining_tolerance_range_math_op").value;

    if (cf_to_perspiration_alkali_cross_staining_tolerance_range_math_op == '≥') 
    {
        

        document.getElementById("cf_to_perspiration_alkali_cross_staining_min_value").value = cf_to_perspiration_alkali_cross_staining_tolerance_value;
        document.getElementById("cf_to_perspiration_alkali_cross_staining_max_value").value = 5;
    }

    else if (cf_to_perspiration_alkali_cross_staining_tolerance_range_math_op == '>') 
    {
        

        document.getElementById("cf_to_perspiration_alkali_cross_staining_min_value").value = parseFloat(cf_to_perspiration_alkali_cross_staining_tolerance_value) + 0.5;
        document.getElementById("cf_to_perspiration_alkali_cross_staining_max_value").value = 5;
    }

    else if (cf_to_perspiration_alkali_cross_staining_tolerance_range_math_op == '<') 
    {
        

        document.getElementById("cf_to_perspiration_alkali_cross_staining_min_value").value = 0;
        document.getElementById("cf_to_perspiration_alkali_cross_staining_max_value").value =  parseFloat(cf_to_perspiration_alkali_cross_staining_tolerance_value) - 0.5;
    }

    else
    {
        

        document.getElementById("cf_to_perspiration_alkali_cross_staining_min_value").value = 0;
        document.getElementById("cf_to_perspiration_alkali_cross_staining_max_value").value = cf_to_perspiration_alkali_cross_staining_tolerance_value;
    }
}

function cf_to_water_color_change_cal()
{
 var cf_to_water_color_change_tolerance_value = document.getElementById("cf_to_water_color_change_tolerance_value").value;
    var cf_to_water_color_change_tolerance_range_math_operator = document.getElementById("cf_to_water_color_change_tolerance_range_math_operator").value;

    if (cf_to_water_color_change_tolerance_range_math_operator == '≥') 
    {
        

        document.getElementById("cf_to_water_color_change_min_value").value = cf_to_water_color_change_tolerance_value;
        document.getElementById("cf_to_water_color_change_max_value").value = 5;
    }

    else if (cf_to_water_color_change_tolerance_range_math_operator == '>') 
    {
        

        document.getElementById("cf_to_water_color_change_min_value").value = parseFloat(cf_to_water_color_change_tolerance_value) +0.5;
        document.getElementById("cf_to_water_color_change_max_value").value = 5;
    }
    else if (cf_to_water_color_change_tolerance_range_math_operator == '<') 
    {
        

        document.getElementById("cf_to_water_color_change_min_value").value = 0;
        document.getElementById("cf_to_water_color_change_max_value").value = parseFloat(cf_to_water_color_change_tolerance_value) - 0.5;
    }


    else
    {
        

        document.getElementById("cf_to_water_color_change_min_value").value = 0;
        document.getElementById("cf_to_water_color_change_max_value").value = cf_to_water_color_change_tolerance_value;
    }
}

function cf_to_water_staining_cal()
{
 var cf_to_water_staining_tolerance_value = document.getElementById("cf_to_water_staining_tolerance_value").value;
    var cf_to_water_staining_tolerance_range_math_operator = document.getElementById("cf_to_water_staining_tolerance_range_math_operator").value;

    if (cf_to_water_staining_tolerance_range_math_operator == '≥') 
    {
        

        document.getElementById("cf_to_water_staining_min_value").value = cf_to_water_staining_tolerance_value;
        document.getElementById("cf_to_water_staining_max_value").value = 5;
    }

    else if (cf_to_water_staining_tolerance_range_math_operator == '>') 
    {
        

        document.getElementById("cf_to_water_staining_min_value").value = parseFloat(cf_to_water_staining_tolerance_value) + 0.5;
        document.getElementById("cf_to_water_staining_max_value").value = 5;
    }
    else if (cf_to_water_staining_tolerance_range_math_operator == '<') 
    {
        

        document.getElementById("cf_to_water_staining_min_value").value = 0;
        document.getElementById("cf_to_water_staining_max_value").value = parseFloat(cf_to_water_staining_tolerance_value) - 0.5;
    }

    else
    {
        

        document.getElementById("cf_to_water_staining_min_value").value = 0;
        document.getElementById("cf_to_water_staining_max_value").value = cf_to_water_staining_tolerance_value;
    }
}

function cf_to_water_cross_staining_cal()
{
 var cf_to_water_cross_staining_tolerance_value = document.getElementById("cf_to_water_cross_staining_tolerance_value").value;
    var cf_to_water_cross_staining_tolerance_range_math_operator = document.getElementById("cf_to_water_cross_staining_tolerance_range_math_operator").value;

    if (cf_to_water_cross_staining_tolerance_range_math_operator == '≥') 
    {
        

        document.getElementById("cf_to_water_cross_staining_min_value").value = cf_to_water_cross_staining_tolerance_value;
        document.getElementById("cf_to_water_cross_staining_max_value").value = 5;
    }

    else if (cf_to_water_cross_staining_tolerance_range_math_operator == '>') 
    {
        

        document.getElementById("cf_to_water_cross_staining_min_value").value = parseFloat(cf_to_water_cross_staining_tolerance_value) + 0.5;
        document.getElementById("cf_to_water_cross_staining_max_value").value = 5;
    }

   else if (cf_to_water_cross_staining_tolerance_range_math_operator == '<') 
    {
        

        document.getElementById("cf_to_water_cross_staining_min_value").value = 0;
        document.getElementById("cf_to_water_cross_staining_max_value").value = parseFloat(cf_to_water_cross_staining_tolerance_value) - 0.5;
    }

    else
    {
        

        document.getElementById("cf_to_water_cross_staining_min_value").value = 0;
        document.getElementById("cf_to_water_cross_staining_max_value").value = cf_to_water_cross_staining_tolerance_value;
    }
}


function cf_to_water_cross_staining_cal()
{
 var cf_to_water_cross_staining_tolerance_value = document.getElementById("cf_to_water_cross_staining_tolerance_value").value;
    var cf_to_water_cross_staining_tolerance_range_math_operator = document.getElementById("cf_to_water_cross_staining_tolerance_range_math_operator").value;

    if (cf_to_water_cross_staining_tolerance_range_math_operator == '≥') 
    {
        

        document.getElementById("cf_to_water_cross_staining_min_value").value = cf_to_water_cross_staining_tolerance_value;
        document.getElementById("cf_to_water_cross_staining_max_value").value = 5;
    }

    else
    {
        

        document.getElementById("cf_to_water_cross_staining_min_value").value = 0;
        document.getElementById("cf_to_water_cross_staining_max_value").value = cf_to_water_cross_staining_tolerance_value;
    }
}


function cf_to_water_spotting_surface_cal()
{
 var cf_to_water_spotting_surface_tolerance_value = document.getElementById("cf_to_water_spotting_surface_tolerance_value").value;
    var cf_to_water_spotting_surface_tolerance_range_math_op = document.getElementById("cf_to_water_spotting_surface_tolerance_range_math_op").value;

    if (cf_to_water_spotting_surface_tolerance_range_math_op == '≥') 
    {
        

        document.getElementById("cf_to_water_spotting_surface_min_value").value = cf_to_water_spotting_surface_tolerance_value;
        document.getElementById("cf_to_water_spotting_surface_max_value").value = 5;
    }

    else if (cf_to_water_spotting_surface_tolerance_range_math_op == '>') 
    {
        

        document.getElementById("cf_to_water_spotting_surface_min_value").value = parseFloat(cf_to_water_spotting_surface_tolerance_value) + 0.5;
        document.getElementById("cf_to_water_spotting_surface_max_value").value = 5;
    }

    else if (cf_to_water_spotting_surface_tolerance_range_math_op == '<') 
    {
        

        document.getElementById("cf_to_water_spotting_surface_min_value").value = 0;
        document.getElementById("cf_to_water_spotting_surface_max_value").value = parseFloat(cf_to_water_spotting_surface_tolerance_value) - 0.5;
    }

    else
    {
        

        document.getElementById("cf_to_water_spotting_surface_min_value").value = 0;
        document.getElementById("cf_to_water_spotting_surface_max_value").value = cf_to_water_spotting_surface_tolerance_value;
    }
}


function cf_to_water_spotting_edge_cal()
{
 var cf_to_water_spotting_edge_tolerance_value = document.getElementById("cf_to_water_spotting_edge_tolerance_value").value;
    var cf_to_water_spotting_edge_tolerance_range_math_op = document.getElementById("cf_to_water_spotting_edge_tolerance_range_math_op").value;

    if (cf_to_water_spotting_edge_tolerance_range_math_op == '≥') 
    {
        

        document.getElementById("cf_to_water_spotting_edge_min_value").value = cf_to_water_spotting_edge_tolerance_value;
        document.getElementById("cf_to_water_spotting_edge_max_value").value = 5;
    }
    else if (cf_to_water_spotting_edge_tolerance_range_math_op == '>') 
    {
        

        document.getElementById("cf_to_water_spotting_edge_min_value").value = parseFloat(cf_to_water_spotting_edge_tolerance_value) + 0.5;
        document.getElementById("cf_to_water_spotting_edge_max_value").value = 5;
    }
    else if (cf_to_water_spotting_edge_tolerance_range_math_op == '<') 
    {
        

        document.getElementById("cf_to_water_spotting_edge_min_value").value = 0;
        document.getElementById("cf_to_water_spotting_edge_max_value").value = parseFloat(cf_to_water_spotting_edge_tolerance_value) - 0.5;
    }

    else
    {
        

        document.getElementById("cf_to_water_spotting_edge_min_value").value = 0;
        document.getElementById("cf_to_water_spotting_edge_max_value").value = cf_to_water_spotting_edge_tolerance_value;
    }
}

function cf_to_water_spotting_cross_staining_cal()
{
 var cf_to_water_spotting_cross_staining_tolerance_value = document.getElementById("cf_to_water_spotting_cross_staining_tolerance_value").value;
    var cf_to_water_spotting_cross_staining_tolerance_range_math_op = document.getElementById("cf_to_water_spotting_cross_staining_tolerance_range_math_op").value;

    if (cf_to_water_spotting_cross_staining_tolerance_range_math_op == '≥') 
    {
        

        document.getElementById("cf_to_water_spotting_cross_staining_min_value").value = cf_to_water_spotting_cross_staining_tolerance_value;
        document.getElementById("cf_to_water_spotting_cross_staining_max_value").value = 5;
    }
    else if (cf_to_water_spotting_cross_staining_tolerance_range_math_op == '>') 
    {
        

        document.getElementById("cf_to_water_spotting_cross_staining_min_value").value = parseFloat(cf_to_water_spotting_cross_staining_tolerance_value) + 0.5;
        document.getElementById("cf_to_water_spotting_cross_staining_max_value").value = 5;
    }

    else if (cf_to_water_spotting_cross_staining_tolerance_range_math_op == '<') 
    {
        

        document.getElementById("cf_to_water_spotting_cross_staining_min_value").value = 0;
        document.getElementById("cf_to_water_spotting_cross_staining_max_value").value = parseFloat(cf_to_water_spotting_cross_staining_tolerance_value) - 0.5;
    }

    else
    {
        

        document.getElementById("cf_to_water_spotting_cross_staining_min_value").value = 0;
        document.getElementById("cf_to_water_spotting_cross_staining_max_value").value = cf_to_water_spotting_cross_staining_tolerance_value;
    }
}


function resistance_to_surface_wetting_before_wash_cal()
{
    var test_method_for_resistance_to_surface_wetting_before_wash = document.getElementById("test_method_for_resistance_to_surface_wetting_before_wash").value;
    var resistance_to_surface_wetting_before_wash_tolerance_value = document.getElementById("resistance_to_surface_wetting_before_wash_tolerance_value").value;
    var resistance_to_surface_wetting_before_wash_tol_range_math_op = document.getElementById("resistance_to_surface_wetting_before_wash_tol_range_math_op").value;


   if(test_method_for_resistance_to_surface_wetting_before_wash == "AATCC 22")
   {


      if (resistance_to_surface_wetting_before_wash_tol_range_math_op == '≥') 
      {
          

          document.getElementById("resistance_to_surface_wetting_before_wash_min_value").value = resistance_to_surface_wetting_before_wash_tolerance_value;
          document.getElementById("resistance_to_surface_wetting_before_wash_max_value").value = 100;
      }
      else if (resistance_to_surface_wetting_before_wash_tol_range_math_op == '>') 
      {
          

          document.getElementById("resistance_to_surface_wetting_before_wash_min_value").value = parseFloat(resistance_to_surface_wetting_before_wash_tolerance_value) ;
          document.getElementById("resistance_to_surface_wetting_before_wash_max_value").value = 100 ;
      }
      else if (resistance_to_surface_wetting_before_wash_tol_range_math_op == '<') 
      {
          

          document.getElementById("resistance_to_surface_wetting_before_wash_min_value").value = 0;
          document.getElementById("resistance_to_surface_wetting_before_wash_max_value").value =  parseFloat(resistance_to_surface_wetting_before_wash_tolerance_value);
      }

      else
      {
          

          document.getElementById("resistance_to_surface_wetting_before_wash_min_value").value = 0;
          document.getElementById("resistance_to_surface_wetting_before_wash_max_value").value = resistance_to_surface_wetting_before_wash_tolerance_value;
      }
  }

  else
  {

    
      if (resistance_to_surface_wetting_before_wash_tol_range_math_op == '≥') 
      {
          

          document.getElementById("resistance_to_surface_wetting_before_wash_min_value").value = resistance_to_surface_wetting_before_wash_tolerance_value;
          document.getElementById("resistance_to_surface_wetting_before_wash_max_value").value = 5;
      }
      else if (resistance_to_surface_wetting_before_wash_tol_range_math_op == '>') 
      {
          

          document.getElementById("resistance_to_surface_wetting_before_wash_min_value").value = parseFloat(resistance_to_surface_wetting_before_wash_tolerance_value) + 0.5;
          document.getElementById("resistance_to_surface_wetting_before_wash_max_value").value = 5;
      }
      else if (resistance_to_surface_wetting_before_wash_tol_range_math_op == '<') 
      {
          

          document.getElementById("resistance_to_surface_wetting_before_wash_min_value").value = 0;
          document.getElementById("resistance_to_surface_wetting_before_wash_max_value").value =  parseFloat(resistance_to_surface_wetting_before_wash_tolerance_value) - 0.5;
      }

      else
      {
          

          document.getElementById("resistance_to_surface_wetting_before_wash_min_value").value = 0;
          document.getElementById("resistance_to_surface_wetting_before_wash_max_value").value = resistance_to_surface_wetting_before_wash_tolerance_value;
      }

      

  }
}
function resistance_to_surface_wetting_after_one_wash_cal()
{
    var test_method_for_resistance_to_surface_wetting_after_one_wash = document.getElementById("test_method_for_resistance_to_surface_wetting_after_one_wash").value;
    var resistance_to_surface_wetting_after_one_wash_tolerance_value = document.getElementById("resistance_to_surface_wetting_after_one_wash_tolerance_value").value;
    var resistance_to_surface_wetting_after_one_wash_tol_range_math_op = document.getElementById("resistance_to_surface_wetting_after_one_wash_tol_range_math_op").value;


   if(test_method_for_resistance_to_surface_wetting_after_one_wash == "AATCC 22")
   {


      if (resistance_to_surface_wetting_after_one_wash_tol_range_math_op == '≥') 
      {
          

          document.getElementById("resistance_to_surface_wetting_after_one_wash_min_value").value = resistance_to_surface_wetting_after_one_wash_tolerance_value;
          document.getElementById("resistance_to_surface_wetting_after_one_wash_max_value").value = 100;
      }
      else if (resistance_to_surface_wetting_after_one_wash_tol_range_math_op == '>') 
      {
          

          document.getElementById("resistance_to_surface_wetting_after_one_wash_min_value").value = parseFloat(resistance_to_surface_wetting_after_one_wash_tolerance_value);
          document.getElementById("resistance_to_surface_wetting_after_one_wash_max_value").value = 100 ;
      }
      else if (resistance_to_surface_wetting_after_one_wash_tol_range_math_op == '<') 
      {
          

          document.getElementById("resistance_to_surface_wetting_after_one_wash_min_value").value = 0;
          document.getElementById("resistance_to_surface_wetting_after_one_wash_max_value").value =  parseFloat(resistance_to_surface_wetting_after_one_wash_tolerance_value);
      }

      else
      {
          

          document.getElementById("resistance_to_surface_wetting_after_one_wash_min_value").value = 0;
          document.getElementById("resistance_to_surface_wetting_after_one_wash_max_value").value = resistance_to_surface_wetting_after_one_wash_tolerance_value;
      }
  }

  else
  {

    
      if (resistance_to_surface_wetting_after_one_wash_tol_range_math_op == '≥') 
      {
          

          document.getElementById("resistance_to_surface_wetting_after_one_wash_min_value").value = resistance_to_surface_wetting_after_one_wash_tolerance_value;
          document.getElementById("resistance_to_surface_wetting_after_one_wash_max_value").value = 5;
      }
      else if (resistance_to_surface_wetting_after_one_wash_tol_range_math_op == '>') 
      {
          

          document.getElementById("resistance_to_surface_wetting_after_one_wash_min_value").value = parseFloat(resistance_to_surface_wetting_after_one_wash_tolerance_value) + 0.5;
          document.getElementById("resistance_to_surface_wetting_after_one_wash_max_value").value = 5;
      }
      else if (resistance_to_surface_wetting_after_one_wash_tol_range_math_op == '<') 
      {
          

          document.getElementById("resistance_to_surface_wetting_after_one_wash_min_value").value = 0;
          document.getElementById("resistance_to_surface_wetting_after_one_wash_max_value").value =  parseFloat(resistance_to_surface_wetting_after_one_wash_tolerance_value) - 0.5;
      }

      else
      {
          

          document.getElementById("resistance_to_surface_wetting_after_one_wash_min_value").value = 0;
          document.getElementById("resistance_to_surface_wetting_after_one_wash_max_value").value = resistance_to_surface_wetting_after_one_wash_tolerance_value;
      }

      

  }
}

/*
function resistance_to_surface_wetting_after_five_wash_cal()
{
   var test_method_for_resistance_to_surface_wetting_after_five_wash = parseFloat(document.getElementById("test_method_for_resistance_to_surface_wetting_after_five_wash").value)
   var resistance_to_surface_wetting_after_five_wash_tolerance_value = parseFloat(document.getElementById("resistance_to_surface_wetting_after_five_wash_tolerance_value").value);
   var resistance_to_surface_wetting_after_five_wash_tol_range_math_op = parseFloat(document.getElementById("resistance_to_surface_wetting_after_five_wash_tol_range_math_op").value);


 if (test_method_for_resistance_to_surface_wetting_after_five_wash == "AATCC 22") 

 {
    if (resistance_to_surface_wetting_after_five_wash_tol_range_math_op == '≥') 
    {
        

        document.getElementById("resistance_to_surface_wetting_after_five_wash_min_value").value = resistance_to_surface_wetting_after_five_wash_tolerance_value - 30 ;
        document.getElementById("resistance_to_surface_wetting_after_five_wash_max_value").value = 100 - 30;
    }

    else if (resistance_to_surface_wetting_after_five_wash_tol_range_math_op == '>') 
    {
        

        document.getElementById("resistance_to_surface_wetting_after_five_wash_min_value").value = parseFloat(resistance_to_surface_wetting_after_five_wash_tolerance_value) - 29;
        document.getElementById("resistance_to_surface_wetting_after_five_wash_max_value").value = 100 - 30;
    }

    else if (resistance_to_surface_wetting_after_five_wash_tol_range_math_op == '<') 
    {
        

        document.getElementById("resistance_to_surface_wetting_after_five_wash_min_value").value = 0;
        document.getElementById("resistance_to_surface_wetting_after_five_wash_max_value").value = parseFloat(resistance_to_surface_wetting_after_five_wash_tolerance_value) - 31;
    }

    else
    {
        

        document.getElementById("resistance_to_surface_wetting_after_five_wash_min_value").value = 0;
        document.getElementById("resistance_to_surface_wetting_after_five_wash_max_value").value = resistance_to_surface_wetting_after_five_wash_tolerance_value - 30;
    }

 }

 else
 {

  if (resistance_to_surface_wetting_after_five_wash_tol_range_math_op == '≥') 
    {
        

        document.getElementById("resistance_to_surface_wetting_after_five_wash_min_value").value = resistance_to_surface_wetting_after_five_wash_tolerance_value;
        document.getElementById("resistance_to_surface_wetting_after_five_wash_max_value").value = 100;
    }

    else if (resistance_to_surface_wetting_after_five_wash_tol_range_math_op == '>') 
    {
        

        document.getElementById("resistance_to_surface_wetting_after_five_wash_min_value").value = parseFloat(resistance_to_surface_wetting_after_five_wash_tolerance_value) + 1;
        document.getElementById("resistance_to_surface_wetting_after_five_wash_max_value").value = 100;
    }

    else if (resistance_to_surface_wetting_after_five_wash_tol_range_math_op == '<') 
    {
        

        document.getElementById("resistance_to_surface_wetting_after_five_wash_min_value").value = 0;
        document.getElementById("resistance_to_surface_wetting_after_five_wash_max_value").value = parseFloat(resistance_to_surface_wetting_after_five_wash_tolerance_value) - 1;
    }

    else
    {
        

        document.getElementById("resistance_to_surface_wetting_after_five_wash_min_value").value = 0;
        document.getElementById("resistance_to_surface_wetting_after_five_wash_max_value").value = resistance_to_surface_wetting_after_five_wash_tolerance_value;
    }
 }
    
}*/




function resistance_to_surface_wetting_after_five_wash_cal()
{
    var test_method_for_resistance_to_surface_wetting_after_five_wash = document.getElementById("test_method_for_resistance_to_surface_wetting_after_five_wash").value;
    var resistance_to_surface_wetting_after_five_wash_tolerance_value = document.getElementById("resistance_to_surface_wetting_after_five_wash_tolerance_value").value;
    var resistance_to_surface_wetting_after_five_wash_tol_range_math_op = document.getElementById("resistance_to_surface_wetting_after_five_wash_tol_range_math_op").value;


   if(test_method_for_resistance_to_surface_wetting_after_five_wash == "AATCC 22")
   {


      if (resistance_to_surface_wetting_after_five_wash_tol_range_math_op == '≥') 
      {
          

          document.getElementById("resistance_to_surface_wetting_after_five_wash_min_value").value = resistance_to_surface_wetting_after_five_wash_tolerance_value;
          document.getElementById("resistance_to_surface_wetting_after_five_wash_max_value").value = 100;
      }
      else if (resistance_to_surface_wetting_after_five_wash_tol_range_math_op == '>') 
      {
          

          document.getElementById("resistance_to_surface_wetting_after_five_wash_min_value").value = parseFloat(resistance_to_surface_wetting_after_five_wash_tolerance_value);
          document.getElementById("resistance_to_surface_wetting_after_five_wash_max_value").value = 100;
      }
      else if (resistance_to_surface_wetting_after_five_wash_tol_range_math_op == '<') 
      {
          

          document.getElementById("resistance_to_surface_wetting_after_five_wash_min_value").value = 0;
          document.getElementById("resistance_to_surface_wetting_after_five_wash_max_value").value =  parseFloat(resistance_to_surface_wetting_after_five_wash_tolerance_value);
      }

      else
      {
          

          document.getElementById("resistance_to_surface_wetting_after_five_wash_min_value").value = 0;
          document.getElementById("resistance_to_surface_wetting_after_five_wash_max_value").value = resistance_to_surface_wetting_after_five_wash_tolerance_value ;
      }
  }

  else
  {

    
      if (resistance_to_surface_wetting_after_five_wash_tol_range_math_op == '≥') 
      {
          

          document.getElementById("resistance_to_surface_wetting_after_five_wash_min_value").value = resistance_to_surface_wetting_after_five_wash_tolerance_value;
          document.getElementById("resistance_to_surface_wetting_after_five_wash_max_value").value = 5;
      }
      else if (resistance_to_surface_wetting_after_five_wash_tol_range_math_op == '>') 
      {
          

          document.getElementById("resistance_to_surface_wetting_after_five_wash_min_value").value = parseFloat(resistance_to_surface_wetting_after_five_wash_tolerance_value) + 0.5;
          document.getElementById("resistance_to_surface_wetting_after_five_wash_max_value").value = 5;
      }
      else if (resistance_to_surface_wetting_after_five_wash_tol_range_math_op == '<') 
      {
          

          document.getElementById("resistance_to_surface_wetting_after_five_wash_min_value").value = 0;
          document.getElementById("resistance_to_surface_wetting_after_five_wash_max_value").value =  parseFloat(resistance_to_surface_wetting_after_five_wash_tolerance_value) - 0.5;
      }

      else
      {
          

          document.getElementById("resistance_to_surface_wetting_after_five_wash_min_value").value = 0;
          document.getElementById("resistance_to_surface_wetting_after_five_wash_max_value").value = resistance_to_surface_wetting_after_five_wash_tolerance_value;
      }

      

  }
}
function cf_to_hydrolysis_of_reactive_dyes_color_change_cal()
{
 var cf_to_hydrolysis_of_reactive_dyes_color_change_tolerance_value = document.getElementById("cf_to_hydrolysis_of_reactive_dyes_color_change_tolerance_value").value;
    var cf_to_hydrolysis_of_reactive_dyes_color_change_tol_rang_mat_op = document.getElementById("cf_to_hydrolysis_of_reactive_dyes_color_change_tol_rang_mat_op").value;

    if (cf_to_hydrolysis_of_reactive_dyes_color_change_tol_rang_mat_op == '≥') 
    {
        

        document.getElementById("cf_to_hydrolysis_of_reactive_dyes_color_change_min_value").value = cf_to_hydrolysis_of_reactive_dyes_color_change_tolerance_value;
        document.getElementById("cf_to_hydrolysis_of_reactive_dyes_color_change_max_value").value = 5;
    }
    else if (cf_to_hydrolysis_of_reactive_dyes_color_change_tol_rang_mat_op == '>') 
    {
        

        document.getElementById("cf_to_hydrolysis_of_reactive_dyes_color_change_min_value").value = parseFloat(cf_to_hydrolysis_of_reactive_dyes_color_change_tolerance_value) + 0.5;
        document.getElementById("cf_to_hydrolysis_of_reactive_dyes_color_change_max_value").value = 5;
    }
    else if (cf_to_hydrolysis_of_reactive_dyes_color_change_tol_rang_mat_op == '<') 
    {
        

        document.getElementById("cf_to_hydrolysis_of_reactive_dyes_color_change_min_value").value = 0;
        document.getElementById("cf_to_hydrolysis_of_reactive_dyes_color_change_max_value").value = parseFloat(cf_to_hydrolysis_of_reactive_dyes_color_change_tolerance_value) - 0.5;
    }

    else
    {
        

        document.getElementById("cf_to_hydrolysis_of_reactive_dyes_color_change_min_value").value = 0;
        document.getElementById("cf_to_hydrolysis_of_reactive_dyes_color_change_max_value").value = cf_to_hydrolysis_of_reactive_dyes_color_change_tolerance_value;
    }
}


function cf_to_hydrolysis_of_reactive_dyes_staining_cal()
{
 var cf_to_hydrolysis_of_reactive_dyes_staining_tolerance_value = document.getElementById("cf_to_hydrolysis_of_reactive_dyes_staining_tolerance_value").value;
    var cf_to_hydrolysis_of_reactive_dyes_staining_toler_range_math_op = document.getElementById("cf_to_hydrolysis_of_reactive_dyes_staining_toler_range_math_op").value;

    if (cf_to_hydrolysis_of_reactive_dyes_staining_toler_range_math_op == '≥') 
    {
        

        document.getElementById("cf_to_hydrolysis_of_reactive_dyes_staining_min_value").value = cf_to_hydrolysis_of_reactive_dyes_staining_tolerance_value;
        document.getElementById("cf_to_hydrolysis_of_reactive_dyes_staining_max_value").value = 5;
    }

    else
    {
        

        document.getElementById("cf_to_hydrolysis_of_reactive_dyes_staining_min_value").value = 0;
        document.getElementById("cf_to_hydrolysis_of_reactive_dyes_staining_max_value").value = cf_to_hydrolysis_of_reactive_dyes_staining_tolerance_value;
    }
}

/*function cf_to_oidative_bleach_damage_color_change_cal()
{
 var cf_to_oidative_bleach_damage_color_change_tolerance_value = document.getElementById("cf_to_oidative_bleach_damage_color_change_tolerance_value").value;
    var cf_to_oidative_bleach_damage_color_change_tolerance_range_mat_op = document.getElementById("cf_to_oidative_bleach_damage_color_change_tolerance_range_mat_op").value;

    if (cf_to_oidative_bleach_damage_color_change_tolerance_range_mat_op == '≥') 
    {
        

        document.getElementById("cf_to_oidative_bleach_damage_color_change_min_value").value = cf_to_oidative_bleach_damage_color_change_tolerance_value;
        document.getElementById("cf_to_oidative_bleach_damage_color_change_max_value").value = 5;
    }

    else
    {
        

        document.getElementById("cf_to_oidative_bleach_damage_color_change_min_value").value = 0;
        document.getElementById("cf_to_oidative_bleach_damage_color_change_max_value").value = cf_to_oidative_bleach_damage_color_change_tolerance_value;
    }
}
*/


function cf_to_oxidative_bleach_damage_color_change_cal()
{
 var cf_to_oxidative_bleach_damage_color_change_tolerance_value = document.getElementById("cf_to_oxidative_bleach_damage_color_change_tolerance_value").value;
    var cf_to_oxidative_bleach_damage_color_change_tol_range_math_op = document.getElementById("cf_to_oxidative_bleach_damage_color_change_tol_range_math_op").value;

    if (cf_to_oxidative_bleach_damage_color_change_tol_range_math_op == '≥') 
    {
        

        document.getElementById("cf_to_oxidative_bleach_damage_color_change_min_value").value = cf_to_oxidative_bleach_damage_color_change_tolerance_value;
        document.getElementById("cf_to_oxidative_bleach_damage_color_change_max_value").value = 5;
    }
    else if (cf_to_oxidative_bleach_damage_color_change_tol_range_math_op == '>') 
    {
        

        document.getElementById("cf_to_oxidative_bleach_damage_color_change_min_value").value = parseFloat(cf_to_oxidative_bleach_damage_color_change_tolerance_value) + 0.5;
        document.getElementById("cf_to_oxidative_bleach_damage_color_change_max_value").value = 5;
    }

    else if (cf_to_oxidative_bleach_damage_color_change_tol_range_math_op == '<') 
    {
        

        document.getElementById("cf_to_oxidative_bleach_damage_color_change_min_value").value = 0;
        document.getElementById("cf_to_oxidative_bleach_damage_color_change_max_value").value = parseFloat(cf_to_oxidative_bleach_damage_color_change_tolerance_value) - 0.5;
    }

    else
    {
        

        document.getElementById("cf_to_oxidative_bleach_damage_color_change_min_value").value = 0;
        document.getElementById("cf_to_oxidative_bleach_damage_color_change_max_value").value = cf_to_oxidative_bleach_damage_color_change_tolerance_value;
    }
}


function cf_to_phenolic_yellowing_staining_cal()
{
 var cf_to_phenolic_yellowing_staining_tolerance_value = document.getElementById("cf_to_phenolic_yellowing_staining_tolerance_value").value;
    var cf_to_phenolic_yellowing_staining_tolerance_range_math_operator = document.getElementById("cf_to_phenolic_yellowing_staining_tolerance_range_math_operator").value;

    if (cf_to_phenolic_yellowing_staining_tolerance_range_math_operator == '≥') 
    {
        

        document.getElementById("cf_to_phenolic_yellowing_staining_min_value").value = cf_to_phenolic_yellowing_staining_tolerance_value;
        document.getElementById("cf_to_phenolic_yellowing_staining_max_value").value = 5;
    }
    else if (cf_to_phenolic_yellowing_staining_tolerance_range_math_operator == '>') 
    {
        

        document.getElementById("cf_to_phenolic_yellowing_staining_min_value").value = parseFloat(cf_to_phenolic_yellowing_staining_tolerance_value) + 0.5;
        document.getElementById("cf_to_phenolic_yellowing_staining_max_value").value = 5;
    }
    else if (cf_to_phenolic_yellowing_staining_tolerance_range_math_operator == '<') 
    {
        

        document.getElementById("cf_to_phenolic_yellowing_staining_min_value").value = 0;
        document.getElementById("cf_to_phenolic_yellowing_staining_max_value").value = parseFloat(cf_to_phenolic_yellowing_staining_tolerance_value) - 0.5;
    }

    else
    {
        

        document.getElementById("cf_to_phenolic_yellowing_staining_min_value").value = 0;
        document.getElementById("cf_to_phenolic_yellowing_staining_max_value").value = cf_to_phenolic_yellowing_staining_tolerance_value;
    }
}

function cf_to_saliva_color_change_cal()
{
 var cf_to_saliva_color_change_tolerance_value = document.getElementById("cf_to_saliva_color_change_tolerance_value").value;
    var cf_to_saliva_color_change_tolerance_range_math_operator = document.getElementById("cf_to_saliva_color_change_tolerance_range_math_operator").value;

    if (cf_to_saliva_color_change_tolerance_range_math_operator == '≥') 
    {
        

        document.getElementById("cf_to_saliva_color_change_min_value").value = cf_to_saliva_color_change_tolerance_value;
        document.getElementById("cf_to_saliva_color_change_max_value").value = 5;
    }

    else
    {
        

        document.getElementById("cf_to_saliva_color_change_min_value").value = 0;
        document.getElementById("cf_to_saliva_color_change_max_value").value = cf_to_saliva_color_change_tolerance_value;
    }
}

function cf_to_pvc_migration_staining_cal()
{
 var cf_to_pvc_migration_staining_tolerance_value = document.getElementById("cf_to_pvc_migration_staining_tolerance_value").value;
    var cf_to_pvc_migration_staining_tolerance_range_math_operator = document.getElementById("cf_to_pvc_migration_staining_tolerance_range_math_operator").value;

    if (cf_to_pvc_migration_staining_tolerance_range_math_operator == '≥') 
    {
        

        document.getElementById("cf_to_pvc_migration_staining_min_value").value = cf_to_pvc_migration_staining_tolerance_value;
        document.getElementById("cf_to_pvc_migration_staining_max_value").value = 5;
    }
    else if (cf_to_pvc_migration_staining_tolerance_range_math_operator == '>') 
    {
        

        document.getElementById("cf_to_pvc_migration_staining_min_value").value = parseFloat(cf_to_pvc_migration_staining_tolerance_value) + 0.5;
        document.getElementById("cf_to_pvc_migration_staining_max_value").value = 5;
    }

    else if (cf_to_pvc_migration_staining_tolerance_range_math_operator == '<') 
    {
        

        document.getElementById("cf_to_pvc_migration_staining_min_value").value = 0;
        document.getElementById("cf_to_pvc_migration_staining_max_value").value = parseFloat(cf_to_pvc_migration_staining_tolerance_value) - 0.5;
    }

    else
    {
        

        document.getElementById("cf_to_pvc_migration_staining_min_value").value = 0;
        document.getElementById("cf_to_pvc_migration_staining_max_value").value = cf_to_pvc_migration_staining_tolerance_value;
    }
}

function cf_to_saliva_staining_cal()
{
 var cf_to_saliva_staining_tolerance_value = document.getElementById("cf_to_saliva_staining_tolerance_value").value;
    var cf_to_saliva_staining_tolerance_range_math_operator = document.getElementById("cf_to_saliva_staining_tolerance_range_math_operator").value;

    if (cf_to_saliva_staining_tolerance_range_math_operator == '≥') 
    {
        

        document.getElementById("cf_to_saliva_staining_staining_min_value").value = cf_to_saliva_staining_tolerance_value;
        document.getElementById("cf_to_saliva_staining_max_value").value = 5;
    }

    else if (cf_to_saliva_staining_tolerance_range_math_operator == '>') 
    {
        

        document.getElementById("cf_to_saliva_staining_staining_min_value").value = parseFloat(cf_to_saliva_staining_tolerance_value) + 0.5;
        document.getElementById("cf_to_saliva_staining_max_value").value = 5;
    }
    else if (cf_to_saliva_staining_tolerance_range_math_operator == '<') 
    {
        

        document.getElementById("cf_to_saliva_staining_staining_min_value").value = 0;
        document.getElementById("cf_to_saliva_staining_max_value").value = parseFloat(cf_to_saliva_staining_tolerance_value) - 0.5;
    }

    else
    {
        

        document.getElementById("cf_to_saliva_staining_staining_min_value").value = 0;
        document.getElementById("cf_to_saliva_staining_max_value").value = cf_to_saliva_staining_tolerance_value;
    }
}


function cf_to_saliva_color_change_cal()
{
 var cf_to_saliva_color_change_tolerance_value = document.getElementById("cf_to_saliva_color_change_tolerance_value").value;
    var cf_to_saliva_color_change_tolerance_range_math_operator = document.getElementById("cf_to_saliva_color_change_tolerance_range_math_operator").value;

    if (cf_to_saliva_color_change_tolerance_range_math_operator == '≥') 
    {
        

        document.getElementById("cf_to_saliva_color_change_staining_min_value").value = cf_to_saliva_color_change_tolerance_value;
        document.getElementById("cf_to_saliva_color_change_max_value").value = 5;
    }
    else if (cf_to_saliva_color_change_tolerance_range_math_operator == '>') 
    {
        

        document.getElementById("cf_to_saliva_color_change_staining_min_value").value = parseFloat(cf_to_saliva_color_change_tolerance_value) + 0.5;
        document.getElementById("cf_to_saliva_color_change_max_value").value = 5;
    }

    else if (cf_to_saliva_color_change_tolerance_range_math_operator == '<') 
    {
        

        document.getElementById("cf_to_saliva_color_change_staining_min_value").value = 0;
        document.getElementById("cf_to_saliva_color_change_max_value").value = parseFloat(cf_to_saliva_color_change_tolerance_value) - 0.5;
    }

    else
    {
        

        document.getElementById("cf_to_saliva_color_change_staining_min_value").value = 0;
        document.getElementById("cf_to_saliva_color_change_max_value").value = cf_to_saliva_color_change_tolerance_value;
    }
}

function cf_to_chlorinated_water_color_change_cal()
{
 var cf_to_chlorinated_water_color_change_tolerance_value = document.getElementById("cf_to_chlorinated_water_color_change_tolerance_value").value;
    var cf_to_chlorinated_water_color_change_tolerance_range_math_op = document.getElementById("cf_to_chlorinated_water_color_change_tolerance_range_math_op").value;

    if (cf_to_chlorinated_water_color_change_tolerance_range_math_op == '≥') 
    {
        

        document.getElementById("cf_to_chlorinated_water_color_change_min_value").value = cf_to_chlorinated_water_color_change_tolerance_value;
        document.getElementById("cf_to_chlorinated_water_color_change_max_value").value = 5;
    }

    else if (cf_to_chlorinated_water_color_change_tolerance_range_math_op == '>') 
    {
        

        document.getElementById("cf_to_chlorinated_water_color_change_min_value").value = parseFloat(cf_to_chlorinated_water_color_change_tolerance_value) + 0.5;
        document.getElementById("cf_to_chlorinated_water_color_change_max_value").value = 5;
    }

    else if (cf_to_chlorinated_water_color_change_tolerance_range_math_op == '<') 
    {
        

        document.getElementById("cf_to_chlorinated_water_color_change_min_value").value = 0;
        document.getElementById("cf_to_chlorinated_water_color_change_max_value").value =  parseFloat(cf_to_chlorinated_water_color_change_tolerance_value) - 0.5;
    }

    else
    {
        

        document.getElementById("cf_to_chlorinated_water_color_change_min_value").value = 0;
        document.getElementById("cf_to_chlorinated_water_color_change_max_value").value = cf_to_chlorinated_water_color_change_tolerance_value;
    }
}

function cf_to_chlorinated_water_staining_cal()
{
 var cf_to_chlorinated_water_staining_tolerance_value = document.getElementById("cf_to_chlorinated_water_staining_tolerance_value").value;
    var cf_to_chlorinated_water_staining_tolerance_range_math_operator = document.getElementById("cf_to_chlorinated_water_staining_tolerance_range_math_operator").value;

    if (cf_to_chlorinated_water_staining_tolerance_range_math_operator == '≥') 
    {
        

        document.getElementById("cf_to_chlorinated_water_staining_min_value").value = cf_to_chlorinated_water_staining_tolerance_value;
        document.getElementById("cf_to_chlorinated_water_staining_max_value").value = 5;
    }

    else
    {
        

        document.getElementById("cf_to_chlorinated_water_staining_min_value").value = 0;
        document.getElementById("cf_to_chlorinated_water_staining_max_value").value = cf_to_chlorinated_water_staining_tolerance_value;
    }
}

function cf_to_cholorine_bleach_color_change_cal()
{
 var cf_to_cholorine_bleach_color_change_tolerance_value = document.getElementById("cf_to_cholorine_bleach_color_change_tolerance_value").value;
    var cf_to_cholorine_bleach_color_change_tolerance_range_math_op = document.getElementById("cf_to_cholorine_bleach_color_change_tolerance_range_math_op").value;

    if (cf_to_cholorine_bleach_color_change_tolerance_range_math_op == '≥') 
    {
        

        document.getElementById("cf_to_cholorine_bleach_color_change_min_value").value = cf_to_cholorine_bleach_color_change_tolerance_value;
        document.getElementById("cf_to_cholorine_bleach_color_change_max_value").value = 5;
    }
    else if (cf_to_cholorine_bleach_color_change_tolerance_range_math_op == '>') 
    {
        

        document.getElementById("cf_to_cholorine_bleach_color_change_min_value").value = parseFloat(cf_to_cholorine_bleach_color_change_tolerance_value) + 0.5;
        document.getElementById("cf_to_cholorine_bleach_color_change_max_value").value = 5;
    }

    else if (cf_to_cholorine_bleach_color_change_tolerance_range_math_op == '<') 
    {
        

        document.getElementById("cf_to_cholorine_bleach_color_change_min_value").value = 0;
        document.getElementById("cf_to_cholorine_bleach_color_change_max_value").value = parseFloat(cf_to_cholorine_bleach_color_change_tolerance_value) - 0.5;
    }

    else
    {
        

        document.getElementById("cf_to_cholorine_bleach_color_change_min_value").value = 0;
        document.getElementById("cf_to_cholorine_bleach_color_change_max_value").value = cf_to_cholorine_bleach_color_change_tolerance_value;
    }
}

function cf_to_cholorine_bleach_staining_cal()
{
 var cf_to_cholorine_bleach_staining_tolerance_value = document.getElementById("cf_to_cholorine_bleach_staining_tolerance_value").value;
    var cf_to_cholorine_bleach_staining_tolerance_range_math_operator = document.getElementById("cf_to_cholorine_bleach_staining_tolerance_range_math_operator").value;

    if (cf_to_cholorine_bleach_staining_tolerance_range_math_operator == '≥') 
    {
        

        document.getElementById("cf_to_cholorine_bleach_staining_min_value").value = cf_to_cholorine_bleach_staining_tolerance_value;
        document.getElementById("cf_to_cholorine_bleach_staining_max_value").value = 5;
    }

    else
    {
        

        document.getElementById("cf_to_cholorine_bleach_staining_min_value").value = 0;
        document.getElementById("cf_to_cholorine_bleach_staining_max_value").value = cf_to_cholorine_bleach_staining_tolerance_value;
    }
}

function cf_to_peroxide_bleach_cal()
{
 var cf_to_peroxide_bleach_color_change_tolerance_value = document.getElementById("cf_to_peroxide_bleach_color_change_tolerance_value").value;
    var cf_to_peroxide_bleach_color_change_tolerance_range_math_operator = document.getElementById("cf_to_peroxide_bleach_color_change_tolerance_range_math_operator").value;

    if (cf_to_peroxide_bleach_color_change_tolerance_range_math_operator == '≥') 
    {
        

        document.getElementById("cf_to_peroxide_bleach_color_change_min_value").value = cf_to_peroxide_bleach_color_change_tolerance_value;
        document.getElementById("cf_to_peroxide_bleach_color_change_max_value").value = 5;
    } 
    else if (cf_to_peroxide_bleach_color_change_tolerance_range_math_operator == '>') 
    {
        

        document.getElementById("cf_to_peroxide_bleach_color_change_min_value").value = parseFloat(cf_to_peroxide_bleach_color_change_tolerance_value) + 0.5;
        document.getElementById("cf_to_peroxide_bleach_color_change_max_value").value = 5;
    }
    else if (cf_to_peroxide_bleach_color_change_tolerance_range_math_operator == '<') 
    {
        

        document.getElementById("cf_to_peroxide_bleach_color_change_min_value").value = 0;
        document.getElementById("cf_to_peroxide_bleach_color_change_max_value").value = parseFloat(cf_to_peroxide_bleach_color_change_tolerance_value) - 0.5;
    }

    else
    {
        

        document.getElementById("cf_to_peroxide_bleach_color_change_min_value").value = 0;
        document.getElementById("cf_to_peroxide_bleach_color_change_max_value").value = cf_to_peroxide_bleach_color_change_tolerance_value;
    }
}

function cf_to_peroxide_bleach_staining_cal()
{
 var cf_to_peroxide_bleach_staining_tolerance_value = document.getElementById("cf_to_peroxide_bleach_staining_tolerance_value").value;
    var cf_to_peroxide_bleach_staining_tolerance_range_math_operator = document.getElementById("cf_to_peroxide_bleach_staining_tolerance_range_math_operator").value;

    if (cf_to_peroxide_bleach_staining_tolerance_range_math_operator == '≥') 
    {
        

        document.getElementById("cf_to_peroxide_bleach_staining_min_value").value = cf_to_peroxide_bleach_staining_tolerance_value;
        document.getElementById("cf_to_peroxide_bleach_staining_max_value").value = 5;
    }

    else
    {
        

        document.getElementById("cf_to_peroxide_bleach_staining_min_value").value = 0;
        document.getElementById("cf_to_peroxide_bleach_staining_max_value").value = cf_to_peroxide_bleach_staining_tolerance_value;
    }
}

function cross_staining_cal()
{
 var cross_staining_tolerance_value = document.getElementById("cross_staining_tolerance_value").value;
    var cross_staining_tolerance_range_math_operator = document.getElementById("cross_staining_tolerance_range_math_operator").value;

    if (cross_staining_tolerance_range_math_operator == '≥') 
    {
        

        document.getElementById("cross_staining_min_value").value = cross_staining_tolerance_value;
        document.getElementById("cross_staining_max_value").value = 5;
    }

    else if (cross_staining_tolerance_range_math_operator == '>') 
    {
        

        document.getElementById("cross_staining_min_value").value = parseFloat(cross_staining_tolerance_value) + 0.5;
        document.getElementById("cross_staining_max_value").value = 5;
    }
    else if (cross_staining_tolerance_range_math_operator == '<') 
    {
        

        document.getElementById("cross_staining_min_value").value = 0;
        document.getElementById("cross_staining_max_value").value =  parseFloat(cross_staining_tolerance_value) - 0.5;
    }

    else
    {
        

        document.getElementById("cross_staining_min_value").value = 0;
        document.getElementById("cross_staining_max_value").value = cross_staining_tolerance_value;
    }
}

function water_absorption_value_cal()
{
 var water_absorption_value_tolerance_value = document.getElementById("water_absorption_value_tolerance_value").value;
    var water_absorption_value_tolerance_range_math_operator = document.getElementById("water_absorption_value_tolerance_range_math_operator").value;

    if (water_absorption_value_tolerance_range_math_operator == '≤') 
    {
        

         document.getElementById("water_absorption_value_min_value").value = 0;
        document.getElementById("water_absorption_value_max_value").value = water_absorption_value_tolerance_value;
    }
   

    else
    {
        

        document.getElementById("water_absorption_value_min_value").value = 0;
        document.getElementById("water_absorption_value_max_value").value = water_absorption_value_tolerance_value;
    }
}

function spirality_value_cal()
{
   var spirality_value_tolerance_value = document.getElementById("spirality_value_tolerance_value").value;
    var spirality_value_tolerance_range_math_operator = document.getElementById("spirality_value_tolerance_range_math_operator").value;

    if (spirality_value_tolerance_range_math_operator == '≥') 
    {
        

        document.getElementById("spirality_value_min_value").value = spirality_value_tolerance_value;
        document.getElementById("spirality_value_max_value").value = 5;
    }

    else if (spirality_value_tolerance_range_math_operator == '>') 
    {
        

        document.getElementById("spirality_value_min_value").value = parseFloat(spirality_value_tolerance_value) + 0.5;
        document.getElementById("spirality_value_max_value").value = 5;
    }
    else if (spirality_value_tolerance_range_math_operator == '<') 
    {
        

        document.getElementById("spirality_value_min_value").value = 0;
        document.getElementById("spirality_value_max_value").value = parseFloat(spirality_value_tolerance_value) - 0.5;
    }

    else
    {
        

        document.getElementById("spirality_value_min_value").value = 0;
        document.getElementById("spirality_value_max_value").value = spirality_value_tolerance_value;
    }
}
function durable_press_value_cal()
{
 var durable_press_value_tolerance_value = document.getElementById("durable_press_value_tolerance_value").value;
    var durable_press_value_tolerance_range_math_operator = document.getElementById("durable_press_value_tolerance_range_math_operator").value;

    if (durable_press_value_tolerance_range_math_operator == '≥') 
    {
        

        document.getElementById("durable_press_value_min_value").value = durable_press_value_tolerance_value;
        document.getElementById("durable_press_value_max_value").value = 5;
    }

    else
    {
        

        document.getElementById("durable_press_value_min_value").value = 0;
        document.getElementById("durable_press_value_max_value").value = durable_press_value_tolerance_value;
    }
}


function color_fastess_to_artificial_daylight_blue_wool_scale_cal()
{

  var color_fastess_to_artificial_daylight_blue_wool_scale=document.getElementById("color_fastess_to_artificial_daylight_blue_wool_scale").value;
  

   if (color_fastess_to_artificial_daylight_blue_wool_scale == 'AFU') 
    {


      document.getElementById("color_fastess_to_artificial_daylight_tolerance_value").style.display= "none";
      document.getElementById("color_fastess_to_artificial_daylight_tolerance_value_afu").style.display= "block";
    }
    else
    {
      document.getElementById("color_fastess_to_artificial_daylight_tolerance_value").style.display= "block";
      document.getElementById("color_fastess_to_artificial_daylight_tolerance_value_afu").style.display= "none";
    }
}


function color_fastess_to_artificial_daylight_cal()
{
    var color_fastess_to_artificial_daylight_tolerance_value = document.getElementById("color_fastess_to_artificial_daylight_tolerance_value").value;
    var color_fastess_to_artificial_daylight_tolerance_value_afu = document.getElementById("color_fastess_to_artificial_daylight_tolerance_value_afu").value;
    var color_fastess_to_artificial_daylight_blue_wool_scale=document.getElementById("color_fastess_to_artificial_daylight_blue_wool_scale").value;
    var color_fastess_to_artificial_daylight_tolerance_range_math_op = document.getElementById("color_fastess_to_artificial_daylight_tolerance_range_math_op").value;

    if (color_fastess_to_artificial_daylight_tolerance_range_math_op == '≥') 
    {
        
  

     if (color_fastess_to_artificial_daylight_blue_wool_scale == 'AFU') 
    {
        document.getElementById("color_fastess_to_artificial_daylight_min_value").value = color_fastess_to_artificial_daylight_tolerance_value_afu;
         document.getElementById("color_fastess_to_artificial_daylight_max_value").value = 8;
    }
    else
     {

        
        document.getElementById("color_fastess_to_artificial_daylight_min_value").value = color_fastess_to_artificial_daylight_tolerance_value;
        document.getElementById("color_fastess_to_artificial_daylight_max_value").value = 8;
     }
    }

    else if (color_fastess_to_artificial_daylight_tolerance_range_math_op == '>') 
    {
        
     if (color_fastess_to_artificial_daylight_blue_wool_scale == 'AFU') 
    {
         document.getElementById("color_fastess_to_artificial_daylight_min_value").value = parseFloat(color_fastess_to_artificial_daylight_tolerance_value_afu) + 0.5;
         document.getElementById("color_fastess_to_artificial_daylight_max_value").value = 8;
    }
    else
     {

        document.getElementById("color_fastess_to_artificial_daylight_min_value").value = parseFloat(color_fastess_to_artificial_daylight_tolerance_value) + 0.5;
        document.getElementById("color_fastess_to_artificial_daylight_max_value").value = 8;
      }

    }

    else if (color_fastess_to_artificial_daylight_tolerance_range_math_op == '<') 
    {
        if (color_fastess_to_artificial_daylight_blue_wool_scale == 'AFU') 
        {
              document.getElementById("color_fastess_to_artificial_daylight_min_value").value = 0;
             document.getElementById("color_fastess_to_artificial_daylight_max_value").value = parseFloat(color_fastess_to_artificial_daylight_tolerance_value_afu) - 0.5;
        }
        else
         {

        document.getElementById("color_fastess_to_artificial_daylight_min_value").value = 0;
        document.getElementById("color_fastess_to_artificial_daylight_max_value").value = parseFloat(color_fastess_to_artificial_daylight_tolerance_value) - 0.5;
       
         }

    }


    else
    {
        if (color_fastess_to_artificial_daylight_blue_wool_scale == 'AFU') 
        {
              document.getElementById("color_fastess_to_artificial_daylight_min_value").value = 0;
             document.getElementById("color_fastess_to_artificial_daylight_max_value").value = color_fastess_to_artificial_daylight_tolerance_value_afu;
        }
        else
         {

        document.getElementById("color_fastess_to_artificial_daylight_min_value").value = 0;
        document.getElementById("color_fastess_to_artificial_daylight_max_value").value = color_fastess_to_artificial_daylight_tolerance_value;
        
         }
    }

    
}


function moisture_content_cal()
{
 var moisture_content_tolerance_value = document.getElementById("moisture_content_tolerance_value").value;
    var moisture_content_tolerance_range_math_op = document.getElementById("moisture_content_tolerance_range_math_op").value;

    if (moisture_content_tolerance_range_math_op == '≥') 
    {
        

        document.getElementById("moisture_content_min_value").value = moisture_content_tolerance_value;
        document.getElementById("moisture_content_max_value").value = 5;
    }
    else if (moisture_content_tolerance_range_math_op == '<') 
    {
        

        document.getElementById("moisture_content_min_value").value = parseFloat(moisture_content_tolerance_value)+0.5;
        document.getElementById("moisture_content_max_value").value = 5;
    }

    else if (moisture_content_tolerance_range_math_op == '>') 
    {
        

        document.getElementById("moisture_content_min_value").value = 0;
        document.getElementById("moisture_content_max_value").value = parseFloat(moisture_content_tolerance_value);
    }


    else
    {
        

        document.getElementById("moisture_content_min_value").value = 0;
        document.getElementById("moisture_content_max_value").value = moisture_content_tolerance_value;
    }
}


function ironability_of_woven_fabric_value_cal()
{
 var ironability_of_woven_fabric_value_tolerance_value = document.getElementById("ironability_of_woven_fabric_value_tolerance_value").value;
    var durable_press_value_tolerance_range_math_operator = document.getElementById("durable_press_value_tolerance_range_math_operator").value;

    if (durable_press_value_tolerance_range_math_operator == '≥') 
    {
        

        document.getElementById("ironability_of_woven_fabric_value_min_value").value = ironability_of_woven_fabric_value_tolerance_value;
        document.getElementById("ironability_of_woven_fabric_value_max_value").value = 5;
    }

    else
    {
        

        document.getElementById("ironability_of_woven_fabric_value_min_value").value = 0;
        document.getElementById("ironability_of_woven_fabric_value_max_value").value = ironability_of_woven_fabric_value_tolerance_value;
    }
}


function evaporation_rate_quick_drying_cal()
{
 var evaporation_rate_quick_drying_tolerance_value = document.getElementById("evaporation_rate_quick_drying_tolerance_value").value;
    var evaporation_rate_quick_drying_tolerance_range_math_op = document.getElementById("evaporation_rate_quick_drying_tolerance_range_math_op").value;

    if (evaporation_rate_quick_drying_tolerance_range_math_op == '≥') 
    {
        

        document.getElementById("evaporation_rate_quick_drying_min_value").value = evaporation_rate_quick_drying_tolerance_value;
        document.getElementById("evaporation_rate_quick_drying_max_value").value = 100;
    }

    else if (evaporation_rate_quick_drying_tolerance_range_math_op == '>') 
    {
        

        document.getElementById("evaporation_rate_quick_drying_min_value").value = parseFloat(evaporation_rate_quick_drying_tolerance_value) + 1;
        document.getElementById("evaporation_rate_quick_drying_max_value").value = 100;
    }

    else if (evaporation_rate_quick_drying_tolerance_range_math_op == '<') 
    {
        

        document.getElementById("evaporation_rate_quick_drying_min_value").value = 0;
        document.getElementById("evaporation_rate_quick_drying_max_value").value = parseFloat(evaporation_rate_quick_drying_tolerance_value) - 1;
    }


    else
    {
        

        document.getElementById("evaporation_rate_quick_drying_min_value").value = 0;
        document.getElementById("evaporation_rate_quick_drying_max_value").value = evaporation_rate_quick_drying_tolerance_value;
    }
}


function cf_to_artificial_light_value_cal()
{
 var cf_to_artificial_light_value_tolerance_value = document.getElementById("cf_to_artificial_light_value_tolerance_value").value;
    var cf_to_artificial_light_value_tolerance_range_math_operator = document.getElementById("cf_to_artificial_light_value_tolerance_range_math_operator").value;

    if (cf_to_artificial_light_value_tolerance_range_math_operator == '≥') 
    {
        

        document.getElementById("cf_to_artificial_light_value_min_value").value = cf_to_artificial_light_value_tolerance_value;
        document.getElementById("cf_to_artificial_light_value_max_value").value = 5;
    }

    else
    {
        

        document.getElementById("cf_to_artificial_light_value_min_value").value = 0;
        document.getElementById("cf_to_artificial_light_value_max_value").value = cf_to_artificial_light_value_tolerance_value;
    }
}

function seam_slippage_resistance_in_warp_cal()
{
 var seam_slippage_resistance_in_warp_tolerance_value = document.getElementById("seam_slippage_resistance_in_warp_tolerance_value").value;
    var seam_slippage_resistance_in_warp_tolerance_range_math_operator = document.getElementById("seam_slippage_resistance_in_warp_tolerance_range_math_operator").value;

    if (seam_slippage_resistance_in_warp_tolerance_range_math_operator == '1') 
    {
        

        document.getElementById("seam_slippage_resistance_in_warp_min_value").value = seam_slippage_resistance_in_warp_tolerance_value;
        document.getElementById("seam_slippage_resistance_in_warp_max_value").value = 3000;
    }

    else if (seam_slippage_resistance_in_warp_tolerance_range_math_operator == '2') 
    {
        

        document.getElementById("seam_slippage_resistance_in_warp_min_value").value = seam_slippage_resistance_in_warp_tolerance_value;
        document.getElementById("seam_slippage_resistance_in_warp_max_value").value = 3000;
    }
    else if (seam_slippage_resistance_in_warp_tolerance_range_math_operator == '3') 
    {
        

        document.getElementById("seam_slippage_resistance_in_warp_min_value").value = seam_slippage_resistance_in_warp_tolerance_value;
        document.getElementById("seam_slippage_resistance_in_warp_max_value").value = 3000;
    }
    else if (seam_slippage_resistance_in_warp_tolerance_range_math_operator == '4') 
    {
        

        document.getElementById("seam_slippage_resistance_in_warp_min_value").value = seam_slippage_resistance_in_warp_tolerance_value;
        document.getElementById("seam_slippage_resistance_in_warp_max_value").value = 3000;
    }

    else
    {
        

        document.getElementById("seam_slippage_resistance_in_warp_min_value").value = seam_slippage_resistance_in_warp_tolerance_value;
        document.getElementById("seam_slippage_resistance_in_warp_max_value").value = 3000;
    }
}

function seam_slippage_resistance_in_weft_cal()
{
 var seam_slippage_resistance_in_weft_tolerance_value = document.getElementById("seam_slippage_resistance_in_weft_tolerance_value").value;
    var seam_slippage_resistance_in_weft_tolerance_range_math_operator = document.getElementById("seam_slippage_resistance_in_weft_tolerance_range_math_operator").value;

    if (seam_slippage_resistance_in_weft_tolerance_range_math_operator == '1') 
    {
        

        document.getElementById("seam_slippage_resistance_in_weft_min_value").value = seam_slippage_resistance_in_weft_tolerance_value;
        document.getElementById("seam_slippage_resistance_in_weft_max_value").value = 3000;
    }

    else if (seam_slippage_resistance_in_weft_tolerance_range_math_operator == '2') 
    {
        

        document.getElementById("seam_slippage_resistance_in_weft_min_value").value = seam_slippage_resistance_in_weft_tolerance_value;
        document.getElementById("seam_slippage_resistance_in_weft_max_value").value = 3000;
    }

    else if (seam_slippage_resistance_in_weft_tolerance_range_math_operator == '3') 
    {
        

        document.getElementById("seam_slippage_resistance_in_weft_min_value").value = seam_slippage_resistance_in_weft_tolerance_value;
        document.getElementById("seam_slippage_resistance_in_weft_max_value").value = 3000;
    }

    else if (seam_slippage_resistance_in_weft_tolerance_range_math_operator == '4') 
    {
        

        document.getElementById("seam_slippage_resistance_in_weft_min_value").value = seam_slippage_resistance_in_weft_tolerance_value;
        document.getElementById("seam_slippage_resistance_in_weft_max_value").value = 3000;
    }

    else
    {
        

        document.getElementById("seam_slippage_resistance_in_weft_min_value").value = seam_slippage_resistance_in_weft_tolerance_value;
        document.getElementById("seam_slippage_resistance_in_weft_max_value").value = 3000;
    }
}



 function seam_slippage_resistance_iso_2_in_warp_cal()
{
 var seam_slippage_resistance_iso_2_in_warp_tolerance_value = document.getElementById("seam_slippage_resistance_iso_2_in_warp_tolerance_value").value;
    var seam_slippage_resistance_iso_2_in_warp_tolerance_range_math_op = document.getElementById("seam_slippage_resistance_iso_2_in_warp_tolerance_range_math_op").value;

    if (seam_slippage_resistance_iso_2_in_warp_tolerance_range_math_op == '≤') 
    {
        

        document.getElementById("seam_slippage_resistance_iso_2_in_warp_min_value").value = 0 ;
        document.getElementById("seam_slippage_resistance_iso_2_in_warp_max_value").value = seam_slippage_resistance_iso_2_in_warp_tolerance_value;
    }

    else
    {
        

        document.getElementById("seam_slippage_resistance_iso_2_in_warp_min_value").value = 0 ;
        document.getElementById("seam_slippage_resistance_iso_2_in_warp_max_value").value = seam_slippage_resistance_iso_2_in_warp_tolerance_value;
    }
}


 function seam_slippage_resistance_iso_2_in_weft_cal()
{
 var seam_slippage_resistance_iso_2_in_weft_tolerance_value = document.getElementById("seam_slippage_resistance_iso_2_in_weft_tolerance_value").value;
    var seam_slippage_resistance_iso_2_in_weft_tolerance_range_math_op = document.getElementById("seam_slippage_resistance_iso_2_in_weft_tolerance_range_math_op").value;

    if (seam_slippage_resistance_iso_2_in_weft_tolerance_range_math_op == '≤') 
    {
        

        document.getElementById("seam_slippage_resistance_iso_2_in_weft_min_value").value = 0 ;
        document.getElementById("seam_slippage_resistance_iso_2_in_weft_max_value").value = seam_slippage_resistance_iso_2_in_weft_tolerance_value;
    }

    

    else
    {
        

       document.getElementById("seam_slippage_resistance_iso_2_in_weft_min_value").value = 0 ;
        document.getElementById("seam_slippage_resistance_iso_2_in_weft_max_value").value = seam_slippage_resistance_iso_2_in_weft_tolerance_value;
    }
}




 function seam_properties_seam_slippage_iso_astm_d_in_warp_cal()
{
 var seam_properties_seam_slippage_iso_astm_d_in_warp_tolerance_value = document.getElementById("seam_properties_seam_slippage_iso_astm_d_in_warp_tolerance_value").value;
    var seam_properties_seam_slippage_iso_astm_d_in_warp_tol_range_mt_op = document.getElementById("seam_properties_seam_slippage_iso_astm_d_in_warp_tol_range_mt_op").value;

    if (seam_properties_seam_slippage_iso_astm_d_in_warp_tol_range_mt_op == '1') 
    {
        

        document.getElementById("seam_properties_seam_slippage_iso_astm_d_in_warp_min_value").value = seam_properties_seam_slippage_iso_astm_d_in_warp_tolerance_value;
        document.getElementById("seam_properties_seam_slippage_iso_astm_d_in_warp_max_value").value = 3000;
    }

    else if (seam_properties_seam_slippage_iso_astm_d_in_warp_tol_range_mt_op == '2') 
    {
        

        document.getElementById("seam_properties_seam_slippage_iso_astm_d_in_warp_min_value").value = seam_properties_seam_slippage_iso_astm_d_in_warp_tolerance_value;
        document.getElementById("seam_properties_seam_slippage_iso_astm_d_in_warp_max_value").value = 3000;
    }
    else if (seam_properties_seam_slippage_iso_astm_d_in_warp_tol_range_mt_op == '3') 
    {
        

        document.getElementById("seam_properties_seam_slippage_iso_astm_d_in_warp_min_value").value = seam_properties_seam_slippage_iso_astm_d_in_warp_tolerance_value;
        document.getElementById("seam_properties_seam_slippage_iso_astm_d_in_warp_max_value").value = 3000;
    }
    else if (seam_properties_seam_slippage_iso_astm_d_in_warp_tol_range_mt_op == '4') 
    {
        

        document.getElementById("seam_properties_seam_slippage_iso_astm_d_in_warp_min_value").value = seam_properties_seam_slippage_iso_astm_d_in_warp_tolerance_value;
        document.getElementById("seam_properties_seam_slippage_iso_astm_d_in_warp_max_value").value = 3000;
    }

    else
    {
        

        document.getElementById("seam_properties_seam_slippage_iso_astm_d_in_warp_min_value").value = seam_properties_seam_slippage_iso_astm_d_in_warp_tolerance_value;
        document.getElementById("seam_properties_seam_slippage_iso_astm_d_in_warp_max_value").value = 3000;
    }
}



function seam_properties_seam_slippage_iso_astm_d_in_weft_cal()
{
 var seam_properties_seam_slippage_iso_astm_d_in_weft_tolerance_value = document.getElementById("seam_properties_seam_slippage_iso_astm_d_in_weft_tolerance_value").value;
    var seam_properties_seam_slippage_iso_astm_d_in_weft_tol_range_mt_op = document.getElementById("seam_properties_seam_slippage_iso_astm_d_in_weft_tol_range_mt_op").value;

    if (seam_properties_seam_slippage_iso_astm_d_in_weft_tol_range_mt_op == '1') 
    {
        

        document.getElementById("seam_properties_seam_slippage_iso_astm_d_in_weft_min_value").value = seam_properties_seam_slippage_iso_astm_d_in_weft_tolerance_value;
        document.getElementById("seam_properties_seam_slippage_iso_astm_d_in_weft_max_value").value = 3000;
    }

    else if (seam_properties_seam_slippage_iso_astm_d_in_weft_tol_range_mt_op == '2') 
    {
        

        document.getElementById("seam_properties_seam_slippage_iso_astm_d_in_weft_min_value").value = seam_properties_seam_slippage_iso_astm_d_in_weft_tolerance_value;
        document.getElementById("seam_properties_seam_slippage_iso_astm_d_in_weft_max_value").value = 3000;
    }
    else if (seam_properties_seam_slippage_iso_astm_d_in_weft_tol_range_mt_op == '3') 
    {
        

        document.getElementById("seam_properties_seam_slippage_iso_astm_d_in_weft_min_value").value = seam_properties_seam_slippage_iso_astm_d_in_weft_tolerance_value;
        document.getElementById("seam_properties_seam_slippage_iso_astm_d_in_weft_max_value").value = 3000;
    }
    else if (seam_properties_seam_slippage_iso_astm_d_in_weft_tol_range_mt_op == '4') 
    {
        

        document.getElementById("seam_properties_seam_slippage_iso_astm_d_in_weft_min_value").value = seam_properties_seam_slippage_iso_astm_d_in_weft_tolerance_value;
        document.getElementById("seam_properties_seam_slippage_iso_astm_d_in_weft_max_value").value = 3000;
    }

    else
    {
        

        document.getElementById("seam_properties_seam_slippage_iso_astm_d_in_weft_min_value").value = seam_properties_seam_slippage_iso_astm_d_in_weft_tolerance_value;
        document.getElementById("seam_properties_seam_slippage_iso_astm_d_in_weft_max_value").value = 3000;
    }
}

function ph_value_cal_without_value()
{
 var ph_value_tolerance_value = document.getElementById("ph_value_tolerance_value").value;
    var ph_value_tolerance_range_math_operator = document.getElementById("ph_value_tolerance_range_math_operator").value;

    if (ph_value_tolerance_range_math_operator == '≥') 
    {
        

        document.getElementById("ph_value_min_value").value = ph_value_tolerance_value;
        document.getElementById("ph_value_max_value").value = 7;
    }
    else if (ph_value_tolerance_range_math_operator == '>') 
    {
        

        document.getElementById("ph_value_min_value").value = parseFloat(ph_value_tolerance_value) + 0.5;
        document.getElementById("ph_value_max_value").value = 7;
    }
    else if (ph_value_tolerance_range_math_operator == '<') 
    {
        

        document.getElementById("ph_value_min_value").value = 5;
        document.getElementById("ph_value_max_value").value = parseFloat(ph_value_tolerance_value) - 0.5;
    }

    else
    {
        

        document.getElementById("ph_value_min_value").value = 5;
        document.getElementById("ph_value_max_value").value = ph_value_tolerance_value;
    }
}


function smoothness_appearance_cal()
{
    var smoothness_appearance_tolerance_value = document.getElementById("smoothness_appearance_tolerance_value").value;
    var smoothness_appearance_tolerance_range_math_op = document.getElementById("smoothness_appearance_tolerance_range_math_op").value;

    if (smoothness_appearance_tolerance_range_math_op == '≥') 
    {
        

        document.getElementById("smoothness_appearance_min_value").value = smoothness_appearance_tolerance_value;
        document.getElementById("smoothness_appearance_max_value").value = 5;
    }

    else if (smoothness_appearance_tolerance_range_math_op == '>') 
    {
        

        document.getElementById("smoothness_appearance_min_value").value = parseFloat(smoothness_appearance_tolerance_value);
        document.getElementById("smoothness_appearance_max_value").value = 5;
    }

    else if (smoothness_appearance_tolerance_range_math_op == '<') 
    {
        

        document.getElementById("smoothness_appearance_min_value").value = 0;
        document.getElementById("smoothness_appearance_max_value").value = parseFloat(smoothness_appearance_tolerance_value) - 1;
    }


    else
    {
        

        document.getElementById("smoothness_appearance_min_value").value = 0;
        document.getElementById("smoothness_appearance_max_value").value = smoothness_appearance_tolerance_value;
    }
}


function iron_ability_of_woven_fabric_cal()
{
 var iron_ability_of_woven_fabric_tolerance_value = document.getElementById("iron_ability_of_woven_fabric_tolerance_value").value;
    var iron_ability_of_woven_fabric_tolerance_range_math_op = document.getElementById("iron_ability_of_woven_fabric_tolerance_range_math_op").value;

    if (iron_ability_of_woven_fabric_tolerance_range_math_op == '≥') 
    {
        

        document.getElementById("iron_ability_of_woven_fabric_min_value").value = iron_ability_of_woven_fabric_tolerance_value;
        document.getElementById("iron_ability_of_woven_fabric_max_value").value = 5;
    }

    else if (iron_ability_of_woven_fabric_tolerance_range_math_op == '>') 
    {
        

        document.getElementById("iron_ability_of_woven_fabric_min_value").value = parseFloat(iron_ability_of_woven_fabric_tolerance_value) ;
        document.getElementById("iron_ability_of_woven_fabric_max_value").value = 5;
    }

    else if (iron_ability_of_woven_fabric_tolerance_range_math_op == '<') 
    {
        

        document.getElementById("iron_ability_of_woven_fabric_min_value").value = 0;
        document.getElementById("iron_ability_of_woven_fabric_max_value").value = parseFloat(iron_ability_of_woven_fabric_tolerance_value) - 1;
    }


    else
    {
        

        document.getElementById("iron_ability_of_woven_fabric_min_value").value = 0;
        document.getElementById("iron_ability_of_woven_fabric_max_value").value = iron_ability_of_woven_fabric_tolerance_value;
    }
}

function percentage_of_total_cotton_content_cal()
{
    
     var percentage_of_total_cotton_content_value = parseFloat(document.getElementById("percentage_of_total_cotton_content_value").value);
      var percentage_of_total_cotton_content_tolerance_value = parseFloat(document.getElementById("percentage_of_total_cotton_content_tolerance_value").value);
      var percentage_of_total_cotton_content_tolerance_range_math_operator = document.getElementById("percentage_of_total_cotton_content_tolerance_range_math_operator").value;

      if (percentage_of_total_cotton_content_tolerance_range_math_operator == '±') 
      {
          
   
          document.getElementById("percentage_of_total_cotton_content_min_value").value = percentage_of_total_cotton_content_value - percentage_of_total_cotton_content_tolerance_value;
          document.getElementById("percentage_of_total_cotton_content_max_value").value = percentage_of_total_cotton_content_value + percentage_of_total_cotton_content_tolerance_value;

      }

      if (percentage_of_total_cotton_content_tolerance_range_math_operator == "+")
      {
          

          document.getElementById("percentage_of_total_cotton_content_min_value").value =percentage_of_total_cotton_content_value;
          document.getElementById("percentage_of_total_cotton_content_max_value").value =  percentage_of_total_cotton_content_value + percentage_of_total_cotton_content_tolerance_value;
      }

      if (percentage_of_total_cotton_content_tolerance_range_math_operator == '-')
      {
          

      
          document.getElementById("percentage_of_total_cotton_content_max_value").value =  percentage_of_total_cotton_content_value;
          document.getElementById("percentage_of_total_cotton_content_min_value").value =  percentage_of_total_cotton_content_value - percentage_of_total_cotton_content_tolerance_value;
      }
}

function percentage_of_total_polyester_content_cal()
{
     var percentage_of_total_polyester_content_value = parseFloat(document.getElementById("percentage_of_total_polyester_content_value").value);
      var percentage_of_total_polyester_content_tolerance_value = parseFloat(document.getElementById("percentage_of_total_polyester_content_tolerance_value").value);
      
      var percentage_of_total_polyester_content_tolerance_range_math_op = document.getElementById("percentage_of_total_polyester_content_tolerance_range_math_op").value;
     

      if (percentage_of_total_polyester_content_tolerance_range_math_op == '±') 
      {
        document.getElementById("percentage_of_total_polyester_content_min_value").value = percentage_of_total_polyester_content_value - percentage_of_total_polyester_content_tolerance_value;
        document.getElementById("percentage_of_total_polyester_content_max_value").value = percentage_of_total_polyester_content_value + percentage_of_total_polyester_content_tolerance_value; 
       
        }

      if (percentage_of_total_polyester_content_tolerance_range_math_op == "+")
      {
          document.getElementById("percentage_of_total_polyester_content_min_value").value = percentage_of_total_polyester_content_value;
          document.getElementById("percentage_of_total_polyester_content_max_value").value = percentage_of_total_polyester_content_value + percentage_of_total_polyester_content_tolerance_value;;
      }

      if (percentage_of_total_polyester_content_tolerance_range_math_op == '-')
      {
          document.getElementById("percentage_of_total_polyester_content_max_value").value = percentage_of_total_polyester_content_value; 
          document.getElementById("percentage_of_total_polyester_content_min_value").value = percentage_of_total_polyester_content_value - percentage_of_total_polyester_content_tolerance_value; 
      }


}

function percentage_of_total_other_fiber_content_cal()
{
     var percentage_of_total_other_fiber_content_value = parseFloat(document.getElementById("percentage_of_total_other_fiber_content_value").value);
      var percentage_of_total_other_fiber_content_tolerance_value = parseFloat(document.getElementById("percentage_of_total_other_fiber_content_tolerance_value").value);
      var percentage_of_total_other_fiber_content_tolerance_range_math_op = document.getElementById("percentage_of_total_other_fiber_content_tolerance_range_math_op").value;

      if (percentage_of_total_other_fiber_content_tolerance_range_math_op == '±') 
      {
          
         
          document.getElementById("percentage_of_total_other_fiber_content_min_value").value = percentage_of_total_other_fiber_content_value - percentage_of_total_other_fiber_content_tolerance_value;
          document.getElementById("percentage_of_total_other_fiber_content_max_value").value =  percentage_of_total_other_fiber_content_value + percentage_of_total_other_fiber_content_tolerance_value;
      }

      if (percentage_of_total_other_fiber_content_tolerance_range_math_op == "+")
      {
          

          document.getElementById("percentage_of_total_other_fiber_content_min_value").value = percentage_of_total_other_fiber_content_value;
          document.getElementById("percentage_of_total_other_fiber_content_max_value").value = percentage_of_total_other_fiber_content_value + percentage_of_total_other_fiber_content_tolerance_value;
      }

      if (percentage_of_total_other_fiber_content_tolerance_range_math_op == '-')
      {
          


          document.getElementById("percentage_of_total_other_fiber_content_max_value").value = percentage_of_total_other_fiber_content_value;

          document.getElementById("percentage_of_total_other_fiber_content_min_value").value = percentage_of_total_other_fiber_content_value - percentage_of_total_other_fiber_content_tolerance_value; 
      }

}
function percentage_of_total_other_fiber_content_1_cal()
{
  
     var percentage_of_total_other_fiber_content_1_value = parseFloat(document.getElementById("percentage_of_total_other_fiber_content_1_value").value);
      var percentage_of_total_other_fiber_content_1_tolerance_value = parseFloat(document.getElementById("percentage_of_total_other_fiber_content_1_tolerance_value").value);
      var percentage_of_total_other_fiber_content_1_tol_range_math_op = document.getElementById("percentage_of_total_other_fiber_content_1_tol_range_math_op").value;
      
      if (percentage_of_total_other_fiber_content_1_tol_range_math_op == '±') 
      {
       
          document.getElementById("percentage_of_total_other_fiber_content_1_min_value").value =  percentage_of_total_other_fiber_content_1_value - percentage_of_total_other_fiber_content_1_tolerance_value; 
          document.getElementById("percentage_of_total_other_fiber_content_1_max_value").value = percentage_of_total_other_fiber_content_1_value + percentage_of_total_other_fiber_content_1_tolerance_value;
      }

      if (percentage_of_total_other_fiber_content_1_tol_range_math_op == "+")
      {
      
          document.getElementById("percentage_of_total_other_fiber_content_1_min_value").value = percentage_of_total_other_fiber_content_1_value;
          document.getElementById("percentage_of_total_other_fiber_content_1_max_value").value =  percentage_of_total_other_fiber_content_1_value + percentage_of_total_other_fiber_content_1_tolerance_value;
      }

      if (percentage_of_total_other_fiber_content_1_tol_range_math_op == '-')
      {

          document.getElementById("percentage_of_total_other_fiber_content_1_max_value").value = percentage_of_total_other_fiber_content_1_value;

          document.getElementById("percentage_of_total_other_fiber_content_1_min_value").value = percentage_of_total_other_fiber_content_1_value - percentage_of_total_other_fiber_content_1_tolerance_value;  
      }

}

function percentage_of_warp_cotton_content_cal()
{
     var percentage_of_warp_cotton_content_value = parseFloat(document.getElementById("percentage_of_warp_cotton_content_value").value);
      var percentage_of_warp_cotton_content_tolerance_value = parseFloat(document.getElementById("percentage_of_warp_cotton_content_tolerance_value").value);
      var percentage_of_warp_cotton_content_tolerance_range_math_operator = document.getElementById("percentage_of_warp_cotton_content_tolerance_range_math_operator").value;

      if (percentage_of_warp_cotton_content_tolerance_range_math_operator == '±') 
      {
          

          document.getElementById("percentage_of_warp_cotton_content_min_value").value = percentage_of_warp_cotton_content_value - percentage_of_warp_cotton_content_tolerance_value; 
          document.getElementById("percentage_of_warp_cotton_content_max_value").value = percentage_of_warp_cotton_content_value + percentage_of_warp_cotton_content_tolerance_value;
      }

      if (percentage_of_warp_cotton_content_tolerance_range_math_operator == "+")
      {
          


          document.getElementById("percentage_of_warp_cotton_content_min_value").value = percentage_of_warp_cotton_content_value;
          document.getElementById("percentage_of_warp_cotton_content_max_value").value = percentage_of_warp_cotton_content_value + percentage_of_warp_cotton_content_tolerance_value;
      }

      if (percentage_of_warp_cotton_content_tolerance_range_math_operator == '-')
      {
          


          document.getElementById("percentage_of_warp_cotton_content_max_value").value = percentage_of_warp_cotton_content_value;

          document.getElementById("percentage_of_warp_cotton_content_min_value").value = percentage_of_warp_cotton_content_value- percentage_of_warp_cotton_content_tolerance_value; 
      }

}

function percentage_of_warp_polyester_content_cal()
{
     var percentage_of_warp_polyester_content_value = parseFloat(document.getElementById("percentage_of_warp_polyester_content_value").value);
      var percentage_of_warp_polyester_content_tolerance_value = parseFloat(document.getElementById("percentage_of_warp_polyester_content_tolerance_value").value);
      var percentage_of_warp_polyester_content_tolerance_range_math_op = document.getElementById("percentage_of_warp_polyester_content_tolerance_range_math_op").value;

      if (percentage_of_warp_polyester_content_tolerance_range_math_op == '±') 
      {
          


          document.getElementById("percentage_of_warp_polyester_content_min_value").value = percentage_of_warp_polyester_content_value - percentage_of_warp_polyester_content_tolerance_value; 
          document.getElementById("percentage_of_warp_polyester_content_max_value").value =  percentage_of_warp_polyester_content_value + percentage_of_warp_polyester_content_tolerance_value;
      }

      if (percentage_of_warp_polyester_content_tolerance_range_math_op == "+")
      {
          


          document.getElementById("percentage_of_warp_polyester_content_min_value").value = percentage_of_warp_polyester_content_value;
          document.getElementById("percentage_of_warp_polyester_content_max_value").value =  percentage_of_warp_polyester_content_value + percentage_of_warp_polyester_content_tolerance_value;
      }

      if (percentage_of_warp_polyester_content_tolerance_range_math_op == '-')
      {
          

          document.getElementById("percentage_of_warp_polyester_content_min_value").value =  percentage_of_warp_polyester_content_value;

          document.getElementById("percentage_of_warp_polyester_content_max_value").value = percentage_of_warp_polyester_content_value - percentage_of_warp_polyester_content_tolerance_value;
      }

}


function percentage_of_warp_other_fiber_content_cal()
{
     var percentage_of_warp_other_fiber_content_value = parseFloat(document.getElementById("percentage_of_warp_other_fiber_content_value").value);
      var percentage_of_warp_other_fiber_content_tolerance_value = parseFloat(document.getElementById("percentage_of_warp_other_fiber_content_tolerance_value").value);
      var percentage_of_warp_other_fiber_content_tolerance_range_math_op = document.getElementById("percentage_of_warp_other_fiber_content_tolerance_range_math_op").value;

      if (percentage_of_warp_other_fiber_content_tolerance_range_math_op == '±') 
      {
          


          document.getElementById("percentage_of_warp_other_fiber_content_min_value").value = percentage_of_warp_other_fiber_content_value - percentage_of_warp_other_fiber_content_tolerance_value;
          document.getElementById("percentage_of_warp_other_fiber_content_max_value").value = percentage_of_warp_other_fiber_content_value + percentage_of_warp_other_fiber_content_tolerance_value; 
      }

      if (percentage_of_warp_other_fiber_content_tolerance_range_math_op == "+")
      {
          



          document.getElementById("percentage_of_warp_other_fiber_content_min_value").value = percentage_of_warp_other_fiber_content_value;
          document.getElementById("percentage_of_warp_other_fiber_content_max_value").value =percentage_of_warp_other_fiber_content_value + percentage_of_warp_other_fiber_content_tolerance_value;
      }

      if (percentage_of_warp_other_fiber_content_tolerance_range_math_op == '-')
      {
          



          document.getElementById("percentage_of_warp_other_fiber_content_max_value").value = percentage_of_warp_other_fiber_content_value;


          document.getElementById("percentage_of_warp_other_fiber_content_min_value").value = percentage_of_warp_other_fiber_content_value - percentage_of_warp_other_fiber_content_tolerance_value; 
      }

}

function percentage_of_warp_other_fiber_content_1_cal()
{
     var percentage_of_warp_other_fiber_content_1_value = parseFloat(document.getElementById("percentage_of_warp_other_fiber_content_1_value").value);
      var percentage_of_warp_other_fiber_content_1_tolerance_value = parseFloat(document.getElementById("percentage_of_warp_other_fiber_content_1_tolerance_value").value);
      var percentage_of_warp_other_fiber_content_1_tolerance_range_math_op = document.getElementById("percentage_of_warp_other_fiber_content_1_tolerance_range_math_op").value;

      if (percentage_of_warp_other_fiber_content_1_tolerance_range_math_op == '±') 
      {


          document.getElementById("percentage_of_warp_other_fiber_content_1_min_value").value = percentage_of_warp_other_fiber_content_1_value - percentage_of_warp_other_fiber_content_1_tolerance_value;
          document.getElementById("percentage_of_warp_other_fiber_content_1_max_value").value = percentage_of_warp_other_fiber_content_1_value + percentage_of_warp_other_fiber_content_1_tolerance_value; 
      }

      if (percentage_of_warp_other_fiber_content_1_tolerance_range_math_op == "+")
      {
          



          document.getElementById("percentage_of_warp_other_fiber_content_1_min_value").value = percentage_of_warp_other_fiber_content_1_value;
          document.getElementById("percentage_of_warp_other_fiber_content_1_max_value").value =percentage_of_warp_other_fiber_content_1_value + percentage_of_warp_other_fiber_content_1_tolerance_value;
      }

      if (percentage_of_warp_other_fiber_content_1_tolerance_range_math_op == '-')
      {


          document.getElementById("percentage_of_warp_other_fiber_content_1_max_value").value = percentage_of_warp_other_fiber_content_1_value;

           
          document.getElementById("percentage_of_warp_other_fiber_content_1_min_value").value = percentage_of_warp_other_fiber_content_1_value - percentage_of_warp_other_fiber_content_1_tolerance_value; 
      }

}




function percentage_of_weft_cotton_content_cal()
{
     var percentage_of_weft_cotton_content_value = parseFloat(document.getElementById("percentage_of_weft_cotton_content_value").value);
      var percentage_of_weft_cotton_content_tolerance_value = parseFloat(document.getElementById("percentage_of_weft_cotton_content_tolerance_value").value);
      var percentage_of_weft_cotton_content_tolerance_range_math_op = document.getElementById("percentage_of_weft_cotton_content_tolerance_range_math_op").value;

      if (percentage_of_weft_cotton_content_tolerance_range_math_op == '±') 
      {


          document.getElementById("percentage_of_weft_cotton_content_min_value").value = percentage_of_weft_cotton_content_value - percentage_of_weft_cotton_content_tolerance_value;
          document.getElementById("percentage_of_weft_cotton_content_max_value").value =  percentage_of_weft_cotton_content_value + percentage_of_weft_cotton_content_tolerance_value; 
      }

      if (percentage_of_weft_cotton_content_tolerance_range_math_op == "+")
      {


          document.getElementById("percentage_of_weft_cotton_content_min_value").value = percentage_of_weft_cotton_content_value;
          document.getElementById("percentage_of_weft_cotton_content_max_value").value = percentage_of_weft_cotton_content_value + percentage_of_weft_cotton_content_tolerance_value;
      }

      if (percentage_of_weft_cotton_content_tolerance_range_math_op == '-')
      {
          


          document.getElementById("percentage_of_weft_cotton_content_max_value").value = percentage_of_weft_cotton_content_value;

          document.getElementById("percentage_of_weft_cotton_content_min_value").value = percentage_of_weft_cotton_content_value - percentage_of_weft_cotton_content_tolerance_value;
      }

}

function percentage_of_weft_polyester_content_cal()
{
     var percentage_of_weft_polyester_content_value = parseFloat(document.getElementById("percentage_of_weft_polyester_content_value").value);
      var percentage_of_weft_polyester_content_tolerance_value = parseFloat(document.getElementById("percentage_of_weft_polyester_content_tolerance_value").value);
      var percentage_of_weft_polyester_content_tolerance_range_math_op = document.getElementById("percentage_of_weft_polyester_content_tolerance_range_math_op").value;

      if (percentage_of_weft_polyester_content_tolerance_range_math_op == '±') 
      {
          


          document.getElementById("percentage_of_weft_polyester_content_min_value").value = percentage_of_weft_polyester_content_value - percentage_of_weft_polyester_content_tolerance_value;  
          document.getElementById("percentage_of_weft_polyester_content_max_value").value = percentage_of_weft_polyester_content_value + percentage_of_weft_polyester_content_tolerance_value;
      }

      if (percentage_of_weft_polyester_content_tolerance_range_math_op == "+")
      {
          


          document.getElementById("percentage_of_weft_polyester_content_min_value").value = percentage_of_weft_polyester_content_value;
          document.getElementById("percentage_of_weft_polyester_content_max_value").value = percentage_of_weft_polyester_content_value + percentage_of_weft_polyester_content_tolerance_value;
      }

      if (percentage_of_weft_polyester_content_tolerance_range_math_op == '-')
      {
          

         

          document.getElementById("percentage_of_weft_polyester_content_max_value").value = percentage_of_weft_polyester_content_value;

          
          document.getElementById("percentage_of_weft_polyester_content_min_value").value = percentage_of_weft_polyester_content_value - percentage_of_weft_polyester_content_tolerance_value; 
      }

}


function percentage_of_weft_other_fiber_content_cal()
{
     var percentage_of_weft_other_fiber_content_value = parseFloat(document.getElementById("percentage_of_weft_other_fiber_content_value").value);
      var percentage_of_weft_other_fiber_content_tolerance_value = parseFloat(document.getElementById("percentage_of_weft_other_fiber_content_tolerance_value").value);
      var percentage_of_weft_other_fiber_content_tolerance_range_math_op = document.getElementById("percentage_of_weft_other_fiber_content_tolerance_range_math_op").value;

      if (percentage_of_weft_other_fiber_content_tolerance_range_math_op == '±') 
      {

          document.getElementById("percentage_of_weft_other_fiber_content_min_value").value =  percentage_of_weft_other_fiber_content_value - percentage_of_weft_other_fiber_content_tolerance_value;
          document.getElementById("percentage_of_weft_other_fiber_content_max_value").value = percentage_of_weft_other_fiber_content_value + percentage_of_weft_other_fiber_content_tolerance_value;
      }

      if (percentage_of_weft_other_fiber_content_tolerance_range_math_op == "+")
      {
          



          document.getElementById("percentage_of_weft_other_fiber_content_min_value").value = percentage_of_weft_other_fiber_content_value;
          document.getElementById("percentage_of_weft_other_fiber_content_max_value").value = percentage_of_weft_other_fiber_content_value + percentage_of_weft_other_fiber_content_tolerance_value;
      }

      if (percentage_of_weft_other_fiber_content_tolerance_range_math_op == '-')
      {
          



          document.getElementById("percentage_of_weft_other_fiber_content_max_value").value = percentage_of_weft_other_fiber_content_value;

          document.getElementById("percentage_of_weft_other_fiber_content_min_value").value = percentage_of_weft_other_fiber_content_value - percentage_of_weft_other_fiber_content_tolerance_value; 
      }

}


function percentage_of_weft_other_fiber_content_1_cal()
{
     var percentage_of_weft_other_fiber_content_1_value = parseFloat(document.getElementById("percentage_of_weft_other_fiber_content_1_value").value);
      var percentage_of_weft_other_fiber_content_1_tolerance_value = parseFloat(document.getElementById("percentage_of_weft_other_fiber_content_1_tolerance_value").value);
      var percentage_of_weft_other_fiber_content_1_tolerance_range_math_op = document.getElementById("percentage_of_weft_other_fiber_content_1_tolerance_range_math_op").value;

      if (percentage_of_weft_other_fiber_content_1_tolerance_range_math_op == '±') 
      {


          document.getElementById("percentage_of_weft_other_fiber_content_1_min_value").value =  percentage_of_weft_other_fiber_content_1_value - percentage_of_weft_other_fiber_content_1_tolerance_value;
          document.getElementById("percentage_of_weft_other_fiber_content_1_max_value").value = percentage_of_weft_other_fiber_content_1_value + percentage_of_weft_other_fiber_content_1_tolerance_value;
      }

      if (percentage_of_weft_other_fiber_content_1_tolerance_range_math_op == "+")
      {
          


          document.getElementById("percentage_of_weft_other_fiber_content_1_min_value").value = percentage_of_weft_other_fiber_content_1_value;
          document.getElementById("percentage_of_weft_other_fiber_content_1_max_value").value = percentage_of_weft_other_fiber_content_1_value + percentage_of_weft_other_fiber_content_1_tolerance_value;
      }

      if (percentage_of_weft_other_fiber_content_1_tolerance_range_math_op == '-')
      {
          



          document.getElementById("percentage_of_weft_other_fiber_content_1_max_value").value = percentage_of_weft_other_fiber_content_1_value; 
          
          document.getElementById("percentage_of_weft_other_fiber_content_1_min_value").value = percentage_of_weft_other_fiber_content_1_value - percentage_of_weft_other_fiber_content_1_tolerance_value;
      }

}

//End OF Finishing,Washing,steaming,Singe & Desize



function absorbency_cal()
{
     var absorbency_value = parseFloat(document.getElementById("absorbency_value").value);
      var absorbency_tolerance_value = parseFloat(document.getElementById("absorbency_tolerance_value").value);
      var absorbency_tolerance_range_math_operator = document.getElementById("absorbency_tolerance_range_math_operator").value;

      if (absorbency_tolerance_range_math_operator == '±') 
      {
          
          var tolarance = ((absorbency_tolerance_value * absorbency_value) / 100);
          var absorbency_max_tol_cal_value2 = absorbency_value + tolarance;
          var absorbency_max_tol_cal_value1 = absorbency_value - tolarance;

          document.getElementById("absorbency_min_value").value = absorbency_max_tol_cal_value1.toFixed(5);
          document.getElementById("absorbency_max_value").value = absorbency_max_tol_cal_value2.toFixed(5);
      }

      if (absorbency_tolerance_range_math_operator == "+")
      {
          

          var tolarance = ((absorbency_tolerance_value * absorbency_value) / 100);
          var absorbency_max_tol_cal_value2 = absorbency_value + tolarance;

          document.getElementById("absorbency_min_value").value = absorbency_value;
          document.getElementById("absorbency_max_value").value = absorbency_max_tol_cal_value2.toFixed(5);
      }

      if (absorbency_tolerance_range_math_operator == '-')
      {
          

          var tolarance = ((absorbency_tolerance_value * absorbency_value) / 100);
          var absorbency_max_tol_cal_value2 = absorbency_value - tolarance;

          document.getElementById("absorbency_max_value").value = absorbency_value;
          document.getElementById("absorbency_min_value").value = absorbency_max_tol_cal_value2.toFixed(5);
      }

}

function residual_residual_sizing_material_material_cal()
{
     var residual_residual_sizing_material_material_value = parseFloat(document.getElementById("residual_residual_sizing_material_material_value").value);
      var residual_residual_sizing_material_material_tolerance_value = parseFloat(document.getElementById("residual_residual_sizing_material_material_tolerance_value").value);
      var residual_residual_sizing_material_material_tolerance_range_math_operator = document.getElementById("residual_residual_sizing_material_material_tolerance_range_math_operator").value;

      if (residual_residual_sizing_material_material_tolerance_range_math_operator == '±') 
      {
          
          var tolarance = ((residual_residual_sizing_material_material_tolerance_value * residual_residual_sizing_material_material_value) / 100);
          var residual_tol_cal_value2 = residual_residual_sizing_material_material_value + tolarance;
          var residual_tol_cal_value1 = residual_residual_sizing_material_material_value - tolarance;

          document.getElementById("residual_residual_sizing_material_material_min_value").value = residual_tol_cal_value1.toFixed(5);
          document.getElementById("residual_residual_sizing_material_material_max_value").value = residual_tol_cal_value2.toFixed(5);
      }

      if (residual_residual_sizing_material_material_tolerance_range_math_operator == "+")
      {
          

          var tolarance = ((residual_residual_sizing_material_material_tolerance_value * residual_residual_sizing_material_material_value) / 100);
          var residual_tol_cal_value2 = residual_residual_sizing_material_material_value + tolarance;

          document.getElementById("residual_residual_sizing_material_material_min_value").value = residual_residual_sizing_material_material_value;
          document.getElementById("residual_residual_sizing_material_material_max_value").value = residual_tol_cal_value2.toFixed(5);
      }

      if (residual_residual_sizing_material_material_tolerance_range_math_operator == '-')
      {
          

          var tolarance = ((residual_residual_sizing_material_material_tolerance_value * residual_residual_sizing_material_material_value) / 100);
          var residual_tol_cal_value2 = residual_residual_sizing_material_material_value - tolarance;

          document.getElementById("residual_residual_sizing_material_material_max_value").value = residual_residual_sizing_material_material_value;
          document.getElementById("residual_residual_sizing_material_material_min_value").value = residual_tol_cal_value2.toFixed(5);
      }

}

function whiteness_cal()
{
     var whiteness_value = parseFloat(document.getElementById("whiteness_value").value);
      var whiteness_tolerance_value = parseFloat(document.getElementById("whiteness_tolerance_value").value);
      var whiteness_tolerance_range_math_operator = document.getElementById("whiteness_tolerance_range_math_operator").value;

      if (whiteness_tolerance_range_math_operator == '±') 
      {
          
          var tolarance = ((whiteness_tolerance_value * whiteness_value) / 100);
          var tol_cal_value2 = whiteness_value + tolarance;
          var tol_cal_value1 = whiteness_value - tolarance;

          document.getElementById("whiteness_min_value").value = tol_cal_value1.toFixed(5);
          document.getElementById("whiteness_max_value").value = tol_cal_value2.toFixed(5);
      }

      if (whiteness_tolerance_range_math_operator == "+")
      {
          

          var tolarance = ((whiteness_tolerance_value * whiteness_value) / 100);
          var tol_cal_value2 = whiteness_value + tolarance;

          document.getElementById("whiteness_min_value").value = whiteness_value;
          document.getElementById("whiteness_max_value").value = tol_cal_value2.toFixed(5);
      }

      if (whiteness_tolerance_range_math_operator == '-')
      {
          

          var tolarance = ((whiteness_tolerance_value * whiteness_value) / 100);
          var tol_cal_value2 = whiteness_value - tolarance;

          document.getElementById("whiteness_max_value").value = whiteness_value;
          document.getElementById("whiteness_min_value").value = tol_cal_value2.toFixed(5);
      }

}

function pilling_iso_12945_2_cal()
{
     var pilling_iso_12945_2_value = parseFloat(document.getElementById("pilling_iso_12945_2_value").value);
      var pilling_iso_12945_2_tolerance_value = parseFloat(document.getElementById("pilling_iso_12945_2_tolerance_value").value);
      var pilling_iso_12945_2_tolerance_range_math_operator = document.getElementById("pilling_iso_12945_2_tolerance_range_math_operator").value;

      if (pilling_iso_12945_2_tolerance_range_math_operator == '±') 
      {
          
          var tolarance = ((pilling_iso_12945_2_tolerance_value * pilling_iso_12945_2_value) / 100);
          var tol_cal_value2 = pilling_iso_12945_2_value + tolarance;
          var tol_cal_value1 = pilling_iso_12945_2_value - tolarance;

          document.getElementById("pilling_iso_12945_2_min_value").value = tol_cal_value1.toFixed(5);
          document.getElementById("pilling_iso_12945_2_max_value").value = tol_cal_value2.toFixed(5);
      }

      if (pilling_iso_12945_2_tolerance_range_math_operator == "+")
      {
          

          var tolarance = ((pilling_iso_12945_2_tolerance_value * pilling_iso_12945_2_value) / 100);
          var tol_cal_value2 = pilling_iso_12945_2_value + tolarance;

          document.getElementById("pilling_iso_12945_2_min_value").value = pilling_iso_12945_2_value;
          document.getElementById("pilling_iso_12945_2_max_value").value = tol_cal_value2.toFixed(5);
      }

      if (pilling_iso_12945_2_tolerance_range_math_operator == '-')
      {
          

          var tolarance = ((pilling_iso_12945_2_tolerance_value * pilling_iso_12945_2_value) / 100);
          var tol_cal_value2 = pilling_iso_12945_2_value - tolarance;

          document.getElementById("pilling_iso_12945_2_max_value").value = pilling_iso_12945_2_value;
          document.getElementById("pilling_iso_12945_2_min_value").value = tol_cal_value2.toFixed(5);
      }

}

function ph_value_cal()
{
     var ph_value = parseFloat(document.getElementById("ph_value").value);
      var bath_ph_tolerance_value = parseFloat(document.getElementById("bath_ph_tolerance_value").value);
      var ph_tolerance_range_math_operator = document.getElementById("ph_tolerance_range_math_operator").value;

      if (ph_tolerance_range_math_operator == '±') 
      {
          
          var tolarance = ((bath_ph_tolerance_value * ph_value) / 100);
          var tol_cal_value2 = ph_value + tolarance;
          var tol_cal_value1 = ph_value - tolarance;

          document.getElementById("bath_ph_min_value").value = tol_cal_value1.toFixed(5);
          document.getElementById("bath_ph_max_value").value = tol_cal_value2.toFixed(5);
      }

      if (ph_tolerance_range_math_operator == "+")
      {
          

          var tolarance = ((bath_ph_tolerance_value * ph_value) / 100);
          var tol_cal_value2 = ph_value + tolarance;

          document.getElementById("bath_ph_min_value").value = ph_value;
          document.getElementById("bath_ph_max_value").value = tol_cal_value2.toFixed(5);
      }

      if (ph_tolerance_range_math_operator == '-')
      {
          

          var tolarance = ((bath_ph_tolerance_value * ph_value) / 100);
          var tol_cal_value2 = ph_value - tolarance;

          document.getElementById("bath_ph_max_value").value = ph_value;
          document.getElementById("bath_ph_min_value").value = tol_cal_value2.toFixed(5);
      }

}


function whiteness_cal_equalize()
{
     var whiteness_value = parseFloat(document.getElementById("whiteness_value").value);
      var whiteness_tolerance_value_in_percentage = parseFloat(document.getElementById("whiteness_tolerance_value_in_percentage").value);
      var whiteness_tolerance_range_math_operator = document.getElementById("whiteness_tolerance_range_math_operator").value;

      if (whiteness_tolerance_range_math_operator == '±') 
      {
          
          var tolarance = ((whiteness_tolerance_value_in_percentage * whiteness_value) / 100);
          var tol_cal_value2 = whiteness_value + tolarance;
          var tol_cal_value1 = whiteness_value - tolarance;

          document.getElementById("whiteness_min_value").value = tol_cal_value1.toFixed(5);
          document.getElementById("whiteness_max_value").value = tol_cal_value2.toFixed(5);
      }

      if (whiteness_tolerance_range_math_operator == "+")
      {
          

          var tolarance = ((whiteness_tolerance_value_in_percentage * whiteness_value) / 100);
          var tol_cal_value2 = whiteness_value + tolarance;

          document.getElementById("whiteness_min_value").value = whiteness_value;
          document.getElementById("whiteness_max_value").value = tol_cal_value2.toFixed(5);
      }

      if (whiteness_tolerance_range_math_operator == '-')
      {
          

          var tolarance = ((whiteness_tolerance_value_in_percentage * whiteness_value) / 100);
          var tol_cal_value2 = whiteness_value - tolarance;

          document.getElementById("whiteness_max_value").value = whiteness_value;
          document.getElementById("whiteness_min_value").value = tol_cal_value2.toFixed(5);
      }

}

function bowing_and_skew_cal()
{
     var bowing_and_skew_value = parseFloat(document.getElementById("bowing_and_skew_value").value);
      var bowing_and_skew_tolerance_value_in_percentage = parseFloat(document.getElementById("bowing_and_skew_tolerance_value_in_percentage").value);
      var bowing_and_skew_tolerance_range_math_operator = document.getElementById("bowing_and_skew_tolerance_range_math_operator").value;

      if (bowing_and_skew_tolerance_range_math_operator == '±') 
      {
          
          var tolarance = ((bowing_and_skew_tolerance_value_in_percentage * bowing_and_skew_value) / 100);
          var tol_cal_value2 = bowing_and_skew_value + tolarance;
          var tol_cal_value1 = bowing_and_skew_value - tolarance;

          document.getElementById("bowing_and_skew_min_value").value = tol_cal_value1.toFixed(5);
          document.getElementById("bowing_and_skew_max_value").value = tol_cal_value2.toFixed(5);
      }

      if (bowing_and_skew_tolerance_range_math_operator == "+")
      {
          

          var tolarance = ((bowing_and_skew_tolerance_value_in_percentage * bowing_and_skew_value) / 100);
          var tol_cal_value2 = bowing_and_skew_value + tolarance;

          document.getElementById("bowing_and_skew_min_value").value = bowing_and_skew_value;
          document.getElementById("bowing_and_skew_max_value").value = tol_cal_value2.toFixed(5);
      }

      if (bowing_and_skew_tolerance_range_math_operator == '-')
      {
          

          var tolarance = ((bowing_and_skew_tolerance_value_in_percentage * bowing_and_skew_value) / 100);
          var tol_cal_value2 = bowing_and_skew_value - tolarance;

          document.getElementById("bowing_and_skew_max_value").value = bowing_and_skew_value;
          document.getElementById("bowing_and_skew_min_value").value = tol_cal_value2.toFixed(5);
      }

}


function bowing_and_skew_cal_for_iso()
{
    var bowing_and_skew_tolerance_value = document.getElementById("bowing_and_skew_tolerance_value").value;
    var bowing_and_skew_tolerance_range_math_operator = document.getElementById("bowing_and_skew_tolerance_range_math_operator").value;

    if (bowing_and_skew_tolerance_range_math_operator == '≥') 
    {
        document.getElementById("bowing_and_skew_min_value").value = bowing_and_skew_tolerance_value;
        document.getElementById("bowing_and_skew_max_value").value = 5;
    }

    else if (bowing_and_skew_tolerance_range_math_operator == '>') 
    {
        

        document.getElementById("bowing_and_skew_min_value").value = parseFloat(bowing_and_skew_tolerance_value) + 1;
        document.getElementById("bowing_and_skew_max_value").value = 5;
    }

    else if (bowing_and_skew_tolerance_range_math_operator == '<') 
    {
        

        document.getElementById("bowing_and_skew_min_value").value = 0;
        document.getElementById("bowing_and_skew_max_value").value =  parseFloat(bowing_and_skew_tolerance_value) - 1;
    }

    else
    {
        

        document.getElementById("bowing_and_skew_min_value").value = 0;
        document.getElementById("bowing_and_skew_max_value").value = bowing_and_skew_tolerance_value;
    }
}

function ph_value_equalize_cal()
{
     var ph_value = parseFloat(document.getElementById("ph_value").value);
      var bath_ph_tolerance_value_in_percentage = parseFloat(document.getElementById("bath_ph_tolerance_value_in_percentage").value);
      var ph_tolerance_range_math_operator = document.getElementById("ph_tolerance_range_math_operator").value;

      if (ph_tolerance_range_math_operator == '±') 
      {
          
          var tolarance = ((bath_ph_tolerance_value_in_percentage * ph_value) / 100);
          var tol_cal_value2 = ph_value + tolarance;
          var tol_cal_value1 = ph_value - tolarance;

          document.getElementById("bath_ph_min_value").value = tol_cal_value1.toFixed(5);
          document.getElementById("bath_ph_max_value").value = tol_cal_value2.toFixed(5);
      }

      if (ph_tolerance_range_math_operator == "+")
      {
          

          var tolarance = ((bath_ph_tolerance_value_in_percentage * ph_value) / 100);
          var tol_cal_value2 = ph_value + tolarance;

          document.getElementById("bath_ph_min_value").value = ph_value;
          document.getElementById("bath_ph_max_value").value = tol_cal_value2.toFixed(5);
      }

      if (ph_tolerance_range_math_operator == '-')
      {
          

          var tolarance = ((bath_ph_tolerance_value_in_percentage * ph_value) / 100);
          var tol_cal_value2 = ph_value - tolarance;

          document.getElementById("bath_ph_max_value").value = ph_value;
          document.getElementById("bath_ph_min_value").value = tol_cal_value2.toFixed(5);
      }

}

function rubbing_dry_cal()
{
 var rubbing_dry_tolerance_value = document.getElementById("rubbing_dry_tolerance_value").value;
    var rubbing_dry_tolerance_range_math_operator = document.getElementById("rubbing_dry_tolerance_range_math_operator").value;

    if (rubbing_dry_tolerance_range_math_operator == '≥' ) 
    {
        

        document.getElementById("rubbing_dry_min_value").value = rubbing_dry_tolerance_value;
        document.getElementById("rubbing_dry_max_value").value = 5;
    }
    else if (rubbing_dry_tolerance_range_math_operator == '>' ) 
    {
        

        document.getElementById("rubbing_dry_min_value").value = parseFloat(rubbing_dry_tolerance_value)+0.5;
        document.getElementById("rubbing_dry_max_value").value = 5;
    }

     else if (rubbing_dry_tolerance_range_math_operator == '<' ) 
    {
        

        document.getElementById("rubbing_dry_min_value").value = 0;
        document.getElementById("rubbing_dry_max_value").value = parseFloat(rubbing_dry_tolerance_value)-0.5;
    }

    else
    {
        

        document.getElementById("rubbing_dry_min_value").value = 0;
        document.getElementById("rubbing_dry_max_value").value = rubbing_dry_tolerance_value;
    }
}

function rubbing_wet_cal()
{
 var rubbing_wet_tolerance_value = document.getElementById("rubbing_wet_tolerance_value").value;
    var rubbing_wet_tolerance_range_math_operator = document.getElementById("rubbing_wet_tolerance_range_math_operator").value;

    if (rubbing_wet_tolerance_range_math_operator == '≥') 
    {
        

        document.getElementById("rubbing_wet_min_value").value = rubbing_wet_tolerance_value;
        document.getElementById("rubbing_wet_max_value").value = 5;
    }

    else if (rubbing_wet_tolerance_range_math_operator == '>') 
    {
        

        document.getElementById("rubbing_wet_min_value").value = parseFloat(rubbing_wet_tolerance_value)+0.5;
        document.getElementById("rubbing_wet_max_value").value = 5;
    }
     else if (rubbing_wet_tolerance_range_math_operator == '<') 
    {
        

        document.getElementById("rubbing_wet_min_value").value = 0;
        document.getElementById("rubbing_wet_max_value").value = parseFloat(rubbing_wet_tolerance_value)-0.5;
    }

    else
    {
        

        document.getElementById("rubbing_wet_min_value").value = 0;
        document.getElementById("rubbing_wet_max_value").value = rubbing_wet_tolerance_value;
    }
}
//Raising Process and Ready For Raising Process

function residual_sizing_material_cal()
{
     var residual_sizing_material_value = parseFloat(document.getElementById("residual_sizing_material_value").value);
      var residual_sizing_material_tolerance_value = parseFloat(document.getElementById("residual_sizing_material_tolerance_value").value);
      var residual_sizing_material_tolerance_range_math_operator = document.getElementById("residual_sizing_material_tolerance_range_math_operator").value;

      if (residual_sizing_material_tolerance_range_math_operator == '±') 
      {
          
          var tolarance = ((residual_sizing_material_tolerance_value * residual_sizing_material_value) / 100);
          var tol_cal_value2 = residual_sizing_material_value + tolarance;
          var tol_cal_value1 = residual_sizing_material_value - tolarance;

          document.getElementById("residual_sizing_material_min_value").value = tol_cal_value1.toFixed(5);
          document.getElementById("residual_sizing_material_max_value").value = tol_cal_value2.toFixed(5);
      }

      if (residual_sizing_material_tolerance_range_math_operator == "+")
      {
          

          var tolarance = ((residual_sizing_material_tolerance_value * residual_sizing_material_value) / 100);
          var tol_cal_value2 = residual_sizing_material_value + tolarance;

          document.getElementById("residual_sizing_material_min_value").value = residual_sizing_material_value;
          document.getElementById("residual_sizing_material_max_value").value = tol_cal_value2.toFixed(5);
      }

      if (residual_sizing_material_tolerance_range_math_operator == '-')
      {
          

          var tolarance = ((residual_sizing_material_tolerance_value * residual_sizing_material_value) / 100);
          var tol_cal_value2 = residual_sizing_material_value - tolarance;

          document.getElementById("residual_sizing_material_max_value").value = residual_sizing_material_value;
          document.getElementById("residual_sizing_material_min_value").value = tol_cal_value2.toFixed(5);
      }

}


function greige_width_cal()
{
     var greige_width_value = parseFloat(document.getElementById("greige_width_value").value);
      var greige_width_tolerance_value = parseFloat(document.getElementById("greige_width_tolerance_value").value);
      var greige_width_range_math_operator = document.getElementById("greige_width_range_math_operator").value;

      if (greige_width_range_math_operator == '±') 
      {
          
         

          document.getElementById("greige_width_min_value").value = greige_width_value - greige_width_tolerance_value;
          document.getElementById("greige_width_max_value").value =  greige_width_value + greige_width_tolerance_value;
      }

      if (greige_width_range_math_operator == "+")
      {
        
          document.getElementById("greige_width_min_value").value = greige_width_value;
          document.getElementById("greige_width_max_value").value =  greige_width_value + greige_width_tolerance_value;
      }

      if (greige_width_range_math_operator == '-')
      {
          

         
          document.getElementById("greige_width_min_value").value = greige_width_value;
          document.getElementById("greige_width_max_value").value = greige_width_value - greige_width_tolerance_value;
      }

}



function appearance_after_wash_fabric_check()
{
         var checkbox = document.getElementById("test_method_for_appearance_after_wash_fabric");
         var appearance_after_wash_fabric = document.getElementById("div_appearance_after_wash_fabric");
         if(checkbox.checked == true)
         {
            appearance_after_wash_fabric.style.display = "block";
         }
         else{
            appearance_after_wash_fabric.style.display = "none";
         }
}

function appearance_after_wash_garments_check()
{
         var checkbox = document.getElementById("test_method_for_appearance_after_wash_garments");
         var appearance_after_wash_garments = document.getElementById("div_appearance_after_wash_garments");
         if(checkbox.checked == true)
         {
            appearance_after_wash_garments.style.display = "block";
         }
         else{
            appearance_after_wash_garments.style.display = "none";
         }
}

// .................................................start fabric_function definition-----------------------------------------------------------------------------------------
function appearance_after_washing_color_change_fabric_cal()
{
    var appearance_after_washing_fabric_color_change_tolerance_value = document.getElementById("appearance_after_washing_fabric_color_change_tolerance_value").value;
    var appearance_after_washing_fabric_color_change_tolerance_range_math_operator = document.getElementById("appearance_after_washing_fabric_color_change_tolerance_range_math_operator").value;

    if (appearance_after_washing_fabric_color_change_tolerance_range_math_operator == '≥') 
    {
        

        document.getElementById("appearance_after_washing_fabric_color_change_min_value").value = appearance_after_washing_fabric_color_change_tolerance_value;
        document.getElementById("appearance_after_washing_fabric_color_change_max_value").value = 5;
    }

    else if (appearance_after_washing_fabric_color_change_tolerance_range_math_operator == '>') 
    {
        

        document.getElementById("appearance_after_washing_fabric_color_change_min_value").value = parseFloat(appearance_after_washing_fabric_color_change_tolerance_value) + 0.5;
        document.getElementById("appearance_after_washing_fabric_color_change_max_value").value = 5;
    }

    else if (appearance_after_washing_fabric_color_change_tolerance_range_math_operator == '<') 
    {
        

        document.getElementById("appearance_after_washing_fabric_color_change_min_value").value = 0 ;
        document.getElementById("appearance_after_washing_fabric_color_change_max_value").value = parseFloat(appearance_after_washing_fabric_color_change_tolerance_value) - 0.5;
    }

    else
    {
        

        document.getElementById("appearance_after_washing_fabric_color_change_min_value").value = 0;
        document.getElementById("appearance_after_washing_fabric_color_change_max_value").value = appearance_after_washing_fabric_color_change_tolerance_value;
    }
}

function appearance_after_washing_cross_staining_fabric_cal()
{
    var appearance_after_washing_fabric_cross_staining_tolerance_value = document.getElementById("appearance_after_washing_fabric_cross_staining_tolerance_value").value;
    var appearance_after_washing_fabric_cross_staining_tolerance_range_math_operator = document.getElementById("appearance_after_washing_fabric_cross_staining_tolerance_range_math_operator").value;

    if (appearance_after_washing_fabric_cross_staining_tolerance_range_math_operator == '≥') 
    {
        

        document.getElementById("appearance_after_washing_fabric_cross_staining_min_value").value = appearance_after_washing_fabric_cross_staining_tolerance_value;
        document.getElementById("appearance_after_washing_fabric_cross_staining_max_value").value = 5;
    }

    else if (appearance_after_washing_fabric_cross_staining_tolerance_range_math_operator == '>') 
    {
        

        document.getElementById("appearance_after_washing_fabric_cross_staining_min_value").value = parseFloat(appearance_after_washing_fabric_cross_staining_tolerance_value) + 0.5;
        document.getElementById("appearance_after_washing_fabric_cross_staining_max_value").value = 5;
    }

    else if (appearance_after_washing_fabric_cross_staining_tolerance_range_math_operator == '<') 
    {
        

        document.getElementById("appearance_after_washing_fabric_cross_staining_min_value").value = 0 ;
        document.getElementById("appearance_after_washing_fabric_cross_staining_max_value").value = parseFloat(appearance_after_washing_fabric_cross_staining_tolerance_value) - 0.5;
    }

    else
    {
        

        document.getElementById("appearance_after_washing_fabric_cross_staining_min_value").value = 0;
        document.getElementById("appearance_after_washing_fabric_cross_staining_max_value").value = appearance_after_washing_fabric_cross_staining_tolerance_value;
    }
}

function appearance_after_washing_surface_fuzzing_fabric_cal()
{
    var appearance_after_washing_fabric_surface_fuzzing_tolerance_value = document.getElementById("appearance_after_washing_fabric_surface_fuzzing_tolerance_value").value;
    var appearance_after_washing_fabric_surface_fuzzing_tolerance_range_math_operator = document.getElementById("appearance_after_washing_fabric_surface_fuzzing_tolerance_range_math_operator").value;

    if (appearance_after_washing_fabric_surface_fuzzing_tolerance_range_math_operator == '≥') 
    {
    

    document.getElementById("appearance_after_washing_fabric_surface_fuzzing_min_value").value = appearance_after_washing_fabric_surface_fuzzing_tolerance_value;
    document.getElementById("appearance_after_washing_fabric_surface_fuzzing_max_value").value = 5;
    }

    else if (appearance_after_washing_fabric_surface_fuzzing_tolerance_range_math_operator == '>') 
    {
    

    document.getElementById("appearance_after_washing_fabric_surface_fuzzing_min_value").value = parseFloat(appearance_after_washing_fabric_surface_fuzzing_tolerance_value) + 0.5;
    document.getElementById("appearance_after_washing_fabric_surface_fuzzing_max_value").value = 5;
    }

    else if (appearance_after_washing_fabric_surface_fuzzing_tolerance_range_math_operator == '<') 
    {
    

    document.getElementById("appearance_after_washing_fabric_surface_fuzzing_min_value").value = 0 ;
    document.getElementById("appearance_after_washing_fabric_surface_fuzzing_max_value").value = parseFloat(appearance_after_washing_fabric_surface_fuzzing_tolerance_value) - 0.5;
    }

    else
    {
    

    document.getElementById("appearance_after_washing_fabric_surface_fuzzing_min_value").value = 0;
    document.getElementById("appearance_after_washing_fabric_surface_fuzzing_max_value").value = appearance_after_washing_fabric_surface_fuzzing_tolerance_value;
    }
}

     function appearance_after_washing_surface_pilling_fabric_cal()
     {
              var appearance_after_washing_fabric_surface_pilling_tolerance_value = document.getElementById("appearance_after_washing_fabric_surface_pilling_tolerance_value").value;
              var appearance_after_washing_fabric_surface_pilling_tolerance_range_math_operator = document.getElementById("appearance_after_washing_fabric_surface_pilling_tolerance_range_math_operator").value;
  
              if (appearance_after_washing_fabric_surface_pilling_tolerance_range_math_operator == '≥') 
              {
                 
  
                 document.getElementById("appearance_after_washing_fabric_surface_pilling_min_value").value = appearance_after_washing_fabric_surface_pilling_tolerance_value;
                 document.getElementById("appearance_after_washing_fabric_surface_pilling_max_value").value = 5;
              }
  
              else if (appearance_after_washing_fabric_surface_pilling_tolerance_range_math_operator == '>') 
              {
                 
  
                 document.getElementById("appearance_after_washing_fabric_surface_pilling_min_value").value = parseFloat(appearance_after_washing_fabric_surface_pilling_tolerance_value) + 0.5;
                 document.getElementById("appearance_after_washing_fabric_surface_pilling_max_value").value = 5;
              }
  
              else if (appearance_after_washing_fabric_surface_pilling_tolerance_range_math_operator == '<') 
              {
                 
  
                 document.getElementById("appearance_after_washing_fabric_surface_pilling_min_value").value = 0 ;
                 document.getElementById("appearance_after_washing_fabric_surface_pilling_max_value").value = parseFloat(appearance_after_washing_fabric_surface_pilling_tolerance_value) - 0.5;
              }
  
              else
              {
                 
  
                 document.getElementById("appearance_after_washing_fabric_surface_pilling_min_value").value = 0;
                 document.getElementById("appearance_after_washing_fabric_surface_pilling_max_value").value = appearance_after_washing_fabric_surface_pilling_tolerance_value;
              }
      }

      function appearance_after_washing_crease_before_ironing_fabric_cal()
      {
               var appearance_after_washing_fabric_crease_before_ironing_tolerance_value = document.getElementById("appearance_after_washing_fabric_crease_before_ironing_tolerance_value").value;
               var appearance_after_washing_fabric_crease_before_ironing_tolerance_range_math_operator = document.getElementById("appearance_after_washing_fabric_crease_before_ironing_tolerance_range_math_operator").value;
   
               if (appearance_after_washing_fabric_crease_before_ironing_tolerance_range_math_operator == '≥') 
               {
                  
   
                  document.getElementById("appearance_after_washing_fabric_crease_before_ironing_min_value").value = appearance_after_washing_fabric_crease_before_ironing_tolerance_value;
                  document.getElementById("appearance_after_washing_fabric_crease_before_ironing_max_value").value = 5;
               }
   
               else if (appearance_after_washing_fabric_crease_before_ironing_tolerance_range_math_operator == '>') 
               {
                  
   
                  document.getElementById("appearance_after_washing_fabric_crease_before_ironing_min_value").value = parseFloat(appearance_after_washing_fabric_crease_before_ironing_tolerance_value) + 0.5;
                  document.getElementById("appearance_after_washing_fabric_crease_before_ironing_max_value").value = 5;
               }
   
               else if (appearance_after_washing_fabric_crease_before_ironing_tolerance_range_math_operator == '<') 
               {
                  
   
                  document.getElementById("appearance_after_washing_fabric_crease_before_ironing_min_value").value = 0 ;
                  document.getElementById("appearance_after_washing_fabric_crease_before_ironing_max_value").value = parseFloat(appearance_after_washing_fabric_crease_before_ironing_tolerance_value) - 0.5;
               }
   
               else
               {
                  
   
                  document.getElementById("appearance_after_washing_fabric_crease_before_ironing_min_value").value = 0;
                  document.getElementById("appearance_after_washing_fabric_crease_before_ironing_max_value").value = appearance_after_washing_fabric_crease_before_ironing_tolerance_value;
               }
       }

       function appearance_after_washing_crease_after_ironing_fabric_cal()
       {
                var appearance_after_washing_fabric_crease_after_ironing_tolerance_value = document.getElementById("appearance_after_washing_fabric_crease_after_ironing_tolerance_value").value;
                var appearance_after_washing_fabric_crease_after_ironing_tolerance_range_math_operator = document.getElementById("appearance_after_washing_fabric_crease_after_ironing_tolerance_range_math_operator").value;
    
                if (appearance_after_washing_fabric_crease_after_ironing_tolerance_range_math_operator == '≥') 
                {
                   
    
                   document.getElementById("appearance_after_washing_fabric_crease_after_ironing_min_value").value = appearance_after_washing_fabric_crease_after_ironing_tolerance_value;
                   document.getElementById("appearance_after_washing_fabric_crease_after_ironing_max_value").value = 5;
                }
    
                else if (appearance_after_washing_fabric_crease_after_ironing_tolerance_range_math_operator == '>') 
                {
                   
    
                   document.getElementById("appearance_after_washing_fabric_crease_after_ironing_min_value").value = parseFloat(appearance_after_washing_fabric_crease_after_ironing_tolerance_value) + 0.5;
                   document.getElementById("appearance_after_washing_fabric_crease_after_ironing_max_value").value = 5;
                }
    
                else if (appearance_after_washing_fabric_crease_after_ironing_tolerance_range_math_operator == '<') 
                {
                   document.getElementById("appearance_after_washing_fabric_crease_after_ironing_min_value").value = 0 ;
                   document.getElementById("appearance_after_washing_fabric_crease_after_ironing_max_value").value = parseFloat(appearance_after_washing_fabric_crease_after_ironing_tolerance_value) - 0.5;
                }
    
                else
                {
                   document.getElementById("appearance_after_washing_fabric_crease_after_ironing_min_value").value = 0;
                   document.getElementById("appearance_after_washing_fabric_crease_after_ironing_max_value").value = appearance_after_washing_fabric_crease_after_ironing_tolerance_value;
                }
        }

// .................................................end fabric_function definition-----------------------------------------------------------------------------------------




// .................................................start garments_function definition-----------------------------------------------------------------------------------------

function appearance_after_washing_color_change_without_suppressor_garments_cal()
{
    var appearance_after_washing_garments_color_change_without_suppressor_tolerance_value = document.getElementById("appearance_after_washing_garments_color_change_without_suppressor_tolerance_value").value;
    var appearance_after_washing_garments_color_change_without_suppressor_tolerance_range_math_operator = document.getElementById("appearance_after_washing_garments_color_change_without_suppressor_tolerance_range_math_operator").value;

    if (appearance_after_washing_garments_color_change_without_suppressor_tolerance_range_math_operator == '≥') 
    {
        

        document.getElementById("appearance_after_washing_garments_color_change_without_suppressor_min_value").value = appearance_after_washing_garments_color_change_without_suppressor_tolerance_value;
        document.getElementById("appearance_after_washing_garments_color_change_without_suppressor_max_value").value = 5;
    }

    else if (appearance_after_washing_garments_color_change_without_suppressor_tolerance_range_math_operator == '>') 
    {
        

        document.getElementById("appearance_after_washing_garments_color_change_without_suppressor_min_value").value = parseFloat(appearance_after_washing_garments_color_change_without_suppressor_tolerance_value) + 0.5;
        document.getElementById("appearance_after_washing_garments_color_change_without_suppressor_max_value").value = 5;
    }

    else if (appearance_after_washing_garments_color_change_without_suppressor_tolerance_range_math_operator == '<') 
    {
        

        document.getElementById("appearance_after_washing_garments_color_change_without_suppressor_min_value").value = 0 ;
        document.getElementById("appearance_after_washing_garments_color_change_without_suppressor_max_value").value = parseFloat(appearance_after_washing_garments_color_change_without_suppressor_tolerance_value) - 0.5;
    }

    else
    {
        

        document.getElementById("appearance_after_washing_garments_color_change_without_suppressor_min_value").value = 0;
        document.getElementById("appearance_after_washing_garments_color_change_without_suppressor_max_value").value = appearance_after_washing_garments_color_change_without_suppressor_tolerance_value;
    }
}

function appearance_after_washing_color_change_with_suppressor_garments_cal()
   {
            var appearance_after_washing_garments_color_change_with_suppressor_tolerance_value = document.getElementById("appearance_after_washing_garments_color_change_with_suppressor_tolerance_value").value;
            var appearance_after_washing_garments_color_change_with_suppressor_tolerance_range_math_operator = document.getElementById("appearance_after_washing_garments_color_change_with_suppressor_tolerance_range_math_operator").value;

            if (appearance_after_washing_garments_color_change_with_suppressor_tolerance_range_math_operator == '≥') 
            {
               

               document.getElementById("appearance_after_washing_garments_color_change_with_suppressor_min_value").value = appearance_after_washing_garments_color_change_with_suppressor_tolerance_value;
               document.getElementById("appearance_after_washing_garments_color_change_with_suppressor_max_value").value = 5;
            }

            else if (appearance_after_washing_garments_color_change_with_suppressor_tolerance_range_math_operator == '>') 
            {
               

               document.getElementById("appearance_after_washing_garments_color_change_with_suppressor_min_value").value = parseFloat(appearance_after_washing_garments_color_change_with_suppressor_tolerance_value) + 0.5;
               document.getElementById("appearance_after_washing_garments_color_change_with_suppressor_max_value").value = 5;
            }

            else if (appearance_after_washing_garments_color_change_with_suppressor_tolerance_range_math_operator == '<') 
            {
               

               document.getElementById("appearance_after_washing_garments_color_change_with_suppressor_min_value").value = 0 ;
               document.getElementById("appearance_after_washing_garments_color_change_with_suppressor_max_value").value = parseFloat(appearance_after_washing_garments_color_change_with_suppressor_tolerance_value) - 0.5;
            }

            else
            {
               

               document.getElementById("appearance_after_washing_garments_color_change_with_suppressor_min_value").value = 0;
               document.getElementById("appearance_after_washing_garments_color_change_with_suppressor_max_value").value = appearance_after_washing_garments_color_change_with_suppressor_tolerance_value;
            }
    }

    function appearance_after_washing_cross_staining_garments_cal()
   {
            var appearance_after_washing_garments_cross_staining_tolerance_value = document.getElementById("appearance_after_washing_garments_cross_staining_tolerance_value").value;
            var appearance_after_washing_garments_cross_staining_tolerance_range_math_operator = document.getElementById("appearance_after_washing_garments_cross_staining_tolerance_range_math_operator").value;

            if (appearance_after_washing_garments_cross_staining_tolerance_range_math_operator == '≥') 
            {
               

               document.getElementById("appearance_after_washing_garments_cross_staining_min_value").value = appearance_after_washing_garments_cross_staining_tolerance_value;
               document.getElementById("appearance_after_washing_garments_cross_staining_max_value").value = 5;
            }

            else if (appearance_after_washing_garments_cross_staining_tolerance_range_math_operator == '>') 
            {
               

               document.getElementById("appearance_after_washing_garments_cross_staining_min_value").value = parseFloat(appearance_after_washing_garments_cross_staining_tolerance_value) + 0.5;
               document.getElementById("appearance_after_washing_garments_cross_staining_max_value").value = 5;
            }

            else if (appearance_after_washing_garments_cross_staining_tolerance_range_math_operator == '<') 
            {
               

               document.getElementById("appearance_after_washing_garments_cross_staining_min_value").value = 0 ;
               document.getElementById("appearance_after_washing_garments_cross_staining_max_value").value = parseFloat(appearance_after_washing_garments_cross_staining_tolerance_value) - 0.5;
            }

            else
            {
               

               document.getElementById("appearance_after_washing_garments_cross_staining_min_value").value = 0;
               document.getElementById("appearance_after_washing_garments_cross_staining_max_value").value = appearance_after_washing_garments_cross_staining_tolerance_value;
            }
    }

    function appearance_after_washing_differential_shrinkage_garments_cal()
    {
             var appearance_after_washing_garments__differential_shrinkage_tolerance_value = document.getElementById("appearance_after_washing_garments__differential_shrinkage_tolerance_value").value;
             var appearance_after_washing_garments_differential_shrinkage_tolerance_range_math_operator = document.getElementById("appearance_after_washing_garments_differential_shrinkage_tolerance_range_math_operator").value;
 
             if (appearance_after_washing_garments_differential_shrinkage_tolerance_range_math_operator == '+') 
             {
                
 
                document.getElementById("appearance_after_washing_garments__differential_shrinkage_min_value").value = appearance_after_washing_garments__differential_shrinkage_tolerance_value;
                document.getElementById("appearance_after_washing_garments__differential_shrinkage_max_value").value = 5;
             }
 
             else if (appearance_after_washing_garments_differential_shrinkage_tolerance_range_math_operator == '-') 
             {
                
 
                document.getElementById("appearance_after_washing_garments__differential_shrinkage_min_value").value = parseFloat(appearance_after_washing_garments__differential_shrinkage_tolerance_value) + 0.5;
                document.getElementById("appearance_after_washing_garments__differential_shrinkage_max_value").value = 5;
             }
             else
             {
                
 
                document.getElementById("appearance_after_washing_garments__differential_shrinkage_min_value").value = 0;
                document.getElementById("appearance_after_washing_garments__differential_shrinkage_max_value").value = appearance_after_washing_garments__differential_shrinkage_tolerance_value;
             }
     }

     function appearance_after_washing_surface_fuzzing_garments_cal()
     {
              var appearance_after_washing_garments_surface_fuzzing_tolerance_value = document.getElementById("appearance_after_washing_garments_surface_fuzzing_tolerance_value").value;
              var appearance_after_washing_garments_surface_fuzzing_tolerance_range_math_operator = document.getElementById("appearance_after_washing_garments_surface_fuzzing_tolerance_range_math_operator").value;
  
              if (appearance_after_washing_garments_surface_fuzzing_tolerance_range_math_operator == '≥') 
              {
                 
  
                 document.getElementById("appearance_after_washing_garments_surface_fuzzing_min_value").value = appearance_after_washing_garments_surface_fuzzing_tolerance_value;
                 document.getElementById("appearance_after_washing_garments_surface_fuzzing_max_value").value = 5;
              }
  
              else if (appearance_after_washing_garments_surface_fuzzing_tolerance_range_math_operator == '>') 
              {
                 
  
                 document.getElementById("appearance_after_washing_garments_surface_fuzzing_min_value").value = parseFloat(appearance_after_washing_garments_surface_fuzzing_tolerance_value) + 0.5;
                 document.getElementById("appearance_after_washing_garments_surface_fuzzing_max_value").value = 5;
              }
  
              else if (appearance_after_washing_garments_surface_fuzzing_tolerance_range_math_operator == '<') 
              {
                 
  
                 document.getElementById("appearance_after_washing_garments_surface_fuzzing_min_value").value = 0 ;
                 document.getElementById("appearance_after_washing_garments_surface_fuzzing_max_value").value = parseFloat(appearance_after_washing_garments_surface_fuzzing_tolerance_value) - 0.5;
              }
  
              else
              {
                 
  
                 document.getElementById("appearance_after_washing_garments_surface_fuzzing_min_value").value = 0;
                 document.getElementById("appearance_after_washing_garments_surface_fuzzing_max_value").value = appearance_after_washing_garments_surface_fuzzing_tolerance_value;
              }
      }

      function appearance_after_washing_surface_pilling_garments_cal()
      {
               var appearance_after_washing_garments_surface_pilling_tolerance_value = document.getElementById("appearance_after_washing_garments_surface_pilling_tolerance_value").value;
               var appearance_after_washing_garments_surface_pilling_tolerance_range_math_operator = document.getElementById("appearance_after_washing_garments_surface_pilling_tolerance_range_math_operator").value;
   
               if (appearance_after_washing_garments_surface_pilling_tolerance_range_math_operator == '≥') 
               {
                  
   
                  document.getElementById("appearance_after_washing_garments_surface_pilling_min_value").value = appearance_after_washing_garments_surface_pilling_tolerance_value;
                  document.getElementById("appearance_after_washing_garments_surface_pilling_max_value").value = 5;
               }
   
               else if (appearance_after_washing_garments_surface_pilling_tolerance_range_math_operator == '>') 
               {
                  
   
                  document.getElementById("appearance_after_washing_garments_surface_pilling_min_value").value = parseFloat(appearance_after_washing_garments_surface_pilling_tolerance_value) + 0.5;
                  document.getElementById("appearance_after_washing_garments_surface_pilling_max_value").value = 5;
               }
   
               else if (appearance_after_washing_garments_surface_pilling_tolerance_range_math_operator == '<') 
               {
                  
   
                  document.getElementById("appearance_after_washing_garments_surface_pilling_min_value").value = 0 ;
                  document.getElementById("appearance_after_washing_garments_surface_pilling_max_value").value = parseFloat(appearance_after_washing_garments_surface_pilling_tolerance_value) - 0.5;
               }
   
               else
               {
                  
   
                  document.getElementById("appearance_after_washing_garments_surface_pilling_min_value").value = 0;
                  document.getElementById("appearance_after_washing_garments_surface_pilling_max_value").value = appearance_after_washing_garments_surface_pilling_tolerance_value;
               }
       }

       function appearance_after_washing_crease_after_ironing_garments_cal()
       {
                var appearance_after_washing_garments_crease_after_ironing_tolerance_value = document.getElementById("appearance_after_washing_garments_crease_after_ironing_tolerance_value").value;
                var appearance_after_washing_garments_crease_after_ironing_tolerance_range_math_operator = document.getElementById("appearance_after_washing_garments_crease_after_ironing_tolerance_range_math_operator").value;
    
                if (appearance_after_washing_garments_crease_after_ironing_tolerance_range_math_operator == '≥') 
                {
                   
    
                   document.getElementById("appearance_after_washing_garments_crease_after_ironing_min_value").value = appearance_after_washing_garments_crease_after_ironing_tolerance_value;
                   document.getElementById("appearance_after_washing_garments_crease_after_ironing_max_value").value = 5;
                }
    
                else if (appearance_after_washing_garments_crease_after_ironing_tolerance_range_math_operator == '>') 
                {
                   
    
                   document.getElementById("appearance_after_washing_garments_crease_after_ironing_min_value").value = parseFloat(appearance_after_washing_garments_crease_after_ironing_tolerance_value) + 0.5;
                   document.getElementById("appearance_after_washing_garments_crease_after_ironing_max_value").value = 5;
                }
    
                else if (appearance_after_washing_garments_crease_after_ironing_tolerance_range_math_operator == '<') 
                {
                   document.getElementById("appearance_after_washing_garments_crease_after_ironing_min_value").value = 0 ;
                   document.getElementById("appearance_after_washing_garments_crease_after_ironing_max_value").value = parseFloat(appearance_after_washing_garments_crease_after_ironing_tolerance_value) - 0.5;
                }
    
                else
                {
                   document.getElementById("appearance_after_washing_garments_crease_after_ironing_min_value").value = 0;
                   document.getElementById("appearance_after_washing_garments_crease_after_ironing_max_value").value = appearance_after_washing_garments_crease_after_ironing_tolerance_value;
                }
        }

        function appearance_after_washing_seam_puckering_garments_cal()
       {
                var appearance_after_washing_garments_seam_puckering_roping_after_iron_tolerance_value = document.getElementById("appearance_after_washing_garments_seam_puckering_roping_after_iron_tolerance_value").value;
                var appearance_after_washing_garments_seam_puckering_roping_after_iron_tolerance_range_math_operator = document.getElementById("appearance_after_washing_garments_seam_puckering_roping_after_iron_tolerance_range_math_operator").value;
    
                if (appearance_after_washing_garments_seam_puckering_roping_after_iron_tolerance_range_math_operator == '≥') 
                {
                   
    
                   document.getElementById("appearance_after_washing_garments_seam_puckering_roping_after_iron_min_value").value = appearance_after_washing_garments_seam_puckering_roping_after_iron_tolerance_value;
                   document.getElementById("appearance_after_washing_garments_seam_puckering_roping_after_iron_max_value").value = 5;
                }
    
                else if (appearance_after_washing_garments_seam_puckering_roping_after_iron_tolerance_range_math_operator == '>') 
                {
                   
    
                   document.getElementById("appearance_after_washing_garments_seam_puckering_roping_after_iron_min_value").value = parseFloat(appearance_after_washing_garments_seam_puckering_roping_after_iron_tolerance_value) + 0.5;
                   document.getElementById("appearance_after_washing_garments_seam_puckering_roping_after_iron_max_value").value = 5;
                }
    
                else if (appearance_after_washing_garments_seam_puckering_roping_after_iron_tolerance_range_math_operator == '<') 
                {
                   document.getElementById("appearance_after_washing_garments_seam_puckering_roping_after_iron_min_value").value = 0 ;
                   document.getElementById("appearance_after_washing_garments_seam_puckering_roping_after_iron_max_value").value = parseFloat(appearance_after_washing_garments_seam_puckering_roping_after_iron_tolerance_value) - 0.5;
                }
    
                else
                {
                   document.getElementById("appearance_after_washing_garments_seam_puckering_roping_after_iron_min_value").value = 0;
                   document.getElementById("appearance_after_washing_garments_seam_puckering_roping_after_iron_max_value").value = appearance_after_washing_garments_seam_puckering_roping_after_iron_tolerance_value;
                }
        }
        // .................................................end garments_function definition-----------------------------------------------------------------------------------------
