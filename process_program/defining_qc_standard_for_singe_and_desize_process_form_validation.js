

function Singing_Desizing_Form_Validation()
{


		if(document.getElementById("pp_number_value").value=="select")
		{
      		alert("Please Select Pp Number");
      		document.getElementById("pp_number_value").focus();
      		return false;
		}
		else if(document.getElementById("version_number").value=="select")
		{
      		alert("Please Select Version Number");
      		document.getElementById("version_number").focus();
      		return false;
		}
		/*else if(document.getElementById("customer_name").value=="select")
		{
      		alert("Please Select Customer Name");
      		document.getElementById("customer_name").focus();
      		return false;
		}
		else if(document.getElementById("color").value=="select")
		{
      		alert("Please Select Color");
      		document.getElementById("color").focus();
      		return false;
		}
		else if(document.getElementById("finish_width_in_inch").value=="select")
		{
      		alert("Please Select Finish Width");
      		document.getElementById("finish_width_in_inch").focus();
      		return false;
		}*/
		/*else if(document.getElementById("standard_for_which_process").value=="select")
		{
      		alert("Please Select Standard For Which Process");
      		document.getElementById("standard_for_which_process").focus();
      		return false;
		}*/
		/*else if(document.getElementById("flame_intensity_value").value.trim()=="")
		{
      		alert("Please Provide Flame Intensity Value");
      		document.getElementById("flame_intensity_value").focus();
      		return false;
		}
		else if(isNaN(document.getElementById("flame_intensity_value").value.trim()))
		{
      		alert("Flame Intensity Value should be Numeric");
			document.getElementById("flame_intensity_value").value="";
      		document.getElementById("flame_intensity_value").focus();
      		return false;
		}
		else if(document.getElementById("uom_of_flame_intensity").value.trim()=="")
		{
      		alert("Please Provide Uom Of Flame Intensity");
      		document.getElementById("uom_of_flame_intensity").focus();
      		return false;
		}
		else if(document.getElementById("flame_intensity_tolerance_range_math_operator").value=="select")
		{
      		alert("Please Select Flame Intensity Tolerance Range Math Operator");
      		document.getElementById("flame_intensity_tolerance_range_math_operator").focus();
      		return false;
		}
		else if(document.getElementById("flame_intensity_tolerance_value").value.trim()=="")
		{
      		alert("Please Provide Flame Intensity Tolerance Value");
      		document.getElementById("flame_intensity_tolerance_value").focus();
      		return false;
		}
		else if(isNaN(document.getElementById("flame_intensity_tolerance_value").value.trim()))
		{
      		alert("Flame Intensity Tolerance Value should be Numeric");
			document.getElementById("flame_intensity_tolerance_value").value="";
      		document.getElementById("flame_intensity_tolerance_value").focus();
      		return false;
		}
		else if(document.getElementById("flame_intensity_min_value").value.trim()=="")
		{
      		alert("Please Provide Flame Intensity Min Value");
      		document.getElementById("flame_intensity_min_value").focus();
      		return false;
		}
		else if(isNaN(document.getElementById("flame_intensity_min_value").value.trim()))
		{
      		alert("Flame Intensity Min Value should be Numeric");
			document.getElementById("flame_intensity_min_value").value="";
      		document.getElementById("flame_intensity_min_value").focus();
      		return false;
		}
		else if(document.getElementById("flame_intensity_max_value").value.trim()=="")
		{
      		alert("Please Provide Flame Intensity Max Value");
      		document.getElementById("flame_intensity_max_value").focus();
      		return false;
		}
		else if(isNaN(document.getElementById("flame_intensity_max_value").value.trim()))
		{
      		alert("Flame Intensity Max Value should be Numeric");
			document.getElementById("flame_intensity_max_value").value="";
      		document.getElementById("flame_intensity_max_value").focus();
      		return false;
		}
		else if(document.getElementById("speed").value.trim()=="")
		{
      		alert("Please Provide Speed");
      		document.getElementById("speed").focus();
      		return false;
		}
		else if(isNaN(document.getElementById("speed").value.trim()))
		{
      		alert("Speed should be Numeric");
			document.getElementById("speed").value="";
      		document.getElementById("speed").focus();
      		return false;
		}
		else if(document.getElementById("uom_of_speed").value.trim()=="")
		{
      		alert("Please Provide Uom Of Speed");
      		document.getElementById("uom_of_speed").focus();
      		return false;
		}
		else if(document.getElementById("speed_tolerance_range_math_operator").value=="select")
		{
      		alert("Please Select Speed Tolerance Range Math Operator");
      		document.getElementById("speed_tolerance_range_math_operator").focus();
      		return false;
		}
		else if(document.getElementById("speed_tolerance_value").value.trim()=="")
		{
      		alert("Please Provide Speed Tolerance Value");
      		document.getElementById("speed_tolerance_value").focus();
      		return false;
		}
		else if(isNaN(document.getElementById("speed_tolerance_value").value.trim()))
		{
      		alert("Speed Tolerance Value should be Numeric");
			document.getElementById("speed_tolerance_value").value="";
      		document.getElementById("speed_tolerance_value").focus();
      		return false;
		}
		else if(document.getElementById("speed_min_value").value.trim()=="")
		{
      		alert("Please Provide Speed Min Value");
      		document.getElementById("speed_min_value").focus();
      		return false;
		}
		else if(isNaN(document.getElementById("speed_min_value").value.trim()))
		{
      		alert("Speed Min Value should be Numeric");
			document.getElementById("speed_min_value").value="";
      		document.getElementById("speed_min_value").focus();
      		return false;
		}
		else if(document.getElementById("speed_max_value").value.trim()=="")
		{
      		alert("Please Provide Speed Max Value");
      		document.getElementById("speed_max_value").focus();
      		return false;
		}
		else if(isNaN(document.getElementById("speed_max_value").value.trim()))
		{
      		alert("Speed Max Value should be Numeric");
			document.getElementById("speed_max_value").value="";
      		document.getElementById("speed_max_value").focus();
      		return false;
		}
		else if(document.getElementById("bath_temperature").value.trim()=="")
		{
      		alert("Please Provide Bath Temperature");
      		document.getElementById("bath_temperature").focus();
      		return false;
		}
		else if(isNaN(document.getElementById("bath_temperature").value.trim()))
		{
      		alert("Bath Temperature should be Numeric");
			document.getElementById("bath_temperature").value="";
      		document.getElementById("bath_temperature").focus();
      		return false;
		}
		else if(document.getElementById("uom_of_bath_temperature").value.trim()=="")
		{
      		alert("Please Provide Uom Of Bath Temperature");
      		document.getElementById("uom_of_bath_temperature").focus();
      		return false;
		}
		else if(document.getElementById("bath_temperature_tolerance_range_math_operator").value.trim()=="")
		{
      		alert("Please Provide Bath Temperature Tolerance Range Math Operator");
      		document.getElementById("bath_temperature_tolerance_range_math_operator").focus();
      		return false;
		}
		else if(document.getElementById("bath_temperature_tolerance_value").value.trim()=="")
		{
      		alert("Please Provide Bath Temperature Tolerance Value");
      		document.getElementById("bath_temperature_tolerance_value").focus();
      		return false;
		}
		else if(isNaN(document.getElementById("bath_temperature_tolerance_value").value.trim()))
		{
      		alert("Bath Temperature Tolerance Value should be Numeric");
			document.getElementById("bath_temperature_tolerance_value").value="";
      		document.getElementById("bath_temperature_tolerance_value").focus();
      		return false;
		}
		else if(document.getElementById("bath_temperature_min_value").value.trim()=="")
		{
      		alert("Please Provide Bath Temperature Min Value");
      		document.getElementById("bath_temperature_min_value").focus();
      		return false;
		}
		else if(isNaN(document.getElementById("bath_temperature_min_value").value.trim()))
		{
      		alert("Bath Temperature Min Value should be Numeric");
			document.getElementById("bath_temperature_min_value").value="";
      		document.getElementById("bath_temperature_min_value").focus();
      		return false;
		}
		else if(document.getElementById("bath_temperature_max_value").value.trim()=="")
		{
      		alert("Please Provide Bath Temperature Max Value");
      		document.getElementById("bath_temperature_max_value").focus();
      		return false;
		}
		else if(isNaN(document.getElementById("bath_temperature_max_value").value.trim()))
		{
      		alert("Bath Temperature Max Value should be Numeric");
			document.getElementById("bath_temperature_max_value").value="";
      		document.getElementById("bath_temperature_max_value").focus();
      		return false;
		}
		else if(document.getElementById("ph").value.trim()=="")
		{
      		alert("Please Provide Ph");
      		document.getElementById("ph").focus();
      		return false;
		}
		else if(isNaN(document.getElementById("ph").value.trim()))
		{
      		alert("Ph should be Numeric");
			document.getElementById("ph").value="";
      		document.getElementById("ph").focus();
      		return false;
		}
		else if(document.getElementById("uom_of_ph").value.trim()=="")
		{
      		alert("Please Provide Uom Of Ph");
      		document.getElementById("uom_of_ph").focus();
      		return false;
		}
		else if(document.getElementById("ph_tolerance_range_math_operator").value=="select")
		{
      		alert("Please Select Ph Tolerance Range Math Operator");
      		document.getElementById("ph_tolerance_range_math_operator").focus();
      		return false;
		}
		else if(document.getElementById("ph_tolerance_value").value.trim()=="")
		{
      		alert("Please Provide Ph Tolerance Value");
      		document.getElementById("ph_tolerance_value").focus();
      		return false;
		}
		else if(isNaN(document.getElementById("ph_tolerance_value").value.trim()))
		{
      		alert("Ph Tolerance Value should be Numeric");
			document.getElementById("ph_tolerance_value").value="";
      		document.getElementById("ph_tolerance_value").focus();
      		return false;
		}
		else if(document.getElementById("ph_min_value").value.trim()=="")
		{
      		alert("Please Provide Ph Min Value");
      		document.getElementById("ph_min_value").focus();
      		return false;
		}
		else if(isNaN(document.getElementById("ph_min_value").value.trim()))
		{
      		alert("Ph Min Value should be Numeric");
			document.getElementById("ph_min_value").value="";
      		document.getElementById("ph_min_value").focus();
      		return false;
		}
		else if(document.getElementById("ph_max_value").value.trim()=="")
		{
      		alert("Please Provide Ph Max Value");
      		document.getElementById("ph_max_value").focus();
      		return false;
		}
		else if(isNaN(document.getElementById("ph_max_value").value.trim()))
		{
      		alert("Ph Max Value should be Numeric");
			document.getElementById("ph_max_value").value="";
      		document.getElementById("ph_max_value").focus();
      		return false;
		}*/

}

