function partial_test_for_test_result_Form_Validation()
{
   
    if(document.getElementById("partial_test_for_test_result_creation_date").value.trim()=="")
    {
        alert("Please Provide Test Result Creation Date");
        document.getElementById("partial_test_for_test_result_creation_date").focus();
        return false;
    }
    else if(document.getElementById("alternate_partial_test_for_test_result_creation_date_time").value.trim()=="")
    {
        alert("Please Provide Test Result Creation Time");
        document.getElementById("alternate_partial_test_for_test_result_creation_date_time").focus();
        return false;
    }
    else if(document.getElementById("employee_name").value.trim()=="select")
    {
        alert("Please Provide Employee name");
        document.getElementById("employee_name").focus();
        return false;
    }
    else if(document.getElementById("trf_id").value.trim()=="select")
    {
       var validate = partial_test_for_test_result_Form_Validation_for_without_trf_id();
       if(validate== false)
       {
           return false;
       }
    }

}

function partial_test_for_test_result_Form_Validation_for_without_trf_id()
    {
        if(document.getElementById("pp_number").value.trim()=="select")
        {
            alert("Please Provide pp number");
            document.getElementById("pp_number").focus();
            return false;
        }
        else if(document.getElementById("version_number").value.trim()=="select")
        {
            alert("Please Provide version name");
            document.getElementById("version_number").focus();
            return false;
        }
        else if(document.getElementById("process_name").value.trim()=="select")
        {
            alert("Please Provide process name");
            document.getElementById("process_name").focus();
            return false;
        }
        else if((document.getElementById("after_trolley_number_or_batcher_number").value.trim()=="select") && (document.getElementById("process_name").value.trim() != "proc_20?fs?Greige Receiving"))
        {
            alert("Please Provide After Trolley or Batcher Number");
            document.getElementById("after_trolley_number_or_batcher_number").focus();
            return false;
        }
        else if(document.getElementById("after_trolley_or_batcher_qty").value.trim()=="")
        {
            alert("Please Provide After Trolley or Batcher Quantity");
            document.getElementById("after_trolley_or_batcher_qty").focus();
            return false;
        }
        else if((document.getElementById("machine_name").value.trim()=="select") && (document.getElementById("process_name").value.trim() != "proc_20?fs?Greige Receiving") && (document.getElementById("process_name").value.trim() != "proc_14?fs?Ready For Raising") && (document.getElementById("process_name").value.trim() != "proc_15?fs?Raising"))
        {
            alert("Please Provide machine name");
            document.getElementById("machine_name").focus();
            return false;
        }
        else if(document.getElementById("service_type").value.trim()=="select")
        {
            alert("Please Provide Service Type");
            document.getElementById("service_type").focus();
            return false;
        }
        else if((document.getElementById("process_name").value.trim() != "proc_20?fs?Greige Receiving") || (document.getElementById("process_name").value.trim() != "proc_1?fs?Singeing & Desizing") || (document.getElementById("process_name").value.trim() != "proc_21?fs?Singeing") || (document.getElementById("process_name").value.trim() != "proc_22?fs?Desizing"))
        {
            var validate = before_trolley_validation();
            if(validate== false)
            {
                return false;
            }
        }
}

function before_trolley_validation ()
{
    if(document.getElementById("before_trolley_number_or_batcher_number").value.trim()=="select")
    {
        alert("Please Provide Before Trolley or Batcher Number");
        document.getElementById("before_trolley_number_or_batcher_number").focus();
        return false;
    }
}