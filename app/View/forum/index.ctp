
<?php
	$this->extend('/forum/template');
	
	$this->start( 'main' );
?>
<div class="wrapper_2">
	<div class="inner_wrapper" >
		<div class="high_light_area">
			<div class="high_light_area_header">
				<div id="notice_header" ><div id="notice_header_content">Notice</div></div>
				<div id="recentpost_header" ><div id="recentpost_header_content">Most Recent Topic</div></div>
				<div id="recentreply_header" ><div id="recentreply_header_content">Hot Category</div></div>
			</div>
			<div class="high_light_area_content">
				<div class="high_light_area_notice" >
					<div id="content_div">
						11111111
					</div>
				</div>
				
				<div class="high_light_area_recentpost" >
					<div id="content_div">
						<?php
							foreach( $recent_posts as $post ){
								//var_dump( $post);
								?>
								<p><a class="high_light_a" href="/bbs_example/games/post?id=<?= $post['Post']['id'] ?>">
								[<?= $post['Post_category']['short'] ?>]<?= $post['Post']['title'] ?> (<?php echo count($post['Post_reply']);?>)
								</a></p>
								<?php
								
							}
						?>
					</div>
				</div>
				
				<div class="high_light_area_recentreply" >
					<div id="content_div">
						<?php
							foreach( $category as $cate ){
								$cate_count = 0;
								//var_dump( $cate);
								?>
								<p><a class="high_light_a" href="">
								[<?= $cate['Post_category']['category'] ?>]
								<?php
									//var_dump( $cate );
									foreach( $cate['Post'] as $cate_post ){
										//echo $cate_post['created_time'];
										$today = strtotime(date('Y-m-d',time())) - 86400;
										//echo $today;
										if( $cate_post['created_time'] > $today ){ $cate_count++; }
									} 
									echo '(' . $cate_count . ')';
								?>
								</a></p>
								<?php
								
							}
						?>
					</div>
				</div>
			</div>
		</div>
		
		<hr/>
		
		<div class="category">
			<div class="cate_colunm_2">
				<div class='cate_game_coc' onclick="entry_coc()" >
				<img class="cate_entry" src="zzz/picture/coc/cate_button.jpg" style="width:100%;" />
				</div>
				<div class='cate_game_coc' onclick="entry_dota2()">
				<img class="cate_entry" src="zzz/picture/dota2/cate_button.jpg" style="width:100%;" />
				</div>
			</div>
		</div>
		
	</div>


	
</div>



<script>
function entry_coc(){
	window.location.href="games/coc?category=1";
}

function entry_dota2(){
	window.location.href="games/coc?category=2";
}


</script>

<?php
	$this->end();
?>

