<?php if(preg_match('#' . basename(__FILE__) . '#', $_SERVER['PHP_SELF'])) { die(_e('You are not allowed to call this page directly.','final-tiles-gallery')); } ?>

<style>
#support-page .main-pic {
    width: 100%;
    margin-bottom:20px;
}
#support-page iframe {
    width: 100%;
    margin-top:20px;
}
</style>

<div class="container">        
    <div class="row">
	    <div class="section s12 m12 l12 col" id="support-page">
            <h4 class="center-on-small-only">Other galleries:</h4>
            <h1 class="header center-on-small-only">PhotoBlocks</h1>	    
			<a href="https://wordpress.org/plugins/photoblocks-grid-gallery/"><img src="<?php echo plugins_url('images', __FILE__) ?>/photoblocks.png" alt="PhotoBlocks preview" class="main-pic"></a>
            <p>PhotoBlocks Grid Builder is the stellar feature that makes PhotoBlocks special and different from other galleries.
With this tool you can design the layout of your gallery simply by dragging the images. You can make a gallery
with images spanning on more columns or rows.</p>
            <iframe width="100%" height="380px" src="https://www.youtube-nocookie.com/embed/x3zfTDwoQc4?rel=0&amp;controls=0&amp;showinfo=0&autoplay=1&loop=1&playlist=x3zfTDwoQc4&modestbranding=1" frameborder="0" allow="autoplay; encrypted-media" allowfullscreen></iframe>

            <p>
            <a class="button" href="https://wordpress.org/plugins/photoblocks-grid-gallery/" aria-label="Download PhotoBlocks – Image Photo Grid Gallery 1.0.1" >Download</a>
            </p>
	    </div>
	</div>
</div>
