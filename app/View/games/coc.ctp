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
		<div>
		<a href="?category=<?=$category?>&page=1"><<</a>
		
			<?php
			//echo $total_posts;
			$page = 1;
			while( $total_posts > 0 ){
				$total_posts -= 10;
				?>
				<a href="?category=<?=$category?>&page=<?= $page?>"><?=$page++?></a>
				
				<?php
				
			}
			$page--;
			?>
		<a href="?category=<?=$category?>&page=<?=$page?>">>></a>
		</div>
		
		
		<div class='new_post' id="coc_new_post">
		<form action="/bbs_example/games/coc_new_post" id="postCocForm" enctype="multipart/form-data" method="post"  accept-charset="utf-8">
			<label for="title">title</label><input name="data[Post][title]" id="title" maxlength="100" type="text">	
			<label for="text">text</label><textarea name="data[Post][text]" id="text" cols="30" rows="6"></textarea>
			<input name="data[pic]" id="picture" type="file" />
			
			
			<input name="data[Post][category]" id="" hidden value="<?= $category ?>" />	
			<input name="data[Post][poster_id]" id="" hidden value="<?= $poster ?>" />	
			<input type="submit" value="submit" id="submit">

		</form>
		</div>

</div>
</div>

<script>
function select_this_post( id ){
	//alert( id );
	<?php
		//$function = new zzz_function;
	?>
	window.location.href="post?id=" + id;
}
</script>


<?php
	$this->end( 'main' );
?>
