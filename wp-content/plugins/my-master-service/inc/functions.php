<?php
add_action('admin_menu', 'create_master_service_menu');

function create_master_service_menu(){
    add_menu_page('Услуги мастеров', 'Услуги мастеров', 'manage_options', 'my-master-service/inc/page.php');
}