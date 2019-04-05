<?
$args = array(
    'taxonomy' => ST_Masters::CATEGORY_TAXONOMY_SLUG,
    'parent'   => 26,
    'orderby'  => 'name',
    'order'    => 'ASC'
);

$categories = get_categories($args);
?>
<!-- <a class="btn" data-popup-open="popup-1" href="#">Open Popup #1</a> -->

<div class="popup popup-set-salon" data-popup="popup-1">
	<div class="popup-inner fancybox-form">
	    <h3>Для продолжения выберите салон</h3>
	    <p>
	    	<ul>
	    	<?
	    		foreach ($categories as $k => $v) 
				{
					$sel = '';
					if(isset($_SESSION['salon']) && $_SESSION['salon'] == $v->slug) 
						$sel = 'active-salon';
					?>
					<li><a href="#" class="<?=$sel?>" data-name="<?=$v->slug?>"><?=$v->name?></a></li>
					<?	
				}
	    	?>
	    	</ul>

	    </p>
	    <p><a class="popup-close-btn" data-popup-close="popup-1" href="#">Закрыть</a></p>
	    <a class="popup-close" data-popup-close="popup-1" href="#">x</a>
	</div>
</div>

<style>
.popup-set-salon ul{padding:10px;}
.popup-set-salon ul li a{display: block; padding: 10px; border: 1px solid #eee}
</style>