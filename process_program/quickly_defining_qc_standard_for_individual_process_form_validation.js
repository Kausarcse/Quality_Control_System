

function Quickly_Defining_QC_Standard_For_Individual_Process_Form_Validation()
{

		
		if(document.getElementById("pp_number_for_searching").value=="select")
		{
      		alert("Please Select PP Number");
      		document.getElementById("pp_number_for_searching").focus();
      		return false;
		}
		else if(document.getElementById("version_number_for_searching").value=="select")
		{
      		alert("Please Select Version Number");
      		document.getElementById("version_number_for_searching").focus();
      		return false;
		}
		else if(document.getElementById("standard_for_for_searching").value=="select")
		{
      		alert("Please Select Standard For");
      		document.getElementById("standard_for_for_searching").focus();
      		return false;
		}

}

