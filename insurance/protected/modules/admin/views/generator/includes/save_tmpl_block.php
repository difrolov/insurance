<?	
if (!isset($allObjectsArray)){ // ...
	$allObjectsArray=Data::getObjectsRecursive();	
}	
if (!isset($allObjectsSecondArray)){ // ...
	$allObjectsSecondArray=Data::getObjectsRecursive(false,-2);
	//var_dump("<h1>allObjectsSecondArray:</h1><pre>",$allObjectsSecondArray,"</pre>");	
}?>
    <h5 id="pick_out_section" class="link" style="display:<? if(isset($_GET['test'])){?>block<? }else{?>none<? }?>;">Выберите родительский раздел для создаваемой страницы</h5>
	<div id="<?="save_tmpl_block"?>"<? if(isset($_GET['test'])){?> style="display:block;"<? }?>>
    	<div id="sections_radios">
        <label>
          <span>
        	<input type="radio" name="menu" id="none" value="radio"><b id="no_parent">Без родительского раздела</b>
          </span>
        </label>
	<?	HelperAdmin::makeSectionsMap($allObjectsArray);?>
    	<hr>
	<?	// HelperAdmin::makeSectionsMap($allObjectsSecondArray);?>
    	</div>
        <hr>
        <div id="subsection_ids">
            Укажите название подраздела: <img src="<?php echo Yii::app()->request->baseUrl; ?>/images/question_framed2.png" width="17" height="17" align="texttop" class="helpHint" title="Текст в меню для загрузки данного подраздела">
    <input name="name" type="text" id="name" required>
            <hr>
            Укажите алиас подраздела: <img src="<?php echo Yii::app()->request->baseUrl; ?>/images/question_framed2.png" width="17" height="17" align="texttop" class="helpHint" title="Будет фигурировать в адресной строке браузера"> 
            <div>(<span class="txtRed">только</span> латинские буквы, цифры и &quot;_&quot;)</div> 
            <input name="alias" type="text" id="alias" required><span class="checkData" id="check_alias_info" style="display:<?="none"?>;"><div id="checking_result">&nbsp;проверка уникальности алиаса...&nbsp;</div></span>
            <input name="seek_alias" id="seek_alias" type="hidden" value="<?=Yii::app()->createUrl('admin/generator/aliasCheck');?>">
            <hr>
        </div>
		<div id="metadata">
        	<h4>Укажите метаданные страницы (важно для поисковой оптимизации):</h4>
          	<div>
            	<h5>Заголовок страницы (title):</h5>
            	<input name="title" type="text" id="title" required>
            </div>
          	<div>
            	<h5>Ключевые слова (keywords, через пробел):</h5>
            	<textarea name="keywords" id="keywords"></textarea>
            </div>
			<div>
                <h5>Описание страницы (description):</h5>
                <textarea name="description" id="description"></textarea>                
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