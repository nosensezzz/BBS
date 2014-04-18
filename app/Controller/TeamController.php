<?php


class TeamController extends AppController {
	public $name = 'Team';

	public $helpers = array ( 'Html' , 'Form');

	public function index($id = null){ 
		//die();
	
	}
	
	public function create_team( ){
	
		$this->loadModel('Game_types');
		$all_games = $this->Game_types->find('all');
		$this->loadModel('User');
		$user = $this->User->findById( $this->Session->read('id') );
		//var_dump($user['Team_member']);
		
		//var_dump($all_games);
		$valid_game = array();
		foreach ($all_games as $game){
			$flag = 0;
			foreach ( $user['Team_member'] as $exist_game ){
				if( $game['Game_types']['id'] == $exist_game['game_type'] ) { $flag = 1; }
			}
			
			if( $flag != 1 ) { array_push ( $valid_game , $game ); }
			
		}
		//var_dump($valid_game);
		$this->set('gameTypes' , $valid_game);
		if ( empty($valid_game) )	{
			$this->redirect( array('controller' => 'Team' , 'action'=> 'edit_team' ,  $this->Session->read('id')) );
		}
			
		/*	
		$this->loadModel('Team');
		if($this->Team->find('first' , array(
			'conditions' =>array(
				'Team.leader_uid' => $this->Session->read('id'),
			),
		))){
			//$this->redirect( array('controller' => 'Team' , 'action'=> 'edit_team' ,  $this->Session->read('id')) );
		}
		*/
	}

	public function create_team_form( $uid=null ){
		$this->request->data['Team']['created_time'] = time();
		$this->request->data['Team']['short'] = trim( $this->request->data['Team']['short'] );
		$this->request->data['Team']['team_name'] = trim( $this->request->data['Team']['team_name'] );
		
		$this->loadModel('Team');
		$new_folder_path = WWW_ROOT . 'zzz\picture\teamlogo' . DS . $this->request->data['Team']['team_name'] . DS;
		$dir = new Folder( $new_folder_path , true , 0755 );
		if(!empty($_FILES)  && $_FILES['logo']['size'] > 0){
		$types = array("jpg","gif","bmp","jpeg","png");
		$function = new zzz_functions;
		$type = $function->file_type($_FILES['logo']['name']);
		// upload logo picture
		if(in_array(strtolower($type) , $types) && $_FILES['logo']['size'] < 2000000){
			
			$filename = explode(".",$_FILES['logo']['name']);
			//var_dump( $filename );
			$extention = array_pop( $filename );
			$name = implode( '.'  , array($this->request->data['Team']['team_name'] , $extention ) );
			$uploadfile = $new_folder_path . $name;
			if(move_uploaded_file($_FILES['logo']['tmp_name'],$uploadfile)){
			//upload success
			$this->request->data['Team']['team_logo'] = '/' . Configure::read('site_name') . '/zzz/picture/teamlogo/' . $this->request->data['Team']['team_name'] . '/' . $name;
			if($this->Team->save($this->request->data)){
				//team_member table actions
				$tid = $this->Team->getLastInsertId();
				$member['Team_member']['tid'] = $tid;
				$member['Team_member']['uid'] = $this->request->data['Team']['leader_uid'];
				$member['Team_member']['role'] = 9;
				$member['Team_member']['game_type'] = $this->request->data['Team']['type'];
				$this->loadModel('Team_member');
				$this->Team_member->save($member);
				$this->Team_member->unbindModel(array(
					'belongsTo' => array('User'),
				));
				$team_info = $this->Team_member->find('all' , array(
				'conditions' => array(
					'Team_member.uid' => $uid,
				)));
				foreach( $team_info as $k=>$t ){
					$team_info[$k] = $t['Team_member'];
				}
				$this->Session->write('team', $team_info );
			}
			$this->redirect( array( 'controller' => 'forum' , 'action' => 'index') );
						
			//die('picture team created');
			}else{
				echo 'move file fail';
				die();
			}
			//echo $name ;
		}else{
			echo 'file type wrong or too large';
			die();
		}
		}else{
			if( $this->request->data['Team']['type'] == 1 ){ $this->request->data['Team']['team_logo'] =  '/' . Configure::read('site_name') . '/zzz/picture/teamlogo/' . 'default_dota2.jpg'; }
			if( $this->request->data['Team']['type'] == 2 ) { $this->request->data['Team']['team_logo'] =  '/' . Configure::read('site_name') . '/zzz/picture/teamlogo/' . 'default_lol.jpg'; }
			if($this->Team->save($this->request->data)){
				//team_member table
				$tid = $this->Team->getLastInsertId();
				$member['Team_member']['tid'] = $tid;
				$member['Team_member']['uid'] = $this->request->data['Team']['leader_uid'];
				$member['Team_member']['role'] = 9;
				$member['Team_member']['game_type'] = $this->request->data['Team']['type'];
				$this->loadModel('Team_member');
				$this->Team_member->save($member);
				$this->Team_member->unbindModel(array(
					'belongsTo' => array('User'),
				));
				$team_info = $this->Team_member->find('all' , array(
				'conditions' => array(
					'Team_member.uid' => $uid,
				)));
				foreach( $team_info as $k=>$t ){
					$team_info[$k] = $t['Team_member'];
				}
				
				//var_dump($team_info);
				//die();
				$this->Session->write('team', $team_info );
			}
			//var_dump($this->request->data);
			$this->redirect( array( 'controller' => 'forum' , 'action' => 'index') );
			//die('no picture team created');
		}
	die();
	
	}
	
	public function edit_team( $uid ){
	
		$teaminfo = $this->Session->read('team'); 
		//die(var_dump($teaminfo));
		$this->loadModel('Team');
		$teams = array();
		foreach ($teaminfo as $k => $t){
			$team = $this->Team->find('first' , array(
			'conditions' =>array(
				'Team.id' => $t['tid'],
				),
			));
			
			//die(var_dump($team));
		
			$this->loadModel('User');

				$count_member = 0;
				$members = array();
				foreach( $team['Team_member'] as $mate ){
				$this->User->unbindModel(
					array(
						'hasMany' => array('Post' , 'Team_member'),
					));
				$user = $this->User->findById( $mate['uid'] );
				$team['Team_member'][$count_member++]['User'] = $user;
				
				}
				array_push( $teams , $team );
			}
		
	
		
		$this->set('team' , $teams);
		$this->set('id' , $uid);
		//var_dump($user);
		// var_dump($teaminfo);
		//die( var_dump($teams) );
	}
	
	public function join_team(){
	
		if(empty($_GET['t'])){
			$gid = 1;
		}else{
			$gid = $_GET['t'];
		}
		$this->loadModel('Team');
		$teams = $this->Team->find('all' , array(
			'conditions' => array(
				'type' => $gid,
			),
			'order' => array( 'team_reward DESC' ),
		));
		
		$this->loadModel('Team_member');
		$this->loadModel('User');
		foreach( $teams as $k => $team  ){
			foreach( $team['Team_member'] as $j => $member ):
			$user = $this->User->find('first'  , array(
				'conditions' => array(
					'id' => $member['uid'],
				),
			));
			$teams[$k]['Team_member'][$j]['User'] = $user['User']; 
			endforeach;
		}
		
		
		$this->loadModel('Game_types');
		$types = $this->Game_types->find('all');
		$this->set('types' , $types );
		$this->set('teams' , $teams );
		$this->set('gid' , $gid );
	//var_dump($types);
	var_dump($teams);
	
	}

	
	
	
	
	
	
	public function ajaxTeamNameCheck(){
		if($this->request->query['fieldId'] == 'teamname'){
			$callback[0] = $this->request->query['fieldId'];
			$this->loadModel('Team');
			$exist = $this->Team->find('first' , array(
				'conditions' => array(
					'team_name' => $this->request->query['fieldValue'],
				),
			));
			if(!$exist){
				$callback[1] = true;
				}else{ $callback[1] = false; }
			echo json_encode($callback);
			die();
		}
		if($this->request->query['fieldId'] == 'teamshort'){
			$callback[0] = $this->request->query['fieldId'];
			$this->loadModel('Team');
			$exist = $this->Team->find('first' , array(
				'conditions' => array(
					'short' => $this->request->query['fieldValue'],
				),
			));
			if(!$exist){
				$callback[1] = true;
				}else{ $callback[1] = false; }
			echo json_encode($callback);
			die();
		}
	}
	
	public function delete_team(){
		//echo $_POST['tid'];
		$this->loadModel('Team');
		$this->Team->delete($_POST['tid']);
		$this->loadModel('Team_member');
				$this->Team_member->unbindModel(array(
					'belongsTo' => array('User'),
				));
				$team_info = $this->Team_member->find('all' , array(
				'conditions' => array(
					'Team_member.uid' => $_POST['uid'],
				)));
				foreach( $team_info as $k=>$t ){
					$team_info[$k] = $t['Team_member'];
				}
				$this->Session->write('team', $team_info );
				echo count($team_info);
		die();
	}
	
	
}