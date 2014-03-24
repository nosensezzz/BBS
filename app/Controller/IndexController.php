<?php

class IndexController extends AppController {

	//public $components = array('DebugKit.Toolbar');
	
	public function index(){
		
		// $this->pageTitle = 'Title of your page.'; 
		// $this->set('view', 'none'); 
		//$this->loadModel( 'User' );
			
		$id = $this->Session->read('id');	
		if( $id ){	
			$this->redirect( array( 'controller'=>'forum' , 'action'=>'index' ) );
			}
			
	}
}


?>