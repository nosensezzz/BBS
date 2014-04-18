<?php

	$category = $this->Session->read( 'category' );
	$poster = $this->Session->read('id');


	$this->extend('/forum/template');
	
	$this->start( 'main' ); 
	
	
?>
<div class="wrapper_2">
<div class="inner_wrapper" >


	<div id='cssmenu' class="adv1">
		<ul>
		<?php foreach( $types as $type ): ?>
		  <li id="game_<?=$type['Game_types']['game']?>" 
		  <?php if($type['Game_types']['id'] == $gid) { echo 'class="active"'; } ?>
		  ><a href="?t=<?=$type['Game_types']['id'] ?>"><span><?= $type['Game_types']['game']?></span></a></li>
		<?php endforeach; ?>
		</ul>
	</div>

	<div>
	<?php
		foreach( $teams as $team ):
	?>
		<div class="inner_post_content" style="cursor:pointer;" id="team_<?=$team['Team']['id']?>">
			<table class="team_view_table">
				<tr>
					<td width=45px ><img src="<?=$team['Team']['team_logo']?>" width=40px height=40px /></td>
					<td style="width:15%;" ><?=$team['Team']['team_name']?></td>
					<td style="width:15%;" ><?=$team['Team']['short']?></td>
					<td style="width:15%;" ><?=$team['Team']['team_description']?></td>
					<td style="width:15%;" >$<?=$team['Team']['team_reward']?></td>
					<td></td>
			
				</tr>
			</table>
			<table class="team_members_table">
			<?php foreach( $team['Team_member'] as $member ){
					//var_dump($member);
					$role = $member['main_role'] . $member['second_role'];
					?>
					<tr>
						<?php if( !empty($member['User']['avatar']) ):?>
						<td width=25px ><img src="/<?=Configure::read('site_name')?>/zzz/picture/user/<?=$member['uid']?>/<?=$member['User']['avatar']?>" width=20px height=20px /></td>
						<?php else:?> 
						<td width=25px ><img src="/<?=Configure::read('site_name')?>/zzz/picture/user/Koala.jpg" width=20px height=20px /></td>
						<?php endif;?>
						
						<td <?php if($team['Team']['leader_uid'] == $member['uid']){ echo "style='font-weight:bold;'"; }?> ><?php if(!empty($role)){ echo $role . '|';}?><?=$member['User']['username']?></td>
						
					</tr>
					<?php
			}
			?>
			</table>
		</div>
		<script>
		$("#team_<?=$team['Team']['id']?>").on('click' , function(e){
			location.href = "/<?=Configure::read('site_name')?>/Team/view_team/<?=$team['Team']['id']?>"; 
		});
		
		</script>
		<?php endforeach; ?>
	</div>






</div>
</div>
<?php 
	$this->end( 'main' );
?>