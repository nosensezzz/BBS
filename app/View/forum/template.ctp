<?php
	//var_dump($user);
?>

<!--  用户简要信息 与 用户相关操作 -->
<?php

		if( !$id ){
		?>
			<div class="central_window">
				<?php
				
				echo $this->Html->link('You need to register first. Click here to go back' , '/' );
				?>
				
				<script>
				
				
				</script>
			</div>
			<script>
			
			</script>
		<?php
		} else {
		// ***********************************          User information
		?>
		
		<div class='user_info'>
		
			<image src="zzz/avatar/1.jpg" alt="picture" style="height:20px;width:20px;float:left" /> 
			<span style="float:left;margin-left:6px;"><?= $user['User']['username'] ?></span>
			
			<span style="float:left;margin-left:10%;">Other function in develop</span>
		
		
		
		
		
		
			<div class="user_logout_button">
			<?php
			echo $this->Html->link(
				'Log out',
				'/User/logout',
				array('class' => 'tbd1')
			);
			?>
			</div>
			
			
		</div>	
			
		<?php
		// ***********************************         User information end here
		}
	
?>
	

	
<div class="sidebar">	
	<div style="padding:5px;">
		this is sidebar
	</div>
	
	
	
	
	
	
	
	
</div>
	
	
	
	
	
<?php
	// main is the page content...
	echo $this->fetch('main');
?> 