<?php

 $args = array(
    'taxonomy' => ST_Masters::CATEGORY_TAXONOMY_SLUG,
    'parent'   => 25,
    'orderby'  => 'name',
    'order'    => 'ASC',
    'exclude'  => array(424, 425) // исключим из выборки Администраторов и Директоров
);

$categories = get_categories($args);

?>
<select id="select-spec" name="spec">
	<option value="all">Выберите специальность</option>
	<option value="all">Все специальности</option>
<?php

foreach ($categories as $k => $v) 
{
	$sel = '';
	if(isset($_SESSION['spec']) && $_SESSION['spec'] == $v->slug) $sel = 'selected';
	?><option value="<?=$v->slug?>" <?=$sel?>><?=$v->name?></option><?
}

?>
</select>



<?php

//printArray($categories);

?>