    <h5 id="pick_out_section" class="link" style="display:<?="none"?>;">Выберите родительский раздел для создаваемой страницы</h5>
	<div id="<?="save_tmpl_block"?>">
    	<div id="sections_radios">
        <label>
          <span>
        	<input type="radio" name="menu" id="none" value="radio"><b id="no_parent">Без родительского раздела</b>
          </span>
        </label>
	<?	$items=HelperAdmin::menuItem();
		var_dump("<h1>items:</h1><pre>",$items,"</pre>");
		
		HelperAdmin::makeArrayForSelect($items);
		$MainSections=HelperAdmin::$MainMenu;
		$SubSections=HelperAdmin::$SubMenu;
		var_dump("<h1>SubSections:</h1><pre>",$SubSections,"</pre>");
		foreach($MainSections as $section_id=>$section_name){?>
        <label>
          <span>
        	<input name="menu" id="menu_<?=$section_id?>" type="radio" value="<?=$section_id?>"><b><?=$section_name?></b>
          </span>
        </label>
		<?	if (isset($SubSections[$section_id])) {?>
        <div>
        	<blockquote>
		<?		foreach ($SubSections[$section_id] as $id => $page){?>
            	<label>
                  <span>
					<input name="menu" id="submenu_<?=$id?>" type="radio" value="<?=$id?>"><?=$page?>
                  </span>
                </label>
			<?	}?>
        	</blockquote>
        </div>
		<?	}?>
	<?	}?>
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