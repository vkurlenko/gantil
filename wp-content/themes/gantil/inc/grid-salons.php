<?php
$post = get_post();
$post_name = $post->post_name;

$is_price = false;
if(@$post_name && $post_name == 'price')
	$is_price = true;
?>

<style type="text/css">
	.grid-salons .salons-item-img{/* display: none; */}
    .salon-since{
        display: block;
        position: absolute;
        top: 0;
        left: 0;
        padding: 2px 5px;
        color: #fff;
        background: #666;
        /*font-style: italic;
        font-weight: bold;*/
    }
</style>

<div class="container-fluid grid-salons">

	<h2 class="frontpage-h2">Наши салоны</h2>

	<!-- a = <div id="a"></div>
	slick = <div id="slick"></div> -->

	<div class="row-fluid grid-salons-slider grid-salons-slick">

		<?
		$args = array(
			'sort_order'   => 'ASC',
			'sort_column'  => 'menu_order',
			'hierarchical' => 0,
			'exclude'      => '',
			'include'      => '',
			'meta_key'     => '',
			'meta_value'   => '',
			'authors'      => '',
			/*'child_of'     => 117,
			'parent'       => -1,*/
            'child_of'     => 0,
            'parent'       => 117,
			'exclude_tree' => '',
			'number'       => '',
			'offset'       => 0,
			'post_type'    => 'page',
			'post_status'  => 'publish',
		); 
		$pages = get_pages( $args );
		//shuffle($pages);
        //printArray($pages);

		foreach( $pages as $post )
		{
			setup_postdata( $post );

			$meta = get_metadata( 'post', $post->ID, 'salon_address', true);
			$salon_address_short = get_metadata( 'post', $post->ID, 'salon_address_short', true);
			
			$arr_replace = array(
				'salon_leninsky' => 'На Ленинском',
				'salon_kolom' 	=> 'На Коломенской',
				'salon_bratis' => 'На Братиславской',
				'salon_sokol' => 'На Соколе',
				'salon_shodnya' => 'На Сходненской',
				'salon_dom_krasoty' => 'На м.Аэропорт'
				);

			$arr_replace_2 = array(
				'salon_leninsky' => 'Жантиль на Ленинском',
				'salon_kolom' 	=> 'Жантиль на Коломенской',
				'salon_bratis' => 'Жантиль на Братиславской',
				'salon_sokol' => 'Жантиль на Соколе',
				'salon_shodnya' => 'Жантиль на Сходненской',
				'salon_dom_krasoty' => 'Жантиль м.Аэропорт'
				);

            $arr_since = array(
                'salon_leninsky' => 2008,
                'salon_kolom' 	=> 2004,
                'salon_bratis' => 2005,
                'salon_sokol' => 2006,
                'salon_shodnya' => 2002,
                'salon_dom_krasoty' => 2015
            );

			// формат вывода
			?>
			<div class="col-md-4 col-sm-6 col-xs-6 salons-item ">
				<?
				$is_price ? $link = "/price/price-service/?salon=".$post->post_name : $link = get_page_link( $post->ID );
				?>
				<a href="<?php echo $link ?>">
					<?php //echo the_post_thumbnail('salon_thumb', array('class' => 'salons-item-img')) ?>

					<?
					$thumb_id = get_post_thumbnail_id();
					$thumb_url = wp_get_attachment_image_src($thumb_id,'salon_thumb', true);
					?>
					<!--<img class="salons-item-img img-mono" src="<?/*=makeGrayPic($thumb_url[0])*/?>" data-imgcolor="<?/*=$thumb_url[0]*/?>">-->
                    <img class="salons-item-img <?=wp_is_mobile() ? '' : 'img-mono';?>" src="<?=makeGrayPic($thumb_url[0])?>" alt="<?php the_title(); ?>" data-imgcolor="<?=wp_is_mobile() ? '' : $thumb_url[0];?>">

                    <!-- <img class="salons-item-img img-color" src="<?=$thumb_url[0]?>"> -->

	                <span class="salon-since">Since <? echo $arr_since[$post->post_name];?></span>
					
					<div class="salons-item-name grid-block-button"><? echo $arr_replace[$post->post_name];?>					
						<div class="salons-address"><?=$salon_address_short?></div>
					</div>	
					
				</a>
				


				<ul class="box-menu">
				
				<?
				if($is_price)
				{
					?>
					<li class="box-menu-left "><a class="" href="/price/price-service/?salon=<? echo $post->post_name;?>">Услуги</a></li>
					<li class="box-menu-right "><a class="" href="/price/price-butik/">Бутик</a></li>
					<?
				}
				else
				{
					?>
					<li class="box-menu-left "><a class="" href="<?php echo get_page_link( $post->ID ); ?>">Подробнее</a></li>
					<li class="box-menu-right fancybox-inline "><a onclick="return false;" class="order-to-salon " data-salon="<? echo $arr_replace_2[$post->post_name]; //$post->post_title;?>" href="#contact_form_pop_up">Записаться</a></li>
					
					<?php 
					/*if(user_admin())
					{
						?><li class="box-menu-right fancybox-inline "><a onclick="return false;" class="order-to-salon " data-salon="" href="#contact_form_pop_up_4">Звонок</a></li>
						<?php
					}*/
					?>
					<?
				}
				?>
				
					<div style="clear:both"></div>
				</ul>


				
			</div>	
			<?

			
		}  
		wp_reset_postdata();

		//printArray($pages);
		?> 
		
	</div>
</div>
