<?php

	$category = $this->Session->read( 'category' );
	$uid = $this->Session->read('id');


	$this->extend('/forum/template');
	
	$this->start( 'main' ); 
	

?>


<div class="wrapper_2">
<div class="inner_wrapper" >
Create a team
				
						<form action="/bbs_example/team/create_team_form/<?php echo $uid;?>"  enctype="multipart/form-data"  id="createTeamForm" method="post" accept-charset="utf-8" >
							
							
							
								
							<table cellspacing=2 cellpadding=0 width=300 border=0>
							<tr>
							<td width=170px ><img src="/<?=Configure::read('site_name')?>/zzz/avatar/1.jpg" height=100px width=100px style="margin:14px;" id="teamlogo" /></td>
							<td><input style="margin-top:100px;" name="logo" type="file"/>
							</td>
							</tr>
							<tr>
							<td><font class="en1"><label for="type">Game Type Select</label></font> </td>
							<td><div>
								<select name="data[Team][type]" id="type">
								<option value="1">Dota 2</option>
								<option value="2">League of Legend</option>
								</select>
							
							</div>
							</td>
							</tr>
							<tr>
							<td width=170px ><font class="en1"><label for="Team Name">Team - Name</label></font> </td>
							<td><input size=50 name="data[Team][team_name]" placeholder="Team Name" id="teamname"
							class="input1"
							onblur="this.className='input1 validate[required] ajax[ajaxTeamCreatePhp]'" 
							onfocus="this.className='input1-bor validate[required] '" />
							</td>
							</tr>
							<tr>
							<td><font class="en1"><label for="Team Name Short">Short Name</label></font> </td>
							<td><input size=50  name="data[Team][short]" type="text" placeholder="Like 'DK' 'iG' , max 10 char" id="teamshort"
							class="input1"
							onblur="this.className='input1 validate[required] ajax[ajaxTeamCreatePhp]'" 
							onfocus="this.className='input1-bor validate[required] '" />
							</td>
							</tr>
							<tr>
							<td><font class="en1"><label for="Team Description">Description</label></font> </td>
							<td><div><textarea name="data[Team][team_description]" id="description"></textarea></div>
							<input hidden name="data[Team][leader_uid]" value="<?=$uid?>" />
							<!--input hidden name="data[Team][type]" value="1" /-->
							</td>
							</tr>
							<tr>
							<td> </td>
							<td>
								<input type="submit" value="Submit" />
							</td>
							</tr>
					
					
								
							</table>	
											
							
	
							
							
							<!--input type="submit" value="LOG IN"/ -->
						</form>
			






</div>
</div>

<script type="text/javascript">
		
$(function() {		
	CKEDITOR.replace( 'description', {
    toolbar: 'Basic',
    uiColor: '#4D4D4D',
	width : '50%',
	toolbarCanCollapse : true,
	toolbarStartupExpanded : false,
	});
	
	jQuery(document).ready(function(){
			// binds form submission and fields to the validation engine
			jQuery("#createTeamForm").validationEngine();			
			
	});


});
	</script>

<?php 
	$this->end( 'main' );
?>