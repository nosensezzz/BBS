<?php

class IndexController extends AppController {

	public $components = array('DebugKit.Toolbar');
	
	public function index(){
		
		 $this->pageTitle = 'Title of your page.'; 
		 $this->set('view', 'none');
		
	}
}


?>