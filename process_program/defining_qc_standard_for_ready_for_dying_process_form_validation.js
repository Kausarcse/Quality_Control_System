

function Ready_For_Dying_Form_Validation()
{


		if(document.getElementById("pp_number_value").value=="select")
		{
      		alert("Please Select PP Number");
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
		else if(document.getElementById("finish_width_in_inch").value.trim()=="")
		{
      		alert("Please Provide Finish Width");
      		document.getElementById("finish_width_in_inch").focus();
      		return false;
		}*/
		/*else if(isNaN(document.getElementById("finish_width_in_inch").value.trim()))
		{
      		alert("Finish Width should be Numeric");
			document.getElementById("finish_width_in_inch").value="";
      		document.getElementById("finish_width_in_inch").focus();
      		return false;
		}
		else if(document.getElementById("standard_for_which_process").value.trim()=="")
		{
      		alert("Please Provide Standard For Which Process");
      		document.getElementById("standard_for_which_process").focus();
      		return false;
		}
		else if(document.getElementById("whiteness_value").value.trim()=="")
		{
      		alert("Please Provide Whiteness Value");
      		document.getElementById("whiteness_value").focus();
      		return false;
		}
		else if(isNaN(document.getElementById("whiteness_value").value.trim()))
		{
      		alert("Whiteness Value should be Numeric");
			document.getElementById("whiteness_value").value="";
      		document.getElementById("whiteness_value").focus();
      		return false;
		}
		else if(document.getElementById("uom_of_whiteness").value.trim()=="")
		{
      		alert("Please Provide Uom Of Whiteness");
      		document.getElementById("uom_of_whiteness").focus();
      		return false;
		}
		else if(document.getElementById("whiteness_tolerance_range_math_operator").value=="select")
		{
      		alert("Please Select Whiteness Tolerance Range Math Operator");
      		document.getElementById("whiteness_tolerance_range_math_operator").focus();
      		return false;
		}
		else if(document.getElementById("whiteness_tolerance_value_in_percentage").value.trim()=="")
		{
      		alert("Please Provide Whiteness Tolerance Value In Percentage");
      		document.getElementById("whiteness_tolerance_value_in_percentage").focus();
      		return false;
		}
		else if(isNaN(document.getElementById("whiteness_tolerance_value_in_percentage").value.trim()))
		{
      		alert("Whiteness Tolerance Value In Percentage should be Numeric");
			document.getElementById("whiteness_tolerance_value_in_percentage").value="";
      		document.getElementById("whiteness_tolerance_value_in_percentage").focus();
      		return false;
		}
		else if(document.getElementById("whiteness_min_value").value.trim()=="")
		{
      		alert("Please Provide Whiteness Min Value");
      		document.getElementById("whiteness_min_value").focus();
      		return false;
		}
		else if(isNaN(document.getElementById("whiteness_min_value").value.trim()))
		{
      		alert("Whiteness Min Value should be Numeric");
			document.getElementById("whiteness_min_value").value="";
      		document.getElementById("whiteness_min_value").focus();
      		return false;
		}
		else if(document.getElementById("whiteness_max_value").value.trim()=="")
		{
      		alert("Please Provide Whiteness Max Value");
      		document.getElementById("whiteness_max_value").focus();
      		return false;
		}
		else if(isNaN(document.getElementById("whiteness_max_value").value.trim()))
		{
      		alert("Whiteness Max Value should be Numeric");
			document.getElementById("whiteness_max_value").value="";
      		document.getElementById("whiteness_max_value").focus();
      		return false;
		}
		else if(document.getElementById("bowing_and_skew_value").value.trim()=="")
		{
      		alert("Please Provide Bowing And Skew Value");
      		document.getElementById("bowing_and_skew_value").focus();
      		return false;
		}
		else if(isNaN(document.getElementById("bowing_and_skew_value").value.trim()))
		{
      		alert("Bowing And Skew Value should be Numeric");
			document.getElementById("bowing_and_skew_value").value="";
      		document.getElementById("bowing_and_skew_value").focus();
      		return false;
		}
		else if(document.getElementById("uom_of_bowing_and_skew").value.trim()=="")
		{
      		alert("Please Provide Uom Of Bowing And Skew");
      		document.getElementById("uom_of_bowing_and_skew").focus();
      		return false;
		}
		else if(document.getElementById("bowing_and_skew_tolerance_range_math_operator").value=="select")
		{
      		alert("Please Select Bowing And Skew Tolerance Range Math Operator");
      		document.getElementById("bowing_and_skew_tolerance_range_math_operator").focus();
      		return false;
		}
		else if(document.getElementById("bowing_and_skew_tolerance_value_in_percentage").value.trim()=="")
		{
      		alert("Please Provide Bowing And Skew Tolerance Value In Percentage");
      		document.getElementById("bowing_and_skew_tolerance_value_in_percentage").focus();
      		return false;
		}
		else if(isNaN(document.getElementById("bowing_and_skew_tolerance_value_in_percentage").value.trim()))
		{
      		alert("Bowing And Skew Tolerance Value In Percentage should be Numeric");
			document.getElementById("bowing_and_skew_tolerance_value_in_percentage").value="";
      		document.getElementById("bowing_and_skew_tolerance_value_in_percentage").focus();
      		return false;
		}
		else if(document.getElementById("bowing_and_skew_min_value").value.trim()=="")
		{
      		alert("Please Provide Bowing And Skew Min Value");
      		document.getElementById("bowing_and_skew_min_value").focus();
      		return false;
		}
		else if(isNaN(document.getElementById("bowing_and_skew_min_value").value.trim()))
		{
      		alert("Bowing And Skew Min Value should be Numeric");
			document.getElementById("bowing_and_skew_min_value").value="";
      		document.getElementById("bowing_and_skew_min_value").focus();
      		return false;
		}
		else if(document.getElementById("bowing_and_skew_max_value").value.trim()=="")
		{
      		alert("Please Provide Bowing And Skew Max Value");
      		document.getElementById("bowing_and_skew_max_value").focus();
      		return false;
		}
		else if(isNaN(document.getElementById("bowing_and_skew_max_value").value.trim()))
		{
      		alert("Bowing And Skew Max Value should be Numeric");
			document.getElementById("bowing_and_skew_max_value").value="";
      		document.getElementById("bowing_and_skew_max_value").focus();
      		return false;
		}
		else if(document.getElementById("ph_value").value.trim()=="")
		{
      		alert("Please Provide Ph Value");
      		document.getElementById("ph_value").focus();
      		return false;
		}
		else if(isNaN(document.getElementById("ph_value").value.trim()))
		{
      		alert("Ph Value should be Numeric");
			document.getElementById("ph_value").value="";
      		document.getElementById("ph_value").focus();
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
		else if(document.getElementById("ph_tolerance_value_in_percentage").value.trim()=="")
		{
      		alert("Please Provide Ph Tolerance Value In Percentage");
      		document.getElementById("ph_tolerance_value_in_percentage").focus();
      		return false;
		}
		else if(isNaN(document.getElementById("ph_tolerance_value_in_percentage").value.trim()))
		{
      		alert("Ph Tolerance Value In Percentage should be Numeric");
			document.getElementById("ph_tolerance_value_in_percentage").value="";
      		document.getElementById("ph_tolerance_value_in_percentage").focus();
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

