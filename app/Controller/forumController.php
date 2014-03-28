<?php

class ForumController extends AppController {

	//public $components = array('DebugKit.Toolbar');

	public function index(){
		$this->loadModel( 'Post' );
		$recent_posts = $this->Post->find('all' , array(
				'conditions' => array(
					'Post.category !=' => 0,
				),
				'limit' => 10,
				'order' => array( 'Post.created_time DESC' ),
		));
		//die( var_dump( $recent_posts ) );
		$time = time();
		
		$this->loadModel( 'Post_category' );
		$category = $this->Post_category->find('all' , array(
				'conditions' => array(
				),
		));
		
		$this->set( 'recent_posts' , $recent_posts );
		$this->set( 'category' , $category );
	//	$this->set( 'root' , $this->Session->read('root') );
	
	//	die( var_dump( $category ) );
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