<a class="go-to-top" href="#top" style="display: block;">
    <span class="icon-bg"></span>
    <span class="back-to-top-text">Top</span>
    <i class="fa fa-angle-up back-to-top-icon"></i>
</a>

<?php get_template_part('inc/warning');?>

<footer class="footer">
<!--<div class="container-fluid  footer">-->

    <div class="row">
        <div class="col-md-6">
            
            <?php
            $args = array(
                'theme_location'  => 'bottom',
                'menu'            => '',
                'container'       => 'div',
                'container_class' => 'footer-menu',
                'container_id'    => '',
                'menu_class'      => '',
                'menu_id'         => '',
                'echo'            => true,
                'fallback_cb'     => 'wp_page_menu',
                'before'          => '',
                'after'           => '',
                'link_before'     => '',
                'link_after'      => '',
                'items_wrap'      => '<ul id="%1$s" class="%2$s">%3$s</ul>',
                'depth'           => 0,
                'walker'          => ''
            );
            wp_nav_menu( $args );
            ?>

            <?php
            /*<!-- 
            
            <li class="fancybox-inline"> <a onclick="return false;" class=" " data-salon="" href="#contact_form_pop_up_3">Выбрать салон</a></li>
            <div class="footer-search">
                <form class="navbar-form navbar-left" role="search">
                  <div class="form-group input-group add-on">
            
                  <input type="text" class="form-control" class="search-query" placeholder="поиск">
                  <div class="input-group-btn">
                      <button class="btn btn-default" type="submit"><i class="glyphicon glyphicon-search"></i></button>
                    </div>
                </div>
                </form>
            </div> -->
            */
            ?>
        </div>

        <!--<div class="col-md-4 button-promo" style="text-align: center">
            <button><?/*=do_shortcode('[spu popup="27018"]PROMO[/spu]');*/?></button>
        </div>-->

        <div class="col-md-6">
            <div class="footer-social">
                <ul>
                    <li><a target="_blank" href="<?=get_option('g_options')['social_ok']?>">
				<span class="fa-stack fa-lg">
				  <i class="fa fa-circle fa-stack-2x"></i>
				  <i class="fa fa-odnoklassniki fa-stack-1x fa-inverse"></i>
				</span></a>
                    </li>
                    <li><a target="_blank" href="<?=get_option('g_options')['social_vk']?>">
				<span class="fa-stack fa-lg">
				  <i class="fa fa-circle fa-stack-2x"></i>
				  <i class="fa fa-vk fa-stack-1x fa-inverse"></i>
				</span></a>
                    </li>
                    <li><a target="_blank" href="<?=get_option('g_options')['social_tw']?>">
				<span class="fa-stack fa-lg">
				  <i class="fa fa-circle fa-stack-2x"></i>
				  <i class="fa fa-twitter fa-stack-1x fa-inverse"></i>
				</span></a>
                    </li>
                    <li><a target="_blank" href="<?=get_option('g_options')['social_fb']?>">
				<span class="fa-stack fa-lg">
				  <i class="fa fa-circle fa-stack-2x"></i>
				  <i class="fa fa-facebook fa-stack-1x fa-inverse"></i>
				</span></a>
                    </li>
                    <li><a target="_blank" href="<?=get_option('g_options')['social_yt']?>">
				<span class="fa-stack fa-lg">
				  <i class="fa fa-circle fa-stack-2x"></i>
				  <i class="fa fa-youtube fa-stack-1x fa-inverse"></i>
				</span></a>
                    </li>
                    <li><a target="_blank" href="<?=get_option('g_options')['social_in']?>">
				<span class="fa-stack fa-lg">
				  <i class="fa fa-circle fa-stack-2x"></i>
				  <i class="fa fa-instagram fa-stack-1x fa-inverse"></i>
				</span></a>
                    </li>
                </ul>

            </div>

            <div style="clear:both"></div>

        </div>

    </div>
<!--</div>-->
</footer>

<!-- <div id="label" class="button-promo">
    <?=do_shortcode('[spu popup="27018"]PROMO[/spu]');?>
</div> -->



<?php if (!function_exists('dynamic_sidebar') || !dynamic_sidebar('widget_call') ) : ?>
<?php endif; ?>

						