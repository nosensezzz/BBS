<?php

class Post_category extends AppModel {
     public $name = 'Post_category';
	 public $useTable = 'post_category';
	 
	 public $hasMany = array(
		'Post' => array(
			'className' => 'Post',
			'foreignKey' => 'category',
			'dependent' => true,
			
		)
	 );
	 
	 public $belongTo = array(
		
		
	 );

	 
	 
}


?>