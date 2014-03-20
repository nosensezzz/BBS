<?php

class User extends AppModel {
	public $useTable = 'User';
     public $name = 'User';
	 
	 /*
	 public $validate = array(
		'username' => array(
				'alphaNumeric' => array(
					'rule'     => 'alphaNumeric',
					'required' => true,
					'message'  => 'Alphabets and numbers only'
				),
				'minlength'  => array(
					'rule'	  => array('minLength', '4'),
					'message'  =>  'At least 4 characters',
				),
			),
		'email' => array(
				'unique'  => array(
					'rule'  =>  'isUnique',
					'required'  =>  true,
					'message'  =>  'Email has been used.',
				),
		),
		
		'password' => array(
				'minlenghth' => array(
					'rule'  => array('minLength' , '6'),
					'message'  => 'At least 6 characters.',
				),
		),
		
	 );
	 */
	 
	 public $hasMany = array(
		'Post' => array(
			'className' => 'Post',
			'foreignKey' => 'poster_id', 
		),
		/*
		'Postcontent' => array(
			'className' => 'Postcontent',
			'foreignKey' => 'by_user',
		),
		*/
	 );
	 
	 
}


?>