<?php


class Add_Dept{
	
	public $DeptAbbrErr = ""; //$DeptAbbrErr = $FaxNoErr = $PhoneNoErr = $EmailErr = "";
	public $Error = false;
	
	
	
    	public function add_dept_plugin_options(){
		//echo "Insideeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeee<br>";
		require_once(get_template_directory().'/inc/dept.php');
	}
    		
    	/*public function abbr_validation_dept($input){
	
		$input = trim($input);
  		$input = stripslashes($input);
  		$input = htmlspecialchars($input);
  		
  		if (!preg_match("/^[a-zA-Z ]*$/",$input)) {
			$this->DeptAbbrErr = "Only letters and white space allowed";
			$Error = true;
		}
		
		return $input;
	}*/
	
    	public function disp_dept_fields(){
    		//echo '<h1>Department Details</h1>';
    	
    	}
    	
    	public function disp_name_field(){
    		$name = esc_attr(get_option('department_name'));
    		echo '<input type="text" name="department_name" value="'.$name.'" placeholder="Name"/>'; //name should be same as the 2nd parameter in register_setting
    	
    	}
    	
    	public function disp_abbr_field(){
    		$abbr = esc_attr(get_option('department_abbr'));
    		echo $this->DeptAbbrErr;
    		echo '<input type="text" name="department_abbr" value="'.$abbr.'" placeholder="Abbr"/><br class="clear" />
    		<span class="error">'. $this->DeptAbbrErr.'</span><br class="clear" />';
    	
    	}
    	
    	public function disp_code_field(){
    		$code = esc_attr(get_option('department_code'));
    		echo '<input type="text" name="department_code" value="'.$code.'" placeholder="Code"/>';
    	
    	}
    	
    	public function disp_est_year_field(){
    		$abbr = esc_attr(get_option('department_est_year'));
    		echo '<input type="text" name="department_est_year" value="'.$abbr.'" placeholder="Est year"/>';
    	
    	}
    	
    	public function disp_faxno_field(){
    		$abbr = esc_attr(get_option('department_faxno'));
    		echo '<input type="text" name="department_faxno" value="'.$abbr.'" placeholder="Fax no."/>';
    	
    	}
    	
    	public function disp_phoneno_field(){
    		$abbr = esc_attr(get_option('department_phoneno'));
    		echo '<input type="text" name="department_phoneno" value="'.$abbr.'" placeholder="Phone no."/>';
    	
    	}
    	
    	public function disp_email_field(){
    		$abbr = esc_attr(get_option('department_email'));
    		echo '<input type="text" name="department_email" value="'.$abbr.'" placeholder="Email"/>';
    	
    	}
    	
	
	
	
	
	
	

	public function dept_add_data() {
		/*if(Error){
			;
		}
		else{*/
			global $wpdb;
			$table=$wpdb->prefix.'department';
			$check = $wpdb->insert($table,array('DepartmentAbbreviation' => $_POST['department_abbr'],  
			'DepartmentName' => $_POST['department_name'],  
			'DepartmentCode' => $_POST['department_code'],
			'EstablishmentYear' => intval($_POST['department_est_year']),  
			'FaxNo' => $_POST['department_faxno'],  
			'PhoneNo' => $_POST['department_phoneno'],  
			'Email' => $_POST['department_email']),array('%s', '%s', '%s', '%d', '%s', '%s', '%s'));
		
			if($check == false){
				echo 'failed<br>';
			}
			else{
				echo 'Success<br>';
			}
			//wp_safe_redirect($_POST['to']);
		//}
		wp_redirect(admin_url('admin.php?page=add_dept_acad_plugin'));
			
	}

	
}
