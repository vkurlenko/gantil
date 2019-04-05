<?php
//printArray($_COOKIE);

if(!isset($_COOKIE['agree'])):
?>

<div id="warning" class="warning-block">
    <div class="alert alert-warning alert-dismissible" role="alert">
        <button type="button" class="close agree" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <strong>Внимание!</strong> Продолжая использовать наш сайт, вы даете согласие на обработку файлов cookie, которые обеспечивают правильную работу сайта.
        <button type="button" class="btn btn-default agree">Продолжить</button>
    </div>
</div>

<?php
endif;
