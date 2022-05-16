

function designation_Form_Validation()
{
    if(document.getElementById("designation_name").value.trim()=="")
		{
      		alert("Please Provide Designation Name");
      		document.getElementById("designation_name").focus();
      		return false;
		}
		
}

