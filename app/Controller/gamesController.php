<?php

define("COC" , 1);


class GamesController extends AppController {

	public $components = array('DebugKit.Toolbar');
	

	public function coc(){
	
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
	
		$this->Session->write('category' , COC);
		
		$this->loadModel( 'Post' );
		
	
	}
	
	public function coc_new_post(){
		$this->loadModel( 'Post' );
	
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
						$this->request->data['Post']['picture'] = $uploadfile;
						$this->request->data['Post']['status'] = 1;
						$this->request->data['Post']['created_time'] = time();
						if($this->Post->save(( $this->request->data))){
							// save in database
							$this->redirect( array( 'controller' => 'games' , 'action' => 'coc'));
						}
					}else{
					
					} 
			}else{
				
				
			}
			
			
			
			//die( var_dump( $this->request->data));
	
		}
		
		die('nothing happened');
	
	}

	
}


?>