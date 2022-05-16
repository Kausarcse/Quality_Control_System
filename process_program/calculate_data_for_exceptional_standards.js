//For Sanforizing,Calendering

function color_fastness_to_rubbing_dry_cal()
{
     var color_fastness_to_rubbing_dry_value = parseFloat(document.getElementById("color_fastness_to_rubbing_dry_value").value);
      var color_fastness_to_rubbing_dry_tolerance_value = parseFloat(document.getElementById("color_fastness_to_rubbing_dry_tolerance_value").value);
      var color_fastness_to_rubbing_dry_tolerance_range_math_operator = document.getElementById("color_fastness_to_rubbing_dry_tolerance_range_math_operator").value;

      if (color_fastness_to_rubbing_dry_tolerance_range_math_operator == '+/-') 
      {
          
          var tolarance = ((color_fastness_to_rubbing_dry_tolerance_value * color_fastness_to_rubbing_dry_value) / 100);
          var tol_cal_value2 = color_fastness_to_rubbing_dry_value + tolarance;
          var tol_cal_value1 = color_fastness_to_rubbing_dry_value - tolarance;

          document.getElementById("color_fastness_to_rubbing_dry_min_value").value = tol_cal_value1.toFixed(5);
          document.getElementById("color_fastness_to_rubbing_dry_max_value").value = tol_cal_value2.toFixed(5);
      }

      if (color_fastness_to_rubbing_dry_tolerance_range_math_operator == "+")
      {
          

          var tolarance = ((color_fastness_to_rubbing_dry_tolerance_value * color_fastness_to_rubbing_dry_value) / 100);
          var tol_cal_value2 = color_fastness_to_rubbing_dry_value + tolarance;

          document.getElementById("color_fastness_to_rubbing_dry_min_value").value = color_fastness_to_rubbing_dry_value;
          document.getElementById("color_fastness_to_rubbing_dry_max_value").value = tol_cal_value2.toFixed(5);
      }

      if (color_fastness_to_rubbing_dry_tolerance_range_math_operator == '-')
      {
          

          var tolarance = ((color_fastness_to_rubbing_dry_tolerance_value * color_fastness_to_rubbing_dry_value) / 100);
          var tol_cal_value2 = color_fastness_to_rubbing_dry_value - tolarance;

          document.getElementById("color_fastness_to_rubbing_dry_max_value").value = color_fastness_to_rubbing_dry_value;
          document.getElementById("color_fastness_to_rubbing_dry_min_value").value = tol_cal_value2.toFixed(5);
      }

}

function color_fastness_to_rubbing_wet_cal()
{
     var color_fastness_to_rubbing_wet_value = parseFloat(document.getElementById("color_fastness_to_rubbing_wet_value").value);
      var color_fastness_to_rubbing_wet_tolerance_value = parseFloat(document.getElementById("color_fastness_to_rubbing_wet_tolerance_value").value);
      var color_fastness_to_rubbing_wet_tolerance_range_math_operator = document.getElementById("color_fastness_to_rubbing_wet_tolerance_range_math_operator").value;

      if (color_fastness_to_rubbing_wet_tolerance_range_math_operator == '+/-') 
      {
          
          var tolarance = ((color_fastness_to_rubbing_wet_tolerance_value * color_fastness_to_rubbing_wet_value) / 100);
          var tol_cal_value2 = color_fastness_to_rubbing_wet_value + tolarance;
          var tol_cal_value1 = color_fastness_to_rubbing_wet_value - tolarance;

          document.getElementById("color_fastness_to_rubbing_wet_min_value").value = tol_cal_value1.toFixed(5);
          document.getElementById("color_fastness_to_rubbing_wet_max_value").value = tol_cal_value2.toFixed(5);
      }

      if (color_fastness_to_rubbing_wet_tolerance_range_math_operator == "+")
      {
          

          var tolarance = ((color_fastness_to_rubbing_wet_tolerance_value * color_fastness_to_rubbing_wet_value) / 100);
          var tol_cal_value2 = color_fastness_to_rubbing_wet_value + tolarance;

          document.getElementById("color_fastness_to_rubbing_wet_min_value").value = color_fastness_to_rubbing_wet_value;
          document.getElementById("color_fastness_to_rubbing_wet_max_value").value = tol_cal_value2.toFixed(5);
      }

      if (color_fastness_to_rubbing_wet_tolerance_range_math_operator == '-')
      {
          

          var tolarance = ((color_fastness_to_rubbing_wet_tolerance_value * color_fastness_to_rubbing_wet_value) / 100);
          var tol_cal_value2 = color_fastness_to_rubbing_wet_value - tolarance;

          document.getElementById("color_fastness_to_rubbing_wet_max_value").value = color_fastness_to_rubbing_wet_value;
          document.getElementById("color_fastness_to_rubbing_wet_min_value").value = tol_cal_value2.toFixed(5);
      }

}

//same as before calculation file
function warp_yarn_count_cal()
{
      var warp_yarn_count_value = parseFloat(document.getElementById("warp_yarn_count_value").value);
      var warp_yarn_count_tolerance_value = parseFloat(document.getElementById("warp_yarn_count_tolerance_value").value);
      var warp_yarn_count_tolerance_range_math_operator = document.getElementById("warp_yarn_count_tolerance_range_math_operator").value;

      if (warp_yarn_count_tolerance_range_math_operator == '+/-') 
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

function mass_per_unit_per_area_cal()
{
     var mass_per_unit_per_area_value = parseFloat(document.getElementById("mass_per_unit_per_area_value").value);
      var mass_per_unit_per_area_tolerance_value = parseFloat(document.getElementById("mass_per_unit_per_area_tolerance_value").value);
      var mass_per_unit_per_area_tolerance_range_math_operator = document.getElementById("mass_per_unit_per_area_tolerance_range_math_operator").value;

      if (mass_per_unit_per_area_tolerance_range_math_operator == '+/-') 
      {
          
          var tolarance = ((mass_per_unit_per_area_tolerance_value * mass_per_unit_per_area_value) / 100);
          var tol_cal_value2 = mass_per_unit_per_area_value + tolarance;
          var tol_cal_value1 = mass_per_unit_per_area_value - tolarance;

          document.getElementById("mass_per_unit_per_area_min_value").value = tol_cal_value1.toFixed(5);
          document.getElementById("mass_per_unit_per_area_max_value").value = tol_cal_value2.toFixed(5);
      }

      if (mass_per_unit_per_area_tolerance_range_math_operator == "+")
      {
          

          var tolarance = ((mass_per_unit_per_area_tolerance_value * mass_per_unit_per_area_value) / 100);
          var tol_cal_value2 = mass_per_unit_per_area_value + tolarance;

          document.getElementById("mass_per_unit_per_area_min_value").value = mass_per_unit_per_area_value;
          document.getElementById("mass_per_unit_per_area_max_value").value = tol_cal_value2.toFixed(5);
      }

      if (mass_per_unit_per_area_tolerance_range_math_operator == '-')
      {
          

          var tolarance = ((mass_per_unit_per_area_tolerance_value * mass_per_unit_per_area_value) / 100);
          var tol_cal_value2 = mass_per_unit_per_area_value - tolarance;

          document.getElementById("mass_per_unit_per_area_max_value").value = mass_per_unit_per_area_value;
          document.getElementById("mass_per_unit_per_area_min_value").value = tol_cal_value2.toFixed(5);
      }

}
function no_of_threads_in_warp_cal()
{
     var no_of_threads_in_warp_value = parseFloat(document.getElementById("no_of_threads_in_warp_value").value);
      var no_of_threads_in_warp_tolerance_value = parseFloat(document.getElementById("no_of_threads_in_warp_tolerance_value").value);
      var no_of_threads_in_warp_tolerance_range_math_operator = document.getElementById("no_of_threads_in_warp_tolerance_range_math_operator").value;

      if (no_of_threads_in_warp_tolerance_range_math_operator == '+/-') 
      {
          
          var tolarance = ((no_of_threads_in_warp_tolerance_value * no_of_threads_in_warp_value) / 100);
          var flame_intensity_tol_cal_value2 = no_of_threads_in_warp_value + tolarance;
          var flame_intensity_tol_cal_value1 = no_of_threads_in_warp_value - tolarance;

          document.getElementById("no_of_threads_in_warp_min_value").value = flame_intensity_tol_cal_value1.toFixed(5);
          document.getElementById("no_of_threads_in_warp_max_value").value = flame_intensity_tol_cal_value2.toFixed(5);
      }

      if (no_of_threads_in_warp_tolerance_range_math_operator == "+")
      {
          

          var tolarance = ((no_of_threads_in_warp_tolerance_value * no_of_threads_in_warp_value) / 100);
          var flame_intensity_tol_cal_value2 = no_of_threads_in_warp_value + tolarance;

          document.getElementById("no_of_threads_in_warp_min_value").value = no_of_threads_in_warp_value;
          document.getElementById("no_of_threads_in_warp_max_value").value = flame_intensity_tol_cal_value2.toFixed(5);
      }

      if (no_of_threads_in_warp_tolerance_range_math_operator == '-')
      {
          

          var tolarance = ((no_of_threads_in_warp_tolerance_value * no_of_threads_in_warp_value) / 100);
          var flame_intensity_tol_cal_value2 = no_of_threads_in_warp_value - tolarance;

          document.getElementById("no_of_threads_in_warp_max_value").value = no_of_threads_in_warp_value;
          document.getElementById("no_of_threads_in_warp_min_value").value = flame_intensity_tol_cal_value2.toFixed(5);
      }

}

/*function no_of_threads_in_weft_cal()
{
     var no_of_threads_in_weft_value = parseFloat(document.getElementById("no_of_threads_in_weft_value").value);
      var no_of_threads_in_weft_tolerance_value = parseFloat(document.getElementById("no_of_threads_in_weft_tolerance_value").value);
      var no_of_threads_in_weft_tolerance_range_math_operator = document.getElementById("no_of_threads_in_weft_tolerance_range_math_operator").value;

      if (no_of_threads_in_weft_tolerance_range_math_operator == '+/-') 
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

}*/

function no_of_threads_in_weft_cal()
{
     var no_of_threads_in_weft_value = parseFloat(document.getElementById("no_of_threads_in_weft_value").value);
      var no_of_threads_in_weft_tolerance_value = parseFloat(document.getElementById("no_of_threads_in_weft_tolerance_value").value);
      var no_of_threads_in_weft_tolerance_range_math_operator = document.getElementById("no_of_threads_in_weft_tolerance_range_math_operator").value;

      if (no_of_threads_in_weft_tolerance_range_math_operator == '+/-') 
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

}function mass_per_unit_per_area_cal()
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

function surface_fuzzing_and_pilling_cal()
{
    var surface_fuzzing_and_pilling_tolerance_value = document.getElementById("surface_fuzzing_and_pilling_tolerance_value").value;
    var surface_fuzzing_and_pilling_tolerance_range_math_operator = document.getElementById("surface_fuzzing_and_pilling_tolerance_range_math_operator").value;

    if (surface_fuzzing_and_pilling_tolerance_range_math_operator == '≥') 
    {
        

        document.getElementById("surface_fuzzing_and_pilling_min_value").value = surface_fuzzing_and_pilling_tolerance_value;
        document.getElementById("surface_fuzzing_and_pilling_max_value").value = 5;
    }

    else
    {
        

        document.getElementById("surface_fuzzing_and_pilling_min_value").value = 0;
        document.getElementById("surface_fuzzing_and_pilling_max_value").value = surface_fuzzing_and_pilling_tolerance_value;
    }
}

function warp_yarn_tensile_properties_cal()
{
    var warp_yarn_tensile_properties_tolerance_value = document.getElementById("warp_yarn_tensile_properties_tolerance_value").value;
    var warp_yarn_tensile_properties_tolerance_range_math_operator = document.getElementById("warp_yarn_tensile_properties_tolerance_range_math_operator").value;

    if (warp_yarn_tensile_properties_tolerance_range_math_operator == '≥') 
    {
        

        document.getElementById("warp_yarn_tensile_properties_min_value").value = warp_yarn_tensile_properties_tolerance_value;
        document.getElementById("warp_yarn_tensile_properties_tolerance_max_value").value = 5;
    }

    else
    {
        

        document.getElementById("warp_yarn_tensile_properties_min_value").value = 0;
        document.getElementById("warp_yarn_tensile_properties_tolerance_max_value").value = warp_yarn_tensile_properties_tolerance_value;
    }
}


function warp_yarn_tear_force_cal()
{
 var warp_yarn_tear_force_tolerance_value = document.getElementById("warp_yarn_tear_force_tolerance_value").value;
    var warp_yarn_tear_force_tolerance_range_math_operator = document.getElementById("warp_yarn_tear_force_tolerance_range_math_operator").value;

    if (warp_yarn_tear_force_tolerance_range_math_operator == '≥') 
    {
        

        document.getElementById("warp_yarn_tear_force_min_value").value = warp_yarn_tear_force_tolerance_value;
        document.getElementById("warp_yarn_tear_force_tolerance_max_value").value = 5;
    }

    else
    {
        

        document.getElementById("warp_yarn_tear_force_min_value").value = 0;
        document.getElementById("warp_yarn_tear_force_tolerance_max_value").value = warp_yarn_tear_force_tolerance_value;
    }
}

function weft_yarn_tear_force_cal()
{
 var weft_yarn_tear_force_tolerance_value = document.getElementById("weft_yarn_tear_force_tolerance_value").value;
    var weft_yarn_tear_force_tolerance_range_math_operator = document.getElementById("weft_yarn_tear_force_tolerance_range_math_operator").value;

    if (weft_yarn_tear_force_tolerance_range_math_operator == '≥') 
    {
        

        document.getElementById("weft_yarn_tear_force_min_value").value = weft_yarn_tear_force_tolerance_value;
        document.getElementById("weft_yarn_tear_force_tolerance_max_value").value = 5;
    }

    else
    {
        

        document.getElementById("weft_yarn_tear_force_min_value").value = 0;
        document.getElementById("weft_yarn_tear_force_tolerance_max_value").value = weft_yarn_tear_force_tolerance_value;
    }
}

function warp_yarn_seam_range_cal()
{
 var warp_yarn_seam_tolerence_value = document.getElementById("warp_yarn_seam_tolerence_value").value;
    var warp_yarn_seam_range_math_operator = document.getElementById("warp_yarn_seam_range_math_operator").value;

    if (warp_yarn_seam_range_math_operator == '≥') 
    {
        

        document.getElementById("warp_yarn_seam_min_value").value = warp_yarn_seam_tolerence_value;
        document.getElementById("warp_yarn_seam_max_value").value = 5;
    }

    else
    {
        

        document.getElementById("warp_yarn_seam_min_value").value = 0;
        document.getElementById("warp_yarn_seam_max_value").value = warp_yarn_seam_tolerence_value;
    }
}


function weft_yarn_seam_range_cal()
{
 var weft_yarn_seam_tolerence_value = document.getElementById("weft_yarn_seam_tolerence_value").value;
    var weft_yarn_seam_range_math_operator = document.getElementById("weft_yarn_seam_range_math_operator").value;

    if (weft_yarn_seam_range_math_operator == '≥') 
    {
        

        document.getElementById("weft_yarn_seam_min_value").value = weft_yarn_seam_tolerence_value;
        document.getElementById("weft_yarn_seam_max_value").value = 5;
    }

    else
    {
        

        document.getElementById("weft_yarn_seam_min_value").value = 0;
        document.getElementById("weft_yarn_seam_max_value").value = weft_yarn_seam_tolerence_value;
    }
}


function seam_slippage_resistance_in_warp_cal()
{
 var seam_slippage_resistance_in_warp_tolerence_value = document.getElementById("seam_slippage_resistance_in_warp_tolerence_value").value;
    var seam_slippage_resistance_in_warp_range_math_operator = document.getElementById("seam_slippage_resistance_in_warp_range_math_operator").value;

    if (seam_slippage_resistance_in_warp_range_math_operator == '≥') 
    {
        

        document.getElementById("seam_slippage_resistance_in_warp_min_value").value = seam_slippage_resistance_in_warp_tolerence_value;
        document.getElementById("seam_slippage_resistance_in_warp_max_value").value = 5;
    }

    else
    {
        

        document.getElementById("seam_slippage_resistance_in_warp_min_value").value = 0;
        document.getElementById("seam_slippage_resistance_in_warp_max_value").value = seam_slippage_resistance_in_warp_tolerence_value;
    }
}

function seam_slippage_resistance_in_weft_cal()
{
 var seam_slippage_resistance_in_weft_tolerence_value = document.getElementById("seam_slippage_resistance_in_weft_tolerence_value").value;
    var seam_slippage_resistance_in_weft_range_math_operator = document.getElementById("seam_slippage_resistance_in_weft_range_math_operator").value;

    if (seam_slippage_resistance_in_weft_range_math_operator == '≥') 
    {
        

        document.getElementById("seam_slippage_resistance_in_weft_min_value").value = seam_slippage_resistance_in_weft_tolerence_value;
        document.getElementById("seam_slippage_resistance_in_weft_max_value").value = 5;
    }

    else
    {
        

        document.getElementById("seam_slippage_resistance_in_weft_min_value").value = 0;
        document.getElementById("seam_slippage_resistance_in_weft_max_value").value = seam_slippage_resistance_in_weft_tolerence_value;
    }
}

function seam_slippage_resistance_in_weft_mm_cal()
{
 var seam_slippage_resistance_in_weft_mm_tolerence_value = document.getElementById("seam_slippage_resistance_in_weft_mm_tolerence_value").value;
    var seam_slippage_resistance_in_weft_mm_range_math_operator = document.getElementById("seam_slippage_resistance_in_weft_mm_range_math_operator").value;

    if (seam_slippage_resistance_in_weft_mm_range_math_operator == '≥') 
    {
        

        document.getElementById("seam_slippage_resistance_in_weft_mm_min_value").value = seam_slippage_resistance_in_weft_mm_tolerence_value;
        document.getElementById("seam_slippage_resistance_in_weft_mm_max_value").value = 5;
    }

    else
    {
        

        document.getElementById("seam_slippage_resistance_in_weft_mm_min_value").value = 0;
        document.getElementById("seam_slippage_resistance_in_weft_mm_max_value").value = seam_slippage_resistance_in_weft_mm_tolerence_value;
    }
}

function seam_slippage_resistance_in_warp_mm_cal()
{
 var seam_slippage_resistance_in_warp_mm_tolerence_value = document.getElementById("seam_slippage_resistance_in_warp_mm_tolerence_value").value;
    var seam_slippage_resistance_in_warp_mm_range_math_operator = document.getElementById("seam_slippage_resistance_in_warp_mm_range_math_operator").value;

    if (seam_slippage_resistance_in_warp_mm_range_math_operator == '≥') 
    {
        

        document.getElementById("seam_slippage_resistance_in_warp_mm_min_value").value = seam_slippage_resistance_in_warp_mm_tolerence_value;
        document.getElementById("seam_slippage_resistance_in_warp_mm_max_value").value = 5;
    }

    else
    {
        

        document.getElementById("seam_slippage_resistance_in_warp_mm_min_value").value = 0;
        document.getElementById("seam_slippage_resistance_in_warp_mm_max_value").value = seam_slippage_resistance_in_warp_mm_tolerence_value;
    }
}


function warp_yarn_tensile_properties_cal_raising()
{
 var warp_yarn_tensile_properties_tolerance_value = document.getElementById("warp_yarn_tensile_properties_tolerance_value").value;
    var warp_yarn_tensile_properties_tolerance_range_math_operator = document.getElementById("warp_yarn_tensile_properties_tolerance_range_math_operator").value;

    if (warp_yarn_tensile_properties_tolerance_range_math_operator == '≥') 
    {
        

        document.getElementById("warp_yarn_tensile_properties_min_value").value = warp_yarn_tensile_properties_tolerance_value;
        document.getElementById("warp_yarn_tensile_properties_max_value").value = 5;
    }

    else
    {
        

        document.getElementById("warp_yarn_tensile_properties_min_value").value = 0;
        document.getElementById("warp_yarn_tensile_properties_max_value").value = warp_yarn_tensile_properties_tolerance_value;
    }
}


function weft_yarn_tensile_properties_cal()
{
 var weft_yarn_tensile_properties_tolerance_value = document.getElementById("weft_yarn_tensile_properties_tolerance_value").value;
    var weft_yarn_tensile_properties_tolerance_range_math_operator = document.getElementById("weft_yarn_tensile_properties_tolerance_range_math_operator").value;

    if (weft_yarn_tensile_properties_tolerance_range_math_operator == '≥') 
    {
        

        document.getElementById("weft_yarn_tensile_properties_min_value").value = weft_yarn_tensile_properties_tolerance_value;
        document.getElementById("weft_yarn_tensile_properties_max_value").value = 5;
    }

    else
    {
        

        document.getElementById("weft_yarn_tensile_properties_min_value").value = 0;
        document.getElementById("weft_yarn_tensile_properties_max_value").value = weft_yarn_tensile_properties_tolerance_value;
    }
}


function warp_yarn_tear_force_cal_raising()
{
 var warp_yarn_tear_force_tolerance_value = document.getElementById("warp_yarn_tear_force_tolerance_value").value;
    var warp_yarn_tear_force_tolerance_range_math_operator = document.getElementById("warp_yarn_tear_force_tolerance_range_math_operator").value;

    if (warp_yarn_tear_force_tolerance_range_math_operator == '≥') 
    {
        

        document.getElementById("warp_yarn_tear_force_min_value").value = warp_yarn_tear_force_tolerance_value;
        document.getElementById("warp_yarn_tear_force_max_value").value = 5;
    }

    else
    {
        

        document.getElementById("warp_yarn_tear_force_min_value").value = 0;
        document.getElementById("warp_yarn_tear_force_max_value").value = warp_yarn_tear_force_tolerance_value;
    }
}


function weft_yarn_tear_force_cal_raising()
{
 var weft_yarn_tear_force_tolerance_value = document.getElementById("weft_yarn_tear_force_tolerance_value").value;
    var weft_yarn_tear_force_tolerance_range_math_operator = document.getElementById("weft_yarn_tear_force_tolerance_range_math_operator").value;

    if (weft_yarn_tear_force_tolerance_range_math_operator == '≥') 
    {
        

        document.getElementById("weft_yarn_tear_force_min_value").value = weft_yarn_tear_force_tolerance_value;
        document.getElementById("weft_yarn_tear_force_max_value").value = 5;
    }

    else
    {
        

        document.getElementById("weft_yarn_tear_force_min_value").value = 0;
        document.getElementById("weft_yarn_tear_force_max_value").value = weft_yarn_tear_force_tolerance_value;
    }
}

//For Greige


function warp_yarn_count_cal_greige()
  {
      var warp_yarn_count_value = parseFloat(document.getElementById("warp_yarn_count_value").value);
      var warp_yarn_count_tolerance_range_math_operator = parseFloat(document.getElementById("warp_yarn_count_tolerance_range_math_operator").value);
      var warp_yarn_count_tolerance_value = parseFloat(document.getElementById("warp_yarn_count_tolerance_value").value);

     
      var positive_tolarance = ( (warp_yarn_count_value * warp_yarn_count_tolerance_range_math_operator) / 100 );
      var negative_tolarance = ( (warp_yarn_count_value * warp_yarn_count_tolerance_value) / 100 );

      var tol_cal_value2 = warp_yarn_count_value + positive_tolarance;
      var tol_cal_value1 = warp_yarn_count_value - negative_tolarance;

      document.getElementById("warp_yarn_count_min_value").value = tol_cal_value1.toFixed(5);
      document.getElementById("warp_yarn_count_max_value").value = tol_cal_value2.toFixed(5);
      

      if(isNaN(document.getElementById("warp_yarn_count_tolerance_range_math_operator").value))
      {
          number_alert("warp_yarn_count_tolerance_range_math_operator");
          return false;
      }

      if(isNaN(document.getElementById("warp_yarn_count_tolerance_value").value))
      {
          number_alert("warp_yarn_count_tolerance_value");
          return false;
      }
  }


  function weft_yarn_count_cal_greige()
  {
      var weft_yarn_count_value = parseFloat(document.getElementById("weft_yarn_count_value").value);
      var weft_yarn_count_tolerance_range_math_operator = parseFloat(document.getElementById("weft_yarn_count_tolerance_range_math_operator").value);
      var weft_yarn_count_tolerance_value = document.getElementById("weft_yarn_count_tolerance_value").value;

     

      var positive_tolarance = ( (weft_yarn_count_value * weft_yarn_count_tolerance_range_math_operator) / 100 );
      var negative_tolarance = ( (weft_yarn_count_value * weft_yarn_count_tolerance_value) / 100 );

      var mass_per_unit_per_area_tol_cal_value2 = weft_yarn_count_value + positive_tolarance;
      var mass_per_unit_per_area_tol_cal_value1 = weft_yarn_count_value - negative_tolarance;

      document.getElementById("weft_yarn_count_min_value").value = mass_per_unit_per_area_tol_cal_value1.toFixed(5);
      document.getElementById("weft_yarn_count_max_value").value = mass_per_unit_per_area_tol_cal_value2.toFixed(5);
      

      if(isNaN(document.getElementById("weft_yarn_count_tolerance_range_math_operator").value))
      {
          number_alert("weft_yarn_count_tolerance_range_math_operator");
          return false;
      }

      if(isNaN(document.getElementById("weft_yarn_count_tolerance_value").value))
      {
          number_alert("weft_yarn_count_tolerance_value");
          return false;
      }
  }


  function no_of_threads_in_warp_in_thread_per_inch_cal()
{
     var no_of_threads_in_warp_in_thread_per_inch_value = parseFloat(document.getElementById("no_of_threads_in_warp_in_thread_per_inch_value").value);
      var no_of_threads_in_warp_in_thread_per_inch_tolarance_value = parseFloat(document.getElementById("no_of_threads_in_warp_in_thread_per_inch_tolarance_value").value);
      var no_of_threads_in_warp_in_thread_per_inch_for_tol_range_math_op = document.getElementById("no_of_threads_in_warp_in_thread_per_inch_for_tol_range_math_op").value;

      if (no_of_threads_in_warp_in_thread_per_inch_for_tol_range_math_op == '+/-') 
      {
          
          var tolarance = ((no_of_threads_in_warp_in_thread_per_inch_tolarance_value * no_of_threads_in_warp_in_thread_per_inch_value) / 100);
          var tol_cal_value2 = no_of_threads_in_warp_in_thread_per_inch_value + tolarance;
          var tol_cal_value1 = no_of_threads_in_warp_in_thread_per_inch_value - tolarance;

          document.getElementById("no_of_threads_in_warp_in_thread_per_inch_for_tolarance_min_value").value = tol_cal_value1.toFixed(5);
          document.getElementById("no_of_threads_in_warp_in_thread_per_inch_for_tolarance_max_value").value = tol_cal_value2.toFixed(5);
      }

      if (no_of_threads_in_warp_in_thread_per_inch_for_tol_range_math_op == "+")
      {
          

          var tolarance = ((no_of_threads_in_warp_in_thread_per_inch_tolarance_value * no_of_threads_in_warp_in_thread_per_inch_value) / 100);
          var tol_cal_value2 = no_of_threads_in_warp_in_thread_per_inch_value + tolarance;

          document.getElementById("no_of_threads_in_warp_in_thread_per_inch_for_tolarance_min_value").value = no_of_threads_in_warp_in_thread_per_inch_value;
          document.getElementById("no_of_threads_in_warp_in_thread_per_inch_for_tolarance_max_value").value = tol_cal_value2.toFixed(5);
      }

      if (no_of_threads_in_warp_in_thread_per_inch_for_tol_range_math_op == '-')
      {
          

          var tolarance = ((no_of_threads_in_warp_in_thread_per_inch_tolarance_value * no_of_threads_in_warp_in_thread_per_inch_value) / 100);
          var tol_cal_value2 = no_of_threads_in_warp_in_thread_per_inch_value - tolarance;

          document.getElementById("no_of_threads_in_warp_in_thread_per_inch_for_tolarance_max_value").value = no_of_threads_in_warp_in_thread_per_inch_value;
          document.getElementById("no_of_threads_in_warp_in_thread_per_inch_for_tolarance_min_value").value = tol_cal_value2.toFixed(5);
      }

}

function no_of_threads_in_weft_in_thread_per_inch_cal()
{
     var no_of_threads_in_weft_in_thread_per_inch_value = parseFloat(document.getElementById("no_of_threads_in_weft_in_thread_per_inch_value").value);
      var no_of_threads_in_weft_in_thread_per_inch_tolarance_value = parseFloat(document.getElementById("no_of_threads_in_weft_in_thread_per_inch_tolarance_value").value);
      var no_of_threads_in_weft_in_thread_per_inch_for_tol_range_math_op = document.getElementById("no_of_threads_in_weft_in_thread_per_inch_for_tol_range_math_op").value;

      if (no_of_threads_in_weft_in_thread_per_inch_for_tol_range_math_op == '+/-') 
      {
          
          var tolarance = ((no_of_threads_in_weft_in_thread_per_inch_tolarance_value * no_of_threads_in_weft_in_thread_per_inch_value) / 100);
          var tol_cal_value2 = no_of_threads_in_weft_in_thread_per_inch_value + tolarance;
          var tol_cal_value1 = no_of_threads_in_weft_in_thread_per_inch_value - tolarance;

          document.getElementById("no_of_threads_in_weft_in_thread_per_inch_min_value").value = tol_cal_value1.toFixed(5);
          document.getElementById("no_of_threads_in_weft_in_thread_per_inch_for_tolarance_max_value").value = tol_cal_value2.toFixed(5);
      }

      if (no_of_threads_in_weft_in_thread_per_inch_for_tol_range_math_op == "+")
      {
          

          var tolarance = ((no_of_threads_in_weft_in_thread_per_inch_tolarance_value * no_of_threads_in_weft_in_thread_per_inch_value) / 100);
          var tol_cal_value2 = no_of_threads_in_weft_in_thread_per_inch_value + tolarance;

          document.getElementById("no_of_threads_in_weft_in_thread_per_inch_min_value").value = no_of_threads_in_weft_in_thread_per_inch_value;
          document.getElementById("no_of_threads_in_weft_in_thread_per_inch_for_tolarance_max_value").value = tol_cal_value2.toFixed(5);
      }

      if (no_of_threads_in_weft_in_thread_per_inch_for_tol_range_math_op == '-')
      {
          

          var tolarance = ((no_of_threads_in_weft_in_thread_per_inch_tolarance_value * no_of_threads_in_weft_in_thread_per_inch_value) / 100);
          var tol_cal_value2 = no_of_threads_in_weft_in_thread_per_inch_value - tolarance;

          document.getElementById("no_of_threads_in_weft_in_thread_per_inch_for_tolarance_max_value").value = no_of_threads_in_weft_in_thread_per_inch_value;
          document.getElementById("no_of_threads_in_weft_in_thread_per_inch_min_value").value = tol_cal_value2.toFixed(5);
      }

}

function gsm_cal()
  {
      var gsm_value = parseFloat(document.getElementById("gsm_value").value);
      var gsm_tolerance_range_math_operator = parseFloat(document.getElementById("gsm_tolerance_range_math_operator").value);
      var gsm_tolerance_value = document.getElementById("gsm_tolerance_value").value;

     

      var positive_tolarance = ( (gsm_value * gsm_tolerance_range_math_operator) / 100 );
      var negative_tolarance = ( (gsm_value * gsm_tolerance_value) / 100 );

      var tol_cal_value2 = gsm_value + positive_tolarance;
      var tol_cal_value1 = gsm_value - negative_tolarance;

      document.getElementById("gsm_min_value").value = tol_cal_value1.toFixed(5);
      document.getElementById("gsm_max_value").value = tol_cal_value2.toFixed(5);
      

      if(isNaN(document.getElementById("gsm_tolerance_range_math_operator").value))
      {
          number_alert("gsm_tolerance_range_math_operator");
          return false;
      }

      if(isNaN(document.getElementById("gsm_tolerance_value").value))
      {
          number_alert("gsm_tolerance_value");
          return false;
      }
  }

  function finish_width_in_inch_cal()
{
     var finish_width_in_inch_value = parseFloat(document.getElementById("finish_width_in_inch_value").value);
      var finish_width_in_inch_tolerance_value = parseFloat(document.getElementById("finish_width_in_inch_tolerance_value").value);
      var finish_width_in_inch_range_math_operator = document.getElementById("finish_width_in_inch_range_math_operator").value;

      if (finish_width_in_inch_range_math_operator == '+/-') 
      {
          
          var tolarance = ((finish_width_in_inch_tolerance_value * finish_width_in_inch_value) / 100);
          var tol_cal_value2 = finish_width_in_inch_value + tolarance;
          var tol_cal_value1 = finish_width_in_inch_value - tolarance;

          document.getElementById("finish_width_in_inch_min_value").value = tol_cal_value1.toFixed(5);
          document.getElementById("finish_width_in_inch_max_value").value = tol_cal_value2.toFixed(5);
      }

      if (finish_width_in_inch_range_math_operator == "+")
      {
          

          var tolarance = ((finish_width_in_inch_tolerance_value * finish_width_in_inch_value) / 100);
          var tol_cal_value2 = finish_width_in_inch_value + tolarance;

          document.getElementById("finish_width_in_inch_min_value").value = finish_width_in_inch_value;
          document.getElementById("finish_width_in_inch_max_value").value = tol_cal_value2.toFixed(5);
      }

      if (finish_width_in_inch_range_math_operator == '-')
      {
          

          var tolarance = ((finish_width_in_inch_tolerance_value * finish_width_in_inch_value) / 100);
          var tol_cal_value2 = finish_width_in_inch_value - tolarance;

          document.getElementById("finish_width_in_inch_max_value").value = finish_width_in_inch_value;
          document.getElementById("finish_width_in_inch_min_value").value = tol_cal_value2.toFixed(5);
      }

}

function percentage_of_cotton_content_cal()
{
     var percentage_of_cotton_content_value = parseFloat(document.getElementById("percentage_of_cotton_content_value").value);
      var percentage_of_cotton_content_tolerance_value = parseFloat(document.getElementById("percentage_of_cotton_content_tolerance_value").value);
      var percentage_of_cotton_content_tolerance_range_math_op = document.getElementById("percentage_of_cotton_content_tolerance_range_math_op").value;

      if (percentage_of_cotton_content_tolerance_range_math_op == '+/-') 
      {
          
          var tolarance = ((percentage_of_cotton_content_tolerance_value * percentage_of_cotton_content_value) / 100);
          var tol_cal_value2 = percentage_of_cotton_content_value + tolarance;
          var tol_cal_value1 = percentage_of_cotton_content_value - tolarance;

          document.getElementById("percentage_of_cotton_content_min_value").value = tol_cal_value1.toFixed(5);
          document.getElementById("percentage_of_cotton_content_max_value").value = tol_cal_value2.toFixed(5);
      }

      if (percentage_of_cotton_content_tolerance_range_math_op == "+")
      {
          

          var tolarance = ((percentage_of_cotton_content_tolerance_value * percentage_of_cotton_content_value) / 100);
          var tol_cal_value2 = percentage_of_cotton_content_value + tolarance;

          document.getElementById("percentage_of_cotton_content_min_value").value = percentage_of_cotton_content_value;
          document.getElementById("percentage_of_cotton_content_max_value").value = tol_cal_value2.toFixed(5);
      }

      if (percentage_of_cotton_content_tolerance_range_math_op == '-')
      {
          

          var tolarance = ((percentage_of_cotton_content_tolerance_value * percentage_of_cotton_content_value) / 100);
          var tol_cal_value2 = percentage_of_cotton_content_value - tolarance;

          document.getElementById("percentage_of_cotton_content_max_value").value = percentage_of_cotton_content_value;
          document.getElementById("percentage_of_cotton_content_min_value").value = tol_cal_value2.toFixed(5);
      }

}

function percentage_of_polyester_content_cal()
{
     var percentage_of_polyester_content_value = parseFloat(document.getElementById("percentage_of_polyester_content_value").value);
      var percentage_of_polyester_content_tolerance_value = parseFloat(document.getElementById("percentage_of_polyester_content_tolerance_value").value);
      var percentage_of_polyester_content_tolerance_range_math_op = document.getElementById("percentage_of_polyester_content_tolerance_range_math_op").value;

      if (percentage_of_polyester_content_tolerance_range_math_op == '+/-') 
      {
          
          var tolarance = ((percentage_of_polyester_content_tolerance_value * percentage_of_polyester_content_value) / 100);
          var tol_cal_value2 = percentage_of_polyester_content_value + tolarance;
          var tol_cal_value1 = percentage_of_polyester_content_value - tolarance;

          document.getElementById("percentage_of_polyester_content_min_value").value = tol_cal_value1.toFixed(5);
          document.getElementById("percentage_of_polyester_content_max_value").value = tol_cal_value2.toFixed(5);
      }

      if (percentage_of_polyester_content_tolerance_range_math_op == "+")
      {
          

          var tolarance = ((percentage_of_polyester_content_tolerance_value * percentage_of_polyester_content_value) / 100);
          var tol_cal_value2 = percentage_of_polyester_content_value + tolarance;

          document.getElementById("percentage_of_polyester_content_min_value").value = percentage_of_polyester_content_value;
          document.getElementById("percentage_of_polyester_content_max_value").value = tol_cal_value2.toFixed(5);
      }

      if (percentage_of_polyester_content_tolerance_range_math_op == '-')
      {
          

          var tolarance = ((percentage_of_polyester_content_tolerance_value * percentage_of_polyester_content_value) / 100);
          var tol_cal_value2 = percentage_of_polyester_content_value - tolarance;

          document.getElementById("percentage_of_polyester_content_max_value").value = percentage_of_polyester_content_value;
          document.getElementById("percentage_of_polyester_content_min_value").value = tol_cal_value2.toFixed(5);
      }

}


function percentage_of_other_fiber_content_cal()
{
     var percentage_of_other_fiber_value = parseFloat(document.getElementById("percentage_of_other_fiber_value").value);
      var percentage_of_other_fiber_content_tolerance_value = parseFloat(document.getElementById("percentage_of_other_fiber_content_tolerance_value").value);
      var percentage_of_other_fiber_content_tolerance_range_math_op = document.getElementById("percentage_of_other_fiber_content_tolerance_range_math_op").value;

      if (percentage_of_other_fiber_content_tolerance_range_math_op == '+/-') 
      {
          
          var tolarance = ((percentage_of_other_fiber_content_tolerance_value * percentage_of_other_fiber_value) / 100);
          var tol_cal_value2 = percentage_of_other_fiber_value + tolarance;
          var tol_cal_value1 = percentage_of_other_fiber_value - tolarance;

          document.getElementById("percentage_of_other_fiber_content_min_value").value = tol_cal_value1.toFixed(5);
          document.getElementById("percentage_of_other_fiber_content_max_value").value = tol_cal_value2.toFixed(5);
      }

      if (percentage_of_other_fiber_content_tolerance_range_math_op == "+")
      {
          

          var tolarance = ((percentage_of_other_fiber_content_tolerance_value * percentage_of_other_fiber_value) / 100);
          var tol_cal_value2 = percentage_of_other_fiber_value + tolarance;

          document.getElementById("percentage_of_other_fiber_content_min_value").value = percentage_of_other_fiber_value;
          document.getElementById("percentage_of_other_fiber_content_max_value").value = tol_cal_value2.toFixed(5);
      }

      if (percentage_of_other_fiber_content_tolerance_range_math_op == '-')
      {
          

          var tolarance = ((percentage_of_other_fiber_content_tolerance_value * percentage_of_other_fiber_value) / 100);
          var tol_cal_value2 = percentage_of_other_fiber_value - tolarance;

          document.getElementById("percentage_of_other_fiber_content_max_value").value = percentage_of_other_fiber_value;
          document.getElementById("percentage_of_other_fiber_content_min_value").value = tol_cal_value2.toFixed(5);
      }

}