<?php

	$this->extend('/forum/template');
	
	$this->start( 'main' ); 
	
	$site_url = Configure::read('site_name');
	$id = Configure::read('id');
	
?>
<div class="wrapper_2">
<div class="inner_wrapper" >

	<div><!-- Check if user has had a same type team  -->
	<?php
		if($team['userHasTeam']){
			?>
			<p style="color:red;">You have joined a same type team.</p>
			<?php
		}else if(!$team['userHasTeam']){
		?>
			<div id="team_join_request" class="joinTeamRequestForm">
			<form action="/<?=$site_url?>/Team/joinTeamAjax/<?=$id?>" id="" method="" accept-charset="utf-8">
			<label for="mainRole">Main Role</label>
			<select name="main_role" id="mainRole">
			<option value="C">Carry</option>
			<option value="S">Support</option>
			<option value="G">Ganker</option>
			<option value="A">Almighty</option>
			<option value="L">Leader</option>
			</select>
			<label for="secondRole">Off Role</label>
			<select name="second_role" id="secondRole">
			<option value="C">Carry</option>
			<option value="S">Support</option>
			<option value="G">Ganker</option>
			<option value="A">Almighty</option>
			<option value="L">Leader</option>
			</select><br/>
			
			<label for="requestMsg">Request Message</label>
			<textarea id="requestMsg" name="requestMsg"></textarea>
			<button id="sendRequestBtn">Send Request</button>
			</form>
			</div>
		<?php
		}
	?>

	</div>
	<div>
	<?php
		var_dump($team);
	?>
	</div>







</div>
</div>
<script>
$(document).ready(function(){
	CKEDITOR.replace( 'requestMsg', {
    toolbar: 'Basic',
    uiColor: '#4D4D4D',
	width : '50%',
	toolbarCanCollapse : true,
	toolbarStartupExpanded : false,
	});
});

$('#sendRequestBtn').on('click' , function(e){
	e.preventDefault();
	
});
</script>
<?php 
	$this->end( 'main' );
?>