 

function partial_test_for_test_result_Form_Validation()
{
       if(document.getElementById("alternate_partial_test_for_test_result_creation_date_time").value.trim()=="")
        {
            alert("Please Provide TRF Creation Date");
            document.getElementById("partial_test_for_test_result_creation_date").focus();
            exit();
        }
        
       else if(document.getElementById("shift").value=="select")
        {
            alert("Please Select Shift");
            document.getElementById("shift").focus();
            /*return false;*/
             exit();
        }

          else if(document.getElementById("process_name").value=="select")
        {
            alert("Please Select Process Name");
            document.getElementById("process_name").focus();
             exit();
        }
        else if(document.getElementById("pp_number").value=="select")
        {
            alert("Please Select PP Number Name");
            document.getElementById("pp_number").focus();
             exit();
        }
         else if(document.getElementById("version_number").value=="select")
        {
            alert("Please Select Version Number Name");
            document.getElementById("version_number").focus();
             exit();
        }
        else if(document.getElementById("week_in_year").value.trim()=="")
        {
            alert("Please Provide Week in Year");
            document.getElementById("week_in_year").focus();
            exit();
        }
        else if(document.getElementById("design").value.trim()=="")
        {
            alert("Please Provide Design");
            document.getElementById("design").focus();
             exit();
        }

        else if(document.getElementById("customer_name").value.trim()=="")
        {
            alert("Please Provide CustomerName");
            document.getElementById("customer_name").focus();
             exit();
        }
         else if(document.getElementById("finish_width_in_inch").value=="select")
        {
            alert("Please Provide Finish Width");
            document.getElementById("finish_width_in_inch").focus();
             exit();
        }
        else if(document.getElementById("before_trolley_number_or_batcher_number").value=="select")
        {
            alert("Please Select Before Trolly or Batcher Number");
            document.getElementById("before_trolley_number_or_batcher_number").focus();
            exit();
        }
        else if(document.getElementById("after_trolley_number_or_batcher_number").value.trim()=="")
        {
            alert("Please Provide After Trolly or Batcher Number");
            document.getElementById("after_trolley_number_or_batcher_number").focus();
             exit();
        }

        else if(document.getElementById("qty").value.trim()=="")
        {
            alert("Please Provide Quantity");
            document.getElementById("qty").focus();
             exit();
        }
        else if(document.getElementById("machine_name").value=="select")
        {
            alert("Please Select  Machine Name");
            document.getElementById("machine_name").focus();
             exit();
        }
        else if(document.getElementById("service_type").value=="select")
        {
            alert("Please Select  Service Type");
            document.getElementById("service_type").focus();
             exit();
        }
 }