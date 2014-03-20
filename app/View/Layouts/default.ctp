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

$cakeDescription = __d('cake_dev', 'This site used for display only.');

$title = __d( 'title' , 'Game BBS' );

$site_url = __d( 'SITE', 'bbs_example' );

//define('SITE' , 'bbs_example');


?>
<!DOCTYPE html>
<html>
<head>
	<?php echo $this->Html->charset(); ?>
	<title>
		<?php echo $title ?>
		<?php //echo $title_for_layout; ?>
	</title>
	<?php
		echo $this->Html->meta('icon');

		echo $this->Html->css('cake.generic');

		echo $this->fetch('meta');
		echo $this->fetch('css');
		echo $this->fetch('script');
	?>
	<!-- My CSS-->
	<link rel="stylesheet" href="/<?= $site_url ?>/zzz/css/zzz.css" type="text/css" media="screen" />
	
	<!-- Jquery JS  -->
	<script type="text/javascript" src="/<?= $site_url ?>/zzz/jquery/jquery-1.9.1.js"></script>
	<script type="text/javascript" src="/<?= $site_url ?>/zzz/jquery/jquery-ui-1.10.3.custom.js"></script>
	<script type="text/javascript" src="/<?= $site_url ?>/zzz/jquery/jquery-ui-1.10.3.custom.min.js"></script>
	<link rel="stylesheet" type="text/css" href="/<?= $site_url ?>/zzz/jquery/css/ui-lightness/jquery-ui-1.10.3.custom.css">
	<link rel="stylesheet" type="text/css" href="/<?= $site_url ?>/zzz/jquery/css/ui-lightness/jquery-ui-1.10.3.custom.min.css">
	
	<!-- nivo  -->
	<script type="text/javascript" src="/<?= $site_url ?>/zzz/nivo/jquery.nivo.slider.js"></script>
	<link rel="stylesheet" href="/<?= $site_url ?>/zzz/nivo/nivo-slider.css" type="text/css" media="screen" />
	
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
