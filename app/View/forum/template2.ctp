<div class="template_">

<?php 
	$site_url = Configure::read('site_name');
?>

<!--  用户简要信息 与 用户相关操作 -->
<?php
		$id = $this->Session->read('id');
		$user = $this->Session->read('user');
		$cate = $this->Session->read('cate');


		//var_dump($cate);
		if( !$id ){
		?>
			<script>
					// 没注册用户的处理
					window.location.href="/<?= Configure::read('site_name')?>"
				
			</script>
			<div class="central_window">
				<?php
				//echo $this->Html->link('You need to register first. Click here to go back' , '/' );
				?>
				<script>
				</script>
			</div>
		
		<?php
		} else {
		// ***********************************          User information
		?>
		
<div class='user_info'>
		
			<div>
			<ul class="menu">
			<?php if( empty($user['avatar']) ):  ?>
				<li class="top_img"><img src="/<?=Configure::read('site_name')?>/zzz/picture/1.jpg"  /></li>
			<?php else :?>
				<li class="top_img"><img src="/<?=Configure::read('site_name')?>/zzz/picture/user/<?=$id ?>/<?=$user['avatar']?>" /></li>
			<?php endif ?>
				<li class="top"><span class="top_username"><?= $user['username'] ?></span></li>
				<!--li class="top"><a href="" class="top_link"><span>TBD</span></a></li-->
	
				
				<li class="top_right"><a href="/<?= Configure::read('site_name')?>/user/logout" class="top_link"><span>Logout</span></a></li>
				<li class="top_right"><a href="/<?=$site_url?>/user/user_edit/<?= $id ?>" class="top_link"><span>Edit</span></a></li>
			</ul>
			</div>
		
		
			
			
</div>	
			
		<?php
		// ***********************************         User information end here
		}
	
?>
	

<div class="left_part">
	<div class="sidebar">	
		<div style="padding:5px;">
			<div class="siderbar_top_part"><img src="/<?=$site_url?>/zzz/picture/logo/skull_logo_original.png" alt="logo"/ onclick="back_to_main()" class="siderbar_logo"></div>
			<hr/>
			
			<div class="siderbar_search"><input size=12"/><button style="width:110px;margin-top:5px;">Search</button></div>
			<hr/>
			<div class="siderbar_mid_part">
			<ul>	
				<span>Categories</span>
				<?php foreach($cate as $category):	?>
				<li><a href="#"><?=$category['cate']['short']?></a></li>
				<?php endforeach; ?>
			</ul>
			</div>
			<hr/>
		</div>
	</div>
	<div class="time_panel">
	<?php echo date('Y-m-d H:i:s', time());  ?>
	</div>
</div>
<div class="right_part">
<div class="right_part_top_links">

<div id="colortab" class="ddcolortabs">
<ul>
<li><a href="/<?= $site_url?>" title=""><span>Forum</span></a></li>
<li><a href="#" title=""><span>Shop</span></a></li>
<li><a href="#" title="" ><span>TBD</span></a></li>
	
<li><a href="#" title="" rel="dropmenu_a" ><span>Contact Us</span></a></li>	
</ul>
</div>

<div class="ddcolortabsline">&nbsp;</div>


<!--1st drop down menu -->                                                   
<div id="dropmenu_a" class="dropmenudiv_a">
<a href="#">nosensezzz</a>

</div>


<!--2nd drop down menu -->                                                


<script type="text/javascript">
//SYNTAX: tabdropdown.init("menu_id", [integer OR "auto"])
tabdropdown.init("colortab", 3)
</script>

</div>
	
	
	
	
	
<?php
	// main is the page content...
	echo $this->fetch('main');
?> 

</div>
</div><!-- All end here -->

<script>
function back_to_main(){
	window.location.href="/bbs_example/forum";
}
function back_to_index(){
	window.location.href="/bbs_example";
}
</script>