<?php

class UserController extends AppController {

	//public $name = 'User' ;
	public $helpers = array ( 'Html' , 'Form');
	//public $components = array('DebugKit.Toolbar' => array('panels' => array()));
	
	
	
	public function register(){
	
		if( $this->Session->read('id')){
			$this->redirect( array( 'controller' => 'forum' , 'action' => ''));
		}
	
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
							
							$this->request->data['User']['password'] = OnlyHash::hash(
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
			
			//Session variables
				$this->Session->write('id', $find['User']['id'] );
				$this->Session->write('user', $find['User'] );
				$this->loadModel('Post_category');
				$category = $this->Post_category->find('all');
				$count = 0;
				foreach( $category as $cate ){
					$cate_info[$count]['cate'] = $cate['Post_category'];
					$count++;
				}
				$this->Session->write('cate' , $cate_info);
				//var_dump($category[0]);
				//die();
				
		
				//$this->Session->setFlash('Welcome back ' . $find['User']['username'] . '!' );
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
		$this->redirect( "/" );
	
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
	
	public function user_edit( $id ){
	
		if($id == 1){
			die('wrong');
		}
		
		$this->loadModel('User');
		$user = $this->User->find('first' , array(
			'conditions' => array(
				'id' => $id ,
			)
		));
		$this->set('user', $user['User']);
		
		
		if( $this->request->is('post')){
			//die(var_dump($this->request->data));
			if( empty($this->request->data['pwd']) ):
			$this->User->id = $id;
			$this->User->save($this->request->data);
			else: if( $this->request->data['pwd'] == '1')
			$this->User->id = $id;
			$this->request->data['User']['password'] = OnlyHash::hash($this->request->data['User']['password']);
			$this->User->save($this->request->data);
			endif;
			
			$this->redirect( array( 'controller' => 'user' , 'action' => 'user_edit' , $id));
		}
		
	}
	
	public function editCheck(){
	//die(var_dump($this->request));
	$original = $this->Session->read('user');
		$checkValue = $_GET['fieldValue'];
		$checkId = $_GET['fieldId'];
		$callback[0] = $_GET['fieldId'];
		$this->loadModel( 'User' );
		if($checkId  == 'email'){
			$user = $this->User->find('first' , array(
				'conditions' => array(
					'Email' => $checkValue,
				)
			));
				if( count($user) > 0 ){
					if( $user['User']['Email'] == $original['Email'] ){
						$callback[1] = true;
						echo json_encode( $callback );
					}else{
						$callback[1] = false;
						echo json_encode( $callback );
						}
				} else {
					$callback[1] = true;
					echo json_encode( $callback );
				}
		} else if($checkId  == 'username'){
			$user = $this->User->find('first' , array(
				'conditions' => array(
					'username' => $checkValue,
				)
			));
				if( count($user) > 0 ){
					if( $user['User']['username'] == $original['username'] ){
						$callback[1] = true;
						echo json_encode( $callback );
					}else{
						$callback[1] = false;
						echo json_encode( $callback );
						}
				} else {
					$callback[1] = true;
					echo json_encode( $callback );
				}
		}
	
	
		die();
	}
	
	public function avatarCheck(){
		//var_dump($_POST);
		//$targetFolder = '/uploads'; // Relative to the root
		$verifyToken = md5('unique_salt' . $_POST['timestamp']);
		$user = $this->Session->read('user');
		$id = $user['id'];
		if (!empty($_FILES) && $_POST['token'] == $verifyToken) {
				$new_folder_path = WWW_ROOT . 'zzz' . DS . 'picture' . DS .  'user' .DS . $this->Session->read('id');
				$dir = new Folder( $new_folder_path , true, 0755);
				$tempFile = $_FILES['Filedata']['tmp_name'];
				$filename = explode(".",$_FILES['Filedata']['name']);
				$count = count( $filename );
				$count--;
				
				//echo $filename[$count];
			// Validate the file type
				$fileTypes = array('jpg','jpeg','gif','png'); // File extensions
			
			if (in_array($filename[$count],$fileTypes)) {
				
				$filename[0] = $id . '_avatar';
				$name = implode(".",$filename);
				$path = $new_folder_path . DS . $name;
				move_uploaded_file($tempFile,$path);
				// save path to DB
				$user = array('id' => $id, 'avatar' => $name);
				$this->loadModel('User');
				$this->User->save($user);
				
				$callback = '/' . $path;
				echo $callback;
			} else {
				echo '2';
				
			}
		}
		
		die();
	}
	public function anonymity(){
		$this->loadModel('User');
		$this->loadModel('Post_category');
		$find = $this->User->findById(1);
		$this->Session->write('id', $find['User']['id'] );
		$category = $this->Post_category->find('all');
				$count = 0;
				foreach( $category as $cate ){
					$cate_info[$count]['cate'] = $cate['Post_category'];
					$count++;
				}
				$this->Session->write('cate' , $cate_info);
				//var_dump($category[0]);
				//die();
				
		
				//$this->Session->setFlash('Welcome back ' . $find['User']['username'] . '!' );
				$this->redirect( array( 'controller' => 'forum' , 'action' => 'index'));
		
	}
	
	
	
	

}




?>