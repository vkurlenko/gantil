<?php


$post = get_post();

if($post->post_name == 'price-service')
	$is_price = true;
//printArray($post);

 $args = array(
    'taxonomy' => ST_Masters::CATEGORY_TAXONOMY_SLUG,
    'parent'   => 26,
    'orderby'  => 'name',
    'order'    => 'ASC'
);

$categories = get_categories($args);

?>
<select id="select-salon" name="salon">
	<option value="all">Выберите салон</option>
	<?
	if(!$is_price) : 
	?>
	<option value="all">Все салоны</option>
	<?
	endif
	?>
<?php

foreach ($categories as $k => $v) 
{
	$sel = '';
	if(isset($_SESSION['salon']) && $_SESSION['salon'] == $v->slug) 
		$sel = 'selected';
	?>
	<option value="<?=$v->slug?>" <?=$sel?>><?=$v->name?></option>
	<?	
}

?>
</select>
<?php

//printArray($categories);

?>