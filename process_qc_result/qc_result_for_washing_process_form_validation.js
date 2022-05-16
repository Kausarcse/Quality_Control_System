function Washing_Form_Validation()
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
		/*
		else if(document.getElementById("customer_name").value.trim()=="")
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
		}
		else if(document.getElementById("standard_for_which_process").value.trim()=="")
		{
      		alert("Please Provide Standard For Which Process");
      		document.getElementById("standard_for_which_process").focus();
      		return false;
		}*/
		// else if(document.getElementById("date").value.trim()=="")
		// {
  //     		alert("Please Provide Date");
  //     		document.getElementById("date").focus();
  //     		return false;
		// }
		// else if(document.getElementById("before_trolley_number_or_batcher_number").value.trim()=="")
		// {
  //     		alert("Please Provide Before Trolley Number Or Batcher Number");
  //     		document.getElementById("before_trolley_number_or_batcher_number").focus();
  //     		return false;
		// }
		// else if(isNaN(document.getElementById("before_trolley_number_or_batcher_number").value.trim()))
		// {
  //     		alert("Before Trolley Number Or Batcher Number should be Numeric");
		// 	document.getElementById("before_trolley_number_or_batcher_number").value="";
  //     		document.getElementById("before_trolley_number_or_batcher_number").focus();
  //     		return false;
		// }
		// else if(document.getElementById("after_trolley_number_or_batcher_number").value.trim()=="")
		// {
  //     		alert("Please Provide After Trolley Number Or Batcher Number");
  //     		document.getElementById("after_trolley_number_or_batcher_number").focus();
  //     		return false;
		// }
		// else if(isNaN(document.getElementById("after_trolley_number_or_batcher_number").value.trim()))
		// {
  //     		alert("After Trolley Number Or Batcher Number should be Numeric");
		// 	document.getElementById("after_trolley_number_or_batcher_number").value="";
  //     		document.getElementById("after_trolley_number_or_batcher_number").focus();
  //     		return false;
		// }
		// else if(document.getElementById("trf_number").value.trim()=="")
		// {
  //     		alert("Please Provide Trf Number");
  //     		document.getElementById("trf_number").focus();
  //     		return false;
		// }
		// else if(isNaN(document.getElementById("trf_number").value.trim()))
		// {
  //     		alert("Trf Number should be Numeric");
		// 	document.getElementById("trf_number").value="";
  //     		document.getElementById("trf_number").focus();
  //     		return false;
		// }
		// else if(document.getElementById("process_fabric_width_inch").value.trim()=="")
		// {
  //     		alert("Please Provide Process Fabric Width Inch");
  //     		document.getElementById("process_fabric_width_inch").focus();
  //     		return false;
		// }
		// else if(isNaN(document.getElementById("process_fabric_width_inch").value.trim()))
		// {
  //     		alert("Process Fabric Width Inch should be Numeric");
		// 	document.getElementById("process_fabric_width_inch").value="";
  //     		document.getElementById("process_fabric_width_inch").focus();
  //     		return false;
		// }
		// else if(document.getElementById("process_qty").value.trim()=="")
		// {
  //     		alert("Please Provide Process Qty");
  //     		document.getElementById("process_qty").focus();
  //     		return false;
		// }
		// else if(isNaN(document.getElementById("process_qty").value.trim()))
		// {
  //     		alert("Process Qty should be Numeric");
		// 	document.getElementById("process_qty").value="";
  //     		document.getElementById("process_qty").focus();
  //     		return false;
		// }
		// else if(document.getElementById("short_or_excess_in_percentage").value.trim()=="")
		// {
  //     		alert("Please Provide Short Or Excess In Percentage");
  //     		document.getElementById("short_or_excess_in_percentage").focus();
  //     		return false;
		// }
		// else if(isNaN(document.getElementById("short_or_excess_in_percentage").value.trim()))
		// {
  //     		alert("Short Or Excess In Percentage should be Numeric");
		// 	document.getElementById("short_or_excess_in_percentage").value="";
  //     		document.getElementById("short_or_excess_in_percentage").focus();
  //     		return false;
		// }
		// else if(document.getElementById("total_quantity_in_meter").value.trim()=="")
		// {
  //     		alert("Please Provide Total Quantity In Meter");
  //     		document.getElementById("total_quantity_in_meter").focus();
  //     		return false;
		// }
		// else if(isNaN(document.getElementById("total_quantity_in_meter").value.trim()))
		// {
  //     		alert("Total Quantity In Meter should be Numeric");
		// 	document.getElementById("total_quantity_in_meter").value="";
  //     		document.getElementById("total_quantity_in_meter").focus();
  //     		return false;
		// }
		// // else if(document.getElementById("total_short_or_excess_in_percentage").value.trim()=="")
		// // {
  // //     		alert("Please Provide Total Short Or Excess In Percentage");
  // //     		document.getElementById("total_short_or_excess_in_percentage").focus();
  // //     		return false;
		// // }
		// // else if(isNaN(document.getElementById("total_short_or_excess_in_percentage").value.trim()))
		// // {
  // //     		alert("Total Short Or Excess In Percentage should be Numeric");
		// // 	document.getElementById("total_short_or_excess_in_percentage").value="";
  // //     		document.getElementById("total_short_or_excess_in_percentage").focus();
  // //     		return false;
		// // }
		// else if(document.getElementById("machine_name").value.trim()=="")
		// {
  //     		alert("Please Provide Machine Name");
  //     		document.getElementById("machine_name").focus();
  //     		return false;
		// }
		// else if(isNaN(document.getElementById("machine_name").value.trim()))
		// {
  //     		alert("Machine Name should be Numeric");
		// 	document.getElementById("machine_name").value="";
  //     		document.getElementById("machine_name").focus();
  //     		return false;
		// }
		// else if(document.getElementById("cf_to_rubbing_dry_tolerance_value").value.trim()=="")
		// {
  //     		alert("Please Provide Cf To Rubbing Dry Tolerance Value");
  //     		document.getElementById("cf_to_rubbing_dry_tolerance_value").focus();
  //     		return false;
		// }
		// else if(isNaN(document.getElementById("cf_to_rubbing_dry_tolerance_value").value.trim()))
		// {
  //     		alert("Cf To Rubbing Dry Tolerance Value should be Numeric");
		// 	document.getElementById("cf_to_rubbing_dry_tolerance_value").value="";
  //     		document.getElementById("cf_to_rubbing_dry_tolerance_value").focus();
  //     		return false;
		// }
		// else if(document.getElementById("uom_of_cf_to_rubbing_dry").value.trim()=="")
		// {
  //     		alert("Please Provide Uom Of Cf To Rubbing Dry");
  //     		document.getElementById("uom_of_cf_to_rubbing_dry").focus();
  //     		return false;
		// }
		// else if(document.getElementById("cf_to_rubbing_wet_tolerance_value").value.trim()=="")
		// {
  //     		alert("Please Provide Cf To Rubbing Wet Tolerance Value");
  //     		document.getElementById("cf_to_rubbing_wet_tolerance_value").focus();
  //     		return false;
		// }
		// else if(isNaN(document.getElementById("cf_to_rubbing_wet_tolerance_value").value.trim()))
		// {
  //     		alert("Cf To Rubbing Wet Tolerance Value should be Numeric");
		// 	document.getElementById("cf_to_rubbing_wet_tolerance_value").value="";
  //     		document.getElementById("cf_to_rubbing_wet_tolerance_value").focus();
  //     		return false;
		// }
		// else if(document.getElementById("uom_of_cf_to_rubbing_wet").value.trim()=="")
		// {
  //     		alert("Please Provide Uom Of Cf To Rubbing Wet");
  //     		document.getElementById("uom_of_cf_to_rubbing_wet").focus();
  //     		return false;
		// }
		// else if(document.getElementById("cf_to_dry_cleaning_color_change_tolerance_value").value.trim()=="")
		// {
  //     		alert("Please Provide Cf To Dry Cleaning Color Change Tolerance Value");
  //     		document.getElementById("cf_to_dry_cleaning_color_change_tolerance_value").focus();
  //     		return false;
		// }
		// else if(isNaN(document.getElementById("cf_to_dry_cleaning_color_change_tolerance_value").value.trim()))
		// {
  //     		alert("Cf To Dry Cleaning Color Change Tolerance Value should be Numeric");
		// 	document.getElementById("cf_to_dry_cleaning_color_change_tolerance_value").value="";
  //     		document.getElementById("cf_to_dry_cleaning_color_change_tolerance_value").focus();
  //     		return false;
		// }
		// else if(document.getElementById("uom_of_cf_to_dry_cleaning_color_change").value.trim()=="")
		// {
  //     		alert("Please Provide Uom Of Cf To Dry Cleaning Color Change");
  //     		document.getElementById("uom_of_cf_to_dry_cleaning_color_change").focus();
  //     		return false;
		// }
		// else if(document.getElementById("cf_to_dry_cleaning_staining_tolerance_value").value.trim()=="")
		// {
  //     		alert("Please Provide Cf To Dry Cleaning Staining Tolerance Value");
  //     		document.getElementById("cf_to_dry_cleaning_staining_tolerance_value").focus();
  //     		return false;
		// }
		// else if(isNaN(document.getElementById("cf_to_dry_cleaning_staining_tolerance_value").value.trim()))
		// {
  //     		alert("Cf To Dry Cleaning Staining Tolerance Value should be Numeric");
		// 	document.getElementById("cf_to_dry_cleaning_staining_tolerance_value").value="";
  //     		document.getElementById("cf_to_dry_cleaning_staining_tolerance_value").focus();
  //     		return false;
		// }
		// else if(document.getElementById("uom_of_cf_to_dry_cleaning_staining").value.trim()=="")
		// {
  //     		alert("Please Provide Uom Of Cf To Dry Cleaning Staining");
  //     		document.getElementById("uom_of_cf_to_dry_cleaning_staining").focus();
  //     		return false;
		// }
		// else if(document.getElementById("cf_to_washing_color_change_tolerance_value").value.trim()=="")
		// {
  //     		alert("Please Provide Cf To Washing Color Change Tolerance Value");
  //     		document.getElementById("cf_to_washing_color_change_tolerance_value").focus();
  //     		return false;
		// }
		// else if(isNaN(document.getElementById("cf_to_washing_color_change_tolerance_value").value.trim()))
		// {
  //     		alert("Cf To Washing Color Change Tolerance Value should be Numeric");
		// 	document.getElementById("cf_to_washing_color_change_tolerance_value").value="";
  //     		document.getElementById("cf_to_washing_color_change_tolerance_value").focus();
  //     		return false;
		// }
		// else if(document.getElementById("uom_of_cf_to_washing_color_change").value.trim()=="")
		// {
  //     		alert("Please Provide Uom Of Cf To Washing Color Change");
  //     		document.getElementById("uom_of_cf_to_washing_color_change").focus();
  //     		return false;
		// }
		// else if(document.getElementById("cf_to_washing_staining_tolerance_value").value.trim()=="")
		// {
  //     		alert("Please Provide Cf To Washing Staining Tolerance Value");
  //     		document.getElementById("cf_to_washing_staining_tolerance_value").focus();
  //     		return false;
		// }
		// else if(isNaN(document.getElementById("cf_to_washing_staining_tolerance_value").value.trim()))
		// {
  //     		alert("Cf To Washing Staining Tolerance Value should be Numeric");
		// 	document.getElementById("cf_to_washing_staining_tolerance_value").value="";
  //     		document.getElementById("cf_to_washing_staining_tolerance_value").focus();
  //     		return false;
		// }
		// else if(document.getElementById("uom_of_cf_to_washing_staining").value.trim()=="")
		// {
  //     		alert("Please Provide Uom Of Cf To Washing Staining");
  //     		document.getElementById("uom_of_cf_to_washing_staining").focus();
  //     		return false;
		// }
		// else if(document.getElementById("cf_to_perspiration_acid_color_change_tolerance_value").value.trim()=="")
		// {
  //     		alert("Please Provide Cf To Perspiration Acid Color Change Tolerance Value");
  //     		document.getElementById("cf_to_perspiration_acid_color_change_tolerance_value").focus();
  //     		return false;
		// }
		// else if(isNaN(document.getElementById("cf_to_perspiration_acid_color_change_tolerance_value").value.trim()))
		// {
  //     		alert("Cf To Perspiration Acid Color Change Tolerance Value should be Numeric");
		// 	document.getElementById("cf_to_perspiration_acid_color_change_tolerance_value").value="";
  //     		document.getElementById("cf_to_perspiration_acid_color_change_tolerance_value").focus();
  //     		return false;
		// }
		// else if(document.getElementById("uom_of_cf_to_perspiration_acid_color_change").value.trim()=="")
		// {
  //     		alert("Please Provide Uom Of Cf To Perspiration Acid Color Change");
  //     		document.getElementById("uom_of_cf_to_perspiration_acid_color_change").focus();
  //     		return false;
		// }
		// else if(document.getElementById("cf_to_perspiration_acid_staining_value").value.trim()=="")
		// {
  //     		alert("Please Provide Cf To Perspiration Acid Staining Value");
  //     		document.getElementById("cf_to_perspiration_acid_staining_value").focus();
  //     		return false;
		// }
		// else if(isNaN(document.getElementById("cf_to_perspiration_acid_staining_value").value.trim()))
		// {
  //     		alert("Cf To Perspiration Acid Staining Value should be Numeric");
		// 	document.getElementById("cf_to_perspiration_acid_staining_value").value="";
  //     		document.getElementById("cf_to_perspiration_acid_staining_value").focus();
  //     		return false;
		// }
		// else if(document.getElementById("uom_of_cf_to_perspiration_acid_staining").value.trim()=="")
		// {
  //     		alert("Please Provide Uom Of Cf To Perspiration Acid Staining");
  //     		document.getElementById("uom_of_cf_to_perspiration_acid_staining").focus();
  //     		return false;
		// }
		// else if(document.getElementById("cf_to_perspiration_alkali_color_change_tolerance_value").value.trim()=="")
		// {
  //     		alert("Please Provide Cf To Perspiration Alkali Color Change Tolerance Value");
  //     		document.getElementById("cf_to_perspiration_alkali_color_change_tolerance_value").focus();
  //     		return false;
		// }
		// else if(isNaN(document.getElementById("cf_to_perspiration_alkali_color_change_tolerance_value").value.trim()))
		// {
  //     		alert("Cf To Perspiration Alkali Color Change Tolerance Value should be Numeric");
		// 	document.getElementById("cf_to_perspiration_alkali_color_change_tolerance_value").value="";
  //     		document.getElementById("cf_to_perspiration_alkali_color_change_tolerance_value").focus();
  //     		return false;
		// }
		// else if(document.getElementById("uom_of_cf_to_perspiration_alkali_color_change").value.trim()=="")
		// {
  //     		alert("Please Provide Uom Of Cf To Perspiration Alkali Color Change");
  //     		document.getElementById("uom_of_cf_to_perspiration_alkali_color_change").focus();
  //     		return false;
		// }
		// else if(document.getElementById("cf_to_water_color_change_tolerance_value").value.trim()=="")
		// {
  //     		alert("Please Provide Cf To Water Color Change Tolerance Value");
  //     		document.getElementById("cf_to_water_color_change_tolerance_value").focus();
  //     		return false;
		// }
		// else if(isNaN(document.getElementById("cf_to_water_color_change_tolerance_value").value.trim()))
		// {
  //     		alert("Cf To Water Color Change Tolerance Value should be Numeric");
		// 	document.getElementById("cf_to_water_color_change_tolerance_value").value="";
  //     		document.getElementById("cf_to_water_color_change_tolerance_value").focus();
  //     		return false;
		// }
		// else if(document.getElementById("uom_of_cf_to_water_color_change").value.trim()=="")
		// {
  //     		alert("Please Provide Uom Of Cf To Water Color Change");
  //     		document.getElementById("uom_of_cf_to_water_color_change").focus();
  //     		return false;
		// }
		// else if(document.getElementById("cf_to_water_staining_tolerance_value").value.trim()=="")
		// {
  //     		alert("Please Provide Cf To Water Staining Tolerance Value");
  //     		document.getElementById("cf_to_water_staining_tolerance_value").focus();
  //     		return false;
		// }
		// else if(isNaN(document.getElementById("cf_to_water_staining_tolerance_value").value.trim()))
		// {
  //     		alert("Cf To Water Staining Tolerance Value should be Numeric");
		// 	document.getElementById("cf_to_water_staining_tolerance_value").value="";
  //     		document.getElementById("cf_to_water_staining_tolerance_value").focus();
  //     		return false;
		// }
		// else if(document.getElementById("uom_of_cf_to_water_staining").value.trim()=="")
		// {
  //     		alert("Please Provide Uom Of Cf To Water Staining");
  //     		document.getElementById("uom_of_cf_to_water_staining").focus();
  //     		return false;
		// }
		// else if(document.getElementById("cf_to_water_sotting_staining_tolerance_value").value.trim()=="")
		// {
  //     		alert("Please Provide Cf To Water Sotting Staining Tolerance Value");
  //     		document.getElementById("cf_to_water_sotting_staining_tolerance_value").focus();
  //     		return false;
		// }
		// else if(isNaN(document.getElementById("cf_to_water_sotting_staining_tolerance_value").value.trim()))
		// {
  //     		alert("Cf To Water Sotting Staining Tolerance Value should be Numeric");
		// 	document.getElementById("cf_to_water_sotting_staining_tolerance_value").value="";
  //     		document.getElementById("cf_to_water_sotting_staining_tolerance_value").focus();
  //     		return false;
		// }
		// else if(document.getElementById("uom_of_cf_to_water_sotting_staining").value.trim()=="")
		// {
  //     		alert("Please Provide Uom Of Cf To Water Sotting Staining");
  //     		document.getElementById("uom_of_cf_to_water_sotting_staining").focus();
  //     		return false;
		// }
		// else if(document.getElementById("cf_to_surface_wetting_staining_tolerance_value").value.trim()=="")
		// {
  //     		alert("Please Provide Cf To Surface Wetting Staining Tolerance Value");
  //     		document.getElementById("cf_to_surface_wetting_staining_tolerance_value").focus();
  //     		return false;
		// }
		// else if(isNaN(document.getElementById("cf_to_surface_wetting_staining_tolerance_value").value.trim()))
		// {
  //     		alert("Cf To Surface Wetting Staining Tolerance Value should be Numeric");
		// 	document.getElementById("cf_to_surface_wetting_staining_tolerance_value").value="";
  //     		document.getElementById("cf_to_surface_wetting_staining_tolerance_value").focus();
  //     		return false;
		// }
		// else if(document.getElementById("uom_of_cf_to_surface_wetting_staining").value.trim()=="")
		// {
  //     		alert("Please Provide Uom Of Cf To Surface Wetting Staining");
  //     		document.getElementById("uom_of_cf_to_surface_wetting_staining").focus();
  //     		return false;
		// }
		// else if(document.getElementById("cf_to_hydrolysis_of_reactive_dyes_color_change_tolerance_value").value.trim()=="")
		// {
  //     		alert("Please Provide Cf To Hydrolysis Of Reactive Dyes Color Change Tolerance Value");
  //     		document.getElementById("cf_to_hydrolysis_of_reactive_dyes_color_change_tolerance_value").focus();
  //     		return false;
		// }
		// else if(isNaN(document.getElementById("cf_to_hydrolysis_of_reactive_dyes_color_change_tolerance_value").value.trim()))
		// {
  //     		alert("Cf To Hydrolysis Of Reactive Dyes Color Change Tolerance Value should be Numeric");
		// 	document.getElementById("cf_to_hydrolysis_of_reactive_dyes_color_change_tolerance_value").value="";
  //     		document.getElementById("cf_to_hydrolysis_of_reactive_dyes_color_change_tolerance_value").focus();
  //     		return false;
		// }
		// else if(document.getElementById("uom_of_cf_to_hydrolysis_of_reactive_dyes_color_change").value.trim()=="")
		// {
  //     		alert("Please Provide Uom Of Cf To Hydrolysis Of Reactive Dyes Color Change");
  //     		document.getElementById("uom_of_cf_to_hydrolysis_of_reactive_dyes_color_change").focus();
  //     		return false;
		// }
		// else if(document.getElementById("cf_to_hydrolysis_of_reactive_dyes_staining_tolerance_value").value.trim()=="")
		// {
  //     		alert("Please Provide Cf To Hydrolysis Of Reactive Dyes Staining Tolerance Value");
  //     		document.getElementById("cf_to_hydrolysis_of_reactive_dyes_staining_tolerance_value").focus();
  //     		return false;
		// }
		// else if(isNaN(document.getElementById("cf_to_hydrolysis_of_reactive_dyes_staining_tolerance_value").value.trim()))
		// {
  //     		alert("Cf To Hydrolysis Of Reactive Dyes Staining Tolerance Value should be Numeric");
		// 	document.getElementById("cf_to_hydrolysis_of_reactive_dyes_staining_tolerance_value").value="";
  //     		document.getElementById("cf_to_hydrolysis_of_reactive_dyes_staining_tolerance_value").focus();
  //     		return false;
		// }
		// else if(document.getElementById("uom_of_cf_to_hydrolysis_of_reactive_dyes_staining").value.trim()=="")
		// {
  //     		alert("Please Provide Uom Of Cf To Hydrolysis Of Reactive Dyes Staining");
  //     		document.getElementById("uom_of_cf_to_hydrolysis_of_reactive_dyes_staining").focus();
  //     		return false;
		// }
		// else if(document.getElementById("cf_to_oidative_bleach_damage_color_change_tolerance_value").value.trim()=="")
		// {
  //     		alert("Please Provide Cf To Oidative Bleach Damage Color Change Tolerance Value");
  //     		document.getElementById("cf_to_oidative_bleach_damage_color_change_tolerance_value").focus();
  //     		return false;
		// }
		// else if(isNaN(document.getElementById("cf_to_oidative_bleach_damage_color_change_tolerance_value").value.trim()))
		// {
  //     		alert("Cf To Oidative Bleach Damage Color Change Tolerance Value should be Numeric");
		// 	document.getElementById("cf_to_oidative_bleach_damage_color_change_tolerance_value").value="";
  //     		document.getElementById("cf_to_oidative_bleach_damage_color_change_tolerance_value").focus();
  //     		return false;
		// }
		// else if(document.getElementById("uom_of_cf_to_oidative_bleach_damage_color_change").value.trim()=="")
		// {
  //     		alert("Please Provide Uom Of Cf To Oidative Bleach Damage Color Change");
  //     		document.getElementById("uom_of_cf_to_oidative_bleach_damage_color_change").focus();
  //     		return false;
		// }
		// else if(document.getElementById("cf_to_phenolic_yellowing_staining_tolerance_value").value.trim()=="")
		// {
  //     		alert("Please Provide Cf To Phenolic Yellowing Staining Tolerance Value");
  //     		document.getElementById("cf_to_phenolic_yellowing_staining_tolerance_value").focus();
  //     		return false;
		// }
		// else if(isNaN(document.getElementById("cf_to_phenolic_yellowing_staining_tolerance_value").value.trim()))
		// {
  //     		alert("Cf To Phenolic Yellowing Staining Tolerance Value should be Numeric");
		// 	document.getElementById("cf_to_phenolic_yellowing_staining_tolerance_value").value="";
  //     		document.getElementById("cf_to_phenolic_yellowing_staining_tolerance_value").focus();
  //     		return false;
		// }
		// else if(document.getElementById("uom_of_cf_to_phenolic_yellowing_staining").value.trim()=="")
		// {
  //     		alert("Please Provide Uom Of Cf To Phenolic Yellowing Staining");
  //     		document.getElementById("uom_of_cf_to_phenolic_yellowing_staining").focus();
  //     		return false;
		// }
		// else if(document.getElementById("cf_to_pvc_migration_staining_tolerance_value").value.trim()=="")
		// {
  //     		alert("Please Provide Cf To Pvc Migration Staining Tolerance Value");
  //     		document.getElementById("cf_to_pvc_migration_staining_tolerance_value").focus();
  //     		return false;
		// }
		// else if(isNaN(document.getElementById("cf_to_pvc_migration_staining_tolerance_value").value.trim()))
		// {
  //     		alert("Cf To Pvc Migration Staining Tolerance Value should be Numeric");
		// 	document.getElementById("cf_to_pvc_migration_staining_tolerance_value").value="";
  //     		document.getElementById("cf_to_pvc_migration_staining_tolerance_value").focus();
  //     		return false;
		// }
		// else if(document.getElementById("uom_of_cf_to_pvc_migration_staining").value.trim()=="")
		// {
  //     		alert("Please Provide Uom Of Cf To Pvc Migration Staining");
  //     		document.getElementById("uom_of_cf_to_pvc_migration_staining").focus();
  //     		return false;
		// }
		// else if(document.getElementById("cf_to_saliva_color_change_tolerance_value").value.trim()=="")
		// {
  //     		alert("Please Provide Cf To Saliva Color Change Tolerance Value");
  //     		document.getElementById("cf_to_saliva_color_change_tolerance_value").focus();
  //     		return false;
		// }
		// else if(isNaN(document.getElementById("cf_to_saliva_color_change_tolerance_value").value.trim()))
		// {
  //     		alert("Cf To Saliva Color Change Tolerance Value should be Numeric");
		// 	document.getElementById("cf_to_saliva_color_change_tolerance_value").value="";
  //     		document.getElementById("cf_to_saliva_color_change_tolerance_value").focus();
  //     		return false;
		// }
		// else if(document.getElementById("uom_of_cf_to_saliva_color_change").value.trim()=="")
		// {
  //     		alert("Please Provide Uom Of Cf To Saliva Color Change");
  //     		document.getElementById("uom_of_cf_to_saliva_color_change").focus();
  //     		return false;
		// }
		// else if(document.getElementById("cf_to_saliva_staining_tolerance_value").value.trim()=="")
		// {
  //     		alert("Please Provide Cf To Saliva Staining Tolerance Value");
  //     		document.getElementById("cf_to_saliva_staining_tolerance_value").focus();
  //     		return false;
		// }
		// else if(isNaN(document.getElementById("cf_to_saliva_staining_tolerance_value").value.trim()))
		// {
  //     		alert("Cf To Saliva Staining Tolerance Value should be Numeric");
		// 	document.getElementById("cf_to_saliva_staining_tolerance_value").value="";
  //     		document.getElementById("cf_to_saliva_staining_tolerance_value").focus();
  //     		return false;
		// }
		// else if(document.getElementById("uom_of_cf_to_saliva_staining").value.trim()=="")
		// {
  //     		alert("Please Provide Uom Of Cf To Saliva Staining");
  //     		document.getElementById("uom_of_cf_to_saliva_staining").focus();
  //     		return false;
		// }
		// else if(document.getElementById("cf_to_chlorinated_water_color_change_tolerance_value").value.trim()=="")
		// {
  //     		alert("Please Provide Cf To Chlorinated Water Color Change Tolerance Value");
  //     		document.getElementById("cf_to_chlorinated_water_color_change_tolerance_value").focus();
  //     		return false;
		// }
		// else if(isNaN(document.getElementById("cf_to_chlorinated_water_color_change_tolerance_value").value.trim()))
		// {
  //     		alert("Cf To Chlorinated Water Color Change Tolerance Value should be Numeric");
		// 	document.getElementById("cf_to_chlorinated_water_color_change_tolerance_value").value="";
  //     		document.getElementById("cf_to_chlorinated_water_color_change_tolerance_value").focus();
  //     		return false;
		// }
		// else if(document.getElementById("uom_of_cf_to_chlorinated_water_color_change").value.trim()=="")
		// {
  //     		alert("Please Provide Uom Of Cf To Chlorinated Water Color Change");
  //     		document.getElementById("uom_of_cf_to_chlorinated_water_color_change").focus();
  //     		return false;
		// }
		// else if(document.getElementById("cf_to_chlorinated_water_staining_tolerance_value").value.trim()=="")
		// {
  //     		alert("Please Provide Cf To Chlorinated Water Staining Tolerance Value");
  //     		document.getElementById("cf_to_chlorinated_water_staining_tolerance_value").focus();
  //     		return false;
		// }
		// else if(isNaN(document.getElementById("cf_to_chlorinated_water_staining_tolerance_value").value.trim()))
		// {
  //     		alert("Cf To Chlorinated Water Staining Tolerance Value should be Numeric");
		// 	document.getElementById("cf_to_chlorinated_water_staining_tolerance_value").value="";
  //     		document.getElementById("cf_to_chlorinated_water_staining_tolerance_value").focus();
  //     		return false;
		// }
		// else if(document.getElementById("uom_of_cf_to_chlorinated_water_staining").value.trim()=="")
		// {
  //     		alert("Please Provide Uom Of Cf To Chlorinated Water Staining");
  //     		document.getElementById("uom_of_cf_to_chlorinated_water_staining").focus();
  //     		return false;
		// }
		// else if(document.getElementById("cf_to_cholorine_bleach_color_change_tolerance_value").value.trim()=="")
		// {
  //     		alert("Please Provide Cf To Cholorine Bleach Color Change Tolerance Value");
  //     		document.getElementById("cf_to_cholorine_bleach_color_change_tolerance_value").focus();
  //     		return false;
		// }
		// else if(isNaN(document.getElementById("cf_to_cholorine_bleach_color_change_tolerance_value").value.trim()))
		// {
  //     		alert("Cf To Cholorine Bleach Color Change Tolerance Value should be Numeric");
		// 	document.getElementById("cf_to_cholorine_bleach_color_change_tolerance_value").value="";
  //     		document.getElementById("cf_to_cholorine_bleach_color_change_tolerance_value").focus();
  //     		return false;
		// }
		// else if(document.getElementById("uom_of_cf_to_cholorine_bleach_color_change").value.trim()=="")
		// {
  //     		alert("Please Provide Uom Of Cf To Cholorine Bleach Color Change");
  //     		document.getElementById("uom_of_cf_to_cholorine_bleach_color_change").focus();
  //     		return false;
		// }
		// else if(document.getElementById("cf_to_cholorine_bleach_staining_tolerance_value").value.trim()=="")
		// {
  //     		alert("Please Provide Cf To Cholorine Bleach Staining Tolerance Value");
  //     		document.getElementById("cf_to_cholorine_bleach_staining_tolerance_value").focus();
  //     		return false;
		// }
		// else if(isNaN(document.getElementById("cf_to_cholorine_bleach_staining_tolerance_value").value.trim()))
		// {
  //     		alert("Cf To Cholorine Bleach Staining Tolerance Value should be Numeric");
		// 	document.getElementById("cf_to_cholorine_bleach_staining_tolerance_value").value="";
  //     		document.getElementById("cf_to_cholorine_bleach_staining_tolerance_value").focus();
  //     		return false;
		// }
		// else if(document.getElementById("uom_of_cf_to_cholorine_bleach_staining").value.trim()=="")
		// {
  //     		alert("Please Provide Uom Of Cf To Cholorine Bleach Staining");
  //     		document.getElementById("uom_of_cf_to_cholorine_bleach_staining").focus();
  //     		return false;
		// }
		// else if(document.getElementById("cf_to_peroxide_bleach_color_change_tolerance_value").value.trim()=="")
		// {
  //     		alert("Please Provide Cf To Peroxide Bleach Color Change Tolerance Value");
  //     		document.getElementById("cf_to_peroxide_bleach_color_change_tolerance_value").focus();
  //     		return false;
		// }
		// else if(isNaN(document.getElementById("cf_to_peroxide_bleach_color_change_tolerance_value").value.trim()))
		// {
  //     		alert("Cf To Peroxide Bleach Color Change Tolerance Value should be Numeric");
		// 	document.getElementById("cf_to_peroxide_bleach_color_change_tolerance_value").value="";
  //     		document.getElementById("cf_to_peroxide_bleach_color_change_tolerance_value").focus();
  //     		return false;
		// }
		// else if(document.getElementById("uom_of_cf_to_peroxide_bleach_color_change").value.trim()=="")
		// {
  //     		alert("Please Provide Uom Of Cf To Peroxide Bleach Color Change");
  //     		document.getElementById("uom_of_cf_to_peroxide_bleach_color_change").focus();
  //     		return false;
		// }
		// else if(document.getElementById("cf_to_peroxide_bleach_staining_tolerance_value").value.trim()=="")
		// {
  //     		alert("Please Provide Cf To Peroxide Bleach Staining Tolerance Value");
  //     		document.getElementById("cf_to_peroxide_bleach_staining_tolerance_value").focus();
  //     		return false;
		// }
		// else if(isNaN(document.getElementById("cf_to_peroxide_bleach_staining_tolerance_value").value.trim()))
		// {
  //     		alert("Cf To Peroxide Bleach Staining Tolerance Value should be Numeric");
		// 	document.getElementById("cf_to_peroxide_bleach_staining_tolerance_value").value="";
  //     		document.getElementById("cf_to_peroxide_bleach_staining_tolerance_value").focus();
  //     		return false;
		// }
		// else if(document.getElementById("uom_of_cf_to_peroxide_bleach_staining").value.trim()=="")
		// {
  //     		alert("Please Provide Uom Of Cf To Peroxide Bleach Staining");
  //     		document.getElementById("uom_of_cf_to_peroxide_bleach_staining").focus();
  //     		return false;
		// }
		// else if(document.getElementById("cross_staining_tolerance_value").value.trim()=="")
		// {
  //     		alert("Please Provide Cross Staining Tolerance Value");
  //     		document.getElementById("cross_staining_tolerance_value").focus();
  //     		return false;
		// }
		// else if(isNaN(document.getElementById("cross_staining_tolerance_value").value.trim()))
		// {
  //     		alert("Cross Staining Tolerance Value should be Numeric");
		// 	document.getElementById("cross_staining_tolerance_value").value="";
  //     		document.getElementById("cross_staining_tolerance_value").focus();
  //     		return false;
		// }
		// else if(document.getElementById("uom_of_cross_staining").value.trim()=="")
		// {
  //     		alert("Please Provide Uom Of Cross Staining");
  //     		document.getElementById("uom_of_cross_staining").focus();
  //     		return false;
		// }
		// else if(document.getElementById("ph_value").value.trim()=="")
		// {
  //     		alert("Please Provide Ph Value");
  //     		document.getElementById("ph_value").focus();
  //     		return false;
		// }
		// else if(isNaN(document.getElementById("ph_value").value.trim()))
		// {
  //     		alert("Ph Value should be Numeric");
		// 	document.getElementById("ph_value").value="";
  //     		document.getElementById("ph_value").focus();
  //     		return false;
		// }
		// else if(document.getElementById("uom_of_ph_value").value.trim()=="")
		// {
  //     		alert("Please Provide Uom Of Ph Value");
  //     		document.getElementById("uom_of_ph_value").focus();
  //     		return false;
		// }
		// var radio_btn_status = document.getElementsByName('status');
		// var ischecked = false;
		// for ( var i = 0; i < radio_btn_status.length; i++) 
		// {
		// 		if(radio_btn_status[i].checked)  
		// 		{
		// 				ischecked = true;
		// 		}
		// }
		// if(!ischecked)
		// {
  //     		alert("Please Select Status");
  //     		document.getElementById("status").focus();
  //     		return false;
		// }

		// else if(document.getElementById("remarks").value.trim()=="")
		// {
  //     		alert("Please Provide Remarks");
  //     		document.getElementById("remarks").focus();
  //     		return false;
		// }

}
