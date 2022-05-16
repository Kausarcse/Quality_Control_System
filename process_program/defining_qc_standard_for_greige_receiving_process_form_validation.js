

function Greige_Receiving_Form_Validation()
{


		if(document.getElementById("pp_number_value").value=="select")
		{
      		alert("Please Select PP Number");
      		document.getElementById("pp_number_value").focus();
      		return false;
		}
		else if(document.getElementById("version_number").value=="select")
		{
      		alert("Please Select Version Number");
      		document.getElementById("version_number").focus();
      		return false;
		}
		/*else if(document.getElementById("customer_name").value.trim()=="")
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
		else if(document.getElementById("standard_for_which_process").value=="select")
		{
      		alert("Please Select Standard For Which Process");
      		document.getElementById("standard_for_which_process").focus();
      		return false;
		}*/
		/*else if(document.getElementById("warp_yarn_count_value").value.trim()=="")
	    {
	          alert("Please Provide Warp Yarn Count Value");
	          document.getElementById("warp_yarn_count_value").focus();
	          return false;
	    }
	    else if(isNaN(document.getElementById("warp_yarn_count_value").value.trim()))
	    {
	          alert("Warp Yarn Count Value should be Numeric");
	      document.getElementById("warp_yarn_count_value").value="";
	          document.getElementById("warp_yarn_count_value").focus();
	          return false;
	    }
	    else if(document.getElementById("warp_yarn_count_tolerance_range_math_operator").value=="select")
	    {
	          alert("Please Select Warp Yarn Count Tolerance Range Math Operator");
	          document.getElementById("warp_yarn_count_tolerance_range_math_operator").focus();
	          return false;
	    }
	    else if(document.getElementById("warp_yarn_count_tolerance_value").value.trim()=="")
	    {
	          alert("Please Provide Warp Yarn Count Tolerance Value");
	          document.getElementById("warp_yarn_count_tolerance_value").focus();
	          return false;
	    }
	    else if(isNaN(document.getElementById("warp_yarn_count_tolerance_value").value.trim()))
	    {
	          alert("Warp Yarn Count Tolerance Value should be Numeric");
	      document.getElementById("warp_yarn_count_tolerance_value").value="";
	          document.getElementById("warp_yarn_count_tolerance_value").focus();
	          return false;
	    }
	    else if(document.getElementById("warp_yarn_count_min_value").value.trim()=="")
	    {
	          alert("Please Provide Warp Yarn Count Min Value");
	          document.getElementById("warp_yarn_count_min_value").focus();
	          return false;
	    }
	    else if(isNaN(document.getElementById("warp_yarn_count_min_value").value.trim()))
	    {
	          alert("Warp Yarn Count Min Value should be Numeric");
	      document.getElementById("warp_yarn_count_min_value").value="";
	          document.getElementById("warp_yarn_count_min_value").focus();
	          return false;
	    }
	    else if(document.getElementById("warp_yarn_count_max_value").value.trim()=="")
	    {
	          alert("Please Provide Warp Yarn Count Max Value");
	          document.getElementById("warp_yarn_count_max_value").focus();
	          return false;
	    }
	    else if(isNaN(document.getElementById("warp_yarn_count_max_value").value.trim()))
	    {
	          alert("Warp Yarn Count Max Value should be Numeric");
	      document.getElementById("warp_yarn_count_max_value").value="";
	          document.getElementById("warp_yarn_count_max_value").focus();
	          return false;
	    }
	    else if(document.getElementById("weft_yarn_count_value").value.trim()=="")
	    {
	          alert("Please Provide weft Yarn Count Value");
	          document.getElementById("weft_yarn_count_value").focus();
	          return false;
	    }
	    else if(isNaN(document.getElementById("weft_yarn_count_value").value.trim()))
	    {
	          alert("weft Yarn Count Value should be Numeric");
	      document.getElementById("weft_yarn_count_value").value="";
	          document.getElementById("weft_yarn_count_value").focus();
	          return false;
	    }
	    
	    else if(document.getElementById("weft_yarn_count_tolerance_value").value.trim()=="")
	    {
	          alert("Please Provide weft Yarn Count Tolerance Value");
	          document.getElementById("weft_yarn_count_tolerance_value").focus();
	          return false;
	    }
	    else if(isNaN(document.getElementById("weft_yarn_count_tolerance_value").value.trim()))
	    {
	          alert("weft Yarn Count Tolerance Value should be Numeric");
	      document.getElementById("weft_yarn_count_tolerance_value").value="";
	          document.getElementById("weft_yarn_count_tolerance_value").focus();
	          return false;
	    }
	    else if(document.getElementById("weft_yarn_count_min_value").value.trim()=="")
	    {
	          alert("Please Provide weft Yarn Count Min Value");
	          document.getElementById("weft_yarn_count_min_value").focus();
	          return false;
	    }
	    else if(isNaN(document.getElementById("weft_yarn_count_min_value").value.trim()))
	    {
	          alert("weft Yarn Count Min Value should be Numeric");
	      document.getElementById("weft_yarn_count_min_value").value="";
	          document.getElementById("weft_yarn_count_min_value").focus();
	          return false;
	    }
	    else if(document.getElementById("weft_yarn_count_max_value").value.trim()=="")
	    {
	          alert("Please Provide weft Yarn Count Max Value");
	          document.getElementById("weft_yarn_count_max_value").focus();
	          return false;
	    }
	    else if(isNaN(document.getElementById("weft_yarn_count_max_value").value.trim()))
	    {
	          alert("weft Yarn Count Max Value should be Numeric");
	      document.getElementById("weft_yarn_count_max_value").value="";
	          document.getElementById("weft_yarn_count_max_value").focus();
	          return false;
	    }

	    else if(isNaN(document.getElementById("percentage_of_other_fiber_value").value.trim()))
        {
              alert("Percentage of Other FIber Value should be Numeric");
          document.getElementById("percentage_of_other_fiber_value").value="";
              document.getElementById("percentage_of_other_fiber_value").focus();
              return false;
        }
        else if(document.getElementById("percentage_of_other_fiber_content_tolerance_range_math_op").value=="select")
        {
              alert("Please Select percentage of Fiber Content Tolerance Range Math Operator");
              document.getElementById("percentage_of_other_fiber_content_tolerance_range_math_op").focus();
              return false;
        }
        else if(document.getElementById("percentage_of_other_fiber_content_tolerance_value").value.trim()=="")
        {
              alert("Please Provide percentage of other fiber content tolerance value");
              document.getElementById("percentage_of_other_fiber_content_tolerance_value").focus();
              return false;
        }
        else if(isNaN(document.getElementById("percentage_of_other_fiber_content_tolerance_value").value.trim()))
        {
              alert("percentage of other fiber content tolerance value should be Numeric");
          document.getElementById("percentage_of_other_fiber_content_tolerance_value").value="";
              document.getElementById("percentage_of_other_fiber_content_tolerance_value").focus();
              return false;
        }
        else if(document.getElementById("percentage_of_other_fiber_content_min_value").value.trim()=="")
        {
              alert("Please Provide percentage of other fiber content min value");
              document.getElementById("percentage_of_other_fiber_content_min_value").focus();
              return false;
        }
        else if(isNaN(document.getElementById("percentage_of_other_fiber_content_min_value").value.trim()))
        {
              alert("percentage of other fiber content min value should be Numeric");
          document.getElementById("percentage_of_other_fiber_content_min_value").value="";
              document.getElementById("percentage_of_other_fiber_content_min_value").focus();
              return false;
        }
        else if(document.getElementById("percentage_of_other_fiber_content_max_value").value.trim()=="")
        {
              alert("Please Provide percentage of other fiber content max value");
              document.getElementById("percentage_of_other_fiber_content_max_value").focus();
              return false;
        }
        else if(isNaN(document.getElementById("percentage_of_other_fiber_content_max_value").value.trim()))
        {
              alert("percentage of other fiber content max value should be Numeric");
          document.getElementById("percentage_of_other_fiber_content_max_value").value="";
              document.getElementById("percentage_of_other_fiber_content_max_value").focus();
              return false;
        }*/
		
}

