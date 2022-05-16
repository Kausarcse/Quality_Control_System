

function Process_Program_Info_Form_Validation()
{


		if(document.getElementById("pp_creation_date").value.trim()=="")
		{
      		alert("Please Provide Pp Creation Date");
      		document.getElementById("pp_creation_date").focus();
      		return false;
		}


		var list_of_month_for_pp_creation_date = ["January","February","March","April","May","June","July","August","September","October","November","December"];
		var date_field_value_for_pp_creation_date = document.getElementById("pp_creation_date").value.trim();
      	var date_format_for_pp_creation_date = /^(0?[1-9]|[12][0-9]|3[01])[\/\-](0?[1-9]|1[012])[\/\-]\d{4}$/;

		if(date_field_value_for_pp_creation_date.match(date_format_for_pp_creation_date))
      	{

      			//Test which seperator is used '/' or '-'

 				var slash_operator_for_pp_creation_date = date_field_value_for_pp_creation_date.split('/');
 				var hyphen_operator_for_pp_creation_date = date_field_value_for_pp_creation_date.split('-'); 

 				length_of_slash_operator_for_pp_creation_date = slash_operator_for_pp_creation_date.length;
 				length_of_hyphen_operator_for_pp_creation_date = hyphen_operator_for_pp_creation_date.length;

 				// Extract the string into month, date and year  
 				if(length_of_slash_operator_for_pp_creation_date > 1)
 				{

 						var splitted_date_for_pp_creation_date = date_field_value_for_pp_creation_date.split('/'); 

 				}
 				else if(length_of_hyphen_operator_for_pp_creation_date > 1) 
 				{

 						var splitted_date_for_pp_creation_date = date_field_value_for_pp_creation_date.split('-'); 

 				}

 				var dd_for_pp_creation_date = parseInt(splitted_date_for_pp_creation_date[0]);
 				var mm_for_pp_creation_date  = parseInt(splitted_date_for_pp_creation_date[1]);
 				var yy_for_pp_creation_date = parseInt(splitted_date_for_pp_creation_date[2]);

 				// Create list of days of a month [assume there is no leap year by default] 
 				var list_of_days_for_pp_creation_date = [31,28,31,30,31,30,31,31,30,31,30,31];

 				if(mm_for_pp_creation_date==1 || mm_for_pp_creation_date>2)
 				{

 						if(dd_for_pp_creation_date>list_of_days_for_pp_creation_date[mm_for_pp_creation_date-1]) 
 						{

 								alert(list_of_month_for_pp_creation_date[mm_for_pp_creation_date-1] + " month can't have "+ dd_for_pp_creation_date + " days");
								document.getElementById('pp_creation_date').focus();
 								return false;

 						}

 				}
 				if(mm_for_pp_creation_date==2)  
 				{

 						var leaf_year_for_pp_creation_date = false; 

 						if( (!(yy_for_pp_creation_date % 4) && yy_for_pp_creation_date % 100) || !(yy_for_pp_creation_date % 400))
 						{
 								leaf_year_for_pp_creation_date = true;
 						}
 						if( (leaf_year_for_pp_creation_date==false) && (dd_for_pp_creation_date>=29) )
 						{

 								alert("This is not February month of leaf year. So it can't have "+ dd_for_pp_creation_date + " days means it must be less than equal 28 days.");
								document.getElementById("pp_creation_date").focus();
 								return false;

 						}
 						if((leaf_year_for_pp_creation_date==true) && (dd_for_pp_creation_date>29) )  
 						{

								alert("This is February month of leaf year. So it can't have more than 29 days. But you have given "+ dd_for_pp_creation_date + " days"); 
								document.getElementById("pp_creation_date").focus();
 								return false;

 						}
 				} // End of if(mm_for_pp_creation_date==2) 

 		} // End of if(date_field_value_for_pp_creation_date.match(dateformat))  
 		else
 		{

      			//Test which seperator is used '/' or '-'

 				var slash_operator_for_pp_creation_date = date_field_value_for_pp_creation_date.split('/');
 				var hyphen_operator_for_pp_creation_date = date_field_value_for_pp_creation_date.split('-'); 

 				length_of_slash_operator_for_pp_creation_date = slash_operator_for_pp_creation_date.length;
 				length_of_hyphen_operator_for_pp_creation_date = hyphen_operator_for_pp_creation_date.length;

				if(length_of_slash_operator_for_pp_creation_date > 1 || length_of_hyphen_operator_for_pp_creation_date > 1)
				{

 						// Extract the string into month, date and year  
 						if(length_of_slash_operator_for_pp_creation_date > 1)
 						{

 								var splitted_date_for_pp_creation_date = date_field_value_for_pp_creation_date.split('/'); 

 						}
 						else if(length_of_hyphen_operator_for_pp_creation_date > 1) 
 						{

 								var splitted_date_for_pp_creation_date = date_field_value_for_pp_creation_date.split('-'); 

 						}

 						var dd_for_pp_creation_date = splitted_date_for_pp_creation_date[0];
 						var mm_for_pp_creation_date  = splitted_date_for_pp_creation_date[1];
 						var yy_for_pp_creation_date = splitted_date_for_pp_creation_date[2];

 						if(isNaN(dd_for_pp_creation_date))
						{
								alert("Day what you have provided as "+dd_for_pp_creation_date+" should be of 2 numeric digits");
								document.getElementById("pp_creation_date").focus();
								return false;

						}
						else if(dd_for_pp_creation_date>31)
						{

								alert("Day what you have provided as "+dd_for_pp_creation_date+" can't be more than 31 days");
								document.getElementById("pp_creation_date").focus();
								return false;

						}
						else if(dd_for_pp_creation_date == 0)
						{

								alert("Day what you have provided as "+dd_for_pp_creation_date+" can't be 0 day");
								document.getElementById("pp_creation_date").focus();
								return false;

						}
						else if(isNaN(mm_for_pp_creation_date))
						{

								alert("Month what you have provided as "+mm_for_pp_creation_date+" should be of 2 numeric digits");
								document.getElementById("pp_creation_date").focus();
								return false;

						}
						else if(mm_for_pp_creation_date>12)
						{

								alert("Month what you have provided as "+mm_for_pp_creation_date+" can't be more than 12 months");
								document.getElementById("pp_creation_date").focus();
								return false;

						}
						else if(mm_for_pp_creation_date == 0)
						{

								alert("Month what you have provided as "+mm_for_pp_creation_date+" can't be 0 month");
								document.getElementById("pp_creation_date").focus();
								return false;

						}
						else if(isNaN(yy_for_pp_creation_date))
						{

								alert("Year what you have provided as "+yy_for_pp_creation_date+" should be of 4 numeric digits");
								document.getElementById("pp_creation_date").focus();
								return false;

						}
						else if(yy_for_pp_creation_date == 0)
						{

								alert("Year what you have provided as "+yy_for_pp_creation_date+" can't be 0 year");
								document.getElementById("pp_creation_date").focus();
								return false;

						}
						else if(yy_for_pp_creation_date.length != 4)
						{

								alert("Year what you have provided as "+yy_for_pp_creation_date+" should be of 4 numeric digits");
								document.getElementById("pp_creation_date").focus();
								return false;

						}


				} // End of if(length_of_slash_operator_for_pp_creation_date > 1 || length_of_hyphen_operator_for_pp_creation_date > 1)
				else
				{

						alert("This is Invalid Date Format ! Date format should be dd/mm/yyyy OR dd-mm-yyyy within actual range of day,month and Year format.");
						document.getElementById("pp_creation_date").focus();
						return false; 

				}


		} // End of else  // This is end of else of if(date_field_value.match(date_format))

		if(document.getElementById("pp_number").value.trim()=="")
		{
      		alert("Please Provide Pp Number");
      		document.getElementById("pp_number").focus();
      		return false;
		}
		else if(document.getElementById("pp_description").value.trim()=="")
		{
      		alert("Please Provide Pp Description");
      		document.getElementById("pp_description").focus();
      		return false;
		}
		else if(document.getElementById("customer_name").value=="select")
		{
      		alert("Please Select Customer Name");
      		document.getElementById("customer_name").focus();
      		return false;
		}
		else if(document.getElementById("greige_demand_no").value.trim()=="")
		{
      		alert("Please Provide Greige Demand No");
      		document.getElementById("greige_demand_no").focus();
      		return false;
		}
		/*else if(document.getElementById("week_in_year").value.trim()=="")
		{
      		alert("Please Provide Week In Year");
      		document.getElementById("week_in_year").focus();
      		return false;
		}
		else if(isNaN(document.getElementById("week_in_year").value.trim()))
		{
      		alert("Week In Year should be Numeric");
			document.getElementById("week_in_year").value="";
      		document.getElementById("week_in_year").focus();
      		return false;
		}*/
		else if(document.getElementById("design").value.trim()=="")
		{
      		alert("Please Provide Design");
      		document.getElementById("design").focus();
      		return false;
		}

}

