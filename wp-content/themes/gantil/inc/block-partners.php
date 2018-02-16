<?
$arg = array( 
	'category_name' 	=> 'partners' , 
	'post_type'   		=> 'post', 
	'orderby' 			=> 'menu_order', 
	'order' 			=> 'ASC',
	'numberposts'		=> -1
);

$arr1 = get_posts($arg);
//printArray($arr1);
$arr = array();

foreach($arr1 as $k => $v)
{
	$arr[] = array(
		'name' 	=> $v -> post_title,
		'img'	=> get_the_post_thumbnail( $v -> ID, 'partners_thumb', array('class' => 'sertif-item-img') )
	);
}


?>



<div class="container-fluid partners ">

	<div class="row-fluid">

			<div class="partners-banner"><?php echo wp_get_attachment_image( 1064, 'subscr_thumb'); ?><!-- <img src="/wp-content/uploads/2017/08/banner.jpg"> --></div>		
			

			<div class="slider-partners col-md-8 col-sm-8 col-xs-12 col-md-offset-2 col-sm-offset-2">

				<?
				foreach($arr as $k => $v)
				{
					?>
					<div class="partners-item">
						<!-- <a href="#"><?=$v['img']?></a> -->	
						<?=$v['img']?>				
					</div>
					<?
				}
				?>

				<!-- <div class="partners-item">
					<a href="#"><img class="sertif-item-img" src="/wp-content/uploads/2017/08/p1.jpg"></a>					
				</div>
				
				<div class="partners-item">
					<a href="#"><img class="sertif-item-img" src="/wp-content/uploads/2017/08/p2.jpg"></a>					
				</div>
				
				<div class="partners-item">
					<a href="#"><img class="sertif-item-img" src="/wp-content/uploads/2017/08/p3.jpg"></a>					
				</div>
				
				<div class="partners-item">
					<a href="#"><img class="sertif-item-img" src="/wp-content/uploads/2017/08/p4.jpg"></a>					
				</div>
				
				<div class="partners-item">
					<a href="#"><img class="sertif-item-img" src="/wp-content/uploads/2017/08/p2.jpg"></a>					
				</div>				 -->
			</div>			
		
	</div>
	<!-- /content -->
</div>

<script type="text/javascript">
	$(document).ready(function(){
	  $('.slider-partners').show().slick({
        dots: false,
        infinite: false,				        
        slidesToShow: 4,
        slidesToScroll: 4,
        arrows: false
        
      });
	});</script>