function Ready_For_Mercerize_Form_Validation()
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
		/*else if(document.getElementById("standard_for_which_process").value.trim()=="")
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
		// else if(document.getElementById("after_trolley_number_or_batcher_number").value.trim()=="")
		// {
  //     		alert("Please Provide After Trolley Number Or Batcher Number");
  //     		document.getElementById("after_trolley_number_or_batcher_number").focus();
  //     		return false;
		// }
		// else if(document.getElementById("fabric_width_in_inch").value.trim()=="")
		// {
  //     		alert("Please Provide Fabric Width In Inch");
  //     		document.getElementById("fabric_width_in_inch").focus();
  //     		return false;
		// }
		// else if(isNaN(document.getElementById("fabric_width_in_inch").value.trim()))
		// {
  //     		alert("Fabric Width In Inch should be Numeric");
		// 	document.getElementById("fabric_width_in_inch").value="";
  //     		document.getElementById("fabric_width_in_inch").focus();
  //     		return false;
		// }
		// else if(document.getElementById("received_quantity_in_meter").value.trim()=="")
		// {
  //     		alert("Please Provide Total Program Quantity");
  //     		document.getElementById("received_quantity_in_meter").focus();
  //     		return false;
		// }
		// else if(isNaN(document.getElementById("received_quantity_in_meter").value.trim()))
		// {
  //     		alert("Total Program Quantity should be Numeric");
		// 	document.getElementById("received_quantity_in_meter").value="";
  //     		document.getElementById("received_quantity_in_meter").focus();
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
		
		
		// else if(document.getElementById("machine_name").value.trim()=="")
		// {
  //     		alert("Please Provide Machine Name");
  //     		document.getElementById("machine_name").focus();
  //     		return false;
		// }
		// else if(document.getElementById("whiteness_value_in_left_side_of_fabric").value.trim()=="")
		// {
  //     		alert("Please Provide Whiteness Value In Left Side Of Fabric");
  //     		document.getElementById("whiteness_value_in_left_side_of_fabric").focus();
  //     		return false;
		// }
		// else if(isNaN(document.getElementById("whiteness_value_in_left_side_of_fabric").value.trim()))
		// {
  //     		alert("Whiteness Value In Left Side Of Fabric should be Numeric");
		// 	document.getElementById("whiteness_value_in_left_side_of_fabric").value="";
  //     		document.getElementById("whiteness_value_in_left_side_of_fabric").focus();
  //     		return false;
		// }
		// else if(document.getElementById("whiteness_value_in_center_of_fabric").value.trim()=="")
		// {
  //     		alert("Please Provide Whiteness Value In Center Of Fabric");
  //     		document.getElementById("whiteness_value_in_center_of_fabric").focus();
  //     		return false;
		// }
		// else if(isNaN(document.getElementById("whiteness_value_in_center_of_fabric").value.trim()))
		// {
  //     		alert("Whiteness Value In Center Of Fabric should be Numeric");
		// 	document.getElementById("whiteness_value_in_center_of_fabric").value="";
  //     		document.getElementById("whiteness_value_in_center_of_fabric").focus();
  //     		return false;
		// }
		// else if(document.getElementById("whiteness_value_in_right_side_of_fabric").value.trim()=="")
		// {
  //     		alert("Please Provide Whiteness Value In Right Side Of Fabric");
  //     		document.getElementById("whiteness_value_in_right_side_of_fabric").focus();
  //     		return false;
		// }
		// else if(isNaN(document.getElementById("whiteness_value_in_right_side_of_fabric").value.trim()))
		// {
  //     		alert("Whiteness Value In Right Side Of Fabric should be Numeric");
		// 	document.getElementById("whiteness_value_in_right_side_of_fabric").value="";
  //     		document.getElementById("whiteness_value_in_right_side_of_fabric").focus();
  //     		return false;
		// }
		// else if(document.getElementById("uom_of_whiteness").value.trim()=="")
		// {
  //     		alert("Please Provide Uom Of Whiteness");
  //     		document.getElementById("uom_of_whiteness").focus();
  //     		return false;
		// }
		// else if(document.getElementById("bowing_and_skew_value").value.trim()=="")
		// {
  //     		alert("Please Provide Bowing And Skew Value");
  //     		document.getElementById("bowing_and_skew_value").focus();
  //     		return false;
		// }
		// else if(isNaN(document.getElementById("bowing_and_skew_value").value.trim()))
		// {
  //     		alert("Bowing And Skew Value should be Numeric");
		// 	document.getElementById("bowing_and_skew_value").value="";
  //     		document.getElementById("bowing_and_skew_value").focus();
  //     		return false;
		// }
		// else if(document.getElementById("uom_of_bowing_and_skew").value.trim()=="")
		// {
  //     		alert("Please Provide Uom Of Bowing And Skew");
  //     		document.getElementById("uom_of_bowing_and_skew").focus();
  //     		return false;
		// }
		// else if(document.getElementById("Ph_value_in_left_side_of_fabric").value.trim()=="")
		// {
  //     		alert("Please Provide Ph Value In Left Side Of Fabric");
  //     		document.getElementById("Ph_value_in_left_side_of_fabric").focus();
  //     		return false;
		// }
		// else if(isNaN(document.getElementById("Ph_value_in_left_side_of_fabric").value.trim()))
		// {
  //     		alert("Ph Value In Left Side Of Fabric should be Numeric");
		// 	document.getElementById("Ph_value_in_left_side_of_fabric").value="";
  //     		document.getElementById("Ph_value_in_left_side_of_fabric").focus();
  //     		return false;
		// }
		// else if(document.getElementById("Ph_value_in_center_of_fabric").value.trim()=="")
		// {
  //     		alert("Please Provide Ph Value In Center Of Fabric");
  //     		document.getElementById("Ph_value_in_center_of_fabric").focus();
  //     		return false;
		// }
		// else if(isNaN(document.getElementById("Ph_value_in_center_of_fabric").value.trim()))
		// {
  //     		alert("Ph Value In Center Of Fabric should be Numeric");
		// 	document.getElementById("Ph_value_in_center_of_fabric").value="";
  //     		document.getElementById("Ph_value_in_center_of_fabric").focus();
  //     		return false;
		// }
		// else if(document.getElementById("Ph_value_in_right_of_fabric").value.trim()=="")
		// {
  //     		alert("Please Provide Ph Value In Right Of Fabric");
  //     		document.getElementById("Ph_value_in_right_of_fabric").focus();
  //     		return false;
		// }
		// else if(isNaN(document.getElementById("Ph_value_in_right_of_fabric").value.trim()))
		// {
  //     		alert("Ph Value In Right Of Fabric should be Numeric");
		// 	document.getElementById("Ph_value_in_right_of_fabric").value="";
  //     		document.getElementById("Ph_value_in_right_of_fabric").focus();
  //     		return false;
		// }
		// else if(document.getElementById("uom_of_ph").value.trim()=="")
		// {
  //     		alert("Please Provide Uom Of Ph");
  //     		document.getElementById("uom_of_ph").focus();
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

		// else if(document.getElementById("remarks").value.trim()=="")
		// {
  //     		alert("Please Provide Remarks");
  //     		document.getElementById("remarks").focus();
  //     		return false;
		// }
}
