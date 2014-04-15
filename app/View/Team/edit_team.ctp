<?php


	$this->extend('/forum/template');
	
	$this->start( 'main' ); 
	
	//var_dump($team);
?>

<div class="wrapper_2">
<div class="inner_wrapper" >

<div id='cssmenu' class="adv1">
	<ul>
	  
	   <?php
	   $one = 0;
		foreach($team as $t):
	   ?>
	   <li <?php if($one == 0){ echo 'class="active"'; $one++; } ?> ><a href='#<?=$t['Team']['short']?>'><span><?=$t['Team']['short']?></span></a></li>
	   <?php endforeach; ?>
	   <!--li class='last'><a href='#t3'><span>Last sample</span></a></li-->
	</ul>
	</div>
	<?php 
	//$two = 0;
	foreach($team as $t): ?>
	<div id="<?= $t['Team']['short'] ?>" class="team_view_div">
			<div style="padding-bottom:20px;" ><img src="<?= $t['Team']['team_logo'] ?> " width=400  />
			
			</div>
			<div id="team_detail">
			<p><?= $t['Team']['team_name'] ?></p>
			<p><?= $t['Team']['short'] ?></p>
			<?= $t['Team']['team_description'] ?>
			</div>
			<div id="team_member">
			Team members : 
			<?php foreach( $t['Team_member'] as $member ): ?>
				<?php// var_dump($member); 	?>
				<div>
					<?=$member['main_role']?><?=$member['second_role']?>|<?=$member['User']['User']['username']?>
				</div>
			
			<?php endforeach; ?>
			<br/>
			<p>Rewards : <?= $t['Team']['team_reward'] ?></p>
			</div>
	</div>
		<?php endforeach; ?>
</div> 
</div> 
 
 
 
<script type="text/javascript"> 
  var settings = { start:0, change:false }; 
  $(".adv1 ul").idTabs(settings,false); 
  $(".adv1 a").on('click' , function( e ){
		 e.preventDefault();
		 $(".adv1 li").removeClass('active');
		 $(this).parent().addClass('active');
  });
</script>



<?php 
	$this->end( 'main' );
?>