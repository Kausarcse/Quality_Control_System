

function Edit_Process_Program_Info_Form_Validation()
{


		
		if(document.getElementById("pp_number").value.trim()=="")
		{
      		alert("Please Provide Pp Number");
      		document.getElementById("pp_number").focus();
      		return false;
		}
		else if(document.getElementById("pp_description").value.trim()=="")
		{
      		alert("Please Provide Pp Description");
      		document.getElementById("pp_description").focus();
      		return false;
		}
		else if(document.getElementById("customer_name").value=="select")
		{
      		alert("Please Select Customer Name");
      		document.getElementById("customer_name").focus();
      		return false;
		}
		else if(document.getElementById("greige_demand_no").value.trim()=="")
		{
      		alert("Please Provide Greige Demand No");
      		document.getElementById("greige_demand_no").focus();
      		return false;
		}
		/*else if(document.getElementById("week_in_year").value.trim()=="")
		{
      		alert("Please Provide Week In Year");
      		document.getElementById("week_in_year").focus();
      		return false;
		}
		else if(isNaN(document.getElementById("week_in_year").value.trim()))
		{
      		alert("Week In Year should be Numeric");
			document.getElementById("week_in_year").value="";
      		document.getElementById("week_in_year").focus();
      		return false;
		}*/
		else if(document.getElementById("design").value.trim()=="")
		{
      		alert("Please Provide Design");
      		document.getElementById("design").focus();
      		return false;
		}

		else if(document.getElementById("remarks").value.trim()=="")
		{
      		alert("Please Give Remarks to Change");
      		document.getElementById("remarks").focus();
      		return false;
		}

}

