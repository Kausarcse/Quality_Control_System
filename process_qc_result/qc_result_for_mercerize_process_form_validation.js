function Mercerize_Form_Validation()
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
		// else if(document.getElementById("finish_width_in_inch").value.trim()=="")
		// {
  //     		alert("Please Provide Greige Width");
  //     		document.getElementById("finish_width_in_inch").focus();
  //     		return false;
		// }
		// else if(isNaN(document.getElementById("finish_width_in_inch").value.trim()))
		// {
  //     		alert("Greige Width should be Numeric");
		// 	document.getElementById("finish_width_in_inch").value="";
  //     		document.getElementById("finish_width_in_inch").focus();
  //     		return false;
		// }
		// else if(document.getElementById("standard_for_which_process").value.trim()=="")
		// {
  //     		alert("Please Provide Standard For Which Process");
  //     		document.getElementById("standard_for_which_process").focus();
  //     		return false;
		// }
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
		else if(document.getElementById("process_fabric_width_inch").value.trim()=="")
		{
      		alert("Please Provide Process Fabric Width Inch");
      		document.getElementById("process_fabric_width_inch").focus();
      		return false;
		}
		else if(isNaN(document.getElementById("process_fabric_width_inch").value.trim()))
		{
      		alert("Process Fabric Width Inch should be Numeric");
			document.getElementById("process_fabric_width_inch").value="";
      		document.getElementById("process_fabric_width_inch").focus();
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
		else if(document.getElementById("absorbency_value_in_left_side_of_fabric").value.trim()=="")
		{
      		alert("Please Provide Absorbency Value In Left Side Of Fabric");
      		document.getElementById("absorbency_value_in_left_side_of_fabric").focus();
      		return false;
		}
		else if(isNaN(document.getElementById("absorbency_value_in_left_side_of_fabric").value.trim()))
		{
      		alert("Absorbency Value In Left Side Of Fabric should be Numeric");
			document.getElementById("absorbency_value_in_left_side_of_fabric").value="";
      		document.getElementById("absorbency_value_in_left_side_of_fabric").focus();
      		return false;
		}
		else if(document.getElementById("absorbency_value_in_center_of_fabric").value.trim()=="")
		{
      		alert("Please Provide Absorbency Value In Center Of Fabric");
      		document.getElementById("absorbency_value_in_center_of_fabric").focus();
      		return false;
		}
		else if(isNaN(document.getElementById("absorbency_value_in_center_of_fabric").value.trim()))
		{
      		alert("Absorbency Value In Center Of Fabric should be Numeric");
			document.getElementById("absorbency_value_in_center_of_fabric").value="";
      		document.getElementById("absorbency_value_in_center_of_fabric").focus();
      		return false;
		}
		else if(document.getElementById("absorbency_value_in_right_side_of_fabric").value.trim()=="")
		{
      		alert("Please Provide Absorbency Value In Right Side Of Fabric");
      		document.getElementById("absorbency_value_in_right_side_of_fabric").focus();
      		return false;
		}
		else if(isNaN(document.getElementById("absorbency_value_in_right_side_of_fabric").value.trim()))
		{
      		alert("Absorbency Value In Right Side Of Fabric should be Numeric");
			document.getElementById("absorbency_value_in_right_side_of_fabric").value="";
      		document.getElementById("absorbency_value_in_right_side_of_fabric").focus();
      		return false;
		}
		else if(document.getElementById("uom_of_absorbency_value").value.trim()=="")
		{
      		alert("Please Provide Uom Of Absorbency Value");
      		document.getElementById("uom_of_absorbency_value").focus();
      		return false;
		}
		else if(document.getElementById("sizing_value_in_left_side_of_fabric").value.trim()=="")
		{
      		alert("Please Provide Sizing Value In Left Side Of Fabric");
      		document.getElementById("sizing_value_in_left_side_of_fabric").focus();
      		return false;
		}
		else if(isNaN(document.getElementById("sizing_value_in_left_side_of_fabric").value.trim()))
		{
      		alert("Sizing Value In Left Side Of Fabric should be Numeric");
			document.getElementById("sizing_value_in_left_side_of_fabric").value="";
      		document.getElementById("sizing_value_in_left_side_of_fabric").focus();
      		return false;
		}
		else if(document.getElementById("sizing_value_in_center_of_fabric").value.trim()=="")
		{
      		alert("Please Provide Sizing Value In Center Of Fabric");
      		document.getElementById("sizing_value_in_center_of_fabric").focus();
      		return false;
		}
		else if(isNaN(document.getElementById("sizing_value_in_center_of_fabric").value.trim()))
		{
      		alert("Sizing Value In Center Of Fabric should be Numeric");
			document.getElementById("sizing_value_in_center_of_fabric").value="";
      		document.getElementById("sizing_value_in_center_of_fabric").focus();
      		return false;
		}
		else if(document.getElementById("sizing_value_in_right_side_of_fabric").value.trim()=="")
		{
      		alert("Please Provide Sizing Value In Right Side Of Fabric");
      		document.getElementById("sizing_value_in_right_side_of_fabric").focus();
      		return false;
		}
		else if(isNaN(document.getElementById("sizing_value_in_right_side_of_fabric").value.trim()))
		{
      		alert("Sizing Value In Right Side Of Fabric should be Numeric");
			document.getElementById("sizing_value_in_right_side_of_fabric").value="";
      		document.getElementById("sizing_value_in_right_side_of_fabric").focus();
      		return false;
		}
		else if(document.getElementById("uom_of_sizing").value.trim()=="")
		{
      		alert("Please Provide Uom Of Sizing");
      		document.getElementById("uom_of_sizing").focus();
      		return false;
		}
		else if(document.getElementById("whiteness_value_in_left_side_of_fabric").value.trim()=="")
		{
      		alert("Please Provide Whiteness Value In Left Side Of Fabric");
      		document.getElementById("whiteness_value_in_left_side_of_fabric").focus();
      		return false;
		}
		else if(isNaN(document.getElementById("whiteness_value_in_left_side_of_fabric").value.trim()))
		{
      		alert("Whiteness Value In Left Side Of Fabric should be Numeric");
			document.getElementById("whiteness_value_in_left_side_of_fabric").value="";
      		document.getElementById("whiteness_value_in_left_side_of_fabric").focus();
      		return false;
		}
		else if(document.getElementById("whiteness_value_in_center_of_fabric").value.trim()=="")
		{
      		alert("Please Provide Whiteness Value In Center Of Fabric");
      		document.getElementById("whiteness_value_in_center_of_fabric").focus();
      		return false;
		}
		else if(isNaN(document.getElementById("whiteness_value_in_center_of_fabric").value.trim()))
		{
      		alert("Whiteness Value In Center Of Fabric should be Numeric");
			document.getElementById("whiteness_value_in_center_of_fabric").value="";
      		document.getElementById("whiteness_value_in_center_of_fabric").focus();
      		return false;
		}
		else if(document.getElementById("whiteness_value_in_right_side_of_fabric").value.trim()=="")
		{
      		alert("Please Provide Whiteness Value In Right Side Of Fabric");
      		document.getElementById("whiteness_value_in_right_side_of_fabric").focus();
      		return false;
		}
		else if(isNaN(document.getElementById("whiteness_value_in_right_side_of_fabric").value.trim()))
		{
      		alert("Whiteness Value In Right Side Of Fabric should be Numeric");
			document.getElementById("whiteness_value_in_right_side_of_fabric").value="";
      		document.getElementById("whiteness_value_in_right_side_of_fabric").focus();
      		return false;
		}
		else if(document.getElementById("uom_of_whiteness").value.trim()=="")
		{
      		alert("Please Provide Uom Of Whiteness");
      		document.getElementById("uom_of_whiteness").focus();
      		return false;
		}
		else if(document.getElementById("ph_value_in_left_side_of_fabric").value.trim()=="")
		{
      		alert("Please Provide Ph Value In Left Side Of Fabric");
      		document.getElementById("ph_value_in_left_side_of_fabric").focus();
      		return false;
		}
		else if(isNaN(document.getElementById("ph_value_in_left_side_of_fabric").value.trim()))
		{
      		alert("Ph Value In Left Side Of Fabric should be Numeric");
			document.getElementById("ph_value_in_left_side_of_fabric").value="";
      		document.getElementById("ph_value_in_left_side_of_fabric").focus();
      		return false;
		}
		else if(document.getElementById("ph_value_value_in_center_of_fabric").value.trim()=="")
		{
      		alert("Please Provide Ph Value Value In Center Of Fabric");
      		document.getElementById("ph_value_value_in_center_of_fabric").focus();
      		return false;
		}
		else if(isNaN(document.getElementById("ph_value_value_in_center_of_fabric").value.trim()))
		{
      		alert("Ph Value Value In Center Of Fabric should be Numeric");
			document.getElementById("ph_value_value_in_center_of_fabric").value="";
      		document.getElementById("ph_value_value_in_center_of_fabric").focus();
      		return false;
		}
		else if(document.getElementById("ph_value_value_in_right_side_of_fabric").value.trim()=="")
		{
      		alert("Please Provide Ph Value Value In Right Side Of Fabric");
      		document.getElementById("ph_value_value_in_right_side_of_fabric").focus();
      		return false;
		}
		else if(isNaN(document.getElementById("ph_value_value_in_right_side_of_fabric").value.trim()))
		{
      		alert("Ph Value Value In Right Side Of Fabric should be Numeric");
			document.getElementById("ph_value_value_in_right_side_of_fabric").value="";
      		document.getElementById("ph_value_value_in_right_side_of_fabric").focus();
      		return false;
		}
		else if(document.getElementById("uom_of_ph").value.trim()=="")
		{
      		alert("Please Provide Uom Of Ph");
      		document.getElementById("uom_of_ph").focus();
      		return false;
		}*/
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
