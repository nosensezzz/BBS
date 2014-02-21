<?php

$site_url = "bbs_example";

?>

<div class="wrapper">
User Register



<?php 
	echo $this->Form->create("User", array(
		'inputDefaults' => array(
			'div' => false
		)	
	));
	
	?>
	<div>
	
	<?=
	$this->Form->input( 'username' , array(
		'label' => 'Username',
		'id' => "username"
	));
	?>
	<p id="username_hint" style="display:none;" ></p>
	
	<?=
	$this->Form->input( 'Email' , array(
		'label' => 'Email',
		'type' => 'email'
	));
	?>
	</div>
	
	<div>
	<?=
	$this->Form->input( 'password' , array(
		'label' => 'Password',
		'id' => 'mainpassword'
	));
	?>
	
	
	<label for="retype">Re-type</label><input id="retype" type="password"  />
	<p id="password_hint" style="display:none;" ></p>
	</div>
	
	<div>

	<?=
	$this->Form->input( 'first_name' , array(
		'label' => 'Your First Name'
	));
	?>
	
	
	<?=
	$this->Form->input( 'last_name' , array(
		'label' => 'Your Last name'
	));
	?>
	</div>
	<input id='info' name='info' hidden />
	<div ><input type="submit" value="submit" id="submit" /></div>

	
</div>










<script>
// Check password match
$("#retype").blur( function(){
	
	val1 = $("#retype").val();
	val2 = $("#mainpassword").val();
	if ( val2.length < 4 ) {
		$("#password_hint").html( "Your password is not long enough." );
		$("#password_hint").show();
		$( "#info" ).val('1');
	
	} else if ( val1 != val2 ){
		$("#password_hint").html( "Your password is not match." );
		$("#password_hint").show();
		$( "#info" ).val('1');
	} else {
		$("#password_hint").html( "" );
		$("#password_hint").hide();
		$( "#info" ).val('9');
	}
	
	
	
});




// Check password length
$("#mainpassword").blur ( function(){
	check = false;
	val1 = $("#retype").val();
	val2 = $("#mainpassword").val();
	if ( val2.length < 4 ) {
		$("#password_hint").html( "Your password is not long enough." );
		$("#password_hint").show();
		//check = true;
		//$( "#reg_submit" ).hide();
		$( "#info" ).val('1');
		//alert(  $( "#info" ).val());
	} else if ( val1 != val2 ){
		$("#password_hint").html( "Your password is not match." );
		$("#password_hint").show();
		//check = true;
		//$( "#reg_submit" ).hide();
		$( "#info" ).val('1');
	} else {
		$("#password_hint").html( "" );
		$("#password_hint").hide();
		
		//check = false;
		/*if( check==false && check2 == false ){
			$( "#reg_submit" ).show();
		}
		*/
		$( "#info" ).val('9');
		alert( $( "#info" ).val() );
		
	}
} );

$("#username").blur( function(){
	username = $(this).val();
	url =  "/<?= $site_url ?>/ajax/ajax";
	$.ajax( {
		url: url,
		dataType: "json",
		type:　"post",
		async: false,
		data:{ a:"UserNameCheck", username: username},
		success:function(data){
		//console.log( data );
		if ( data['msg'] == 'This username has been used.'){
			$(" #username_hint ").html('This username has been used.');
			$("#username_hint").show();
			$( "#info" ).val('2');
			//check2 = true;
			
		} else if ( data['msg'] == 'You can use this username.' ){
			$(" #username_hint ").html('This username is open.' );
			$("#username_hint").show();
			$( "#info" ).val('9');
			//check2 = false;
		}
		
		
		},
		error:function(data){
		//console.log( data );
		}
		
	} );
	
} );




</script>









