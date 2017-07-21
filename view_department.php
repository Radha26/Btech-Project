<?php 

class View_Dept{

	public function display_dept(){
		global $wpdb;
		$table=$wpdb->prefix.'department';
		$myrows = $wpdb->get_results( "SELECT * FROM $table" );
		?>
		<div class="wrap">
		<table border="2", width="100%">
  		<thead>
    		<tr>
      		<th>Name</th>
      		<th>Abbreviation</th>
      		<th>Code</th>
      		<th>Establishment Year</th>
      		<th>Fax No</th>
      		<th>Phone No</th>
      		<th>Email</th>
      		
    		</tr>
  		</thead>
  		<tbody>
    		<?php
      			foreach($myrows as $row){
          		echo "<tr ><td>".$row->DepartmentName."</td><td>".$row->DepartmentAbbreviation."</td><td> ".$row->DepartmentCode."</td><td>".$row->EstablishmentYear."</td><td> ".$row->FaxNo."</td><td>".$row->PhoneNo."</td><td>".$row->Email."</td></tr>\n";
	     	}
	 
	    	?>
 		 </tbody>
		</table>
		</div>
		<?php
	}

}
