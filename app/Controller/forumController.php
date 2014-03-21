<?php

class ForumController extends AppController {

	public $components = array('DebugKit.Toolbar');

	public function index(){
		$this->loadModel( 'Post' );
		
		$recent_posts = $this->Post->find('all' , array(
				'conditions' => array(
					
				),
				'limit' => 10,
				'order' => array( 'Post.created_time DESC' ),
		));
		$this->set( 'recent_posts' , $recent_posts );
		$this->set( 'root' , $this->Session->read('root') );
	
		//die( var_dump( $recent_posts ) );
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