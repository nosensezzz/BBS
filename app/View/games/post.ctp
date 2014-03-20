<?php

	$category = $this->Session->read( 'category' );
	$poster = $this->Session->read('id');


	$this->extend('/forum/template');
	
	$this->start( 'main' );
 //  var_dump( $post );
	
	
	$floor = 1;
	
?>

<div class="wrapper_2">
<div class="inner_wrapper" >
	<div class="table_header">
				Clash of Clans -- need a banner picture here
	</div>
	<div class="inner_post_category"><?= $post['Post_category']['category'] ?></div>
	<hr style="margin:10px;"/>
	<div class="post_control_panel">
	
	<button class='control_panel_button'>reply</button>
	<button class='control_panel_button'>reply</button>
	<button class='control_panel_button'>reply</button>
	</div>
	
	
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
				<th>Time : </th><td><?php echo date('Y-m-d H:i:s', $post['Post']['created_time']);  ?></td>
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
		<div class="post_footer_div">
			
			<div class="post_footer_div_userinfo">
			<?php
				echo '#' . $floor++ . ' - ';
				if($post['Post']['ip']){
					echo "[From :" . $post['Post']['ip'] . "]";
				}else{
					echo "[From :" . " ip hidden " . "]";
				}
			?>
			</div>
			
			<div><button class='post_footer_div_buttons' id="reply_button" onclick="reply( '<?=$post['Post']['text']?>' ,  <?=$floor?> )">reply</button></div>
		</div>
	</div>
<!--             我是分割线              上面是主贴             下面是回复    -->

<?php
	foreach( $post['Post_reply'] as $reply ){
?>                                        
	<div class="inner_post_content">
		<table class="post_header_table">
			<tr>
				<th>Written By :</th>
				<td><?= $reply['username'] ?></td>
			</tr>
			<tr>
				<th>Time : </th><td><?php echo date('Y-m-d H:i:s', $reply['created_time']);  ?></td>
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
		<div class="post_footer_div">
			<div class="post_footer_div_userinfo">
			<?php
				echo '#' . $floor++ . ' - ';
				
				if($reply['ip']){
					echo "[From :" . $reply['ip'] . "]";
				}else{
					echo "[From :" . " ip hidden " . "]";
				}
			?>
			</div>
			<div><button class='post_footer_div_buttons' onclick="reply( this.value ,  <?=$floor?> )"  value="<?= $reply['text'] ?>" >reply</button></div>
			
		</div>
	</div>
	
<?php  
}  
?>




	<div id="reply_div" hidden>
		
		<div class="reply_div_form">
				<form action="/bbs_example/games/post_reply" id="" enctype="multipart/form-data" method="post"  accept-charset="utf-8">
				<label for="subtitle">Sub-title</label><input name="data[Post_reply][title]" id="subtitle" maxlength="50"></input>
				<label for="text">text</label><textarea name="data[Post_reply][text]" id="text" cols="30" rows="6"></textarea>
				<input name="data[pic]" id="picture" type="file" />
				
				<input name="data[Post_reply][written_by]" id="" hidden value="<?= $poster ?>" />	
				<input name="data[Post_reply][post_id]" id="" hidden value="<?=  $post['Post']['id'] ?>" />	
				<input type="submit" value="submit" id="submit" />
				<input type="submit" id="reply_cancel_button"  value="Cancel"/>
					</form>
				
		</div>
		
		<div class="reply_div_footer">

				
		</div>
		
	</div>
</div>

</div>
<script>
  
  $("#reply_cancel_button").click(function(){
	event.preventDefault();
	$("#reply_div").hide();
  });
  
</script>
<script>
function reply( text, floor){
	str = text.substring(0, 20);
	floor = floor - 1;
	$("#reply_div").show();
	$("#subtitle").val( '@ #'+ floor + '     ' + str + '...');
	$("#text").val();
}
</script>

<?php
	$this->end( 'main' );
?>