

function Calendering_Form_Validation()
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
		else if(document.getElementById("finish_width_in_inch").value.trim()=="")
		{
      		alert("Please Provide Finish Width");
      		document.getElementById("finish_width_in_inch").focus();
      		return false;
		}*/
		else if(isNaN(document.getElementById("finish_width_in_inch").value.trim()))
		{
      		alert("Finish Width should be Numeric");
			document.getElementById("finish_width_in_inch").value="";
      		document.getElementById("finish_width_in_inch").focus();
      		return false;
		}
		/*else if(document.getElementById("standard_for_which_process").value.trim()=="")
		{
      		alert("Please Provide Standard For Which Process");
      		document.getElementById("standard_for_which_process").focus();
      		return false;
		}*/
		/*else if(document.getElementById("color_fastness_to_rubbing_dry_value").value.trim()=="")
		{
      		alert("Please Provide Yarn Count Warp Value");
      		document.getElementById("color_fastness_to_rubbing_dry_value").focus();
      		return false;
		}
		else if(isNaN(document.getElementById("color_fastness_to_rubbing_dry_value").value.trim()))
		{
      		alert("Value should be Numeric");
			document.getElementById("color_fastness_to_rubbing_dry_value").value="";
      		document.getElementById("color_fastness_to_rubbing_dry_value").focus();
      		return false;
		}
		
		else if(document.getElementById("color_fastness_to_rubbing_dry_tolerance_range_math_operator").value=="select")
		{
      		alert("Please Select  Tolerance Range Math Operator");
      		document.getElementById("color_fastness_to_rubbing_dry_tolerance_range_math_operator").focus();
      		return false;
		}
		else if(document.getElementById("color_fastness_to_rubbing_dry_tolerance_value").value.trim()=="")
		{
      		alert("Please Provide  Tolerance Value In Percentage");
      		document.getElementById("color_fastness_to_rubbing_dry_tolerance_value").focus();
      		return false;
		}
		else if(isNaN(document.getElementById("color_fastness_to_rubbing_dry_tolerance_value").value.trim()))
		{
      		alert("Tolerance Value In Percentage should be Numeric");
			document.getElementById("color_fastness_to_rubbing_dry_tolerance_value").value="";
      		document.getElementById("color_fastness_to_rubbing_dry_tolerance_value").focus();
      		return false;
		}
		else if(document.getElementById("color_fastness_to_rubbing_dry_min_value").value.trim()=="")
		{
      		alert("Please Provide  Min Value");
      		document.getElementById("color_fastness_to_rubbing_dry_min_value").focus();
      		return false;
		}
		else if(isNaN(document.getElementById("color_fastness_to_rubbing_dry_min_value").value.trim()))
		{
      		alert("Min Value should be Numeric");
			document.getElementById("color_fastness_to_rubbing_dry_min_value").value="";
      		document.getElementById("color_fastness_to_rubbing_dry_min_value").focus();
      		return false;
		}
		else if(document.getElementById("color_fastness_to_rubbing_dry_max_value").value.trim()=="")
		{
      		alert("Please Provide uom_of_color_fastness_to_rubbing_dry Max Value");
      		document.getElementById("color_fastness_to_rubbing_dry_max_value").focus();
      		return false;
		}
		else if(isNaN(document.getElementById("color_fastness_to_rubbing_dry_max_value").value.trim()))
		{
      		alert("uom_of_color_fastness_to_rubbing_dry_value should be Numeric");
			document.getElementById("color_fastness_to_rubbing_dry_max_value").value="";
      		document.getElementById("color_fastness_to_rubbing_dry_max_value").focus();
      		return false;
		}
		else if(document.getElementById("uom_of_color_fastness_to_rubbing_dry_value").value.trim()=="")
		{
      		alert("Please Provide uom_of_color_fastness_to_rubbing_dry_value");
      		document.getElementById("uom_of_color_fastness_to_rubbing_dry_value").focus();
      		return false;
		}

           

         //color_fastness_to_rubbing_wet

		else if(document.getElementById("color_fastness_to_rubbing_wet_value").value.trim()=="")
		{
      		alert("Please Provide color_fastness_to_rubbing_wet_value");
      		document.getElementById("color_fastness_to_rubbing_wet_value").focus();
      		return false;
		}
		else if(isNaN(document.getElementById("color_fastness_to_rubbing_wet_value").value.trim()))
		{
      		alert("color_fastness_to_rubbing_wet_value Value should be Numeric");
			document.getElementById("color_fastness_to_rubbing_wet_value").value="";
      		document.getElementById("color_fastness_to_rubbing_wet_value").focus();
      		return false;
		}
		
		else if(document.getElementById("color_fastness_to_rubbing_wet_tolerance_range_math_operator").value=="select")
		{
      		alert("Please Select color_fastness_to_rubbing_wet_tolerance_range_math_operator");
      		document.getElementById("color_fastness_to_rubbing_wet_tolerance_range_math_operator").focus();
      		return false;
		}
		else if(document.getElementById("color_fastness_to_rubbing_wet_tolerance_value").value.trim()=="")
		{
      		alert("Please Provide  color_fastness_to_rubbing_wet_tolerance_value");
      		document.getElementById("color_fastness_to_rubbing_wet_tolerance_value").focus();
      		return false;
		}
		else if(isNaN(document.getElementById("color_fastness_to_rubbing_wet_tolerance_value").value.trim()))
		{
      		alert("Tolerance color_fastness_to_rubbing_wet_tolerance_value should be Numeric");
			document.getElementById("color_fastness_to_rubbing_wet_tolerance_value").value="";
      		document.getElementById("color_fastness_to_rubbing_wet_tolerance_value").focus();
      		return false;
		}
		else if(document.getElementById("color_fastness_to_rubbing_wet_min_value").value.trim()=="")
		{
      		alert("Please Provide  color_fastness_to_rubbing_wet_min_value");
      		document.getElementById("color_fastness_to_rubbing_wet_min_value").focus();
      		return false;
		}
		else if(isNaN(document.getElementById("color_fastness_to_rubbing_wet_min_value").value.trim()))
		{
      		alert("Min color_fastness_to_rubbing_wet_min_value should be Numeric");
			document.getElementById("color_fastness_to_rubbing_wet_min_value").value="";
      		document.getElementById("color_fastness_to_rubbing_wet_min_value").focus();
      		return false;
		}
		else if(document.getElementById("color_fastness_to_rubbing_wet_max_value").value.trim()=="")
		{
      		alert("Please Provide  color_fastness_to_rubbing_wet_max_value");
      		document.getElementById("color_fastness_to_rubbing_wet_max_value").focus();
      		return false;
		}
		else if(isNaN(document.getElementById("color_fastness_to_rubbing_dry_max_value").value.trim()))
		{
      		alert("Whiteness color_fastness_to_rubbing_wet_max_value should be Numeric");
			document.getElementById("color_fastness_to_rubbing_wet_max_value").value="";
      		document.getElementById("color_fastness_to_rubbing_wet_max_value").focus();
      		return false;
		}
		else if(document.getElementById("uom_of_color_fastness_to_rubbing_wet").value.trim()=="")
		{
      		alert("Please Provide Uom ");
      		document.getElementById("uom_of_color_fastness_to_rubbing_wet").focus();
      		return false;
		}




		//change_in_warp_for_washing_before_iron_max_value


		else if(document.getElementById("change_in_warp_for_washing_before_iron_min_value").value.trim()=="")
		{
      		alert("Please Provide change_in_warp_for_washing_before_iron_min_value");
      		document.getElementById("change_in_warp_for_washing_before_iron_min_value").focus();
      		return false;
		}
		else if(isNaN(document.getElementById("change_in_warp_for_washing_before_iron_min_value").value.trim()))
		{
      		alert("Min change_in_warp_for_washing_before_iron_min_value should be Numeric");
			document.getElementById("change_in_warp_for_washing_before_iron_min_value").value="";
      		document.getElementById("change_in_warp_for_washing_before_iron_min_value").focus();
      		return false;
		}
		else if(document.getElementById("change_in_warp_for_washing_before_iron_max_value").value.trim()=="")
		{
      		alert("Please Provide change_in_warp_for_washing_before_iron_max_value");
      		document.getElementById("change_in_warp_for_washing_before_iron_max_value").focus();
      		return false;
		}
		else if(isNaN(document.getElementById("color_fastness_to_rubbing_dry_max_value").value.trim()))
		{
      		alert("change_in_warp_for_washing_before_iron_max_value should be Numeric");
			document.getElementById("change_in_warp_for_washing_before_iron_max_value").value="";
      		document.getElementById("change_in_warp_for_washing_before_iron_max_value").focus();
      		return false;
		}
		else if(document.getElementById("uom_of_change_in_warp_for_washing_before_iron").value.trim()=="")
		{
      		alert("Please Provide uom_of_change_in_warp_for_washing_before_iron");
      		document.getElementById("uom_of_change_in_warp_for_washing_before_iron").focus();
      		return false;
		}
      


		//change_in_warp_for_washing_before_iron_max_value


		else if(document.getElementById("change_in_warp_for_washing_after_iron_min_value").value.trim()=="")
		{
      		alert("Please Provide change_in_warp_for_washing_after_iron_min_value");
      		document.getElementById("change_in_warp_for_washing_after_iron_min_value").focus();
      		return false;
		}
		else if(isNaN(document.getElementById("change_in_warp_for_washing_after_iron_min_value").value.trim()))
		{
      		alert("Min change_in_warp_for_washing_after_iron_min_value should be Numeric");
			document.getElementById("change_in_warp_for_washing_after_iron_min_value").value="";
      		document.getElementById("change_in_warp_for_washing_after_iron_min_value").focus();
      		return false;
		}
		else if(document.getElementById("change_in_warp_for_washing_after_iron_max_value").value.trim()=="")
		{
      		alert("Please Provide change_in_warp_for_washing_after_iron_max_value");
      		document.getElementById("change_in_warp_for_washing_after_iron_max_value").focus();
      		return false;
		}
		else if(isNaN(document.getElementById("change_in_warp_for_washing_after_iron_max_value").value.trim()))
		{
      		alert("change_in_warp_for_washing_after_iron_max_value should be Numeric");
			document.getElementById("change_in_warp_for_washing_after_iron_max_value").value="";
      		document.getElementById("change_in_warp_for_washing_after_iron_max_value").focus();
      		return false;
		}
		else if(document.getElementById("change_in_warp_for_washing_before_iron_max_value").value.trim()=="")
		{
      		alert("Please Provide uom_of_change_in_warp_for_washing_after_iron");
      		document.getElementById("uom_of_change_in_warp_for_washing_after_iron").focus();
      		return false;
		}
*/
		
}

