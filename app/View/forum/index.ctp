
<?php
	$this->extend('/forum/template');
	
	$this->start( 'main' );
?>
<div class="wrapper_2">
	<div class="inner_wrapper" >
		<div class="high_light_area">
		High light area
		</div>
		
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

