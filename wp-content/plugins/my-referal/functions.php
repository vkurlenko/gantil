<?php
/**
 * Created by PhpStorm.
 * User: admin
 * Date: 21.01.2019
 * Time: 20:47
 */

require_once 'Referal.php';

add_action('admin_menu', 'getReferals');

add_action('wp_ajax_counter1', 'counter1');
add_action('wp_ajax_nopriv_counter1', 'counter1');

function getReferals(){
    add_menu_page('Реферальные ссылки', 'Реферальные ссылки', 'manage_options', 'my-referal/page.php');
}

function counter1()
{
    $referal = new Referal();
    echo $referal->incCount($_POST['id']);
    wp_die();
}

