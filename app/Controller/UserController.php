<?php

class UserController extends AppController {

	//public $name = 'User' ;
	public $helpers = array ( 'Html' , 'Form');
	//public $components = array('DebugKit.Toolbar' => array('panels' => array()));
	
	
	
	public function register(){
	
		$this->loadModel( 'User' );
	
		if( $this->request->is('post')){
		
		
			if($_POST['info'] == '9'){
		
				$checkUser = $this->User->find('first' , array(
					'conditions' => array(
						'User.Email'  => $this->request->data['User']['Email']
					)
				));
				
				
				
					//die( var_dump( $checkUser ) );
					if( empty( $checkUser) ){
							//var_dump( $this->request->data );
							//date_default_timezone_set('Asia/Beijing');
							$this->request->data['User']['created_time'] = time();
							$this->request->data['User']['status'] = 0 ;
							
							$this->request->data['User']['password'] = Security::hash(
							$this->request->data['User']['password']
							);
							
							
							
							if($this->User->save(( $this->request->data))){
								$this->Session->setFlash('You have registered!');
								$this->redirect( array( 'controller' => 'forum' , 'action' => 'index'));
							}
					} else {
							$this->Session->setFlash('Error, This Email has been Used!');
					
					}
			
			}  else if( $_POST['info'] == '1' ){
				$this->Session->setFlash('Error in password.');
				$this->redirect( array( 'action' => 'register'));
			} else if( $_POST['info'] == '2' ){
				$this->Session->setFlash('Error in username.');
				$this->redirect( array( 'action' => 'register'));
			} 
			
			
		
		
		}
	
		
	}

	public function anonymity(){

		
	}
	
	public function login(){
		//var_dump( $_POST );
		
		
		$password = OnlyHash::hash( $_POST['password'] );
		$find = $this->User->find( 'first' , array(
				'conditions' => array(
					'username' => $_POST['username'],
					'password' => $password
				)
			));
		
		if( $find ){
				$callback['action'] = '1';
				$callback['data'] = $find;
				echo json_encode( $callback );
		/*
				$this->Session->write('id',$find['User']['id']);
				$this->Session->setFlash('Welcome back ' . $find['User']['username'] . '!' );
				$this->redirect( array( 'controller' => 'forum' , 'action' => 'index'));
				
				*/
			} else {
				$callback['action'] = '0';
				echo json_encode( $callback );
			/*
				$this->Session->setFlash( 'No such user.' );
				$this->redirect( array( 'controller' => 'index' , 'action' => 'index'));
				*/
			}
		
		die();
	}
	
	public function after_login(){
		//echo $_GET['id'];
			
			$id = $_GET['id'];
			
			
			
			$find = $this->User->find( 'first' , array(
				'conditions' => array(
					'id' => $id,
					'password' => $_GET['pw']
				)
			));
			
			//var_dump( $find );
			//die();
			if ( $find ){
				$this->Session->write('id', $find['User']['id'] );
				$this->Session->setFlash('Welcome back ' . $find['User']['username'] . '!' );
				$this->redirect( array( 'controller' => 'forum' , 'action' => 'index'));
			} else{
				echo 'error';
				//$this->Session->setFlash('error');
				//die();
			}
		
		die();
		
	}
	
	public function logout(){
		$this->Session->destroy();
		$this->redirect( array( 'controller' => 'index' , 'action' => 'index'));
	
	}
	
	public function test(){
	

	
	}
	
	public function usernameCheck(){
		//var_dump ($_GET);
		$checkValue = $_GET['fieldValue'];
		$callback[0] = $_GET['fieldId'];
		$this->loadModel( 'User' );
		$user = $this->User->find('first' , array(
			'conditions' => array(
				'username' => $checkValue,
			)
		));
		if( count($user) > 0 ){
			$callback[1] = false;
			echo json_encode( $callback );
		} else {
			$callback[1] = true;
			echo json_encode( $callback );
		}
		die();
	}
	
	public function emailCheck(){
		$checkValue = $_GET['fieldValue'];
		$callback[0] = $_GET['fieldId'];
		$this->loadModel( 'User' );
		$user = $this->User->find('first' , array(
			'conditions' => array(
				'Email' => $checkValue,
			)
		));
		if( count($user) > 0 ){
			$callback[1] = false;
			echo json_encode( $callback );
		} else {
			$callback[1] = true;
			echo json_encode( $callback );
		}
	
	
	die();
	}
	
	

}




?>