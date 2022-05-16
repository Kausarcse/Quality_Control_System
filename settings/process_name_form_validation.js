

function Form_Validation()
{


		if(document.getElementById("process_name").value.trim()=="")
		{
      		alert("Please Provide Process Name");
      		document.getElementById("process_name").focus();
      		return false;
		}
		else if(document.getElementById("description_of_process").value.trim()=="")
		{
      		alert("Please Provide Description Of Process");
      		document.getElementById("description_of_process").focus();
      		return false;
		}

}

