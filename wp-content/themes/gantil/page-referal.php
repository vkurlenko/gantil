<?php
/*
Template Name: Заказ звонка по реферальной ссылке
*/

require_once $_SERVER['DOCUMENT_ROOT'].'/wp-content/plugins/my-referal/Referal.php';

get_header();
?>


    <!-- content -->
<?php
$post = get_post();

//print_r($post);?>
    <div class="row-fluid">
        <div class="container-fluid content">


            <!-- breadcrumbs -->
            <?php if( function_exists('kama_breadcrumbs') ) kama_breadcrumbs(' > '); ?>
            <!-- /breadcrumbs -->

            <div class="content-article">

                <?php if ( have_posts() ) :  while ( have_posts() ) : the_post(); ?>

                    <h1><?php the_title();?></h1>


                    <!-- submenu -->
                    <ul class="submenu">
                        <?php
                        $arr_menu = wp_list_pages(
                            array(
                                'title_li' => '',
                                'child_of' => $post->ID,
                                'depth' => 1,
                                'echo' => false
                            )
                        );

                        echo $arr_menu;

                        ?>
                    </ul>

                    <div style="clear:both"></div>
                    <!-- /submenu -->

                    <div>
                        <?php
                        //printArray($_GET);

                        // если есть код приглашения, то проверим его в БД и покажем форму записи
                        if($_GET['code']){
                            $referal = new Referal();

                            $row = $referal->checkCode($_GET['code']);
    //printArray($row);
                            if($row){
                                ?>
                                <div class="col-md-6">
                                    <?php
                                    // форма записи
                                    echo do_shortcode('[contact-form-7 id="27704" title="Заказ звонка по реферальной ссылке"]');
                                    ?>
                                </div>
                                <div class="col-md-6">
                                    <?php
                                    the_content();
                                    ?>
                                </div>
                                
                                <script type="text/javascript">
                                    var id  = '<?=$row[0]->id?>';
                                    var name = '<?=$row[0]->name?>';
                                    var surn = '<?=$row[0]->surn?>';
                                    var phone = '<?=$row[0]->phone?>';
                                    var email = '<?=$row[0]->email?>';
                                    var salon = '<?=$row[0]->salon?>';
                                    var code = '<?=$row[0]->code?>';

                                    $(document).ready(function(){
                                        // подставим в скрытое поле формы имя дарителя
                                        $('#referer-name').attr('value', name);
                                        $('#referer-surn').attr('value', surn);
                                        $('#referer-phone').attr('value', phone);
                                        $('#referer-email').attr('value', email);
                                        $('#referer-salon').attr('value', salon);

                                        // заблокируем выбор других салонов, кроме салона-дарителя
                                        $('#wpcf7-f27704-p27705-o1 .cf7-select-salon-call option').each(function(){
                                            if($(this).val() != salon)
                                                $(this).remove();
                                            else
                                                $(this).attr('selected', true);
                                        })

                                        // по клику на ОТПРАВИТЬ увеличим счетчик + 1
                                        $('#send').click(function(){
                                           
                                            var data = {
                                                action : 'counter1',
                                                id : id                                             
                                            };

                                            jQuery.post( '/wp-admin/admin-ajax.php', data, function(response) {
                                                console.log('Получено с сервера: ' + response);
                                            }); 
                                        });
                                    })
                                </script>
                                <?php
                            }
                                
                            else
                                echo 'Нет действительного кода приглашения';
                        }
                        else
                            echo 'Нет действительного кода приглашения';
                        ?>


                    </div>

                <?php endwhile; ?>
                <?php endif; ?>

            </div>
        </div>
    </div>
    <!-- /content -->
    </div>
    <!-- /left-block -->

<?php
get_footer()
?>