<?php

define("COC" , 1);


class GamesController extends AppController {

	public $components = array('DebugKit.Toolbar');
	
	
	

	public function coc(){
	
		if( empty($_GET['category']) ){
			echo 'error';
				
				die();
		}
	
		$this->Session->write('category' ,  $_GET['category'] );
		
		$this->loadModel( 'Post' );
			$posts = $this->Post->find('all' , array(
				'conditions' => array(
					'Post.category' => $this->Session->read('category')
				)
			));	
			//die(var_dump( $posts ));
			$this->set ('posts' , $posts);
		
	
	}
	
	public function coc_new_post(){
		$this->loadModel( 'Post' );
			
			//var_dump( $this->request );
	
		if( $this->request->is('post')){
			$function = new zzz_functions;
			$type = $function->file_type($this->request->data['pic']['name']);
			$types = array("jpg","gif","bmp","jpeg","png");
			$uploaddir = '/' . $function->site_name() . '/zzz/pic/coc/';
			
			$id = $this->Session->read('id');
			
			
			if(in_array(strtolower($type),$types) && $this->request->data['pic']['size'] < 2000000 && $id){
				// allowed type & size
					$new_folder_path = WWW_ROOT . 'zzz' . DS .  'picture' .DS . 'coc' . DS . $id;
					$dir = new Folder( $new_folder_path , true, 0755);
					$filename = explode(".",$this->request->data['pic']['name']);
					$time=date("m-d-H-i-s");
					$filename[0] = $id . '_' . $time;
					$name = implode(".",$filename);
					$uploadfile =  WWW_ROOT . 'zzz' . DS .  'picture' .DS . 'coc' . DS . $id . DS . $name;
					if(move_uploaded_file($this->request->data['pic']['tmp_name'],$uploadfile)){
						//upload success
						//$this->request->data['Post']['picture'] = $uploadfile;
						$this->request->data['Post']['picture'] = $function->site_name() . DS . 'zzz' . DS .  'picture' .DS . 'coc' . DS . $id . DS . $name;
						$this->request->data['Post']['status'] = 1;
						$this->request->data['Post']['created_time'] = time();
						$this->request->data['Post']['ip'] = $function->GetIP();
						//var_dump( $this->request->data['Post']['ip'] );
						//die();
						
						if($this->Post->save(( $this->request->data))){
							// save in database
							$this->redirect( array( 'controller' => 'games' , 'action' => 'coc' , '?' => array('category'=> $this->request->data['Post']['category'] )) );
						}
					}else{
					
					} 
			}else if( $this->request->data['pic']['size'] == 0 ){
					$this->request->data['Post']['created_time'] = time();
					$this->request->data['Post']['status'] = 0;
					$this->request->data['Post']['ip'] = $function->GetIP();
					if($this->Post->save(( $this->request->data))){
							// save in database
							$this->redirect( array( 'controller' => 'games' , 'action' => 'coc', '?'=>array('category'=> $this->request->data['Post']['category'] )));
						}else{
					
					} 
				
				
			}else if( $this->request->data['pic']['size'] > 2000000  ){
				die(  'picture too large' );
			}
			
			
			
			//die( var_dump( $this->request->data));
	
		}
		
		die('nothing happened');
	
	}
	
	public function post(){
		if( !empty($_GET['id'])){
		$post_id = $_GET['id'];
		} else {
			$this->Session->setFlash('Wrong');
			$this->redirect( array( 'controller' => 'forum' , 'action' => 'index'));
		}
		
		$this->loadModel( 'Post' );
		$this->loadModel( 'User' );
			
			if( $post_id ){
				$post = $this->Post->find('first' , array(
						'conditions' => array(
							'Post.id'  => $post_id
						)
					));

					
				// 给post-reply找到发布者的username
				$step = 0;
				foreach( $post['Post_reply'] as $reply ){
					$user = $this->User->find('first' , array(
						'conditions' => array(
							'User.id' => $reply['written_by'],
						)
					));
					$post['Post_reply'][$step]['username'] = $user['User']['username'];
					$step++;
				}
				
				$this->set('post' , $post);
				
				//die( var_dump( $post ) );
				
				$this->Post->id = $post_id;
				$this->Post->saveField( 'count' , ++$post['Post']['count'] );
				
				
				
			}else{}
			

	
	}
	
	public function post_reply(){
		$this->loadModel( 'Post_reply' );
		$function = new zzz_functions;
	
		$this->request->data['Post_reply']['created_time'] = time();
		$this->request->data['Post_reply']['ip'] = $function->GetIP();
		
		$id = $this->Session->read('id');
		$type = $function->file_type($this->request->data['pic']['name']);
		$types = array("jpg","gif","bmp","jpeg","png");
		$uploaddir = '/' . $function->site_name() . '/zzz/pic/coc/';
		
		
		if(in_array(strtolower($type),$types) && $this->request->data['pic']['size'] < 2000000 && $id){
				// allowed type & size
					$new_folder_path = WWW_ROOT . 'zzz' . DS .  'picture' .DS . 'coc' . DS . $id;
					$dir = new Folder( $new_folder_path , true, 0755);
					$filename = explode(".",$this->request->data['pic']['name']);
					$time=date("m-d-H-i-s");
					$filename[0] = $id . '_' . $time;
					$name = implode(".",$filename);
					$uploadfile =  WWW_ROOT . 'zzz' . DS .  'picture' .DS . 'coc' . DS . $id . DS . $name;
					if(move_uploaded_file($this->request->data['pic']['tmp_name'],$uploadfile)){
						//upload success
						$this->request->data['Post_reply']['picture'] = $function->site_name() . DS . 'zzz' . DS .  'picture' .DS . 'coc' . DS . $id . DS . $name;
						$this->request->data['Post_reply']['status'] = 1;
						
						if($this->Post_reply->save(( $this->request->data))){
							// save in database
							$this->redirect( array( 'controller' => 'games' , 'action' => 'post' , '?' => array('id'=> $this->request->data['Post_reply']['post_id'] )) );
						}
					}else{
					
					} 
			}else if( $this->request->data['pic']['size'] == 0 ){
					$this->request->data['Post_reply']['status'] = 0;
					if($this->Post_reply->save(( $this->request->data))){
							// save in database
							$this->redirect( array( 'controller' => 'games' , 'action' => 'post' , '?' => array('id'=> $this->request->data['Post_reply']['post_id'] )) );
						}else{
					
					} 
				
				
			}else if( $this->request->data['pic']['size'] > 2000000  ){
				die(  'picture too large' );
			}
		
		
	}

	
}


?>