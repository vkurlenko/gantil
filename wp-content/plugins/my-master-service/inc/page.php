
<link rel="stylesheet" href="/wp-content/plugins/my-master-service/lib/css/style.css">

<script src="https://code.jquery.com/jquery.min.js"></script>
<script src="/wp-content/plugins/my-master-service/lib/js/script.js"></script>
<?php
require_once 'masterServiceController.php';

function makeProductsList($arr, $arr_ms){

    $list = '<ul class="child">';

    foreach($arr as $product){

        if(in_array($product['ID'], $arr_ms))
            $ch = 'checked';
        else
            $ch = '';

        $list .= '<li><label><input type="checkbox" name="'.$product['ID'].'" '.$ch.'  id="'.$product['ID'].'">'.$product['post_title'].'</label></li>';
    }

    $list .= '</ul>';

    return $list;
}

function plugin(){

    $master = new masterServiceController();
    $arr_ms = [];

    // список мастеров
    if(!$_GET['master_id']){
        $a = $master->getMasters();

        $list = '<ul>';
        foreach($a as $master){
            $list .= '<li><a href="?page=my-master-service/inc/page.php&master_id='.$master->ID.'">'.$master->post_title.'</a></li>';
        }
        $list .= '</ul>';

        echo $list;
    }
    else{

        if(!empty($_POST)){
            $arr = [];
            foreach($_POST as $id => $v){
                $arr[] = $id;
            }

            $str = serialize($arr);

            $master->setMasterServices($_GET['master_id'], $str);
        }

        $master_info = $master->getMaster($_GET['master_id']);

        $master_service = $master->getMasterServices($_GET['master_id']);

        if($master_service){
            $arr_ms = unserialize($master_service['service_arr']);
            //printArray($arr_ms);
        }

        // дерево услуг
        $tree = $master->getCatTree(79);

        $list = '<h1>'.$master_info->post_title.'</h1>
                <div id="view-all"><a href="#">развернуть/свернуть все услуги</a></div>
                <div id="form-master-service">
                    <form method="post" action="">';

        foreach($tree as $node1){
            $list .= '<ul class="parent parent1"><li class="header"><span>'.$node1['name'].'</span>';
            if($node1['is_products']){
                $list .= makeProductsList($node1['arr_child'], $arr_ms);
            }
            else{
                foreach($node1['arr_child'] as $node2){
                    $list .= '<ul class="parent parent2"><li class="header"><span>'.$node2['name'].'</span>';
                    if($node2['is_products']){
                        $list .= makeProductsList($node2['arr_child'], $arr_ms);
                    }
                    else{
                        foreach($node2['arr_child'] as $node3){
                            $list .= '<ul class="parent parent3"><li class="header"><span>'.$node3['name'].'</span>';
                            if($node3['is_products']){
                                $list .= makeProductsList($node3['arr_child'], $arr_ms);
                            }
                            else{
                                foreach($node3['arr_child'] as $node4){
                                    $list .= '<ul class="parent parent4"><li class="header"><span>'.$node4['name'].'</span>';
                                    if($node4['is_products']){
                                        $list .= makeProductsList($node4['arr_child'], $arr_ms);
                                    }
                                    $list .= '</li></ul>';
                                }
                            }
                            $list .= '</li></ul>';
                        }
                    }
                    $list .= '</li></ul>';
                }
            }
            $list .= '</li></ul>';
        }
        $list .= '<input type="submit" value="Сохранить"></form></div>';

        echo $list;

        //printArray($tree);
    }

    //wp_die();
}

?>


<?php
plugin();
?>