<?php


	$this->extend('/forum/template');
	
	$this->start( 'main' ); 
	
//	var_dump($team);
	
?>

<div class="wrapper_2">
<div class="inner_wrapper" >

<div id='cssmenu' class="adv1">
	<ul>
	  
	   <?php
	   $one = 0;
		foreach($team as $t):
	   ?>
	   <li 
	   <?php if($one == 0){ echo 'class="active"'; $one++; } ?> 
	   ><a href='#<?=$t['Team']['short']?>' value="<?=$t['Team']['short']?>" ><span><?=$t['Team']['short']?></span></a></li>
	   <?php endforeach; ?>
	   <!--li class='last'><a href='#t3'><span>Last sample</span></a></li-->
	</ul>
	</div>
	<?php 
	$two = 0;
	foreach($team as $t): ?>
	<div id="<?= $t['Team']['short'] ?>" class="team_view_div"
	<?php if($two == 0 ){ echo "display='block';"; $two++; }else{ echo 'display="none"'; } ?>
	>
			<div style="padding-bottom:20px;" >
			<?php
				if($t['Team']['leader_uid'] == $this->Session->read('id') ){
				?>
				<div style="clear:both; margin:20px;"><button id="<?=$t['Team']['id']?>_dismiss_team_btn" value="<?=$t['Team']['id']?>">Dismiss Team</button></div>
				<button style="display:none;" value="<?= $id ?>" id="uid_value_div"></button>
				<?php
				}
			?>
			<img src="<?= $t['Team']['team_logo'] ?> " width=400  />
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
	<script>
  $('#<?=$t['Team']['id']?>_dismiss_team_btn').on('click' , function(e){
	if( confirm() ){
		tid = $(this).val();
		uid = $("#uid_value_div").val();
		//alert(uid);
		
		var ajax = $.ajax({
			type: "POST",
			url: "/<?=Configure::read('site_name')?>/team/delete_team",
			data: { tid: tid , uid: uid}
		});
		ajax.done(function(data){
			if(data > 0){ location.reload(); }else{ 
					 location.href = "/<?=Configure::read('site_name')?>/team/create_team";
			}
		});
		ajax.fail(function( jqXHR, textStatus ) {
		  alert( "Request failed: " + textStatus );
		});
		
		
	}
  });
</script>
		<?php endforeach; ?>
</div> 
</div> 
 
<script type="text/javascript"> 
  var settings = { start:0, change:false }; 
  $(".adv1 ul").idTabs(settings,true); 
  $(".adv1 a").on('click' , function( e ){
		 e.preventDefault();
		 $(".adv1 li").removeClass('active');
		 $(this).parent().addClass('active');
		// var id = $(this).children().html();
		 //alert(id);
		 //$("#"+id).siblings().attr('display' , 'none');
		// $("#"+id).attr('display' , 'block');
		 
  });
  </script>
  



<?php 
	$this->end( 'main' );
?>