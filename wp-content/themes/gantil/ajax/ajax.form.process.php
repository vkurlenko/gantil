<?php

if(empty($_POST))
	exit;



$name	= $_POST["name"];
$tel	= $_POST["tel"];
$salon	= $_POST["salon"];
$email	= $_POST["email"];
$pid	= $_POST["pid"];
$promotion = '';
$emlSalon = '';
$arrSalon = array();

if($salon != '0')
{

	$sql = "SELECT * FROM `".$_VARS['tbl_pages_name']."`
		WHERE p_parent_id = 9 AND p_show = '1'
		ORDER BY p_order ASC";
	$res = mysql_query($sql);
	
	while($row = mysql_fetch_array($res))
	{
		$arrSalon[$row['p_url']] = $row['p_title'];		
	}


	$e = mysql_fetch_assoc(mysql_query("SELECT * FROM {$_VARS['tbl_prefix']}_presets WHERE var_name='mail_admin_{$salon}'"));
	$emlSalon = $e['var_value'];
}

if($pid)
{

	$sql = "
		SELECT * FROM `".$_VARS['tbl_prefix']."_lp`
		WHERE id = ".$pid;
	$res = mysql_query($sql);
	
	while($row = mysql_fetch_array($res))
	{
		$promotion = strip_tags($row['lp_text_1']);		
	}

}


$errorMSG= "";
 
// ИМЯ
if(empty($_POST["name"]))
    $errorMSG= "Необходимо ввести имя!<br>";
else
    $name= $_POST["name"];

// ТЕЛЕФОН
if(empty($_POST["tel"]))
    $errorMSG.= "Необходимо ввести номер телефона!<br>";
else
{
	//if(!'^((8|\+7)[\- ]?)?(\(?\d{3}\)?[\- ]?)?[\d\- ]{7,10}$')
	
	$pattern = '/(?:\+?[\d]{1,5})?[-\(\s]{0,2}\d{3,3}[-\)\s\(]{0,3}\d{3,3}[-\)\s]{0,3}\d{2,2}[-\s]{0,2}\d{0,2}(?:\*[\d]{1,5})?/';//'/((8|\+7)-?)?\(?\d{3,5}\)?-?\d{1}-?\d{1}-?\d{1}-?\d{1}-?\d{1}((-?\d{1})?-?\d{1})?/'; 
	if(!preg_match($pattern, $_POST["tel"], $out))
	{ 
		$errorMSG.= "Поверьте правильность номера телефона!<br>";
	}	
	
}
    $message= $_POST["tel"];
 
if(empty($_POST["salon"]) || $_POST["salon"] == '0')
    $errorMSG.= "Необходимо выбрать салон!<br>";
else
    $message= $_POST["salon"];
// EMAIL
/*if(empty($_POST["email"])) 
    $errorMSG.= " Необходимо ввести Email";
else*/
    $email= $_POST["email"];
 

 

 
//$EmailTo= "vkurlenko@rambler.ru";
$EmailTo= $_VARS['env']['mail_admin'].', '.$emlSalon;//"vkurlenko@rambler.ru";
$Subject= "Получена заявка на запись по специальному предложению ($arrSalon[$salon])";
 
// Подготовка шапки сообщения
$Body= "Получена заявка на запись по специальному предложению \r\n";
$Body.= "=====================================================\r\n";



 $Body.= "Имя: ";
 $Body.= $name;
 $Body.= "\n";
 
 $Body.= "Телефон: ";
 $Body.= $tel;
 $Body.= "\n";
 
 $Body.= "Салон: ";
 $Body.= $arrSalon[$salon];
 $Body.= "\n";
 
 $Body.= "Email: ";
 $Body.= $email;
 $Body.= "\n";
 
 $Body.= "Условия акции: ";
 $Body.= $promotion;
 $Body.= "\n";
 
 if($errorMSG == '')
 	$success= mail($EmailTo, $Subject, $Body, "Content-type: text/plain; charset=utf-8;\r\nFrom:".$email);

// посылаем сообщение
 
// редирект
if($success && $errorMSG == "")
{
	echo "success";
}
else
{
	if($errorMSG  == "")
	{
		echo "Произошла ошибка";
	} 
	else
	{
		echo $errorMSG;
	}
}
 
?>