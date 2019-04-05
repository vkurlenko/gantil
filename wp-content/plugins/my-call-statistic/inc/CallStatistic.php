<?php
/**
 * Created by PhpStorm.
 * User: admin
 * Date: 22.10.2018
 * Time: 10:04
 */

class CallStatistic
{
    /**
     * запись в БД информации о звонке в салон
     */
    public function setRecord()
    {
        global $wpdb;
        date_default_timezone_set('Etc/GMT-3');

        $res = false;

        if(!empty($_POST)){
            $res = $wpdb->insert(
                'gn_call_statistic',
                array( 'salon' => $_POST['salon'], 'referrer' => $_POST['referrer'], 'date' => date('Y-m-d H:i:s') ),
                array( '%s', '%s', '%s' )
            );
        }

        return $res;
    }

    /**
     * отправка на почту информации о звонке в салон
     */
    public function sendMail()
    {
        $mail_to = get_option('g_options')['email_admin'];

        $subject = 'Поступил звонок в '.$this->getName($_POST['salon']);

        $body = '<h3>Поступил звонок в '.$this->getName($_POST['salon']).'</h3>';
        $body .= '<p>Время: '.date('Y-m-d H:i:s').'</p>';
        $body .= '<p>Адрес ссылающейся страницы: '.$_POST['referrer'].'</p>';
        $body .= '
        <table>
            <tr>
                <th colspan="2">Всего звонков в этот салон</th>
            </tr>
            <tr>
                <td>за сегодня ('.date('d-m-Y').')</td><td>'.$this->getStatistic($_POST['salon'], 0).'</td>
            </tr>
            <tr>
                <td>за вчера</td><td>'.$this->getStatistic($_POST['salon'], 1).'</td>
            </tr><tr>
                <td>за последние 7 дней</td><td>'.$this->getStatistic($_POST['salon'], 7).'</td>
            </tr><tr>
                <td>за последние 30 дней</td><td>'.$this->getStatistic($_POST['salon'], 30).'</td>
            </tr>
        </table>';

        $headers = array(
            'From: Статистика gantil.ru <gantilinfo@yandex.ru>',
            'content-type: text/html'
        );

        wp_mail( $mail_to, $subject, $body, $headers );
    }

    /**
     * определим имя салона по его slug
     */
    public function getName($salon_name)
    {
        $salon_title = 'Салон не определен';

        $args = array(
            'sort_order'   => 'ASC',
            'sort_column'  => 'menu_order',
            'hierarchical' => 0,
            'exclude'      => '',
            'include'      => '',
            'meta_key'     => '',
            'meta_value'   => '',
            'authors'      => '',
            'child_of'     => 117,
            'parent'       => -1,
            'exclude_tree' => '',
            'number'       => '',
            'offset'       => 0,
            'post_type'    => 'page',
            'post_status'  => 'publish',
        );
        $pages = get_pages( $args );

        foreach( $pages as $salon ){
            if( $salon->post_name == $salon_name ){
                $salon_title = $salon->post_title;
                break;
            }
        }

        return $salon_title;
    }

    /**
     * получим все саслоны
     */
    public function getAllSalons()
    {

        $args = array(
            'sort_order'   => 'ASC',
            'sort_column'  => 'menu_order',
            'hierarchical' => 0,
            'exclude'      => '',
            'include'      => '',
            'meta_key'     => '',
            'meta_value'   => '',
            'authors'      => '',
            'child_of'     => 117,
            'parent'       => -1,
            'exclude_tree' => '',
            'number'       => '',
            'offset'       => 0,
            'post_type'    => 'page',
            'post_status'  => 'publish',
        );
        $pages = get_pages( $args );

        return $pages;
    }

    /**
     *   получим статистику звонков за $interval дней (0 - сегодня)
     */
    public function getStatistic($salon_name, $interval = 0)
    {
        global $wpdb;

        // для запроса "вчера" $interval = 1
        $interval === 1 ? $operator = '=' :  $operator = '<=';

        $query = "SELECT COUNT(*) FROM gn_call_statistic
              WHERE salon = '".$salon_name."'
              AND TO_DAYS(NOW()) - TO_DAYS(date) $operator ".$interval;

        $count = $wpdb->get_var($wpdb->prepare($query, 'foo'));

        return $count;

    }
}