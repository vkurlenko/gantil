<ul class="menu-widget"> 
<?php

global $post;
$args = array( 'posts_per_page' => 0, 'offset'=> 0, 'category_name' => 'widgets' );
$myposts = get_posts( $args );
foreach( $myposts as $post )
{ 
	setup_postdata($post);
	$thumbnail = get_the_post_thumbnail( $post -> id, array(300, 0));
	$meta_values = get_post_custom( $post -> id,  'widget_link');
	//print_r($meta_values);
	?>
	<li>
		<span class="widget-title"><?php echo $post -> post_title;?></span>	
		<a class="widget-img" href="<?php echo $meta_values['widget_link'][0]?>">
				<!-- <img src="/wp-content/uploads/2017/05/334-236x115-mono-2.jpg" width=300> -->
				<?php echo $thumbnail?>
				<span class="widget-text"><?php echo $post -> post_content;?></span>
		</a>		
	</li>
	<?php
}
wp_reset_postdata();
?>


	<!-- <li>
		<span class="widget-title">Будь в курсе</span>	
		<a class="widget-img" href="#">
				<img src="/wp-content/uploads/2017/05/334-236x115-mono-2.jpg" width=300>
				<span class="widget-text">MERCEDES-BENZ FASHION WEEK RUSSIA</span>
		</a>	
										
	</li>

	<li>
		<span class="widget-title">НОВОСТИ</span>	
		<a class="widget-img" href="#">
				<img src="/wp-content/uploads/2017/05/334-236x115-mono-2.jpg" width=300>
				<span class="widget-text">ВЕСЕННЕЕ ПРЕОБРАЖЕНИЕ В ЖАНТИЛЬ</span>
		</a>	
										
	</li>

	<li>
		<span class="widget-title">АКЦИИ</span>	
		<a class="widget-img" href="#">
				<img src="/wp-content/uploads/2017/05/334-236x115-mono-2.jpg" width=300>
				<span class="widget-text">ДНИ КРАСОТЫ В ЖАНТИЛЬ НА БРАТИСЛАВСКОЙ</span>
		</a>											
	</li> -->
</ul>