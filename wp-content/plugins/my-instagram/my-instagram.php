<?php
/*
Plugin Name: Лента Инстаграм gantil_official
Plugin URI:
Description: вывод ленты Инстаграм
Version: 1.0
Author: Курленко В.В.
Author URI:
*/

require $_SERVER['DOCUMENT_ROOT'].'/wp-content/themes/gantil/controllers/instagramController.php';

add_action('wp_ajax_my_instagram', 'my_instagram');
add_action('wp_ajax_nopriv_my_instagram', 'my_instagram');

add_shortcode('my_instagram', 'my_instagram');

function my_instagram()
{
    $insta = new instagramController();

    $arr = $insta->getPosts();

    if (!empty($arr['data'])) {

        //printArray($arr['data']);

        foreach($arr['data'] as $row) {
            ?>

            <div class="insta-post">
                <?=$insta->getPost($row); ?>
                <div class="insta-post-info">
                    <?=$insta->getPostInfo($row); ?>
                </div>
                <?=$insta->getPostMedia($row)?>
            </div>

            <?php
        }
    }
    echo '<div style="clear:both"></div>';

    wp_enqueue_script('mousewheel', '/wp-content/plugins/easy-fancybox/js/jquery.mousewheel.min.js');
}