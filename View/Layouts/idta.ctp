<?php
/**
 *
 * PHP 5
 *
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright 2005-2011, Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright 2005-2011, Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       Cake.View.Layouts
 * @since         CakePHP(tm) v 0.10.0.1076
 * @license       MIT License (http://www.opensource.org/licenses/mit-license.php)
 */

$cakeDescription = __d('cake_dev', 'CakePHP: the rapid development php framework');
$title = 'BCA';

?>
<!DOCTYPE html>
<html>
<head>
	<?php echo $this->Html->charset(); ?>
	<title>
		<?php echo $title ?>:
		<?php echo $title_for_layout; ?>
	</title>
	<?php
		echo $this->Html->meta('icon');

		echo $this->Html->css('bca');

		echo $this->fetch('meta');
		echo $this->fetch('css');
		echo $this->fetch('script');
	?>

<!--
<script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

  ga('create', 'UA-51197293-1', 'idta.co.uk');
  ga('send', 'pageview');

</script>
-->

</head>
<body>
	<?php
		// Scripts for Google Translate //
		echo $this->Html->script('google_translate');
		echo $this->Html->script('//translate.google.com/translate_a/element.js?cb=googleTranslateElementInit');
	?>

	<div id="where">
	<?php
	echo $this->Html->link(
		$this->Html->image('/img/Nav_Whereoff.gif',
			array('escape' => false, 'alt' => 'Dance Centres',
				'onmouseover' => "this.src='/img/Nav_Whereon.gif'",
				'onmouseout' => "this.src='/img/Nav_Whereoff.gif'"
			)
		),
		'http://idta.co.uk/Site2/centres.php',
		array('escape' => false)
	);
	?>
	</div>

	<div id="funk">
	<?php
	echo $this->Html->link(
		$this->Html->image('/img/Nav_Funkoff.gif',
			array('escape' => false, 'alt' => 'Funky Moves',
				'onmouseover' => "this.src='/img/Nav_Funkon.gif'",
				'onmouseout' => "this.src='/img/Nav_Funkoff.gif'"
			)
		),
		'http://www.idta-funkymoves.co.uk',
		array('escape' => false)
	);
	?>
	</div>

	<div id="teen">
	<?php
	echo $this->Html->link(
		$this->Html->image('/img/Nav_Teenoff.gif',
			array('escape' => false, 'alt' => 'Teen Tribes',
				'onmouseover' => "this.src='/img/Nav_Teenon.gif'",
				'onmouseout' => "this.src='/img/Nav_Teenoff.gif'"
			)
		),
		'http://www.idta-teentribe.co.uk',
		array('escape' => false)
	);
	?>
	</div>

	<div id="logo_bar">
		<a href="http://idta.co.uk"><img src="/img/Nav_logobar-white.gif" alt="Logo Bar" /></a>
	</div>

	<div id="container">
		<div id="header">
			<h1><p>&nbsp;</p>'</h1>
		</div>

		<div id="content">
			<div id="google_translate_element"></div>


			<?php echo $this->Session->flash(); ?>
			<?php echo $this->fetch('content'); ?>
		</div>

		<div id="footer">

			<?php echo $this->Html->link(
					$this->Html->image('cake.power.gif', array('alt' => $cakeDescription, 'border' => '0')),
					'http://www.cakephp.org/',
					array('target' => '_blank', 'escape' => false)
				);
			?>

			<div id="footer_detail">
				<?php echo $this->Html->para(null, 'IDTA: International House, 76 Bennett Road, Brighton, East Sussex, BN2 5JL <br \>'.
					'Tel: +44 (0)1273 685 652. Fax: +44 (0)1273 674 388<br \>'.
					'&copy; 2013 International Dance Teachers Association. All rights reserved.'); ?>
			</div>

		</div>
	</div>
	<?php echo $this->element('sql_dump'); ?>
</body>
</html>
