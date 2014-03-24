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
		
		
		<div class="new_reply_div">
			<form action="/bbs_example/games/post_reply" id="replyForm" enctype="multipart/form-data" method="post"  accept-charset="utf-8" class="form_1">
				<table cellspacing=2 cellpadding=0 width=300 border=0>
				<tr>
				<td><font class="en1">Sub-title:</font> </td>
				<td><input size=60 <input name="data[Post_reply][title]" id="subtitle"  class="input1" onblur="this.className='input1'" onfocus="this.className='input1-bor'">
				</td>
				</tr>
				<tr>
				<td><font class="en1">Content: </font> </td>
				<td><textarea name="data[Post_reply][text]" id="text" rows=8 cols=60 class="input1" onblur="this.className='input1 validate[required] minSize[10]'" onfocus="this.className='input1-bor validate[required] minSize[10]'"></textarea>
				</td>
				</tr>
				<tr>
				<td><font class="en1">Pic: </font> </td>
				<td><input name="data[pic]" id="picture" type="file" />
				</td>
				</tr>
			
				<tr>
				<td><font class="en1"></font> </td>
				<td>  <input type="submit" id="reply_cancel_button"  value="Cancel"/>  <input type="submit" value="submit" id="submit">
				</td>
				</tr>
				
				
				
				<input name="data[Post_reply][post_id]" id="" hidden value="<?=  $post['Post']['id'] ?>" />	
				<input name="data[Post_reply][written_by]" id="" hidden value="<?= $poster ?>" />	
				</table>
					
			</form>
		</div>
		
		
		
		<div class="reply_div_footer"></div>
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
	$("#text").focus();
	
}
</script>

<script>
// Call ValidationEngine here
		jQuery(document).ready(function(){
			// binds form submission and fields to the validation engine
			jQuery("#replyForm").validationEngine();
		});
		/**
		*
		* @param {jqObject} the field where the validation applies
		* @param {Array[String]} validation rules for this field
		* @param {int} rule index
		* @param {Map} form options
		* @return an error string if validation failed
		*/
		function checkHELLO(field, rules, i, options){
			if (field.val() != "HELLO") {
				// this allows to use i18 for the error msgs
				return options.allrules.validate2fields.alertText;
			}
		}
	
</script>

<?php
	$this->end( 'main' );
?>