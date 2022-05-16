

function Ready_For_Printing_Form_Validation()
{


		if(document.getElementById("pp_number_value").value=="select")
		{
      		alert("Please Select Pp Number");
      		document.getElementById("pp_number_value").focus();
      		return false;
		}
		else if(document.getElementById("version_number").value=="select")
		{
      		alert("Please Select Version Number");
      		document.getElementById("version_number").focus();
      		return false;
		}
		/*else if(document.getElementById("customer_name").value=="select")
		{
      		alert("Please Select Customer Name");
      		document.getElementById("customer_name").focus();
      		return false;
		}
		else if(document.getElementById("color").value=="select")
		{
      		alert("Please Select Color");
      		document.getElementById("color").focus();
      		return false;
		}
		else if(document.getElementById("finish_width_in_inch").value.trim()=="")
		{
      		alert("Please Provide Finish Width");
      		document.getElementById("finish_width_in_inch").focus();
      		return false;
		}*/
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
		
		/*else if(document.getElementById("whiteness_min_value").value.trim()=="")
		{
      		alert("Please Provide Whiteness Min Value");
      		document.getElementById("whiteness_min_value").focus();
      		return false;
		}
		else if(isNaN(document.getElementById("whiteness_min_value").value.trim()))
		{
      		alert("Whiteness Min Value should be Numeric");
			document.getElementById("whiteness_min_value").value="";
      		document.getElementById("whiteness_min_value").focus();
      		return false;
		}
		else if(document.getElementById("whiteness_max_value").value.trim()=="")
		{
      		alert("Please Provide Whiteness Max Value");
      		document.getElementById("whiteness_max_value").focus();
      		return false;
		}
		else if(isNaN(document.getElementById("whiteness_max_value").value.trim()))
		{
      		alert("Whiteness Max Value should be Numeric");
			document.getElementById("whiteness_max_value").value="";
      		document.getElementById("whiteness_max_value").focus();
      		return false;
		}
		
		else if(document.getElementById("bowing_and_skew_min_value").value.trim()=="")
		{
      		alert("Please Provide Bowing And Skew Min Value");
      		document.getElementById("bowing_and_skew_min_value").focus();
      		return false;
		}
		else if(isNaN(document.getElementById("bowing_and_skew_min_value").value.trim()))
		{
      		alert("Bowing And Skew Min Value should be Numeric");
			document.getElementById("bowing_and_skew_min_value").value="";
      		document.getElementById("bowing_and_skew_min_value").focus();
      		return false;
		}
		else if(document.getElementById("bowing_and_skew_max_value").value.trim()=="")
		{
      		alert("Please Provide Bowing And Skew Max Value");
      		document.getElementById("bowing_and_skew_max_value").focus();
      		return false;
		}
		else if(isNaN(document.getElementById("bowing_and_skew_max_value").value.trim()))
		{
      		alert("Bowing And Skew Max Value should be Numeric");
			document.getElementById("bowing_and_skew_max_value").value="";
      		document.getElementById("bowing_and_skew_max_value").focus();
      		return false;
		}
		
		else if(document.getElementById("ph_min_value").value.trim()=="")
		{
      		alert("Please Provide Ph Min Value");
      		document.getElementById("ph_min_value").focus();
      		return false;
		}
		else if(isNaN(document.getElementById("ph_min_value").value.trim()))
		{
      		alert("Ph Min Value should be Numeric");
			document.getElementById("ph_min_value").value="";
      		document.getElementById("ph_min_value").focus();
      		return false;
		}
		else if(document.getElementById("ph_max_value").value.trim()=="")
		{
      		alert("Please Provide Ph Max Value");
      		document.getElementById("ph_max_value").focus();
      		return false;
		}
		else if(isNaN(document.getElementById("ph_max_value").value.trim()))
		{
      		alert("Ph Max Value should be Numeric");
			document.getElementById("ph_max_value").value="";
      		document.getElementById("ph_max_value").focus();
      		return false;
		}
*/
}

