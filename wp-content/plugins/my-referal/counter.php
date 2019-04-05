<?php
/**
 * Created by PhpStorm.
 * User: admin
 * Date: 26.01.2019
 * Time: 12:50
 */

require_once $_SERVER['DOCUMENT_ROOT'].'/wp-content/plugins/my-referal/Referal.php';

$query = "SELECT * FROM `gn_referal` WHERE 1";
$res = $wpdb->get_results( $query );
printArray($res);
/*
global $wpdb;
//printArray($_POST);
$wpdb->update( 'gn_referal', array('count' => 555), array('id' => 11) );
//if($_POST['id']){
if($_GET['id']){
    echo $referal->incCount($_GET['id']);
}*/