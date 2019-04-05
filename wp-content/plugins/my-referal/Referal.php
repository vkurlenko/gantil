<?php
/**
 * Created by PhpStorm.
 * User: admin
 * Date: 21.01.2019
 * Time: 20:47
 */

class Referal
{
    public $active_interval = 30; // срок активноcти ссылки (дней)
    static $url         = 'https://gantil.ru/zakazat-zvonok-po-akcii-privedi-druga/'; // url формы заказа звонка по ссылке
    static $host        = "gate.iqsms.ru"; // SMS провайдер iqsms.ru
    static $port        = 80;
    static $login       = "z1525382048354"; // логин на сайте iqsms.ru
    static $password    = "159369"; // пароль на сайте iqsms.ru
    static $sender      = "Gantil"; // подпись для SMS
    static $wapurl      = "gantil.ru";

    // статусы отправленных SMS
    public $stat        = [
                            'delivered'     => ['Сообщение доставлено', '#00f7004a'],
                            'queued'        => ['Сообщение находится в очереди', '#ff980059'],
                            'delivery error'=> ['Ошибка доставки SMS (абонент в течение времени доставки находился вне зоны действия сети или номер абонента заблокирован)', '#ffc5c5'],
                            'smsc submit'   => ['Сообщение доставлено в SMSC', '#001fff38'],
                            'smsc reject'   => ['Сообщение отвергнуто SMSC (номер заблокирован или не существует)', '#ffc5c5'],
                            'incorrect id'  => ['Неверный идентификатор сообщения', '#ffc5c5']
                        ];

    // статусы результатов отправки SMS
    public $send_stat = [
                            'accepted'                  => ['Сообщение принято сервисом', '#00f7004a'],
                            'invalid mobile phone'      => ['Неверно задан номер тефона (формат 71234567890)', '#ffc5c5'],
                            'text is empty'             => ['Отсутствует текст', '#ffc5c5'],
                            'sender address invalid'    => ['Неверная (незарегистрированная) подпись отправителя', '#ffc5c5'],
                            'wapurl invalid'            => ['Неправильный формат wap-push ссылки', '#ffc5c5'],
                            'invalid schedule time format'     => ['Неверный формат даты отложенной отправки сообщения', '#ffc5c5'],
                            'invalid status queue name	'      => ['Неверное название очереди статусов сообщений', '#ffc5c5'],
                            'not enough credits'        => ['Баланс пуст (проверьте баланс)', '#ffc5c5']

                        ];

    /**
     * форма ввода данных клиента
     */
    public function printForm($arr = [])
    {
        printArray($arr);
        $salons = self::getSalons();
        $options = '<option value="">---</option>';
        if($salons){
            foreach($salons as $salon){
                $options .= '<option value="'.$salon->post_title.'">'.$salon->post_title.'</option>';
            }
        }

        $fields = ['r_name', 'r_surn', 'r_phone', 'r_email', 'r_salon'];

        foreach($fields as $field){
            $arr[$field] ? ${$field} = $arr[$field] : ${$field} = '';
        }

        $html = '
        <div class="referal-form">
            
            <h2>Новая ссылка</h2>
            
            <form method="post" action="">
                <label>Имя дарителя (обязательно)<br>
                <input name="r_name" type="text" value="' . $r_name . '"></label><br>
                
                <label>Фамилия (обязательно)<br>
                <input name="r_surn" type="text" value="' . $r_surn . '"></label><br>
                
                <label>Телефон (обязательно)<br>
                <input name="r_phone" id="r_phone" type="text" value="' . $r_phone . '"></label><br>
                
                <label>Email дарителя (обязательно)<br>
                <input name="r_email" type="text" value="' . $r_email . '"></label><br>
                
                <label>Салон (обязательно)<br>
                    <select name="r_salon">
                        '.$options.'
                    </select>                
                </label><br>
                
                <input type="submit" value="Сохранить">
            </form>
        </div>';

        return $html;
    }

    /**
     * форма создания реферальной ссылки
     */
    public function renderForm($post = [])
    {
        if($_POST){
            echo self::setReferal($_POST);
        }
        else
            echo self::printForm();
    }

    /***
     * массив салонов
     */
    public static function getSalons()
    {
        $arr = [];

        $args = array(
            'sort_order'   => 'ASC',
            'sort_column'  => 'menu_order',
            'hierarchical' => 0,
            'exclude'      => '',
            'include'      => '',
            'meta_key'     => '',
            'meta_value'   => '',
            'authors'      => '',
            'child_of'     => 0,
            'parent'       => 117,
            'exclude_tree' => '',
            'number'       => '',
            'offset'       => 0,
            'post_type'    => 'page',
            'post_status'  => 'publish',
        );

        $arr = get_pages( $args );

        return $arr;
    }


    /**
     * проверим ввод данных
     * @param null $post = $_POST
     * $data - массив данных для генерации реферальной ссылки
     * $validate_error - массив ошибок валидации
     * @return boolean
     */
    public function setReferal($post = null)
    {
        global $wpdb;

        $data = [
            'r_name' => '',
            'r_surn' => '',
            'r_phone' => '',
            'r_email' => '',
            'r_salon' => '',
            'code' => uniqid()
        ];

        $validate_error = [];

        if(is_array($post) && !empty($post)){

            foreach($post as $field => $value){

                switch($field){

                    case 'r_name' :
                        if(self::validate($value)){
                            $data['r_name'] = $value;
                        }
                        else
                            $validate_error[] = 'Ошибка ввода имени';

                        break;

                    case 'r_surn' :
                        if(self::validate($value)){
                            $data['r_surn'] = $value;
                        }
                        else
                            $validate_error[] = 'Ошибка ввода фамилии';

                        break;

                    case 'r_phone' :
                        if(self::validate($value)){
                            $data['r_phone'] = $value;
                        }
                        else
                            $validate_error[] = 'Ошибка ввода телефона';

                        break;

                    case 'r_email' :
                        if(self::validate($value, 'email')){
                            $data['r_email'] = $value;
                        }
                        else
                            $validate_error[] = 'Ошибка ввода email';
                        break;

                    case 'r_salon' :
                        if(self::validate($value)){
                            $data['r_salon'] = $value;
                        }
                        else
                            $validate_error[] = 'Ошибка ввода салона';

                        break;

                    default: break;
                }
            }

            // если форма не прошла валидацию
            if(!empty($validate_error)){

                echo '<div class="error" style="color:red">';
                //printArray($validate_error);

                foreach($validate_error as $error){
                    echo '<p>'.$error.'</p>';
                }

                echo '</div>';

                return self::printForm($post);
            }

            // если форма прошла валидацию
            else{
                if( self::setRecord($data) ){
                    echo '<div class="updated">Ссылка сохранена в БД</div>';

                    if( self::sendReferal($data, $data['r_email']) )
                        echo '<div class="updated">Ссылка отправлена на email '.$data['r_email'].'</div>';

                    /* SMS */
                    $sms = self::sendSms($data);

                    $wpdb->update(
                        'gn_referal',
                        ['sms_res' => $sms],
                        ['code' => $data['code']]
                    );

                    $a_sms = explode('=', $sms);

                    if(is_array($a_sms) && count($a_sms) == 2){
                        if($a_sms[1] == 'accepted'){
                            echo '<div class="updated">SMS со ссылкой отправлена на '.$data['r_phone'].' ('.$sms.')</div>';
                            self::setSmsId($sms, $data);
                        }
                        else{
                            echo $sms;
                        }
                    }
                    else{
                        echo $sms;
                    }
                    /* /SMS */

                }
                else
                    echo '<div class="error">Ошибка сохранения ссылки в БД</div>';

                return self::printForm();
            }
        }
        else{
            return self::printForm();
        }
    }


    /**
     * валидация полей
     */
    public function validate($field_value, $field_type = null)
    {
        $value = trim($field_value);

        if(!$value)
            return false;

        if($field_type){

            switch($field_type){
                case 'r_email':
                    if(is_email( $field_value )){
                        return true;
                    }
                    else
                        return false;
                    break;

                default: return true;
                    break;
            }
        }

        return true;
    }


    /**
     * запись в БД новой строки с данными для рефера
     */
    public function setRecord($data = [])
    {
        global $wpdb;

        $res = $wpdb->insert(
            'gn_referal',
            //array( 'name' => $data['name'], 'email' => $data['email'], 'code' => $data['code'],  'active' => 1, 'create_date' => date('Y-m-d')),
            array(
                'name' => $data['r_name'],
                'surn' => $data['r_surn'],
                'phone' => $data['r_phone'],
                'email' => $data['r_email'],
                'salon' => $data['r_salon'],
                'code' => $data['code'],
                'create_date' => date('Y-m-d')
            ),
            array( '%s', '%s', '%s', '%s', '%s', '%s', '%s' )
        );

        return $res;
    }


    /**
     * отправка ссылки на почту дарителю
     */
    public function sendReferal($data = [], $email = null)
    {
        $send = false;

        if($email && !empty($data)){

            $to         = $email;
            $subject    = 'Ваша ссылка для приглашения друзей в салон Жантиль';
            $url        = self::$url; //'https://gantil.ru/zakazat-zvonok-po-akcii-privedi-druga/';
            $link       = $url.'?code='.$data['code'];

            $message    = 'Ваша ссылка для приглашения друзей в салон Жантиль'."\r\n";
            $message    .= '<a href="'.$link.'">'.$link.'</a>';

            $headers    = array(
                'content-type: text/html',
                'From: Жантиль <gantilinfo@yandex.ru>'//'From: Жантиль <gantil@gantil.ru>' . "\r\n";
            );

            $send = wp_mail( $to, $subject, $message, $headers );
        }

        return $send;
    }

    /**
    * функция передачи SMS
    */
    public function sendSms($data)
    {
        $host       = self::$host;
        $port       = self::$port;
        $login      = self::$login;
        $password   = self::$password;
        $sender     = self::$sender;
        $wapurl     = self::$wapurl;

        $url        = self::$url;
        $link       = $url.'?code='.$data['code'];
        $text       = 'Ваша ссылка для приглашения друзей в салон Жантиль '.$link;

        $phone      = self::normalizePhone($data['r_phone']);

        if(!$phone)
            return false;

        $fp = fsockopen($host, $port, $errno, $errstr);
        if (!$fp) {
            return "errno: $errno \nerrstr: $errstr\n";
        }

        fwrite($fp, "GET /send/" .
            "?phone=" . rawurlencode($phone) .
            "&text=" . rawurlencode($text) .
            //"&flash=1" .
            ($sender ? "&sender=" . rawurlencode($sender) : "") .
            ($wapurl ? "&wapurl=" . rawurlencode($wapurl) : "") .
            " HTTP/1.0\n");

        fwrite($fp, "Host: " . $host . "\r\n");

        if ($login != "") {
            fwrite($fp, "Authorization: Basic " .
                base64_encode($login. ":" . $password) . "\n");
        }

        fwrite($fp, "\n");

        $response = "";

        while(!feof($fp)) {
            $response .= fread($fp, 1);
        }

        fclose($fp);

        list($other, $responseBody) = explode("\r\n\r\n", $response, 2);

        return $responseBody;
    }

    /**
     * проверка состояния счета на балансе SMS провайдера
     */
    public function getBalance()
    {
        $balance = '?';
        $result = wp_remote_get( 'http://api.iqsms.ru/messages/v2/balance/?login='.self::$login.'&password='.self::$password );

        if($result){
            $body = explode(';', $result['body']);
            if($body[1])
                $balance = $body[1];
        }
        return $balance;
    }

    /**
    * функция проверки состояния отправленного сообщения
    */
    public function getSmsStatus($sms_id)
    {
        $host       = self::$host;
        $port       = self::$port;
        $login      = self::$login;
        $password   = self::$password;

        if(!$sms_id)
            return false;

        $fp = fsockopen($host, $port, $errno, $errstr);
        if (!$fp) {
            return "errno: $errno \nerrstr: $errstr\n";
        }
        fwrite($fp, "GET /status/" .
            "?id=" . $sms_id .
            " HTTP/1.0\n");
        fwrite($fp, "Host: " . $host . "\r\n");
        if ($login != "") {
            fwrite($fp, "Authorization: Basic " .
                base64_encode($login. ":" . $password) . "\n");
        }
        fwrite($fp, "\n");
        $response = "";
        while(!feof($fp)) {
            $response .= fread($fp, 1);
        }
        fclose($fp);
        list($other, $responseBody) = explode("\r\n\r\n", $response, 2);

        $arr = explode('=', $responseBody);
        $status = $arr[1];

        //return $responseBody;
        return $status;
    }

    /**
     * внесем в БД id SMS
     */
    public function setSmsId($response, $data)
    {
        global $wpdb;

        $res = false;

        if($response){
            $arr = explode('=', $response);

            $smsid = $arr[0];

            $res = $wpdb->update(
                'gn_referal',
                ['smsid' => $smsid],
                ['code' => $data['code']]
            );
        }

        return $res;
    }

    /**
     * приведение номера телефона к виду 79998887766 для отправки SMS
     */
    public function normalizePhone($phone = null)
    {
        $arr2 = [];

        if($phone){

            $arr = str_split($phone); // преобразуем строку телефона в массив символов

            //printArray($arr);

            // выберем только числовые символы и внесем их в новый массив
            foreach($arr as $n){
                if(is_numeric($n)){
                    $arr2[] = $n;
                }
            }

            // при необходимости добавим в начале 7
            if(count($arr2) == 10){
                array_unshift($arr2, '7');
            }
            // при необходимости исправим первую 8 на 7
            elseif(count($arr2) == 11){
                if($arr2[0] != '7')
                    $arr2[0] = '7';
            }
            else
                $arr2 = false;

        }

        if($arr2)
            $arr2 = implode($arr2);

        return $arr2;
    }

    /**
     * печать таблицы рефералов
     */
    public function printReferals()
    {
        global $wpdb;

        $res = $wpdb->get_results( "SELECT * FROM `gn_referal` WHERE 1 ORDER BY id DESC" );

        // проверим баланс на счете SMS провайдера
        $balance = self::getBalance();
        $balance < 100 ? $color = 'red' : $color = 'green';

        $html = '<h2>Реферальные ссылки</h2>';

        if($res){
            $html .= '<table border="1" cellpadding="10" cellspacing="0" width="100%">';

            $html .= '<tr>
                        <th>ID</th>
                        <th>Имя дарителя</th>
                        <th>Фамилия</th>
                        <th>Телефон</th>
                        <th>Статус SMS (баланс: <span style="color:'.$color.'">'.$balance.'</span> руб.)</th>
                        <th>Ответ SMS провайдера</th>
                        <th>Email</th>
                        <th>Салон</th>
                        <th>Код приглашения</th>                        
                        <!--<th>Ссылка активна</th>-->
                        <th>Дата создания ссылки</th>
                        <th>Счетчик использования </th>
                        <th>Удалить</th>
                    </tr>';

            foreach($res as $row){
                $id = 0;
                $html .= '<tr>';

                foreach($row as $field => $val){
                    $cls = '';
                    if( $field == 'create_date'){
                        if(!self::getDateDiff($val)){
                            $val .= '(не активно)';
                            $cls = ' style="background:#ffc5c5" ';
                        }
                    }

                    if($field == 'id')
                        $id = $val;

                    if($field == 'smsid'){
                        $color = $this->stat[self::getSmsStatus($val)][1];
                        $val = $this->stat[self::getSmsStatus($val)][0];
                        $cls = ' style="background:'.$color.'" ';
                    }


                    //

                    $html .= '<td '.$cls.'>'.$val.'</td>';
                }

                $html .= '<td><a href="?page=my-referal/page.php&del='.$id.'">удалить</a></td></tr>';
            }

            $html .= '</table>';
        }

        return $html;
    }

    /**
     * проверим актуальность ссылки (дата создания не раньше 30 дней)
     */
    public function getDateDiff($create_date = null)
    {
        $active = true;

        if($create_date){
            $datetime1 = new DateTime($create_date);
            $datetime2 = new DateTime(date('Y-m-d'));
            $interval = $datetime1->diff($datetime2);
            //return $interval->format('%a');

            if($interval->format('%a') > $this->active_interval)
                $active = false;
        }

        return $active;
    }

    /**
     * проверим наличие кода приглашения в БД
     * и если он есть, то вернем запись
     */
    public function checkCode($code = null)
    {
        global $wpdb;

        if($code){
            $query = "SELECT * FROM `gn_referal` 
                      WHERE code = '$code' 
                      AND create_date > (NOW() - INTERVAL $this->active_interval DAY)";
            $res = $wpdb->get_results( $query );

            if($res)
                return $res;
        }

        return false;
    }

    /**
     * увеличение счетчика заказов по ссылке
     */
    public function incCount($id = null){
        global $wpdb;

        if($id){
            $query = "UPDATE `gn_referal` SET `count` = `count` + 1 WHERE `id` = ".$id;
            $res = $wpdb->query($query);
            //return $query;
            return $res;
        }

        return false;
    }

    /**
     * удаление реферальной ссылки
     */
    public function deleteReferal($id = null)
    {
        global $wpdb;

        if($id){
            $res = $wpdb->delete( 'gn_referal', array('id' => $id), array( '%d' ) );
            return $res;
        }
        else
            return false;
    }
}
