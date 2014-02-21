<?php


//AJAX CALL File  
	$data = mysql_query ( 'select * from user ' );
	var_dump( $data );
	
	echo mysql_error($data);


if( $_POST['a'] == 'UserNameCheck' ){

	$data = mysql_query ( 'select * from user ' );
	
	

	echo "a receiverd";
	echo $_POST['username'];
} 







else {

	echo "no request code.";
}



?>