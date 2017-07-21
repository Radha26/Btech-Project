<?php
/*
Plugin Name: ProjectShort
Plugin URI:
Description: To manage academic institutes
Author: Radha Ravindra Pathak
Version: 1.0
Author URI:
*/
require_once('add_department.php');
require_once('view_department.php');
require_once('name_validator.php');
require_once('add_college.php');


class Base{
	
	public $add_dept; //---------------------->>>>>>>>>>>>> cant declare an object as a property

	public function __construct(){
		//$this->add_dept = $ad;
		register_activation_hook(__FILE__, array(&$this, 'activate'));
		register_deactivation_hook(__FILE__, array(&$this, 'deactivate'));
		
		//echo ("bbbbbbbbbbbbbbbbbbbbbbbaaaaaassssssssssssssssssssssssssseeeeeeeeeeeeeeeeee");
		add_action('admin_menu',array(&$this,'acad_admin_menu'));
		//add_action('admin_init', 'registering');
    		
    		  		
  		add_action('admin_post_dept_add_data',array(new Add_Dept,'dept_add_data'));
  		add_action('admin_post_nopriv_dept_add_data',array(new Add_Dept,'dept_add_data'));
  		
  		add_action('admin_post_add_college',array(new Add_College,'college_add_data'));
  		add_action('admin_post_nopriv_add_college',array(new Add_College,'college_add_data'));
  		//echo ("executed hook");
  		/*add_shortcode('student', function() {
		global $wpdb;
		$students = $wpdb->get_results("SELECT * FROM {$wpdb->prefix}student;");
		echo "<table>";
		foreach($students as $student){
			echo "<tr>";
			echo "<td>".$student->id."</td>";
			echo "<td>".$student->student_name."</td>";
			//echo "<td>".$dept->FirstName."</td>";
			//echo "<td>".$dept->LastName."</td>";
			echo "<td>".$student->student_rollno."</td>";
			echo "<td>".$student->student_programid."</td>";
			echo "<td>
				<form action=? method='post'>
					<input type='hidden' name='id' value='$student->id'>
					<input type='submit' name='enroll' value='Enroll'>
				</form>
			
				</td>";
			echo "</tr>"; }
			echo "</table>";
			
			//isset limitation : even submitted on blank fields
			if(!empty( $_POST["enroll"])){
				$sid = intval($_POST['id']);
				$result = $wpdb->get_results("SELECT student_name FROM {$wpdb->prefix}student WHERE id = ".$sid.";");
				echo $result[0]->student_name;
			}
		} );*/
	}
	//Table creation
	public function activate() {
		global $wpdb;
		$table = $wpdb->prefix . 'department';
  		$charset = $wpdb->get_charset_collate();
  		
  		$wpdb->query("DROP TABLE IF EXISTS $table");
  		
  		$sql = "CREATE TABLE $table (
		DepartmentID INTEGER UNSIGNED NOT NULL AUTO_INCREMENT,
		DepartmentAbbreviation VARCHAR(45) NULL,
		DepartmentName VARCHAR(45) NOT NULL,
		DepartmentCode VARCHAR(20) NULL,
		EstablishmentYear INTEGER NULL,
		FaxNo VARCHAR(20) NULL,
		PhoneNo VARCHAR(20) NULL,
		Email VARCHAR(20) NULL,
		PRIMARY KEY  (DepartmentID)
		) $charset;";
  		require_once(ABSPATH.'wp-admin/includes/upgrade.php');	//required for executing dbDelta()
  		dbDelta($sql);
	}
	
	
	public function acad_admin_menu() {
  		//$add_dept = new Add_Dept;
  		//Generate admin menu page
  		add_menu_page('Acad','College','manage_options','college_acad_plugin',array(&$this,'plugin_options'), '', 110);
		add_menu_page('Dept','Department','manage_options','dept_acad_plugin',array(&$this,'plugin_options2'), '', 112);
		//Generate admin sub pages
		//add_submenu_page('acad_plugin', 'department', 'Department', 'manage_options', 'dept_acad_plugin', array(&$this, 'dept_plugin_options'));
		add_submenu_page('college_acad_plugin', 'college', 'Add', 'manage_options', 'add_college_acad_plugin', array(new Add_College, 'add_college_plugin_options'));
		add_submenu_page('dept_acad_plugin', 'add', 'Add', 'manage_options', 'add_dept_acad_plugin', array(new Add_Dept, 'add_dept_plugin_options'));
		add_submenu_page('dept_acad_plugin', 'view', 'View', 'manage_options', 'view_dept_acad_plugin', array(new View_Dept, 'display_dept'));
		
		//Activate custom settings
		add_action('admin_init', array(&$this, 'registering'));
	}
	
	
	public function plugin_options(){
		echo '<h1>Welcome to Academic Administration!!!</h1>';
	}
	
	public function plugin_options2(){
		echo '<h1>Welcome to Academic Administration!!!</h1>';
	}
	
	public function dept_plugin_options(){
		echo '<h1>Department</h1>';
		echo '<button name="rad" onclick="add_dept_plugin_options()">Add a new Department</button><br>';
		echo '<a href="/wp-content/plugins/Project/view_department.php">View the Departments</a>';
		
	}
	
		
	public function view_dept_plugin_options(){
		my_render_list_page();
	}
	
	public function registering() {
      		
      		register_setting('department-settings-group','department_abbr', array(new Name_Validator('department_abbr'), 'is_valid'));
      		register_setting('department-settings-group','department_name', array(new Name_Validator('department_name'), 'is_valid'));
      		register_setting('department-settings-group','department_code', array(new Name_Validator('department_code'), 'is_valid'));
      		register_setting('department-settings-group','department_est_year', array(new Name_Validator('department_est_year'), 'is_valid'));
      		register_setting('department-settings-group','department_faxno', array(new Name_Validator('department_faxno'), 'is_valid'));
      		register_setting('department-settings-group','department_phoneno', array(new Name_Validator('department_phoneno'), 'is_valid'));
      		register_setting('department-settings-group','department_email', array(new Name_Validator('department_email'), 'is_valid'));
      	
      		
      		add_settings_section('department_details_section', 'Department details', array(&$this, 'disp_dept_fields'), 'add_dept_acad_plugin');//4th par: name of page from add_submenu_page
      		
      		
      		add_settings_field('department-name', 'Name', array(new Add_Dept, 'disp_name_field'), 'add_dept_acad_plugin', 'department_details_section');
      		add_settings_field('department-abbr', 'Abbreviation', array(new Add_Dept, 'disp_abbr_field'), 'add_dept_acad_plugin', 'department_details_section');
      		add_settings_field('department-code', 'Code', array(new Add_Dept, 'disp_code_field'), 'add_dept_acad_plugin', 'department_details_section');
      		add_settings_field('department-est-year', 'Establishment Year', array(new Add_Dept, 'disp_est_year_field'), 'add_dept_acad_plugin', 'department_details_section');
      		add_settings_field('department-faxno', 'Fax No', array(new Add_Dept, 'disp_faxno_field'), 'add_dept_acad_plugin', 'department_details_section');
      		add_settings_field('department-phoneno', 'Phone No', array(new Add_Dept, 'disp_phoneno_field'), 'add_dept_acad_plugin', 'department_details_section');
      		add_settings_field('department-email', 'Email', array(new Add_Dept, 'disp_email_field'), 'add_dept_acad_plugin', 'department_details_section');
      
      
      		register_setting('college-settings-group','college_name');
      		register_setting('college-settings-group','college_code');
      		register_setting('college-settings-group','college_est_year');
      		register_setting('college-settings-group','college_faxno');
      		register_setting('college-settings-group','college_phoneno');
      		register_setting('college-settings-group','college_email');	
      		
      		add_settings_section('college_details_section', 'College details', array(&$this, 'disp_college_fields'), 'add_college_acad_plugin');
      		
      		add_settings_field('college-name', 'Name', array(new Add_College, 'disp_name_field'), 'add_college_acad_plugin', 'college_details_section');
      		add_settings_field('college-code', 'Code', array(new Add_College, 'disp_code_field'), 'add_college_acad_plugin', 'college_details_section');
      		add_settings_field('college-est-year', 'Establishment Year', array(new Add_College, 'disp_est_year_field'), 'add_college_acad_plugin', 'college_details_section');
      		add_settings_field('college-faxno', 'Fax No', array(new Add_College, 'disp_faxno_field'), 'add_college_acad_plugin', 'college_details_section');
      		add_settings_field('college-phoneno', 'Phone No', array(new Add_College, 'disp_phoneno_field'), 'add_college_acad_plugin', 'college_details_section');
      		add_settings_field('college-email', 'Email', array(new Add_College, 'disp_email_field'), 'add_college_acad_plugin', 'college_details_section');
    	
    	}
    	
    	public function disp_dept_fields(){
    		//echo '<h1>Department Details</h1>';
    	
    	}
    	
    	public function disp_college_fields(){
    		//echo '<h1>Department Details</h1>';
    	
    	}
     	
    	
	public function student_plugin_options(){
	
	}
	
	
	/*
		
		if (!preg_match("/^[a-zA-Z ]*$/",$data['DepartmentName'])) {
			$DeptNameErr = "Only letters and white space allowed";
			$Error = true;
		}
		
		if (!preg_match("/^[0-9]*$/",$data['FaxNo'])) {
			$FaxNoErr = "Only nos allowed";
			$Error = true;
		}
		
		if (!preg_match("/^[0-9]*$/",$data['PhoneNo'])) {
			$PhoneNoErr = "Only nos allowed";
			$Error = true;
		}
		
		if (!filter_var($data['Email'], FILTER_VALIDATE_EMAIL)) {
  			$EmailErr = "Invalid email format";
  			$Error = true;
		}
	}*/
	
	public function deactivate(){
		global $wpdb;
		$table = $wpdb->prefix . 'department';
		$wpdb->query("DROP TABLE IF EXISTS $table");
	}
	
}

$a = new Base();
