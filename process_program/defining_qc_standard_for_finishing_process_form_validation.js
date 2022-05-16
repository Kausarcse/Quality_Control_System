function Finishing_Form_Validation()
{
		if(document.getElementById("pp_number_value").value.trim()=="")
		{
      		alert("Please Provide PP Number");
      		document.getElementById("pp_number_value").focus();
      		return false;
		}
		else if(document.getElementById("version_number").value.trim()=="")
		{
      		alert("Please Provide Version Number");
      		document.getElementById("version_number").focus();
      		return false;
		}
		// else if(document.getElementById("customer_name").value.trim()=="")
		// {
      	// 	alert("Please Provide PP and Version Number");
      	// 	document.getElementById("customer_name").focus();
      	// 	return false;
		// }
		// else if(document.getElementById("color").value.trim()=="")
		// {
      	// 	alert("Please Provide Color");
      	// 	document.getElementById("color").focus();
      	// 	return false;
		// }
		// else if(document.getElementById("finish_width_in_inch").value.trim()=="")
		// {
      	// 	alert("Please Provide Finish Width");
      	// 	document.getElementById("finish_width_in_inch").focus();
      	// 	return false;
		// }
		// else if(isNaN(document.getElementById("finish_width_in_inch").value.trim()))
		// {
      	// 	alert("Finish Width should be Numeric");
		// 	document.getElementById("finish_width_in_inch").value="";
      	// 	document.getElementById("finish_width_in_inch").focus();
      	// 	return false;
		// }
		/*else if(document.getElementById("standard_for_which_process").value.trim()=="")
		{
      		alert("Please Provide Standard For Which Process");
      		document.getElementById("standard_for_which_process").focus();
      		return false;
		}*/
		/*else if(document.getElementById("cf_to_rubbing_dry_tolerance_range_math_operator").value.trim()=="")
		{
      		alert("Please Provide Cf To Rubbing Dry Tolerance Range Math Operator");
      		document.getElementById("cf_to_rubbing_dry_tolerance_range_math_operator").focus();
      		return false;
		}
		else if(document.getElementById("cf_to_rubbing_dry_tolerance_value").value.trim()=="")
		{
      		alert("Please Provide Cf To Rubbing Dry Tolerance Value");
      		document.getElementById("cf_to_rubbing_dry_tolerance_value").focus();
      		return false;
		}
		else if(isNaN(document.getElementById("cf_to_rubbing_dry_tolerance_value").value.trim()))
		{
      		alert("Cf To Rubbing Dry Tolerance Value should be Numeric");
			document.getElementById("cf_to_rubbing_dry_tolerance_value").value="";
      		document.getElementById("cf_to_rubbing_dry_tolerance_value").focus();
      		return false;
		}
		else if(document.getElementById("cf_to_rubbing_dry_min_value").value.trim()=="")
		{
      		alert("Please Provide Cf To Rubbing Dry Min Value");
      		document.getElementById("cf_to_rubbing_dry_min_value").focus();
      		return false;
		}
		else if(isNaN(document.getElementById("cf_to_rubbing_dry_min_value").value.trim()))
		{
      		alert("Cf To Rubbing Dry Min Value should be Numeric");
			document.getElementById("cf_to_rubbing_dry_min_value").value="";
      		document.getElementById("cf_to_rubbing_dry_min_value").focus();
      		return false;
		}
		else if(document.getElementById("cf_to_rubbing_dry_max_value").value.trim()=="")
		{
      		alert("Please Provide Cf To Rubbing Dry Max Value");
      		document.getElementById("cf_to_rubbing_dry_max_value").focus();
      		return false;
		}
		else if(isNaN(document.getElementById("cf_to_rubbing_dry_max_value").value.trim()))
		{
      		alert("Cf To Rubbing Dry Max Value should be Numeric");
			document.getElementById("cf_to_rubbing_dry_max_value").value="";
      		document.getElementById("cf_to_rubbing_dry_max_value").focus();
      		return false;
		}
		else if(document.getElementById("uom_of_cf_to_rubbing_dry").value.trim()=="")
		{
      		alert("Please Provide Uom Of Cf To Rubbing Dry");
      		document.getElementById("uom_of_cf_to_rubbing_dry").focus();
      		return false;
		}
		else if(document.getElementById("cf_to_rubbing_wet_tolerance_range_math_operator").value.trim()=="")
		{
      		alert("Please Provide Cf To Rubbing Wet Tolerance Range Math Operator");
      		document.getElementById("cf_to_rubbing_wet_tolerance_range_math_operator").focus();
      		return false;
		}
		else if(document.getElementById("cf_to_rubbing_wet_tolerance_value").value.trim()=="")
		{
      		alert("Please Provide Cf To Rubbing Wet Tolerance Value");
      		document.getElementById("cf_to_rubbing_wet_tolerance_value").focus();
      		return false;
		}
		else if(isNaN(document.getElementById("cf_to_rubbing_wet_tolerance_value").value.trim()))
		{
      		alert("Cf To Rubbing Wet Tolerance Value should be Numeric");
			document.getElementById("cf_to_rubbing_wet_tolerance_value").value="";
      		document.getElementById("cf_to_rubbing_wet_tolerance_value").focus();
      		return false;
		}
		else if(document.getElementById("cf_to_rubbing_wet_min_value").value.trim()=="")
		{
      		alert("Please Provide Cf To Rubbing Wet Min Value");
      		document.getElementById("cf_to_rubbing_wet_min_value").focus();
      		return false;
		}
		else if(isNaN(document.getElementById("cf_to_rubbing_wet_min_value").value.trim()))
		{
      		alert("Cf To Rubbing Wet Min Value should be Numeric");
			document.getElementById("cf_to_rubbing_wet_min_value").value="";
      		document.getElementById("cf_to_rubbing_wet_min_value").focus();
      		return false;
		}
		else if(document.getElementById("cf_to_rubbing_wet_max_value").value.trim()=="")
		{
      		alert("Please Provide Cf To Rubbing Wet Max Value");
      		document.getElementById("cf_to_rubbing_wet_max_value").focus();
      		return false;
		}
		else if(isNaN(document.getElementById("cf_to_rubbing_wet_max_value").value.trim()))
		{
      		alert("Cf To Rubbing Wet Max Value should be Numeric");
			document.getElementById("cf_to_rubbing_wet_max_value").value="";
      		document.getElementById("cf_to_rubbing_wet_max_value").focus();
      		return false;
		}
		else if(document.getElementById("uom_of_cf_to_rubbing_wet").value.trim()=="")
		{
      		alert("Please Provide Uom Of Cf To Rubbing Wet");
      		document.getElementById("uom_of_cf_to_rubbing_wet").focus();
      		return false;
		}
		else if(document.getElementById("dimensional_stability_to_warp_washing_before_iron_min_value").value.trim()=="")
		{
      		alert("Please Provide Change In Warp For Washing Before Iron Min Value");
      		document.getElementById("dimensional_stability_to_warp_washing_before_iron_min_value").focus();
      		return false;
		}
		else if(isNaN(document.getElementById("dimensional_stability_to_warp_washing_before_iron_min_value").value.trim()))
		{
      		alert("Change In Warp For Washing Before Iron Min Value should be Numeric");
			document.getElementById("dimensional_stability_to_warp_washing_before_iron_min_value").value="";
      		document.getElementById("dimensional_stability_to_warp_washing_before_iron_min_value").focus();
      		return false;
		}
		else if(document.getElementById("dimensional_stability_to_warp_washing_before_iron_max_value").value.trim()=="")
		{
      		alert("Please Provide Change In Warp For Washing Before Iron Max Value");
      		document.getElementById("dimensional_stability_to_warp_washing_before_iron_max_value").focus();
      		return false;
		}
		else if(isNaN(document.getElementById("dimensional_stability_to_warp_washing_before_iron_max_value").value.trim()))
		{
      		alert("Change In Warp For Washing Before Iron Max Value should be Numeric");
			document.getElementById("dimensional_stability_to_warp_washing_before_iron_max_value").value="";
      		document.getElementById("dimensional_stability_to_warp_washing_before_iron_max_value").focus();
      		return false;
		}
		else if(document.getElementById("uom_of_dimensional_stability_to_warp_washing_before_iron").value.trim()=="")
		{
      		alert("Please Provide Uom Of Change In Warp For Washing Before Iron");
      		document.getElementById("uom_of_dimensional_stability_to_warp_washing_before_iron").focus();
      		return false;
		}
		else if(document.getElementById("dimensional_stability_to_weft_washing_before_iron_min_value").value.trim()=="")
		{
      		alert("Please Provide Change In Weft For Washing Before Iron Min Value");
      		document.getElementById("dimensional_stability_to_weft_washing_before_iron_min_value").focus();
      		return false;
		}
		else if(isNaN(document.getElementById("dimensional_stability_to_weft_washing_before_iron_min_value").value.trim()))
		{
      		alert("Change In Weft For Washing Before Iron Min Value should be Numeric");
			document.getElementById("dimensional_stability_to_weft_washing_before_iron_min_value").value="";
      		document.getElementById("dimensional_stability_to_weft_washing_before_iron_min_value").focus();
      		return false;
		}
		else if(document.getElementById("dimensional_stability_to_weft_washing_before_iron_max_value").value.trim()=="")
		{
      		alert("Please Provide Change In Weft For Washing Before Iron Max Value");
      		document.getElementById("dimensional_stability_to_weft_washing_before_iron_max_value").focus();
      		return false;
		}
		else if(isNaN(document.getElementById("dimensional_stability_to_weft_washing_before_iron_max_value").value.trim()))
		{
      		alert("Change In Weft For Washing Before Iron Max Value should be Numeric");
			document.getElementById("dimensional_stability_to_weft_washing_before_iron_max_value").value="";
      		document.getElementById("dimensional_stability_to_weft_washing_before_iron_max_value").focus();
      		return false;
		}
		else if(document.getElementById("uom_of_dimensional_stability_to_weft_washing_before_iron").value.trim()=="")
		{
      		alert("Please Provide Uom Of Change In Weft For Washing Before Iron");
      		document.getElementById("uom_of_dimensional_stability_to_weft_washing_before_iron").focus();
      		return false;
		}*/
		/*else if(document.getElementById("dimensional_stability_to_warp_washing_after_iron_min_value").value.trim()=="")
		{
      		alert("Please Provide Change In Warp For Washing After Iron Min Value");
      		document.getElementById("dimensional_stability_to_warp_washing_after_iron_min_value").focus();
      		return false;
		}
		else if(isNaN(document.getElementById("dimensional_stability_to_warp_washing_after_iron_min_value").value.trim()))
		{
      		alert("Change In Warp For Washing After Iron Min Value should be Numeric");
			document.getElementById("dimensional_stability_to_warp_washing_after_iron_min_value").value="";
      		document.getElementById("dimensional_stability_to_warp_washing_after_iron_min_value").focus();
      		return false;
		}
		else if(document.getElementById("dimensional_stability_to_warp_washing_after_iron_max_value").value.trim()=="")
		{
      		alert("Please Provide Change In Warp For Washing After Iron Max Value");
      		document.getElementById("dimensional_stability_to_warp_washing_after_iron_max_value").focus();
      		return false;
		}
		else if(isNaN(document.getElementById("dimensional_stability_to_warp_washing_after_iron_max_value").value.trim()))
		{
      		alert("Change In Warp For Washing After Iron Max Value should be Numeric");
			document.getElementById("dimensional_stability_to_warp_washing_after_iron_max_value").value="";
      		document.getElementById("dimensional_stability_to_warp_washing_after_iron_max_value").focus();
      		return false;
		}
		else if(document.getElementById("uom_of_dimensional_stability_to_warp_washing_after_iron").value.trim()=="")
		{
      		alert("Please Provide Uom Of Change In Warp For Washing After Iron");
      		document.getElementById("uom_of_dimensional_stability_to_warp_washing_after_iron").focus();
      		return false;
		}
		else if(document.getElementById("dimensional_stability_to_weft_washing_after_iron_min_value").value.trim()=="")
		{
      		alert("Please Provide Change In Weft For Washing After Iron Min Value");
      		document.getElementById("dimensional_stability_to_weft_washing_after_iron_min_value").focus();
      		return false;
		}
		else if(isNaN(document.getElementById("dimensional_stability_to_weft_washing_after_iron_min_value").value.trim()))
		{
      		alert("Change In Weft For Washing After Iron Min Value should be Numeric");
			document.getElementById("dimensional_stability_to_weft_washing_after_iron_min_value").value="";
      		document.getElementById("dimensional_stability_to_weft_washing_after_iron_min_value").focus();
      		return false;
		}
		else if(document.getElementById("dimensional_stability_to_weft_washing_after_iron_max_value").value.trim()=="")
		{
      		alert("Please Provide Change In Weft For Washing After Iron Max Value");
      		document.getElementById("dimensional_stability_to_weft_washing_after_iron_max_value").focus();
      		return false;
		}
		else if(isNaN(document.getElementById("dimensional_stability_to_weft_washing_after_iron_max_value").value.trim()))
		{
      		alert("Change In Weft For Washing After Iron Max Value should be Numeric");
			document.getElementById("dimensional_stability_to_weft_washing_after_iron_max_value").value="";
      		document.getElementById("dimensional_stability_to_weft_washing_after_iron_max_value").focus();
      		return false;
		}
		else if(document.getElementById("uom_of_dimensional_stability_to_weft_washing_after_iron").value.trim()=="")
		{
      		alert("Please Provide Uom Of Change In Weft For Washing After Iron");
      		document.getElementById("uom_of_dimensional_stability_to_weft_washing_after_iron").focus();
      		return false;
		}
		else if(document.getElementById("change_in_warp_for_dry_cleaning_min_value").value.trim()=="")
		{
      		alert("Please Provide Change In Warp For Dry Cleaning Min Value");
      		document.getElementById("change_in_warp_for_dry_cleaning_min_value").focus();
      		return false;
		}
		else if(isNaN(document.getElementById("change_in_warp_for_dry_cleaning_min_value").value.trim()))
		{
      		alert("Change In Warp For Dry Cleaning Min Value should be Numeric");
			document.getElementById("change_in_warp_for_dry_cleaning_min_value").value="";
      		document.getElementById("change_in_warp_for_dry_cleaning_min_value").focus();
      		return false;
		}
		else if(document.getElementById("change_in_warp_for_dry_cleaning_max_value").value.trim()=="")
		{
      		alert("Please Provide Change In Warp For Dry Cleaning Max Value");
      		document.getElementById("change_in_warp_for_dry_cleaning_max_value").focus();
      		return false;
		}
		else if(isNaN(document.getElementById("change_in_warp_for_dry_cleaning_max_value").value.trim()))
		{
      		alert("Change In Warp For Dry Cleaning Max Value should be Numeric");
			document.getElementById("change_in_warp_for_dry_cleaning_max_value").value="";
      		document.getElementById("change_in_warp_for_dry_cleaning_max_value").focus();
      		return false;
		}
		else if(document.getElementById("uom_of_change_in_warp_for_dry_cleaning").value.trim()=="")
		{
      		alert("Please Provide Uom Of Change In Warp For Dry Cleaning");
      		document.getElementById("uom_of_change_in_warp_for_dry_cleaning").focus();
      		return false;
		}
		else if(document.getElementById("change_in_weft_for_dry_cleaning_min_value").value.trim()=="")
		{
      		alert("Please Provide Change In Weft For Dry Cleaning Min Value");
      		document.getElementById("change_in_weft_for_dry_cleaning_min_value").focus();
      		return false;
		}
		else if(isNaN(document.getElementById("change_in_weft_for_dry_cleaning_min_value").value.trim()))
		{
      		alert("Change In Weft For Dry Cleaning Min Value should be Numeric");
			document.getElementById("change_in_weft_for_dry_cleaning_min_value").value="";
      		document.getElementById("change_in_weft_for_dry_cleaning_min_value").focus();
      		return false;
		}
		else if(document.getElementById("change_in_weft_for_dry_cleaning_max_value").value.trim()=="")
		{
      		alert("Please Provide Change In Weft For Dry Cleaning Max Value");
      		document.getElementById("change_in_weft_for_dry_cleaning_max_value").focus();
      		return false;
		}
		else if(isNaN(document.getElementById("change_in_weft_for_dry_cleaning_max_value").value.trim()))
		{
      		alert("Change In Weft For Dry Cleaning Max Value should be Numeric");
			document.getElementById("change_in_weft_for_dry_cleaning_max_value").value="";
      		document.getElementById("change_in_weft_for_dry_cleaning_max_value").focus();
      		return false;
		}
		else if(document.getElementById("uom_of_change_in_weft_for_dry_cleaning").value.trim()=="")
		{
      		alert("Please Provide Uom Of Change In Weft For Dry Cleaning");
      		document.getElementById("uom_of_change_in_weft_for_dry_cleaning").focus();
      		return false;
		}
		else if(document.getElementById("warp_yarn_count_value").value.trim()=="")
		{
      		alert("Please Provide Warp Yarn Count Value");
      		document.getElementById("warp_yarn_count_value").focus();
      		return false;
		}
		else if(isNaN(document.getElementById("warp_yarn_count_value").value.trim()))
		{
      		alert("Warp Yarn Count Value should be Numeric");
			document.getElementById("warp_yarn_count_value").value="";
      		document.getElementById("warp_yarn_count_value").focus();
      		return false;
		}
		else if(document.getElementById("warp_yarn_count_tolerance_range_math_operator").value.trim()=="")
		{
      		alert("Please Provide Warp Yarn Count Tolerance Range Math Operator");
      		document.getElementById("warp_yarn_count_tolerance_range_math_operator").focus();
      		return false;
		}
		else if(document.getElementById("warp_yarn_count_tolerance_value").value.trim()=="")
		{
      		alert("Please Provide Warp Yarn Count Tolerance Value");
      		document.getElementById("warp_yarn_count_tolerance_value").focus();
      		return false;
		}
		else if(isNaN(document.getElementById("warp_yarn_count_tolerance_value").value.trim()))
		{
      		alert("Warp Yarn Count Tolerance Value should be Numeric");
			document.getElementById("warp_yarn_count_tolerance_value").value="";
      		document.getElementById("warp_yarn_count_tolerance_value").focus();
      		return false;
		}
		else if(document.getElementById("warp_yarn_count_min_value").value.trim()=="")
		{
      		alert("Please Provide Warp Yarn Count Min Value");
      		document.getElementById("warp_yarn_count_min_value").focus();
      		return false;
		}
		else if(isNaN(document.getElementById("warp_yarn_count_min_value").value.trim()))
		{
      		alert("Warp Yarn Count Min Value should be Numeric");
			document.getElementById("warp_yarn_count_min_value").value="";
      		document.getElementById("warp_yarn_count_min_value").focus();
      		return false;
		}
		else if(document.getElementById("warp_yarn_count_max_value").value.trim()=="")
		{
      		alert("Please Provide Warp Yarn Count Max Value");
      		document.getElementById("warp_yarn_count_max_value").focus();
      		return false;
		}
		else if(isNaN(document.getElementById("warp_yarn_count_max_value").value.trim()))
		{
      		alert("Warp Yarn Count Max Value should be Numeric");
			document.getElementById("warp_yarn_count_max_value").value="";
      		document.getElementById("warp_yarn_count_max_value").focus();
      		return false;
		}
		else if(document.getElementById("uom_of_warp_yarn_count_value").value.trim()=="")
		{
      		alert("Please Provide Uom Of Warp Yarn Count Value");
      		document.getElementById("uom_of_warp_yarn_count_value").focus();
      		return false;
		}
		else if(document.getElementById("mass_per_unit_per_area_value").value.trim()=="")
		{
      		alert("Please Provide Mass Per Unit Per Area Value");
      		document.getElementById("mass_per_unit_per_area_value").focus();
      		return false;
		}
		else if(isNaN(document.getElementById("mass_per_unit_per_area_value").value.trim()))
		{
      		alert("Mass Per Unit Per Area Value should be Numeric");
			document.getElementById("mass_per_unit_per_area_value").value="";
      		document.getElementById("mass_per_unit_per_area_value").focus();
      		return false;
		}
		else if(document.getElementById("mass_per_unit_per_area_tolerance_range_math_operator").value.trim()=="")
		{
      		alert("Please Provide Mass Per Unit Per Area Tolerance Range Math Operator");
      		document.getElementById("mass_per_unit_per_area_tolerance_range_math_operator").focus();
      		return false;
		}
		else if(document.getElementById("mass_per_unit_per_area_tolerance_value").value.trim()=="")
		{
      		alert("Please Provide Mass Per Unit Per Area Tolerance Value");
      		document.getElementById("mass_per_unit_per_area_tolerance_value").focus();
      		return false;
		}
		else if(isNaN(document.getElementById("mass_per_unit_per_area_tolerance_value").value.trim()))
		{
      		alert("Mass Per Unit Per Area Tolerance Value should be Numeric");
			document.getElementById("mass_per_unit_per_area_tolerance_value").value="";
      		document.getElementById("mass_per_unit_per_area_tolerance_value").focus();
      		return false;
		}
		else if(document.getElementById("mass_per_unit_per_area_min_value").value.trim()=="")
		{
      		alert("Please Provide Mass Per Unit Per Area Min Value");
      		document.getElementById("mass_per_unit_per_area_min_value").focus();
      		return false;
		}
		else if(isNaN(document.getElementById("mass_per_unit_per_area_min_value").value.trim()))
		{
      		alert("Mass Per Unit Per Area Min Value should be Numeric");
			document.getElementById("mass_per_unit_per_area_min_value").value="";
      		document.getElementById("mass_per_unit_per_area_min_value").focus();
      		return false;
		}
		else if(document.getElementById("mass_per_unit_per_area_max_value").value.trim()=="")
		{
      		alert("Please Provide Mass Per Unit Per Area Max Value");
      		document.getElementById("mass_per_unit_per_area_max_value").focus();
      		return false;
		}
		else if(isNaN(document.getElementById("mass_per_unit_per_area_max_value").value.trim()))
		{
      		alert("Mass Per Unit Per Area Max Value should be Numeric");
			document.getElementById("mass_per_unit_per_area_max_value").value="";
      		document.getElementById("mass_per_unit_per_area_max_value").focus();
      		return false;
		}
		else if(document.getElementById("uom_of_mass_per_unit_per_area_value").value.trim()=="")
		{
      		alert("Please Provide Uom Of Mass Per Unit Per Area Value");
      		document.getElementById("uom_of_mass_per_unit_per_area_value").focus();
      		return false;
		}
		else if(document.getElementById("no_of_threads_in_warp_value").value.trim()=="")
		{
      		alert("Please Provide No Of Threads In Warp Value");
      		document.getElementById("no_of_threads_in_warp_value").focus();
      		return false;
		}
		else if(isNaN(document.getElementById("no_of_threads_in_warp_value").value.trim()))
		{
      		alert("No Of Threads In Warp Value should be Numeric");
			document.getElementById("no_of_threads_in_warp_value").value="";
      		document.getElementById("no_of_threads_in_warp_value").focus();
      		return false;
		}
		else if(document.getElementById("no_of_threads_in_warp_tolerance_range_math_operator").value.trim()=="")
		{
      		alert("Please Provide No Of Threads In Warp Tolerance Range Math Operator");
      		document.getElementById("no_of_threads_in_warp_tolerance_range_math_operator").focus();
      		return false;
		}
		else if(document.getElementById("no_of_threads_in_warp_tolerance_value").value.trim()=="")
		{
      		alert("Please Provide No Of Threads In Warp Tolerance Value");
      		document.getElementById("no_of_threads_in_warp_tolerance_value").focus();
      		return false;
		}
		else if(isNaN(document.getElementById("no_of_threads_in_warp_tolerance_value").value.trim()))
		{
      		alert("No Of Threads In Warp Tolerance Value should be Numeric");
			document.getElementById("no_of_threads_in_warp_tolerance_value").value="";
      		document.getElementById("no_of_threads_in_warp_tolerance_value").focus();
      		return false;
		}
		else if(document.getElementById("no_of_threads_in_warp_min_value").value.trim()=="")
		{
      		alert("Please Provide No Of Threads In Warp Min Value");
      		document.getElementById("no_of_threads_in_warp_min_value").focus();
      		return false;
		}
		else if(isNaN(document.getElementById("no_of_threads_in_warp_min_value").value.trim()))
		{
      		alert("No Of Threads In Warp Min Value should be Numeric");
			document.getElementById("no_of_threads_in_warp_min_value").value="";
      		document.getElementById("no_of_threads_in_warp_min_value").focus();
      		return false;
		}
		else if(document.getElementById("no_of_threads_in_warp_max_value").value.trim()=="")
		{
      		alert("Please Provide No Of Threads In Warp Max Value");
      		document.getElementById("no_of_threads_in_warp_max_value").focus();
      		return false;
		}
		else if(isNaN(document.getElementById("no_of_threads_in_warp_max_value").value.trim()))
		{
      		alert("No Of Threads In Warp Max Value should be Numeric");
			document.getElementById("no_of_threads_in_warp_max_value").value="";
      		document.getElementById("no_of_threads_in_warp_max_value").focus();
      		return false;
		}
		else if(document.getElementById("uom_of_no_of_threads_in_warp_value").value.trim()=="")
		{
      		alert("Please Provide Uom Of No Of Threads In Warp Value");
      		document.getElementById("uom_of_no_of_threads_in_warp_value").focus();
      		return false;
		}
		else if(document.getElementById("no_of_threads_in_weft_value").value.trim()=="")
		{
      		alert("Please Provide No Of Threads In Weft Value");
      		document.getElementById("no_of_threads_in_weft_value").focus();
      		return false;
		}
		else if(isNaN(document.getElementById("no_of_threads_in_weft_value").value.trim()))
		{
      		alert("No Of Threads In Weft Value should be Numeric");
			document.getElementById("no_of_threads_in_weft_value").value="";
      		document.getElementById("no_of_threads_in_weft_value").focus();
      		return false;
		}
		else if(document.getElementById("no_of_threads_in_weft_tolerance_range_math_operator").value.trim()=="")
		{
      		alert("Please Provide No Of Threads In Weft Tolerance Range Math Operator");
      		document.getElementById("no_of_threads_in_weft_tolerance_range_math_operator").focus();
      		return false;
		}
		else if(document.getElementById("no_of_threads_in_weft_tolerance_value").value.trim()=="")
		{
      		alert("Please Provide No Of Threads In Weft Tolerance Value");
      		document.getElementById("no_of_threads_in_weft_tolerance_value").focus();
      		return false;
		}
		else if(isNaN(document.getElementById("no_of_threads_in_weft_tolerance_value").value.trim()))
		{
      		alert("No Of Threads In Weft Tolerance Value should be Numeric");
			document.getElementById("no_of_threads_in_weft_tolerance_value").value="";
      		document.getElementById("no_of_threads_in_weft_tolerance_value").focus();
      		return false;
		}
		else if(document.getElementById("no_of_threads_in_weft_min_value").value.trim()=="")
		{
      		alert("Please Provide No Of Threads In Weft Min Value");
      		document.getElementById("no_of_threads_in_weft_min_value").focus();
      		return false;
		}
		else if(isNaN(document.getElementById("no_of_threads_in_weft_min_value").value.trim()))
		{
      		alert("No Of Threads In Weft Min Value should be Numeric");
			document.getElementById("no_of_threads_in_weft_min_value").value="";
      		document.getElementById("no_of_threads_in_weft_min_value").focus();
      		return false;
		}
		else if(document.getElementById("no_of_threads_in_weft_max_value").value.trim()=="")
		{
      		alert("Please Provide No Of Threads In Weft Max Value");
      		document.getElementById("no_of_threads_in_weft_max_value").focus();
      		return false;
		}
		else if(isNaN(document.getElementById("no_of_threads_in_weft_max_value").value.trim()))
		{
      		alert("No Of Threads In Weft Max Value should be Numeric");
			document.getElementById("no_of_threads_in_weft_max_value").value="";
      		document.getElementById("no_of_threads_in_weft_max_value").focus();
      		return false;
		}
		else if(document.getElementById("uom_of_no_of_threads_in_weft_value").value.trim()=="")
		{
      		alert("Please Provide Uom Of No Of Threads In Weft Value");
      		document.getElementById("uom_of_no_of_threads_in_weft_value").focus();
      		return false;
		}
		else if(document.getElementById("surface_fuzzing_and_pilling_tolerance_range_math_operator").value.trim()=="")
		{
      		alert("Please Provide Surface Fuzzing And Pilling Tolerance Range Math Operator");
      		document.getElementById("surface_fuzzing_and_pilling_tolerance_range_math_operator").focus();
      		return false;
		}
		else if(document.getElementById("surface_fuzzing_and_pilling_tolerance_value").value.trim()=="")
		{
      		alert("Please Provide Surface Fuzzing And Pilling Tolerance Value");
      		document.getElementById("surface_fuzzing_and_pilling_tolerance_value").focus();
      		return false;
		}
		else if(isNaN(document.getElementById("surface_fuzzing_and_pilling_tolerance_value").value.trim()))
		{
      		alert("Surface Fuzzing And Pilling Tolerance Value should be Numeric");
			document.getElementById("surface_fuzzing_and_pilling_tolerance_value").value="";
      		document.getElementById("surface_fuzzing_and_pilling_tolerance_value").focus();
      		return false;
		}
		else if(document.getElementById("surface_fuzzing_and_pilling_min_value").value.trim()=="")
		{
      		alert("Please Provide Surface Fuzzing And Pilling Min Value");
      		document.getElementById("surface_fuzzing_and_pilling_min_value").focus();
      		return false;
		}
		else if(isNaN(document.getElementById("surface_fuzzing_and_pilling_min_value").value.trim()))
		{
      		alert("Surface Fuzzing And Pilling Min Value should be Numeric");
			document.getElementById("surface_fuzzing_and_pilling_min_value").value="";
      		document.getElementById("surface_fuzzing_and_pilling_min_value").focus();
      		return false;
		}
		else if(document.getElementById("surface_fuzzing_and_pilling_max_value").value.trim()=="")
		{
      		alert("Please Provide Surface Fuzzing And Pilling Max Value");
      		document.getElementById("surface_fuzzing_and_pilling_max_value").focus();
      		return false;
		}
		else if(isNaN(document.getElementById("surface_fuzzing_and_pilling_max_value").value.trim()))
		{
      		alert("Surface Fuzzing And Pilling Max Value should be Numeric");
			document.getElementById("surface_fuzzing_and_pilling_max_value").value="";
      		document.getElementById("surface_fuzzing_and_pilling_max_value").focus();
      		return false;
		}
		else if(document.getElementById("uom_of_surface_fuzzing_and_pilling_value").value.trim()=="")
		{
      		alert("Please Provide Uom Of Surface Fuzzing And Pilling Value");
      		document.getElementById("uom_of_surface_fuzzing_and_pilling_value").focus();
      		return false;
		}
		else if(document.getElementById("tensile_properties_in_warp_value_tolerance_range_math_operator").value.trim()=="")
		{
      		alert("Please Provide Tensile Properties In Warp Value Tolerance Range Math Operator");
      		document.getElementById("tensile_properties_in_warp_value_tolerance_range_math_operator").focus();
      		return false;
		}
		else if(document.getElementById("tensile_properties_in_warp_value_tolerance_value").value.trim()=="")
		{
      		alert("Please Provide Tensile Properties In Warp Value Tolerance Value");
      		document.getElementById("tensile_properties_in_warp_value_tolerance_value").focus();
      		return false;
		}
		else if(isNaN(document.getElementById("tensile_properties_in_warp_value_tolerance_value").value.trim()))
		{
      		alert("Tensile Properties In Warp Value Tolerance Value should be Numeric");
			document.getElementById("tensile_properties_in_warp_value_tolerance_value").value="";
      		document.getElementById("tensile_properties_in_warp_value_tolerance_value").focus();
      		return false;
		}
		else if(document.getElementById("tensile_properties_in_warp_value_min_value").value.trim()=="")
		{
      		alert("Please Provide Tensile Properties In Warp Value Min Value");
      		document.getElementById("tensile_properties_in_warp_value_min_value").focus();
      		return false;
		}
		else if(isNaN(document.getElementById("tensile_properties_in_warp_value_min_value").value.trim()))
		{
      		alert("Tensile Properties In Warp Value Min Value should be Numeric");
			document.getElementById("tensile_properties_in_warp_value_min_value").value="";
      		document.getElementById("tensile_properties_in_warp_value_min_value").focus();
      		return false;
		}
		else if(document.getElementById("tensile_properties_in_warp_value_max_value").value.trim()=="")
		{
      		alert("Please Provide Tensile Properties In Warp Value Max Value");
      		document.getElementById("tensile_properties_in_warp_value_max_value").focus();
      		return false;
		}
		else if(isNaN(document.getElementById("tensile_properties_in_warp_value_max_value").value.trim()))
		{
      		alert("Tensile Properties In Warp Value Max Value should be Numeric");
			document.getElementById("tensile_properties_in_warp_value_max_value").value="";
      		document.getElementById("tensile_properties_in_warp_value_max_value").focus();
      		return false;
		}
		else if(document.getElementById("uom_of_tensile_properties_in_warp_value").value.trim()=="")
		{
      		alert("Please Provide Uom Of Tensile Properties In Warp Value");
      		document.getElementById("uom_of_tensile_properties_in_warp_value").focus();
      		return false;
		}
		else if(document.getElementById("tear_force_in_warp_value_tolerance_range_math_operator").value.trim()=="")
		{
      		alert("Please Provide Tear Force In Warp Value Tolerance Range Math Operator");
      		document.getElementById("tear_force_in_warp_value_tolerance_range_math_operator").focus();
      		return false;
		}
		else if(document.getElementById("tear_force_in_warp_value_tolerance_value").value.trim()=="")
		{
      		alert("Please Provide Tear Force In Warp Value Tolerance Value");
      		document.getElementById("tear_force_in_warp_value_tolerance_value").focus();
      		return false;
		}
		else if(isNaN(document.getElementById("tear_force_in_warp_value_tolerance_value").value.trim()))
		{
      		alert("Tear Force In Warp Value Tolerance Value should be Numeric");
			document.getElementById("tear_force_in_warp_value_tolerance_value").value="";
      		document.getElementById("tear_force_in_warp_value_tolerance_value").focus();
      		return false;
		}
		else if(document.getElementById("tear_force_in_warp_value_min_value").value.trim()=="")
		{
      		alert("Please Provide Tear Force In Warp Value Min Value");
      		document.getElementById("tear_force_in_warp_value_min_value").focus();
      		return false;
		}
		else if(isNaN(document.getElementById("tear_force_in_warp_value_min_value").value.trim()))
		{
      		alert("Tear Force In Warp Value Min Value should be Numeric");
			document.getElementById("tear_force_in_warp_value_min_value").value="";
      		document.getElementById("tear_force_in_warp_value_min_value").focus();
      		return false;
		}
		else if(document.getElementById("tear_force_in_warp_value_max_value").value.trim()=="")
		{
      		alert("Please Provide Tear Force In Warp Value Max Value");
      		document.getElementById("tear_force_in_warp_value_max_value").focus();
      		return false;
		}
		else if(isNaN(document.getElementById("tear_force_in_warp_value_max_value").value.trim()))
		{
      		alert("Tear Force In Warp Value Max Value should be Numeric");
			document.getElementById("tear_force_in_warp_value_max_value").value="";
      		document.getElementById("tear_force_in_warp_value_max_value").focus();
      		return false;
		}
		else if(document.getElementById("uom_of_tear_force_in_warp_value").value.trim()=="")
		{
      		alert("Please Provide Uom Of Tear Force In Warp Value");
      		document.getElementById("uom_of_tear_force_in_warp_value").focus();
      		return false;
		}
		else if(document.getElementById("tear_force_in_weft_value_tolerance_range_math_operator").value.trim()=="")
		{
      		alert("Please Provide Tear Force In Weft Value Tolerance Range Math Operator");
      		document.getElementById("tear_force_in_weft_value_tolerance_range_math_operator").focus();
      		return false;
		}
		else if(document.getElementById("tear_force_in_weft_value_tolerance_value").value.trim()=="")
		{
      		alert("Please Provide Tear Force In Weft Value Tolerance Value");
      		document.getElementById("tear_force_in_weft_value_tolerance_value").focus();
      		return false;
		}
		else if(isNaN(document.getElementById("tear_force_in_weft_value_tolerance_value").value.trim()))
		{
      		alert("Tear Force In Weft Value Tolerance Value should be Numeric");
			document.getElementById("tear_force_in_weft_value_tolerance_value").value="";
      		document.getElementById("tear_force_in_weft_value_tolerance_value").focus();
      		return false;
		}
		else if(document.getElementById("tear_force_in_weft_value_min_value").value.trim()=="")
		{
      		alert("Please Provide Tear Force In Weft Value Min Value");
      		document.getElementById("tear_force_in_weft_value_min_value").focus();
      		return false;
		}
		else if(isNaN(document.getElementById("tear_force_in_weft_value_min_value").value.trim()))
		{
      		alert("Tear Force In Weft Value Min Value should be Numeric");
			document.getElementById("tear_force_in_weft_value_min_value").value="";
      		document.getElementById("tear_force_in_weft_value_min_value").focus();
      		return false;
		}
		else if(document.getElementById("tear_force_in_weft_value_max_value").value.trim()=="")
		{
      		alert("Please Provide Tear Force In Weft Value Max Value");
      		document.getElementById("tear_force_in_weft_value_max_value").focus();
      		return false;
		}
		else if(isNaN(document.getElementById("tear_force_in_weft_value_max_value").value.trim()))
		{
      		alert("Tear Force In Weft Value Max Value should be Numeric");
			document.getElementById("tear_force_in_weft_value_max_value").value="";
      		document.getElementById("tear_force_in_weft_value_max_value").focus();
      		return false;
		}
		else if(document.getElementById("uom_of_tear_force_in_weft_value").value.trim()=="")
		{
      		alert("Please Provide Uom Of Tear Force In Weft Value");
      		document.getElementById("uom_of_tear_force_in_weft_value").focus();
      		return false;
		}
		else if(document.getElementById("seam_strength_in_warp_value_tolerance_range_math_operator").value.trim()=="")
		{
      		alert("Please Provide Seam Strength In Warp Value Tolerance Range Math Operator");
      		document.getElementById("seam_strength_in_warp_value_tolerance_range_math_operator").focus();
      		return false;
		}
		else if(document.getElementById("seam_strength_in_warp_value_tolerance_value").value.trim()=="")
		{
      		alert("Please Provide Seam Strength In Warp Value Tolerance Value");
      		document.getElementById("seam_strength_in_warp_value_tolerance_value").focus();
      		return false;
		}
		else if(isNaN(document.getElementById("seam_strength_in_warp_value_tolerance_value").value.trim()))
		{
      		alert("Seam Strength In Warp Value Tolerance Value should be Numeric");
			document.getElementById("seam_strength_in_warp_value_tolerance_value").value="";
      		document.getElementById("seam_strength_in_warp_value_tolerance_value").focus();
      		return false;
		}
		else if(document.getElementById("seam_strength_in_warp_value_min_value").value.trim()=="")
		{
      		alert("Please Provide Seam Strength In Warp Value Min Value");
      		document.getElementById("seam_strength_in_warp_value_min_value").focus();
      		return false;
		}
		else if(isNaN(document.getElementById("seam_strength_in_warp_value_min_value").value.trim()))
		{
      		alert("Seam Strength In Warp Value Min Value should be Numeric");
			document.getElementById("seam_strength_in_warp_value_min_value").value="";
      		document.getElementById("seam_strength_in_warp_value_min_value").focus();
      		return false;
		}
		else if(document.getElementById("seam_strength_in_warp_value_max_value").value.trim()=="")
		{
      		alert("Please Provide Seam Strength In Warp Value Max Value");
      		document.getElementById("seam_strength_in_warp_value_max_value").focus();
      		return false;
		}
		else if(isNaN(document.getElementById("seam_strength_in_warp_value_max_value").value.trim()))
		{
      		alert("Seam Strength In Warp Value Max Value should be Numeric");
			document.getElementById("seam_strength_in_warp_value_max_value").value="";
      		document.getElementById("seam_strength_in_warp_value_max_value").focus();
      		return false;
		}
		else if(document.getElementById("uom_of_seam_strength_in_warp_value").value.trim()=="")
		{
      		alert("Please Provide Uom Of Seam Strength In Warp Value");
      		document.getElementById("uom_of_seam_strength_in_warp_value").focus();
      		return false;
		}
		else if(document.getElementById("seam_strength_in_weft_value_tolerance_range_math_operator").value.trim()=="")
		{
      		alert("Please Provide Seam Strength In Weft Value Tolerance Range Math Operator");
      		document.getElementById("seam_strength_in_weft_value_tolerance_range_math_operator").focus();
      		return false;
		}
		else if(document.getElementById("seam_strength_in_weft_value_tolerance_value").value.trim()=="")
		{
      		alert("Please Provide Seam Strength In Weft Value Tolerance Value");
      		document.getElementById("seam_strength_in_weft_value_tolerance_value").focus();
      		return false;
		}
		else if(isNaN(document.getElementById("seam_strength_in_weft_value_tolerance_value").value.trim()))
		{
      		alert("Seam Strength In Weft Value Tolerance Value should be Numeric");
			document.getElementById("seam_strength_in_weft_value_tolerance_value").value="";
      		document.getElementById("seam_strength_in_weft_value_tolerance_value").focus();
      		return false;
		}
		else if(document.getElementById("seam_strength_in_weft_value_min_value").value.trim()=="")
		{
      		alert("Please Provide Seam Strength In Weft Value Min Value");
      		document.getElementById("seam_strength_in_weft_value_min_value").focus();
      		return false;
		}
		else if(isNaN(document.getElementById("seam_strength_in_weft_value_min_value").value.trim()))
		{
      		alert("Seam Strength In Weft Value Min Value should be Numeric");
			document.getElementById("seam_strength_in_weft_value_min_value").value="";
      		document.getElementById("seam_strength_in_weft_value_min_value").focus();
      		return false;
		}
		else if(document.getElementById("seam_strength_in_weft_value_max_value").value.trim()=="")
		{
      		alert("Please Provide Seam Strength In Weft Value Max Value");
      		document.getElementById("seam_strength_in_weft_value_max_value").focus();
      		return false;
		}
		else if(isNaN(document.getElementById("seam_strength_in_weft_value_max_value").value.trim()))
		{
      		alert("Seam Strength In Weft Value Max Value should be Numeric");
			document.getElementById("seam_strength_in_weft_value_max_value").value="";
      		document.getElementById("seam_strength_in_weft_value_max_value").focus();
      		return false;
		}
		else if(document.getElementById("uom_of_seam_strength_in_weft_value").value.trim()=="")
		{
      		alert("Please Provide Uom Of Seam Strength In Weft Value");
      		document.getElementById("uom_of_seam_strength_in_weft_value").focus();
      		return false;
		}
		else if(document.getElementById("abrasion_resistance_s_change_value_math_op").value.trim()=="")
		{
      		alert("Please Provide Abrasion Resistance S Change Value Math Op");
      		document.getElementById("abrasion_resistance_s_change_value_math_op").focus();
      		return false;
		}
		else if(document.getElementById("abrasion_resistance_s_change_value_tolerance_value").value.trim()=="")
		{
      		alert("Please Provide Abrasion Resistance S Change Value Tolerance Value");
      		document.getElementById("abrasion_resistance_s_change_value_tolerance_value").focus();
      		return false;
		}
		else if(isNaN(document.getElementById("abrasion_resistance_s_change_value_tolerance_value").value.trim()))
		{
      		alert("Abrasion Resistance S Change Value Tolerance Value should be Numeric");
			document.getElementById("abrasion_resistance_s_change_value_tolerance_value").value="";
      		document.getElementById("abrasion_resistance_s_change_value_tolerance_value").focus();
      		return false;
		}
		else if(document.getElementById("abrasion_resistance_s_change_value_min_value").value.trim()=="")
		{
      		alert("Please Provide Abrasion Resistance S Change Value Min Value");
      		document.getElementById("abrasion_resistance_s_change_value_min_value").focus();
      		return false;
		}
		else if(isNaN(document.getElementById("abrasion_resistance_s_change_value_min_value").value.trim()))
		{
      		alert("Abrasion Resistance S Change Value Min Value should be Numeric");
			document.getElementById("abrasion_resistance_s_change_value_min_value").value="";
      		document.getElementById("abrasion_resistance_s_change_value_min_value").focus();
      		return false;
		}
		else if(document.getElementById("abrasion_resistance_s_change_value_max_value").value.trim()=="")
		{
      		alert("Please Provide Abrasion Resistance S Change Value Max Value");
      		document.getElementById("abrasion_resistance_s_change_value_max_value").focus();
      		return false;
		}
		else if(isNaN(document.getElementById("abrasion_resistance_s_change_value_max_value").value.trim()))
		{
      		alert("Abrasion Resistance S Change Value Max Value should be Numeric");
			document.getElementById("abrasion_resistance_s_change_value_max_value").value="";
      		document.getElementById("abrasion_resistance_s_change_value_max_value").focus();
      		return false;
		}
		else if(document.getElementById("uom_of_abrasion_resistance_s_change_value").value.trim()=="")
		{
      		alert("Please Provide Uom Of Abrasion Resistance S Change Value");
      		document.getElementById("uom_of_abrasion_resistance_s_change_value").focus();
      		return false;
		}
		else if(document.getElementById("abrasion_resistance_thread_break").value.trim()=="")
		{
      		alert("Please Provide Abrasion Resistance Thread Break");
      		document.getElementById("abrasion_resistance_thread_break").focus();
      		return false;
		}
		else if(document.getElementById("revolution").value.trim()=="")
		{
      		alert("Please Provide Revolution");
      		document.getElementById("revolution").focus();
      		return false;
		}
		else if(document.getElementById("print_durability").value.trim()=="")
		{
      		alert("Please Provide Print Durability");
      		document.getElementById("print_durability").focus();
      		return false;
		}
		else if(document.getElementById("mass_loss_in_abrasion_test_value_tolerance_range_math_operator").value.trim()=="")
		{
      		alert("Please Provide Mass Loss In Abrasion Test Value Tolerance Range Math Operator");
      		document.getElementById("mass_loss_in_abrasion_test_value_tolerance_range_math_operator").focus();
      		return false;
		}
		else if(document.getElementById("mass_loss_in_abrasion_test_value_tolerance_value").value.trim()=="")
		{
      		alert("Please Provide Mass Loss In Abrasion Test Value Tolerance Value");
      		document.getElementById("mass_loss_in_abrasion_test_value_tolerance_value").focus();
      		return false;
		}
		else if(isNaN(document.getElementById("mass_loss_in_abrasion_test_value_tolerance_value").value.trim()))
		{
      		alert("Mass Loss In Abrasion Test Value Tolerance Value should be Numeric");
			document.getElementById("mass_loss_in_abrasion_test_value_tolerance_value").value="";
      		document.getElementById("mass_loss_in_abrasion_test_value_tolerance_value").focus();
      		return false;
		}
		else if(document.getElementById("mass_loss_in_abrasion_test_value_min_value").value.trim()=="")
		{
      		alert("Please Provide Mass Loss In Abrasion Test Value Min Value");
      		document.getElementById("mass_loss_in_abrasion_test_value_min_value").focus();
      		return false;
		}
		else if(isNaN(document.getElementById("mass_loss_in_abrasion_test_value_min_value").value.trim()))
		{
      		alert("Mass Loss In Abrasion Test Value Min Value should be Numeric");
			document.getElementById("mass_loss_in_abrasion_test_value_min_value").value="";
      		document.getElementById("mass_loss_in_abrasion_test_value_min_value").focus();
      		return false;
		}
		else if(document.getElementById("mass_loss_in_abrasion_test_value_max_value").value.trim()=="")
		{
      		alert("Please Provide Mass Loss In Abrasion Test Value Max Value");
      		document.getElementById("mass_loss_in_abrasion_test_value_max_value").focus();
      		return false;
		}
		else if(isNaN(document.getElementById("mass_loss_in_abrasion_test_value_max_value").value.trim()))
		{
      		alert("Mass Loss In Abrasion Test Value Max Value should be Numeric");
			document.getElementById("mass_loss_in_abrasion_test_value_max_value").value="";
      		document.getElementById("mass_loss_in_abrasion_test_value_max_value").focus();
      		return false;
		}
		else if(document.getElementById("uom_of_mass_loss_in_abrasion_test_value").value.trim()=="")
		{
      		alert("Please Provide Uom Of Mass Loss In Abrasion Test Value");
      		document.getElementById("uom_of_mass_loss_in_abrasion_test_value").focus();
      		return false;
		}
		else if(document.getElementById("formaldehyde_content_tolerance_range_math_operator").value.trim()=="")
		{
      		alert("Please Provide Formaldehyde Content Tolerance Range Math Operator");
      		document.getElementById("formaldehyde_content_tolerance_range_math_operator").focus();
      		return false;
		}
		else if(document.getElementById("formaldehyde_content_tolerance_value").value.trim()=="")
		{
      		alert("Please Provide Formaldehyde Content Tolerance Value");
      		document.getElementById("formaldehyde_content_tolerance_value").focus();
      		return false;
		}
		else if(isNaN(document.getElementById("formaldehyde_content_tolerance_value").value.trim()))
		{
      		alert("Formaldehyde Content Tolerance Value should be Numeric");
			document.getElementById("formaldehyde_content_tolerance_value").value="";
      		document.getElementById("formaldehyde_content_tolerance_value").focus();
      		return false;
		}
		else if(document.getElementById("formaldehyde_content_min_value").value.trim()=="")
		{
      		alert("Please Provide Formaldehyde Content Min Value");
      		document.getElementById("formaldehyde_content_min_value").focus();
      		return false;
		}
		else if(isNaN(document.getElementById("formaldehyde_content_min_value").value.trim()))
		{
      		alert("Formaldehyde Content Min Value should be Numeric");
			document.getElementById("formaldehyde_content_min_value").value="";
      		document.getElementById("formaldehyde_content_min_value").focus();
      		return false;
		}
		else if(document.getElementById("formaldehyde_content_max_value").value.trim()=="")
		{
      		alert("Please Provide Formaldehyde Content Max Value");
      		document.getElementById("formaldehyde_content_max_value").focus();
      		return false;
		}
		else if(isNaN(document.getElementById("formaldehyde_content_max_value").value.trim()))
		{
      		alert("Formaldehyde Content Max Value should be Numeric");
			document.getElementById("formaldehyde_content_max_value").value="";
      		document.getElementById("formaldehyde_content_max_value").focus();
      		return false;
		}
		else if(document.getElementById("uom_of_formaldehyde_content").value.trim()=="")
		{
      		alert("Please Provide Uom Of Formaldehyde Content");
      		document.getElementById("uom_of_formaldehyde_content").focus();
      		return false;
		}
		else if(document.getElementById("cf_to_dry_cleaning_color_change_tolerance_range_math_operator").value.trim()=="")
		{
      		alert("Please Provide Cf To Dry Cleaning Color Change Tolerance Range Math Operator");
      		document.getElementById("cf_to_dry_cleaning_color_change_tolerance_range_math_operator").focus();
      		return false;
		}
		else if(document.getElementById("cf_to_dry_cleaning_color_change_tolerance_value").value.trim()=="")
		{
      		alert("Please Provide Cf To Dry Cleaning Color Change Tolerance Value");
      		document.getElementById("cf_to_dry_cleaning_color_change_tolerance_value").focus();
      		return false;
		}
		else if(isNaN(document.getElementById("cf_to_dry_cleaning_color_change_tolerance_value").value.trim()))
		{
      		alert("Cf To Dry Cleaning Color Change Tolerance Value should be Numeric");
			document.getElementById("cf_to_dry_cleaning_color_change_tolerance_value").value="";
      		document.getElementById("cf_to_dry_cleaning_color_change_tolerance_value").focus();
      		return false;
		}
		else if(document.getElementById("cf_to_dry_cleaning_color_change_min_value").value.trim()=="")
		{
      		alert("Please Provide Cf To Dry Cleaning Color Change Min Value");
      		document.getElementById("cf_to_dry_cleaning_color_change_min_value").focus();
      		return false;
		}
		else if(isNaN(document.getElementById("cf_to_dry_cleaning_color_change_min_value").value.trim()))
		{
      		alert("Cf To Dry Cleaning Color Change Min Value should be Numeric");
			document.getElementById("cf_to_dry_cleaning_color_change_min_value").value="";
      		document.getElementById("cf_to_dry_cleaning_color_change_min_value").focus();
      		return false;
		}
		else if(document.getElementById("cf_to_dry_cleaning_color_change_max_value").value.trim()=="")
		{
      		alert("Please Provide Cf To Dry Cleaning Color Change Max Value");
      		document.getElementById("cf_to_dry_cleaning_color_change_max_value").focus();
      		return false;
		}
		else if(isNaN(document.getElementById("cf_to_dry_cleaning_color_change_max_value").value.trim()))
		{
      		alert("Cf To Dry Cleaning Color Change Max Value should be Numeric");
			document.getElementById("cf_to_dry_cleaning_color_change_max_value").value="";
      		document.getElementById("cf_to_dry_cleaning_color_change_max_value").focus();
      		return false;
		}
		else if(document.getElementById("uom_of_cf_to_dry_cleaning_color_change").value.trim()=="")
		{
      		alert("Please Provide Uom Of Cf To Dry Cleaning Color Change");
      		document.getElementById("uom_of_cf_to_dry_cleaning_color_change").focus();
      		return false;
		}
		else if(document.getElementById("cf_to_dry_cleaning_staining_tolerance_range_math_operator").value.trim()=="")
		{
      		alert("Please Provide Cf To Dry Cleaning Staining Tolerance Range Math Operator");
      		document.getElementById("cf_to_dry_cleaning_staining_tolerance_range_math_operator").focus();
      		return false;
		}
		else if(document.getElementById("cf_to_dry_cleaning_staining_tolerance_value").value.trim()=="")
		{
      		alert("Please Provide Cf To Dry Cleaning Staining Tolerance Value");
      		document.getElementById("cf_to_dry_cleaning_staining_tolerance_value").focus();
      		return false;
		}
		else if(isNaN(document.getElementById("cf_to_dry_cleaning_staining_tolerance_value").value.trim()))
		{
      		alert("Cf To Dry Cleaning Staining Tolerance Value should be Numeric");
			document.getElementById("cf_to_dry_cleaning_staining_tolerance_value").value="";
      		document.getElementById("cf_to_dry_cleaning_staining_tolerance_value").focus();
      		return false;
		}
		else if(document.getElementById("cf_to_dry_cleaning_staining_min_value").value.trim()=="")
		{
      		alert("Please Provide Cf To Dry Cleaning Staining Min Value");
      		document.getElementById("cf_to_dry_cleaning_staining_min_value").focus();
      		return false;
		}
		else if(isNaN(document.getElementById("cf_to_dry_cleaning_staining_min_value").value.trim()))
		{
      		alert("Cf To Dry Cleaning Staining Min Value should be Numeric");
			document.getElementById("cf_to_dry_cleaning_staining_min_value").value="";
      		document.getElementById("cf_to_dry_cleaning_staining_min_value").focus();
      		return false;
		}
		else if(document.getElementById("cf_to_dry_cleaning_staining_max_value").value.trim()=="")
		{
      		alert("Please Provide Cf To Dry Cleaning Staining Max Value");
      		document.getElementById("cf_to_dry_cleaning_staining_max_value").focus();
      		return false;
		}
		else if(isNaN(document.getElementById("cf_to_dry_cleaning_staining_max_value").value.trim()))
		{
      		alert("Cf To Dry Cleaning Staining Max Value should be Numeric");
			document.getElementById("cf_to_dry_cleaning_staining_max_value").value="";
      		document.getElementById("cf_to_dry_cleaning_staining_max_value").focus();
      		return false;
		}
		else if(document.getElementById("uom_of_cf_to_dry_cleaning_staining").value.trim()=="")
		{
      		alert("Please Provide Uom Of Cf To Dry Cleaning Staining");
      		document.getElementById("uom_of_cf_to_dry_cleaning_staining").focus();
      		return false;
		}
		else if(document.getElementById("cf_to_washing_color_change_tolerance_range_math_operator").value.trim()=="")
		{
      		alert("Please Provide Cf To Washing Color Change Tolerance Range Math Operator");
      		document.getElementById("cf_to_washing_color_change_tolerance_range_math_operator").focus();
      		return false;
		}
		else if(document.getElementById("cf_to_washing_color_change_tolerance_value").value.trim()=="")
		{
      		alert("Please Provide Cf To Washing Color Change Tolerance Value");
      		document.getElementById("cf_to_washing_color_change_tolerance_value").focus();
      		return false;
		}
		else if(isNaN(document.getElementById("cf_to_washing_color_change_tolerance_value").value.trim()))
		{
      		alert("Cf To Washing Color Change Tolerance Value should be Numeric");
			document.getElementById("cf_to_washing_color_change_tolerance_value").value="";
      		document.getElementById("cf_to_washing_color_change_tolerance_value").focus();
      		return false;
		}
		else if(document.getElementById("cf_to_washing_color_change_min_value").value.trim()=="")
		{
      		alert("Please Provide Cf To Washing Color Change Min Value");
      		document.getElementById("cf_to_washing_color_change_min_value").focus();
      		return false;
		}
		else if(isNaN(document.getElementById("cf_to_washing_color_change_min_value").value.trim()))
		{
      		alert("Cf To Washing Color Change Min Value should be Numeric");
			document.getElementById("cf_to_washing_color_change_min_value").value="";
      		document.getElementById("cf_to_washing_color_change_min_value").focus();
      		return false;
		}
		else if(document.getElementById("cf_to_washing_color_change_max_value").value.trim()=="")
		{
      		alert("Please Provide Cf To Washing Color Change Max Value");
      		document.getElementById("cf_to_washing_color_change_max_value").focus();
      		return false;
		}
		else if(isNaN(document.getElementById("cf_to_washing_color_change_max_value").value.trim()))
		{
      		alert("Cf To Washing Color Change Max Value should be Numeric");
			document.getElementById("cf_to_washing_color_change_max_value").value="";
      		document.getElementById("cf_to_washing_color_change_max_value").focus();
      		return false;
		}
		else if(document.getElementById("uom_of_cf_to_washing_color_change").value.trim()=="")
		{
      		alert("Please Provide Uom Of Cf To Washing Color Change");
      		document.getElementById("uom_of_cf_to_washing_color_change").focus();
      		return false;
		}
		else if(document.getElementById("cf_to_washing_staining_tolerance_range_math_operator").value.trim()=="")
		{
      		alert("Please Provide Cf To Washing Staining Tolerance Range Math Operator");
      		document.getElementById("cf_to_washing_staining_tolerance_range_math_operator").focus();
      		return false;
		}
		else if(document.getElementById("cf_to_washing_staining_tolerance_value").value.trim()=="")
		{
      		alert("Please Provide Cf To Washing Staining Tolerance Value");
      		document.getElementById("cf_to_washing_staining_tolerance_value").focus();
      		return false;
		}
		else if(isNaN(document.getElementById("cf_to_washing_staining_tolerance_value").value.trim()))
		{
      		alert("Cf To Washing Staining Tolerance Value should be Numeric");
			document.getElementById("cf_to_washing_staining_tolerance_value").value="";
      		document.getElementById("cf_to_washing_staining_tolerance_value").focus();
      		return false;
		}
		else if(document.getElementById("cf_to_washing_staining_min_value").value.trim()=="")
		{
      		alert("Please Provide Cf To Washing Staining Min Value");
      		document.getElementById("cf_to_washing_staining_min_value").focus();
      		return false;
		}
		else if(isNaN(document.getElementById("cf_to_washing_staining_min_value").value.trim()))
		{
      		alert("Cf To Washing Staining Min Value should be Numeric");
			document.getElementById("cf_to_washing_staining_min_value").value="";
      		document.getElementById("cf_to_washing_staining_min_value").focus();
      		return false;
		}
		else if(document.getElementById("cf_to_washing_staining_max_value").value.trim()=="")
		{
      		alert("Please Provide Cf To Washing Staining Max Value");
      		document.getElementById("cf_to_washing_staining_max_value").focus();
      		return false;
		}
		else if(isNaN(document.getElementById("cf_to_washing_staining_max_value").value.trim()))
		{
      		alert("Cf To Washing Staining Max Value should be Numeric");
			document.getElementById("cf_to_washing_staining_max_value").value="";
      		document.getElementById("cf_to_washing_staining_max_value").focus();
      		return false;
		}
		else if(document.getElementById("uom_of_cf_to_washing_staining").value.trim()=="")
		{
      		alert("Please Provide Uom Of Cf To Washing Staining");
      		document.getElementById("uom_of_cf_to_washing_staining").focus();
      		return false;
		}
		else if(document.getElementById("cf_to_perspiration_acid_color_change_tolerance_range_math_op").value.trim()=="")
		{
      		alert("Please Provide Cf To Perspiration Acid Color Change Tolerance Range Math Op");
      		document.getElementById("cf_to_perspiration_acid_color_change_tolerance_range_math_op").focus();
      		return false;
		}
		else if(document.getElementById("cf_to_perspiration_acid_color_change_tolerance_value").value.trim()=="")
		{
      		alert("Please Provide Cf To Perspiration Acid Color Change Tolerance Value");
      		document.getElementById("cf_to_perspiration_acid_color_change_tolerance_value").focus();
      		return false;
		}
		else if(isNaN(document.getElementById("cf_to_perspiration_acid_color_change_tolerance_value").value.trim()))
		{
      		alert("Cf To Perspiration Acid Color Change Tolerance Value should be Numeric");
			document.getElementById("cf_to_perspiration_acid_color_change_tolerance_value").value="";
      		document.getElementById("cf_to_perspiration_acid_color_change_tolerance_value").focus();
      		return false;
		}
		else if(document.getElementById("cf_to_perspiration_acid_color_change_min_value").value.trim()=="")
		{
      		alert("Please Provide Cf To Perspiration Acid Color Change Min Value");
      		document.getElementById("cf_to_perspiration_acid_color_change_min_value").focus();
      		return false;
		}
		else if(isNaN(document.getElementById("cf_to_perspiration_acid_color_change_min_value").value.trim()))
		{
      		alert("Cf To Perspiration Acid Color Change Min Value should be Numeric");
			document.getElementById("cf_to_perspiration_acid_color_change_min_value").value="";
      		document.getElementById("cf_to_perspiration_acid_color_change_min_value").focus();
      		return false;
		}
		else if(document.getElementById("cf_to_perspiration_acid_color_change_max_value").value.trim()=="")
		{
      		alert("Please Provide Cf To Perspiration Acid Color Change Max Value");
      		document.getElementById("cf_to_perspiration_acid_color_change_max_value").focus();
      		return false;
		}
		else if(isNaN(document.getElementById("cf_to_perspiration_acid_color_change_max_value").value.trim()))
		{
      		alert("Cf To Perspiration Acid Color Change Max Value should be Numeric");
			document.getElementById("cf_to_perspiration_acid_color_change_max_value").value="";
      		document.getElementById("cf_to_perspiration_acid_color_change_max_value").focus();
      		return false;
		}
		else if(document.getElementById("uom_of_cf_to_perspiration_acid_color_change").value.trim()=="")
		{
      		alert("Please Provide Uom Of Cf To Perspiration Acid Color Change");
      		document.getElementById("uom_of_cf_to_perspiration_acid_color_change").focus();
      		return false;
		}
		else if(document.getElementById("cf_to_perspiration_acid_staining_tolerance_range_math_operator").value.trim()=="")
		{
      		alert("Please Provide Cf To Perspiration Acid Staining Tolerance Range Math Operator");
      		document.getElementById("cf_to_perspiration_acid_staining_tolerance_range_math_operator").focus();
      		return false;
		}
		else if(document.getElementById("cf_to_perspiration_acid_staining_value").value.trim()=="")
		{
      		alert("Please Provide Cf To Perspiration Acid Staining Value");
      		document.getElementById("cf_to_perspiration_acid_staining_value").focus();
      		return false;
		}
		else if(isNaN(document.getElementById("cf_to_perspiration_acid_staining_value").value.trim()))
		{
      		alert("Cf To Perspiration Acid Staining Value should be Numeric");
			document.getElementById("cf_to_perspiration_acid_staining_value").value="";
      		document.getElementById("cf_to_perspiration_acid_staining_value").focus();
      		return false;
		}
		else if(document.getElementById("cf_to_perspiration_acid_staining_min_value").value.trim()=="")
		{
      		alert("Please Provide Cf To Perspiration Acid Staining Min Value");
      		document.getElementById("cf_to_perspiration_acid_staining_min_value").focus();
      		return false;
		}
		else if(isNaN(document.getElementById("cf_to_perspiration_acid_staining_min_value").value.trim()))
		{
      		alert("Cf To Perspiration Acid Staining Min Value should be Numeric");
			document.getElementById("cf_to_perspiration_acid_staining_min_value").value="";
      		document.getElementById("cf_to_perspiration_acid_staining_min_value").focus();
      		return false;
		}
		else if(document.getElementById("cf_to_perspiration_acid_staining_max_value").value.trim()=="")
		{
      		alert("Please Provide Cf To Perspiration Acid Staining Max Value");
      		document.getElementById("cf_to_perspiration_acid_staining_max_value").focus();
      		return false;
		}
		else if(isNaN(document.getElementById("cf_to_perspiration_acid_staining_max_value").value.trim()))
		{
      		alert("Cf To Perspiration Acid Staining Max Value should be Numeric");
			document.getElementById("cf_to_perspiration_acid_staining_max_value").value="";
      		document.getElementById("cf_to_perspiration_acid_staining_max_value").focus();
      		return false;
		}
		else if(document.getElementById("uom_of_cf_to_perspiration_acid_staining").value.trim()=="")
		{
      		alert("Please Provide Uom Of Cf To Perspiration Acid Staining");
      		document.getElementById("uom_of_cf_to_perspiration_acid_staining").focus();
      		return false;
		}
		else if(document.getElementById("cf_to_perspiration_alkali_color_change_tolerance_range_math_op").value.trim()=="")
		{
      		alert("Please Provide Cf To Perspiration Alkali Color Change Tolerance Range Math Op");
      		document.getElementById("cf_to_perspiration_alkali_color_change_tolerance_range_math_op").focus();
      		return false;
		}
		else if(document.getElementById("cf_to_perspiration_alkali_color_change_tolerance_value").value.trim()=="")
		{
      		alert("Please Provide Cf To Perspiration Alkali Color Change Tolerance Value");
      		document.getElementById("cf_to_perspiration_alkali_color_change_tolerance_value").focus();
      		return false;
		}
		else if(isNaN(document.getElementById("cf_to_perspiration_alkali_color_change_tolerance_value").value.trim()))
		{
      		alert("Cf To Perspiration Alkali Color Change Tolerance Value should be Numeric");
			document.getElementById("cf_to_perspiration_alkali_color_change_tolerance_value").value="";
      		document.getElementById("cf_to_perspiration_alkali_color_change_tolerance_value").focus();
      		return false;
		}
		else if(document.getElementById("cf_to_perspiration_alkali_color_change_min_value").value.trim()=="")
		{
      		alert("Please Provide Cf To Perspiration Alkali Color Change Min Value");
      		document.getElementById("cf_to_perspiration_alkali_color_change_min_value").focus();
      		return false;
		}
		else if(isNaN(document.getElementById("cf_to_perspiration_alkali_color_change_min_value").value.trim()))
		{
      		alert("Cf To Perspiration Alkali Color Change Min Value should be Numeric");
			document.getElementById("cf_to_perspiration_alkali_color_change_min_value").value="";
      		document.getElementById("cf_to_perspiration_alkali_color_change_min_value").focus();
      		return false;
		}
		else if(document.getElementById("cf_to_perspiration_alkali_color_change_max_value").value.trim()=="")
		{
      		alert("Please Provide Cf To Perspiration Alkali Color Change Max Value");
      		document.getElementById("cf_to_perspiration_alkali_color_change_max_value").focus();
      		return false;
		}
		else if(isNaN(document.getElementById("cf_to_perspiration_alkali_color_change_max_value").value.trim()))
		{
      		alert("Cf To Perspiration Alkali Color Change Max Value should be Numeric");
			document.getElementById("cf_to_perspiration_alkali_color_change_max_value").value="";
      		document.getElementById("cf_to_perspiration_alkali_color_change_max_value").focus();
      		return false;
		}
		else if(document.getElementById("uom_of_cf_to_perspiration_alkali_color_change").value.trim()=="")
		{
      		alert("Please Provide Uom Of Cf To Perspiration Alkali Color Change");
      		document.getElementById("uom_of_cf_to_perspiration_alkali_color_change").focus();
      		return false;
		}
		else if(document.getElementById("cf_to_water_color_change_tolerance_range_math_operator").value.trim()=="")
		{
      		alert("Please Provide Cf To Water Color Change Tolerance Range Math Operator");
      		document.getElementById("cf_to_water_color_change_tolerance_range_math_operator").focus();
      		return false;
		}
		else if(document.getElementById("cf_to_water_color_change_tolerance_value").value.trim()=="")
		{
      		alert("Please Provide Cf To Water Color Change Tolerance Value");
      		document.getElementById("cf_to_water_color_change_tolerance_value").focus();
      		return false;
		}
		else if(isNaN(document.getElementById("cf_to_water_color_change_tolerance_value").value.trim()))
		{
      		alert("Cf To Water Color Change Tolerance Value should be Numeric");
			document.getElementById("cf_to_water_color_change_tolerance_value").value="";
      		document.getElementById("cf_to_water_color_change_tolerance_value").focus();
      		return false;
		}
		else if(document.getElementById("cf_to_water_color_change_min_value").value.trim()=="")
		{
      		alert("Please Provide Cf To Water Color Change Min Value");
      		document.getElementById("cf_to_water_color_change_min_value").focus();
      		return false;
		}
		else if(isNaN(document.getElementById("cf_to_water_color_change_min_value").value.trim()))
		{
      		alert("Cf To Water Color Change Min Value should be Numeric");
			document.getElementById("cf_to_water_color_change_min_value").value="";
      		document.getElementById("cf_to_water_color_change_min_value").focus();
      		return false;
		}
		else if(document.getElementById("cf_to_water_color_change_max_value").value.trim()=="")
		{
      		alert("Please Provide Cf To Water Color Change Max Value");
      		document.getElementById("cf_to_water_color_change_max_value").focus();
      		return false;
		}
		else if(isNaN(document.getElementById("cf_to_water_color_change_max_value").value.trim()))
		{
      		alert("Cf To Water Color Change Max Value should be Numeric");
			document.getElementById("cf_to_water_color_change_max_value").value="";
      		document.getElementById("cf_to_water_color_change_max_value").focus();
      		return false;
		}
		else if(document.getElementById("uom_of_cf_to_water_color_change").value.trim()=="")
		{
      		alert("Please Provide Uom Of Cf To Water Color Change");
      		document.getElementById("uom_of_cf_to_water_color_change").focus();
      		return false;
		}
		else if(document.getElementById("cf_to_water_staining_tolerance_range_math_operator").value.trim()=="")
		{
      		alert("Please Provide Cf To Water Staining Tolerance Range Math Operator");
      		document.getElementById("cf_to_water_staining_tolerance_range_math_operator").focus();
      		return false;
		}
		else if(document.getElementById("cf_to_water_staining_tolerance_value").value.trim()=="")
		{
      		alert("Please Provide Cf To Water Staining Tolerance Value");
      		document.getElementById("cf_to_water_staining_tolerance_value").focus();
      		return false;
		}
		else if(isNaN(document.getElementById("cf_to_water_staining_tolerance_value").value.trim()))
		{
      		alert("Cf To Water Staining Tolerance Value should be Numeric");
			document.getElementById("cf_to_water_staining_tolerance_value").value="";
      		document.getElementById("cf_to_water_staining_tolerance_value").focus();
      		return false;
		}
		else if(document.getElementById("cf_to_water_staining_min_value").value.trim()=="")
		{
      		alert("Please Provide Cf To Water Staining Min Value");
      		document.getElementById("cf_to_water_staining_min_value").focus();
      		return false;
		}
		else if(isNaN(document.getElementById("cf_to_water_staining_min_value").value.trim()))
		{
      		alert("Cf To Water Staining Min Value should be Numeric");
			document.getElementById("cf_to_water_staining_min_value").value="";
      		document.getElementById("cf_to_water_staining_min_value").focus();
      		return false;
		}
		else if(document.getElementById("cf_to_water_staining_max_value").value.trim()=="")
		{
      		alert("Please Provide Cf To Water Staining Max Value");
      		document.getElementById("cf_to_water_staining_max_value").focus();
      		return false;
		}
		else if(isNaN(document.getElementById("cf_to_water_staining_max_value").value.trim()))
		{
      		alert("Cf To Water Staining Max Value should be Numeric");
			document.getElementById("cf_to_water_staining_max_value").value="";
      		document.getElementById("cf_to_water_staining_max_value").focus();
      		return false;
		}
		else if(document.getElementById("uom_of_cf_to_water_staining").value.trim()=="")
		{
      		alert("Please Provide Uom Of Cf To Water Staining");
      		document.getElementById("uom_of_cf_to_water_staining").focus();
      		return false;
		}
		else if(document.getElementById("cf_to_water_sotting_staining_tolerance_range_math_operator").value.trim()=="")
		{
      		alert("Please Provide Cf To Water Sotting Staining Tolerance Range Math Operator");
      		document.getElementById("cf_to_water_sotting_staining_tolerance_range_math_operator").focus();
      		return false;
		}
		else if(document.getElementById("cf_to_water_sotting_staining_tolerance_value").value.trim()=="")
		{
      		alert("Please Provide Cf To Water Sotting Staining Tolerance Value");
      		document.getElementById("cf_to_water_sotting_staining_tolerance_value").focus();
      		return false;
		}
		else if(isNaN(document.getElementById("cf_to_water_sotting_staining_tolerance_value").value.trim()))
		{
      		alert("Cf To Water Sotting Staining Tolerance Value should be Numeric");
			document.getElementById("cf_to_water_sotting_staining_tolerance_value").value="";
      		document.getElementById("cf_to_water_sotting_staining_tolerance_value").focus();
      		return false;
		}
		else if(document.getElementById("cf_to_water_sotting_staining_min_value").value.trim()=="")
		{
      		alert("Please Provide Cf To Water Sotting Staining Min Value");
      		document.getElementById("cf_to_water_sotting_staining_min_value").focus();
      		return false;
		}
		else if(isNaN(document.getElementById("cf_to_water_sotting_staining_min_value").value.trim()))
		{
      		alert("Cf To Water Sotting Staining Min Value should be Numeric");
			document.getElementById("cf_to_water_sotting_staining_min_value").value="";
      		document.getElementById("cf_to_water_sotting_staining_min_value").focus();
      		return false;
		}
		else if(document.getElementById("cf_to_water_sotting_staining_max_value").value.trim()=="")
		{
      		alert("Please Provide Cf To Water Sotting Staining Max Value");
      		document.getElementById("cf_to_water_sotting_staining_max_value").focus();
      		return false;
		}
		else if(isNaN(document.getElementById("cf_to_water_sotting_staining_max_value").value.trim()))
		{
      		alert("Cf To Water Sotting Staining Max Value should be Numeric");
			document.getElementById("cf_to_water_sotting_staining_max_value").value="";
      		document.getElementById("cf_to_water_sotting_staining_max_value").focus();
      		return false;
		}
		else if(document.getElementById("uom_of_cf_to_water_sotting_staining").value.trim()=="")
		{
      		alert("Please Provide Uom Of Cf To Water Sotting Staining");
      		document.getElementById("uom_of_cf_to_water_sotting_staining").focus();
      		return false;
		}
		else if(document.getElementById("resistance_to_surface_wetting_tolerance_range_math_operator").value.trim()=="")
		{
      		alert("Please Provide Cf To Surface Wetting Staining Tolerance Range Math Operator");
      		document.getElementById("resistance_to_surface_wetting_tolerance_range_math_operator").focus();
      		return false;
		}
		else if(document.getElementById("resistance_to_surface_wetting_tolerance_value").value.trim()=="")
		{
      		alert("Please Provide Cf To Surface Wetting Staining Tolerance Value");
      		document.getElementById("resistance_to_surface_wetting_tolerance_value").focus();
      		return false;
		}
		else if(isNaN(document.getElementById("resistance_to_surface_wetting_tolerance_value").value.trim()))
		{
      		alert("Cf To Surface Wetting Staining Tolerance Value should be Numeric");
			document.getElementById("resistance_to_surface_wetting_tolerance_value").value="";
      		document.getElementById("resistance_to_surface_wetting_tolerance_value").focus();
      		return false;
		}
		else if(document.getElementById("resistance_to_surface_wetting_min_value").value.trim()=="")
		{
      		alert("Please Provide Cf To Surface Wetting Staining Min Value");
      		document.getElementById("resistance_to_surface_wetting_min_value").focus();
      		return false;
		}
		else if(isNaN(document.getElementById("resistance_to_surface_wetting_min_value").value.trim()))
		{
      		alert("Cf To Surface Wetting Staining Min Value should be Numeric");
			document.getElementById("resistance_to_surface_wetting_min_value").value="";
      		document.getElementById("resistance_to_surface_wetting_min_value").focus();
      		return false;
		}
		else if(document.getElementById("resistance_to_surface_wetting_max_value").value.trim()=="")
		{
      		alert("Please Provide Cf To Surface Wetting Staining Max Value");
      		document.getElementById("resistance_to_surface_wetting_max_value").focus();
      		return false;
		}
		else if(isNaN(document.getElementById("resistance_to_surface_wetting_max_value").value.trim()))
		{
      		alert("Cf To Surface Wetting Staining Max Value should be Numeric");
			document.getElementById("resistance_to_surface_wetting_max_value").value="";
      		document.getElementById("resistance_to_surface_wetting_max_value").focus();
      		return false;
		}
		else if(document.getElementById("uom_of_resistance_to_surface_wetting").value.trim()=="")
		{
      		alert("Please Provide Uom Of Cf To Surface Wetting Staining");
      		document.getElementById("uom_of_resistance_to_surface_wetting").focus();
      		return false;
		}
		else if(document.getElementById("cf_to_hydrolysis_of_reactive_dyes_color_change_tol_rang_mat_op").value.trim()=="")
		{
      		alert("Please Provide Cf To Hydrolysis Of Reactive Dyes Color Change Tol Rang Mat Op");
      		document.getElementById("cf_to_hydrolysis_of_reactive_dyes_color_change_tol_rang_mat_op").focus();
      		return false;
		}
		else if(document.getElementById("cf_to_hydrolysis_of_reactive_dyes_color_change_tolerance_value").value.trim()=="")
		{
      		alert("Please Provide Cf To Hydrolysis Of Reactive Dyes Color Change Tolerance Value");
      		document.getElementById("cf_to_hydrolysis_of_reactive_dyes_color_change_tolerance_value").focus();
      		return false;
		}
		else if(isNaN(document.getElementById("cf_to_hydrolysis_of_reactive_dyes_color_change_tolerance_value").value.trim()))
		{
      		alert("Cf To Hydrolysis Of Reactive Dyes Color Change Tolerance Value should be Numeric");
			document.getElementById("cf_to_hydrolysis_of_reactive_dyes_color_change_tolerance_value").value="";
      		document.getElementById("cf_to_hydrolysis_of_reactive_dyes_color_change_tolerance_value").focus();
      		return false;
		}
		else if(document.getElementById("cf_to_hydrolysis_of_reactive_dyes_color_change_min_value").value.trim()=="")
		{
      		alert("Please Provide Cf To Hydrolysis Of Reactive Dyes Color Change Min Value");
      		document.getElementById("cf_to_hydrolysis_of_reactive_dyes_color_change_min_value").focus();
      		return false;
		}
		else if(isNaN(document.getElementById("cf_to_hydrolysis_of_reactive_dyes_color_change_min_value").value.trim()))
		{
      		alert("Cf To Hydrolysis Of Reactive Dyes Color Change Min Value should be Numeric");
			document.getElementById("cf_to_hydrolysis_of_reactive_dyes_color_change_min_value").value="";
      		document.getElementById("cf_to_hydrolysis_of_reactive_dyes_color_change_min_value").focus();
      		return false;
		}
		else if(document.getElementById("cf_to_hydrolysis_of_reactive_dyes_color_change_max_value").value.trim()=="")
		{
      		alert("Please Provide Cf To Hydrolysis Of Reactive Dyes Color Change Max Value");
      		document.getElementById("cf_to_hydrolysis_of_reactive_dyes_color_change_max_value").focus();
      		return false;
		}
		else if(isNaN(document.getElementById("cf_to_hydrolysis_of_reactive_dyes_color_change_max_value").value.trim()))
		{
      		alert("Cf To Hydrolysis Of Reactive Dyes Color Change Max Value should be Numeric");
			document.getElementById("cf_to_hydrolysis_of_reactive_dyes_color_change_max_value").value="";
      		document.getElementById("cf_to_hydrolysis_of_reactive_dyes_color_change_max_value").focus();
      		return false;
		}
		else if(document.getElementById("uom_of_cf_to_hydrolysis_of_reactive_dyes_color_change").value.trim()=="")
		{
      		alert("Please Provide Uom Of Cf To Hydrolysis Of Reactive Dyes Color Change");
      		document.getElementById("uom_of_cf_to_hydrolysis_of_reactive_dyes_color_change").focus();
      		return false;
		}
		else if(document.getElementById("cf_to_hydrolysis_of_reactive_dyes_staining_toler_range_math_op").value.trim()=="")
		{
      		alert("Please Provide Cf To Hydrolysis Of Reactive Dyes Staining Toler Range Math Op");
      		document.getElementById("cf_to_hydrolysis_of_reactive_dyes_staining_toler_range_math_op").focus();
      		return false;
		}
		else if(document.getElementById("cf_to_hydrolysis_of_reactive_dyes_staining_tolerance_value").value.trim()=="")
		{
      		alert("Please Provide Cf To Hydrolysis Of Reactive Dyes Staining Tolerance Value");
      		document.getElementById("cf_to_hydrolysis_of_reactive_dyes_staining_tolerance_value").focus();
      		return false;
		}
		else if(isNaN(document.getElementById("cf_to_hydrolysis_of_reactive_dyes_staining_tolerance_value").value.trim()))
		{
      		alert("Cf To Hydrolysis Of Reactive Dyes Staining Tolerance Value should be Numeric");
			document.getElementById("cf_to_hydrolysis_of_reactive_dyes_staining_tolerance_value").value="";
      		document.getElementById("cf_to_hydrolysis_of_reactive_dyes_staining_tolerance_value").focus();
      		return false;
		}
		else if(document.getElementById("cf_to_hydrolysis_of_reactive_dyes_staining_min_value").value.trim()=="")
		{
      		alert("Please Provide Cf To Hydrolysis Of Reactive Dyes Staining Min Value");
      		document.getElementById("cf_to_hydrolysis_of_reactive_dyes_staining_min_value").focus();
      		return false;
		}
		else if(isNaN(document.getElementById("cf_to_hydrolysis_of_reactive_dyes_staining_min_value").value.trim()))
		{
      		alert("Cf To Hydrolysis Of Reactive Dyes Staining Min Value should be Numeric");
			document.getElementById("cf_to_hydrolysis_of_reactive_dyes_staining_min_value").value="";
      		document.getElementById("cf_to_hydrolysis_of_reactive_dyes_staining_min_value").focus();
      		return false;
		}
		else if(document.getElementById("cf_to_hydrolysis_of_reactive_dyes_staining_max_value").value.trim()=="")
		{
      		alert("Please Provide Cf To Hydrolysis Of Reactive Dyes Staining Max Value");
      		document.getElementById("cf_to_hydrolysis_of_reactive_dyes_staining_max_value").focus();
      		return false;
		}
		else if(isNaN(document.getElementById("cf_to_hydrolysis_of_reactive_dyes_staining_max_value").value.trim()))
		{
      		alert("Cf To Hydrolysis Of Reactive Dyes Staining Max Value should be Numeric");
			document.getElementById("cf_to_hydrolysis_of_reactive_dyes_staining_max_value").value="";
      		document.getElementById("cf_to_hydrolysis_of_reactive_dyes_staining_max_value").focus();
      		return false;
		}
		else if(document.getElementById("uom_of_cf_to_hydrolysis_of_reactive_dyes_staining").value.trim()=="")
		{
      		alert("Please Provide Uom Of Cf To Hydrolysis Of Reactive Dyes Staining");
      		document.getElementById("uom_of_cf_to_hydrolysis_of_reactive_dyes_staining").focus();
      		return false;
		}
		else if(document.getElementById("cf_to_oidative_bleach_damage_color_change_tolerance_range_mat_op").value.trim()=="")
		{
      		alert("Please Provide Cf To Oidative Bleach Damage Color Change Tolerance Range Mat Op");
      		document.getElementById("cf_to_oidative_bleach_damage_color_change_tolerance_range_mat_op").focus();
      		return false;
		}
		else if(document.getElementById("cf_to_oidative_bleach_damage_color_change_tolerance_value").value.trim()=="")
		{
      		alert("Please Provide Cf To Oidative Bleach Damage Color Change Tolerance Value");
      		document.getElementById("cf_to_oidative_bleach_damage_color_change_tolerance_value").focus();
      		return false;
		}
		else if(isNaN(document.getElementById("cf_to_oidative_bleach_damage_color_change_tolerance_value").value.trim()))
		{
      		alert("Cf To Oidative Bleach Damage Color Change Tolerance Value should be Numeric");
			document.getElementById("cf_to_oidative_bleach_damage_color_change_tolerance_value").value="";
      		document.getElementById("cf_to_oidative_bleach_damage_color_change_tolerance_value").focus();
      		return false;
		}
		else if(document.getElementById("cf_to_oidative_bleach_damage_color_change_min_value").value.trim()=="")
		{
      		alert("Please Provide Cf To Oidative Bleach Damage Color Change Min Value");
      		document.getElementById("cf_to_oidative_bleach_damage_color_change_min_value").focus();
      		return false;
		}
		else if(isNaN(document.getElementById("cf_to_oidative_bleach_damage_color_change_min_value").value.trim()))
		{
      		alert("Cf To Oidative Bleach Damage Color Change Min Value should be Numeric");
			document.getElementById("cf_to_oidative_bleach_damage_color_change_min_value").value="";
      		document.getElementById("cf_to_oidative_bleach_damage_color_change_min_value").focus();
      		return false;
		}
		else if(document.getElementById("cf_to_oidative_bleach_damage_color_change_max_value").value.trim()=="")
		{
      		alert("Please Provide Cf To Oidative Bleach Damage Color Change Max Value");
      		document.getElementById("cf_to_oidative_bleach_damage_color_change_max_value").focus();
      		return false;
		}
		else if(isNaN(document.getElementById("cf_to_oidative_bleach_damage_color_change_max_value").value.trim()))
		{
      		alert("Cf To Oidative Bleach Damage Color Change Max Value should be Numeric");
			document.getElementById("cf_to_oidative_bleach_damage_color_change_max_value").value="";
      		document.getElementById("cf_to_oidative_bleach_damage_color_change_max_value").focus();
      		return false;
		}
		else if(document.getElementById("uom_of_cf_to_oidative_bleach_damage_color_change").value.trim()=="")
		{
      		alert("Please Provide Uom Of Cf To Oidative Bleach Damage Color Change");
      		document.getElementById("uom_of_cf_to_oidative_bleach_damage_color_change").focus();
      		return false;
		}
		else if(document.getElementById("cf_to_phenolic_yellowing_staining_tolerance_range_math_operator").value.trim()=="")
		{
      		alert("Please Provide Cf To Phenolic Yellowing Staining Tolerance Range Math Operator");
      		document.getElementById("cf_to_phenolic_yellowing_staining_tolerance_range_math_operator").focus();
      		return false;
		}
		else if(document.getElementById("cf_to_phenolic_yellowing_staining_tolerance_value").value.trim()=="")
		{
      		alert("Please Provide Cf To Phenolic Yellowing Staining Tolerance Value");
      		document.getElementById("cf_to_phenolic_yellowing_staining_tolerance_value").focus();
      		return false;
		}
		else if(isNaN(document.getElementById("cf_to_phenolic_yellowing_staining_tolerance_value").value.trim()))
		{
      		alert("Cf To Phenolic Yellowing Staining Tolerance Value should be Numeric");
			document.getElementById("cf_to_phenolic_yellowing_staining_tolerance_value").value="";
      		document.getElementById("cf_to_phenolic_yellowing_staining_tolerance_value").focus();
      		return false;
		}
		else if(document.getElementById("cf_to_phenolic_yellowing_staining_min_value").value.trim()=="")
		{
      		alert("Please Provide Cf To Phenolic Yellowing Staining Min Value");
      		document.getElementById("cf_to_phenolic_yellowing_staining_min_value").focus();
      		return false;
		}
		else if(isNaN(document.getElementById("cf_to_phenolic_yellowing_staining_min_value").value.trim()))
		{
      		alert("Cf To Phenolic Yellowing Staining Min Value should be Numeric");
			document.getElementById("cf_to_phenolic_yellowing_staining_min_value").value="";
      		document.getElementById("cf_to_phenolic_yellowing_staining_min_value").focus();
      		return false;
		}
		else if(document.getElementById("cf_to_phenolic_yellowing_staining_max_value").value.trim()=="")
		{
      		alert("Please Provide Cf To Phenolic Yellowing Staining Max Value");
      		document.getElementById("cf_to_phenolic_yellowing_staining_max_value").focus();
      		return false;
		}
		else if(isNaN(document.getElementById("cf_to_phenolic_yellowing_staining_max_value").value.trim()))
		{
      		alert("Cf To Phenolic Yellowing Staining Max Value should be Numeric");
			document.getElementById("cf_to_phenolic_yellowing_staining_max_value").value="";
      		document.getElementById("cf_to_phenolic_yellowing_staining_max_value").focus();
      		return false;
		}
		else if(document.getElementById("uom_of_cf_to_phenolic_yellowing_staining").value.trim()=="")
		{
      		alert("Please Provide Uom Of Cf To Phenolic Yellowing Staining");
      		document.getElementById("uom_of_cf_to_phenolic_yellowing_staining").focus();
      		return false;
		}
		else if(document.getElementById("cf_to_saliva_color_change_tolerance_range_math_operator").value.trim()=="")
		{
      		alert("Please Provide Cf To Saliva Color Change Tolerance Range Math Operator");
      		document.getElementById("cf_to_saliva_color_change_tolerance_range_math_operator").focus();
      		return false;
		}
		else if(document.getElementById("cf_to_pvc_migration_staining_tolerance_value").value.trim()=="")
		{
      		alert("Please Provide Cf To Pvc Migration Staining Tolerance Value");
      		document.getElementById("cf_to_pvc_migration_staining_tolerance_value").focus();
      		return false;
		}
		else if(isNaN(document.getElementById("cf_to_pvc_migration_staining_tolerance_value").value.trim()))
		{
      		alert("Cf To Pvc Migration Staining Tolerance Value should be Numeric");
			document.getElementById("cf_to_pvc_migration_staining_tolerance_value").value="";
      		document.getElementById("cf_to_pvc_migration_staining_tolerance_value").focus();
      		return false;
		}
		else if(document.getElementById("cf_to_pvc_migration_staining_min_value").value.trim()=="")
		{
      		alert("Please Provide Cf To Pvc Migration Staining Min Value");
      		document.getElementById("cf_to_pvc_migration_staining_min_value").focus();
      		return false;
		}
		else if(isNaN(document.getElementById("cf_to_pvc_migration_staining_min_value").value.trim()))
		{
      		alert("Cf To Pvc Migration Staining Min Value should be Numeric");
			document.getElementById("cf_to_pvc_migration_staining_min_value").value="";
      		document.getElementById("cf_to_pvc_migration_staining_min_value").focus();
      		return false;
		}
		else if(document.getElementById("cf_to_pvc_migration_staining_max_value").value.trim()=="")
		{
      		alert("Please Provide Cf To Pvc Migration Staining Max Value");
      		document.getElementById("cf_to_pvc_migration_staining_max_value").focus();
      		return false;
		}
		else if(isNaN(document.getElementById("cf_to_pvc_migration_staining_max_value").value.trim()))
		{
      		alert("Cf To Pvc Migration Staining Max Value should be Numeric");
			document.getElementById("cf_to_pvc_migration_staining_max_value").value="";
      		document.getElementById("cf_to_pvc_migration_staining_max_value").focus();
      		return false;
		}
		else if(document.getElementById("uom_of_cf_to_pvc_migration_staining").value.trim()=="")
		{
      		alert("Please Provide Uom Of Cf To Pvc Migration Staining");
      		document.getElementById("uom_of_cf_to_pvc_migration_staining").focus();
      		return false;
		}
		else if(document.getElementById("cf_to_pvc_migration_staining_tolerance_range_math_operator").value.trim()=="")
		{
      		alert("Please Provide Cf To Pvc Migration Staining Tolerance Range Math Operator");
      		document.getElementById("cf_to_pvc_migration_staining_tolerance_range_math_operator").focus();
      		return false;
		}
		else if(document.getElementById("cf_to_saliva_color_change_tolerance_value").value.trim()=="")
		{
      		alert("Please Provide Cf To Saliva Color Change Tolerance Value");
      		document.getElementById("cf_to_saliva_color_change_tolerance_value").focus();
      		return false;
		}
		else if(isNaN(document.getElementById("cf_to_saliva_color_change_tolerance_value").value.trim()))
		{
      		alert("Cf To Saliva Color Change Tolerance Value should be Numeric");
			document.getElementById("cf_to_saliva_color_change_tolerance_value").value="";
      		document.getElementById("cf_to_saliva_color_change_tolerance_value").focus();
      		return false;
		}
		else if(document.getElementById("cf_to_saliva_color_change_min_value").value.trim()=="")
		{
      		alert("Please Provide Cf To Saliva Color Change Min Value");
      		document.getElementById("cf_to_saliva_color_change_min_value").focus();
      		return false;
		}
		else if(isNaN(document.getElementById("cf_to_saliva_color_change_min_value").value.trim()))
		{
      		alert("Cf To Saliva Color Change Min Value should be Numeric");
			document.getElementById("cf_to_saliva_color_change_min_value").value="";
      		document.getElementById("cf_to_saliva_color_change_min_value").focus();
      		return false;
		}
		else if(document.getElementById("cf_to_saliva_color_change_max_value").value.trim()=="")
		{
      		alert("Please Provide Cf To Saliva Color Change Max Value");
      		document.getElementById("cf_to_saliva_color_change_max_value").focus();
      		return false;
		}
		else if(isNaN(document.getElementById("cf_to_saliva_color_change_max_value").value.trim()))
		{
      		alert("Cf To Saliva Color Change Max Value should be Numeric");
			document.getElementById("cf_to_saliva_color_change_max_value").value="";
      		document.getElementById("cf_to_saliva_color_change_max_value").focus();
      		return false;
		}
		else if(document.getElementById("uom_of_cf_to_saliva_color_change").value.trim()=="")
		{
      		alert("Please Provide Uom Of Cf To Saliva Color Change");
      		document.getElementById("uom_of_cf_to_saliva_color_change").focus();
      		return false;
		}
		else if(document.getElementById("cf_to_saliva_staining_tolerance_range_math_operator").value.trim()=="")
		{
      		alert("Please Provide Cf To Saliva Staining Tolerance Range Math Operator");
      		document.getElementById("cf_to_saliva_staining_tolerance_range_math_operator").focus();
      		return false;
		}
		else if(document.getElementById("cf_to_saliva_staining_tolerance_value").value.trim()=="")
		{
      		alert("Please Provide Cf To Saliva Staining Tolerance Value");
      		document.getElementById("cf_to_saliva_staining_tolerance_value").focus();
      		return false;
		}
		else if(isNaN(document.getElementById("cf_to_saliva_staining_tolerance_value").value.trim()))
		{
      		alert("Cf To Saliva Staining Tolerance Value should be Numeric");
			document.getElementById("cf_to_saliva_staining_tolerance_value").value="";
      		document.getElementById("cf_to_saliva_staining_tolerance_value").focus();
      		return false;
		}
		else if(document.getElementById("cf_to_saliva_staining_staining_min_value").value.trim()=="")
		{
      		alert("Please Provide Cf To Saliva Staining Staining Min Value");
      		document.getElementById("cf_to_saliva_staining_staining_min_value").focus();
      		return false;
		}
		else if(isNaN(document.getElementById("cf_to_saliva_staining_staining_min_value").value.trim()))
		{
      		alert("Cf To Saliva Staining Staining Min Value should be Numeric");
			document.getElementById("cf_to_saliva_staining_staining_min_value").value="";
      		document.getElementById("cf_to_saliva_staining_staining_min_value").focus();
      		return false;
		}
		else if(document.getElementById("cf_to_saliva_staining_max_value").value.trim()=="")
		{
      		alert("Please Provide Cf To Saliva Staining Max Value");
      		document.getElementById("cf_to_saliva_staining_max_value").focus();
      		return false;
		}
		else if(isNaN(document.getElementById("cf_to_saliva_staining_max_value").value.trim()))
		{
      		alert("Cf To Saliva Staining Max Value should be Numeric");
			document.getElementById("cf_to_saliva_staining_max_value").value="";
      		document.getElementById("cf_to_saliva_staining_max_value").focus();
      		return false;
		}
		else if(document.getElementById("uom_of_cf_to_saliva_staining").value.trim()=="")
		{
      		alert("Please Provide Uom Of Cf To Saliva Staining");
      		document.getElementById("uom_of_cf_to_saliva_staining").focus();
      		return false;
		}
		else if(document.getElementById("cf_to_chlorinated_water_color_change_tolerance_range_math_op").value.trim()=="")
		{
      		alert("Please Provide Cf To Chlorinated Water Color Change Tolerance Range Math Op");
      		document.getElementById("cf_to_chlorinated_water_color_change_tolerance_range_math_op").focus();
      		return false;
		}
		else if(document.getElementById("cf_to_chlorinated_water_color_change_tolerance_value").value.trim()=="")
		{
      		alert("Please Provide Cf To Chlorinated Water Color Change Tolerance Value");
      		document.getElementById("cf_to_chlorinated_water_color_change_tolerance_value").focus();
      		return false;
		}
		else if(isNaN(document.getElementById("cf_to_chlorinated_water_color_change_tolerance_value").value.trim()))
		{
      		alert("Cf To Chlorinated Water Color Change Tolerance Value should be Numeric");
			document.getElementById("cf_to_chlorinated_water_color_change_tolerance_value").value="";
      		document.getElementById("cf_to_chlorinated_water_color_change_tolerance_value").focus();
      		return false;
		}
		else if(document.getElementById("cf_to_chlorinated_water_color_change_min_value").value.trim()=="")
		{
      		alert("Please Provide Cf To Chlorinated Water Color Change Min Value");
      		document.getElementById("cf_to_chlorinated_water_color_change_min_value").focus();
      		return false;
		}
		else if(isNaN(document.getElementById("cf_to_chlorinated_water_color_change_min_value").value.trim()))
		{
      		alert("Cf To Chlorinated Water Color Change Min Value should be Numeric");
			document.getElementById("cf_to_chlorinated_water_color_change_min_value").value="";
      		document.getElementById("cf_to_chlorinated_water_color_change_min_value").focus();
      		return false;
		}
		else if(document.getElementById("cf_to_chlorinated_water_color_change_max_value").value.trim()=="")
		{
      		alert("Please Provide Cf To Chlorinated Water Color Change Max Value");
      		document.getElementById("cf_to_chlorinated_water_color_change_max_value").focus();
      		return false;
		}
		else if(isNaN(document.getElementById("cf_to_chlorinated_water_color_change_max_value").value.trim()))
		{
      		alert("Cf To Chlorinated Water Color Change Max Value should be Numeric");
			document.getElementById("cf_to_chlorinated_water_color_change_max_value").value="";
      		document.getElementById("cf_to_chlorinated_water_color_change_max_value").focus();
      		return false;
		}
		else if(document.getElementById("uom_of_cf_to_chlorinated_water_color_change").value.trim()=="")
		{
      		alert("Please Provide Uom Of Cf To Chlorinated Water Color Change");
      		document.getElementById("uom_of_cf_to_chlorinated_water_color_change").focus();
      		return false;
		}
		else if(document.getElementById("cf_to_chlorinated_water_staining_tolerance_range_math_operator").value.trim()=="")
		{
      		alert("Please Provide Cf To Chlorinated Water Staining Tolerance Range Math Operator");
      		document.getElementById("cf_to_chlorinated_water_staining_tolerance_range_math_operator").focus();
      		return false;
		}
		else if(document.getElementById("cf_to_chlorinated_water_staining_tolerance_value").value.trim()=="")
		{
      		alert("Please Provide Cf To Chlorinated Water Staining Tolerance Value");
      		document.getElementById("cf_to_chlorinated_water_staining_tolerance_value").focus();
      		return false;
		}
		else if(isNaN(document.getElementById("cf_to_chlorinated_water_staining_tolerance_value").value.trim()))
		{
      		alert("Cf To Chlorinated Water Staining Tolerance Value should be Numeric");
			document.getElementById("cf_to_chlorinated_water_staining_tolerance_value").value="";
      		document.getElementById("cf_to_chlorinated_water_staining_tolerance_value").focus();
      		return false;
		}
		else if(document.getElementById("cf_to_chlorinated_water_staining_min_value").value.trim()=="")
		{
      		alert("Please Provide Cf To Chlorinated Water Staining Min Value");
      		document.getElementById("cf_to_chlorinated_water_staining_min_value").focus();
      		return false;
		}
		else if(isNaN(document.getElementById("cf_to_chlorinated_water_staining_min_value").value.trim()))
		{
      		alert("Cf To Chlorinated Water Staining Min Value should be Numeric");
			document.getElementById("cf_to_chlorinated_water_staining_min_value").value="";
      		document.getElementById("cf_to_chlorinated_water_staining_min_value").focus();
      		return false;
		}
		else if(document.getElementById("cf_to_chlorinated_water_staining_max_value").value.trim()=="")
		{
      		alert("Please Provide Cf To Chlorinated Water Staining Max Value");
      		document.getElementById("cf_to_chlorinated_water_staining_max_value").focus();
      		return false;
		}
		else if(isNaN(document.getElementById("cf_to_chlorinated_water_staining_max_value").value.trim()))
		{
      		alert("Cf To Chlorinated Water Staining Max Value should be Numeric");
			document.getElementById("cf_to_chlorinated_water_staining_max_value").value="";
      		document.getElementById("cf_to_chlorinated_water_staining_max_value").focus();
      		return false;
		}
		else if(document.getElementById("uom_of_cf_to_chlorinated_water_staining").value.trim()=="")
		{
      		alert("Please Provide Uom Of Cf To Chlorinated Water Staining");
      		document.getElementById("uom_of_cf_to_chlorinated_water_staining").focus();
      		return false;
		}
		else if(document.getElementById("cf_to_cholorine_bleach_color_change_tolerance_range_math_op").value.trim()=="")
		{
      		alert("Please Provide Cf To Cholorine Bleach Color Change Tolerance Range Math Op");
      		document.getElementById("cf_to_cholorine_bleach_color_change_tolerance_range_math_op").focus();
      		return false;
		}
		else if(document.getElementById("cf_to_cholorine_bleach_color_change_tolerance_value").value.trim()=="")
		{
      		alert("Please Provide Cf To Cholorine Bleach Color Change Tolerance Value");
      		document.getElementById("cf_to_cholorine_bleach_color_change_tolerance_value").focus();
      		return false;
		}
		else if(isNaN(document.getElementById("cf_to_cholorine_bleach_color_change_tolerance_value").value.trim()))
		{
      		alert("Cf To Cholorine Bleach Color Change Tolerance Value should be Numeric");
			document.getElementById("cf_to_cholorine_bleach_color_change_tolerance_value").value="";
      		document.getElementById("cf_to_cholorine_bleach_color_change_tolerance_value").focus();
      		return false;
		}
		else if(document.getElementById("cf_to_cholorine_bleach_color_change_min_value").value.trim()=="")
		{
      		alert("Please Provide Cf To Cholorine Bleach Color Change Min Value");
      		document.getElementById("cf_to_cholorine_bleach_color_change_min_value").focus();
      		return false;
		}
		else if(isNaN(document.getElementById("cf_to_cholorine_bleach_color_change_min_value").value.trim()))
		{
      		alert("Cf To Cholorine Bleach Color Change Min Value should be Numeric");
			document.getElementById("cf_to_cholorine_bleach_color_change_min_value").value="";
      		document.getElementById("cf_to_cholorine_bleach_color_change_min_value").focus();
      		return false;
		}
		else if(document.getElementById("cf_to_cholorine_bleach_color_change_max_value").value.trim()=="")
		{
      		alert("Please Provide Cf To Cholorine Bleach Color Change Max Value");
      		document.getElementById("cf_to_cholorine_bleach_color_change_max_value").focus();
      		return false;
		}
		else if(isNaN(document.getElementById("cf_to_cholorine_bleach_color_change_max_value").value.trim()))
		{
      		alert("Cf To Cholorine Bleach Color Change Max Value should be Numeric");
			document.getElementById("cf_to_cholorine_bleach_color_change_max_value").value="";
      		document.getElementById("cf_to_cholorine_bleach_color_change_max_value").focus();
      		return false;
		}
		else if(document.getElementById("uom_of_cf_to_cholorine_bleach_color_change").value.trim()=="")
		{
      		alert("Please Provide Uom Of Cf To Cholorine Bleach Color Change");
      		document.getElementById("uom_of_cf_to_cholorine_bleach_color_change").focus();
      		return false;
		}
		else if(document.getElementById("cf_to_cholorine_bleach_staining_tolerance_range_math_operator").value.trim()=="")
		{
      		alert("Please Provide Cf To Cholorine Bleach Staining Tolerance Range Math Operator");
      		document.getElementById("cf_to_cholorine_bleach_staining_tolerance_range_math_operator").focus();
      		return false;
		}
		else if(document.getElementById("cf_to_cholorine_bleach_staining_tolerance_value").value.trim()=="")
		{
      		alert("Please Provide Cf To Cholorine Bleach Staining Tolerance Value");
      		document.getElementById("cf_to_cholorine_bleach_staining_tolerance_value").focus();
      		return false;
		}
		else if(isNaN(document.getElementById("cf_to_cholorine_bleach_staining_tolerance_value").value.trim()))
		{
      		alert("Cf To Cholorine Bleach Staining Tolerance Value should be Numeric");
			document.getElementById("cf_to_cholorine_bleach_staining_tolerance_value").value="";
      		document.getElementById("cf_to_cholorine_bleach_staining_tolerance_value").focus();
      		return false;
		}
		else if(document.getElementById("cf_to_cholorine_bleach_staining_min_value").value.trim()=="")
		{
      		alert("Please Provide Cf To Cholorine Bleach Staining Min Value");
      		document.getElementById("cf_to_cholorine_bleach_staining_min_value").focus();
      		return false;
		}
		else if(isNaN(document.getElementById("cf_to_cholorine_bleach_staining_min_value").value.trim()))
		{
      		alert("Cf To Cholorine Bleach Staining Min Value should be Numeric");
			document.getElementById("cf_to_cholorine_bleach_staining_min_value").value="";
      		document.getElementById("cf_to_cholorine_bleach_staining_min_value").focus();
      		return false;
		}
		else if(document.getElementById("cf_to_cholorine_bleach_staining_max_value").value.trim()=="")
		{
      		alert("Please Provide Cf To Cholorine Bleach Staining Max Value");
      		document.getElementById("cf_to_cholorine_bleach_staining_max_value").focus();
      		return false;
		}
		else if(isNaN(document.getElementById("cf_to_cholorine_bleach_staining_max_value").value.trim()))
		{
      		alert("Cf To Cholorine Bleach Staining Max Value should be Numeric");
			document.getElementById("cf_to_cholorine_bleach_staining_max_value").value="";
      		document.getElementById("cf_to_cholorine_bleach_staining_max_value").focus();
      		return false;
		}
		else if(document.getElementById("uom_of_cf_to_cholorine_bleach_staining").value.trim()=="")
		{
      		alert("Please Provide Uom Of Cf To Cholorine Bleach Staining");
      		document.getElementById("uom_of_cf_to_cholorine_bleach_staining").focus();
      		return false;
		}
		else if(document.getElementById("cf_to_peroxide_bleach_color_change_tolerance_range_math_operator").value.trim()=="")
		{
      		alert("Please Provide Cf To Peroxide Bleach Color Change Tolerance Range Math Operator");
      		document.getElementById("cf_to_peroxide_bleach_color_change_tolerance_range_math_operator").focus();
      		return false;
		}
		else if(document.getElementById("cf_to_peroxide_bleach_color_change_tolerance_value").value.trim()=="")
		{
      		alert("Please Provide Cf To Peroxide Bleach Color Change Tolerance Value");
      		document.getElementById("cf_to_peroxide_bleach_color_change_tolerance_value").focus();
      		return false;
		}
		else if(isNaN(document.getElementById("cf_to_peroxide_bleach_color_change_tolerance_value").value.trim()))
		{
      		alert("Cf To Peroxide Bleach Color Change Tolerance Value should be Numeric");
			document.getElementById("cf_to_peroxide_bleach_color_change_tolerance_value").value="";
      		document.getElementById("cf_to_peroxide_bleach_color_change_tolerance_value").focus();
      		return false;
		}
		else if(document.getElementById("cf_to_peroxide_bleach_color_change_min_value").value.trim()=="")
		{
      		alert("Please Provide Cf To Peroxide Bleach Color Change Min Value");
      		document.getElementById("cf_to_peroxide_bleach_color_change_min_value").focus();
      		return false;
		}
		else if(isNaN(document.getElementById("cf_to_peroxide_bleach_color_change_min_value").value.trim()))
		{
      		alert("Cf To Peroxide Bleach Color Change Min Value should be Numeric");
			document.getElementById("cf_to_peroxide_bleach_color_change_min_value").value="";
      		document.getElementById("cf_to_peroxide_bleach_color_change_min_value").focus();
      		return false;
		}
		else if(document.getElementById("cf_to_peroxide_bleach_color_change_max_value").value.trim()=="")
		{
      		alert("Please Provide Cf To Peroxide Bleach Color Change Max Value");
      		document.getElementById("cf_to_peroxide_bleach_color_change_max_value").focus();
      		return false;
		}
		else if(isNaN(document.getElementById("cf_to_peroxide_bleach_color_change_max_value").value.trim()))
		{
      		alert("Cf To Peroxide Bleach Color Change Max Value should be Numeric");
			document.getElementById("cf_to_peroxide_bleach_color_change_max_value").value="";
      		document.getElementById("cf_to_peroxide_bleach_color_change_max_value").focus();
      		return false;
		}
		else if(document.getElementById("uom_of_cf_to_peroxide_bleach_color_change").value.trim()=="")
		{
      		alert("Please Provide Uom Of Cf To Peroxide Bleach Color Change");
      		document.getElementById("uom_of_cf_to_peroxide_bleach_color_change").focus();
      		return false;
		}
		else if(document.getElementById("cf_to_peroxide_bleach_staining_tolerance_range_math_operator").value.trim()=="")
		{
      		alert("Please Provide Cf To Peroxide Bleach Staining Tolerance Range Math Operator");
      		document.getElementById("cf_to_peroxide_bleach_staining_tolerance_range_math_operator").focus();
      		return false;
		}
		else if(document.getElementById("cf_to_peroxide_bleach_staining_tolerance_value").value.trim()=="")
		{
      		alert("Please Provide Cf To Peroxide Bleach Staining Tolerance Value");
      		document.getElementById("cf_to_peroxide_bleach_staining_tolerance_value").focus();
      		return false;
		}
		else if(isNaN(document.getElementById("cf_to_peroxide_bleach_staining_tolerance_value").value.trim()))
		{
      		alert("Cf To Peroxide Bleach Staining Tolerance Value should be Numeric");
			document.getElementById("cf_to_peroxide_bleach_staining_tolerance_value").value="";
      		document.getElementById("cf_to_peroxide_bleach_staining_tolerance_value").focus();
      		return false;
		}
		else if(document.getElementById("cf_to_peroxide_bleach_staining_min_value").value.trim()=="")
		{
      		alert("Please Provide Cf To Peroxide Bleach Staining Min Value");
      		document.getElementById("cf_to_peroxide_bleach_staining_min_value").focus();
      		return false;
		}
		else if(isNaN(document.getElementById("cf_to_peroxide_bleach_staining_min_value").value.trim()))
		{
      		alert("Cf To Peroxide Bleach Staining Min Value should be Numeric");
			document.getElementById("cf_to_peroxide_bleach_staining_min_value").value="";
      		document.getElementById("cf_to_peroxide_bleach_staining_min_value").focus();
      		return false;
		}
		else if(document.getElementById("cf_to_peroxide_bleach_staining_max_value").value.trim()=="")
		{
      		alert("Please Provide Cf To Peroxide Bleach Staining Max Value");
      		document.getElementById("cf_to_peroxide_bleach_staining_max_value").focus();
      		return false;
		}
		else if(isNaN(document.getElementById("cf_to_peroxide_bleach_staining_max_value").value.trim()))
		{
      		alert("Cf To Peroxide Bleach Staining Max Value should be Numeric");
			document.getElementById("cf_to_peroxide_bleach_staining_max_value").value="";
      		document.getElementById("cf_to_peroxide_bleach_staining_max_value").focus();
      		return false;
		}
		else if(document.getElementById("uom_of_cf_to_peroxide_bleach_staining").value.trim()=="")
		{
      		alert("Please Provide Uom Of Cf To Peroxide Bleach Staining");
      		document.getElementById("uom_of_cf_to_peroxide_bleach_staining").focus();
      		return false;
		}
		else if(document.getElementById("cross_staining_tolerance_range_math_operator").value.trim()=="")
		{
      		alert("Please Provide Cross Staining Tolerance Range Math Operator");
      		document.getElementById("cross_staining_tolerance_range_math_operator").focus();
      		return false;
		}
		else if(document.getElementById("cross_staining_tolerance_value").value.trim()=="")
		{
      		alert("Please Provide Cross Staining Tolerance Value");
      		document.getElementById("cross_staining_tolerance_value").focus();
      		return false;
		}
		else if(isNaN(document.getElementById("cross_staining_tolerance_value").value.trim()))
		{
      		alert("Cross Staining Tolerance Value should be Numeric");
			document.getElementById("cross_staining_tolerance_value").value="";
      		document.getElementById("cross_staining_tolerance_value").focus();
      		return false;
		}
		else if(document.getElementById("cross_staining_min_value").value.trim()=="")
		{
      		alert("Please Provide Cross Staining Min Value");
      		document.getElementById("cross_staining_min_value").focus();
      		return false;
		}
		else if(isNaN(document.getElementById("cross_staining_min_value").value.trim()))
		{
      		alert("Cross Staining Min Value should be Numeric");
			document.getElementById("cross_staining_min_value").value="";
      		document.getElementById("cross_staining_min_value").focus();
      		return false;
		}
		else if(document.getElementById("cross_staining_max_value").value.trim()=="")
		{
      		alert("Please Provide Cross Staining Max Value");
      		document.getElementById("cross_staining_max_value").focus();
      		return false;
		}
		else if(isNaN(document.getElementById("cross_staining_max_value").value.trim()))
		{
      		alert("Cross Staining Max Value should be Numeric");
			document.getElementById("cross_staining_max_value").value="";
      		document.getElementById("cross_staining_max_value").focus();
      		return false;
		}
		else if(document.getElementById("uom_of_cross_staining").value.trim()=="")
		{
      		alert("Please Provide Uom Of Cross Staining");
      		document.getElementById("uom_of_cross_staining").focus();
      		return false;
		}
		else if(document.getElementById("water_absorption_value_tolerance_range_math_operator").value.trim()=="")
		{
      		alert("Please Provide Water Absorption Value Tolerance Range Math Operator");
      		document.getElementById("water_absorption_value_tolerance_range_math_operator").focus();
      		return false;
		}
		else if(document.getElementById("water_absorption_value_tolerance_value").value.trim()=="")
		{
      		alert("Please Provide Water Absorption Value Tolerance Value");
      		document.getElementById("water_absorption_value_tolerance_value").focus();
      		return false;
		}
		else if(isNaN(document.getElementById("water_absorption_value_tolerance_value").value.trim()))
		{
      		alert("Water Absorption Value Tolerance Value should be Numeric");
			document.getElementById("water_absorption_value_tolerance_value").value="";
      		document.getElementById("water_absorption_value_tolerance_value").focus();
      		return false;
		}
		else if(document.getElementById("water_absorption_value_min_value").value.trim()=="")
		{
      		alert("Please Provide Water Absorption Value Min Value");
      		document.getElementById("water_absorption_value_min_value").focus();
      		return false;
		}
		else if(isNaN(document.getElementById("water_absorption_value_min_value").value.trim()))
		{
      		alert("Water Absorption Value Min Value should be Numeric");
			document.getElementById("water_absorption_value_min_value").value="";
      		document.getElementById("water_absorption_value_min_value").focus();
      		return false;
		}
		else if(document.getElementById("water_absorption_value_max_value").value.trim()=="")
		{
      		alert("Please Provide Water Absorption Value Max Value");
      		document.getElementById("water_absorption_value_max_value").focus();
      		return false;
		}
		else if(isNaN(document.getElementById("water_absorption_value_max_value").value.trim()))
		{
      		alert("Water Absorption Value Max Value should be Numeric");
			document.getElementById("water_absorption_value_max_value").value="";
      		document.getElementById("water_absorption_value_max_value").focus();
      		return false;
		}
		else if(document.getElementById("uom_of_water_absorption_value").value.trim()=="")
		{
      		alert("Please Provide Uom Of Water Absorption Value");
      		document.getElementById("uom_of_water_absorption_value").focus();
      		return false;
		}
		else if(document.getElementById("spirality_value_tolerance_range_math_operator").value.trim()=="")
		{
      		alert("Please Provide Spirality Value Tolerance Range Math Operator");
      		document.getElementById("spirality_value_tolerance_range_math_operator").focus();
      		return false;
		}
		else if(document.getElementById("spirality_value_tolerance_value").value.trim()=="")
		{
      		alert("Please Provide Spirality Value Tolerance Value");
      		document.getElementById("spirality_value_tolerance_value").focus();
      		return false;
		}
		else if(isNaN(document.getElementById("spirality_value_tolerance_value").value.trim()))
		{
      		alert("Spirality Value Tolerance Value should be Numeric");
			document.getElementById("spirality_value_tolerance_value").value="";
      		document.getElementById("spirality_value_tolerance_value").focus();
      		return false;
		}
		else if(document.getElementById("spirality_value_min_value").value.trim()=="")
		{
      		alert("Please Provide Spirality Value Min Value");
      		document.getElementById("spirality_value_min_value").focus();
      		return false;
		}
		else if(isNaN(document.getElementById("spirality_value_min_value").value.trim()))
		{
      		alert("Spirality Value Min Value should be Numeric");
			document.getElementById("spirality_value_min_value").value="";
      		document.getElementById("spirality_value_min_value").focus();
      		return false;
		}
		else if(document.getElementById("spirality_value_max_value").value.trim()=="")
		{
      		alert("Please Provide Spirality Value Max Value");
      		document.getElementById("spirality_value_max_value").focus();
      		return false;
		}
		else if(isNaN(document.getElementById("spirality_value_max_value").value.trim()))
		{
      		alert("Spirality Value Max Value should be Numeric");
			document.getElementById("spirality_value_max_value").value="";
      		document.getElementById("spirality_value_max_value").focus();
      		return false;
		}
		else if(document.getElementById("uom_of_spirality_value").value.trim()=="")
		{
      		alert("Please Provide Uom Of Spirality Value");
      		document.getElementById("uom_of_spirality_value").focus();
      		return false;
		}
		else if(document.getElementById("durable_press_value_tolerance_range_math_operator").value.trim()=="")
		{
      		alert("Please Provide Durable Press Value Tolerance Range Math Operator");
      		document.getElementById("durable_press_value_tolerance_range_math_operator").focus();
      		return false;
		}
		else if(document.getElementById("durable_press_value_tolerance_value").value.trim()=="")
		{
      		alert("Please Provide Durable Press Value Tolerance Value");
      		document.getElementById("durable_press_value_tolerance_value").focus();
      		return false;
		}
		else if(isNaN(document.getElementById("durable_press_value_tolerance_value").value.trim()))
		{
      		alert("Durable Press Value Tolerance Value should be Numeric");
			document.getElementById("durable_press_value_tolerance_value").value="";
      		document.getElementById("durable_press_value_tolerance_value").focus();
      		return false;
		}
		else if(document.getElementById("durable_press_value_min_value").value.trim()=="")
		{
      		alert("Please Provide Durable Press Value Min Value");
      		document.getElementById("durable_press_value_min_value").focus();
      		return false;
		}
		else if(isNaN(document.getElementById("durable_press_value_min_value").value.trim()))
		{
      		alert("Durable Press Value Min Value should be Numeric");
			document.getElementById("durable_press_value_min_value").value="";
      		document.getElementById("durable_press_value_min_value").focus();
      		return false;
		}
		else if(document.getElementById("durable_press_value_max_value").value.trim()=="")
		{
      		alert("Please Provide Durable Press Value Max Value");
      		document.getElementById("durable_press_value_max_value").focus();
      		return false;
		}
		else if(isNaN(document.getElementById("durable_press_value_max_value").value.trim()))
		{
      		alert("Durable Press Value Max Value should be Numeric");
			document.getElementById("durable_press_value_max_value").value="";
      		document.getElementById("durable_press_value_max_value").focus();
      		return false;
		}
		else if(document.getElementById("uom_of_durable_press_value").value.trim()=="")
		{
      		alert("Please Provide Uom Of Durable Press Value");
      		document.getElementById("uom_of_durable_press_value").focus();
      		return false;
		}
		else if(document.getElementById("ironability_of_woven_fabric_value_tolerance_range_math_operator").value.trim()=="")
		{
      		alert("Please Provide Ironability Of Woven Fabric Value Tolerance Range Math Operator");
      		document.getElementById("ironability_of_woven_fabric_value_tolerance_range_math_operator").focus();
      		return false;
		}
		else if(document.getElementById("ironability_of_woven_fabric_value_tolerance_value").value.trim()=="")
		{
      		alert("Please Provide Ironability Of Woven Fabric Value Tolerance Value");
      		document.getElementById("ironability_of_woven_fabric_value_tolerance_value").focus();
      		return false;
		}
		else if(isNaN(document.getElementById("ironability_of_woven_fabric_value_tolerance_value").value.trim()))
		{
      		alert("Ironability Of Woven Fabric Value Tolerance Value should be Numeric");
			document.getElementById("ironability_of_woven_fabric_value_tolerance_value").value="";
      		document.getElementById("ironability_of_woven_fabric_value_tolerance_value").focus();
      		return false;
		}
		else if(document.getElementById("ironability_of_woven_fabric_value_min_value").value.trim()=="")
		{
      		alert("Please Provide Ironability Of Woven Fabric Value Min Value");
      		document.getElementById("ironability_of_woven_fabric_value_min_value").focus();
      		return false;
		}
		else if(isNaN(document.getElementById("ironability_of_woven_fabric_value_min_value").value.trim()))
		{
      		alert("Ironability Of Woven Fabric Value Min Value should be Numeric");
			document.getElementById("ironability_of_woven_fabric_value_min_value").value="";
      		document.getElementById("ironability_of_woven_fabric_value_min_value").focus();
      		return false;
		}
		else if(document.getElementById("ironability_of_woven_fabric_value_max_value").value.trim()=="")
		{
      		alert("Please Provide Ironability Of Woven Fabric Value Max Value");
      		document.getElementById("ironability_of_woven_fabric_value_max_value").focus();
      		return false;
		}
		else if(isNaN(document.getElementById("ironability_of_woven_fabric_value_max_value").value.trim()))
		{
      		alert("Ironability Of Woven Fabric Value Max Value should be Numeric");
			document.getElementById("ironability_of_woven_fabric_value_max_value").value="";
      		document.getElementById("ironability_of_woven_fabric_value_max_value").focus();
      		return false;
		}
		else if(document.getElementById("uom_of_ironability_of_woven_fabric_value").value.trim()=="")
		{
      		alert("Please Provide Uom Of Ironability Of Woven Fabric Value");
      		document.getElementById("uom_of_ironability_of_woven_fabric_value").focus();
      		return false;
		}
		else if(document.getElementById("cf_to_artificial_light_value_tolerance_range_math_operator").value.trim()=="")
		{
      		alert("Please Provide Cf To Artificial Light Value Tolerance Range Math Operator");
      		document.getElementById("cf_to_artificial_light_value_tolerance_range_math_operator").focus();
      		return false;
		}
		else if(document.getElementById("cf_to_artificial_light_value_tolerance_value").value.trim()=="")
		{
      		alert("Please Provide Cf To Artificial Light Value Tolerance Value");
      		document.getElementById("cf_to_artificial_light_value_tolerance_value").focus();
      		return false;
		}
		else if(isNaN(document.getElementById("cf_to_artificial_light_value_tolerance_value").value.trim()))
		{
      		alert("Cf To Artificial Light Value Tolerance Value should be Numeric");
			document.getElementById("cf_to_artificial_light_value_tolerance_value").value="";
      		document.getElementById("cf_to_artificial_light_value_tolerance_value").focus();
      		return false;
		}
		else if(document.getElementById("cf_to_artificial_light_value_min_value").value.trim()=="")
		{
      		alert("Please Provide Cf To Artificial Light Value Min Value");
      		document.getElementById("cf_to_artificial_light_value_min_value").focus();
      		return false;
		}
		else if(isNaN(document.getElementById("cf_to_artificial_light_value_min_value").value.trim()))
		{
      		alert("Cf To Artificial Light Value Min Value should be Numeric");
			document.getElementById("cf_to_artificial_light_value_min_value").value="";
      		document.getElementById("cf_to_artificial_light_value_min_value").focus();
      		return false;
		}
		else if(document.getElementById("cf_to_artificial_light_value_max_value").value.trim()=="")
		{
      		alert("Please Provide Cf To Artificial Light Value Max Value");
      		document.getElementById("cf_to_artificial_light_value_max_value").focus();
      		return false;
		}
		else if(isNaN(document.getElementById("cf_to_artificial_light_value_max_value").value.trim()))
		{
      		alert("Cf To Artificial Light Value Max Value should be Numeric");
			document.getElementById("cf_to_artificial_light_value_max_value").value="";
      		document.getElementById("cf_to_artificial_light_value_max_value").focus();
      		return false;
		}
		else if(document.getElementById("uom_of_cf_to_artificial_light_value").value.trim()=="")
		{
      		alert("Please Provide Uom Of Cf To Artificial Light Value");
      		document.getElementById("uom_of_cf_to_artificial_light_value").focus();
      		return false;
		}
		else if(document.getElementById("moisture_content_in_percentage_min_value").value.trim()=="")
		{
      		alert("Please Provide Moisture Content In Percentage Min Value");
      		document.getElementById("moisture_content_in_percentage_min_value").focus();
      		return false;
		}
		else if(isNaN(document.getElementById("moisture_content_in_percentage_min_value").value.trim()))
		{
      		alert("Moisture Content In Percentage Min Value should be Numeric");
			document.getElementById("moisture_content_in_percentage_min_value").value="";
      		document.getElementById("moisture_content_in_percentage_min_value").focus();
      		return false;
		}
		else if(document.getElementById("moisture_content_in_percentage_max_value").value.trim()=="")
		{
      		alert("Please Provide Moisture Content In Percentage Max Value");
      		document.getElementById("moisture_content_in_percentage_max_value").focus();
      		return false;
		}
		else if(isNaN(document.getElementById("moisture_content_in_percentage_max_value").value.trim()))
		{
      		alert("Moisture Content In Percentage Max Value should be Numeric");
			document.getElementById("moisture_content_in_percentage_max_value").value="";
      		document.getElementById("moisture_content_in_percentage_max_value").focus();
      		return false;
		}
		else if(document.getElementById("uom_of_moisture_content_in_percentage").value.trim()=="")
		{
      		alert("Please Provide Uom Of Moisture Content In Percentage");
      		document.getElementById("uom_of_moisture_content_in_percentage").focus();
      		return false;
		}
		else if(document.getElementById("evaporation_rate_in_percentage_min_value").value.trim()=="")
		{
      		alert("Please Provide Evaporation Rate In Percentage Min Value");
      		document.getElementById("evaporation_rate_in_percentage_min_value").focus();
      		return false;
		}
		else if(isNaN(document.getElementById("evaporation_rate_in_percentage_min_value").value.trim()))
		{
      		alert("Evaporation Rate In Percentage Min Value should be Numeric");
			document.getElementById("evaporation_rate_in_percentage_min_value").value="";
      		document.getElementById("evaporation_rate_in_percentage_min_value").focus();
      		return false;
		}
		else if(document.getElementById("evaporation_rate_in_percentage_max_value").value.trim()=="")
		{
      		alert("Please Provide Evaporation Rate In Percentage Max Value");
      		document.getElementById("evaporation_rate_in_percentage_max_value").focus();
      		return false;
		}
		else if(isNaN(document.getElementById("evaporation_rate_in_percentage_max_value").value.trim()))
		{
      		alert("Evaporation Rate In Percentage Max Value should be Numeric");
			document.getElementById("evaporation_rate_in_percentage_max_value").value="";
      		document.getElementById("evaporation_rate_in_percentage_max_value").focus();
      		return false;
		}
		else if(document.getElementById("uom_of_evaporation_rate_in_percentage").value.trim()=="")
		{
      		alert("Please Provide Uom Of Evaporation Rate In Percentage");
      		document.getElementById("uom_of_evaporation_rate_in_percentage").focus();
      		return false;
		}
		else if(document.getElementById("percentage_of_total_cotton_content_tolerance_range_math_operator").value.trim()=="")
		{
      		alert("Please Provide Percentage Of Total Cotton Content Tolerance Range Math Operator");
      		document.getElementById("percentage_of_total_cotton_content_tolerance_range_math_operator").focus();
      		return false;
		}
		else if(document.getElementById("percentage_of_total_cotton_content_tolerance_value").value.trim()=="")
		{
      		alert("Please Provide Percentage Of Total Cotton Content Tolerance Value");
      		document.getElementById("percentage_of_total_cotton_content_tolerance_value").focus();
      		return false;
		}
		else if(isNaN(document.getElementById("percentage_of_total_cotton_content_tolerance_value").value.trim()))
		{
      		alert("Percentage Of Total Cotton Content Tolerance Value should be Numeric");
			document.getElementById("percentage_of_total_cotton_content_tolerance_value").value="";
      		document.getElementById("percentage_of_total_cotton_content_tolerance_value").focus();
      		return false;
		}
		else if(document.getElementById("percentage_of_total_cotton_content_min_value").value.trim()=="")
		{
      		alert("Please Provide Percentage Of Total Cotton Content Min Value");
      		document.getElementById("percentage_of_total_cotton_content_min_value").focus();
      		return false;
		}
		else if(isNaN(document.getElementById("percentage_of_total_cotton_content_min_value").value.trim()))
		{
      		alert("Percentage Of Total Cotton Content Min Value should be Numeric");
			document.getElementById("percentage_of_total_cotton_content_min_value").value="";
      		document.getElementById("percentage_of_total_cotton_content_min_value").focus();
      		return false;
		}
		else if(document.getElementById("percentage_of_total_cotton_content_max_value").value.trim()=="")
		{
      		alert("Please Provide Percentage Of Total Cotton Content Max Value");
      		document.getElementById("percentage_of_total_cotton_content_max_value").focus();
      		return false;
		}
		else if(isNaN(document.getElementById("percentage_of_total_cotton_content_max_value").value.trim()))
		{
      		alert("Percentage Of Total Cotton Content Max Value should be Numeric");
			document.getElementById("percentage_of_total_cotton_content_max_value").value="";
      		document.getElementById("percentage_of_total_cotton_content_max_value").focus();
      		return false;
		}
		else if(document.getElementById("uom_of_percentage_of_total_cotton_content").value.trim()=="")
		{
      		alert("Please Provide Uom Of Percentage Of Total Cotton Content");
      		document.getElementById("uom_of_percentage_of_total_cotton_content").focus();
      		return false;
		}
		else if(document.getElementById("percentage_of_total_polyester_content_tolerance_range_math_op").value.trim()=="")
		{
      		alert("Please Provide Percentage Of Total Polyester Content Tolerance Range Math Op");
      		document.getElementById("percentage_of_total_polyester_content_tolerance_range_math_op").focus();
      		return false;
		}
		else if(document.getElementById("percentage_of_total_polyester_content_tolerance_value").value.trim()=="")
		{
      		alert("Please Provide Percentage Of Total Polyester Content Tolerance Value");
      		document.getElementById("percentage_of_total_polyester_content_tolerance_value").focus();
      		return false;
		}
		else if(isNaN(document.getElementById("percentage_of_total_polyester_content_tolerance_value").value.trim()))
		{
      		alert("Percentage Of Total Polyester Content Tolerance Value should be Numeric");
			document.getElementById("percentage_of_total_polyester_content_tolerance_value").value="";
      		document.getElementById("percentage_of_total_polyester_content_tolerance_value").focus();
      		return false;
		}
		else if(document.getElementById("percentage_of_total_polyester_content_min_value").value.trim()=="")
		{
      		alert("Please Provide Percentage Of Total Polyester Content Min Value");
      		document.getElementById("percentage_of_total_polyester_content_min_value").focus();
      		return false;
		}
		else if(isNaN(document.getElementById("percentage_of_total_polyester_content_min_value").value.trim()))
		{
      		alert("Percentage Of Total Polyester Content Min Value should be Numeric");
			document.getElementById("percentage_of_total_polyester_content_min_value").value="";
      		document.getElementById("percentage_of_total_polyester_content_min_value").focus();
      		return false;
		}
		else if(document.getElementById("percentage_of_total_polyester_content_max_value").value.trim()=="")
		{
      		alert("Please Provide Percentage Of Total Polyester Content Max Value");
      		document.getElementById("percentage_of_total_polyester_content_max_value").focus();
      		return false;
		}
		else if(isNaN(document.getElementById("percentage_of_total_polyester_content_max_value").value.trim()))
		{
      		alert("Percentage Of Total Polyester Content Max Value should be Numeric");
			document.getElementById("percentage_of_total_polyester_content_max_value").value="";
      		document.getElementById("percentage_of_total_polyester_content_max_value").focus();
      		return false;
		}
		else if(document.getElementById("uom_of_percentage_of_total_polyester_content").value.trim()=="")
		{
      		alert("Please Provide Uom Of Percentage Of Total Polyester Content");
      		document.getElementById("uom_of_percentage_of_total_polyester_content").focus();
      		return false;
		}
		else if(document.getElementById("percentage_of_total_other_fiber_content_tolerance_range_math_op").value.trim()=="")
		{
      		alert("Please Provide Percentage Of Total Other Fiber Content Tolerance Range Math Op");
      		document.getElementById("percentage_of_total_other_fiber_content_tolerance_range_math_op").focus();
      		return false;
		}
		else if(document.getElementById("percentage_of_total_other_fiber_content_tolerance_value").value.trim()=="")
		{
      		alert("Please Provide Percentage Of Total Other Fiber Content Tolerance Value");
      		document.getElementById("percentage_of_total_other_fiber_content_tolerance_value").focus();
      		return false;
		}
		else if(isNaN(document.getElementById("percentage_of_total_other_fiber_content_tolerance_value").value.trim()))
		{
      		alert("Percentage Of Total Other Fiber Content Tolerance Value should be Numeric");
			document.getElementById("percentage_of_total_other_fiber_content_tolerance_value").value="";
      		document.getElementById("percentage_of_total_other_fiber_content_tolerance_value").focus();
      		return false;
		}
		else if(document.getElementById("percentage_of_total_other_fiber_content_min_value").value.trim()=="")
		{
      		alert("Please Provide Percentage Of Total Other Fiber Content Min Value");
      		document.getElementById("percentage_of_total_other_fiber_content_min_value").focus();
      		return false;
		}
		else if(isNaN(document.getElementById("percentage_of_total_other_fiber_content_min_value").value.trim()))
		{
      		alert("Percentage Of Total Other Fiber Content Min Value should be Numeric");
			document.getElementById("percentage_of_total_other_fiber_content_min_value").value="";
      		document.getElementById("percentage_of_total_other_fiber_content_min_value").focus();
      		return false;
		}
		else if(document.getElementById("percentage_of_total_other_fiber_content_max_value").value.trim()=="")
		{
      		alert("Please Provide Percentage Of Total Other Fiber Content Max Value");
      		document.getElementById("percentage_of_total_other_fiber_content_max_value").focus();
      		return false;
		}
		else if(isNaN(document.getElementById("percentage_of_total_other_fiber_content_max_value").value.trim()))
		{
      		alert("Percentage Of Total Other Fiber Content Max Value should be Numeric");
			document.getElementById("percentage_of_total_other_fiber_content_max_value").value="";
      		document.getElementById("percentage_of_total_other_fiber_content_max_value").focus();
      		return false;
		}
		else if(document.getElementById("uom_of_percentage_of_total_other_fiber_content").value.trim()=="")
		{
      		alert("Please Provide Uom Of Percentage Of Total Other Fiber Content");
      		document.getElementById("uom_of_percentage_of_total_other_fiber_content").focus();
      		return false;
		}
		else if(document.getElementById("percentage_of_warp_cotton_content_tolerance_range_math_operator").value.trim()=="")
		{
      		alert("Please Provide Percentage Of Warp Cotton Content Tolerance Range Math Operator");
      		document.getElementById("percentage_of_warp_cotton_content_tolerance_range_math_operator").focus();
      		return false;
		}
		else if(document.getElementById("percentage_of_warp_cotton_content_tolerance_value").value.trim()=="")
		{
      		alert("Please Provide Percentage Of Warp Cotton Content Tolerance Value");
      		document.getElementById("percentage_of_warp_cotton_content_tolerance_value").focus();
      		return false;
		}
		else if(isNaN(document.getElementById("percentage_of_warp_cotton_content_tolerance_value").value.trim()))
		{
      		alert("Percentage Of Warp Cotton Content Tolerance Value should be Numeric");
			document.getElementById("percentage_of_warp_cotton_content_tolerance_value").value="";
      		document.getElementById("percentage_of_warp_cotton_content_tolerance_value").focus();
      		return false;
		}
		else if(document.getElementById("percentage_of_warp_cotton_content_min_value").value.trim()=="")
		{
      		alert("Please Provide Percentage Of Warp Cotton Content Min Value");
      		document.getElementById("percentage_of_warp_cotton_content_min_value").focus();
      		return false;
		}
		else if(isNaN(document.getElementById("percentage_of_warp_cotton_content_min_value").value.trim()))
		{
      		alert("Percentage Of Warp Cotton Content Min Value should be Numeric");
			document.getElementById("percentage_of_warp_cotton_content_min_value").value="";
      		document.getElementById("percentage_of_warp_cotton_content_min_value").focus();
      		return false;
		}
		else if(document.getElementById("uom_of_percentage_of_warp_cotton_content").value.trim()=="")
		{
      		alert("Please Provide Uom Of Percentage Of Warp Cotton Content");
      		document.getElementById("uom_of_percentage_of_warp_cotton_content").focus();
      		return false;
		}
		else if(document.getElementById("percentage_of_warp_polyester_content_tolerance_range_math_op").value.trim()=="")
		{
      		alert("Please Provide Percentage Of Warp Polyester Content Tolerance Range Math Op");
      		document.getElementById("percentage_of_warp_polyester_content_tolerance_range_math_op").focus();
      		return false;
		}
		else if(document.getElementById("percentage_of_warp_polyester_content_tolerance_value").value.trim()=="")
		{
      		alert("Please Provide Percentage Of Warp Polyester Content Tolerance Value");
      		document.getElementById("percentage_of_warp_polyester_content_tolerance_value").focus();
      		return false;
		}
		else if(isNaN(document.getElementById("percentage_of_warp_polyester_content_tolerance_value").value.trim()))
		{
      		alert("Percentage Of Warp Polyester Content Tolerance Value should be Numeric");
			document.getElementById("percentage_of_warp_polyester_content_tolerance_value").value="";
      		document.getElementById("percentage_of_warp_polyester_content_tolerance_value").focus();
      		return false;
		}
		else if(document.getElementById("percentage_of_warp_polyester_content_min_value").value.trim()=="")
		{
      		alert("Please Provide Percentage Of Warp Polyester Content Min Value");
      		document.getElementById("percentage_of_warp_polyester_content_min_value").focus();
      		return false;
		}
		else if(isNaN(document.getElementById("percentage_of_warp_polyester_content_min_value").value.trim()))
		{
      		alert("Percentage Of Warp Polyester Content Min Value should be Numeric");
			document.getElementById("percentage_of_warp_polyester_content_min_value").value="";
      		document.getElementById("percentage_of_warp_polyester_content_min_value").focus();
      		return false;
		}
		else if(document.getElementById("percentage_of_warp_polyester_content_max_value").value.trim()=="")
		{
      		alert("Please Provide Percentage Of Warp Polyester Content Max Value");
      		document.getElementById("percentage_of_warp_polyester_content_max_value").focus();
      		return false;
		}
		else if(isNaN(document.getElementById("percentage_of_warp_polyester_content_max_value").value.trim()))
		{
      		alert("Percentage Of Warp Polyester Content Max Value should be Numeric");
			document.getElementById("percentage_of_warp_polyester_content_max_value").value="";
      		document.getElementById("percentage_of_warp_polyester_content_max_value").focus();
      		return false;
		}
		else if(document.getElementById("uom_of_percentage_of_warp_polyester_content").value.trim()=="")
		{
      		alert("Please Provide Uom Of Percentage Of Warp Polyester Content");
      		document.getElementById("uom_of_percentage_of_warp_polyester_content").focus();
      		return false;
		}
		else if(document.getElementById("percentage_of_warp_other_fiber_content_tolerance_range_math_op").value.trim()=="")
		{
      		alert("Please Provide Percentage Of Warp Other Fiber Content Tolerance Range Math Op");
      		document.getElementById("percentage_of_warp_other_fiber_content_tolerance_range_math_op").focus();
      		return false;
		}
		else if(document.getElementById("percentage_of_warp_other_fiber_content_tolerance_value").value.trim()=="")
		{
      		alert("Please Provide Percentage Of Warp Other Fiber Content Tolerance Value");
      		document.getElementById("percentage_of_warp_other_fiber_content_tolerance_value").focus();
      		return false;
		}
		else if(isNaN(document.getElementById("percentage_of_warp_other_fiber_content_tolerance_value").value.trim()))
		{
      		alert("Percentage Of Warp Other Fiber Content Tolerance Value should be Numeric");
			document.getElementById("percentage_of_warp_other_fiber_content_tolerance_value").value="";
      		document.getElementById("percentage_of_warp_other_fiber_content_tolerance_value").focus();
      		return false;
		}
		else if(document.getElementById("percentage_of_warp_other_fiber_content_min_value").value.trim()=="")
		{
      		alert("Please Provide Percentage Of Warp Other Fiber Content Min Value");
      		document.getElementById("percentage_of_warp_other_fiber_content_min_value").focus();
      		return false;
		}
		else if(isNaN(document.getElementById("percentage_of_warp_other_fiber_content_min_value").value.trim()))
		{
      		alert("Percentage Of Warp Other Fiber Content Min Value should be Numeric");
			document.getElementById("percentage_of_warp_other_fiber_content_min_value").value="";
      		document.getElementById("percentage_of_warp_other_fiber_content_min_value").focus();
      		return false;
		}
		else if(document.getElementById("percentage_of_warp_other_fiber_content_max_value").value.trim()=="")
		{
      		alert("Please Provide Percentage Of Warp Other Fiber Content Max Value");
      		document.getElementById("percentage_of_warp_other_fiber_content_max_value").focus();
      		return false;
		}
		else if(isNaN(document.getElementById("percentage_of_warp_other_fiber_content_max_value").value.trim()))
		{
      		alert("Percentage Of Warp Other Fiber Content Max Value should be Numeric");
			document.getElementById("percentage_of_warp_other_fiber_content_max_value").value="";
      		document.getElementById("percentage_of_warp_other_fiber_content_max_value").focus();
      		return false;
		}
		else if(document.getElementById("uom_of_percentage_of_warp_other_fiber_content").value.trim()=="")
		{
      		alert("Please Provide Uom Of Percentage Of Warp Other Fiber Content");
      		document.getElementById("uom_of_percentage_of_warp_other_fiber_content").focus();
      		return false;
		}
		/*else if(document.getElementById("percentage_of_weft_polyester_content_tolerance_range_math_op").value.trim()=="")
		{
      		alert("Please Provide Percentage Of Weft Polyester Content Tolerance Range Math Op");
      		document.getElementById("percentage_of_weft_polyester_content_tolerance_range_math_op").focus();
      		return false;
		}
		else if(isNaN(document.getElementById("percentage_of_weft_polyester_content_tolerance_range_math_op").value.trim()))
		{
      		alert("Percentage Of Weft Polyester Content Tolerance Range Math Op should be Numeric");
			document.getElementById("percentage_of_weft_polyester_content_tolerance_range_math_op").value="";
      		document.getElementById("percentage_of_weft_polyester_content_tolerance_range_math_op").focus();
      		return false;
		}


		else if(document.getElementById("percentage_of_weft_polyester_content_tolerance_value").value.trim()=="")
		{
      		alert("Please Provide Percentage Of Weft Polyester Content Tolerance Value");
      		document.getElementById("percentage_of_weft_polyester_content_tolerance_value").focus();
      		return false;
		}
		else if(isNaN(document.getElementById("percentage_of_weft_polyester_content_tolerance_value").value.trim()))
		{
      		alert("Percentage Of Weft Polyester Content Tolerance Value should be Numeric");
			document.getElementById("percentage_of_weft_polyester_content_tolerance_value").value="";
      		document.getElementById("percentage_of_weft_polyester_content_tolerance_value").focus();
      		return false;
		}
		else if(document.getElementById("percentage_of_weft_polyester_content_min_value").value.trim()=="")
		{
      		alert("Please Provide Percentage Of Weft Polyester Content Min Value");
      		document.getElementById("percentage_of_weft_polyester_content_min_value").focus();
      		return false;
		}
		else if(isNaN(document.getElementById("percentage_of_weft_polyester_content_min_value").value.trim()))
		{
      		alert("Percentage Of Weft Polyester Content Min Value should be Numeric");
			document.getElementById("percentage_of_weft_polyester_content_min_value").value="";
      		document.getElementById("percentage_of_weft_polyester_content_min_value").focus();
      		return false;
		}
		else if(document.getElementById("percentage_of_weft_polyester_content_max_value").value.trim()=="")
		{
      		alert("Please Provide Percentage Of Weft Polyester Content Max Value");
      		document.getElementById("percentage_of_weft_polyester_content_max_value").focus();
      		return false;
		}
		else if(isNaN(document.getElementById("percentage_of_weft_polyester_content_max_value").value.trim()))
		{
      		alert("Percentage Of Weft Polyester Content Max Value should be Numeric");
			document.getElementById("percentage_of_weft_polyester_content_max_value").value="";
      		document.getElementById("percentage_of_weft_polyester_content_max_value").focus();
      		return false;
		}
		else if(document.getElementById("uom_of_percentage_of_weft_polyester_content").value.trim()=="")
		{
      		alert("Please Provide Uom Of Percentage Of Weft Polyester Content");
      		document.getElementById("uom_of_percentage_of_weft_polyester_content").focus();
      		return false;
		}
		else if(document.getElementById("percentage_of_weft_other_fiber_content_tolerance_range_math_op").value.trim()=="")
		{
      		alert("Please Provide Percentage Of Weft Other Fiber Content Tolerance Range Math Op");
      		document.getElementById("percentage_of_weft_other_fiber_content_tolerance_range_math_op").focus();
      		return false;
		}
		else if(document.getElementById("percentage_of_weft_other_fiber_content_tolerance_value").value.trim()=="")
		{
      		alert("Please Provide Percentage Of Weft Other Fiber Content Tolerance Value");
      		document.getElementById("percentage_of_weft_other_fiber_content_tolerance_value").focus();
      		return false;
		}
		else if(isNaN(document.getElementById("percentage_of_weft_other_fiber_content_tolerance_value").value.trim()))
		{
      		alert("Percentage Of Weft Other Fiber Content Tolerance Value should be Numeric");
			document.getElementById("percentage_of_weft_other_fiber_content_tolerance_value").value="";
      		document.getElementById("percentage_of_weft_other_fiber_content_tolerance_value").focus();
      		return false;
		}
		else if(document.getElementById("percentage_of_weft_other_fiber_content_min_value").value.trim()=="")
		{
      		alert("Please Provide Percentage Of Weft Other Fiber Content Min Value");
      		document.getElementById("percentage_of_weft_other_fiber_content_min_value").focus();
      		return false;
		}
		else if(isNaN(document.getElementById("percentage_of_weft_other_fiber_content_min_value").value.trim()))
		{
      		alert("Percentage Of Weft Other Fiber Content Min Value should be Numeric");
			document.getElementById("percentage_of_weft_other_fiber_content_min_value").value="";
      		document.getElementById("percentage_of_weft_other_fiber_content_min_value").focus();
      		return false;
		}
		else if(document.getElementById("percentage_of_weft_other_fiber_content_max_value").value.trim()=="")
		{
      		alert("Please Provide Percentage Of Weft Other Fiber Content Max Value");
      		document.getElementById("percentage_of_weft_other_fiber_content_max_value").focus();
      		return false;
		}
		else if(isNaN(document.getElementById("percentage_of_weft_other_fiber_content_max_value").value.trim()))
		{
      		alert("Percentage Of Weft Other Fiber Content Max Value should be Numeric");
			document.getElementById("percentage_of_weft_other_fiber_content_max_value").value="";
      		document.getElementById("percentage_of_weft_other_fiber_content_max_value").focus();
      		return false;
		}
		else if(document.getElementById("uom_of_percentage_of_weft_other_fiber_content").value.trim()=="")
		{
      		alert("Please Provide Uom Of Percentage Of Weft Other Fiber Content");
      		document.getElementById("uom_of_percentage_of_weft_other_fiber_content").focus();
      		return false;
		}
		else if(document.getElementById("seam_slippage_resistance_in_warp_tolerance_range_math_operator").value.trim()=="")
		{
      		alert("Please Provide Seam Slippage Resistance In Warp Tolerance Range Math Operator");
      		document.getElementById("seam_slippage_resistance_in_warp_tolerance_range_math_operator").focus();
      		return false;
		}
		else if(document.getElementById("seam_slippage_resistance_in_warp_tolerance_value").value.trim()=="")
		{
      		alert("Please Provide Seam Slippage Resistance In Warp Tolerance Value");
      		document.getElementById("seam_slippage_resistance_in_warp_tolerance_value").focus();
      		return false;
		}
		else if(isNaN(document.getElementById("seam_slippage_resistance_in_warp_tolerance_value").value.trim()))
		{
      		alert("Seam Slippage Resistance In Warp Tolerance Value should be Numeric");
			document.getElementById("seam_slippage_resistance_in_warp_tolerance_value").value="";
      		document.getElementById("seam_slippage_resistance_in_warp_tolerance_value").focus();
      		return false;
		}
		else if(document.getElementById("seam_slippage_resistance_in_warp_min_value").value.trim()=="")
		{
      		alert("Please Provide Seam Slippage Resistance In Warp Min Value");
      		document.getElementById("seam_slippage_resistance_in_warp_min_value").focus();
      		return false;
		}
		else if(isNaN(document.getElementById("seam_slippage_resistance_in_warp_min_value").value.trim()))
		{
      		alert("Seam Slippage Resistance In Warp Min Value should be Numeric");
			document.getElementById("seam_slippage_resistance_in_warp_min_value").value="";
      		document.getElementById("seam_slippage_resistance_in_warp_min_value").focus();
      		return false;
		}
		else if(document.getElementById("seam_slippage_resistance_in_warp_max_value").value.trim()=="")
		{
      		alert("Please Provide Seam Slippage Resistance In Warp Max Value");
      		document.getElementById("seam_slippage_resistance_in_warp_max_value").focus();
      		return false;
		}
		else if(isNaN(document.getElementById("seam_slippage_resistance_in_warp_max_value").value.trim()))
		{
      		alert("Seam Slippage Resistance In Warp Max Value should be Numeric");
			document.getElementById("seam_slippage_resistance_in_warp_max_value").value="";
      		document.getElementById("seam_slippage_resistance_in_warp_max_value").focus();
      		return false;
		}
		else if(document.getElementById("uom_of_seam_slippage_resistance_in_warp").value.trim()=="")
		{
      		alert("Please Provide Uom Of Seam Slippage Resistance In Warp");
      		document.getElementById("uom_of_seam_slippage_resistance_in_warp").focus();
      		return false;
		}
		else if(document.getElementById("seam_slippage_resistance_in_weft_tolerance_range_math_operator").value.trim()=="")
		{
      		alert("Please Provide Seam Slippage Resistance In Weft Tolerance Range Math Operator");
      		document.getElementById("seam_slippage_resistance_in_weft_tolerance_range_math_operator").focus();
      		return false;
		}
		else if(document.getElementById("seam_slippage_resistance_in_weft_tolerance_value").value.trim()=="")
		{
      		alert("Please Provide Seam Slippage Resistance In Weft Tolerance Value");
      		document.getElementById("seam_slippage_resistance_in_weft_tolerance_value").focus();
      		return false;
		}
		else if(isNaN(document.getElementById("seam_slippage_resistance_in_weft_tolerance_value").value.trim()))
		{
      		alert("Seam Slippage Resistance In Weft Tolerance Value should be Numeric");
			document.getElementById("seam_slippage_resistance_in_weft_tolerance_value").value="";
      		document.getElementById("seam_slippage_resistance_in_weft_tolerance_value").focus();
      		return false;
		}
		else if(document.getElementById("seam_slippage_resistance_in_weft_min_value").value.trim()=="")
		{
      		alert("Please Provide Seam Slippage Resistance In Weft Min Value");
      		document.getElementById("seam_slippage_resistance_in_weft_min_value").focus();
      		return false;
		}
		else if(isNaN(document.getElementById("seam_slippage_resistance_in_weft_min_value").value.trim()))
		{
      		alert("Seam Slippage Resistance In Weft Min Value should be Numeric");
			document.getElementById("seam_slippage_resistance_in_weft_min_value").value="";
      		document.getElementById("seam_slippage_resistance_in_weft_min_value").focus();
      		return false;
		}
		else if(document.getElementById("seam_slippage_resistance_in_weft_max_value").value.trim()=="")
		{
      		alert("Please Provide Seam Slippage Resistance In Weft Max Value");
      		document.getElementById("seam_slippage_resistance_in_weft_max_value").focus();
      		return false;
		}
		else if(isNaN(document.getElementById("seam_slippage_resistance_in_weft_max_value").value.trim()))
		{
      		alert("Seam Slippage Resistance In Weft Max Value should be Numeric");
			document.getElementById("seam_slippage_resistance_in_weft_max_value").value="";
      		document.getElementById("seam_slippage_resistance_in_weft_max_value").focus();
      		return false;
		}
		else if(document.getElementById("uom_of_seam_slippage_resistance_in_weft").value.trim()=="")
		{
      		alert("Please Provide Uom Of Seam Slippage Resistance In Weft");
      		document.getElementById("uom_of_seam_slippage_resistance_in_weft").focus();
      		return false;
		}
		else if(document.getElementById("ph_value_tolerance_range_math_operator").value.trim()=="")
		{
      		alert("Please Provide Ph Value Tolerance Range Math Operator");
      		document.getElementById("ph_value_tolerance_range_math_operator").focus();
      		return false;
		}
		else if(document.getElementById("ph_value_tolerance_value").value.trim()=="")
		{
      		alert("Please Provide Ph Value Tolerance Value");
      		document.getElementById("ph_value_tolerance_value").focus();
      		return false;
		}
		else if(isNaN(document.getElementById("ph_value_tolerance_value").value.trim()))
		{
      		alert("Ph Value Tolerance Value should be Numeric");
			document.getElementById("ph_value_tolerance_value").value="";
      		document.getElementById("ph_value_tolerance_value").focus();
      		return false;
		}
		else if(document.getElementById("ph_value_min_value").value.trim()=="")
		{
      		alert("Please Provide Ph Value Min Value");
      		document.getElementById("ph_value_min_value").focus();
      		return false;
		}
		else if(isNaN(document.getElementById("ph_value_min_value").value.trim()))
		{
      		alert("Ph Value Min Value should be Numeric");
			document.getElementById("ph_value_min_value").value="";
      		document.getElementById("ph_value_min_value").focus();
      		return false;
		}
		else if(document.getElementById("ph_value_max_value").value.trim()=="")
		{
      		alert("Please Provide Ph Value Max Value");
      		document.getElementById("ph_value_max_value").focus();
      		return false;
		}
		else if(isNaN(document.getElementById("ph_value_max_value").value.trim()))
		{
      		alert("Ph Value Max Value should be Numeric");
			document.getElementById("ph_value_max_value").value="";
      		document.getElementById("ph_value_max_value").focus();
      		return false;
		}
		else if(document.getElementById("uom_of_ph_value").value.trim()=="")
		{
      		alert("Please Provide Uom Of Ph Value");
      		document.getElementById("uom_of_ph_value").focus();
      		return false;
		}*/
}
