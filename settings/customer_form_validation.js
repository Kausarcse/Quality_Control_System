

function Customer_Form_Validation()
{


		if(document.getElementById("customer_name").value.trim()=="")
		{
      		alert("Please Provide Customer Name");
      		document.getElementById("customer_name").focus();
      		return false;
		}
		else if(document.getElementById("customer_address").value.trim()=="")
		{
      		alert("Please Provide Customer Address");
      		document.getElementById("customer_address").focus();
      		return false;
		}
		else if(document.getElementById("country_of_origin").value=="select")
		{
      		alert("Please Select Country Of Origin");
      		document.getElementById("country_of_origin").focus();
      		return false;
		}
		else if(document.getElementById("key_account_manager_name").value=="select")
		{
      		alert("Please Select Key Account Manager Name");
      		document.getElementById("key_account_manager_name").focus();
      		return false;
		}
		else if(document.getElementById("customer_type").value=="select")
		{
      		alert("Please Select Customer Type");
      		document.getElementById("customer_type").focus();
      		return false;
		}

}

