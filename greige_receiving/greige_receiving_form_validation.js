

function Greige_Receiving_Form_Validation()
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
		else if(document.getElementById("greige_receiving_date").value.trim()=="")
		{
      		alert("Please Provide Greige Receiving Date");
      		document.getElementById("greige_receiving_date").focus();
      		return false;
		}


		var list_of_month_for_greige_receiving_date = ["January","February","March","April","May","June","July","August","September","October","November","December"];
		var date_field_value_for_greige_receiving_date = document.getElementById("greige_receiving_date").value.trim();
      	var date_format_for_greige_receiving_date = /^(0?[1-9]|[12][0-9]|3[01])[\/\-](0?[1-9]|1[012])[\/\-]\d{4}$/;

		if(date_field_value_for_greige_receiving_date.match(date_format_for_greige_receiving_date))
      	{

      			//Test which seperator is used '/' or '-'

 				var slash_operator_for_greige_receiving_date = date_field_value_for_greige_receiving_date.split('/');
 				var hyphen_operator_for_greige_receiving_date = date_field_value_for_greige_receiving_date.split('-'); 

 				length_of_slash_operator_for_greige_receiving_date = slash_operator_for_greige_receiving_date.length;
 				length_of_hyphen_operator_for_greige_receiving_date = hyphen_operator_for_greige_receiving_date.length;

 				// Extract the string into month, date and year  
 				if(length_of_slash_operator_for_greige_receiving_date > 1)
 				{

 						var splitted_date_for_greige_receiving_date = date_field_value_for_greige_receiving_date.split('/'); 

 				}
 				else if(length_of_hyphen_operator_for_greige_receiving_date > 1) 
 				{

 						var splitted_date_for_greige_receiving_date = date_field_value_for_greige_receiving_date.split('-'); 

 				}

 				var dd_for_greige_receiving_date = parseInt(splitted_date_for_greige_receiving_date[0]);
 				var mm_for_greige_receiving_date  = parseInt(splitted_date_for_greige_receiving_date[1]);
 				var yy_for_greige_receiving_date = parseInt(splitted_date_for_greige_receiving_date[2]);

 				// Create list of days of a month [assume there is no leap year by default] 
 				var list_of_days_for_greige_receiving_date = [31,28,31,30,31,30,31,31,30,31,30,31];

 				if(mm_for_greige_receiving_date==1 || mm_for_greige_receiving_date>2)
 				{

 						if(dd_for_greige_receiving_date>list_of_days_for_greige_receiving_date[mm_for_greige_receiving_date-1]) 
 						{

 								alert(list_of_month_for_greige_receiving_date[mm_for_greige_receiving_date-1] + " month can't have "+ dd_for_greige_receiving_date + " days");
								document.getElementById('greige_receiving_date').focus();
 								return false;

 						}

 				}
 				if(mm_for_greige_receiving_date==2)  
 				{

 						var leaf_year_for_greige_receiving_date = false; 

 						if( (!(yy_for_greige_receiving_date % 4) && yy_for_greige_receiving_date % 100) || !(yy_for_greige_receiving_date % 400))
 						{
 								leaf_year_for_greige_receiving_date = true;
 						}
 						if( (leaf_year_for_greige_receiving_date==false) && (dd_for_greige_receiving_date>=29) )
 						{

 								alert("This is not February month of leaf year. So it can't have "+ dd_for_greige_receiving_date + " days means it must be less than equal 28 days.");
								document.getElementById("greige_receiving_date").focus();
 								return false;

 						}
 						if((leaf_year_for_greige_receiving_date==true) && (dd_for_greige_receiving_date>29) )  
 						{

								alert("This is February month of leaf year. So it can't have more than 29 days. But you have given "+ dd_for_greige_receiving_date + " days"); 
								document.getElementById("greige_receiving_date").focus();
 								return false;

 						}
 				} // End of if(mm_for_greige_receiving_date==2) 

 		} // End of if(date_field_value_for_greige_receiving_date.match(dateformat))  
 		else
 		{

      			//Test which seperator is used '/' or '-'

 				var slash_operator_for_greige_receiving_date = date_field_value_for_greige_receiving_date.split('/');
 				var hyphen_operator_for_greige_receiving_date = date_field_value_for_greige_receiving_date.split('-'); 

 				length_of_slash_operator_for_greige_receiving_date = slash_operator_for_greige_receiving_date.length;
 				length_of_hyphen_operator_for_greige_receiving_date = hyphen_operator_for_greige_receiving_date.length;

				if(length_of_slash_operator_for_greige_receiving_date > 1 || length_of_hyphen_operator_for_greige_receiving_date > 1)
				{

 						// Extract the string into month, date and year  
 						if(length_of_slash_operator_for_greige_receiving_date > 1)
 						{

 								var splitted_date_for_greige_receiving_date = date_field_value_for_greige_receiving_date.split('/'); 

 						}
 						else if(length_of_hyphen_operator_for_greige_receiving_date > 1) 
 						{

 								var splitted_date_for_greige_receiving_date = date_field_value_for_greige_receiving_date.split('-'); 

 						}

 						var dd_for_greige_receiving_date = splitted_date_for_greige_receiving_date[0];
 						var mm_for_greige_receiving_date  = splitted_date_for_greige_receiving_date[1];
 						var yy_for_greige_receiving_date = splitted_date_for_greige_receiving_date[2];

 						if(isNaN(dd_for_greige_receiving_date))
						{
								alert("Day what you have provided as "+dd_for_greige_receiving_date+" should be of 2 numeric digits");
								document.getElementById("greige_receiving_date").focus();
								return false;

						}
						else if(dd_for_greige_receiving_date>31)
						{

								alert("Day what you have provided as "+dd_for_greige_receiving_date+" can't be more than 31 days");
								document.getElementById("greige_receiving_date").focus();
								return false;

						}
						else if(dd_for_greige_receiving_date == 0)
						{

								alert("Day what you have provided as "+dd_for_greige_receiving_date+" can't be 0 day");
								document.getElementById("greige_receiving_date").focus();
								return false;

						}
						else if(isNaN(mm_for_greige_receiving_date))
						{

								alert("Month what you have provided as "+mm_for_greige_receiving_date+" should be of 2 numeric digits");
								document.getElementById("greige_receiving_date").focus();
								return false;

						}
						else if(mm_for_greige_receiving_date>12)
						{

								alert("Month what you have provided as "+mm_for_greige_receiving_date+" can't be more than 12 months");
								document.getElementById("greige_receiving_date").focus();
								return false;

						}
						else if(mm_for_greige_receiving_date == 0)
						{

								alert("Month what you have provided as "+mm_for_greige_receiving_date+" can't be 0 month");
								document.getElementById("greige_receiving_date").focus();
								return false;

						}
						else if(isNaN(yy_for_greige_receiving_date))
						{

								alert("Year what you have provided as "+yy_for_greige_receiving_date+" should be of 4 numeric digits");
								document.getElementById("greige_receiving_date").focus();
								return false;

						}
						else if(yy_for_greige_receiving_date == 0)
						{

								alert("Year what you have provided as "+yy_for_greige_receiving_date+" can't be 0 year");
								document.getElementById("greige_receiving_date").focus();
								return false;

						}
						else if(yy_for_greige_receiving_date.length != 4)
						{

								alert("Year what you have provided as "+yy_for_greige_receiving_date+" should be of 4 numeric digits");
								document.getElementById("greige_receiving_date").focus();
								return false;

						}


				} // End of if(length_of_slash_operator_for_greige_receiving_date > 1 || length_of_hyphen_operator_for_greige_receiving_date > 1)
				else
				{

						alert("This is Invalid Date Format ! Date format should be dd/mm/yyyy OR dd-mm-yyyy within actual range of day,month and Year format.");
						document.getElementById("greige_receiving_date").focus();
						return false; 

				}


		} // End of else  // This is end of else of if(date_field_value.match(date_format))

		if(document.getElementById("received_quantity").value.trim()=="")
		{
      		alert("Please Provide Received Quantity");
      		document.getElementById("received_quantity").focus();
      		return false;
		}
		else if(isNaN(document.getElementById("received_quantity").value.trim()))
		{
      		alert("Received Quantity should be Numeric");
			document.getElementById("received_quantity").value="";
      		document.getElementById("received_quantity").focus();
      		return false;
		}
		else if(document.getElementById("warp_yarn_count").value.trim()=="")
		{
      		alert("Please Provide Warp Yarn Count");
      		document.getElementById("warp_yarn_count").focus();
      		return false;
		}
		else if(isNaN(document.getElementById("warp_yarn_count").value.trim()))
		{
      		alert("Warp Yarn Count should be Numeric");
			document.getElementById("warp_yarn_count").value="";
      		document.getElementById("warp_yarn_count").focus();
      		return false;
		}
		else if(document.getElementById("weft_yarn_count").value.trim()=="")
		{
      		alert("Please Provide Weft Yarn Count");
      		document.getElementById("weft_yarn_count").focus();
      		return false;
		}
		else if(isNaN(document.getElementById("weft_yarn_count").value.trim()))
		{
      		alert("Weft Yarn Count should be Numeric");
			document.getElementById("weft_yarn_count").value="";
      		document.getElementById("weft_yarn_count").focus();
      		return false;
		}
		else if(document.getElementById("no_of_threads_in_warp_in_thread_per_inch").value.trim()=="")
		{
      		alert("Please Provide No Of Threads In Warp In Thread Per Inch");
      		document.getElementById("no_of_threads_in_warp_in_thread_per_inch").focus();
      		return false;
		}
		else if(isNaN(document.getElementById("no_of_threads_in_warp_in_thread_per_inch").value.trim()))
		{
      		alert("No Of Threads In Warp In Thread Per Inch should be Numeric");
			document.getElementById("no_of_threads_in_warp_in_thread_per_inch").value="";
      		document.getElementById("no_of_threads_in_warp_in_thread_per_inch").focus();
      		return false;
		}
		else if(document.getElementById("no_of_threads_in_weft_in_thread_per_inch").value.trim()=="")
		{
      		alert("Please Provide No Of Threads In Weft In Thread Per Inch");
      		document.getElementById("no_of_threads_in_weft_in_thread_per_inch").focus();
      		return false;
		}
		else if(isNaN(document.getElementById("no_of_threads_in_weft_in_thread_per_inch").value.trim()))
		{
      		alert("No Of Threads In Weft In Thread Per Inch should be Numeric");
			document.getElementById("no_of_threads_in_weft_in_thread_per_inch").value="";
      		document.getElementById("no_of_threads_in_weft_in_thread_per_inch").focus();
      		return false;
		}
		else if(document.getElementById("gsm").value.trim()=="")
		{
      		alert("Please Provide Gsm");
      		document.getElementById("gsm").focus();
      		return false;
		}
		else if(isNaN(document.getElementById("gsm").value.trim()))
		{
      		alert("Gsm should be Numeric");
			document.getElementById("gsm").value="";
      		document.getElementById("gsm").focus();
      		return false;
		}
		else if(document.getElementById("percentage_of_cotton_content").value.trim()=="")
		{
      		alert("Please Provide Percentage Of Cotton Content");
      		document.getElementById("percentage_of_cotton_content").focus();
      		return false;
		}
		else if(isNaN(document.getElementById("percentage_of_cotton_content").value.trim()))
		{
      		alert("Percentage Of Cotton Content should be Numeric");
			document.getElementById("percentage_of_cotton_content").value="";
      		document.getElementById("percentage_of_cotton_content").focus();
      		return false;
		}
		else if(document.getElementById("percentage_of_polyester_content").value.trim()=="")
		{
      		alert("Please Provide Percentage Of Polyester Content");
      		document.getElementById("percentage_of_polyester_content").focus();
      		return false;
		}
		else if(isNaN(document.getElementById("percentage_of_polyester_content").value.trim()))
		{
      		alert("Percentage Of Polyester Content should be Numeric");
			document.getElementById("percentage_of_polyester_content").value="";
      		document.getElementById("percentage_of_polyester_content").focus();
      		return false;
		}
		else if(document.getElementById("name_of_other_fiber_in_yarn").value=="select")
		{
      		alert("Please Select Name Of Other Fiber In Yarn");
      		document.getElementById("name_of_other_fiber_in_yarn").focus();
      		return false;
		}
		else if(document.getElementById("percentage_of_other_fiber_content").value.trim()=="")
		{
      		alert("Please Provide Percentage Of Other Fiber Content");
      		document.getElementById("percentage_of_other_fiber_content").focus();
      		return false;
		}
		else if(isNaN(document.getElementById("percentage_of_other_fiber_content").value.trim()))
		{
      		alert("Percentage Of Other Fiber Content should be Numeric");
			document.getElementById("percentage_of_other_fiber_content").value="";
      		document.getElementById("percentage_of_other_fiber_content").focus();
      		return false;
		}
		else if(document.getElementById("greige_width").value.trim()=="")
		{
      		alert("Please Provide Greige Width");
      		document.getElementById("greige_width").focus();
      		return false;
		}
		else if(isNaN(document.getElementById("greige_width").value.trim()))
		{
      		alert("Greige Width should be Numeric");
			document.getElementById("greige_width").value="";
      		document.getElementById("greige_width").focus();
      		return false;
		}

		var radio_btn_status = document.getElementsByName('status');
		var ischecked = false;
		for ( var i = 0; i < radio_btn_status.length; i++) 
		{
				if(radio_btn_status[i].checked)  
				{
						ischecked = true;
				}
		}
		if(!ischecked)
		{
      		alert("Please Select Status");
      		document.getElementById("status").focus();
      		return false;
		}

		else if(document.getElementById("remarks").value.trim()=="")
		{
      		alert("Please Provide Remarks");
      		document.getElementById("remarks").focus();
      		return false;
		}

}

