<?	
if (!isset($allObjectsArray)){ // ...
	$allObjectsArray=Data::getObjectsRecursive();	
}	
if (!isset($allObjectsSecondArray)){ // ...
	$allObjectsSecondArray=Data::getObjectsRecursive(false,-2);
	//var_dump("<h1>allObjectsSecondArray:</h1><pre>",$allObjectsSecondArray,"</pre>");	
}?>
    <h5 id="pick_out_section" class="link" style="display:<?="none"?>;">Выберите родительский раздел для создаваемой страницы</h5>
	<div id="<?="save_tmpl_block"?>"<? if(isset($_GET['test'])){?> style="display:block;"<? }?>>
    	<div id="sections_radios">
        <label>
          <span>
        	<input type="radio" name="menu" id="none" value="radio"><b id="no_parent">Без родительского раздела</b>
          </span>
        </label>
	<?	HelperAdmin::makeSectionsMap($allObjectsArray);?>
    	<hr>
	<?	HelperAdmin::makeSectionsMap($allObjectsSecondArray);?>
    	</div>
        <hr>
        <div id="subsection_ids">
            Укажите название подраздела: <img src="<?php echo Yii::app()->request->baseUrl; ?>/images/question_framed2.png" width="17" height="17" align="texttop" class="helpHint" title="Текст в меню для загрузки данного подраздела">
    <input name="name" type="text" id="name" required>
            <hr>
            Укажите алиас подраздела: <img src="<?php echo Yii::app()->request->baseUrl; ?>/images/question_framed2.png" width="17" height="17" align="texttop" class="helpHint" title="Уникальная подстрока в адресе страницы с данным подразделом"> 
            <input name="alias" type="text" id="alias" required>
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
        <button id="save_page" type="button">Сохранить страницу</button>
	</div>