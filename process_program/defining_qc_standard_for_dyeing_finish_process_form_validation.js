

function Dyeing_Finish_Form_Validation()
{
		if(document.getElementById("pp_number_value").value.trim()=="")
		{
      		alert("Please Provide PP Number");
      		document.getElementById("pp_number_value").focus();
      		return false;
		}
		else if(document.getElementById("version_number").value.trim()=="")
		{
      		alert("Please Provide Version Number");
      		document.getElementById("version_number").focus();
      		return false;
		}
}