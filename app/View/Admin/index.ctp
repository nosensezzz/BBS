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
AdminMain
<div class="admin_wrapper">
			<div class="category">
			<div class="category_table_div">
						
						<table class="cate_table">
					
					
							<tr style="text-align:center;"><th></th><th></th><th>待审核</th><th>帖子数</th></tr>
					
					<?php
						foreach( $categories as $cate){
							 // var_dump($cate) ;
						?>
							
						
							<tr onclick="admin_select_this_cate( <?= $cate['Post_category']['id'] ?> )" id="" style="cursor:pointer;">
								<td id="tr_id"><img src="/<?php echo Configure::read( 'site_name' );?>/zzz/picture/<?= $cate['Post_category']['id']?>/cate_logo.jpg"  /></td>
								<td style="width:70%;padding-left:25px;"><?=$cate['Post_category']['category']?></td>
								<td style="width:14%;text-align:center;">
								<?php
								$pending = 0;
								foreach($cate['Post'] as $post){
									if($post['status'] == 1){ $pending++; }
								}
								echo $pending;
								?>
								</td>

								<td style="width:14%;text-align:center;"><?php echo count($cate['Post']); ?></td>
								
							
								
							</tr>
							
							
							
						<?php
						}
					?>
					</table>
			
			</div>
			</div>
</div>


<script>
function admin_select_this_cate(cate_id){

	window.location.href="/<?= Configure::read('site_name')?>/admin/category/" + cate_id ;
}

</script>