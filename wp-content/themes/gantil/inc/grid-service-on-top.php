<?php

require_once $_SERVER['DOCUMENT_ROOT'].'/wp-content/themes/gantil/controllers/serviceController.php';

$grid = new Service;
$arr = $grid->getServiceCat();

$i = 0;
foreach($arr as $k) {
	?>
	<div class="col-xs-6 grid-promo-item grid-item-news" >
		<div>
			<a href="<?=$k['link']?>">
				<img class="img-mono" src="<?=makeGrayPic($k['img_src'])?>">
				<img class="img-color" src="<?=$k['img_src']?>">
				<!-- <?=$k['img']?> -->
			</a>
			<span><?=$k['name']?></span>
		</div>
	</div>
	<?php
	if ($i == 1) {
		echo '<div style="clear:both"></div>';
	}
	$i++;
}

?>
<script type="text/javascript">
$(document).ready(function()
{	
	$('.grid-promo-item, .banner-align-left, .banner-align-right').mouseenter(function()
	{			
		$(this).find('.img-color').show()
		$(this).find('.img-mono').animate({opacity: 0}, 300);
	}).mouseleave (function()
	{		
		$(this).find('.img-mono').animate({opacity: 1}, 500);		
	})
});
</script>