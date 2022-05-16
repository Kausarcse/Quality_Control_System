

function PP_Wise_Version_Creation_Form_Validation()
{


		if(document.getElementById("pp_number").value=="select")
		{
      		alert("Please Select Pp Number");
      		document.getElementById("pp_number").focus();
      		return false;
		}
		else if(document.getElementById("version_name").value=="select")
		{
      		alert("Please Select Version Name");
      		document.getElementById("version_name").focus();
      		return false;
		}
		// else if(document.getElementById("style_name").value.trim()=="")
		// {
  //     		alert("Please Provide style name");
  //     		document.getElementById("style_name").focus();
  //     		return false;
		// }
		else if(document.getElementById("color").value=="select")
		{
      		alert("Please Select Color");
      		document.getElementById("color").focus();
      		return false;
		}
		else if(document.getElementById("construction_name").value=="select")
		{
      		alert("Please Select Construction Name");
      		document.getElementById("construction_name").focus();
      		return false;
		}
		/*else if(document.getElementById("no_of_weft_yarn_picking").value=="select")
		{
      		alert("Please Select No Of Weft Yarn Picking");
      		document.getElementById("no_of_weft_yarn_picking").focus();
      		return false;
		}*/
		else if(document.getElementById("greige_width_in_inch").value.trim()=="")
		{
      		alert("Please Provide Greige Width In Inch");
      		document.getElementById("greige_width_in_inch").focus();
      		return false;
		}
		else if(isNaN(document.getElementById("greige_width_in_inch").value.trim()))
		{
      		alert("Greige Width In Inch should be Numeric");
			document.getElementById("greige_width_in_inch").value="";
      		document.getElementById("greige_width_in_inch").focus();
      		return false;
		}
		else if(document.getElementById("finish_width_in_inch").value.trim()=="")
		{
      		alert("Please Provide Finish Width In Inch");
      		document.getElementById("finish_width_in_inch").focus();
      		return false;
		}
		else if(isNaN(document.getElementById("finish_width_in_inch").value.trim()))
		{
      		alert("Finish Width In Inch should be Numeric");
			document.getElementById("finish_width_in_inch").value="";
      		document.getElementById("finish_width_in_inch").focus();
      		return false;
		}
		else if(document.getElementById("process_technique_name").value=="select")
		{
      		alert("Please Select Process Technique Name");
      		document.getElementById("process_technique_name").focus();
      		return false;
		}
		/*else if(document.getElementById("percentage_of_cotton_content").value.trim()=="")
		{
      		
      		document.getElementById("percentage_of_cotton_content").value="0";
      		
		}
		else if(isNaN(document.getElementById("percentage_of_cotton_content").value.trim()))
		{
      		
			document.getElementById("percentage_of_cotton_content").value="0";
      		document.getElementById("percentage_of_cotton_content").focus();
      		
		}
		else if(document.getElementById("percentage_of_polyester_content").value.trim()=="")
		{
      		
      		document.getElementById("percentage_of_polyester_content").value="0";
		}
		else if(isNaN(document.getElementById("percentage_of_polyester_content").value.trim()))
		{
      		document.getElementById("percentage_of_polyester_content").value="0";
      		document.getElementById("percentage_of_polyester_content").focus();
      		return false;
		}
		
		else if(document.getElementById("percentage_of_other_fiber_content").value.trim()=="")
		{
      		document.getElementById("percentage_of_other_fiber_content").value="0";
      		document.getElementById("percentage_of_other_fiber_content").focus();
      		
		}
		else if(isNaN(document.getElementById("percentage_of_other_fiber_content").value.trim()))
		{
      		document.getElementById("percentage_of_other_fiber_content").value="0";
      		document.getElementById("percentage_of_other_fiber_content").focus();
      		
		}*/
		else if(document.getElementById("pp_quantity").value.trim()=="")
		{
      		alert("Please Provide Quantity");
      		document.getElementById("pp_quantity").focus();
      		return false;
		}
		else if(isNaN(document.getElementById("pp_quantity").value.trim()))
		{
      		alert("Quantity should be Numeric");
			document.getElementById("pp_quantity").value="";
      		document.getElementById("pp_quantity").focus();
      		return false;
		}

}

