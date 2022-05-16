function Bleaching_Form_Validation()
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
		else if(document.getElementById("date").value.trim()=="")
		{
      		alert("Please Provide Date");
      		document.getElementById("date").focus();
      		return false;
		}
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
		/*else if(document.getElementById("fabric_width_in_inch").value.trim()=="")
		{
      		alert("Please Provide Fabric Width In Inch");
      		document.getElementById("fabric_width_in_inch").focus();
      		return false;
		}
		else if(isNaN(document.getElementById("fabric_width_in_inch").value.trim()))
		{
      		alert("Fabric Width In Inch should be Numeric");
			document.getElementById("fabric_width_in_inch").value="";
      		document.getElementById("fabric_width_in_inch").focus();
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
		}
		else if(document.getElementById("absorbency_value").value.trim()=="")
		{
      		alert("Please Provide Absorbency Value");
      		document.getElementById("absorbency_value").focus();
      		return false;
		}
		else if(isNaN(document.getElementById("absorbency_value").value.trim()))
		{
      		alert("Absorbency Value should be Numeric");
			document.getElementById("absorbency_value").value="";
      		document.getElementById("absorbency_value").focus();
      		return false;
		}
		else if(document.getElementById("uom_of_absorbency").value.trim()=="")
		{
      		alert("Please Provide Uom Of Absorbency");
      		document.getElementById("uom_of_absorbency").focus();
      		return false;
		}
		else if(document.getElementById("residual_sizing_material_value").value.trim()=="")
		{
      		alert("Please Provide Residual Sizing Material Value");
      		document.getElementById("residual_sizing_material_value").focus();
      		return false;
		}
		else if(isNaN(document.getElementById("residual_sizing_material_value").value.trim()))
		{
      		alert("Residual Sizing Material Value should be Numeric");
			document.getElementById("residual_sizing_material_value").value="";
      		document.getElementById("residual_sizing_material_value").focus();
      		return false;
		}
		else if(document.getElementById("uom_of_residual_sizing_material").value.trim()=="")
		{
      		alert("Please Provide Uom Of Residual Sizing Material");
      		document.getElementById("uom_of_residual_sizing_material").focus();
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
		else if(document.getElementById("resistance_to_surface_fuzzing_and_pilling_value").value.trim()=="")
		{
      		alert("Please Provide Resistance to Surface Fuzzing and Pilling Value");
      		document.getElementById("resistance_to_surface_fuzzing_and_pilling_value").focus();
      		return false;
		}
		else if(isNaN(document.getElementById("resistance_to_surface_fuzzing_and_pilling_value").value.trim()))
		{
      		alert("Resistance to Surface Fuzzing and Pilling Value should be Numeric");
			document.getElementById("resistance_to_surface_fuzzing_and_pilling_value").value="";
      		document.getElementById("resistance_to_surface_fuzzing_and_pilling_value").focus();
      		return false;
		}
		else if(document.getElementById("uom_of_resistance_to_surface_fuzzing_and_pilling").value.trim()=="")
		{
      		alert("Please Provide Uom Of Resistance to Surface Fuzzing and Pilling");
      		document.getElementById("uom_of_resistance_to_surface_fuzzing_and_pilling").focus();
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
		}*/
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
		else if(document.getElementById("remarks").value.trim()=="")
		{
      		alert("Please Provide Remarks");
      		document.getElementById("remarks").focus();
      		return false;
		}
}
