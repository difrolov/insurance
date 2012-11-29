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
if (isset($data)&&isset($model_modules)){
	$edit_mode=true;
	//var_dump("<h1>data:</h1><pre>",$data,"</pre>"); 
	//var_dump("<h1>model_modules:</h1><pre>",$model_modules,"</pre>");
	$section_name=$data['name'];
	$section_parent_id=$data['parent_id'];
	$section_alias=$data['alias'];
	$section_title=$data['title'];
	$section_keywords=$data['keywords'];
	$section_description=$data['description']; 
	//var_dump("<h1>data:</h1><pre>",$data,"</pre>");
	//var_dump("<h1>model_modules:</h1><pre>",$model_modules,"</pre>");
	//die();
}?>
    <h5 id="pick_out_section" class="link" style="display:<? 
		if(isset($_GET['test'])){
			?>block<? 
		}else{
			?>none<? 
		}?>;">Выберите родительский раздел для создаваемой страницы</h5>
	<div id="<?="save_tmpl_block"?>"<? if(isset($_GET['test'])){?> style="display:block;"<? }?>>
    	<div id="sections_radios">
        <label>
          <span>
        	<input type="radio" name="menu" id="none" value="radio"<? 
			if ($edit_mode&&!$section_parent_id){?> checked<? }?>><b id="no_parent">Без родительского раздела</b>
          </span>
        </label><br>
	<?	HelperAdmin::makeSectionsMap($allObjectsArray,$section_parent_id);?>
    	<hr><?	// HelperAdmin::makeSectionsMap($allObjectsSecondArray);?>
    	</div>
        <hr>
        <div id="subsection_ids">
            Укажите название подраздела: <img src="<?php echo Yii::app()->request->baseUrl; ?>/images/question_framed2.png" width="17" height="17" align="texttop" class="helpHint" title="Текст в меню для загрузки данного подраздела">
    <input name="name" type="text" id="name" required value="<?=$section_name?>">
            <hr>
            Укажите алиас подраздела: <img src="<?php echo Yii::app()->request->baseUrl; ?>/images/question_framed2.png" width="17" height="17" align="texttop" class="helpHint" title="Будет фигурировать в адресной строке браузера"> 
            <div>(<span class="txtRed">только</span> латинские буквы, цифры и &quot;_&quot;)</div> ALIAS : <?=$section_alias?>
            <input name="alias" type="text" id="alias" required value="<?=$section_alias?>"><span class="checkData" id="check_alias_info" style="display:<?="none"?>;"><div id="checking_result">&nbsp;проверка уникальности алиаса...&nbsp;</div></span>
<?	if($section_alias){ // ...?>
   			<!-- Для сверки текущего значения и значения ячейки: -->
            <input name="old_alias" id="old_alias" type="hidden" value="<?=$section_alias?>">
<?	}?>
            <!-- Для передачи клиентскому скрипту адреса отправки данных: -->
            <input name="seek_alias" id="seek_alias" type="hidden" value="<?=Yii::app()->createUrl('admin/generator/aliasCheck');?>">
            <hr>
        </div>
		<div id="metadata">
        	<h4>Укажите метаданные страницы (важно для поисковой оптимизации):</h4>
          	<div>
            	<h5>Заголовок страницы (title):</h5>
            	<input name="title" type="text" id="title" required value="<?=$section_title?>">
            </div>
          	<div>
            	<h5>Ключевые слова (keywords, через пробел):</h5>
            	<textarea name="keywords" id="keywords"><?=$section_keywords?></textarea>
            </div>
			<div>
                <h5>Описание страницы (description):</h5>
                <textarea name="description" id="description"><?=$section_description?></textarea>                
      		</div>
		</div>
        <hr>
        <button id="preview_page" type="button">Предпросмотр</button>
        &nbsp;
        или
        &nbsp;
        <button id="save_page" type="button">&nbsp;Сохранение&nbsp;</button>
        &nbsp;
        подраздела
        &nbsp;
	</div>