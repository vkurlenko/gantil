<!-- social-button -->
<div id="social-block">
	
	<div id="vk_like" class="social-button"></div>
	<script type="text/javascript">								

		VK.Widgets.Like("vk_like", 
			{
				type: "button", 
				height: 20, 
				pageTitle: '<?php the_title();?>', 
				pageDescription: '',
				pageImage: '<? the_post_thumbnail_url(); ?>'				
			}, 
			<?=$post->ID?>);
	</script>

	<a href="https://twitter.com/share" class="twitter-share-button social-button" data-lang="en">Tweet</a>
	<script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0];if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src="https://platform.twitter.com/widgets.js";fjs.parentNode.insertBefore(js,fjs);}}(document,"script","twitter-wjs");</script>
	
	<div class="fb-like social social-button" style="" data-href="<? the_permalink() ?>" data-width="450" data-layout="button_count" data-show-faces="false" data-send="false"></div>		
	<div style="clear:both"></div>
</div>
<!-- /social-button -->
