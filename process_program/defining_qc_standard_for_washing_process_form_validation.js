function Washing_Form_Validation()
{
		if(document.getElementById("pp_number_value").value.trim()=="")
		{
      		alert("Please Provide Pp Number");
      		document.getElementById("pp_number_value").focus();
      		return false;
		}
		else if(document.getElementById("version_number").value.trim()=="")
		{
      		alert("Please Provide Version Number");
      		document.getElementById("version_number").focus();
      		return false;
		}
		else if(document.getElementById("customer_name").value.trim()=="")
		{
      		alert("Please Provide Customer Name");
      		document.getElementById("customer_name").focus();
      		return false;
		}
		else if(document.getElementById("color_name").value.trim()=="")
		{
      		alert("Please Provide Color");
      		document.getElementById("color_name").focus();
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
		else if(document.getElementById("cf_to_surface_wetting_staining_tolerance_range_math_operator").value.trim()=="")
		{
      		alert("Please Provide Cf To Surface Wetting Staining Tolerance Range Math Operator");
      		document.getElementById("cf_to_surface_wetting_staining_tolerance_range_math_operator").focus();
      		return false;
		}
		else if(document.getElementById("cf_to_surface_wetting_staining_tolerance_value").value.trim()=="")
		{
      		alert("Please Provide Cf To Surface Wetting Staining Tolerance Value");
      		document.getElementById("cf_to_surface_wetting_staining_tolerance_value").focus();
      		return false;
		}
		else if(isNaN(document.getElementById("cf_to_surface_wetting_staining_tolerance_value").value.trim()))
		{
      		alert("Cf To Surface Wetting Staining Tolerance Value should be Numeric");
			document.getElementById("cf_to_surface_wetting_staining_tolerance_value").value="";
      		document.getElementById("cf_to_surface_wetting_staining_tolerance_value").focus();
      		return false;
		}
		else if(document.getElementById("cf_to_surface_wetting_staining_min_value").value.trim()=="")
		{
      		alert("Please Provide Cf To Surface Wetting Staining Min Value");
      		document.getElementById("cf_to_surface_wetting_staining_min_value").focus();
      		return false;
		}
		else if(isNaN(document.getElementById("cf_to_surface_wetting_staining_min_value").value.trim()))
		{
      		alert("Cf To Surface Wetting Staining Min Value should be Numeric");
			document.getElementById("cf_to_surface_wetting_staining_min_value").value="";
      		document.getElementById("cf_to_surface_wetting_staining_min_value").focus();
      		return false;
		}
		else if(document.getElementById("cf_to_surface_wetting_staining_max_value").value.trim()=="")
		{
      		alert("Please Provide Cf To Surface Wetting Staining Max Value");
      		document.getElementById("cf_to_surface_wetting_staining_max_value").focus();
      		return false;
		}
		else if(isNaN(document.getElementById("cf_to_surface_wetting_staining_max_value").value.trim()))
		{
      		alert("Cf To Surface Wetting Staining Max Value should be Numeric");
			document.getElementById("cf_to_surface_wetting_staining_max_value").value="";
      		document.getElementById("cf_to_surface_wetting_staining_max_value").focus();
      		return false;
		}
		else if(document.getElementById("uom_of_cf_to_surface_wetting_staining").value.trim()=="")
		{
      		alert("Please Provide Uom Of Cf To Surface Wetting Staining");
      		document.getElementById("uom_of_cf_to_surface_wetting_staining").focus();
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
