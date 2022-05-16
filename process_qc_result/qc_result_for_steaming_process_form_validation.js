function Steaming_Form_Validation()
{
	if(document.getElementById("pp_number").value=="select")
	{
		  alert("Please Select PP Number");
		  document.getElementById("pp_number").focus();
		  return false;
	}
	else if(document.getElementById("version_number").value=="select")
	{
		  alert("Please Select Version Number");
		  document.getElementById("version_number").focus();
		  return false;
	}
	else if(document.getElementById("customer_name").value.trim()=="")
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
}
