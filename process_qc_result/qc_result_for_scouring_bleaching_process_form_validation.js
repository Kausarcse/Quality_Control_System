function Scouring_Bleaching_Form_Validation()
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
		// else if(document.getElementById("before_fabric_width_in_inch").value.trim()=="")
		// {
  //     		alert("Please Provide Before Fabric Width In Inch");
  //     		document.getElementById("before_fabric_width_in_inch").focus();
  //     		return false;
		// }
		// else if(isNaN(document.getElementById("before_fabric_width_in_inch").value.trim()))
		// {
  //     		alert("Before Fabric Width In Inch should be Numeric");
		// 	document.getElementById("before_fabric_width_in_inch").value="";
  //     		document.getElementById("before_fabric_width_in_inch").focus();
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
		// else if(document.getElementById("total_short_or_excess_in_percentage").value.trim()=="")
		// {
  //     		alert("Please Provide Total Short Or Excess In Percentage");
  //     		document.getElementById("total_short_or_excess_in_percentage").focus();
  //     		return false;
		// }
		// else if(isNaN(document.getElementById("total_short_or_excess_in_percentage").value.trim()))
		// {
  //     		alert("Total Short Or Excess In Percentage should be Numeric");
		// 	document.getElementById("total_short_or_excess_in_percentage").value="";
  //     		document.getElementById("total_short_or_excess_in_percentage").focus();
  //     		return false;
		// }
		// else if(document.getElementById("machine_name").value.trim()=="")
		// {
  //     		alert("Please Provide Machine Name");
  //     		document.getElementById("machine_name").focus();
  //     		return false;
		// }
		/*else if(document.getElementById("absorbency_left_value").value.trim()=="")
		{
      		alert("Please Provide absorbency Left Value");
      		document.getElementById("absorbency_left_value").focus();
      		return false;
		}
		else if(isNaN(document.getElementById("absorbency_left_value").value.trim()))
		{
      		alert("Rubbing absorbency Left should be Numeric");
			document.getElementById("absorbency_left_value").value="";
      		document.getElementById("absorbency_left_value").focus();
      		return false;
		}*/
		/*else if(document.getElementById("uom_of_rubbing_dry").value.trim()=="")
		{
      		alert("Please Provide Uom Of Rubbing Dry");
      		document.getElementById("uom_of_rubbing_dry").focus();
      		return false;
		}*/
		/*else if(document.getElementById("absorbency_center_value").value.trim()=="")
		{
      		alert("Please Provide absorbency Center Value");
      		document.getElementById("absorbency_center_value").focus();
      		return false;
		}
		else if(isNaN(document.getElementById("absorbency_center_value").value.trim()))
		{
      		alert("absorbency Center Value should be Numeric");
			document.getElementById("absorbency_center_value").value="";
      		document.getElementById("absorbency_center_value").focus();
      		return false;
		}
		else if(document.getElementById("absorbency_right_value").value.trim()=="")
		{
      		alert("Please Provide absorbency Right Value");
      		document.getElementById("absorbency_right_value").focus();
      		return false;
		}
		else if(isNaN(document.getElementById("absorbency_right_value").value.trim()))
		{
      		alert("absorbency Right Value should be Numeric");
			document.getElementById("absorbency_right_value").value="";
      		document.getElementById("absorbency_right_value").focus();
      		return false;
		}*/
		/*else if(document.getElementById("uom_of_rubbing_wet").value.trim()=="")
		{
      		alert("Please Provide Uom Of Rubbing Wet");
      		document.getElementById("uom_of_rubbing_wet").focus();
      		return false;
		}*/

		 /* else if(document.getElementById("ph_left_value").value.trim()=="")
    {
          alert("Please Provide ph Left Value");
          document.getElementById("ph_left_value").focus();
          return false;
    }
    else if(isNaN(document.getElementById("ph_left_value").value.trim()))
    {
          alert("Rubbing ph Left should be Numeric");
      document.getElementById("ph_left_value").value="";
          document.getElementById("ph_left_value").focus();
          return false;
    }*/
    /*else if(document.getElementById("uom_of_rubbing_dry").value.trim()=="")
    {
          alert("Please Provide Uom Of Rubbing Dry");
          document.getElementById("uom_of_rubbing_dry").focus();
          return false;
    }*/
   /* else if(document.getElementById("ph_center_value").value.trim()=="")
    {
          alert("Please Provide ph Center Value");
          document.getElementById("ph_center_value").focus();
          return false;
    }
    else if(isNaN(document.getElementById("ph_center_value").value.trim()))
    {
          alert("ph Center Value should be Numeric");
      document.getElementById("ph_center_value").value="";
          document.getElementById("ph_center_value").focus();
          return false;
    }
    else if(document.getElementById("ph_right_value").value.trim()=="")
    {
          alert("Please Provide ph Right Value");
          document.getElementById("ph_right_value").focus();
          return false;
    }
    else if(isNaN(document.getElementById("ph_right_value").value.trim()))
    {
          alert("ph Right Value should be Numeric");
      document.getElementById("ph_right_value").value="";
          document.getElementById("ph_right_value").focus();
          return false;
    }

     else if(document.getElementById("whiteness_left_value").value.trim()=="")
    {
          alert("Please Provide whiteness Left Value");
          document.getElementById("whiteness_left_value").focus();
          return false;
    }
    else if(isNaN(document.getElementById("whiteness_left_value").value.trim()))
    {
          alert("Rubbing whiteness Left should be Numeric");
      document.getElementById("whiteness_left_value").value="";
          document.getElementById("whiteness_left_value").focus();
          return false;
    }*/
    /*else if(document.getElementById("uom_of_rubbing_dry").value.trim()=="")
    {
          alert("Please Provide Uom Of Rubbing Dry");
          document.getElementById("uom_of_rubbing_dry").focus();
          return false;
    }*/
   /* else if(document.getElementById("whiteness_center_value").value.trim()=="")
    {
          alert("Please Provide whiteness Center Value");
          document.getElementById("whiteness_center_value").focus();
          return false;
    }
    else if(isNaN(document.getElementById("whiteness_center_value").value.trim()))
    {
          alert("whiteness Center Value should be Numeric");
      document.getElementById("whiteness_center_value").value="";
          document.getElementById("whiteness_center_value").focus();
          return false;
    }
    else if(document.getElementById("whiteness_right_value").value.trim()=="")
    {
          alert("Please Provide whiteness Right Value");
          document.getElementById("whiteness_right_value").focus();
          return false;
    }
    else if(isNaN(document.getElementById("whiteness_right_value").value.trim()))
    {
          alert("whiteness Right Value should be Numeric");
      document.getElementById("whiteness_right_value").value="";
          document.getElementById("whiteness_right_value").focus();
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

		
}
