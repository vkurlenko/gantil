<?
//printArray($_SESSION);

/* выпадающий список салонов */
$arrSalon = array(
	"0" => "Выбор салона"
);

$sql = "SELECT * FROM `".$_VARS['tbl_pages_name']."`
		WHERE p_parent_id = 9 and p_show = '1'
		ORDER BY p_order ASC";
$res = mysql_query($sql);

while($row = mysql_fetch_array($res))
{
	$arrSalon[$row['p_url']] = $row['p_title'];
}
/* /выпадающий список салонов */




//------------------------------------
// получим учетные данные пользователя
$arrUD = array();

if(isset($_SESSION['user_id']))
{
	include_once $_SERVER['DOCUMENT_ROOT'].'/modules/user/user.class.php';

	$user = new USER1();
	
	$user -> tbl = $_VARS['tbl_prefix'].'_users';
	$user -> user_id = $_SESSION['user_id'];
	
	$arrUD = $user -> getUserData();	
	
	//printArray($arrUD);	
}
//------------------------------------


//------------------------------
// подставим данные в поля формы
$arrFormData = array();

isset($arrUD['user_name']) ? $arrFormData['user_name'] = $arrUD['user_name'] : $arrFormData['user_name'] = '';

if(isset($arrUD['user_phone']))
{
	$a = explode('|', $arrUD['user_phone'], 2);
	
	$b = $a[0].$a[1];
	
	$arrFormData['user_code'] = substr($b, 0, 3);
	$arrFormData['user_phone'] = substr($b, 3);
	
	/*$arrFormData['user_code'] = $a[0];
	$arrFormData['user_phone'] = $a[1];*/
	
}
else
{
	$arrFormData['user_code'] = '';
	$arrFormData['user_phone'] = '';
}
//------------------------------
 


?>

<script language="javascript">

$(document).ready(function(){

	/*~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~*/
	/* диалоговое окно "Оставить отзыв" */
	/*~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~*/
	
	/* ВВОД НОМЕРА ТЕЛЕФОНА */
	
	$('.fieldNum input').attr('disabled', true)
		
	$('.dialogField input').keyup(function()
	{
		var thisLen = $(this).val().length;
		var maxLen  = $(this).attr('maxlength')
		
		if(thisLen == maxLen)
		{
			$('.fieldNum input').attr('disabled', false).focus()
		}
		
	})
		
	/* /ВВОД НОМЕРА ТЕЛЕФОНА */
})
</script>

<style>
.ui-widget-header{ background: #008686; border:0 }
.ui-dialog .ui-dialog-title{color:#FFFFFF}
/*.ui-state-default .ui-icon{background-image: url("images/ui-icons_ffffff_256x240.png");}*/
.ui-dialog-titlebar-close{display:none}
#dialog p{font-size:0.8}
.fieldCode, .fieldNum, .fieldCodeC{float:left}
.fieldCode input, .fieldNum input{display:block; width:100%}
.fieldCode {width:20%; margin-left:10px}
.fieldNum {width:60%; float:right }
.userName input, #selectCall{width:100%}
.formSendCall{display: block;
    text-align: center;
    background: #008686;
    color: #fff !important;
    text-transform: uppercase;
    text-decoration: none;
    padding: 20px 0;
    width: 100%;
	margin-top:10px}
	
.resultCall{font-style:italic}
td{padding:10px 0}
</style>


<div id="dialog" title="Обратный звонок">
	<p>Укажите свои данные и администратор выбранного Вами салона обязательно перезвонит Вам в ближайшее время.</p>
	<form action="/blocks/ajax.add.call.php" method="post" id="formAddCall">
		<table>
			<tr>
				<td>
					<select id="selectCall" name="msgSalon">
						
						<?
						foreach($arrSalon as $k => $v)
						{
							$selected = '';
							if(isset($_SESSION['salon']) && $_SESSION['salon'] == "$k") 
								$selected = ' selected ';

							?><option value="<?=$k?>" <?=$selected?>><?=$v?></option><?
						}
						?>
					</select>
				</td>
			</tr>
			<tr>
				<td><div class="dialogField userName"><input type="text" name="userName" value="<?=$arrFormData['user_name']?>" placeholder="Ваше имя" /></div></td>
			</tr>
			<tr>
				<td><div class="dialogField userTime">Удобное время&nbsp;
					<select name="userTime" placeholder="Время" >
						
						<?
						for($i = 10; $i < 23; $i++)
						{
							?>
							<option value="<?=$i.':00'?>"><?=$i.':00'?></option>
							<option value="<?=$i.':30'?>"><?=$i.':30'?></option>
							<?
						}
						?>
					</select>
				
				</div></td>
			</tr>
			<tr>
				<td>
					<span class="fieldCodeC">+7</span>
					<div class="dialogField fieldCode"><input type="text" name="addCallCode" maxlength="3" value="<?=$arrFormData['user_code']?>" placeholder="xxx" /></div>
					<div class="dialogField fieldNum"><input type="text" name="addCallNum" maxlength="7" value="<?=$arrFormData['user_phone']?>" placeholder="xxxxxxx" /></div>		
					<input type="hidden" name="type" value="advertising"/>			
				</td>
			</tr>
		</table>		
		<a class="formSendCall" href="#">Заказать звонок</a>
	</form>
	<div class="result resultCall">&nbsp;</div>		
		
	</div>
<script src="/js/jquery-ui-1.11.4.custom/jquery-ui.min.js"></script>
<script>

var winW = w =  $(window).width();	

if(winW > 500)
	w = 400
else
	w = winW * 0.8
	
//alert(w)
	

$( "#dialog" ).dialog({
	autoOpen: false,
	width: w,
	modal: true,
	/*beforeClose : function(){
			$('#fancybox-overlay').removeClass('overlay');
		},	*/	
	buttons: [
		/*{
			text: "Ok",
			click: function() {
				$( this ).dialog( "close" );
			}
		},*/
		{
			text: "Отмена",
			click: function() {
				$( this ).dialog( "close" );
			}
		}
	]
});

// Link to open the dialog
$( ".link, .backcall-top, .backcall" ).click(function( event ) {
	$( "#dialog" ).dialog( "open" );
	//$('#fancybox-overlay').addClass('overlay');
	event.preventDefault();
});

 var options = {
		  target: ".resultCall",
		  clearForm : true
		};
		
$(".formSendCall").click(function(){
	 	//alert("#formAddCall")
	  	$("#formAddCall").ajaxSubmit(options);
		
		return false;
	  })


</script>
