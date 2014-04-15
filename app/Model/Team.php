<?php

class Team extends AppModel {
	public $useTable = 'team';
     public $name = 'Team';

	 
	 public $hasMany = array(
		'Team_member' => array(
			'className' => 'Team_member',
			'foreignKey' => 'tid',
			'dependent' => true,
		),
	 );
	 
}


?>