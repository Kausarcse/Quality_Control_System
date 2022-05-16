<?php
session_start();
require_once("login/db_session_chk.php");

$user_name=$_SESSION['user_name'];
$user_id=$_SESSION['user_id'];
$user_type=$_SESSION['user_type'];
$select_sql_for_user="SELECT `profile_picture` FROM `user_login` WHERE `user_name`='$user_name'";
$result= mysqli_query($con, $select_sql_for_user) or die(mysqli_error($con));
$row=mysqli_fetch_assoc($result);
?>

<!-- <style>
.sub_menu   
{
	display:block;
	margin:1px;
	width:110%;
	
	background-color:#0C2D48; 
	color:#FFFFFF; 
	border-style: dotted;
	border-color: green; 
	margin-top:2px;

}


</style> -->

<script>


	/********************User Menu*********************/
	function change_create_user_button_color() {
		

		$('#create_user_list').css('background', 'black');
		$('#user_list').css('background', 'none');
		$('#department_info').css('background', 'none');
		$('#designation_info').css('background', 'none');

		$('#key_account_manager').css('background', 'none');
		$('#add_customer').css('background', 'none');
		$('#add_process_technique').css('background', 'none');
		$('#add_color').css('background', 'none');

		$('#add_process_name').css('background', 'none');
		$('#add_trolley').css('background', 'none');
		$('#add_machine').css('background', 'none');
		$('#add_machine_owner').css('background', 'none');
		$('#add_test_name').css('background', 'none');
		$('#add_test_method_name').css('background', 'none');
		$('#add_test_method_for_customer').css('background', 'none');
		$('#add_version_of_pp').css('background', 'none');
		$('#add_construction').css('background', 'none');
		$('#add_machine_stoppage_problems').css('background', 'none');

		$('#auto_sync').css('background', 'none');
		$('#auto_sync_list').css('background', 'none');

		$('#add_pp_creation').css('background', 'none');
		$('#pp_wise_version_creation').css('background', 'none');
		$('#adding_process_to_version').css('background', 'none');
		$('#pp_monitoring').css('background', 'none');
		$('#partial_test_trf').css('background', 'none');
		$('#all_test_trf').css('background', 'none');
		$('#reprocess_trf').css('background', 'none');
		$('#partial_test_result').css('background', 'none');
		$('#all_test_result').css('background', 'none');
		$('#reprocess_all_test').css('background', 'none');

		$('#machine_stopage_daily_data_input').css('background', 'none');
		
		$('#partial_test_report').css('background', 'none');
		$('#all_test_report').css('background', 'none');
		$('#customized_report').css('background', 'none');
		$('#pp_progress_report').css('background', 'none');
		$('#pp_status_report').css('background', 'none');


		load_page('user/user_info.php');
	}
	function change_create_button_color() {
		$('#create_user_list').css('background', 'none');
		$('#user_list').css('background', 'black');
		$('#department_info').css('background', 'none');
		$('#designation_info').css('background', 'none');

		$('#key_account_manager').css('background', 'none');
		$('#add_customer').css('background', 'none');
		$('#add_process_technique').css('background', 'none');
		$('#add_color').css('background', 'none');

		$('#add_process_name').css('background', 'none');
		$('#add_trolley').css('background', 'none');
		$('#add_machine').css('background', 'none');
		$('#add_machine_owner').css('background', 'none');
		$('#add_test_name').css('background', 'none');
		$('#add_test_method_name').css('background', 'none');
		$('#add_test_method_for_customer').css('background', 'none');
		$('#add_version_of_pp').css('background', 'none');
		$('#add_construction').css('background', 'none');
		$('#add_machine_stoppage_problems').css('background', 'none');

		$('#auto_sync').css('background', 'none');
		$('#auto_sync_list').css('background', 'none');

		$('#add_pp_creation').css('background', 'none');
		$('#pp_wise_version_creation').css('background', 'none');
		$('#adding_process_to_version').css('background', 'none');
		$('#quickly_defining_qc_standard_for_individual_process').css('background', 'none');
		$('#pp_monitoring').css('background', 'none');
		$('#partial_test_trf').css('background', 'none');
		$('#all_test_trf').css('background', 'none');
		$('#reprocess_trf').css('background', 'none');
		$('#partial_test_result').css('background', 'none');
		$('#all_test_result').css('background', 'none');
		$('#reprocess_all_test').css('background', 'none');

		$('#machine_stopage_daily_data_input').css('background', 'none');

		$('#partial_test_report').css('background', 'none');
		$('#all_test_report').css('background', 'none');
		$('#customized_report').css('background', 'none');
		$('#pp_progress_report').css('background', 'none');
		$('#pp_status_report').css('background', 'none');


		load_page('user/user_list.php');
	}

	function change_department_info_button_color() {
		$('#create_user_list').css('background', 'none');
		$('#user_list').css('background', 'none');
		$('#department_info').css('background', 'black');
		$('#designation_info').css('background', 'none');

		$('#key_account_manager').css('background', 'none');
		$('#add_customer').css('background', 'none');
		$('#add_process_technique').css('background', 'none');
		$('#add_color').css('background', 'none');

		$('#add_process_name').css('background', 'none');
		$('#add_trolley').css('background', 'none');
		$('#add_machine').css('background', 'none');
		$('#add_machine_owner').css('background', 'none');
		$('#add_test_name').css('background', 'none');
		$('#add_test_method_name').css('background', 'none');
		$('#add_test_method_for_customer').css('background', 'none');
		$('#add_version_of_pp').css('background', 'none');
		$('#add_construction').css('background', 'none');
		$('#add_machine_stoppage_problems').css('background', 'none');

		$('#auto_sync').css('background', 'none');
		$('#auto_sync_list').css('background', 'none');

		$('#add_pp_creation').css('background', 'none');
		$('#pp_wise_version_creation').css('background', 'none');
		$('#adding_process_to_version').css('background', 'none');
		$('#quickly_defining_qc_standard_for_individual_process').css('background', 'none');
		$('#pp_monitoring').css('background', 'none');
		$('#partial_test_trf').css('background', 'none');
		$('#all_test_trf').css('background', 'none');
		$('#reprocess_trf').css('background', 'none');
		$('#partial_test_result').css('background', 'none');
		$('#all_test_result').css('background', 'none');
		$('#reprocess_all_test').css('background', 'none');

		$('#machine_stopage_daily_data_input').css('background', 'none');

		$('#partial_test_report').css('background', 'none');
		$('#all_test_report').css('background', 'none');
		$('#customized_report').css('background', 'none');
		$('#pp_progress_report').css('background', 'none');
		$('#pp_status_report').css('background', 'none');


		load_page('user/department_info.php');
	}
	/********************Settings Menu*********************/
	function change_key_account_manager_button_color() {
		$('#create_user_list').css('background', 'none');
		$('#user_list').css('background', 'none');
		$('#department_info').css('background', 'none');
		$('#designation_info').css('background', 'none');

		$('#key_account_manager').css('background', 'black');
		$('#add_customer').css('background', 'none');
		$('#add_customer').css('background', 'none');
		$('#add_process_technique').css('background', 'none');
		$('#add_color').css('background', 'none');

		$('#add_process_name').css('background', 'none');
		$('#add_trolley').css('background', 'none');
		$('#add_machine').css('background', 'none');
		$('#add_machine_owner').css('background', 'none');
		$('#add_test_name').css('background', 'none');
		$('#add_test_method_name').css('background', 'none');
		$('#add_test_method_for_customer').css('background', 'none');
		$('#add_version_of_pp').css('background', 'none');
		$('#add_construction').css('background', 'none');
		$('#add_machine_stoppage_problems').css('background', 'none');

		$('#auto_sync').css('background', 'none');
		$('#auto_sync_list').css('background', 'none');

		$('#add_pp_creation').css('background', 'none');
		$('#pp_wise_version_creation').css('background', 'none');
		$('#adding_process_to_version').css('background', 'none');
		$('#quickly_defining_qc_standard_for_individual_process').css('background', 'none');
		$('#pp_monitoring').css('background', 'none');
		$('#partial_test_trf').css('background', 'none');
		$('#all_test_trf').css('background', 'none');
		$('#reprocess_trf').css('background', 'none');
		$('#partial_test_result').css('background', 'none');
		$('#all_test_result').css('background', 'none');
		$('#reprocess_all_test').css('background', 'none');

		$('#machine_stopage_daily_data_input').css('background', 'none');

		$('#partial_test_report').css('background', 'none');
		$('#all_test_report').css('background', 'none');
		$('#customized_report').css('background', 'none');
		$('#pp_progress_report').css('background', 'none');
		$('#pp_status_report').css('background', 'none');


		load_page('settings/key_account_manager.php');
	}

	function change_add_customer_button_color() {
		$('#create_user_list').css('background', 'none');
		$('#user_list').css('background', 'none');
		$('#department_info').css('background', 'none');
		$('#designation_info').css('background', 'none');

		$('#key_account_manager').css('background', 'none');
		$('#add_customer').css('background', 'black');
		$('#add_process_technique').css('background', 'none');
		$('#add_color').css('background', 'none');

		$('#add_process_name').css('background', 'none');
		$('#add_trolley').css('background', 'none');
		$('#add_machine').css('background', 'none');
		$('#add_machine_owner').css('background', 'none');
		$('#add_test_name').css('background', 'none');
		$('#add_test_method_name').css('background', 'none');
		$('#add_test_method_for_customer').css('background', 'none');
		$('#add_version_of_pp').css('background', 'none');
		$('#add_construction').css('background', 'none');
		$('#add_machine_stoppage_problems').css('background', 'none');

		$('#auto_sync').css('background', 'none');
		$('#auto_sync_list').css('background', 'none');

		$('#add_pp_creation').css('background', 'none');
		$('#pp_wise_version_creation').css('background', 'none');
		$('#adding_process_to_version').css('background', 'none');
		$('#quickly_defining_qc_standard_for_individual_process').css('background', 'none');
		$('#pp_monitoring').css('background', 'none');
		$('#partial_test_trf').css('background', 'none');
		$('#all_test_trf').css('background', 'none');
		$('#reprocess_trf').css('background', 'none');
		$('#partial_test_result').css('background', 'none');
		$('#all_test_result').css('background', 'none');
		$('#reprocess_all_test').css('background', 'none');

		$('#machine_stopage_daily_data_input').css('background', 'none');

		$('#partial_test_report').css('background', 'none');
		$('#all_test_report').css('background', 'none');
		$('#customized_report').css('background', 'none');
		$('#pp_progress_report').css('background', 'none');
		$('#pp_status_report').css('background', 'none');


		load_page('settings/customer.php');
	}
	function change_add_process_technique_button_color() {
		$('#create_user_list').css('background', 'none');
		$('#user_list').css('background', 'none');
		$('#department_info').css('background', 'none');
		$('#designation_info').css('background', 'none');

		$('#key_account_manager').css('background', 'none');
		$('#add_customer').css('background', 'none');
		$('#add_process_technique').css('background', 'black');
		$('#add_color').css('background', 'none');

		$('#add_process_name').css('background', 'none');
		$('#add_trolley').css('background', 'none');
		$('#add_machine').css('background', 'none');
		$('#add_machine_owner').css('background', 'none');
		$('#add_test_name').css('background', 'none');
		$('#add_test_method_name').css('background', 'none');
		$('#add_test_method_for_customer').css('background', 'none');
		$('#add_version_of_pp').css('background', 'none');
		$('#add_construction').css('background', 'none');
		$('#add_machine_stoppage_problems').css('background', 'none');

		$('#auto_sync').css('background', 'none');
		$('#auto_sync_list').css('background', 'none');

		$('#add_pp_creation').css('background', 'none');
		$('#pp_wise_version_creation').css('background', 'none');
		$('#adding_process_to_version').css('background', 'none');
		$('#quickly_defining_qc_standard_for_individual_process').css('background', 'none');
		$('#pp_monitoring').css('background', 'none');
		$('#partial_test_trf').css('background', 'none');
		$('#all_test_trf').css('background', 'none');
		$('#reprocess_trf').css('background', 'none');
		$('#partial_test_result').css('background', 'none');
		$('#all_test_result').css('background', 'none');
		$('#reprocess_all_test').css('background', 'none');

		$('#machine_stopage_daily_data_input').css('background', 'none');

		$('#partial_test_report').css('background', 'none');
		$('#all_test_report').css('background', 'none');
		$('#customized_report').css('background', 'none');
		$('#pp_progress_report').css('background', 'none');
		$('#pp_status_report').css('background', 'none');


		load_page('settings/process_technique_or_program_type.php');
	}

	function change_add_color_button_color() {
		$('#create_user_list').css('background', 'none');
		$('#user_list').css('background', 'none');
		$('#department_info').css('background', 'none');
		$('#designation_info').css('background', 'none');

		$('#key_account_manager').css('background', 'none');
		$('#add_customer').css('background', 'none');
		$('#add_process_technique').css('background', 'none');
		$('#add_color').css('background', 'black');

		$('#add_process_name').css('background', 'none');

		$('#add_trolley').css('background', 'none');
		$('#add_machine').css('background', 'none');
		$('#add_machine_owner').css('background', 'none');
		$('#add_test_name').css('background', 'none');
		$('#add_test_method_name').css('background', 'none');
		$('#add_test_method_for_customer').css('background', 'none');
		$('#add_version_of_pp').css('background', 'none');
		$('#add_construction').css('background', 'none');
		$('#add_machine_stoppage_problems').css('background', 'none');

		$('#auto_sync').css('background', 'none');
		$('#auto_sync_list').css('background', 'none');

		$('#add_pp_creation').css('background', 'none');
		$('#pp_wise_version_creation').css('background', 'none');
		$('#adding_process_to_version').css('background', 'none');
		$('#quickly_defining_qc_standard_for_individual_process').css('background', 'none');
		$('#pp_monitoring').css('background', 'none');
		$('#partial_test_trf').css('background', 'none');
		$('#all_test_trf').css('background', 'none');
		$('#reprocess_trf').css('background', 'none');
		$('#partial_test_result').css('background', 'none');
		$('#all_test_result').css('background', 'none');
		$('#reprocess_all_test').css('background', 'none');

		$('#machine_stopage_daily_data_input').css('background', 'none');

		$('#partial_test_report').css('background', 'none');
		$('#all_test_report').css('background', 'none');
		$('#customized_report').css('background', 'none');
		$('#pp_progress_report').css('background', 'none');
		$('#pp_status_report').css('background', 'none');


		load_page('settings/color.php');
	}

/*	Need to paste buttons */

	function change_add_process_name_button_color() {
		$('#create_user_list').css('background', 'none');
		$('#user_list').css('background', 'none');
		$('#department_info').css('background', 'none');
		$('#designation_info').css('background', 'none');

		$('#key_account_manager').css('background', 'none');
		$('#add_customer').css('background', 'none');
		$('#add_process_technique').css('background', 'none');
		$('#add_color').css('background', 'none');
		$('#add_process_name').css('background', 'black');

		$('#add_trolley').css('background', 'none');
		$('#add_machine').css('background', 'none');
		$('#add_machine_owner').css('background', 'none');
		$('#add_test_name').css('background', 'none');
		$('#add_test_method_name').css('background', 'none');
		$('#add_test_method_for_customer').css('background', 'none');
		$('#add_version_of_pp').css('background', 'none');
		$('#add_construction').css('background', 'none');
		$('#add_machine_stoppage_problems').css('background', 'none');

		$('#auto_sync').css('background', 'none');
		$('#auto_sync_list').css('background', 'none');

		$('#add_pp_creation').css('background', 'none');
		$('#pp_wise_version_creation').css('background', 'none');
		$('#adding_process_to_version').css('background', 'none');
		$('#quickly_defining_qc_standard_for_individual_process').css('background', 'none');
		$('#pp_monitoring').css('background', 'none');
		$('#partial_test_trf').css('background', 'none');
		$('#all_test_trf').css('background', 'none');
		$('#reprocess_trf').css('background', 'none');
		$('#partial_test_result').css('background', 'none');
		$('#all_test_result').css('background', 'none');
		$('#reprocess_all_test').css('background', 'none');

		$('#machine_stopage_daily_data_input').css('background', 'none');

		$('#partial_test_report').css('background', 'none');
		$('#all_test_report').css('background', 'none');
		$('#customized_report').css('background', 'none');
		$('#pp_progress_report').css('background', 'none');
		$('#pp_status_report').css('background', 'none');

		load_page('settings/process_name.php');
	}

	function change_add_trolley_button_color() {
		$('#create_user_list').css('background', 'none');
		$('#user_list').css('background', 'none');
		$('#department_info').css('background', 'none');
		$('#designation_info').css('background', 'none');

		$('#key_account_manager').css('background', 'none');
		$('#add_customer').css('background', 'none');
		$('#add_process_technique').css('background', 'none');
		$('#add_color').css('background', 'none');
		
		$('#add_process_name').css('background', 'none');
		$('#add_trolley').css('background', 'black');
		$('#add_machine').css('background', 'none');
		$('#add_machine_owner').css('background', 'none');
		$('#add_test_name').css('background', 'none');
		$('#add_test_method_name').css('background', 'none');
		$('#add_test_method_for_customer').css('background', 'none');
		$('#add_version_of_pp').css('background', 'none');
		$('#add_construction').css('background', 'none');
		$('#add_machine_stoppage_problems').css('background', 'none');

		$('#auto_sync').css('background', 'none');
		$('#auto_sync_list').css('background', 'none');

		$('#add_pp_creation').css('background', 'none');
		$('#pp_wise_version_creation').css('background', 'none');
		$('#adding_process_to_version').css('background', 'none');
		$('#quickly_defining_qc_standard_for_individual_process').css('background', 'none');
		$('#pp_monitoring').css('background', 'none');
		$('#partial_test_trf').css('background', 'none');
		$('#all_test_trf').css('background', 'none');
		$('#reprocess_trf').css('background', 'none');
		$('#partial_test_result').css('background', 'none');
		$('#all_test_result').css('background', 'none');
		$('#reprocess_all_test').css('background', 'none');

		$('#machine_stopage_daily_data_input').css('background', 'none');

		$('#partial_test_report').css('background', 'none');
		$('#all_test_report').css('background', 'none');
		$('#customized_report').css('background', 'none');
		$('#pp_progress_report').css('background', 'none');
		$('#pp_status_report').css('background', 'none');

		load_page('settings/trolley.php');
	}

	function change_add_machine_button_color() {
		$('#create_user_list').css('background', 'none');
		$('#user_list').css('background', 'none');
		$('#department_info').css('background', 'none');
		$('#designation_info').css('background', 'none');

		$('#key_account_manager').css('background', 'none');
		$('#add_customer').css('background', 'none');
		$('#add_process_technique').css('background', 'none');
		$('#add_color').css('background', 'none');
		
		$('#add_process_name').css('background', 'none');
		$('#add_trolley').css('background', 'none');
		$('#add_machine').css('background', 'black');
		$('#add_machine_owner').css('background', 'none');
		$('#add_test_name').css('background', 'none');
		$('#add_test_method_name').css('background', 'none');
		$('#add_test_method_for_customer').css('background', 'none');
		$('#add_version_of_pp').css('background', 'none');
		$('#add_construction').css('background', 'none');
		$('#add_machine_stoppage_problems').css('background', 'none');

		$('#auto_sync').css('background', 'none');
		$('#auto_sync_list').css('background', 'none');

		$('#add_pp_creation').css('background', 'none');
		$('#pp_wise_version_creation').css('background', 'none');
		$('#adding_process_to_version').css('background', 'none');
		$('#quickly_defining_qc_standard_for_individual_process').css('background', 'none');
		$('#pp_monitoring').css('background', 'none');
		$('#partial_test_trf').css('background', 'none');
		$('#all_test_trf').css('background', 'none');
		$('#reprocess_trf').css('background', 'none');
		$('#partial_test_result').css('background', 'none');
		$('#all_test_result').css('background', 'none');
		$('#reprocess_all_test').css('background', 'none');

		$('#machine_stopage_daily_data_input').css('background', 'none');

		$('#partial_test_report').css('background', 'none');
		$('#all_test_report').css('background', 'none');
		$('#customized_report').css('background', 'none');
		$('#pp_progress_report').css('background', 'none');
		$('#pp_status_report').css('background', 'none');

		load_page('settings/machine_name.php');
	}

	function change_add_machine_owner_button_color() {
		$('#create_user_list').css('background', 'none');
		$('#user_list').css('background', 'none');
		$('#department_info').css('background', 'none');
		$('#designation_info').css('background', 'none');

		$('#key_account_manager').css('background', 'none');
		$('#add_customer').css('background', 'none');
		$('#add_process_technique').css('background', 'none');
		$('#add_color').css('background', 'none');
		
		$('#add_process_name').css('background', 'none');
		$('#add_trolley').css('background', 'none');
		$('#add_machine').css('background', 'none');
		$('#add_machine_owner').css('background', 'black');
		$('#add_test_name').css('background', 'none');
		$('#add_test_method_name').css('background', 'none');
		$('#add_test_method_for_customer').css('background', 'none');
		$('#add_version_of_pp').css('background', 'none');
		$('#add_construction').css('background', 'none');
		$('#add_machine_stoppage_problems').css('background', 'none');

		$('#auto_sync').css('background', 'none');
		$('#auto_sync_list').css('background', 'none');

		$('#add_pp_creation').css('background', 'none');
		$('#pp_wise_version_creation').css('background', 'none');
		$('#adding_process_to_version').css('background', 'none');
		$('#quickly_defining_qc_standard_for_individual_process').css('background', 'none');
		$('#pp_monitoring').css('background', 'none');
		$('#partial_test_trf').css('background', 'none');
		$('#all_test_trf').css('background', 'none');
		$('#reprocess_trf').css('background', 'none');
		$('#partial_test_result').css('background', 'none');
		$('#all_test_result').css('background', 'none');
		$('#reprocess_all_test').css('background', 'none');

		$('#machine_stopage_daily_data_input').css('background', 'none');

		$('#partial_test_report').css('background', 'none');
		$('#all_test_report').css('background', 'none');
		$('#customized_report').css('background', 'none');
		$('#pp_progress_report').css('background', 'none');
		$('#pp_status_report').css('background', 'none');

		load_page('settings/machine_owner_name.php');
	}

	function change_add_test_name_button_color() {
		$('#create_user_list').css('background', 'none');
		$('#user_list').css('background', 'none');
		$('#department_info').css('background', 'none');
		$('#designation_info').css('background', 'none');

		$('#key_account_manager').css('background', 'none');
		$('#add_customer').css('background', 'none');
		$('#add_process_technique').css('background', 'none');
		$('#add_color').css('background', 'none');
		
		$('#add_process_name').css('background', 'none');
		$('#add_trolley').css('background', 'none');
		$('#add_machine').css('background', 'none');
		$('#add_machine_owner').css('background', 'none');
		$('#add_test_name').css('background', 'black');
		$('#add_test_method_name').css('background', 'none');
		$('#add_test_method_for_customer').css('background', 'none');
		$('#add_version_of_pp').css('background', 'none');
		$('#add_construction').css('background', 'none');
		$('#add_machine_stoppage_problems').css('background', 'none');

		$('#auto_sync').css('background', 'none');
		$('#auto_sync_list').css('background', 'none');

		$('#add_pp_creation').css('background', 'none');
		$('#pp_wise_version_creation').css('background', 'none');
		$('#adding_process_to_version').css('background', 'none');
		$('#quickly_defining_qc_standard_for_individual_process').css('background', 'none');
		$('#pp_monitoring').css('background', 'none');
		$('#partial_test_trf').css('background', 'none');
		$('#all_test_trf').css('background', 'none');
		$('#reprocess_trf').css('background', 'none');
		$('#partial_test_result').css('background', 'none');
		$('#all_test_result').css('background', 'none');
		$('#reprocess_all_test').css('background', 'none');

		$('#machine_stopage_daily_data_input').css('background', 'none');

		$('#partial_test_report').css('background', 'none');
		$('#all_test_report').css('background', 'none');
		$('#customized_report').css('background', 'none');
		$('#pp_progress_report').css('background', 'none');
		$('#pp_status_report').css('background', 'none');

		load_page('settings/test_name.php');
	}

	function change_add_test_method_name_button_color() {
		$('#create_user_list').css('background', 'none');
		$('#user_list').css('background', 'none');
		$('#department_info').css('background', 'none');
		$('#designation_info').css('background', 'none');

		$('#key_account_manager').css('background', 'none');
		$('#add_customer').css('background', 'none');
		$('#add_process_technique').css('background', 'none');
		$('#add_color').css('background', 'none');
		
		$('#add_process_name').css('background', 'none');
		$('#add_trolley').css('background', 'none');
		$('#add_machine').css('background', 'none');
		$('#add_machine_owner').css('background', 'none');
		$('#add_test_name').css('background', 'none');
		$('#add_test_method_name').css('background', 'black');
		$('#add_test_method_for_customer').css('background', 'none');
		$('#add_version_of_pp').css('background', 'none');
		$('#add_construction').css('background', 'none');
		$('#add_machine_stoppage_problems').css('background', 'none');

		$('#auto_sync').css('background', 'none');
		$('#auto_sync_list').css('background', 'none');

		$('#add_pp_creation').css('background', 'none');
		$('#pp_wise_version_creation').css('background', 'none');
		$('#adding_process_to_version').css('background', 'none');
		$('#quickly_defining_qc_standard_for_individual_process').css('background', 'none');
		$('#pp_monitoring').css('background', 'none');
		$('#partial_test_trf').css('background', 'none');
		$('#all_test_trf').css('background', 'none');
		$('#reprocess_trf').css('background', 'none');
		$('#partial_test_result').css('background', 'none');
		$('#all_test_result').css('background', 'none');
		$('#reprocess_all_test').css('background', 'none');

		$('#machine_stopage_daily_data_input').css('background', 'none');

		$('#partial_test_report').css('background', 'none');
		$('#all_test_report').css('background', 'none');
		$('#customized_report').css('background', 'none');
		$('#pp_progress_report').css('background', 'none');
		$('#pp_status_report').css('background', 'none');

		load_page('settings/test_method_name.php');
	}

	function change_add_test_method_for_customer_button_color() {
		$('#create_user_list').css('background', 'none');
		$('#user_list').css('background', 'none');
		$('#department_info').css('background', 'none');
		$('#designation_info').css('background', 'none');

		$('#key_account_manager').css('background', 'none');
		$('#add_customer').css('background', 'none');
		$('#add_process_technique').css('background', 'none');
		$('#add_color').css('background', 'none');
		
		$('#add_process_name').css('background', 'none');
		$('#add_trolley').css('background', 'none');
		$('#add_machine').css('background', 'none');
		$('#add_machine_owner').css('background', 'none');
		$('#add_test_name').css('background', 'none');
		$('#add_test_method_name').css('background', 'none');
		$('#add_test_method_for_customer').css('background', 'black');
		$('#add_version_of_pp').css('background', 'none');
		$('#add_construction').css('background', 'none');
		$('#add_machine_stoppage_problems').css('background', 'none');

		$('#auto_sync').css('background', 'none');
		$('#auto_sync_list').css('background', 'none');

		$('#add_pp_creation').css('background', 'none');
		$('#pp_wise_version_creation').css('background', 'none');
		$('#adding_process_to_version').css('background', 'none');
		$('#quickly_defining_qc_standard_for_individual_process').css('background', 'none');
		$('#pp_monitoring').css('background', 'none');
		$('#partial_test_trf').css('background', 'none');
		$('#all_test_trf').css('background', 'none');
		$('#reprocess_trf').css('background', 'none');
		$('#partial_test_result').css('background', 'none');
		$('#all_test_result').css('background', 'none');
		$('#reprocess_all_test').css('background', 'none');

		$('#machine_stopage_daily_data_input').css('background', 'none');

		$('#partial_test_report').css('background', 'none');
		$('#all_test_report').css('background', 'none');
		$('#customized_report').css('background', 'none');
		$('#pp_progress_report').css('background', 'none');
		$('#pp_status_report').css('background', 'none');

		load_page('settings/test_method_for_customer.php');
	}

	function change_add_version_of_pp_button_color() {
		$('#create_user_list').css('background', 'none');
		$('#user_list').css('background', 'none');
		$('#department_info').css('background', 'none');
		$('#designation_info').css('background', 'none');

		$('#key_account_manager').css('background', 'none');
		$('#add_customer').css('background', 'none');
		$('#add_process_technique').css('background', 'none');
		$('#add_color').css('background', 'none');
		
		$('#add_process_name').css('background', 'none');
		$('#add_trolley').css('background', 'none');
		$('#add_machine').css('background', 'none');
		$('#add_machine_owner').css('background', 'none');
		$('#add_test_name').css('background', 'none');
		$('#add_test_method_name').css('background', 'none');
		$('#add_test_method_for_customer').css('background', 'none');
		$('#add_version_of_pp').css('background', 'black');
		$('#add_construction').css('background', 'none');
		$('#add_machine_stoppage_problems').css('background', 'none');

		$('#auto_sync').css('background', 'none');
		$('#auto_sync_list').css('background', 'none');

		$('#add_pp_creation').css('background', 'none');
		$('#pp_wise_version_creation').css('background', 'none');
		$('#adding_process_to_version').css('background', 'none');
		$('#quickly_defining_qc_standard_for_individual_process').css('background', 'none');
		$('#pp_monitoring').css('background', 'none');
		$('#partial_test_trf').css('background', 'none');
		$('#all_test_trf').css('background', 'none');
		$('#reprocess_trf').css('background', 'none');
		$('#partial_test_result').css('background', 'none');
		$('#all_test_result').css('background', 'none');
		$('#reprocess_all_test').css('background', 'none');

		$('#machine_stopage_daily_data_input').css('background', 'none');

		$('#partial_test_report').css('background', 'none');
		$('#all_test_report').css('background', 'none');
		$('#customized_report').css('background', 'none');
		$('#pp_progress_report').css('background', 'none');
		$('#pp_status_report').css('background', 'none');

		load_page('settings/version_name.php');   
	}

	function change_add_construction_button_color() {
		$('#create_user_list').css('background', 'none');
		$('#user_list').css('background', 'none');
		$('#department_info').css('background', 'none');
		$('#designation_info').css('background', 'none');

		$('#key_account_manager').css('background', 'none');
		$('#add_customer').css('background', 'none');
		$('#add_process_technique').css('background', 'none');
		$('#add_color').css('background', 'none');
		
		$('#add_process_name').css('background', 'none');
		$('#add_trolley').css('background', 'none');
		$('#add_machine').css('background', 'none');
		$('#add_machine_owner').css('background', 'none');
		$('#add_test_name').css('background', 'none');
		$('#add_test_method_name').css('background', 'none');
		$('#add_test_method_for_customer').css('background', 'none');
		$('#add_version_of_pp').css('background', 'none');
		$('#add_construction').css('background', 'black');
		$('#add_machine_stoppage_problems').css('background', 'none');

		$('#auto_sync').css('background', 'none');
		$('#auto_sync_list').css('background', 'none');

		$('#add_pp_creation').css('background', 'none');
		$('#pp_wise_version_creation').css('background', 'none');
		$('#adding_process_to_version').css('background', 'none');
		$('#quickly_defining_qc_standard_for_individual_process').css('background', 'none');
		$('#pp_monitoring').css('background', 'none');
		$('#partial_test_trf').css('background', 'none');
		$('#all_test_trf').css('background', 'none');
		$('#reprocess_trf').css('background', 'none');
		$('#partial_test_result').css('background', 'none');
		$('#all_test_result').css('background', 'none');
		$('#reprocess_all_test').css('background', 'none');

		$('#machine_stopage_daily_data_input').css('background', 'none');

		$('#partial_test_report').css('background', 'none');
		$('#all_test_report').css('background', 'none');
		$('#customized_report').css('background', 'none');
		$('#pp_progress_report').css('background', 'none');
		$('#pp_status_report').css('background', 'none');

		load_page('settings/construction_for_version.php');
	}

	/******************* Auto Sync *****************************/
	function change_auto_sync_button_color()
	{
		$('#create_user_list').css('background', 'none');
		$('#user_list').css('background', 'none');
		$('#department_info').css('background', 'none');
		$('#designation_info').css('background', 'none');

		$('#key_account_manager').css('background', 'none');
		$('#add_customer').css('background', 'none');
		$('#add_process_technique').css('background', 'none');
		$('#add_color').css('background', 'none');
		
		$('#add_process_name').css('background', 'none');
		$('#add_trolley').css('background', 'none');
		$('#add_machine').css('background', 'none');
		$('#add_machine_owner').css('background', 'none');
		$('#add_test_name').css('background', 'none');
		$('#add_test_method_name').css('background', 'none');
		$('#add_test_method_for_customer').css('background', 'none');
		$('#add_version_of_pp').css('background', 'none');
		$('#add_construction').css('background', 'none');
		$('#add_machine_stoppage_problems').css('background', 'none');

		$('#auto_sync').css('background', 'black');
		$('#auto_sync_list').css('background', 'none');

		$('#add_pp_creation').css('background', 'none');
		$('#pp_wise_version_creation').css('background', 'none');
		$('#adding_process_to_version').css('background', 'none');
		$('#quickly_defining_qc_standard_for_individual_process').css('background', 'none');
		$('#pp_monitoring').css('background', 'none');
		$('#partial_test_trf').css('background', 'none');
		$('#all_test_trf').css('background', 'none');
		$('#reprocess_trf').css('background', 'none');
		$('#partial_test_result').css('background', 'none');
		$('#all_test_result').css('background', 'none');
		$('#reprocess_all_test').css('background', 'none');

		$('#machine_stopage_daily_data_input').css('background', 'none');

		$('#partial_test_report').css('background', 'none');
		$('#all_test_report').css('background', 'none');
		$('#customized_report').css('background', 'none');
		$('#pp_progress_report').css('background', 'none');
		$('#pp_status_report').css('background', 'none');

		load_page('auto_sync/auto_sync_info.php');
	}


	function change_auto_sync_list_button_color()
	{
		$('#create_user_list').css('background', 'none');
		$('#user_list').css('background', 'none');
		$('#department_info').css('background', 'none');
		$('#designation_info').css('background', 'none');

		$('#key_account_manager').css('background', 'none');
		$('#add_customer').css('background', 'none');
		$('#add_process_technique').css('background', 'none');
		$('#add_color').css('background', 'none');
		
		$('#add_process_name').css('background', 'none');
		$('#add_trolley').css('background', 'none');
		$('#add_machine').css('background', 'none');
		$('#add_machine_owner').css('background', 'none');
		$('#add_test_name').css('background', 'none');
		$('#add_test_method_name').css('background', 'none');
		$('#add_test_method_for_customer').css('background', 'none');
		$('#add_version_of_pp').css('background', 'none');
		$('#add_construction').css('background', 'none');
		$('#add_machine_stoppage_problems').css('background', 'none');

		$('#auto_sync').css('background', 'none');
		$('#auto_sync_list').css('background', 'black');

		$('#add_pp_creation').css('background', 'none');
		$('#pp_wise_version_creation').css('background', 'none');
		$('#adding_process_to_version').css('background', 'none');
		$('#quickly_defining_qc_standard_for_individual_process').css('background', 'none');
		$('#pp_monitoring').css('background', 'none');
		$('#partial_test_trf').css('background', 'none');
		$('#all_test_trf').css('background', 'none');
		$('#reprocess_trf').css('background', 'none');
		$('#partial_test_result').css('background', 'none');
		$('#all_test_result').css('background', 'none');
		$('#reprocess_all_test').css('background', 'none');

		$('#machine_stopage_daily_data_input').css('background', 'none');

		$('#partial_test_report').css('background', 'none');
		$('#all_test_report').css('background', 'none');
		$('#customized_report').css('background', 'none');
		$('#pp_progress_report').css('background', 'none');
		$('#pp_status_report').css('background', 'none');

		load_page('auto_sync/auto_sync_list.php');
	}

	/*******************Process Program*************************/

	function change_add_pp_creation_button_color() {
		$('#create_user_list').css('background', 'none');
		$('#user_list').css('background', 'none');
		$('#department_info').css('background', 'none');
		$('#designation_info').css('background', 'none');

		$('#key_account_manager').css('background', 'none');
		$('#add_customer').css('background', 'none');
		$('#add_process_technique').css('background', 'none');
		$('#add_color').css('background', 'none');
		
		$('#add_process_name').css('background', 'none');
		$('#add_trolley').css('background', 'none');
		$('#add_machine').css('background', 'none');
		$('#add_machine_owner').css('background', 'none');
		$('#add_test_name').css('background', 'none');
		$('#add_test_method_name').css('background', 'none');
		$('#add_test_method_for_customer').css('background', 'none');
		$('#add_version_of_pp').css('background', 'none');
		$('#add_construction').css('background', 'none');
		$('#add_machine_stoppage_problems').css('background', 'none');

		$('#auto_sync').css('background', 'none');
		$('#auto_sync_list').css('background', 'none');

		$('#add_pp_creation').css('background', 'black');
		$('#pp_wise_version_creation').css('background', 'none');
		$('#adding_process_to_version').css('background', 'none');
		$('#quickly_defining_qc_standard_for_individual_process').css('background', 'none');
		$('#pp_monitoring').css('background', 'none');
		$('#partial_test_trf').css('background', 'none');
		$('#all_test_trf').css('background', 'none');
		$('#reprocess_trf').css('background', 'none');
		$('#partial_test_result').css('background', 'none');
		$('#all_test_result').css('background', 'none');
		$('#reprocess_all_test').css('background', 'none');

		$('#machine_stopage_daily_data_input').css('background', 'none');

		$('#partial_test_report').css('background', 'none');
		$('#all_test_report').css('background', 'none');
		$('#customized_report').css('background', 'none');
		$('#pp_progress_report').css('background', 'none');
		$('#pp_status_report').css('background', 'none');

		load_page('process_program/process_program_info.php');
	}

	function change_pp_wise_version_creation_button_color() {
		$('#create_user_list').css('background', 'none');
		$('#user_list').css('background', 'none');
		$('#department_info').css('background', 'none');
		$('#designation_info').css('background', 'none');

		$('#key_account_manager').css('background', 'none');
		$('#add_customer').css('background', 'none');
		$('#add_process_technique').css('background', 'none');
		$('#add_color').css('background', 'none');
		
		$('#add_process_name').css('background', 'none');
		$('#add_trolley').css('background', 'none');
		$('#add_machine').css('background', 'none');
		$('#add_machine_owner').css('background', 'none');
		$('#add_test_name').css('background', 'none');
		$('#add_test_method_name').css('background', 'none');
		$('#add_test_method_for_customer').css('background', 'none');
		$('#add_version_of_pp').css('background', 'none');
		$('#add_construction').css('background', 'none');
		$('#add_machine_stoppage_problems').css('background', 'none');

		$('#auto_sync').css('background', 'none');
		$('#auto_sync_list').css('background', 'none');

		$('#add_pp_creation').css('background', 'none');
		$('#pp_wise_version_creation').css('background', 'black');
		$('#adding_process_to_version').css('background', 'none');
		$('#quickly_defining_qc_standard_for_individual_process').css('background', 'none');
		$('#pp_monitoring').css('background', 'none');
		$('#partial_test_trf').css('background', 'none');
		$('#all_test_trf').css('background', 'none');
		$('#reprocess_trf').css('background', 'none');
		$('#partial_test_result').css('background', 'none');
		$('#all_test_result').css('background', 'none');
		$('#reprocess_all_test').css('background', 'none');

		$('#machine_stopage_daily_data_input').css('background', 'none');

		$('#partial_test_report').css('background', 'none');
		$('#all_test_report').css('background', 'none');
		$('#customized_report').css('background', 'none');
		$('#pp_progress_report').css('background', 'none');
		$('#pp_status_report').css('background', 'none');

		load_page('process_program/pp_wise_version_creation_info.php');
	}

	function change_adding_process_to_version_button_color() {
		$('#create_user_list').css('background', 'none');
		$('#user_list').css('background', 'none');
		$('#department_info').css('background', 'none');
		$('#designation_info').css('background', 'none');

		$('#key_account_manager').css('background', 'none');
		$('#add_customer').css('background', 'none');
		$('#add_process_technique').css('background', 'none');
		$('#add_color').css('background', 'none');
		
		$('#add_process_name').css('background', 'none');
		$('#add_trolley').css('background', 'none');
		$('#add_machine').css('background', 'none');
		$('#add_machine_owner').css('background', 'none');
		$('#add_test_name').css('background', 'none');
		$('#add_test_method_name').css('background', 'none');
		$('#add_test_method_for_customer').css('background', 'none');
		$('#add_version_of_pp').css('background', 'none');
		$('#add_construction').css('background', 'none');
		$('#add_machine_stoppage_problems').css('background', 'none');

		$('#auto_sync').css('background', 'none');
		$('#auto_sync_list').css('background', 'none');

		$('#add_pp_creation').css('background', 'none');
		$('#pp_wise_version_creation').css('background', 'none');
		$('#adding_process_to_version').css('background', 'black');
		$('#quickly_defining_qc_standard_for_individual_process').css('background', 'none');
		$('#pp_monitoring').css('background', 'none');
		$('#partial_test_trf').css('background', 'none');
		$('#all_test_trf').css('background', 'none');
		$('#reprocess_trf').css('background', 'none');
		$('#partial_test_result').css('background', 'none');
		$('#all_test_result').css('background', 'none');
		$('#reprocess_all_test').css('background', 'none');

		$('#machine_stopage_daily_data_input').css('background', 'none');

		$('#partial_test_report').css('background', 'none');
		$('#all_test_report').css('background', 'none');
		$('#customized_report').css('background', 'none');
		$('#pp_progress_report').css('background', 'none');
		$('#pp_status_report').css('background', 'none');
		

		load_page('process_program/version_wise_process_info.php');  
	}


	function change_quickly_defining_qc_standard_for_individual_process_button_color() {
		$('#create_user_list').css('background', 'none');
		$('#user_list').css('background', 'none');
		$('#department_info').css('background', 'none');
		$('#designation_info').css('background', 'none');

		$('#key_account_manager').css('background', 'none');
		$('#add_customer').css('background', 'none');
		$('#add_process_technique').css('background', 'none');
		$('#add_color').css('background', 'none');
		
		$('#add_process_name').css('background', 'none');
		$('#add_trolley').css('background', 'none');
		$('#add_machine').css('background', 'none');
		$('#add_machine_owner').css('background', 'none');
		$('#add_test_name').css('background', 'none');
		$('#add_test_method_name').css('background', 'none');
		$('#add_test_method_for_customer').css('background', 'none');
		$('#add_version_of_pp').css('background', 'none');
		$('#add_construction').css('background', 'none');
		$('#add_machine_stoppage_problems').css('background', 'none');

		$('#auto_sync').css('background', 'none');
		$('#auto_sync_list').css('background', 'none');

		$('#add_pp_creation').css('background', 'none');
		$('#pp_wise_version_creation').css('background', 'none');
		$('#quickly_defining_qc_standard_for_individual_process').css('background', 'black');
		$('#adding_process_to_version').css('background', 'none');
		$('#pp_monitoring').css('background', 'none');
		$('#partial_test_trf').css('background', 'none');
		$('#all_test_trf').css('background', 'none');
		$('#reprocess_trf').css('background', 'none');
		$('#partial_test_result').css('background', 'none');
		$('#all_test_result').css('background', 'none');
		$('#reprocess_all_test').css('background', 'none');

		$('#machine_stopage_daily_data_input').css('background', 'none');

		$('#partial_test_report').css('background', 'none');
		$('#all_test_report').css('background', 'none');
		$('#customized_report').css('background', 'none');
		$('#pp_progress_report').css('background', 'none');
		$('#pp_status_report').css('background', 'none');
		

		load_page('process_program/quickly_defining_qc_standard_for_individual_process.php');  
	}
    

   /******************************** PP Monitoring*******************************************/

	function change_pp_monitoring_button_color() {
		$('#create_user_list').css('background', 'none');
		$('#user_list').css('background', 'none');
		$('#department_info').css('background', 'none');
		$('#designation_info').css('background', 'none');

		$('#key_account_manager').css('background', 'none');
		$('#add_customer').css('background', 'none');
		$('#add_process_technique').css('background', 'none');
		$('#add_color').css('background', 'none');
		
		$('#add_process_name').css('background', 'none');
		$('#add_trolley').css('background', 'none');
		$('#add_machine').css('background', 'none');
		$('#add_machine_owner').css('background', 'none');
		$('#add_test_name').css('background', 'none');
		$('#add_test_method_name').css('background', 'none');
		$('#add_test_method_for_customer').css('background', 'none');
		$('#add_version_of_pp').css('background', 'none');
		$('#add_construction').css('background', 'none');
		$('#add_machine_stoppage_problems').css('background', 'none');

		$('#auto_sync').css('background', 'none');
		$('#auto_sync_list').css('background', 'none');

		$('#add_pp_creation').css('background', 'none');
		$('#pp_wise_version_creation').css('background', 'none');
		$('#adding_process_to_version').css('background', 'none');
		$('#quickly_defining_qc_standard_for_individual_process').css('background', 'none');
		$('#pp_monitoring').css('background', 'black');
		$('#partial_test_trf').css('background', 'none');
		$('#all_test_trf').css('background', 'none');
		$('#reprocess_trf').css('background', 'none');
		$('#partial_test_result').css('background', 'none');
		$('#all_test_result').css('background', 'none');
		$('#reprocess_all_test').css('background', 'none');

		$('#machine_stopage_daily_data_input').css('background', 'none');

		$('#partial_test_report').css('background', 'none');
		$('#all_test_report').css('background', 'none');
		$('#customized_report').css('background', 'none');
		$('#pp_progress_report').css('background', 'none');
		$('#pp_status_report').css('background', 'none');
		

	    load_page('pp_monitoring/pp_monitoring.php');
	}
	/********************************Sample & Test Result*******************************************/


	function change_partial_test_trf_button_color() {
		$('#create_user_list').css('background', 'none');
		$('#user_list').css('background', 'none');
		$('#department_info').css('background', 'none');
		$('#designation_info').css('background', 'none');

		$('#key_account_manager').css('background', 'none');
		$('#add_customer').css('background', 'none');
		$('#add_process_technique').css('background', 'none');
		$('#add_color').css('background', 'none');
		
		$('#add_process_name').css('background', 'none');
		$('#add_trolley').css('background', 'none');
		$('#add_machine').css('background', 'none');
		$('#add_machine_owner').css('background', 'none');
		$('#add_test_name').css('background', 'none');
		$('#add_test_method_name').css('background', 'none');
		$('#add_test_method_for_customer').css('background', 'none');
		$('#add_version_of_pp').css('background', 'none');
		$('#add_construction').css('background', 'none');
		$('#add_machine_stoppage_problems').css('background', 'none');

		$('#auto_sync').css('background', 'none');
		$('#auto_sync_list').css('background', 'none');

		$('#add_pp_creation').css('background', 'none');
		$('#pp_wise_version_creation').css('background', 'none');
		$('#adding_process_to_version').css('background', 'none');
		$('#quickly_defining_qc_standard_for_individual_process').css('background', 'none');
		$('#pp_monitoring').css('background', 'none');
		$('#partial_test_trf').css('background', 'black');
		$('#all_test_trf').css('background', 'none');
		$('#reprocess_trf').css('background', 'none');
		$('#partial_test_result').css('background', 'none');
		$('#all_test_result').css('background', 'none');
		$('#reprocess_all_test').css('background', 'none');

		$('#machine_stopage_daily_data_input').css('background', 'none');

		$('#partial_test_report').css('background', 'none');
		$('#all_test_report').css('background', 'none');
		$('#customized_report').css('background', 'none');
		$('#pp_progress_report').css('background', 'none');
		$('#pp_status_report').css('background', 'none');
		

	    load_page('trf/partial_test_for_trf_info.php');
	}

	function change_all_test_trf_button_color() {
		$('#create_user_list').css('background', 'none');
		$('#user_list').css('background', 'none');
		$('#department_info').css('background', 'none');
		$('#designation_info').css('background', 'none');

		$('#key_account_manager').css('background', 'none');
		$('#add_customer').css('background', 'none');
		$('#add_process_technique').css('background', 'none');
		$('#add_color').css('background', 'none');
		
		$('#add_process_name').css('background', 'none');
		$('#add_trolley').css('background', 'none');
		$('#add_machine').css('background', 'none');
		$('#add_machine_owner').css('background', 'none');
		$('#add_test_name').css('background', 'none');
		$('#add_test_method_name').css('background', 'none');
		$('#add_test_method_for_customer').css('background', 'none');
		$('#add_version_of_pp').css('background', 'none');
		$('#add_construction').css('background', 'none');
		$('#add_machine_stoppage_problems').css('background', 'none');

		$('#auto_sync').css('background', 'none');
		$('#auto_sync_list').css('background', 'none');

		$('#add_pp_creation').css('background', 'none');
		$('#pp_wise_version_creation').css('background', 'none');
		$('#adding_process_to_version').css('background', 'none');
		$('#quickly_defining_qc_standard_for_individual_process').css('background', 'none');
		$('#pp_monitoring').css('background', 'none');

		$('#partial_test_trf').css('background', 'none');
		$('#all_test_trf').css('background', 'black');
		$('#reprocess_trf').css('background', 'none');
		$('#partial_test_result').css('background', 'none');
		$('#all_test_result').css('background', 'none');
		$('#reprocess_all_test').css('background', 'none');

		$('#machine_stopage_daily_data_input').css('background', 'none');

		$('#partial_test_report').css('background', 'none');
		$('#all_test_report').css('background', 'none');
		$('#customized_report').css('background', 'none');
		$('#pp_progress_report').css('background', 'none');
		$('#pp_status_report').css('background', 'none');
		

	    load_page('trf/all_test_for_trf_info.php');
	}

	function change_reprocess_trf_button_color() {
		$('#create_user_list').css('background', 'none');
		$('#user_list').css('background', 'none');
		$('#department_info').css('background', 'none');
		$('#designation_info').css('background', 'none');

		$('#key_account_manager').css('background', 'none');
		$('#add_customer').css('background', 'none');
		$('#add_process_technique').css('background', 'none');
		$('#add_color').css('background', 'none');
		
		$('#add_process_name').css('background', 'none');
		$('#add_trolley').css('background', 'none');
		$('#add_machine').css('background', 'none');
		$('#add_machine_owner').css('background', 'none');
		$('#add_test_name').css('background', 'none');
		$('#add_test_method_name').css('background', 'none');
		$('#add_test_method_for_customer').css('background', 'none');
		$('#add_version_of_pp').css('background', 'none');
		$('#add_construction').css('background', 'none');
		$('#add_machine_stoppage_problems').css('background', 'none');

		$('#auto_sync').css('background', 'none');
		$('#auto_sync_list').css('background', 'none');

		$('#add_pp_creation').css('background', 'none');
		$('#pp_wise_version_creation').css('background', 'none');
		$('#adding_process_to_version').css('background', 'none');
		$('#quickly_defining_qc_standard_for_individual_process').css('background', 'none');
		$('#pp_monitoring').css('background', 'none');
		$('#partial_test_trf').css('background', 'none');
		$('#all_test_trf').css('background', 'none');
		$('#reprocess_trf').css('background', 'black');
		$('#partial_test_result').css('background', 'none');
		$('#all_test_result').css('background', 'none');
		$('#reprocess_all_test').css('background', 'none');

		$('#machine_stopage_daily_data_input').css('background', 'none');

		$('#partial_test_report').css('background', 'none');
		$('#all_test_report').css('background', 'none');
		$('#customized_report').css('background', 'none');
		$('#pp_progress_report').css('background', 'none');
		$('#pp_status_report').css('background', 'none');
		

	    load_page('trf/reporcess_partial_test_for_trf_info.php');
	}

	function change_partial_test_result_button_color() {
		$('#create_user_list').css('background', 'none');
		$('#user_list').css('background', 'none');
		$('#department_info').css('background', 'none');
		$('#designation_info').css('background', 'none');

		$('#key_account_manager').css('background', 'none');
		$('#add_customer').css('background', 'none');
		$('#add_process_technique').css('background', 'none');
		$('#add_color').css('background', 'none');
		
		$('#add_process_name').css('background', 'none');
		$('#add_trolley').css('background', 'none');
		$('#add_machine').css('background', 'none');
		$('#add_machine_owner').css('background', 'none');
		$('#add_test_name').css('background', 'none');
		$('#add_test_method_name').css('background', 'none');
		$('#add_test_method_for_customer').css('background', 'none');
		$('#add_version_of_pp').css('background', 'none');
		$('#add_construction').css('background', 'none');
		$('#add_machine_stoppage_problems').css('background', 'none');

		$('#auto_sync').css('background', 'none');
		$('#auto_sync_list').css('background', 'none');

		$('#add_pp_creation').css('background', 'none');
		$('#pp_wise_version_creation').css('background', 'none');
		$('#adding_process_to_version').css('background', 'none');
		$('#quickly_defining_qc_standard_for_individual_process').css('background', 'none');
		$('#pp_monitoring').css('background', 'none');
		$('#partial_test_trf').css('background', 'none');
		$('#all_test_trf').css('background', 'none');
		$('#reprocess_trf').css('background', 'none');
		$('#partial_test_result').css('background', 'black');
		$('#all_test_result').css('background', 'none');
		$('#reprocess_all_test').css('background', 'none');

		$('#machine_stopage_daily_data_input').css('background', 'none');

		$('#partial_test_report').css('background', 'none');
		$('#all_test_report').css('background', 'none');
		$('#customized_report').css('background', 'none');
		$('#pp_progress_report').css('background', 'none');
		$('#pp_status_report').css('background', 'none');
		

	    load_page('test_result/partial_test_for_test_result_info.php');
	}

	function change_all_test_result_button_color() {
		$('#create_user_list').css('background', 'none');
		$('#user_list').css('background', 'none');
		$('#department_info').css('background', 'none');
		$('#designation_info').css('background', 'none');

		$('#key_account_manager').css('background', 'none');
		$('#add_customer').css('background', 'none');
		$('#add_process_technique').css('background', 'none');
		$('#add_color').css('background', 'none');
		
		$('#add_process_name').css('background', 'none');
		$('#add_trolley').css('background', 'none');
		$('#add_machine').css('background', 'none');
		$('#add_machine_owner').css('background', 'none');
		$('#add_test_name').css('background', 'none');
		$('#add_test_method_name').css('background', 'none');
		$('#add_test_method_for_customer').css('background', 'none');
		$('#add_version_of_pp').css('background', 'none');
		$('#add_construction').css('background', 'none');
		$('#add_machine_stoppage_problems').css('background', 'none');

		$('#auto_sync').css('background', 'none');
		$('#auto_sync_list').css('background', 'none');

		$('#add_pp_creation').css('background', 'none');
		$('#pp_wise_version_creation').css('background', 'none');
		$('#adding_process_to_version').css('background', 'none');
		$('#quickly_defining_qc_standard_for_individual_process').css('background', 'none');
		$('#pp_monitoring').css('background', 'none');
		$('#partial_test_trf').css('background', 'none');
		$('#all_test_trf').css('background', 'none');
		$('#reprocess_trf').css('background', 'none');

		$('#machine_stopage_daily_data_input').css('background', 'none');

		$('#partial_test_result').css('background', 'none');
		$('#all_test_result').css('background', 'black');
		$('#reprocess_all_test').css('background', 'none');
		$('#partial_test_report').css('background', 'none');
		$('#all_test_report').css('background', 'none');
		$('#customized_report').css('background', 'none');
		$('#pp_progress_report').css('background', 'none');
		$('#pp_status_report').css('background', 'none');
		

	    load_page('test_result/all_test_for_test_result_info.php');
	}


	function change_reprocess_all_test_button_color() {
		$('#create_user_list').css('background', 'none');
		$('#user_list').css('background', 'none');
		$('#department_info').css('background', 'none');
		$('#designation_info').css('background', 'none');

		$('#key_account_manager').css('background', 'none');
		$('#add_customer').css('background', 'none');
		$('#add_process_technique').css('background', 'none');
		$('#add_color').css('background', 'none');
		
		$('#add_process_name').css('background', 'none');
		$('#add_trolley').css('background', 'none');
		$('#add_machine').css('background', 'none');
		$('#add_machine_owner').css('background', 'none');
		$('#add_test_name').css('background', 'none');
		$('#add_test_method_name').css('background', 'none');
		$('#add_test_method_for_customer').css('background', 'none');
		$('#add_version_of_pp').css('background', 'none');
		$('#add_construction').css('background', 'none');
		$('#add_machine_stoppage_problems').css('background', 'none');

		$('#auto_sync').css('background', 'none');
		$('#auto_sync_list').css('background', 'none');

		$('#add_pp_creation').css('background', 'none');
		$('#pp_wise_version_creation').css('background', 'none');
		$('#adding_process_to_version').css('background', 'none');
		$('#quickly_defining_qc_standard_for_individual_process').css('background', 'none');
		$('#pp_monitoring').css('background', 'none');
		$('#partial_test_trf').css('background', 'none');
		$('#all_test_trf').css('background', 'none');
		$('#reprocess_trf').css('background', 'none');
		$('#partial_test_result').css('background', 'none');
		$('#all_test_result').css('background', 'none');
		$('#reprocess_all_test').css('background', 'black');

		$('#machine_stopage_daily_data_input').css('background', 'none');

		$('#partial_test_report').css('background', 'none');
		$('#all_test_report').css('background', 'none');
		$('#customized_report').css('background', 'none');
		$('#pp_progress_report').css('background', 'none');
		$('#pp_status_report').css('background', 'none');
		

	    load_page('test_result/reprocess_partial_test_for_test_result_info.php');
	}

/***********************************Machine Stopage*************************************/

	function change_machine_stopage_daily_data_input_color() 
	{
		$('#create_user_list').css('background', 'none');
		$('#user_list').css('background', 'none');
		$('#department_info').css('background', 'none');
		$('#designation_info').css('background', 'none');

		$('#key_account_manager').css('background', 'none');
		$('#add_customer').css('background', 'none');
		$('#add_process_technique').css('background', 'none');
		$('#add_color').css('background', 'none');
		
		$('#add_process_name').css('background', 'none');
		$('#add_trolley').css('background', 'none');
		$('#add_machine').css('background', 'none');
		$('#add_machine_owner').css('background', 'none');
		$('#add_test_name').css('background', 'none');
		$('#add_test_method_name').css('background', 'none');
		$('#add_test_method_for_customer').css('background', 'none');
		$('#add_version_of_pp').css('background', 'none');
		$('#add_construction').css('background', 'none');
		$('#add_machine_stoppage_problems').css('background', 'none');

		$('#auto_sync').css('background', 'none');
		$('#auto_sync_list').css('background', 'none');

		$('#add_pp_creation').css('background', 'none');
		$('#pp_wise_version_creation').css('background', 'none');
		$('#adding_process_to_version').css('background', 'none');
		$('#quickly_defining_qc_standard_for_individual_process').css('background', 'none');
		$('#pp_monitoring').css('background', 'none');
		$('#partial_test_trf').css('background', 'none');
		$('#all_test_trf').css('background', 'none');
		$('#reprocess_trf').css('background', 'none');
		$('#partial_test_result').css('background', 'none');
		$('#all_test_result').css('background', 'none');
		$('#reprocess_all_test').css('background', 'none');

		$('#machine_stopage_daily_data_input').css('background', 'black');

		$('#partial_test_report').css('background', 'none');
		$('#all_test_report').css('background', 'none');
		$('#customized_report').css('background', 'none');
		$('#pp_progress_report').css('background', 'none');
		$('#pp_status_report').css('background', 'none');
		

	    load_page('machine_stopage/machine_stopage_daily_data_input.php');
	}

/***********************************Test Report*************************************/
	function change_partial_test_report_button_color() {
		$('#create_user_list').css('background', 'none');
		$('#user_list').css('background', 'none');
		$('#department_info').css('background', 'none');
		$('#designation_info').css('background', 'none');

		$('#key_account_manager').css('background', 'none');
		$('#add_customer').css('background', 'none');
		$('#add_process_technique').css('background', 'none');
		$('#add_color').css('background', 'none');
		
		$('#add_process_name').css('background', 'none');
		$('#add_trolley').css('background', 'none');
		$('#add_machine').css('background', 'none');
		$('#add_machine_owner').css('background', 'none');
		$('#add_test_name').css('background', 'none');
		$('#add_test_method_name').css('background', 'none');
		$('#add_test_method_for_customer').css('background', 'none');
		$('#add_version_of_pp').css('background', 'none');
		$('#add_construction').css('background', 'none');
		$('#add_machine_stoppage_problems').css('background', 'none');

		$('#auto_sync').css('background', 'none');
		$('#auto_sync_list').css('background', 'none');

		$('#add_pp_creation').css('background', 'none');
		$('#pp_wise_version_creation').css('background', 'none');
		$('#adding_process_to_version').css('background', 'none');
		$('#quickly_defining_qc_standard_for_individual_process').css('background', 'none');
		$('#pp_monitoring').css('background', 'none');
		$('#partial_test_trf').css('background', 'none');
		$('#all_test_trf').css('background', 'none');
		$('#reprocess_trf').css('background', 'none');
		$('#partial_test_result').css('background', 'none');
		$('#all_test_result').css('background', 'none');
		$('#reprocess_all_test').css('background', 'none');

		$('#machine_stopage_daily_data_input').css('background', 'none');

		$('#partial_test_report').css('background', 'black');
		$('#all_test_report').css('background', 'none');
		$('#customized_report').css('background', 'none');
		$('#pp_progress_report').css('background', 'none');
		$('#pp_status_report').css('background', 'none');
		

	    load_page('report/partial_test_report_form.php');
	}
	function change_all_test_report_button_color() {
		$('#create_user_list').css('background', 'none');
		$('#user_list').css('background', 'none');
		$('#department_info').css('background', 'none');
		$('#designation_info').css('background', 'none');

		$('#key_account_manager').css('background', 'none');
		$('#add_customer').css('background', 'none');
		$('#add_process_technique').css('background', 'none');
		$('#add_color').css('background', 'none');
		
		$('#add_process_name').css('background', 'none');
		$('#add_trolley').css('background', 'none');
		$('#add_machine').css('background', 'none');
		$('#add_machine_owner').css('background', 'none');
		$('#add_test_name').css('background', 'none');
		$('#add_test_method_name').css('background', 'none');
		$('#add_test_method_for_customer').css('background', 'none');
		$('#add_version_of_pp').css('background', 'none');
		$('#add_construction').css('background', 'none');
		$('#add_machine_stoppage_problems').css('background', 'none');

		$('#auto_sync').css('background', 'none');
		$('#auto_sync_list').css('background', 'none');

		$('#add_pp_creation').css('background', 'none');
		$('#pp_wise_version_creation').css('background', 'none');
		$('#adding_process_to_version').css('background', 'none');
		$('#quickly_defining_qc_standard_for_individual_process').css('background', 'none');
		$('#pp_monitoring').css('background', 'none');
		$('#partial_test_trf').css('background', 'none');
		$('#all_test_trf').css('background', 'none');
		$('#reprocess_trf').css('background', 'none');
		$('#partial_test_result').css('background', 'none');
		$('#all_test_result').css('background', 'none');
		$('#reprocess_all_test').css('background', 'none');

		$('#machine_stopage_daily_data_input').css('background', 'none');

		$('#partial_test_report').css('background', 'none');
		$('#all_test_report').css('background', 'black');
		$('#customized_report').css('background', 'none');
		$('#pp_progress_report').css('background', 'none');
		$('#pp_status_report').css('background', 'none');
		

	    load_page('report/all_test_report_form.php');
	}

	function change_customized_report_button_color() {
		$('#create_user_list').css('background', 'none');
		$('#user_list').css('background', 'none');
		$('#department_info').css('background', 'none');
		$('#designation_info').css('background', 'none');

		$('#key_account_manager').css('background', 'none');
		$('#add_customer').css('background', 'none');
		$('#add_process_technique').css('background', 'none');
		$('#add_color').css('background', 'none');
		
		$('#add_process_name').css('background', 'none');
		$('#add_trolley').css('background', 'none');
		$('#add_machine').css('background', 'none');
		$('#add_machine_owner').css('background', 'none');
		$('#add_test_name').css('background', 'none');
		$('#add_test_method_name').css('background', 'none');
		$('#add_test_method_for_customer').css('background', 'none');
		$('#add_version_of_pp').css('background', 'none');
		$('#add_construction').css('background', 'none');
		$('#add_machine_stoppage_problems').css('background', 'none');

		$('#auto_sync').css('background', 'none');
		$('#auto_sync_list').css('background', 'none');

		$('#add_pp_creation').css('background', 'none');
		$('#pp_wise_version_creation').css('background', 'none');
		$('#adding_process_to_version').css('background', 'none');
		$('#quickly_defining_qc_standard_for_individual_process').css('background', 'none');
		$('#pp_monitoring').css('background', 'none');
		$('#partial_test_trf').css('background', 'none');
		$('#all_test_trf').css('background', 'none');
		$('#reprocess_trf').css('background', 'none');
		$('#partial_test_result').css('background', 'none');
		$('#all_test_result').css('background', 'none');
		$('#reprocess_all_test').css('background', 'none');

		$('#machine_stopage_daily_data_input').css('background', 'none');

		$('#partial_test_report').css('background', 'none');
		$('#all_test_report').css('background', 'none');
		$('#customized_report').css('background', 'black');
		$('#pp_progress_report').css('background', 'none');
		$('#pp_status_report').css('background', 'none');
		

	    load_page('customized_report/customized_report_for_partial_test.php');   
	}

	function change_pp_progress_report_button_color() {
		$('#create_user_list').css('background', 'none');
		$('#user_list').css('background', 'none');
		$('#department_info').css('background', 'none');
		$('#designation_info').css('background', 'none');

		$('#key_account_manager').css('background', 'none');
		$('#add_customer').css('background', 'none');
		$('#add_process_technique').css('background', 'none');
		$('#add_color').css('background', 'none');
		
		$('#add_process_name').css('background', 'none');
		$('#add_trolley').css('background', 'none');
		$('#add_machine').css('background', 'none');
		$('#add_machine_owner').css('background', 'none');
		$('#add_test_name').css('background', 'none');
		$('#add_test_method_name').css('background', 'none');
		$('#add_test_method_for_customer').css('background', 'none');
		$('#add_version_of_pp').css('background', 'none');
		$('#add_construction').css('background', 'none');
		$('#add_machine_stoppage_problems').css('background', 'none');

		$('#auto_sync').css('background', 'none');
		$('#auto_sync_list').css('background', 'none');

		$('#add_pp_creation').css('background', 'none');
		$('#pp_wise_version_creation').css('background', 'none');
		$('#adding_process_to_version').css('background', 'none');
		$('#quickly_defining_qc_standard_for_individual_process').css('background', 'none');
		$('#pp_monitoring').css('background', 'none');
		$('#partial_test_trf').css('background', 'none');
		$('#all_test_trf').css('background', 'none');
		$('#reprocess_trf').css('background', 'none');
		$('#partial_test_result').css('background', 'none');
		$('#all_test_result').css('background', 'none');
		$('#reprocess_all_test').css('background', 'none');

		$('#machine_stopage_daily_data_input').css('background', 'none');

		$('#partial_test_report').css('background', 'none');
		$('#all_test_report').css('background', 'none');
		$('#customized_report').css('background', 'none');
		$('#pp_progress_report').css('background', 'black');
		$('#pp_status_report').css('background', 'none');
		

	     load_page('pp_progress_report/pp_progress_report.php');
	}

	function change_pp_status_report_button_color() {
		$('#create_user_list').css('background', 'none');
		$('#user_list').css('background', 'none');
		$('#department_info').css('background', 'none');
		$('#designation_info').css('background', 'none');

		$('#key_account_manager').css('background', 'none');
		$('#add_customer').css('background', 'none');
		$('#add_process_technique').css('background', 'none');
		$('#add_color').css('background', 'none');
		
		$('#add_process_name').css('background', 'none');
		$('#add_trolley').css('background', 'none');
		$('#add_machine').css('background', 'none');
		$('#add_machine_owner').css('background', 'none');
		$('#add_test_name').css('background', 'none');
		$('#add_test_method_name').css('background', 'none');
		$('#add_test_method_for_customer').css('background', 'none');
		$('#add_version_of_pp').css('background', 'none');
		$('#add_construction').css('background', 'none');
		$('#add_machine_stoppage_problems').css('background', 'none');

		$('#auto_sync').css('background', 'none');
		$('#auto_sync_list').css('background', 'none');

		$('#add_pp_creation').css('background', 'none');
		$('#pp_wise_version_creation').css('background', 'none');
		$('#adding_process_to_version').css('background', 'none');
		$('#quickly_defining_qc_standard_for_individual_process').css('background', 'none');
		$('#pp_monitoring').css('background', 'none');
		$('#partial_test_trf').css('background', 'none');
		$('#all_test_trf').css('background', 'none');
		$('#reprocess_trf').css('background', 'none');
		$('#partial_test_result').css('background', 'none');
		$('#all_test_result').css('background', 'none');
		$('#reprocess_all_test').css('background', 'none');

		$('#machine_stopage_daily_data_input').css('background', 'none');

		$('#partial_test_report').css('background', 'none');
		$('#all_test_report').css('background', 'none');
		$('#customized_report').css('background', 'none');
		$('#pp_progress_report').css('background', 'none');
		$('#pp_status_report').css('background', 'black');
		

	    load_page('pp_progress_report/pp_status_report_filtering.php');
	}

	function change_designation_info_button_color()
	{
		$('#create_user_list').css('background', 'none');
		$('#user_list').css('background', 'none');
		$('#department_info').css('background', 'none');
		$('#designation_info').css('background', 'black');

		$('#key_account_manager').css('background', 'none');
		$('#add_customer').css('background', 'none');
		$('#add_process_technique').css('background', 'none');
		$('#add_color').css('background', 'none');
		
		$('#add_process_name').css('background', 'none');
		$('#add_trolley').css('background', 'none');
		$('#add_machine').css('background', 'none');
		$('#add_machine_owner').css('background', 'none');
		$('#add_test_name').css('background', 'none');
		$('#add_test_method_name').css('background', 'none');
		$('#add_test_method_for_customer').css('background', 'none');
		$('#add_version_of_pp').css('background', 'none');
		$('#add_construction').css('background', 'none');
		$('#add_machine_stoppage_problems').css('background', 'none');

		$('#auto_sync').css('background', 'none');
		$('#auto_sync_list').css('background', 'none');

		$('#add_pp_creation').css('background', 'none');
		$('#pp_wise_version_creation').css('background', 'none');
		$('#adding_process_to_version').css('background', 'none');
		$('#quickly_defining_qc_standard_for_individual_process').css('background', 'none');
		$('#pp_monitoring').css('background', 'none');
		$('#partial_test_trf').css('background', 'none');
		$('#all_test_trf').css('background', 'none');
		$('#reprocess_trf').css('background', 'none');
		$('#partial_test_result').css('background', 'none');
		$('#all_test_result').css('background', 'none');
		$('#reprocess_all_test').css('background', 'none');

		$('#machine_stopage_daily_data_input').css('background', 'none');

		$('#partial_test_report').css('background', 'none');
		$('#all_test_report').css('background', 'none');
		$('#customized_report').css('background', 'none');
		$('#pp_progress_report').css('background', 'none');
		$('#pp_status_report').css('background', 'none');

		load_page('user/designation_info.php');
	}

	function change_add_machine_stoppage_problems_color()
	{
		$('#create_user_list').css('background', 'none');
		$('#user_list').css('background', 'none');
		$('#department_info').css('background', 'none');
		$('#designation_info').css('background', 'none');

		$('#key_account_manager').css('background', 'none');
		$('#add_customer').css('background', 'none');
		$('#add_process_technique').css('background', 'none');
		$('#add_color').css('background', 'none');
		
		$('#add_process_name').css('background', 'none');
		$('#add_trolley').css('background', 'none');
		$('#add_machine').css('background', 'none');
		$('#add_machine_owner').css('background', 'none');
		$('#add_test_name').css('background', 'none');
		$('#add_test_method_name').css('background', 'none');
		$('#add_test_method_for_customer').css('background', 'none');
		$('#add_version_of_pp').css('background', 'none');
		$('#add_construction').css('background', 'none');

		$('#add_machine_stoppage_problems').css('background', 'black');

		$('#auto_sync').css('background', 'none');
		$('#auto_sync_list').css('background', 'none');

		$('#add_pp_creation').css('background', 'none');
		$('#pp_wise_version_creation').css('background', 'none');
		$('#adding_process_to_version').css('background', 'none');
		$('#quickly_defining_qc_standard_for_individual_process').css('background', 'none');
		$('#pp_monitoring').css('background', 'none');
		$('#partial_test_trf').css('background', 'none');
		$('#all_test_trf').css('background', 'none');
		$('#reprocess_trf').css('background', 'none');
		$('#partial_test_result').css('background', 'none');
		$('#all_test_result').css('background', 'none');
		$('#reprocess_all_test').css('background', 'none');

		$('#machine_stopage_daily_data_input').css('background', 'none');

		$('#partial_test_report').css('background', 'none');
		$('#all_test_report').css('background', 'none');
		$('#customized_report').css('background', 'none');
		$('#pp_progress_report').css('background', 'none');
		$('#pp_status_report').css('background', 'none');

		load_page('settings/add_problems_of_machine_stopage.php');
	}

	function onlcick_problem()
	{
		alert("Please make sure double click for open chart");
	}

</script>
<style>
	.sidepanel  {
  width: 0;
  position: fixed;
  z-index: 1;
  height: 250px;
  top: 0;
  left: 0;
  background-color: #111;
  overflow-x: hidden;
  transition: 0.5s;
  padding-top: 60px;
}

.sidepanel a {
  padding: 8px 8px 8px 32px;
  text-decoration: none;
  font-size: 25px;
  color: #818181;
  display: block;
  transition: 0.3s;
}

.sidepanel a:hover {
  color: #f1f1f1;
}

.sidepanel .closebtn {
  position: absolute;
  top: 0;
  right: 25px;
  font-size: 36px;
}

.openbtn {
  font-size: 20px;
  cursor: pointer;
  background-color: #111;
  color: white;
  padding: 10px 15px;
  border: none;
}

.openbtn:hover {
  background-color:#444;
}
</style>
<!-- <div>
	<button type="button" class="openbtn" onclick="openNav()">☰ </button>  		
</div> -->

<script>
// function openNav() {
//   document.getElementById("mySidepanel").style.width = "250px";
// }

// function closeNav() {
//   document.getElementById("mySidepanel").style.width = "0";
// }
</script>

<!-- <div id="mySidepanel" class="sidepanel"> -->
<!-- <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">×</a> -->

	<div class="col-sm-3 col-md-3 col-lg-3" style="background-color:#0C2D48; min-height:100%; width: 15%;">									
		<h3>
			<img src="img/ZnZ.jpg" style="width: 30px; height:30px; margin-bottom: 4px; background: #ffffff;" class="img-rounded"/>
			<span class="text-primary" style="color:#FFFFFF">Noman Group</span>
		</h3>
									
		<!-- <img src="img/8571-1.JPG" style="width: 30px; height:30px; margin-bottom: 4px; background: #ffffff;" class="img-circle" alt="100x100"> -->
		<img src="img/<?php echo $row['profile_picture'] ?>" alt="..." class="img-circle profile_img" style="width: 30px; height:30px; margin-bottom: 4px; background: #ffffff;">

		<span class="text-primary" style="color:#FFFFFF; margin-left:5px;">Welcome, <?php echo $user_name;?></span>
		<br/>
		<span class="text-primary" style="color:#FFFFFF; margin-left:5px;"><?php echo $user_type;?> View</span>

		<!-- Add All Your Left Side Menu=>Submenu From Here in Accordion Menu -->
										
		<div id="accordion" class="accordion_menu">
			<h3 style="font-size: 13px; color:#FFFFFF; background:none;"><span class="glyphicon glyphicon-user"></span>&nbsp;User </h3>
			<div style="padding-left:7px;">
				<button class="sub_menu panel text-left"  onclick="change_create_user_button_color()" id='create_user_list'><span  style="font-size: 11px;" >Create User</span></button>
				<button class="sub_menu panel text-left" onclick="change_create_button_color()" id='user_list'><span style="font-size: 11px;">User List</span></button>
				<button class="sub_menu panel text-left" onclick="change_department_info_button_color()" id="department_info"><span style="font-size: 11px;">Department Info</span></button>
				<button class="sub_menu panel text-left" onclick="change_designation_info_button_color()" id="designation_info"><span style="font-size: 11px;">Designation Info</span></button>

			</div>
			<h3 style="font-size: 13px; color:#FFFFFF; background:none;">Settings</h3>
			<div style="padding-left:7px;">
				<button class="sub_menu panel text-left" onclick="change_key_account_manager_button_color()" id="key_account_manager"><span style="font-size: 11px;">Add key Account Manager</span></button>
				<button class="sub_menu panel text-left" onclick="change_add_customer_button_color()" id="add_customer"><span style="font-size: 11px;">Add Customer</span></button>
				<button class="sub_menu panel text-left" onclick="change_add_process_technique_button_color()" id="add_process_technique"><span style="font-size: 11px;">Add Process Technique</span></button>
				<button class="sub_menu panel text-left" onclick="change_add_color_button_color()" id="add_color"><span style="font-size: 11px;">Add Color Name</span></button>
				
				<button class="sub_menu panel text-left" onclick="change_add_process_name_button_color()" id="add_process_name"><span style="font-size: 11px;">Add Process Name</span></button>
				<button class="sub_menu panel text-left" onclick="change_add_trolley_button_color()" id="add_trolley"><span style="font-size: 11px;">Add Trolley</span></button>
				<button class="sub_menu panel text-left"  onclick="change_add_machine_button_color()" id="add_machine"><span style="font-size: 11px;">Add Machine Name</span></button>
				<button class="sub_menu panel text-left" onclick="change_add_machine_owner_button_color()" id="add_machine_owner"><span style="font-size: 11px;">Add Machine Owner Name</span></button>
				<button class="sub_menu panel text-left" onclick="change_add_test_name_button_color()" id="add_test_name"><span style="font-size: 11px;">Add Test Name</span></button>
				<button class="sub_menu panel text-left" onclick="change_add_test_method_name_button_color()" id="add_test_method_name"><span style="font-size: 11px;">Add Test Method Name</span></button>
				<button class="sub_menu panel text-left" onclick="change_add_test_method_for_customer_button_color()" id="add_test_method_for_customer"><span style="font-size: 11px;">Add Test Method for Customer</span></button>
				<button class="sub_menu panel text-left" onclick="change_add_version_of_pp_button_color()" id="add_version_of_pp"><span style="font-size: 11px;">Add Version of PP</span></button>
				<button class="sub_menu panel text-left" onclick="change_add_construction_button_color()" id="add_construction"><span style="font-size: 11px;">Add Construction</span></button>
				<button class="sub_menu panel text-left" onclick="change_add_machine_stoppage_problems_color()" id="add_machine_stoppage_problems"><span style="font-size: 11px;">Machine Stoppage Problems</span></button>
				
			</div>

			<h3 style="font-size: 13px; color:#FFFFFF; background:none;">Auto Sync</h3>
			<div style="padding-left:7px;">
				
				<button class="sub_menu panel text-left" onclick="change_auto_sync_button_color()" id="auto_sync"><span style="font-size: 11px;">Auto Sync</span></button>

				<button class="sub_menu panel text-left" onclick="change_auto_sync_list_button_color()" id="auto_sync_list"><span style="font-size: 11px;">Auto Sync List</span></button>
			
			</div>

			<h3 style="font-size: 13px; color:#FFFFFF; background:none;">Process Program</h3>
			<div style="padding-left:7px;">
			<button class="sub_menu panel text-left" onclick="change_add_pp_creation_button_color()" id="add_pp_creation"><span style="font-size: 11px;">PP Creation</span></button>
			<button class="sub_menu panel text-left" onclick="change_pp_wise_version_creation_button_color()" id="pp_wise_version_creation"><span style="font-size: 11px;">PP Wise Version Creation</span></button>
			
			<button class="sub_menu panel text-left" onclick="change_adding_process_to_version_button_color()" id="adding_process_to_version"><span style="font-size: 11px;">Adding Process to Version</span></button>


			<button class="sub_menu panel text-left" onclick="change_quickly_defining_qc_standard_for_individual_process_button_color()" id="quickly_defining_qc_standard_for_individual_process"><span style="font-size: 11px;">Quickly Defining Qc Standard for Individual Process</span></button>

		

			<!-- <button class="sub_menu panel text-left" onClick="load_page('process_program/quickly_defining_qc_standard_for_individual_process.php')"><span style="font-size: 11px;">Quickly Defining Qc Standard for Individual Process</span></button>

			<button class="sub_menu panel text-left" onClick="load_page('copy/multiple_copy_form.php')"><span style="font-size: 11px;">Single/Multiple Copy </span></button>
			-->
			
			</div>


			


			<h3 style="font-size: 13px; color:#FFFFFF; background:none;">PP Monitoring</h3>
			<div style="padding-left:7px;">
				
				<button class="sub_menu panel text-left" onclick="change_pp_monitoring_button_color()" id="pp_monitoring"><span style="font-size: 11px;">PP Monitoring</span></button>
			
			</div>

			<h3 style="font-size: 13px; color:#FFFFFF; background:none;">Sample & Test Result</h3>
			<div style="padding-left:7px;">
				<h3 style="font-size: 13px; color:#FFFFFF; background:none;"> TRF</h3>
				<button class="sub_menu panel text-left" onclick="change_partial_test_trf_button_color()" id="partial_test_trf"><span style="font-size: 11px;">Partial Test</span></button>
				<button class="sub_menu panel text-left" onclick="change_all_test_trf_button_color()" id="all_test_trf"><span style="font-size: 11px;">All Test</span></button>
				<button class="sub_menu panel text-left" onclick="change_reprocess_trf_button_color()" id="reprocess_trf"><span style="font-size: 11px;">Reprocess TRF</span></button>
			
				<h3 style="font-size: 13px; color:#FFFFFF; background:none;"> Test Result</h3>
				<div style="padding-left:8px;">
					<button class="sub_menu panel text-left" onclick="change_partial_test_result_button_color()"  id="partial_test_result"><span style="font-size: 11px;">Partial Test</span></button>
					<button class="sub_menu panel text-left" onclick="change_all_test_result_button_color()" id="all_test_result"><span style="font-size: 11px;">All Test</span></button>
					<button class="sub_menu panel text-left" onclick="change_reprocess_all_test_button_color()" id="reprocess_all_test"><span style="font-size: 11px;">Reprocess For Test Result</span></button>
				</div>
			
			</div>


			<h3 style="font-size: 13px; color:#FFFFFF; background:none;">Machine Stopage</h3>
			<div style="padding-left:7px;">
				<button class="sub_menu panel text-left" onclick="change_machine_stopage_daily_data_input_color()" id="machine_stopage_daily_data_input"><span style="font-size: 11px;">Daily Data Input</span></button>
			</div>

			
			<h3 style="font-size: 13px; color:#FFFFFF; background:none;">Inspection and Folding</h3>
				<div style="padding-left:7px;">
					<!-- <button class="sub_menu panel text-left" onclick="load_page('inspection_and_folding/inspection_and_folding.php')" id="inspection_and_folding_summary"><span style="font-size: 11px;">Folding & Rework</span></button> -->
					<!-- <button class="sub_menu panel text-left" onclick="load_page('inspection_and_folding/inspection_and_folding_report.php')" id="inspection_and_folding_report"><span style="font-size: 11px;">Folding & Rework Summary</span></button> -->
					<button class="sub_menu panel text-left" onclick="load_page('inspection_and_folding/waiting_for_lab_approval_for_folding.php')" id="waiting_for_lab_approval_for_folding"><span style="font-size: 11px;">Waiting for Lab Approval for Folding</span></button>
					<button class="sub_menu panel text-left" onclick="load_page('inspection_and_folding/waiting_for_inspection_and_folding.php')" id="waiting_for_inspection_and_folding"><span style="font-size: 11px;">Waiting for Folding</span></button>
					<button class="sub_menu panel text-left" onclick="load_page('inspection_and_folding/waiting_for_rework.php')" id="inspection_and_folding_summary"><span style="font-size: 11px;">Waiting for Rework</span></button>


				</div>	

		

			<h3 style="font-size: 13px; color:#FFFFFF; background:none;">Report/Overview</h3>
			<div style="padding-left:7px;">
			<h3 style="font-size: 13px; color:#FFFFFF; background:none;">Test Report</h3>
				<div style="padding-left:7px;">
					<button class="sub_menu panel text-left" onclick="change_partial_test_report_button_color()" id="partial_test_report"><span style="font-size: 11px;">Partial Test Report</span></button>

					<button class="sub_menu panel text-left" onclick="change_all_test_report_button_color()" id="all_test_report"><span style="font-size: 11px;">All Test Report</span></button>
					
					<button class="sub_menu panel text-left" onclick="change_customized_report_button_color()" id="customized_report"><span style="font-size: 11px;">Customized Report</span></button>
					<!-- <button class="sub_menu panel text-left" onClick="load_page('customized_report/customized_report_for_all_test.php')"><span style="font-size: 11px;">Customized Report(All Test)</span></button> -->
				</div>



				<h3 style="font-size: 13px; color:#FFFFFF; background:none;">Production Report</h3>
				<div style="padding-left:7px;">
					<button class="sub_menu panel text-left" onclick="change_pp_progress_report_button_color()" id="pp_progress_report"><span style="font-size: 11px;">PP Progress Report</span></button>
					<button class="sub_menu panel text-left"onclick="change_pp_status_report_button_color()" id="pp_status_report"><span style="font-size: 11px;">PP Status Report</span></button>

				</div>	  

			</div> <!--  End of <div style="padding-left:7px;"> -->

			<h3 style="font-size: 13px; color:#FFFFFF; background:none;">Production Summary</h3>
				<div style="padding-left:7px;">
					
					<button class="sub_menu panel text-left" onclick="load_page('machine_wise_production_summary/machine_wise_production_summary.php')" id="machine_wise_production_details"><span style="font-size: 11px;">Machine Wise Production Summary</span></button>
					<button class="sub_menu panel text-left" onclick="load_page('inspection_and_folding/inspection_and_folding_report_summary.php')" id="folding_and_delivery_summary"><span style="font-size: 11px;">Folding and Delivery Summary</span></button>
					<button class="sub_menu panel text-left" onclick="load_page('machine_wise_production_summary/machine_and_process_wise_production_summary.php')" id="machine_and_process_wise_production_details"><span style="font-size: 11px;">Machine & Process Wise Production Summary</span></button>

				</div>

			<h3 style="font-size: 13px; color:#FFFFFF; background:none;">Visualisation Chart</h3>
				<div style="padding-left:7px;">

					<!-- <button class="sub_menu panel text-left" onclick="load_page('production_summary_chart/machine_wise_production_summary_chart.php')" id="machine_wise_production_summary_chart"><span style="font-size: 11px;">Machine wise Production Summary Chart</span></button> -->
					<button class="sub_menu panel text-left" onclick="load_page('production_summary_chart/date_wise_productivity_productive_time_downtime_chart.php')" id="date_wise_productivity_productive_time_downtime_chart"><span style="font-size: 11px;">Date wise Productivity, Productive time, Downtime Chart</span></button>
					<button class="sub_menu panel text-left" onclick="load_page('production_summary_chart/machine_wise_productive_time_breakdown_time.php')" id="machine_wise_productive_time_breakdown_time_chart"><span style="font-size: 11px;">M/C Wise Productive Time & Breakdown Time Chart</span></button> 
				</div>	

		</div> <!-- End of <div id="accordion"> -->
	</div> <!--End of <div class="col-sm-3 col-md-3 col-lg-3" style="background-color:#add8e6; height:100%;"> -->
<!-- </div>	 -->

