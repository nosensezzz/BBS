<?php

	$category = $this->Session->read( 'category' );
	$poster = $this->Session->read('id');


	$this->extend('/forum/template');
	
	$this->start( 'main' );
?>

<div class="all_post" id="coc_all_posts" >





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





<?php
	$this->end( 'main' );
?>