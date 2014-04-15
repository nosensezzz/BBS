<?php

class Team_member extends AppModel {
	public $useTable = 'team_member';
     public $name = 'Team_member';
	 
	 public $belongsTo = array(
		'User' => array(
			'className' => 'User',
			'foreignKey' => 'uid',
		),
	 );

	 
}


?>