<?php

class ForumController extends AppController {

	public $components = array('DebugKit.Toolbar');

	public function index(){
	
		$this->loadModel( 'User' );
			
		$id = $this->Session->read('id');
			
		if( $id ){
			$user = $this->User->find('first' , array(
					'conditions' => array(
						'User.id'  => $id
					)
				));
			
			$this->set('user' , $user);
		
		}else{
			$id = null;
		}
			
		$this->set ('id' , $id);
		
	}
	
	public function template(){
	/********* This is a template 
	/*	1 User informations
	/*	2 Log out button
	/* 
	/**/
	
	
	}


}

?>