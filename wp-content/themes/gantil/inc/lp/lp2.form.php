<?php
/* выпадающий список салонов */
$arrSalon = array(
	"0" => "Выберите салон"
);

$sql = "SELECT * FROM `".$_VARS['tbl_pages_name']."`
		WHERE p_parent_id = 9 AND p_show = '1'
		ORDER BY p_order ASC";
$res = mysql_query($sql);

while($row = mysql_fetch_array($res))
{
	
	$arrSalon[$row['p_url']] = $row['p_title'];
	
}
/* /выпадающий список салонов */
?>


<div class="form-group">
	<label for="inputName" class="col-xs-4 control-label">Имя*</label>
	<div class="col-xs-8">
	  <input type="text" class="form-control inputName" id="" placeholder="Введите имя" required>
	  <div  class="help-block with-errors"></div>
	</div>
  </div>


<div class="form-group">
	<label for="inputTel" class="col-xs-4 control-label">Телефон*</label>
	<div class="col-xs-8">
	  <input type="tel" class="form-control inputTel" id="" placeholder="Введите телефон" required>
	  <div  class="help-block with-errors"></div>
	</div>
  </div>

  <div class="form-group">
	<label for="inputEmail" class="col-xs-4 control-label">Выберите салон*</label>
	<div class="col-xs-8">
		<select class="form-control inputSalon" id="" placeholder="Выберите салон" required>
		
			<?
			foreach($arrSalon as $k => $v)
			{
			?>
			<option value="<?=$k?>"><?=$v?></option>
			<?
			}
			?>
			
		</select>
		
		
		
	  <div  class="help-block with-errors"></div>
	</div>
  </div>
  
   <div class="form-group">
	<label for="inputEmail" class="col-xs-4 control-label">Email</label>
	<div class="col-xs-8">
	  <input type="email" class="form-control inputEmail" id="" placeholder="Введите email">
	  <div  class="help-block with-errors"></div>
	</div>
  </div>
  						  
  <div class="form-group">
	<div class="col-xs-offset-4 col-xs-8">
	  <button type="submit" class="btn btn-default">Записаться</button>
	</div>
  </div>

  <div class="alert alert-success alert-dismissible hidden" role="alert">
	  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
	  Ваша заявка успешно отправлена! Спасибо!
	</div>
	
	<div class="alert alert-danger alert-dismissible hidden" role="alert">
	  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
	  К сожалению произошла ошибка отправки заявки. Пожалуйста, проверьте правильность заполнения полей и попробуйте еще раз.
	</div>