<?php

	$category = $this->Session->read( 'category' );
	$poster = $this->Session->read('id');


	$this->extend('/forum/template');
	
	$this->start( 'main' ); 
	
	$total_result = count($posts);
?>
<div class="wrapper_2">
<div class="inner_wrapper" >












</div>
</div>
<?php 
	$this->end( 'main' );
?>