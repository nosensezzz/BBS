<?php

	$category = $this->Session->read( 'category' );
	$poster = $this->Session->read('id');


	$this->extend('/forum/template');
	
	$this->start( 'main' ); 
	
	$total_result = count($posts);
?>
<div class="wrapper_2">
<div class="inner_wrapper" >

	<div class="search_result_div" >
			<span>Search Result 	-- total <?=$total_result ?> results</span><hr/>
	<?php foreach($posts as $post){  ?>
			<div class="search_single_div">
				<a href="/<?=Configure::read('site_name')?>/games/post?id=<?=$post['Post']['id']?>" id="search_title" style="font-size: 18px;"><?= $post['Post']['title'] ?></a>
				  <span> By : <?=$post['User']['username']?></span>
				<br/>
				<span style="font-size: 9px;" >www.<?=Configure::read('site_name')?>/games/post?id=<?=$post['Post']['id']?></span><br/>
				<div>
				<?php if(!empty($post['Post']['picture'])): ?>
				<img style="float:left;" src="/<?=$post['Post']['picture']?>" height=40px width=40px ></img>
				<?php endif; ?>
				<span style="float:left;margin: 23px 0px 0px 10px;"><?=$post['Post']['text'] ?></span>
				
				</div>
				
				
			</div>
	<?php } ?>
	</div>
	<div class="pagination">
		<a href="?query=<?=$_GET['query']?>&page=1"><<</a>
		
			<?php
			$page = 1;
			if( !isset($_GET['page'])){	$_GET['page'] = 1;	}
			while( $total_results > 0 ){
				$total_results -= 10;
				
				if($page == $_GET['page']  ){
				?>
					<a href='?query=<?=$_GET["query"]?>&page= $page?>' style="color:white;"><?=$page++?></a>
					<?php
				}else{
				?>	
					<a href="?query=<?=$_GET['query']?>&page=<?= $page?>"><?=$page++?></a>
				<?php
				}
			}
			$page--;
			?>
		<a href="?query=<?=$_GET['query']?>&page=<?= $page?>">>></a>
	</div>
</div>
</div>





<?php 
	$this->end( 'main' );
?>