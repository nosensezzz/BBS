<?php

class Post extends AppModel {
     public $name = 'Post';
	 public $useTable = 'post';
	 
	 
	 public $belongsTo = array(
		'User' => array(
			'className' => 'User',
			'foreignKey' => 'poster_id'
		
		),
		'Post_category' => array(
			'className' => 'Post_category',
			'foreignKey' => 'category'
		)
	 );
	 
	
	public $hasMany = array(
		'Post_reply' => array(
			'className' => 'Post_reply',
			'foreignKey' => 'post_id',
			
			'dependent' => true,
		),
	 );

	 
	 
}


?>