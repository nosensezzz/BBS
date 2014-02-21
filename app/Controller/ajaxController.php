<?php

class ajaxController extends Controller {

	public function ajax(){
		$this->loadModel('User');
		
		if( $this->request->is( 'post' ) ){
		
			if( $_POST['a'] == 'UserNameCheck'){
		
			
				$find = $this->User->find('count' , array(
					'conditions' => array( 'User.username' => $_POST['username'] )
				));
					
				if( $find ){
					$callback['msg'] = 'This username has been used.';
					$json = json_encode ( $callback );
					echo $json;
				} else {
					$callback['msg'] = 'You can use this username.';
					$json = json_encode ( $callback );
					echo $json;
				}
			
					
				
				
			
			} 
	
		}
		die();
	
	}
	
	
	public function test(){
		$this->loadModel('User');
		$find = $this->User->find('count' , array(
					'conditions' => array( 'User.username' => 'jjj' )
				));
				
				if( $find > 0){
					$answer['msg'] = "This name already taken.";
					$callback = json_encode( $answer );
					
					echo $callback;
				}
	
				die();
	}

}




?>