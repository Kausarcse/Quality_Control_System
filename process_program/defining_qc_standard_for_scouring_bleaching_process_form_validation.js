

function Scouring_Bleaching_Form_Validation()
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
		
		/*else if(document.getElementById("absorbency_min_value").value.trim()=="")
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
		}
		else if(document.getElementById("uom_of_absorbency").value.trim()=="")
		{
      		alert("Please Provide Uom Of Absorbency");
      		document.getElementById("uom_of_absorbency").focus();
      		return false;
		}
		
		else if(document.getElementById("residual_sizing_material_min_value").value.trim()=="")
		{
      		alert("Please Provide Residual Sizing Material Min Value");
      		document.getElementById("residual_sizing_material_min_value").focus();
      		return false;
		}
		else if(isNaN(document.getElementById("residual_sizing_material_min_value").value.trim()))
		{
      		alert("Residual Sizing Material Min Value should be Numeric");
			document.getElementById("residual_sizing_material_min_value").value="";
      		document.getElementById("residual_sizing_material_min_value").focus();
      		return false;
		}
		else if(document.getElementById("residual_sizing_material_max_value").value.trim()=="")
		{
      		alert("Please Provide Residual Sizing Material Max Value");
      		document.getElementById("residual_sizing_material_max_value").focus();
      		return false;
		}
		else if(isNaN(document.getElementById("residual_sizing_material_max_value").value.trim()))
		{
      		alert("Residual Sizing Material Max Value should be Numeric");
			document.getElementById("residual_sizing_material_max_value").value="";
      		document.getElementById("residual_sizing_material_max_value").focus();
      		return false;
		}
		else if(document.getElementById("uom_of_residual_sizing_material").value.trim()=="")
		{
      		alert("Please Provide Uom Of Residual Sizing Material");
      		document.getElementById("uom_of_residual_sizing_material").focus();
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
		}
		else if(document.getElementById("uom_of_whiteness").value=="select")
		{
      		alert("Please Select Uom Of Whiteness");
      		document.getElementById("uom_of_whiteness").focus();
      		return false;
		}
		
		else if(document.getElementById("pilling_iso_12945_2_min_value").value.trim()=="")
		{
      		alert("Please Provide Pilling Iso 12945 2 Min Value");
      		document.getElementById("pilling_iso_12945_2_min_value").focus();
      		return false;
		}
		else if(isNaN(document.getElementById("pilling_iso_12945_2_min_value").value.trim()))
		{
      		alert("Pilling Iso 12945 2 Min Value should be Numeric");
			document.getElementById("pilling_iso_12945_2_min_value").value="";
      		document.getElementById("pilling_iso_12945_2_min_value").focus();
      		return false;
		}
		else if(document.getElementById("pilling_iso_12945_2_max_value").value.trim()=="")
		{
      		alert("Please Provide Pilling Iso 12945 2 Max Value");
      		document.getElementById("pilling_iso_12945_2_max_value").focus();
      		return false;
		}
		else if(isNaN(document.getElementById("pilling_iso_12945_2_max_value").value.trim()))
		{
      		alert("Pilling Iso 12945 2 Max Value should be Numeric");
			document.getElementById("pilling_iso_12945_2_max_value").value="";
      		document.getElementById("pilling_iso_12945_2_max_value").focus();
      		return false;
		}
		else if(document.getElementById("uom_of_pilling_iso_12945_2").value.trim()=="")
		{
      		alert("Please Provide Uom Of Pilling Iso 12945 2");
      		document.getElementById("uom_of_pilling_iso_12945_2").focus();
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
		else if(document.getElementById("uom_of_ph").value.trim()=="")
		{
      		alert("Please Provide Uom Of Ph");
      		document.getElementById("uom_of_ph").focus();
      		return false;
		}*/

}

