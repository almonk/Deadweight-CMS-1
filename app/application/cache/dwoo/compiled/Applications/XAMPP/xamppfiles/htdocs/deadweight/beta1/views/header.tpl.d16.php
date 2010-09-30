<?php
ob_start(); /* template body */ ?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
 "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<title><?php echo $this->scope["title"];?>| Deadweight</title>
		<?php echo $this->scope["jquery"];?>

		<script type="text/javascript" src="http://cloud.github.com/downloads/malsup/cycle/jquery.cycle.all.2.72.js"></script>
		<link rel="stylesheet" href="<?php echo $this->scope["site_url"];?>public/css/reset.css" type="text/css" media="screen" title="no title" charset="utf-8"/>
		<link rel="stylesheet" href="<?php echo $this->scope["site_url"];?>public/css/style.css" type="text/css" media="screen" title="no title" charset="utf-8"/>
		<script type="text/javascript" charset="utf-8">
			$(function() {
			    $('#slideshow').cycle({
			        fx:      'fade',
			        timeout:  1000,
			        prev:    '#prev',
			        next:    '#next'
			    });
			});
		</script>
	</head>
	<body>
		<div id="wrapper">
			<div id="left">
				<h1>Mada Upnaym</h1>
				<p>Photographer &amp; designer</p>
				<ul>
					<li><a href="<?php echo $this->scope["site_url"];?>">Home</a></li>
					<?php echo $this->scope["nav"];?>

				</ul>
				<p class="credit">Powered by Deadweight 0.1</p>
			</div><?php  /* end template body */
return $this->buffer . ob_get_clean();
?>