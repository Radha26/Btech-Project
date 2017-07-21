<?php


class Add_College{
	
	
    	public function add_college_plugin_options(){
		require_once(get_template_directory().'/inc/college.php');
	}
    		
    	
	
    	public function disp_college_fields(){
    		//echo '<h1>college Details</h1>';
    	
    	}
    	
    	public function disp_name_field(){
    		$name = esc_attr(get_option('college_name'));
    		echo '<input type="text" name="college_name" value="'.$name.'" placeholder="Name"/>'; //name should be same as the 2nd parameter in register_setting
    	
    	}
    	
    	
    	
    	public function disp_code_field(){
    		$code = esc_attr(get_option('college_code'));
    		echo '<input type="text" name="college_code" value="'.$code.'" placeholder="Code"/>';
    	
    	}
    	
    	public function disp_est_year_field(){
    		$abbr = esc_attr(get_option('college_est_year'));
    		echo '<input type="text" name="college_est_year" value="'.$abbr.'" placeholder="Est year"/>';
    	
    	}
    	
    	public function disp_faxno_field(){
    		$abbr = esc_attr(get_option('college_faxno'));
    		echo '<input type="text" name="college_faxno" value="'.$abbr.'" placeholder="Fax no."/>';
    	
    	}
    	
    	public function disp_phoneno_field(){
    		$abbr = esc_attr(get_option('college_phoneno'));
    		echo '<input type="text" name="college_phoneno" value="'.$abbr.'" placeholder="Phone no."/>';
    	
    	}
    	
    	public function disp_email_field(){
    		$abbr = esc_attr(get_option('college_email'));
    		echo '<input type="text" name="college_email" value="'.$abbr.'" placeholder="Email"/>';
    	
    	}
    	
	
	
	
	
	
	
	

	public function college_add_data() {
		add_option('college_name', $_POST['college_name']);
		add_option('college_code', $_POST['college_code']);
		add_option('college_est_year', $_POST['college_est_year']);
		add_option('college_faxno', $_POST['college_faxno']);
		add_option('college_phoneno', $_POST['college_phoneno']);
		add_option('college_email', $_POST['college_email']);
		
		
		wp_redirect(admin_url('admin.php?page=add_college_acad_plugin'));
		//echo get_option('college_name');	
	}

	
}
