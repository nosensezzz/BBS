<?php

	$category = $this->Session->read( 'category' );
	$poster = $this->Session->read('id');


	$this->extend('/forum/template');
	
	$this->start( 'main' );
?>
<div class="wrapper_2">
<div class="inner_wrapper" >
		
		<div class="table_header">
				Clash of Clans -- need a banner picture here
		</div>
		
		<table class="post_table">
			
		
			<tr id="th">
				<th id="th_id">Post ID</th> <th>Status</th> <th>Author</th>  <th>Title</th> <th>Time</th> <th>View/Reply</th>
			<tr>
		
		<?php
			foreach( $list_posts as $post){
				//die ( var_dump($post) );
			?>
				<!--div class="coc_post_style">
					<div class="post_picture"><img src="/<?= $post['Post']['picture'] ?>" width="100%" /></div>
					<div class="post_content">
						<span id="title">Title:<?= $post['Post']['title'] ?> </span><br/><br/>
						<span>Comment:<?= $post['Post']['text'] ?></span><br/>
					</div>	
					<div class="post_footer"><span>Post by:<?= $post['Post']['poster_id'] ?>      <?php echo date('Y-m-d H:i:s', $post['Post']['created_time']);  ?></span></div>
				</div-->
				
				<tr onclick="select_this_post( <?= $post['Post']['id'] ?> )" id="post">
					<td id="tr_id"><?= $post['Post']['category'] ?>-<?= $post['Post']['id'] ?></td>
					<td>TBD</td>
					<td><?= $post['Post']['poster_id'] ?></td>
					<td><?= $post['Post']['title'] ?></td>
					<td> <?php echo date('Y-m-d H:i:s', $post['Post']['created_time']);  ?></td>
					<td><?= $post['Post']['count'] ?> / <?php echo count( $post['Post_reply'] ); ?></td>
				</tr>
				
				
				
			<?php
			}
		?>
		</table>
		
		<!--  pagination  -->
	<div class="pagination_newpost">
		<div class="pagination">
		<a href="?category=<?=$category?>&page=1"><<</a>
		
			<?php
			//echo $total_posts;
			$page = 1;
			while( $total_posts > 0 ){
				$total_posts -= 20;
				?>
				<a href="?category=<?=$category?>&page=<?= $page?>"><?=$page++?></a>
				
				<?php
				
			}
			$page--;
			?>
		<a href="?category=<?=$category?>&page=<?=$page?>">>></a>
		</div>
		<div class="newpost" >
		<button onclick="newpostshow()" class="cakeButton">New Post</button>
		</div>
	</div>
		
		<!-- new form div -->
		
		<div class="new_post_div" hidden>
			<form action="/<?=Configure::read('site_name')?>/games/coc_new_post" id="postForm" enctype="multipart/form-data" method="post"  accept-charset="utf-8" class="form_1">
				<table cellspacing=2 cellpadding=0 width=300 border=0>
				<tr>
				<td><font class="en1">Subject:</font> </td>
				<td><input size=100 id="post_subject" name="data[Post][title]"  class="input1" onblur="this.className='input1 validate[required] minSize[5]'" onfocus="this.className='input1-bor validate[required] minSize[5]'">
		
				
				</td>
				</tr>
				<tr>
				<td><font class="en1">Content: </font> </td>
				<td><textarea name="data[Post][text]" id="text" rows=10 cols=120 class="input1" onblur="this.className='input1 validate[required] minSize[10]'" onfocus="this.className='input1-bor validate[required] minSize[10]'"></textarea>
				</td>
				</tr>
				<tr>
				<td><font class="en1">Pic: </font> </td>
				<td><input name="data[pic]" id="picture" type="file" />
				</td>
				</tr>
			
				<tr>
				<td><font class="en1"></font> </td>
				<td><a class="cakeButton" onclick="javascript:cancelReply()">Cancel</a>  <input type="submit" value="submit" id="submit" class="cakeButton">
				</td>
				</tr>
				
				
				<input name="data[Post][category]" id="" hidden value="<?= $category ?>" />	
				<input name="data[Post][poster_id]" id="" hidden value="<?= $poster ?>" />	
				</table>
					
			</form>
			
		</div>

</div>
</div>

<script>
function select_this_post( id ){

	window.location.href="post?id=" + id;
}

function newpostshow(){
	$(".new_post_div").show();
	$("#post_subject").focus();
}

function cancelReply(){
	$(".new_post_div").hide();
}
</script>
<script>
// Call ValidationEngine here
		jQuery(document).ready(function(){
			// binds form submission and fields to the validation engine
			jQuery("#postForm").validationEngine();
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
