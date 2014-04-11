<?php


class TeamController extends AppController {

	public $helpers = array ( 'Html' , 'Form');

	public function index($id = null){ 
		//die();
	
	}
	
	public function create_team( ){
	
	}

	public function create_team_form( $uid=null ){
		//$this->request->data['Team']['leader_uid'] = $this->Session->read('id');
		$this->request->data['Team']['created_time'] = time();
		$this->loadModel('Team');
		//$this->Team->save($this->request->data);
		var_dump($this->request);
		var_dump($_FILES);
		$types = array("jpg","gif","bmp","jpeg","png");
		$function = new zzz_functions;
		$type = $function->file_type($_FILES['logo']['name']);
	
		
		// upload logo picture
		if(in_array(strtolower($type) , $types) && $_FILES['logo']['size'] < 2000000){
			$new_folder_path = WWW_ROOT . 'zzz\picture\logo' . DS . $this->request->data['Team']['team_name'] . DS;
			echo $new_folder_path;
			$dir = new Folder( $new_folder_path , true , 0755 );
			$filename = explode(".",$_FILES['logo']['name']);
			var_dump( $filename );
			$extention = array_pop( $filename );
			$name = implode( $this->request->data['Team'][]  );
			echo $name ;
		}
	die();
	}
	

	
	
	
	
	
	
	public function ajaxTeamNameCheck(){
	if($this->request->query['fieldId'] == 'teamname'){
		$callback[0] = $this->request->query['fieldId'];
		$callback[1] = true;
		echo json_encode($callback);
		die();
	}
	if($this->request->query['fieldId'] == 'teamshort'){
		$callback[0] = $this->request->query['fieldId'];
		$callback[1] = true;
		echo json_encode($callback);
		die();
	}
	
	
	}
	
	
}