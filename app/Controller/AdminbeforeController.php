<?php

class AdminbeforeController extends AppController {
	
	public function index( $msg = null){
		if($msg){
			echo $msg;
		}
	}
	
	public function loginCheck(){
	
		$this->loadModel('Admin');
	
		$find = $this->Admin->find('first' , array(
			'conditions' => array(
				'admin' => $this->request->data['Admin']['username'],
				'password' => $this->request->data['Admin']['password'],
			),
		));
		if($find){
			$this->Session->write('admin_id' , $find['Admin']['id']);
			
			$this->redirect( array( 'controller'=>'admin' , 'action' => 'index'));
		} else{
			echo 'wrong';
			$this->redirect( array( 'controller'=>'AdminBefore' , 'action' => 'index' , 'wrong'));
		}
	
		die();
	}
	
}
	
?>