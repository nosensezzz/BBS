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
Admin - post
<a href="/<?=Configure::read('site_name')?>/admin/">back</a>
<div class="admin_wrapper">
<?php // var_dump($post); ?>
		

	<div class="inner_post_content">
		<table class="post_header_table">
			<tr>
				<th>Written By :</th>
				<td><?= $post['User']['username'] ?></td>
			</tr>
			<tr>
				<th>Title : </th><td> <?= $post['Post']['title'] ?></td>
			</tr>
			<tr>
				<th>Posted : </th><td><?php echo date('Y-m-d H:i:s', $post['Post']['created_time']);  ?></td>
			</tr>
			
		</table>
		
		<div class="post_text_area">
				<p><?= $post['Post']['text'] ?>	</p>
		
		</div>
		<div class="post_picture_area">
		<?php
			if( $post['Post']['picture']){
			?>
				<img id="post_picture" src="/<?= $post['Post']['picture'] ?>" />
			<?php
			}else{
				echo 'no picture';
			}
		?>
		</div>
		<hr/>
		<div class="admin_action_bar"><button onclick="deletePost(<?=$post['Post']['id']?>)" >Delete</button></div>
	</div>
	<script>
	function deletePost(post_id){
		if( confirm('确定删除？') ){
			$.ajax({
			  type: "POST",
			  data: {category:<?=$post['Post']['category']?>},
			  url: '/<?= Configure::read('site_name')?>/admin/ajaxPostDelete/' + post_id,
			  success: function (data){
				if(data == 'success'){
					window.location.href="/<?=Configure::read('site_name')?>/Admin/category/<?=$post['Post']['category']?>";
				}else{
					alert( data );
					window.location.href="/<?=Configure::read('site_name')?>/Admin/category/<?=$post['Post']['category']?>";
				}
			  },
			});
		}
	}
	</script>
<!--             我是分割线              上面是主贴             下面是回复    -->

<?php
	foreach( $post['Post_reply'] as $reply ){
?>                                        
	<div class="inner_post_content">
		<table class="post_header_table">
			
			<tr>
				<th>Posted : </th><td><?php echo date('Y-m-d H:i:s', $reply['created_time']);  ?></td>
			</tr>
			
		</table>
		
		<div class="post_text_area">
				<?php
					if( !empty ($reply['title']) ){
				?>
				<p class="p-reply_title"><?= $reply['title'] ?>	</p>
				<?php
					}
				?>
				
				<p><?= $reply['text'] ?>	</p>
		
		</div>
		<div class="post_picture_area">
		<?php
			if( $reply['picture']){
			?>
				<img id="post_picture" src="/<?= $reply['picture'] ?>" />
			<?php
			}else{
				echo 'no picture';
			}
		?>
		</div>
		<hr/>
		<div class="admin_action_bar"><button onclick="deleteReply(<?=$reply['id']?>)" >Delete</button></div>
	</div>
	<script>
	function deleteReply(reply_id){
		if( confirm('确定删除？') ){
			$.ajax({
			  type: "POST",
			  data: {category:<?=$post['Post']['category']?>},
			  url: '/<?= Configure::read('site_name')?>/admin/ajaxReplyDelete/' + reply_id,
			  success: function (data){
				//console.log(data);
				if(data == 'success'){
					window.location.href="/<?=Configure::read('site_name')?>/Admin/category/<?=$post['Post']['category']?>";
				}else{
					alert( data );
					window.location.href="/<?=Configure::read('site_name')?>/Admin/category/<?=$post['Post']['category']?>";
				}
			  },
			});
		}
	}
	</script>
<?php  
}  
?>

</div><!-- End of wrapper-->