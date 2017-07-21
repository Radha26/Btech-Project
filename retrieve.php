<?php
	if( ! class_exists( 'WP_List_Table' ) ) {
		require_once( ABSPATH . 'wp-admin/includes/class-wp-list-table.php' );
	}
	
	
	class My_List_Table extends WP_List_Table {
		
		$myListTable = new My_List_Table();
		$example_data = $myListTable.get_data();
		
		
		function get_data(){
		
			global $wpdb;
			$table=$wpdb->prefix.'department';
			$myrows = $wpdb->get_results( "SELECT * FROM $table" );
			return $myrows;
		
		}
		function get_columns(){
  			$columns = array(
    			'DepartmentAbbreviation' => 'Abbr',
    			'DepartmentName'    => 'Name',
    			'DepartmentCode'      => 'Code'
  			);
  			return $columns;
		}
		
		function prepare_items() {
  			$columns = $this->get_columns();
  			$hidden = array();
  			$sortable = array();
  			$this->_column_headers = array($columns, $hidden, $sortable);
  			$this->items = $this->example_data;;
		}
		
		function column_default( $item, $column_name ) {
			switch( $column_name ) { 
				case 'DepartmentAbbreviation':
		    		case 'DepartmentName':
		    		case 'DepartmentCode':
		     		 	return $item[ $column_name ];
		    		default:
		      			return print_r( $item, true ) ; //Show the whole array for troubleshooting purposes
  		}
  		
		function my_render_list_page(){	
			
			
			
  			echo '<div class="wrap"><h2>My List Table Test</h2>'; 
  			$myListTable->prepare_items(); 
  			$myListTable->display(); 
  			echo '</div>'; 
		}
		
	}

	
	
