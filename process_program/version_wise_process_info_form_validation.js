

function Form_Validation()
{


		if(document.getElementById("pp_number").value=="select")
		{
      		alert("Please Select Pp Number");
      		document.getElementById("pp_number").focus();
      		return false;
		}
		else if(document.getElementById("version_name").value=="select")
		{
      		alert("Please Select Version Name");
      		document.getElementById("version_name").focus();
      		return false;
		}
		
		var possible_total_process = document.getElementById("possible_number_of_process").value;
		
		for(var i=1;i<=possible_total_process;i++) // Looping till all possibles Process Names and Serial No.
		{
			
			
			var process_name = "process_name_"+i;

			if(typeof(document.getElementById(process_name)) != 'undefined' && document.getElementById(process_name) != null) 
			{
				
				if(document.getElementById(process_name).value=="select")
				{
					alert("Please Select Process Name");
					document.getElementById(process_name).focus();
					return false;
				}
				
			} // End of if(typeof(process_name) != 'undefined' && process_name != null)
			
			
			var process_serial = "process_serial_"+i;
			
			if(typeof(document.getElementById(process_serial)) != 'undefined' && document.getElementById(process_serial) != null) // This is for deleting Alternative Field of Date if exists
			{
				
				if(document.getElementById(process_serial).value=="")
				{
					alert("Please Provide Process Serial Number");
					document.getElementById(process_serial).focus();
					return false;
				}
				
			} // End of if(typeof(process_serial) != 'undefined' && process_serial != null)
			
	    } //End of for(var i=1;i<possible_total_process;i++) // Looping till all possibles Process Names and Serial No.



} // End of function Form_Validation()

