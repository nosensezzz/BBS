
<?php
	$this->extend('/forum/template');
	
	$this->start( 'main' );
?>
<div class="wrapper_2">
	<div class="inner_wrapper" >
		<div class="high_light_area">
			<div class="high_light_area_header">
				<div id="notice_header" ><div id="notice_header_content">Popular Teams</div></div>
				<div id="recentpost_header" ><div id="recentpost_header_content">Most Recent Topic</div></div>
				<div id="recentreply_header" ><div id="recentreply_header_content">Hot Category</div></div>
			</div>
			<div class="high_light_area_content">
				<div class="high_light_area_notice" >
					<div id="content_div">
						<?php
							foreach( $recent_sugg as $sugg ){
								//var_dump( $post);
								?>
								<p><a class="high_light_a" href="/bbs_example/games/post?id=<?= $sugg['Post']['id'] ?>">
								<?= $sugg['Post']['title'] ?> 
								</a></p>
								<?php
								
							}
						?>
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
								<?php
									//var_dump( $cate );
									foreach( $cate['Post'] as $cate_post ){
										//echo $cate_post['created_time'];
										$today = strtotime(date('Y-m-d',time())) - 86400;
										//echo $today;
										if( $cate_post['created_time'] > $today ){ $cate_count++; }
									} 
								?>
								<p><a class="high_light_a" href="">
								<?php 
								if( $cate_count > 0):
								echo '[' . $cate['Post_category']['category'] . '] (' . $cate_count . ')'; 
								endif;   ?>
								</a></p>
								<?php
									//var_dump($category);
							}
						?>
					</div>
				</div>
			</div>
		</div>
		
		<hr style="margin-top:10px;"/>
		
		<div class="category">
	
			
			<div class="category_table_div">
						
						<table class="cate_table">
					
					<?php
						foreach( $category as $cate){
							$active_posts_count = 0;
							//die ( var_dump($post) );
						?>
							
							
							<tr onclick="select_this_cate( <?= $cate['Post_category']['id'] ?> )" id="post" style="cursor:pointer;" >
								<td id="tr_id"><img src="/<?php echo Configure::read( 'site_name' );?>/zzz/picture/<?= $cate['Post_category']['id']?>/cate_logo.jpg"  /></td>
								<td style="width:65%;padding-left:25px;"><?=$cate['Post_category']['category']?></td>
								<?php  if($cate['Post_category']['id'] == 0): ?>
								<td style="width:5%;text-align:center;"><?php echo ' - '; ?></td>
								<?php else:?>
								<td style="width:5%;text-align:center;"><?php 
									foreach( $cate['Post'] as $post ){
										$post['status'] > 0?$active_posts_count++:'';
									}
									echo $active_posts_count;
								?></td>
								<?php endif; ?>
								
								<td style="width:27%;text-align:center;" ><?php  if($cate['Post_category']['id'] == 0):      echo '-'; ?><?php 
								else:
								$i = end( $cate['Post'] );
								echo 'Last Posted By - ' . date('Y-m-d H:i:s', $i['created_time']); 
								endif;
								?></td>
								
								
							</tr>
							
							
							
						<?php
						}
					?>
					</table>
			
			
			
			</div>
			
		
	
		</div>
		
</div>


	
</div>





<?php
	$this->end();
?>

