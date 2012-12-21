<?	
// ПОЛУЧИМ ВСЕ РАЗДЕЛЫ САЙТА:
// Начиная с главных:
$allObjectsArray=Data::getObjectsRecursive();
// Те, у которых parent_id = -2:
$allObjectsSecondArray=Data::getObjectsRecursive(false,-2);
						

if (!isset($allObjectsArray)){ // ...
	$allObjectsArray=Data::getObjectsRecursive();	
}	
if (!isset($allObjectsSecondArray)){ // ...
	$allObjectsSecondArray=Data::getObjectsRecursive(false,-2);
}
$edit_mode=false;
//-------------------------
$section_name=false;
$section_parent_id=false;
$section_alias=false;
$section_title=false;
$section_keywords=false;
$section_description=false;

// если в режиме редактирования, получим данные макета:
if (isset($data)&&isset($modules)){
	$edit_mode=true;
	//var_dump("<h1>data:</h1><pre>",$data,"</pre>"); 
	//var_dump("<h1>model_modules:</h1><pre>",$model_modules,"</pre>");
	$section_name=$data['name'];
	$section_parent_id=$data['parent_id'];
	$section_alias=$data['alias'];
	$section_title=$data['title'];
	$section_keywords=$data['keywords'];
	$section_description=$data['description']; 
}?>
<?	
if($exclusiveView) {?>
<style>
#mblock{
	width:70%
}
#metadata input,
#metadata textarea{
	width:70% !important;
}
#issue{
	background:#FF9; 
	border-bottom-left-radius:8px; 
	border-bottom-right-radius:8px; 
	line-height:8px; 
	margin-bottom:40px;
	padding:10px;  
	padding-top:20px;
}
#point_meta{
	font-size:16px;
	font-weight:300;
}

</style>
<div align="center">
  <div id="mblock">	
    <div id="issue">
      <p>Данный раздел разработан как программный модуль. </p>
      <p>Вы можете изменить только метаданные страницы.</p>
    </div>
<?	require_once dirname(__FILE__).'/metadata.php';?>
    <hr>
    <button id="save_metadata" name="save_metadata" type="submit" value="<?=$data['id']?>">Сохранить данные</button>
  </div>
</div>
<?
}else{?>        

    <h5 id="pick_out_section" class="link" style="display:<? 
		if(isset($_GET['test'])){
			?>block<? 
		}else{
			?>none<? 
		}?>;">Выберите родительский раздел для создаваемой страницы</h5>
	<div id="<?="save_tmpl_block"?>"<? 
		if( isset($_GET['test'])
			|| setHTML::detectOldIE()
			|| $primitive
		  ){?> style="display:block;"<? }?>>
    	<div id="sections_radios" style="text-align:left">
        <label>
          <span>
        	<input type="radio" name="menu" id="none" value="radio"<? 
			if ($edit_mode&&!$section_parent_id){?> checked<? }?>><b id="no_parent">Без родительского раздела</b>
          </span>
        </label><br>
	<?	HelperAdmin::makeSectionsMap($allObjectsArray,$section_parent_id);?>
    	<hr>
    	</div>
        <hr>
        <div style="text-align:left" id="subsection_ids">
            Укажите название подраздела: <img src="<?php echo Yii::app()->request->baseUrl; ?>/images/question_framed2.png" width="17" height="17" align="texttop" class="helpHint" title="Текст в меню для загрузки данного подраздела">
    <input name="name" type="text" id="name" required value="<?=$section_name?>">
            <hr>
            Укажите алиас подраздела: <img src="<?php echo Yii::app()->request->baseUrl; ?>/images/question_framed2.png" width="17" height="17" align="texttop" class="helpHint" title="Будет фигурировать в адресной строке браузера"> 
            <div>(<span class="txtRed">только</span> латинские буквы, цифры и &quot;_&quot;)</div>
            <input name="alias" type="text" id="alias" required value="<?=$section_alias?>"><span class="checkData" id="check_alias_info" style="display:<?="none"?>;"><div id="checking_result">&nbsp;проверка уникальности алиаса...&nbsp;</div></span>
<?	if($section_alias){ // ...?>
   			<!-- Для сверки текущего значения и значения ячейки: -->
            <input name="old_alias" id="old_alias" type="hidden" value="<?=$section_alias?>">
<?	}?>
            <!-- Для передачи клиентскому скрипту адреса отправки данных: -->
            <input name="seek_alias" id="seek_alias" type="hidden" value="<?=Yii::app()->createUrl('admin/generator/aliasCheck');?>">
            <hr>
        </div>
<?	require_once dirname(__FILE__).'/metadata.php';?>        
        <hr>
        <button id="preview_page" type="button" value="yes">Предпросмотр</button>
        &nbsp;
        или
        &nbsp;
        <button id="save_page" type="button">&nbsp;Сохранение&nbsp;</button>
        &nbsp;
        подраздела
        &nbsp;
	<?	if(isset($data)){?>
		<input name="section_id" id="section_id"  type="hidden" value="<?=$data['id']?>">
	<? }?>        
	</div>
<?
}?>