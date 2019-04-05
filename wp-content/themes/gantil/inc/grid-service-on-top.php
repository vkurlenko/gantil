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
				<img class="grid-item-img img-mono" src="<?=makeGrayPic($k['img_src'])?>" data-imgcolor="<?=$k['img_src']?>">
				<!-- <img class="img-color" src="<?=$k['img_src']?>"> -->
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
