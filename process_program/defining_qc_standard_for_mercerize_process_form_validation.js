
function Mercerize_Form_Validation()
{
		if(document.getElementById("pp_number_value").value=="select")
		{
      		alert("Please Select PP Number");
      		document.getElementById("pp_number_value").focus();
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
      		alert("Please Provide Finish Width");
      		document.getElementById("finish_width_in_inch").focus();
      		return false;
		}
		else if(isNaN(document.getElementById("finish_width_in_inch").value.trim()))
		{
      		alert("Finish Width should be Numeric");
			document.getElementById("finish_width_in_inch").value="";
      		document.getElementById("finish_width_in_inch").focus();
      		return false;
		}
		else if(document.getElementById("standard_for_which_process").value=="select")
		{
      		alert("Please Select Standard For Which Process");
      		document.getElementById("standard_for_which_process").focus();
      		return false;
		}*/
		
		/*else if(document.getElementById("absorbency_value").value.trim()=="")
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
		else if(document.getElementById("absorbency_tolerance_range_math_operator").value=="select")
		{
      		alert("Please Select Absorbency Tolerance Range Math Operator");
      		document.getElementById("absorbency_tolerance_range_math_operator").focus();
      		return false;
		}
		else if(document.getElementById("absorbency_tolerance_value").value.trim()=="")
		{
      		alert("Please Provide Absorbency Tolerance Value");
      		document.getElementById("absorbency_tolerance_value").focus();
      		return false;
		}
		else if(isNaN(document.getElementById("absorbency_tolerance_value").value.trim()))
		{
      		alert("Absorbency Tolerance Value should be Numeric");
			document.getElementById("absorbency_tolerance_value").value="";
      		document.getElementById("absorbency_tolerance_value").focus();
      		return false;
		}
		else if(document.getElementById("absorbency_min_value").value.trim()=="")
		{
      		alert("Please Provide Absorbency Min Value");
      		document.getElementById("absorbency_min_value").focus();
      		return false;
		}
		else if(isNaN(document.getElementById("absorbency_min_value").value.trim()))
		{
      		alert("Absorbency Min Value should be Numeric");
			document.getElementById("absorbency_min_value").value="";
      		document.getElementById("absorbency_min_value").focus();
      		return false;
		}
		else if(document.getElementById("absorbency_max_value").value.trim()=="")
		{
      		alert("Please Provide Absorbency Max Value");
      		document.getElementById("absorbency_max_value").focus();
      		return false;
		}
		else if(isNaN(document.getElementById("absorbency_max_value").value.trim()))
		{
      		alert("Absorbency Max Value should be Numeric");
			document.getElementById("absorbency_max_value").value="";
      		document.getElementById("absorbency_max_value").focus();
      		return false;
		}*/
		/*else if(document.getElementById("uom_of_absorbency").value.trim()=="")
		{
      		alert("Please Provide Uom Of Absorbency");
      		document.getElementById("uom_of_absorbency").focus();
      		return false;
		}*/
		/*else if(document.getElementById("residual_sizing_material_value").value.trim()=="")
		{
      		alert("Please Provide  residual_sizing_material Value");
      		document.getElementById("residual_sizing_material_value").focus();
      		return false;
		}
		else if(isNaN(document.getElementById("residual_sizing_material_value").value.trim()))
		{
      		alert("residual_sizing_material Value should be Numeric");
			document.getElementById("residual_sizing_material_value").value="";
      		document.getElementById("residual_sizing_material_value").focus();
      		return false;
		}
		else if(document.getElementById("residual_sizing_material_tolerance_range_math_operator").value=="select")
		{
      		alert("Please Select  residual_sizing_material Tolerance Range Math Operator");
      		document.getElementById("residual_sizing_material_tolerance_range_math_operator").focus();
      		return false;
		}
		else if(document.getElementById("residual_sizing_material_tolerance_value").value.trim()=="")
		{
      		alert("Please Provide  residual_sizing_material Tolerance Value");
      		document.getElementById("residual_sizing_material_tolerance_value").focus();
      		return false;
		}
		else if(isNaN(document.getElementById("residual_sizing_material_tolerance_value").value.trim()))
		{
      		alert(" residual_sizing_material Tolerance Value should be Numeric");
			document.getElementById("residual_sizing_material_tolerance_value").value="";
      		document.getElementById("residual_sizing_material_tolerance_value").focus();
      		return false;
		}
		else if(document.getElementById("residual_sizing_material_min_value").value.trim()=="")
		{
      		alert("Please Provide  residual_sizing_material Min Value");
      		document.getElementById("residual_sizing_material_min_value").focus();
      		return false;
		}
		else if(isNaN(document.getElementById("residual_sizing_material_min_value").value.trim()))
		{
      		alert(" residual_sizing_material Min Value should be Numeric");
			document.getElementById("residual_sizing_material_min_value").value="";
      		document.getElementById("residual_sizing_material_min_value").focus();
      		return false;
		}
		else if(document.getElementById("residual_sizing_material_max_value").value.trim()=="")
		{
      		alert("Please Provide  residual_sizing_material Max Value");
      		document.getElementById("residual_sizing_material_max_value").focus();
      		return false;
		}
		else if(isNaN(document.getElementById("residual_sizing_material_max_value").value.trim()))
		{
      		alert(" residual_sizing_material Max Value should be Numeric");
			document.getElementById("residual_sizing_material_max_value").value="";
      		document.getElementById("residual_sizing_material_max_value").focus();
      		return false;
		}*/
		/*else if(document.getElementById("uom_of_residual_sizing_material").value.trim()=="")
		{
      		alert("Please Provide Uom Of residual_sizing_material");
      		document.getElementById("uom_of_residual_sizing_material").focus();
      		return false;
		}*/
		/*else if(document.getElementById("whiteness_value").value.trim()=="")
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
		else if(document.getElementById("whiteness_tolerance_range_math_operator").value=="select")
		{
      		alert("Please Select Whiteness Tolerance Range Math Operator");
      		document.getElementById("whiteness_tolerance_range_math_operator").focus();
      		return false;
		}
		else if(document.getElementById("whiteness_tolerance_value").value.trim()=="")
		{
      		alert("Please Provide Whiteness Tolerance Value");
      		document.getElementById("whiteness_tolerance_value").focus();
      		return false;
		}
		else if(isNaN(document.getElementById("whiteness_tolerance_value").value.trim()))
		{
      		alert("Whiteness Tolerance Value should be Numeric");
			document.getElementById("whiteness_tolerance_value").value="";
      		document.getElementById("whiteness_tolerance_value").focus();
      		return false;
		}
		else if(document.getElementById("whiteness_min_value").value.trim()=="")
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
		}*/
		/*else if(document.getElementById("uom_of_whiteness").value=="select")
		{
      		alert("Please Select Uom Of Whiteness");
      		document.getElementById("uom_of_whiteness").focus();
      		return false;
		}*/
		
		/*else if(document.getElementById("ph_value").value.trim()=="")
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
		else if(document.getElementById("ph_tolerance_range_math_operator").value=="select")
		{
      		alert("Please Select Ph Tolerance Range Math Operator");
      		document.getElementById("ph_tolerance_range_math_operator").focus();
      		return false;
		}
		else if(document.getElementById("ph_tolerance_value").value.trim()=="")
		{
      		alert("Please Provide Ph Tolerance Value");
      		document.getElementById("ph_tolerance_value").focus();
      		return false;
		}
		else if(isNaN(document.getElementById("ph_tolerance_value").value.trim()))
		{
      		alert("Ph Tolerance Value should be Numeric");
			document.getElementById("ph_tolerance_value").value="";
      		document.getElementById("ph_tolerance_value").focus();
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
		}*/
		/*else if(document.getElementById("uom_of_ph").value.trim()=="")
		{
      		alert("Please Provide Uom Of Ph");
      		document.getElementById("uom_of_ph").focus();
      		return false;
		}*/
}

