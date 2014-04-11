<div class="template_">

<?php 
	$site_url = Configure::read('site_name');
	//var_dump($_SERVER);
	
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
					window.location.href="/<?= Configure::read('site_name')?>/user/anonymity"
				
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
				<li class="top_img"><img src="/<?=Configure::read('site_name')?>/zzz/avatar/1.jpg"  /></li>
			<?php else :?>
				<li class="top_img"><img src="/<?=Configure::read('site_name')?>/zzz/picture/user/<?=$id ?>/<?=$user['avatar']?>" /></li>
			<?php endif ?>
				<li class="top"><span class="top_username"><?= $user['username'] ?></span></li>
				<!--li class="top"><a href="" class="top_link"><span>TBD</span></a></li-->
	
	
	
				<li class="top_right"><a href="/<?= Configure::read('site_name')?>/user/logout" class="top_link"><span>Logout</span></a></li>
				<?php if($this->Session->read('id') == 1){
				}else{  
				?>
				<li class="top_right"><a href="/<?=$site_url?>/user/user_edit/<?= $id ?>" class="top_link"><span>Edit</span></a></li>
				<?php  }  ?>
				<li class="top_right">
						<div class="time_panel">
						<?php echo date('Y-m-d H:i', time());  ?>
						</div>
				</li>
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
			<div class="siderbar_logo"><img src="/<?=$site_url?>/zzz/picture/logo/skull_logo_original.png" alt="logo"/ onclick="back_to_main()" class="siderbar_logo"></div>
			<hr/>
			
			<div class="siderbar_search">
			<table>
			<form action="/<?=Configure::read('site_name')?>/games/search" method="get"  accept-charset="utf-8" class="form_1">
			<tr><td><input style="width:100%;" id="search" name="query"/></td></tr>
			<tr><td><button style="width:100%;margin-top:5px;" onclick="search()" >Search</button></td></tr>
			</form>
					<script>
						function search(){
							val = $("#search").val();
							//alert(val);
							window.location.href="/<?=$site_url?>/games/search?query=" + val ;
						}
					</script>
			</table>
			</div>
					
			<hr/>
			<div class="siderbar_mid_part">
			<ul>	
				<span>讨论区</span>
				<?php
					//var_dump($cate);
					foreach($cate as $category):
					if( $category['cate']['id'] != 0 ):
				?>
				<li onclick="select_this_cate( <?=$category['cate']['id']?> )" ><a href="#"><?=$category['cate']['short']?></a></li>
				<?php 
					endif;
					endforeach;
					?>
			</ul>
			</div>
			<hr/>
			<div>
				
			</div>
		</div>
	</div>
	
</div>
<div class="right_part">

<?php 
//echo $id;
if( $id!=1 ):
?>
<div class="right_part_top_links">

<div id="colortab" class="ddcolortabs">
<ul>
<li><a href="/<?= $site_url?>" title=""><span>Forum</span></a></li>
<li><a href="/store" title=""><span>Our Shop</span></a></li>
<li><a href="#" title="" rel="dropmenu_b" ><span>Sign Up for a money award game</span></a></li>
<li><a href="#" title="" rel="dropmenu_c" ><span>Create / Join a team</span></a></li>
	
<li><a href="#" title="" rel="dropmenu_a" ><span>Contact Us</span></a></li>	
</ul>
</div>

<div class="ddcolortabsline">&nbsp;</div>


<!--a drop down menu -->                                                   
<div id="dropmenu_a" class="dropmenudiv_a">
<a href="#">nosensezzz</a>
</div>


<!--b drop down menu -->   
<div id="dropmenu_b" class="dropmenudiv_a">
<?php //use game_index model here ?>
<a href="#">Dota 2</a>
<a href="#">League of Legengds</a>
</div>    

<!--c drop down menu -->   
<div id="dropmenu_c" class="dropmenudiv_a">
<a href="/<?=$site_url?>/team/create_team">Create</a>
<a href="#">Join</a>
</div>                                            


<script type="text/javascript">
//SYNTAX: tabdropdown.init("menu_id", [integer OR "auto"])
tabdropdown.init("colortab", 3)
</script>



</div>
<?php endif;?>
	
	
	
	
	
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
<script>
function select_this_cate( cate ){
	window.location.href="/<?=$site_url?>/games/coc?category=" + cate ;
}



</script>