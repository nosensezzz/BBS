<?php

class AdminController extends AppController {
	
	function beforeFilter(){
		$admin = $this->Session->read('admin_id');
		if( empty($admin) ){
			$this->redirect( array(  'controller'=>'Adminbefore'  , 'action' => 'index'));
		}else{
				$this->loadModel('Admin');
				$find = $this->Admin->find('first' , array(
					'conditions'=> array(
						'Admin.id' => $admin,
					)
				));
				$this->set('admin' , $find);
		}
	}


	
	
	public function index(){
		$this->loadModel('Post_category');
		$this->loadModel('Admin_to_Category');
		
		$options['joins'] = array(
			array(
				'table'=> 'admin_to_category',
				'alias' => 'Admin_to_Category',
				'type' =>'inner',
				'conditions' => array(
					'Post_category.id = Admin_to_Category.category_id',
				),
			),
			array(
				'table' => 'admin',
				'alias' => 'Admin',
				'type' => 'inner',
				'conditions' => array(
					'Admin_to_Category.admin_id = Admin.id',
				),
			),
		);
		
		$options['conditions'] = array(
			'Admin.id' => $this->Session->read('admin_id'),
		);
		
		$categories = $this->Post_category->find('all' , $options);
		$this->set('categories' , $categories);
		//var_dump($categories);
	
		
	}
	
	public function logout(){
		$this->Session->delete('admin_id');
		$this->redirect( array( 'controller'=>'Adminbefore' , 'action' => 'index'));
	}
	
	public function category( $cate_id ){
		$this->loadModel('Admin_to_Category');
		$options['conditions'] = array( 'Admin_to_Category.category_id ' => $cate_id , 'Admin_to_Category.admin_id' => $this->Session->read('admin_id') );
		//$options['limit']= 30 ;
		//$options['page']= $page;
		//$options['order']= array( 'id DESC' );
		if ( $this->Admin_to_Category->find('first' , $options)  ){
				if( empty($_GET['page'])){
					$page=1;
				}else{
					$page=$_GET['page'];
				}
		
				$this->loadModel('Post');
				$this->Post->unbindModel(
					array(
						'hasMany'=>array('Post_reply'),
						'belongsTo'=>array('Post_category','User'),
					)
				);
				$posts = $this->Post->find('all' , array(
					'conditions' => array(
						'Post.category' => $cate_id,
					),
					'limit'=>20,
					'page'=>$page,
					'order' => array('Post.created_time DESC'),
				));
				$this->set('posts' , $posts );
			
				$posts = $this->Post->find('all' , array(
				'conditions' => array(
					'Post.category' => $cate_id,
				)
			));	
			$total_posts = count( $posts );
			$this->set ('total_posts' , $total_posts);
			//die(var_dump($cate));
		}else{
		die();
		}
	}
	
	public function post( $post_id ){
		$this->loadModel('Post');
		$this->Post->id = $post_id;
		$this->Post->save( array('status'=>2) );
		
		$this->loadModel('Admin_to_Category');
		$find = $this->Post->findById($post_id);
		$options['conditions'] = array( 'Admin_to_Category.category_id ' => $find['Post_category']['id'] , 'Admin_to_Category.admin_id' => $this->Session->read('admin_id') );
		
		
		if( $this->Admin_to_Category->find('first' , $options) ){
			$this->set('post' , $find );
		}else{
			die('wrong');
		}
	}
	
	public function ajaxPostStatus2( $post_id ){
		$this->loadModel('Post');
		$this->Post->id = $post_id;
		$this->Post->save( array('status'=>2) );
		//echo '123';
		die();
	}
	public function ajaxPostStatus0( $post_id ){
		$this->loadModel('Post');
		$this->Post->id = $post_id;
		$this->Post->save( array('status'=>0) );
		//echo '123';
		die();
	}
	public function ajaxPostDelete($post_id){
		$this->loadModel('Post');
		$this->Post->id = $post_id;
		
		if($this->Post->delete($post_id)){
			//$this->redirect( array(  'controller'=>'Admin'  , 'action' => 'category' , $_POST['category']));
			echo 'success';
		}else{
			echo 'wrong';
		}
		die();
	}
	public function ajaxReplyDelete($reply_id){
		$this->loadModel('Post_reply');
		//$this->Post->id = $post_id;
		$reply = $this->Post_reply->findById($reply_id);
		if(!empty($reply['Post_reply']['picture'])){
		   unlink($aurls[$i]);
		  }
		
		if($this->Post_reply->delete($reply_id)){
			//$this->redirect( array(  'controller'=>'Admin'  , 'action' => 'category' , $_POST['category']));
			echo 'success';
		}else{
			echo 'wrong';
		}
		die();
	}
	
	public function admin_edit( $id=null ){
		if($this->request->is('post'  && $id != null)){
				$this->Admin->id = $id;
				$this->Admin->save($this->request->data);
			//die(var_dump($this->request->data));
		}
	
	}
	
	
	
	
}


?>