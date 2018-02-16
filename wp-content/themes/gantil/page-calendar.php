<?php
session_start();
/*
Template Name: Календарь
*/

get_header(); 
?>

<?php

// перевод DATETIME -> timestamp
function getTimestamp($d)
{
    $date = date_create($d);
    $times = date_timestamp_get($date);
    return $times;
}

// перевод timestamp -> DATETIME
function getDatetime($dt)
{
    return date ('Y-m-d H:i:s', $dt);   
}

function getColor($cdate)
{
    global $current_ts;
    $cdate_ts = getTimestamp($cdate);
    $day_num = ($cdate_ts - $current_ts) / (60*60*24);
    $d_color =  $day_num % 4;
    return ($d_color + 1);
}

$lastday = 31;
$global_count = 0;
$currentdate = '2015-12-01';
$current_ts = getTimestamp($currentdate);
$x = 4;


function monthCalendar($m, $year, $lastday)
{       
    
    global $weeks, $lastday, $global_count, $x;
    
    $arr = array(
        //2015 => array('green', 'green', 'red', 'red'),
        2016 => array( 'green', 'green', 'red', 'red')/*,
        2017 => array('red', 'green', 'green', 'red')*/     
    );
    
    if(strlen($m) < 2) $m = "0".$m;
    
    $arrMonth = array(
        array("January",    "Январь"    ), 
        array("February",   "Февраль"   ), 
        array("March",      "Март"      ), 
        array("April",      "Апрель"    ), 
        array("May",        "Май"       ), 
        array("June",       "Июнь"      ), 
        array("July",       "Июль"      ), 
        array("August",     "Август"    ), 
        array("September",  "Сентябрь"  ), 
        array("October",    "Октябрь"   ), 
        array("November",   "Ноябрь"    ), 
        array("December",   "Декабрь"   )
    );
    
    $arrWeek = array("пн", "вт", "ср", "чт", "пт", "сб", "вс");
    
    $dayofmonth = date('t', strtotime ("10 ".$arrMonth[$m - 1][0]." ".$year));
    
    // Счётчик для дней месяца
    $day_count = 1;     
    
    // 1. Первая неделя
    $num = 0; // порядковый номер недели
    $prev_days = array();

    for($i = 0; $i < 7; $i++)
    {   
        // Вычисляем номер дня недели для числа
        $dayofweek = date('w', mktime(0, 0, 0, date($m), $day_count, date($year)));         
              
                          
        // Приводим числа к формату 1 - понедельник, ..., 6 - суббота
        $dayofweek = $dayofweek - 1;

        if($dayofweek == -1) 
            $dayofweek = 6;
        
        if($dayofweek == $i)
        {
            // Если дни недели совпадают, заполняем массив $week числами месяца
            
            if(strlen($day_count) < 2) 
                $daynum = "0".$day_count;
            else 
                $daynum = $day_count;
            
            $thisDay = $daynum.".".$m.".".$year;
            $thisDayLink = $year."-".$m."-".$daynum;
            
            $cdate = $year."-".$m."-".$daynum;  
            //echo $cdate;
            
            
            if($thisDay == date('d').".".date('m').".".date('Y')) 
            {
                $week[$num][$i] = "<td class='today ".$arr[date('Y')][$global_count%4]." color".getColor($cdate)."'><div>".$day_count."</div></td>";   
            }                           
            else 
            {
                $week[$num][$i] = "<td class='".$arr[date('Y')][$global_count%4]." color".getColor($cdate)."'><div>".$day_count."</div></td>";
            }

            $x++;
                

            if($x > 4)
                $x = 1;
          
            $day_count++;
            $global_count++;
        }
        else
        {
            if($lastday > 0)
                $prev_days[] = $lastday - $i;               
        }
        
        // печатаем числа предыдущего месяца
        if(!empty($prev_days))
        {
            $prev = array_reverse($prev_days);

            for($d = 0; $d < count($prev); $d++)
                $week[$num][$d] = "<td style='color:#999; text-align:center'>".$prev[$d]."</td>";
        }
        // /печатаем числа предыдущего месяца
    }
    
    // 2. Последующие недели месяца
    while(true)
    {
        $num++;
        for($i = 0; $i < 7; $i++)
        {
            if(strlen($day_count) < 2) 
                $daynum = "0".$day_count;
            else 
                $daynum = $day_count;
            
            $thisDay = $daynum.".".$m.".".$year;
            $thisDayLink = $year."-".$m."-".$daynum;
            
            $cdate = $year."-".$m."-".$daynum;  
            
            if($thisDay == date('d').".".date('m').".".date('Y')) 
            {
                $week[$num][$i] = "<td class='today ".$arr[date('Y')][$global_count%4]." color".getColor($cdate)."'><div>".$day_count."</div></td>";
            }               
            else 
            {
                $week[$num][$i] = "<td class='".$arr[date('Y')][$global_count%4]." color".getColor($cdate)."'><div>".$day_count."</div></td>";             
            }


            $x++;   

            if($x > 4)
                $x = 1;
            
            $day_count++;
            $global_count++;
            
            // Если достигли конца месяца - выходим из цикла
            if($day_count > $dayofmonth) 
            {
                // печатаем числа следующего месяца
                $lastday = $day_count - 1;

                if($i < 7)
                {
                    $index = $i+1;
                    $day = 1;

                    while($index < 7) 
                        $week[$num][$index++] = "<td style='color:#999'>".$day++."</td>";
                }
                // /печатаем числа следующего месяца
                break;
            }
        }
        
        // Если достигли конца месяца - выходим из цикла
        if($day_count > $dayofmonth) 
        {
            // печатаем числа следующего месяца
            $lastday = $day_count - 1;
            if($i < 7)
            {
                $index = $i+1;
                $day = 1;

                while($index < 7) 
                    $week[$num][$index++] = "";
            }   
            // /печатаем числа следующего месяца            
            break;
        }
    }
    
    
    // 3. Выводим содержимое массива $week в виде календаря
    // Выводим таблицу

    $cl = 'n'.intval($m);
    if(date('m') == $m) $thisMonth = 'thisMonth';
    else $thisMonth = '';

    ?>
    
    
    
    
    
    <div class="month <?=$thisMonth?> " id="<?=$cl?>"  >
        <table border=0 align="center" width="90%">
        <tr>
            <th colspan=7><a name="<?=($m - 1)?>"></a><?=$arrMonth[$m - 1][1]." ".$year?></th>
        </tr>
        <tr>
            <?
            for($w = 0; $w < count($arrWeek); $w++)
            {
                ?><td class="weekDayName" align="center"><?=$arrWeek[$w]?></td><?
            }
            ?>
        </tr>
        <?
        for($i = 0; $i < count($week); $i++)
        {
            ?>
            <tr>
            <?
            for($j = 0; $j < 7; $j++)
            {
                if(!empty($week[$i][$j]))
                {
                    echo $week[$i][$j];
                }
                else
                {
                    ?><td>&nbsp;</td><?
                }
                
            }
            ?></tr><?
        } 
        if(count($week) < 6)
        {
            ?><tr><td colspan=7>&nbsp;</td></tr><?
        }   
        ?>
        </table>
    </div>
    <?
}

?>

<!-- content -->
                        
                        <div class="row-fluid">
                            <div class="container-fluid content">                                
                                
                                
                                <!-- breadcrumbs -->
                                <?php if( function_exists('kama_breadcrumbs') ) kama_breadcrumbs(' > '); ?>
                                <!-- /breadcrumbs -->
    
                                <div class="content-article">

                                    <h1><?php the_title();?></h1>
                                    
                                    <?
                                    $post = get_post();
                                    ?>

                                    <!-- submenu -->
                                    <!-- <ul class="submenu">
                                    <?php  
                                    $arr_menu = wp_list_pages( 
                                        array(
                                            'title_li' => '',
                                            'child_of' => $post->post_parent,
                                            'depth' => 1,
                                            'echo' => true
                                        ) 
                                    ); 
                                    ?>
                                    </ul> -->
                                    
                                    <div style="clear:both"></div>
                                    <!-- /submenu -->

                                   
                                    <?php echo $post -> post_content;  ?>
                                   

                                    <!-- календарь -->
                                    <?php
                                    $weeks  = array();
                                
                                    $m_num  = 18; // кол-во месяцев календаря
                                    $n      = 0; // счетчик
                                    
                                    
                                    $m_from = date('m') - 1; // от какого месяца считать (за 6 месяцев до текущего)
                                    
                                    $m_to   = date('m') + 12; // до какого месяца считать (в течение 12 месяцев от текущего)
                                    

                                    for($i = $m_from; $i < $m_to; $i++)
                                    {
                                        
                                        if($i <= 0)
                                        {
                                            $j = 12 + $i;
                                            $year = date('Y') - 1;
                                        }
                                        else
                                        {
                                            $j = $i;
                                            $year = date('Y');  
                                        }   
                                        
                                        if($j > 12) 
                                        {
                                            $j = $j - 12;
                                            $year = date('Y') + 1;
                                        }
                                        
                                        monthCalendar($j, $year, $lastday);             
                                        
                                        $n++;
                                    }       
                                    
                                    ?>  

                                    
                                    <!-- /календарь -->
                                    
                                </div>
                            </div>
                        </div>
                        <!-- /content -->
                    </div>
                    <!-- /left-block -->




<?php
get_footer()
?>