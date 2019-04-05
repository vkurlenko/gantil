<?php
/**
 * Created by PhpStorm.
 * User: admin
 * Date: 21.10.2018
 * Time: 19:20
 */

require_once 'CallStatistic.php';

add_action('wp_ajax_callstatistic', 'callstatistic');
add_action('wp_ajax_nopriv_callstatistic', 'callstatistic');
//add_action('wp_ajax_nopriv_hello', 'say_hello');
add_action('admin_menu', 'create_statistic_menu');


function callstatistic(){

    $event = new CallStatistic();

    $event->setRecord();

    $event->sendMail();

    return true;
}

function create_statistic_menu(){
    add_menu_page('Статистика звонков со страницы контактов', 'Статистика звонков', 'manage_options', 'my-call-statistic/inc/page.php');
}
