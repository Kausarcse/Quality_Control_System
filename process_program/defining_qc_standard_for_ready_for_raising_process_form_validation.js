

function Ready_For_Raising_Form_Validation()
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
		/*else if(document.getElementById("customer_name").value.trim()=="")
		{
      		alert("Please Provide Customer Name");
      		document.getElementById("customer_name").focus();
      		return false;
		}
		else if(document.getElementById("color").value.trim()=="")
		{
      		alert("Please Provide Color");
      		document.getElementById("color").focus();
      		return false;
		}
		else if(document.getElementById("finish_width_in_inch").value.trim()=="")
		{
      		alert("Please Provide Finish Width");
      		document.getElementById("finish_width_in_inch").focus();
      		return false;
		}
		else if(isNaN(document.getElementById("finish_width_in_inch").value.trim()))
		{
      		alert("Finish Width should be Numeric");
			document.getElementById("finish_width_in_inch").value="";
      		document.getElementById("finish_width_in_inch").focus();
      		return false;
		}
		else if(document.getElementById("standard_for_which_process").value=="select")
		{
      		alert("Please Select Standard For Which Process");
      		document.getElementById("standard_for_which_process").focus();
      		return false;
		}*/
		/*else if(document.getElementById("warp_yarn_tensile_properties_tolerance_range_math_operator").value=="select")
		{
      		alert("Please Select Warp Yarn Tensile Properties Tolerance Range Math Operator");
      		document.getElementById("warp_yarn_tensile_properties_tolerance_range_math_operator").focus();
      		return false;
		}
		else if(document.getElementById("warp_yarn_tensile_properties_tolerance_value").value.trim()=="")
		{
      		alert("Please Provide Warp Yarn Tensile Properties Tolerance Value");
      		document.getElementById("warp_yarn_tensile_properties_tolerance_value").focus();
      		return false;
		}
		else if(isNaN(document.getElementById("warp_yarn_tensile_properties_tolerance_value").value.trim()))
		{
      		alert("Warp Yarn Tensile Properties Tolerance Value should be Numeric");
			document.getElementById("warp_yarn_tensile_properties_tolerance_value").value="";
      		document.getElementById("warp_yarn_tensile_properties_tolerance_value").focus();
      		return false;
		}
		else if(document.getElementById("uom_of_warp_yarn_tensile_properties").value=="select")
		{
      		alert("Please Select Uom Of Warp Yarn Tensile Properties");
      		document.getElementById("uom_of_warp_yarn_tensile_properties").focus();
      		return false;
		}
		else if(document.getElementById("warp_yarn_tensile_properties_min_value").value.trim()=="")
		{
      		alert("Please Provide Warp Yarn Tensile Properties Min Value");
      		document.getElementById("warp_yarn_tensile_properties_min_value").focus();
      		return false;
		}
		else if(isNaN(document.getElementById("warp_yarn_tensile_properties_min_value").value.trim()))
		{
      		alert("Warp Yarn Tensile Properties Min Value should be Numeric");
			document.getElementById("warp_yarn_tensile_properties_min_value").value="";
      		document.getElementById("warp_yarn_tensile_properties_min_value").focus();
      		return false;
		}
		else if(document.getElementById("warp_yarn_tensile_properties_max_value").value.trim()=="")
		{
      		alert("Please Provide Warp Yarn Tensile Properties Max Value");
      		document.getElementById("warp_yarn_tensile_properties_max_value").focus();
      		return false;
		}
		else if(isNaN(document.getElementById("warp_yarn_tensile_properties_max_value").value.trim()))
		{
      		alert("Warp Yarn Tensile Properties Max Value should be Numeric");
			document.getElementById("warp_yarn_tensile_properties_max_value").value="";
      		document.getElementById("warp_yarn_tensile_properties_max_value").focus();
      		return false;
		}
		else if(document.getElementById("weft_yarn_tensile_properties_tolerance_range_math_operator").value=="select")
		{
      		alert("Please Select Weft Yarn Tensile Properties Tolerance Range Math Operator");
      		document.getElementById("weft_yarn_tensile_properties_tolerance_range_math_operator").focus();
      		return false;
		}
		else if(document.getElementById("weft_yarn_tensile_properties_tolerance_value").value.trim()=="")
		{
      		alert("Please Provide Weft Yarn Tensile Properties Tolerance Value");
      		document.getElementById("weft_yarn_tensile_properties_tolerance_value").focus();
      		return false;
		}
		else if(isNaN(document.getElementById("weft_yarn_tensile_properties_tolerance_value").value.trim()))
		{
      		alert("Weft Yarn Tensile Properties Tolerance Value should be Numeric");
			document.getElementById("weft_yarn_tensile_properties_tolerance_value").value="";
      		document.getElementById("weft_yarn_tensile_properties_tolerance_value").focus();
      		return false;
		}
		else if(document.getElementById("uom_of_weft_yarn_tensile_properties").value=="select")
		{
      		alert("Please Select Uom Of Weft Yarn Tensile Properties");
      		document.getElementById("uom_of_weft_yarn_tensile_properties").focus();
      		return false;
		}
		else if(document.getElementById("weft_yarn_tensile_properties_min_value").value.trim()=="")
		{
      		alert("Please Provide Weft Yarn Tensile Properties Min Value");
      		document.getElementById("weft_yarn_tensile_properties_min_value").focus();
      		return false;
		}
		else if(isNaN(document.getElementById("weft_yarn_tensile_properties_min_value").value.trim()))
		{
      		alert("Weft Yarn Tensile Properties Min Value should be Numeric");
			document.getElementById("weft_yarn_tensile_properties_min_value").value="";
      		document.getElementById("weft_yarn_tensile_properties_min_value").focus();
      		return false;
		}
		else if(document.getElementById("weft_yarn_tensile_properties_max_value").value.trim()=="")
		{
      		alert("Please Provide Weft Yarn Tensile Properties Max Value");
      		document.getElementById("weft_yarn_tensile_properties_max_value").focus();
      		return false;
		}
		else if(isNaN(document.getElementById("weft_yarn_tensile_properties_max_value").value.trim()))
		{
      		alert("Weft Yarn Tensile Properties Max Value should be Numeric");
			document.getElementById("weft_yarn_tensile_properties_max_value").value="";
      		document.getElementById("weft_yarn_tensile_properties_max_value").focus();
      		return false;
		}
		else if(document.getElementById("warp_yarn_tear_force_tolerance_range_math_operator").value=="select")
		{
      		alert("Please Select Warp Yarn Tear Force Tolerance Range Math Operator");
      		document.getElementById("warp_yarn_tear_force_tolerance_range_math_operator").focus();
      		return false;
		}
		else if(document.getElementById("warp_yarn_tear_force_tolerance_value").value.trim()=="")
		{
      		alert("Please Provide Warp Yarn Tear Force Tolerance Value");
      		document.getElementById("warp_yarn_tear_force_tolerance_value").focus();
      		return false;
		}
		else if(isNaN(document.getElementById("warp_yarn_tear_force_tolerance_value").value.trim()))
		{
      		alert("Warp Yarn Tear Force Tolerance Value should be Numeric");
			document.getElementById("warp_yarn_tear_force_tolerance_value").value="";
      		document.getElementById("warp_yarn_tear_force_tolerance_value").focus();
      		return false;
		}
		else if(document.getElementById("uom_of_warp_yarn_tear_force").value=="select")
		{
      		alert("Please Select Uom Of Warp Yarn Tear Force");
      		document.getElementById("uom_of_warp_yarn_tear_force").focus();
      		return false;
		}
		else if(document.getElementById("warp_yarn_tear_force_min_value").value.trim()=="")
		{
      		alert("Please Provide Warp Yarn Tear Force Min Value");
      		document.getElementById("warp_yarn_tear_force_min_value").focus();
      		return false;
		}
		else if(isNaN(document.getElementById("warp_yarn_tear_force_min_value").value.trim()))
		{
      		alert("Warp Yarn Tear Force Min Value should be Numeric");
			document.getElementById("warp_yarn_tear_force_min_value").value="";
      		document.getElementById("warp_yarn_tear_force_min_value").focus();
      		return false;
		}
		else if(document.getElementById("warp_yarn_tear_force_max_value").value.trim()=="")
		{
      		alert("Please Provide Warp Yarn Tear Force Max Value");
      		document.getElementById("warp_yarn_tear_force_max_value").focus();
      		return false;
		}
		else if(isNaN(document.getElementById("warp_yarn_tear_force_max_value").value.trim()))
		{
      		alert("Warp Yarn Tear Force Max Value should be Numeric");
			document.getElementById("warp_yarn_tear_force_max_value").value="";
      		document.getElementById("warp_yarn_tear_force_max_value").focus();
      		return false;
		}
		else if(document.getElementById("weft_yarn_tear_force_tolerance_range_math_operator").value=="select")
		{
      		alert("Please Select Weft Yarn Tear Force Tolerance Range Math Operator");
      		document.getElementById("weft_yarn_tear_force_tolerance_range_math_operator").focus();
      		return false;
		}
		else if(document.getElementById("weft_yarn_tear_force_tolerance_value").value.trim()=="")
		{
      		alert("Please Provide Weft Yarn Tear Force Tolerance Value");
      		document.getElementById("weft_yarn_tear_force_tolerance_value").focus();
      		return false;
		}
		else if(isNaN(document.getElementById("weft_yarn_tear_force_tolerance_value").value.trim()))
		{
      		alert("Weft Yarn Tear Force Tolerance Value should be Numeric");
			document.getElementById("weft_yarn_tear_force_tolerance_value").value="";
      		document.getElementById("weft_yarn_tear_force_tolerance_value").focus();
      		return false;
		}
		else if(document.getElementById("uom_of_weft_yarn_tear_force").value=="select")
		{
      		alert("Please Select Uom Of Weft Yarn Tear Force");
      		document.getElementById("uom_of_weft_yarn_tear_force").focus();
      		return false;
		}
		else if(document.getElementById("weft_yarn_tear_force_min_value").value.trim()=="")
		{
      		alert("Please Provide Weft Yarn Tear Force Min Value");
      		document.getElementById("weft_yarn_tear_force_min_value").focus();
      		return false;
		}
		else if(isNaN(document.getElementById("weft_yarn_tear_force_min_value").value.trim()))
		{
      		alert("Weft Yarn Tear Force Min Value should be Numeric");
			document.getElementById("weft_yarn_tear_force_min_value").value="";
      		document.getElementById("weft_yarn_tear_force_min_value").focus();
      		return false;
		}
		else if(document.getElementById("weft_yarn_tear_force_max_value").value.trim()=="")
		{
      		alert("Please Provide Weft Yarn Tear Force Max Value");
      		document.getElementById("weft_yarn_tear_force_max_value").focus();
      		return false;
		}
		else if(isNaN(document.getElementById("weft_yarn_tear_force_max_value").value.trim()))
		{
      		alert("Weft Yarn Tear Force Max Value should be Numeric");
			document.getElementById("weft_yarn_tear_force_max_value").value="";
      		document.getElementById("weft_yarn_tear_force_max_value").focus();
      		return false;
		}*/

}

