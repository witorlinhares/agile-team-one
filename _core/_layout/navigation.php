<?php
global $simple_url;
?>
<nav class="navbar pull-left">
	<ul class="nav navbar-nav">
		<li class="active"><a href="<?php just_url(); ?>">Ínicio</a></li>
		<li><a href="<?php just_url(); ?>/conheca">Conheça</a></li>
		<li><a href="https://<?php echo $simple_url; ?>/localizacao">Marketplace</a></li>
	</ul>
</nav> 

<nav class="navbar pull-right hidden-xs hidden-sm">
	<ul class="nav navbar-nav">
		<li class="active"><a target="_blank" href="https://api.whatsapp.com/send?phone=55<?php echo $whatsapp; ?>&text=Como%20posso%20te%20ajudar%20%3B%20"><i class="lni lni-headphone-alt icon-left"></i> Fale conosco</a></li>
	</ul>
</nav> 

<div class="clear"></div>