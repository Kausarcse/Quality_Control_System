function Dyeing_Form_Validation()
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
		

		
}
