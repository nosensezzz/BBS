<?php
/**
 *
 * PHP 5
 *
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       app.View.Layouts
 * @since         CakePHP(tm) v 0.10.0.1076
 * @license       http://www.opensource.org/licenses/mit-license.php MIT License
 */

$cakeDescription = __d('cake_dev', 'have fun and get all you want here.');

$title = __d( 'title' , 'nonsense 游戏讨论和交易中心' );

$site_url = __d( 'SITE', 'bbs_example' );

//define('SITE' , 'bbs_example');


?>
<!DOCTYPE html>
<html>
<head>
	<?php echo $this->Html->charset(); ?>
	<title>
		<?php echo $title ?>
		<?php echo ' - ' . $title_for_layout; ?>
	</title>
		<meta name="description" content="A place to enhance your skill at all kinds game ">
		<meta name="keywords" content="games, clash of clans, dota2, <?= $title_for_layout ?>">
		<meta name="author" content="">
		<meta charset="UTF-8">
	<?php
		echo $this->Html->meta('icon');

		echo $this->Html->css('cake.generic');

		echo $this->fetch('css');
		echo $this->fetch('script');
	?>
	<!-- My CSS-->
	<link rel="stylesheet" href="/<?= $site_url ?>/zzz/css/zzz.css" type="text/css" media="screen" />
	<!-- User Nav Bar -->
	<link rel="stylesheet" href="/<?= $site_url ?>/zzz/nav_bar_css/menu_style.css" type="text/css" media="screen" />
	<!-- Jquery JS  -->
	<script type="text/javascript" src="/<?= $site_url ?>/zzz/jquery/jquery-1.9.1.js"></script>
	<script type="text/javascript" src="/<?= $site_url ?>/zzz/jquery/jquery-ui-1.10.3.custom.js"></script>
	<script type="text/javascript" src="/<?= $site_url ?>/zzz/jquery/jquery-ui-1.10.3.custom.min.js"></script>
	<link rel="stylesheet" type="text/css" href="/<?= $site_url ?>/zzz/jquery/css/ui-lightness/jquery-ui-1.10.3.custom.css">
	<link rel="stylesheet" type="text/css" href="/<?= $site_url ?>/zzz/jquery/css/ui-lightness/jquery-ui-1.10.3.custom.min.css">
	
	<!-- nivo  -->
	<script type="text/javascript" src="/<?= $site_url ?>/zzz/nivo/jquery.nivo.slider.js"></script>
	<link rel="stylesheet" href="/<?= $site_url ?>/zzz/nivo/nivo-slider.css" type="text/css" media="screen" />
	
	<!-- validationEngine -->
	<script src="/<?= $site_url ?>/zzz/jQuery-Validation-Engine-master/js/jquery.validationEngine-en.js" type="text/javascript" charset="utf-8"></script>
	<script src="/<?= $site_url ?>/zzz/jQuery-Validation-Engine-master/js/jquery.validationEngine.js" type="text/javascript" charset="utf-8"></script>
	<link rel="stylesheet" href="/<?= $site_url ?>/zzz/jQuery-Validation-Engine-master/css/validationEngine.jquery.css" type="text/css"/>
	
	<!-- uploadify -->
	<script src="/<?= Configure::read('site_name') ?>/zzz/uploadify/jquery.uploadify.min.js" type="text/javascript"></script>
	<link rel="stylesheet" type="text/css" href="/<?= Configure::read('site_name') ?>/zzz/uploadify/uploadify.css">
	
	<!-- CSS for Drop Down Tabs Menu #1 -->
	<link rel="stylesheet" type="text/css" href="/<?= Configure::read('site_name') ?>/zzz/top_nav_bar/top_nav/ddcolortabs.css" />
	<script type="text/javascript" src="/<?= Configure::read('site_name') ?>/zzz/top_nav_bar/top_nav/dropdowntabs.js"></script>
</head>
<body>
	<div id="container">
		<div id="header">
			<h1><?php echo $this->Html->link($cakeDescription, '/'); ?></h1>
		</div>
		<div id="content">

			<?php //echo $this->Session->flash(); ?>

			<?php echo $this->fetch('content'); ?>
		</div>
		<div id="footer">
			
			
			<div class="copyright">
				Developed by nosensezzz  |  ©2013 nosensezzz All Rights Reserved.
			</div>
		</div>
	</div>
	
</body>
</html>
