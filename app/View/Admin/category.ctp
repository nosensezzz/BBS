<div class='user_info'>
			<ul class="menu">
			<li class="top"><div class="time_panel" style="margin-left:10px;" ><?= $admin['Admin']['admin']?></div></li>
			<li class="top_right"><a href="/<?= Configure::read('site_name')?>/admin/logout" class="top_link"><span>Logout</span></a></li>
			<li class="top_right"><a href="/<?= Configure::read('site_name')?>/admin/admin_edit" class="top_link"><span>Edit</span></a></li>
			<li class="top_right">
						<div class="time_panel">
						<?php echo date('Y-m-d H:i', time());  ?>
						</div>
			</li>
			</ul>	
</div>	
Admin - category
<a href="/<?=Configure::read('site_name')?>/admin/">back</a>
<div class="admin_wrapper">
			<div class="category">
			<div class="category_table_div">
						<table class="cate_table">
							<tr style="text-align:center;"><th>ID</th><th>主题</th><th>内容</th><th>图片</th><th>状态</th></tr>
					
					<?php
						foreach( $posts as $post){
							//  die(var_dump($post)) ;
						?>
							
						
							<tr <?php if($post['Post']['status']==1): echo "style='background:rgb(179, 231, 255);'"; endif; ?> id="">
								<td id="tr_id" style="width:5%;" ><?=$post['Post']['id']?></td>
								<td style="width:10%;padding-left:25px;cursor:pointer;" onclick="admin_select_this_post( <?= $post['Post']['id'] ?> )"><?=$post['Post']['title']?></td>
								<td style="width:25%;cursor:pointer;" onclick="admin_select_this_post( <?= $post['Post']['id'] ?> )">
								<?= $post['Post']['text'] ?>
								</td>

								<td style="width:2%;text-align:center;"><input <?php echo empty($post['picture'])?'':'checked="checked"'; ?> type="radio" disabled /></td>
								<td style="width:2%;text-align:center;"><input id="post_<?=$post['Post']['id']?>" <?php echo $post['Post']['status'] == 0?'':'checked'; ?> type="checkbox" onchange="change_status(<?= $post['Post']['id'] ?>)" /></td>
							</tr>
							
							
							
						<?php
						}
					?>
					</table>
			
			</div>
			<div class="pagination">
		<a href="?page=1"><<</a>
		
			<?php
			//echo $total_posts;
			$page = 1;
			while( $total_posts > 0 ){
				$total_posts -= 20;
				?>
				<a href="?page=<?= $page?>"><?=$page++?></a>
				
				<?php
				
			}
			$page--;
			?>
		<a href="?page=<?=$page?>">>></a>
		</div>
			</div>
			

</div>

<script>
function admin_select_this_post(post_id){
	window.location.href="/<?= Configure::read('site_name')?>/admin/post/" + post_id ;
	
}

function change_status(post_id){
	var sk=$('#post_'+post_id).prop("checked");
	if( sk ){
		$.ajax({
			  type: "POST",
			  url: '/<?= Configure::read('site_name')?>/admin/ajaxPostStatus2/' + post_id,
			  success: function (data){
				//console.log(data);
			  },
			});
	}else{
		$.ajax({
			  type: "POST",
			  url: '/<?= Configure::read('site_name')?>/admin/ajaxPostStatus0/' + post_id,
			  success: function (data){
				//console.log(data);
			  },
			});
	}
}

</script>