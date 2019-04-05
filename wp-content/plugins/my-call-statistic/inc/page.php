<?php
/**
 * Created by PhpStorm.
 * User: admin
 * Date: 24.10.2018
 * Time: 11:37
 */
require_once 'CallStatistic.php';

$salons = new CallStatistic();
$arr = $salons->getAllSalons();
?>

<p></p>

<div class="row-fluid">
    <div class="container-fluid content">
        <table class="table table-hover table-striped">

            <caption>Статистика звонков по салонам</caption>

            <tr align="center">
                <th>Салон</th>
                <th>Сегодня</th>
                <th>Вчера</th>
                <!--<th>Позавчера</th>-->
                <th>Последняя неделя</th>
                <th>Последний месяц</th>
                <th>Последний год</th>
            </tr>

            <?php
            foreach( $arr as $salon ){
                ?>
                <tr align="center">
                    <td align="left"><?=$salon->post_title?></td>
                    <td><?=$salons->getStatistic($salon->post_name, $interval = 0)?></td>
                    <td><?=$salons->getStatistic($salon->post_name, $interval = 1)?></td>
                    <!--<td><?/*=$salons->getStatistic($salon->post_name, $interval = 2)*/?></td>-->
                    <td><?=$salons->getStatistic($salon->post_name, $interval = 7)?></td>
                    <td><?=$salons->getStatistic($salon->post_name, $interval = 30)?></td>
                    <td><?=$salons->getStatistic($salon->post_name, $interval = 365)?></td>
                </tr>
                <?php
            }
            ?>
        </table>

        <div class="update-nag">Статистика собирается по кликам на кнопку номера телефона салона на странице <a href="/contacts/">"Контакты"</a></div>
    </div>
</div>

<link rel="stylesheet" href="<?=get_template_directory_uri().'/plugin/bootstrap/css/bootstrap.css'?>">
<script src="<?=get_template_directory_uri().'/plugin/bootstrap/js/bootstrap.js'?>"></script>

<style>
    th{text-align: center}
    caption{
        font-weight: bold;}
</style>
