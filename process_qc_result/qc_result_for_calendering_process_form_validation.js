function Calendering_Form_Validation()
{
		if(document.getElementById("pp_number").value=="select")
		{
      		alert("Please Select PP Number");
      		document.getElementById("pp_number").focus();
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
      		alert("Please Provide Greige Width");
      		document.getElementById("finish_width_in_inch").focus();
      		return false;
		}
		else if(isNaN(document.getElementById("finish_width_in_inch").value.trim()))
		{
      		alert("Greige Width should be Numeric");
			document.getElementById("finish_width_in_inch").value="";
      		document.getElementById("finish_width_in_inch").focus();
      		return false;
		}*/
		/*else if(document.getElementById("standard_for_which_process").value.trim()=="")
		{
      		alert("Please Provide Standard For Which Process");
      		document.getElementById("standard_for_which_process").focus();
      		return false;
		}*/
		// else if(document.getElementById("date").value.trim()=="")
		// {
      	// 	alert("Please Provide Date");
      	// 	document.getElementById("date").focus();
      	// 	return false;
		// }
		/*else if(document.getElementById("before_trolley_number_or_batcher_number").value.trim()=="")
		{
      		alert("Please Provide Before Trolley Number Or Batcher Number");
      		document.getElementById("before_trolley_number_or_batcher_number").focus();
      		return false;
		}
		else if(isNaN(document.getElementById("before_trolley_number_or_batcher_number").value.trim()))
		{
      		alert("Before Trolley Number Or Batcher Number should be Numeric");
			document.getElementById("before_trolley_number_or_batcher_number").value="";
      		document.getElementById("before_trolley_number_or_batcher_number").focus();
      		return false;
		}
		else if(document.getElementById("after_trolley_number_or_batcher_number").value.trim()=="")
		{
      		alert("Please Provide After Trolley Number Or Batcher Number");
      		document.getElementById("after_trolley_number_or_batcher_number").focus();
      		return false;
		}
		else if(isNaN(document.getElementById("after_trolley_number_or_batcher_number").value.trim()))
		{
      		alert("After Trolley Number Or Batcher Number should be Numeric");
			document.getElementById("after_trolley_number_or_batcher_number").value="";
      		document.getElementById("after_trolley_number_or_batcher_number").focus();
      		return false;
		}*/
		/*else if(document.getElementById("before_fabric_width_in_inch").value.trim()=="")
		{
      		alert("Please Provide Before Fabric Width In Inch");
      		document.getElementById("before_fabric_width_in_inch").focus();
      		return false;
		}
		else if(isNaN(document.getElementById("before_fabric_width_in_inch").value.trim()))
		{
      		alert("Before Fabric Width In Inch should be Numeric");
			document.getElementById("before_fabric_width_in_inch").value="";
      		document.getElementById("before_fabric_width_in_inch").focus();
      		return false;
		}
		else if(document.getElementById("process_fabrice_width_inch").value.trim()=="")
		{
      		alert("Please Provide Process Fabrice Width Inch");
      		document.getElementById("process_fabrice_width_inch").focus();
      		return false;
		}
		else if(isNaN(document.getElementById("process_fabrice_width_inch").value.trim()))
		{
      		alert("Process Fabrice Width Inch should be Numeric");
			document.getElementById("process_fabrice_width_inch").value="";
      		document.getElementById("process_fabrice_width_inch").focus();
      		return false;
		}
		else if(document.getElementById("received_quantity_in_meter").value.trim()=="")
		{
      		alert("Please Provide Total Program Quantity");
      		document.getElementById("received_quantity_in_meter").focus();
      		return false;
		}
		else if(isNaN(document.getElementById("received_quantity_in_meter").value.trim()))
		{
      		alert("Total Program Quantity should be Numeric");
			document.getElementById("received_quantity_in_meter").value="";
      		document.getElementById("received_quantity_in_meter").focus();
      		return false;
		}
		else if(document.getElementById("short_or_excess_in_percentage").value.trim()=="")
		{
      		alert("Please Provide Short Or Excess In Percentage");
      		document.getElementById("short_or_excess_in_percentage").focus();
      		return false;
		}
		else if(isNaN(document.getElementById("short_or_excess_in_percentage").value.trim()))
		{
      		alert("Short Or Excess In Percentage should be Numeric");
			document.getElementById("short_or_excess_in_percentage").value="";
      		document.getElementById("short_or_excess_in_percentage").focus();
      		return false;
		}
		else if(document.getElementById("trf_number").value.trim()=="")
		{
      		alert("Please Provide Trf Number");
      		document.getElementById("trf_number").focus();
      		return false;
		}
		else if(isNaN(document.getElementById("trf_number").value.trim()))
		{
      		alert("Trf Number should be Numeric");
			document.getElementById("trf_number").value="";
      		document.getElementById("trf_number").focus();
      		return false;
		}
		else if(document.getElementById("total_quantity_in_meter").value.trim()=="")
		{
      		alert("Please Provide Total Quantity In Meter");
      		document.getElementById("total_quantity_in_meter").focus();
      		return false;
		}
		else if(isNaN(document.getElementById("total_quantity_in_meter").value.trim()))
		{
      		alert("Total Quantity In Meter should be Numeric");
			document.getElementById("total_quantity_in_meter").value="";
      		document.getElementById("total_quantity_in_meter").focus();
      		return false;
		}
		else if(document.getElementById("total_short_or_excess_in_percentage").value.trim()=="")
		{
      		alert("Please Provide Total Short Or Excess In Percentage");
      		document.getElementById("total_short_or_excess_in_percentage").focus();
      		return false;
		}
		else if(isNaN(document.getElementById("total_short_or_excess_in_percentage").value.trim()))
		{
      		alert("Total Short Or Excess In Percentage should be Numeric");
			document.getElementById("total_short_or_excess_in_percentage").value="";
      		document.getElementById("total_short_or_excess_in_percentage").focus();
      		return false;
		}
		else if(document.getElementById("machine_name").value.trim()=="")
		{
      		alert("Please Provide Machine Name");
      		document.getElementById("machine_name").focus();
      		return false;
		}*/
		
		/*else if(document.getElementById("color_fastness_to_rubbing_dry_value").value.trim()=="")
		{
      		alert("Please Provide Color Fastness To Rubbing Dry Value");
      		document.getElementById("color_fastness_to_rubbing_dry_value").focus();
      		return false;
		}
		else if(isNaN(document.getElementById("color_fastness_to_rubbing_dry_value").value.trim()))
		{
      		alert("Color Fastness To Rubbing Dry Value should be Numeric");
			document.getElementById("color_fastness_to_rubbing_dry_value").value="";
      		document.getElementById("color_fastness_to_rubbing_dry_value").focus();
      		return false;
		}
		else if(document.getElementById("uom_of_color_fastness_to_rubbing_dry_value").value.trim()=="")
		{
      		alert("Please Provide Uom Of Color Fastness To Rubbing Dry Value");
      		document.getElementById("uom_of_color_fastness_to_rubbing_dry_value").focus();
      		return false;
		}
		else if(document.getElementById("color_fastness_to_rubbing_wet_value").value.trim()=="")
		{
      		alert("Please Provide Color Fastness To Rubbing Wet Value");
      		document.getElementById("color_fastness_to_rubbing_wet_value").focus();
      		return false;
		}
		else if(isNaN(document.getElementById("color_fastness_to_rubbing_wet_value").value.trim()))
		{
      		alert("Color Fastness To Rubbing Wet Value should be Numeric");
			document.getElementById("color_fastness_to_rubbing_wet_value").value="";
      		document.getElementById("color_fastness_to_rubbing_wet_value").focus();
      		return false;
		}
		else if(document.getElementById("color_fastness_to_rubbing_wet_tolerance_value").value.trim()=="")
		{
      		alert("Please Provide Color Fastness To Rubbing Wet Tolerance Value");
      		document.getElementById("color_fastness_to_rubbing_wet_tolerance_value").focus();
      		return false;
		}
		else if(isNaN(document.getElementById("color_fastness_to_rubbing_wet_tolerance_value").value.trim()))
		{
      		alert("Color Fastness To Rubbing Wet Tolerance Value should be Numeric");
			document.getElementById("color_fastness_to_rubbing_wet_tolerance_value").value="";
      		document.getElementById("color_fastness_to_rubbing_wet_tolerance_value").focus();
      		return false;
		}
		else if(document.getElementById("uom_of_color_fastness_to_rubbing_wet").value.trim()=="")
		{
      		alert("Please Provide Uom Of Color Fastness To Rubbing Wet");
      		document.getElementById("uom_of_color_fastness_to_rubbing_wet").focus();
      		return false;
		}
		else if(document.getElementById("change_in_warp_for_washing_before_iron_value").value.trim()=="")
		{
      		alert("Please Provide Change In Warp For Washing Before Iron Value");
      		document.getElementById("change_in_warp_for_washing_before_iron_value").focus();
      		return false;
		}
		else if(document.getElementById("change_in_weft_for_washing_before_iron_value").value.trim()=="")
		{
      		alert("Please Provide Change In Weft For Washing Before Iron Value");
      		document.getElementById("change_in_weft_for_washing_before_iron_value").focus();
      		return false;
		}
		else if(isNaN(document.getElementById("change_in_weft_for_washing_before_iron_value").value.trim()))
		{
      		alert("Change In Weft For Washing Before Iron Value should be Numeric");
			document.getElementById("change_in_weft_for_washing_before_iron_value").value="";
      		document.getElementById("change_in_weft_for_washing_before_iron_value").focus();
      		return false;
		}
		else if(document.getElementById("uom_of_change_in_weft_for_washing_before_iron").value.trim()=="")
		{
      		alert("Please Provide Uom Of Change In Weft For Washing Before Iron");
      		document.getElementById("uom_of_change_in_weft_for_washing_before_iron").focus();
      		return false;
		}
		else if(document.getElementById("change_in_warp_for_washing_after_iron_value").value.trim()=="")
		{
      		alert("Please Provide Change In Warp For Washing After Iron Value");
      		document.getElementById("change_in_warp_for_washing_after_iron_value").focus();
      		return false;
		}
		else if(isNaN(document.getElementById("change_in_warp_for_washing_after_iron_value").value.trim()))
		{
      		alert("Change In Warp For Washing After Iron Value should be Numeric");
			document.getElementById("change_in_warp_for_washing_after_iron_value").value="";
      		document.getElementById("change_in_warp_for_washing_after_iron_value").focus();
      		return false;
		}
		else if(document.getElementById("uom_of_change_in_warp_for_washing_after_iron").value.trim()=="")
		{
      		alert("Please Provide Uom Of Change In Warp For Washing After Iron");
      		document.getElementById("uom_of_change_in_warp_for_washing_after_iron").focus();
      		return false;
		}
		else if(document.getElementById("change_in_weft_for_washing_after_iron_value").value.trim()=="")
		{
      		alert("Please Provide Change In Weft For Washing After Iron Value");
      		document.getElementById("change_in_weft_for_washing_after_iron_value").focus();
      		return false;
		}
		else if(isNaN(document.getElementById("change_in_weft_for_washing_after_iron_value").value.trim()))
		{
      		alert("Change In Weft For Washing After Iron Value should be Numeric");
			document.getElementById("change_in_weft_for_washing_after_iron_value").value="";
      		document.getElementById("change_in_weft_for_washing_after_iron_value").focus();
      		return false;
		}
		else if(document.getElementById("uom_of_change_in_weft_for_washing_after_iron").value.trim()=="")
		{
      		alert("Please Provide Uom Of Change In Weft For Washing After Iron");
      		document.getElementById("uom_of_change_in_weft_for_washing_after_iron").focus();
      		return false;
		}
		else if(document.getElementById("change_in_weft_for_washing_afer_iron_min_value").value.trim()=="")
		{
      		alert("Please Provide Change In Weft For Washing Afer Iron Min Value");
      		document.getElementById("change_in_weft_for_washing_afer_iron_min_value").focus();
      		return false;
		}
		else if(isNaN(document.getElementById("change_in_weft_for_washing_afer_iron_min_value").value.trim()))
		{
      		alert("Change In Weft For Washing Afer Iron Min Value should be Numeric");
			document.getElementById("change_in_weft_for_washing_afer_iron_min_value").value="";
      		document.getElementById("change_in_weft_for_washing_afer_iron_min_value").focus();
      		return false;
		}
		else if(document.getElementById("uom_of_change_in_weft_for_washing_afer_iron").value.trim()=="")
		{
      		alert("Please Provide Uom Of Change In Weft For Washing Afer Iron");
      		document.getElementById("uom_of_change_in_weft_for_washing_afer_iron").focus();
      		return false;
		}
		else if(document.getElementById("change_in_warp_for_dry_cleaning_value").value.trim()=="")
		{
      		alert("Please Provide Change In Warp For Dry Cleaning Value");
      		document.getElementById("change_in_warp_for_dry_cleaning_value").focus();
      		return false;
		}
		else if(isNaN(document.getElementById("change_in_warp_for_dry_cleaning_value").value.trim()))
		{
      		alert("Change In Warp For Dry Cleaning Value should be Numeric");
			document.getElementById("change_in_warp_for_dry_cleaning_value").value="";
      		document.getElementById("change_in_warp_for_dry_cleaning_value").focus();
      		return false;
		}
		else if(document.getElementById("uom_of_change_in_warp_for_dry_cleaning").value.trim()=="")
		{
      		alert("Please Provide Uom Of Change In Warp For Dry Cleaning");
      		document.getElementById("uom_of_change_in_warp_for_dry_cleaning").focus();
      		return false;
		}
		else if(document.getElementById("change_in_weft_for_dry_cleaning_value").value.trim()=="")
		{
      		alert("Please Provide Change In Weft For Dry Cleaning Value");
      		document.getElementById("change_in_weft_for_dry_cleaning_value").focus();
      		return false;
		}
		else if(isNaN(document.getElementById("change_in_weft_for_dry_cleaning_value").value.trim()))
		{
      		alert("Change In Weft For Dry Cleaning Value should be Numeric");
			document.getElementById("change_in_weft_for_dry_cleaning_value").value="";
      		document.getElementById("change_in_weft_for_dry_cleaning_value").focus();
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
		else if(document.getElementById("uom_of_warp_yarn_count_properties").value.trim()=="")
		{
      		alert("Please Provide Uom Of Warp Yarn Count Properties");
      		document.getElementById("uom_of_warp_yarn_count_properties").focus();
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
		else if(document.getElementById("uom_of_mass_per_unit_per_area_properties").value.trim()=="")
		{
      		alert("Please Provide Uom Of Mass Per Unit Per Area Properties");
      		document.getElementById("uom_of_mass_per_unit_per_area_properties").focus();
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
		else if(document.getElementById("uom_of_no_of_threads_in_warp_properties").value.trim()=="")
		{
      		alert("Please Provide Uom Of No Of Threads In Warp Properties");
      		document.getElementById("uom_of_no_of_threads_in_warp_properties").focus();
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
		else if(document.getElementById("uom_of_no_of_threads_in_weft_properties").value.trim()=="")
		{
      		alert("Please Provide Uom Of No Of Threads In Weft Properties");
      		document.getElementById("uom_of_no_of_threads_in_weft_properties").focus();
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
		else if(document.getElementById("uom_of_surface_fuzzing_and_pilling").value.trim()=="")
		{
      		alert("Please Provide Uom Of Surface Fuzzing And Pilling");
      		document.getElementById("uom_of_surface_fuzzing_and_pilling").focus();
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
		else if(document.getElementById("uom_of_warp_yarn_tensile_properties").value.trim()=="")
		{
      		alert("Please Provide Uom Of Warp Yarn Tensile Properties");
      		document.getElementById("uom_of_warp_yarn_tensile_properties").focus();
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
		else if(document.getElementById("uom_of_warp_yarn_tear_force_properties").value.trim()=="")
		{
      		alert("Please Provide Uom Of Warp Yarn Tear Force Properties");
      		document.getElementById("uom_of_warp_yarn_tear_force_properties").focus();
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
		else if(document.getElementById("uom_of_weft_yarn_tear_force_properties").value.trim()=="")
		{
      		alert("Please Provide Uom Of Weft Yarn Tear Force Properties");
      		document.getElementById("uom_of_weft_yarn_tear_force_properties").focus();
      		return false;
		}
		else if(document.getElementById("warp_yarn_seam_tolerence_value").value.trim()=="")
		{
      		alert("Please Provide Warp Yarn Seam Tolerence Value");
      		document.getElementById("warp_yarn_seam_tolerence_value").focus();
      		return false;
		}
		else if(isNaN(document.getElementById("warp_yarn_seam_tolerence_value").value.trim()))
		{
      		alert("Warp Yarn Seam Tolerence Value should be Numeric");
			document.getElementById("warp_yarn_seam_tolerence_value").value="";
      		document.getElementById("warp_yarn_seam_tolerence_value").focus();
      		return false;
		}
		else if(document.getElementById("uom_of_warp_yarn_seam").value.trim()=="")
		{
      		alert("Please Provide Uom Of Warp Yarn Seam");
      		document.getElementById("uom_of_warp_yarn_seam").focus();
      		return false;
		}
		else if(document.getElementById("weft_yarn_seam_tolerence_value").value.trim()=="")
		{
      		alert("Please Provide Weft Yarn Seam Tolerence Value");
      		document.getElementById("weft_yarn_seam_tolerence_value").focus();
      		return false;
		}
		else if(isNaN(document.getElementById("weft_yarn_seam_tolerence_value").value.trim()))
		{
      		alert("Weft Yarn Seam Tolerence Value should be Numeric");
			document.getElementById("weft_yarn_seam_tolerence_value").value="";
      		document.getElementById("weft_yarn_seam_tolerence_value").focus();
      		return false;
		}
		else if(document.getElementById("uom_of_weft_yarn_seam_properties").value.trim()=="")
		{
      		alert("Please Provide Uom Of Weft Yarn Seam Properties");
      		document.getElementById("uom_of_weft_yarn_seam_properties").focus();
      		return false;
		}
		else if(document.getElementById("seam_slippage_resistance_in_warp_tolerence_value").value.trim()=="")
		{
      		alert("Please Provide Seam Slippage Resistance In Warp Tolerence Value");
      		document.getElementById("seam_slippage_resistance_in_warp_tolerence_value").focus();
      		return false;
		}
		else if(isNaN(document.getElementById("seam_slippage_resistance_in_warp_tolerence_value").value.trim()))
		{
      		alert("Seam Slippage Resistance In Warp Tolerence Value should be Numeric");
			document.getElementById("seam_slippage_resistance_in_warp_tolerence_value").value="";
      		document.getElementById("seam_slippage_resistance_in_warp_tolerence_value").focus();
      		return false;
		}
		else if(document.getElementById("uom_of_seam_slippage_resistance_in_warp_properties").value.trim()=="")
		{
      		alert("Please Provide Uom Of Seam Slippage Resistance In Warp Properties");
      		document.getElementById("uom_of_seam_slippage_resistance_in_warp_properties").focus();
      		return false;
		}
		else if(document.getElementById("seam_slippage_resistance_in_weft_tolerence_value").value.trim()=="")
		{
      		alert("Please Provide Seam Slippage Resistance In Weft Tolerence Value");
      		document.getElementById("seam_slippage_resistance_in_weft_tolerence_value").focus();
      		return false;
		}
		else if(isNaN(document.getElementById("seam_slippage_resistance_in_weft_tolerence_value").value.trim()))
		{
      		alert("Seam Slippage Resistance In Weft Tolerence Value should be Numeric");
			document.getElementById("seam_slippage_resistance_in_weft_tolerence_value").value="";
      		document.getElementById("seam_slippage_resistance_in_weft_tolerence_value").focus();
      		return false;
		}
		else if(document.getElementById("uom_of_seam_slippage_resistance_in_weft").value.trim()=="")
		{
      		alert("Please Provide Uom Of Seam Slippage Resistance In Weft");
      		document.getElementById("uom_of_seam_slippage_resistance_in_weft").focus();
      		return false;
		}
		else if(document.getElementById("seam_slippage_resistance_in_warp_mm_tolerance_value").value.trim()=="")
		{
      		alert("Please Provide Seam Slippage Resistance In Warp Mm Tolerance Value");
      		document.getElementById("seam_slippage_resistance_in_warp_mm_tolerance_value").focus();
      		return false;
		}
		else if(isNaN(document.getElementById("seam_slippage_resistance_in_warp_mm_tolerance_value").value.trim()))
		{
      		alert("Seam Slippage Resistance In Warp Mm Tolerance Value should be Numeric");
			document.getElementById("seam_slippage_resistance_in_warp_mm_tolerance_value").value="";
      		document.getElementById("seam_slippage_resistance_in_warp_mm_tolerance_value").focus();
      		return false;
		}
		else if(document.getElementById("uom_of_seam_slippage_resistance_in_warp_mm").value.trim()=="")
		{
      		alert("Please Provide Uom Of Seam Slippage Resistance In Warp Mm");
      		document.getElementById("uom_of_seam_slippage_resistance_in_warp_mm").focus();
      		return false;
		}
		else if(document.getElementById("seam_slippage_resistance_in_weft_mm_tolerence_value").value.trim()=="")
		{
      		alert("Please Provide Seam Slippage Resistance In Weft Mm Tolerence Value");
      		document.getElementById("seam_slippage_resistance_in_weft_mm_tolerence_value").focus();
      		return false;
		}
		else if(isNaN(document.getElementById("seam_slippage_resistance_in_weft_mm_tolerence_value").value.trim()))
		{
      		alert("Seam Slippage Resistance In Weft Mm Tolerence Value should be Numeric");
			document.getElementById("seam_slippage_resistance_in_weft_mm_tolerence_value").value="";
      		document.getElementById("seam_slippage_resistance_in_weft_mm_tolerence_value").focus();
      		return false;
		}
		else if(document.getElementById("uom_of_seam_slippage_resistance_in_weft_mm_properties").value.trim()=="")
		{
      		alert("Please Provide Uom Of Seam Slippage Resistance In Weft Mm Properties");
      		document.getElementById("uom_of_seam_slippage_resistance_in_weft_mm_properties").focus();
      		return false;
		}*/
		var radio_btn_hand_feel = document.getElementsByName('hand_feel');
	    var ischecked = false;
	    for ( var i = 0; i < radio_btn_hand_feel.length; i++) 
	    {
	        if(radio_btn_hand_feel[i].checked)  
	        {
	            ischecked = true;
	        }
	    }
	    if(!ischecked)
	    {
	          alert("Please Select Hand Feel");
	          document.getElementById("hand_feel").focus();
	          return false;
	    }
		var radio_btn_status = document.getElementsByName('status');
		var ischecked = false;
		for ( var i = 0; i < radio_btn_status.length; i++) 
		{
				if(radio_btn_status[i].checked)  
				{
						ischecked = true;
				}
		}
		if(!ischecked)
		{
      		alert("Please Select Status");
      		document.getElementById("status").focus();
      		return false;
		}
		else if(document.getElementById("remarks").value.trim()=="")
		{
      		alert("Please Provide Remarks");
      		document.getElementById("remarks").focus();
      		return false;
		}
}
