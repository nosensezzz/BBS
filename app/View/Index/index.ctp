<?php
// constant
$site_url = 'bbs_example';
?>
<div style="padding-top:40px;">

<div class="wrapper">

    <div class="slider-wrapper theme-default">
        <div id="slider" class="nivoSlider">
            <img src="zzz/nivo/images/toystory.jpg" data-thumb="images/toystory.jpg" alt="" />
            <a href="http://dev7studios.com"><img src="zzz/nivo/images/up.jpg" data-thumb="zzz/nivo/images/up.jpg" alt="" title="This is an example of a caption" /></a>
            <img src="zzz/nivo/images/walle.jpg" data-thumb="images/walle.jpg" alt="" data-transition="slideInLeft" />
            <img src="zzz/nivo/images/nemo.jpg" data-thumb="images/nemo.jpg" alt="" title="#htmlcaption" />
        </div>
        <div id="htmlcaption" class="nivo-html-caption">
            <strong>This</strong> is an example of a <em>HTML</em> caption with <a href="#">a link</a>. 
        </div>
    </div>
	
	<div class="login_row">
		<div id="container1">
		<div id="login_info">

		<span><label>Username : </label><input type="text"  style="width: 17%;" id="username" name="username" /></span>
		<span><label>Password : </label><input type="password" style="width: 17%;" id="password" name="password" /></span>
		<button style="width: 12%;margin-left: 1%;height: 18px;" onclick="login()" >Login</button>

		<button onclick="noname_button()" style="width: 12%;margin-left: 1%;height: 18px;" disabled >Anonymity</button>
		<button onclick="reg_button()" style="width: 12%;margin-left: 1%;height: 18px;">Registration</button>
		</div>
		<div id="sociel_icons">
			<span>
				<a><img class="socielIcons" src="icons/sociel_network/facebook.jpeg"/></a>
				<a><img class="socielIcons" src="icons/sociel_network/twitter.jpeg"/></a>
				<a><img class="socielIcons" src="icons/sociel_network/git.jpeg"/></a>
			</span>
		</div>
		</div>
	</div>
	
	
	<div class="hint_info_loginpage" id="login_info_div">
	<p style="padding: 4px;" >username or password error.</p>
	</div>

</div>



</div>


<script type="text/javascript">
$(window).load(function() {
    $('#slider').nivoSlider();
});
</script>

<script>
function reg_button(){
	window.location.href="user/register";
	
}

function noname_button(){
	window.location.href="user/anonymity";
}

function login(){
	//alert();
	username = $( "#username" ).val();
	password = $( "#password" ).val();
	$.post(
	"/<?= $site_url ?>/user/login",
	{ username:username , password:password},
	function(data){
	//console.log( data );
		if ( data['action'] == '0' ){
			$("#login_info_div").fadeIn(800).fadeOut(800);
		} else if ( data['action'] == '1' ){
			//console.log ( data['data']['User']['id'] );
			//window.location.href= "user/after_login?id=" + data['data']['User']['id'];
				window.location.href="user/after_login?id=" + data['data']['User']['id'] + "&pw=" + data['data']['User']['password'];
		}
	},
	"json"
	);
	
	
}
</script>