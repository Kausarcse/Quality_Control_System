function Singeing_Form_Validation()
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
		// else if(document.getElementById("batcher_number").value.trim()=="")
		// {
  //     		alert("Please Provide Batcher Number");
  //     		document.getElementById("batcher_number").focus();
  //     		return false;
		// }
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
		else if(document.getElementById("machine_name").value.trim()=="")
		{
      		alert("Please Provide Machine Name");
      		document.getElementById("machine_name").focus();
      		return false;
		}
		else if(document.getElementById("flame_intensity_value").value.trim()=="")
		{
      		alert("Please Provide Flame Intensity Value");
      		document.getElementById("flame_intensity_value").focus();
      		return false;
		}
		else if(isNaN(document.getElementById("flame_intensity_value").value.trim()))
		{
      		alert("Flame Intensity Value should be Numeric");
			document.getElementById("flame_intensity_value").value="";
      		document.getElementById("flame_intensity_value").focus();
      		return false;
		}
		else if(document.getElementById("uom_of_flame_intensity").value.trim()=="")
		{
      		alert("Please Provide Uom Of Flame Intensity");
      		document.getElementById("uom_of_flame_intensity").focus();
      		return false;
		}
		else if(document.getElementById("machine_speed").value.trim()=="")
		{
      		alert("Please Provide machine_speed");
      		document.getElementById("machine_speed").focus();
      		return false;
		}
		else if(isNaN(document.getElementById("machine_speed").value.trim()))
		{
      		alert("machine_speed should be Numeric");
			document.getElementById("machine_speed").value="";
      		document.getElementById("machine_speed").focus();
      		return false;
		}
		else if(document.getElementById("uom_of_machine_speed").value.trim()=="")
		{
      		alert("Please Provide Uom Of machine_speed");
      		document.getElementById("uom_of_machine_speed").focus();
      		return false;
		}
		else if(document.getElementById("bath_temperature").value.trim()=="")
		{
      		alert("Please Provide Bath Temperature");
      		document.getElementById("bath_temperature").focus();
      		return false;
		}
		else if(isNaN(document.getElementById("bath_temperature").value.trim()))
		{
      		alert("Bath Temperature should be Numeric");
			document.getElementById("bath_temperature").value="";
      		document.getElementById("bath_temperature").focus();
      		return false;
		}
		else if(document.getElementById("uom_of_bath_temperature").value.trim()=="")
		{
      		alert("Please Provide Uom Of Bath Temperature");
      		document.getElementById("uom_of_bath_temperature").focus();
      		return false;
		}
		else if(document.getElementById("bath_ph").value.trim()=="")
		{
      		alert("Please Provide Bath Ph");
      		document.getElementById("bath_ph").focus();
      		return false;
		}
		else if(isNaN(document.getElementById("bath_ph").value.trim()))
		{
      		alert("Bath Ph should be Numeric");
			document.getElementById("bath_ph").value="";
      		document.getElementById("bath_ph").focus();
      		return false;
		}
		else if(document.getElementById("uom_of_bath_ph").value.trim()=="")
		{
      		alert("Please Provide Uom Of Bath Ph");
      		document.getElementById("uom_of_bath_ph").focus();
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
