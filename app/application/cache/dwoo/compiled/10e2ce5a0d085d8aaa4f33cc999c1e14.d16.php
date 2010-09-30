<?php
if (function_exists('Dwoo_Plugin_include')===false)
	$this->getLoader()->loadPlugin('include');
ob_start(); /* template body */ ;
echo Dwoo_Plugin_include($this, 'file:///Applications/XAMPP/xamppfiles/htdocs/deadweight/beta1/views/header.tpl', null, null, null, '_root', null);?>


<div id="content">
	<?php echo $this->scope["content"];?>

	
	<div id="slideshow">
	<?php 
$_fh0_data = (isset($this->scope["images"]) ? $this->scope["images"] : null);
if ($this->isArray($_fh0_data) === true)
{
	foreach ($_fh0_data as $this->scope['url'])
	{
/* -- foreach start output */
?>
	  <img src="<?php echo $this->scope["url"];?>" width="500"/>
	<?php 
/* -- foreach end output */
	}
}?>

	</div>
</div>	

<?php echo Dwoo_Plugin_include($this, 'file:///Applications/XAMPP/xamppfiles/htdocs/deadweight/beta1/views/footer.tpl', null, null, null, '_root', null);
 /* end template body */
return $this->buffer . ob_get_clean();
?>