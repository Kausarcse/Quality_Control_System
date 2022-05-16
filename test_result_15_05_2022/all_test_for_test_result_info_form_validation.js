function all_test_for_test_result_Form_Validation()
{
   
    if(document.getElementById("all_test_for_test_result_creation_date").value.trim()=="")
    {
        alert("Please Provide Test Result Creation Date");
        document.getElementById("all_test_for_test_result_creation_date").focus();
        return false;
    }
    else if(document.getElementById("alternate_all_test_for_test_result_creation_date_time").value.trim()=="")
    {
        alert("Please Provide Test Result Creation Time");
        document.getElementById("alternate_all_test_for_test_result_creation_date_time").focus();
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
        alert("Please Provide TRF ID");
        document.getElementById("trf_id").focus();
        return false;
    }

}

