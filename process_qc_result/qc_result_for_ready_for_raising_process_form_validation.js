function Ready_For_Raising_Process_Form_Validation()
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
		// else if(document.getElementById("customer_name").value.trim()=="")
		// {
  //     		alert("Please Provide Customer Name");
  //     		document.getElementById("customer_name").focus();
  //     		return false;
		// }
		// else if(document.getElementById("color").value.trim()=="")
		// {
  //     		alert("Please Provide Color");
  //     		document.getElementById("color").focus();
  //     		return false;
		// }
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
		/*else if(document.getElementById("machine_name").value.trim()=="")
		{
      		alert("Please Provide Machine Name");
      		document.getElementById("machine_name").focus();
      		return false;
		}*/
		/*else if(document.getElementById("warp_yarn_tensile_properties_tolerance_value").value.trim()=="")
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
		else if(document.getElementById("uom_of_tensile_properties_in_warp").value.trim()=="")
		{
      		alert("Please Provide Uom Of Warp Yarn Tensile Properties");
      		document.getElementById("uom_of_tensile_properties_in_warp").focus();
      		return false;
		}
		else if(document.getElementById("warp_yarn_tensile_properties_max_value").value.trim()=="")
		{
      		alert("Please Provide Warp Yarn Tensile Properties Max Value");
      		document.getElementById("warp_yarn_tensile_properties_max_value").focus();
      		return false;
		}
		else if(isNaN(document.getElementById("warp_yarn_tensile_properties_max_value").value.trim()))
		{
      		alert("Warp Yarn Tensile Properties Max Value should be Numeric");
			document.getElementById("warp_yarn_tensile_properties_max_value").value="";
      		document.getElementById("warp_yarn_tensile_properties_max_value").focus();
      		return false;
		}
		else if(document.getElementById("uom_of_tensile_properties_in_weft").value.trim()=="")
		{
      		alert("Please Provide Uom Of Weft Yarn Tensile Properties");
      		document.getElementById("uom_of_tensile_properties_in_weft").focus();
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
		else if(document.getElementById("uom_of_tear_force_in_warp").value.trim()=="")
		{
      		alert("Please Provide Uom Of Warp Yarn Tear Force");
      		document.getElementById("uom_of_tear_force_in_warp").focus();
      		return false;
		}
		else if(document.getElementById("uom_of_tear_force_in_weft").value.trim()=="")
		{
      		alert("Please Provide Uom Of Weft Yarn Tear Force");
      		document.getElementById("uom_of_tear_force_in_weft").focus();
      		return false;
		}*/
		// var radio_btn_hand_feel = document.getElementsByName('hand_feel');
	 //    var ischecked = false;
	 //    for ( var i = 0; i < radio_btn_hand_feel.length; i++) 
	 //    {
	 //        if(radio_btn_hand_feel[i].checked)  
	 //        {
	 //            ischecked = true;
	 //        }
	 //    }
	 //    if(!ischecked)
	 //    {
	 //          alert("Please Select Hand Feel");
	 //          document.getElementById("hand_feel").focus();
	 //          return false;
	 //    }
	    /*var radio_btn_ready_for_raising_process_quality = document.getElementsByName('ready_for_raising_process_quality');
	    var ischecked = false;
	    for ( var i = 0; i < radio_btn_ready_for_raising_process_quality.length; i++) 
	    {
	        if(radio_btn_ready_for_raising_process_quality[i].checked)  
	        {
	            ischecked = true;
	        }
	    }
	    if(!ischecked)
	    {
	          alert("Please Select Hand Feel");
	          document.getElementById("ready_for_raising_process_quality").focus();
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

		*/
		
}
