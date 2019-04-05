<?php
/**
 * Created by PhpStorm.
 * User: admin
 * Date: 21.01.2019
 * Time: 20:50
 */
require_once 'Referal.php';

//$wpdb->update( 'gn_referal', array('count' => 555), array('id' => 10) );

$referal = new Referal();

if($_GET['del']){
    if($referal->deleteReferal($_GET['del'])){
        header('Location: ?page=my-referal/page.php');
        exit;
    }
}

/*if($_GET['inccount']){
    if($referal->incCount($_POST['id'])){
        //header('Location: ?page=my-referal/page.php');
        exit;
    }
}*/
?>

<script src="https://code.jquery.com/jquery.min.js"></script>
<script src="/wp-content/themes/gantil/js/mask.js"></script>
<script src="/wp-content/plugins/my-referal/js/script.js"></script>
<div class="row-fluid">
    <div class="container-fluid content">
        <h1>Реферальные ссылки</h1>

        <?php
        $referal->renderForm();

        echo $referal->printReferals();
        ?>
    </div>
</div>

<style>
    .referal-form{
        padding:10px;
        margin:20px 0;
        border: 1px solid #ccc;
        border-left: 4px solid #00a0d2;
        box-shadow: 0 1px 1px 0 rgba(0,0,0,.1);
    }
</style>