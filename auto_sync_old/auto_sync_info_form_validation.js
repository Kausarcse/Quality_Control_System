

function Auto_Sync_Form_Validation()
{


		if(document.getElementById("customer_name").value=="select")
		{
      		alert("Please Select Customer Name");
      		document.getElementById("customer_name").focus();
      		return false;
		}
		else if(document.getElementById("version_name").value=="select")
		{
      		alert("Please Select Version Name");
      		document.getElementById("version_name").focus();
      		return false;
		}
		else if(document.getElementById("color").value=="select")
		{
      		alert("Please Select Color");
      		document.getElementById("color").focus();
      		return false;
		}
		else if(document.getElementById("process_name").value=="select")
		{
      		alert("Please Select Process  Name");
      		document.getElementById("process_name").focus();
      		return false;
		}
		else if(document.getElementById("process_serial").value.trim()=="")
		{
      		alert("Please Provide Process Serial");
      		document.getElementById("process_serial").focus();
      		return false;
		}

		else if(isNaN(document.getElementById("process_serial").value.trim()))
		{
      		alert("Process Serial should be Numeric");
			document.getElementById("process_serial").value="";
      		document.getElementById("process_serial").focus();
      		return false;
		}

		else if(document.getElementById("process_technique_name").value=="select")
		{
      		alert("Please Select Process Technique Name");
      		document.getElementById("process_technique_name").focus();
      		return false;
		}

}

