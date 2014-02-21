
<!--  用户简要信息 与 用户相关操作 -->
<?php
	//var_dump( $this->Session->read('id') );
		$id = $this->Session->read('id');
		if( !$id ){
		?>
			You need to register.
		<?php
		} else {
		?>
			User information goes here
			<?php
			echo $this->Html->link(
				'Log out',
				'/User/logout',
				array('class' => 'tbd1')
			);
			?>
		<?php
		}
	
?>
	

	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
<?php
	
	echo $this->fetch('main');
?> 