<?php
/*
Plugin Name: Popup промо-баннер
Plugin URI:
Description:
Version: 1.0
Author: Курленко В.В.
Author URI:
*/

/**
 * скрипт таймера
 */
require_once('BFI_Thumb.php');

/**
 * Промо-баннер popup
 *
 * компоненты задаются в записи с ID = $post_id (запись должна быть в категории "promo")
 * картинка - изображение к этой записи (размеры $img_width х $img_height)
 * текст над картинкой - контент записи
 * текст справа (над часами) - отрывок записи
 * дата таймера - дата в атрибутах записи (время отбрасывается)
 * форма - форма contact-form-7 с ID = $form_id
 */

class Promo
{
    public function renderBanner()
    {
        /*$post_id    = 20068;
        $form_id    = 20072;*/
        $post_id    = 27060;
        $form_id    = 27062;
        $img_width  = 650;
        $img_height = 500;

        $post = get_post( $post_id );

        $html = '';

        $params = array( 'width' => $img_width, 'height' => $img_height );
        $img = bfi_thumb( get_the_post_thumbnail_url( $post_id, 'full' ), $params );


        $html .= '
        <div class="promo-wrap">

            <div class="promo-left">
                <img class="promo-img" src="'.$img.'" alt=""  />
            </div>
            
            <div class="promo-content promo-content-mobi">'.$post->post_content.'</div>

            <div class="promo-right">
                <p class="promo-descr">'.$post->post_excerpt.'</p>                
                
                <div id="clock" data-date="'.self::getDate($post->post_date).'"></div>
                
                <div class="promo-form">'.do_shortcode('[contact-form-7 id="'.$form_id.'" title="Запись по акции"]').'</div>
            </div>
            
            <div style="clear:both;"></div>
            
            <div class="promo-content promo-content-pc">'.$post->post_content.'</div>

        </div>';

        return $html;
    }

    /**
     * преобразование даты вида
     * 2018-12-02 23:15
     *
     * в вид
     * 2018/12/02
     **/
    public static function getDate( $date = null )
    {
        if( $date ){
            $arr = explode(' ', $date );
            if( !empty( $arr ) ){
                $d = str_replace('-', '/', $arr[0]);
                return $d;
            }
        }
    }
}