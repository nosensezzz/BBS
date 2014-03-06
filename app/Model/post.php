<?php

class Post extends AppModel {
     public $name = 'Post';
	 public $useTable = 'post';
	 
	 /*
	 public $belongsTo = array(
		'User' => array(
			'className' => 'User',
			'foreignKey' => 'by_user'
		
		)
	 );
	 
	 public $hasMany = array(
		'Postcontent' => array(
			'className' => 'Postcontent',
			'foreignkey' => 'post_id',
			'dependent' => true,
		)
	 );
	 
	 */
	 
	 
}


?>