<? 	if (isset($_GET['show_seq'])){
	// hidden: ?>
<h4>Последовательность вызова клиентских скриптов:</h4>
    <table width="100%" border="1" cellpadding="8" cellspacing="0">
  <tr bgcolor="#FFCCFF">
    <td><h4>#</h4></td>
    <td><h4>Function</h4></td>
    <td><h4>event source</h4></td>
    <td><h4>Файл</h4></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>преобразовать контент блока (Layout.blocks) в массив:<br>
    <strong>splitBlockContent(blockNumer);</strong></td>
    <td>&nbsp;</td>
    <td>manage_template.php</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>преобразовать контент блока в строку и сохранить в Layout:<br>
    <strong>saveBlockContentString(blockNumer,tBlock);</strong></td>
    <td>&nbsp;</td>
    <td>manage_template.php</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr valign="top">
    <td colspan="4" style="line-height:1px; padding:0;" bgcolor="#CCCCCC">&nbsp;</td>
    </tr>
  <tr valign="top">
    <td>&nbsp;</td>
    <td><p>Подготовить схему макета:<br>
	<strong>defineLayoutSchema(event,this); </strong></p></td>
    <td>Пиктораммы схем макета</td>
    <td>prepare_data.php</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td><blockquote>
      <p>показать блок "текущий выбор":<br>
        <strong>showBlock('currentChoice','line'); </strong></p>
    </blockquote></td>
    <td>&nbsp;</td>
    <td>prepare_data.php</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td><blockquote>
      <p>обработать скрытые блоки с выбором типа размещения подзаголовка и псевдофутера:<br>
        <strong>handlePyctos(srce); </strong></p>
    </blockquote></td>
    <td>&nbsp;</td>
    <td>prepare_data.php</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td><blockquote>
      <blockquote>
        <p>отобразить блоки следующего уровня, назначить класс первой пиктограмме:<br>
          <strong>startHandleBlock(srce,blockTextToShowSubheader,divPyctosSubheader);</strong></p>
      </blockquote>
    </blockquote></td>
    <td>&nbsp;</td>
    <td>prepare_data.php</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td><blockquote>
      <blockquote>
        <p>сделать все пиктограммы блоков 2 и 3 непрозрачными:<br>
          <strong>dropPyctosOpacity(divPyctosFooter);</strong> </p>
      </blockquote>
    </blockquote></td>
    <td>&nbsp;</td>
    <td>prepare_data.php</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td><blockquote>
      <p>установить состояние прозрачности для пиктограмм, добавить информацию о подзаголовке и псевдофутере;<br>
        указать параметры текущего выбора:<br>
        <strong>setCurrentChoiceStatus(event,currentPyctosContainer); </strong></p>
    </blockquote></td>
    <td>&nbsp;</td>
    <td>prepare_data.php</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td><blockquote>
      <p>проверить &#8212; допускает ли текущее состояние макета его загрузку;<br>
        если да, <span class="txtRed">назначить схему для макета</span> :<br>
        <strong>checkLayoutReady();</strong></p>
    </blockquote></td>
    <td>&nbsp;</td>
    <td>prepare_data.php</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td><p>Загрузить макет по сформированному шаблону:<strong><br>
    loadLayout();</strong></p></td>
    <td>Кнопка <q><strong>Загрузить макет</strong></q></td>
    <td>load_template.php</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td><blockquote>
      <p>назначить параметры отображения задействованным элементам:<br>
        <strong>stateLayoutIsLoaded()</strong>;</p>
    </blockquote></td>
    <td>&nbsp;</td>
    <td>switch_states.php</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td><blockquote>
      <p>собрать блочную структуру макета по выбранной ранее схеме:<br>
        <strong>createLayout();</strong></p>
    </blockquote></td>
    <td>&nbsp;</td>
    <td>load_template.php</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>выделить цветом активную колонку:<br>
    <strong>selectColumn(event,this);</strong></td>
    <td>Колонки макета</td>
    <td>manage_template.php</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td><p>добавить модуль в активную колонку:<br>
    <strong>addModuleIntoBlock(event,this);</strong></p></td>
    <td>Кнопка модуля</td>
    <td>manage_template.php</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td><blockquote>
      <p>распарсить Layout и отобразить в тестовом блоке:<br>
        <strong>test_parseLayout();</strong></p>
    </blockquote></td>
    <td>&nbsp;</td>
    <td>test.php</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td><blockquote>
      <p><strong>?</strong> добавить ссылки (команды добавления текста/статьи) в текстовый модуль:<br>
        <strong>addTextModuleComLinks(content);</strong></p>
    </blockquote></td>
    <td>&nbsp;</td>
    <td>manage_template.php</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>загрузить предпросмотр статьи:<br>
    <strong>manageArticleText();</strong></td>
    <td>Ссылка (картинка) <strong>Предпросмотр статьи</strong></td>
    <td>handle_text_module.php</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td><a id="storeLayoutBlockData"></a>сохранить в Layout индекс  модуля и номер его родительского блока (колонки):<br>
    <strong> storeLayoutBlockData(curModule);</strong></td>
    <td>&nbsp;</td>
    <td>handle_text_module.php</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td><p>сохранить в Layout индекс текстового модуля и номер его родительского блока (колонки):<br>
    <strong>identifyTextBlock(obj);</strong></p>
      <blockquote>
        <p><strong> <a href="#storeLayoutBlockData">storeLayoutBlockData(curModule)</a>;</strong></p>
    </blockquote></td>
    <td><p>Ссылки внутри добавленного блока:</p>
      <ul>
        <li>&quot;Добавьте произвольное содержание&quot;</li>
        <li> &quot;Выберите из иеющихся статей&quot;</li>
      </ul>    </td>
    <td>handle_text_module.php</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>удалить модуль из колонки и из Layout:<br>
    <strong>removeModule(objSrc);</strong></td>
    <td>&quot;Удалить модуль из колонки&quot;</td>
    <td>manage_template.php</td>
  </tr>
</table>

	<hr size="4" color="#0000FF">
<? }?>
<style>
div#article_preview_text{
	display:<?="none"?>;
	max-height:35%;
	padding-right:24px;
	position:fixed;
	z-index:2;
}
div#article_preview_text div#wrp{
	border:solid 1px #FFCC00;
	box-shadow: 0 0 20px 0 #666;
}
div#article_preview_text
	div#prev_content{
	background:#FFF;
	max-height:330px;
	overflow:auto;
	padding:8px;
	text-align:left;
}
div#upload_article_window{
	background:#FFF; 
	border:solid 2px #CCC; 
	box-shadow: 0 0 30px 0 #666;
	padding:4px; 
	position:absolute; 
	z-index:3000; 
	display:<?="none"?>; 
}
table#tblArticles {
	border:solid 1px #CCC;
}
table#tblArticles tr td{
	border-bottom:dashed 1px #CCC;
}
table#tblArticles tbody tr:first-child td{
	border-bottom-style:solid;
}
table#tblArticles tbody tr:last-child td{
	border-bottom:none;
}
table#tblArticles tr td:first-child{
	text-align:right;
}
table#tblArticles tr td:last-child{
	text-align:center;
}
table#tblArticles tbody tr:first-child td:first-child{
	text-align:left;
}

tr.bold >td {
	font-weight:bold;
}
div[data-test="template"]{
	background:#FFFFCC;
	border:solid 2px #FFCC66;
	left:0;
	max-width:40%;
	opacity:0.3;
	overflow:hidden;
	padding:10px;
	position:fixed;
	text-align:left;
	top:20px;
	width:260px;
	z-index:1;
}
div[data-test="template"]:hover{
	opacity:1;
}
div[data-test="template"] 
	div#tmpl-blocks
		> div > div {
	margin-left:20px;
}
div#test_block_appearance{
	position:absolute;
	right:4px;
	top:2px;
}
td[data-article-id]{
	cursor:default;
}
td[data-article-id]:hover{
	background:#08C;
	color:#FFF;
}
.wclose{
	background:url(<?php echo Yii::app()->request->baseUrl; ?>/images/gtk-cancel.png);
	cursor:pointer;
	height:22px;
	position:absolute;
	right:-25px;
	top:-2px;
	width:22px; 
}
.wclose.inside{
	right:0;
}
</style>
<?	if (isset($_GET['test'])){?>
<script src="<?php echo Yii::app()->request->baseUrl; ?>/js/admin/generator/test.php?base_url=<?=Yii::app()->request->baseUrl?>"></script>
<div data-test="template">
	<div id="test_block_appearance" class="link">свернуть</div>
	<h4>Текущие данные создаваемого подраздела:</h4>
    <h5>Схема макета:  <span id="tmpl-shema"></span></h5>
  	<h5 class="margin0">Блоки/модули:</h5>
    <div id='obj_place'></div>
</div>
<?php
	}
/* @var $this DefaultController */

$this->breadcrumbs=array(
	$this->module->id,
);/*?><h1><?php echo $this->uniqueId . '/' . $this->action->id; ?></h1><? */?>
<div id="article_preview_text">
</div>
<div align="left">
	<div id="choice_init">
        <h5>Выберите параметры макета создаваемой страницы</h5>
        <div id="mng">
            <div id="txtActions">
                <div>Колонки:</div>
                <div>Подзаголовок:</div>
                <div>Псевдофутер:</div>
            </div>
            <div id="txtChoice" onClick="defineLayoutSchema(event,this);">
                <div id="tmplColSet">
                    <div class="oneColumn" title="Одна колонка">&nbsp;</div>
                    <div class="twoColumn" title="Две колонки">&nbsp;</div>
                    <div class="threeColumn" title="Три колонки">&nbsp;</div>
                    <div class="fourColumn" title="Четыре колонки">&nbsp;</div>
                </div>
                <div id="<?="chHeaders"?>">
                    <div title="Без подзаголовка">&nbsp;</div>
                    <div title="Внутренний подзаголовок">&nbsp;</div>
                    <div title="Общий подзаголовок">&nbsp;</div>
                </div>
                <div id="<?="psFooter"?>">
                    <div title="Без псевдофутера">&nbsp;</div>
                    <div>&nbsp;</div>
                    <div>&nbsp;</div>
                </div>
            </div>
            <div id="currentChoice">Вы выбрали следующие параметры макета:
                <span id="selectedColumnsSet"></span>
                <span id="selectedSubheaderPlacement"></span>
                <span id="selectedFooterPlacement"></span>
            </div>
        </div>
	</div>
<? //<div id="test">test block</div>?>
    <div id="<?="tmpl_commands"?>">
        <button class="active" id="<?="btn_loadLayout"?>" type="button" onClick="loadLayout();">Загрузить макет</button>
        <button class="passive" disabled id="<?="btn_changeLayout"?>" type="button" onClick="changeLayout(this);">Изменить макет</button>
        <button class="passive" disabled id="<?="btn_cancelLayoutChanges"?>" type="button" onClick="cancelLayoutChanges(this);">Отменить изменения</button>
    </div>
    <div id="<?="sel_modules"?>">
      <ol>
        <li>Щёлкните нужную колонку; </li>
        <li>Щёлкните модули для размещения в ней.</li>
      </ol>
        <div id="select_mod" onClick="addModuleIntoBlock(event,this);">
            <div data-module-type="Новости">Новости</div>
            <div data-module-type="Готовое решение">Готовое решение</div>
            <div data-module-type="Программа страхования">Программа страхования</div>
            <div data-module-type="Случайная статья">Случайная статья</div>
            <div data-module-type="Текст" class="mod_type_text" title="Содержание текстового модуля вы можете задавать/изменять самостоятельно">Текст</div>
        </div>
    </div>
    <div id="<?="tmplPlace"?>">
        <div id="<?="tmplInner"?>"></div>
    </div>
    <h5 id="pick_out_section" class="link" style="display:<?="none"?>;">Выберите родительский раздел для создаваемой страницы</h5>
  	<div id="<?="save_tmpl_block"?>">
        <label>
          <span>
        	<input type="radio" name="menu" id="none" value="radio"><b>Без родительского раздела</b>
          </span>
        </label>
        <?
			//echo "<h1>No HelperAdmin::arrMenuItems</h1>";
			$items=HelperAdmin::menuItem();
		HelperAdmin::makeArrayForSelect($items);
		$MainSections=HelperAdmin::$MainMenu;
		$SubSections=HelperAdmin::$SubMenu;
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
        <hr>
        <button id="save_page">Сохранить страницу</button>
    </div>
</div>

	<?php $this->beginWidget('application.extensions.bootstrap.widgets.TbModal',
			array('id'=>'myModal',
					'options'=>array(
							'width'=>'800px',
							'fade'=>false,
							))); ?>

<div class="modal-header">
    <a class="close" data-dismiss="modal">&times;</a>
</div>
<div class="modal-body">

<form name="content_edit" method="post" action="<?php echo Yii::app()->createUrl('admin/object/edit/') ?>">
    <?php
$this->widget('application.extensions.TheCKEditor.theCKEditorWidget',
			  array(
    'model'=>$model,                # Data-Model (form model)
    'attribute'=>'content',         # Attribute in the Data-Model
    'height'=>'240px',
    'width'=>'100%',
    'toolbarSet'=>'Basic',          # EXISTING(!) Toolbar (see: ckeditor.js)
    'ckeditor'=>Yii::app()->basePath.'/../ckeditor/ckeditor.php',
                                    # Path to ckeditor.php
    'ckBasePath'=>Yii::app()->baseUrl.'/ckeditor/',
                                    # Relative Path to the Editor (from Web-Root)
    /* 'css' => Yii::app()->baseUrl.'/css/index.css', */
                                    # Additional Parameters
	'config' =>

			array('toolbar'=>array(

				array( 'Source', '-', 'Bold', 'Italic', 'Underline', 'Strike' ),
				array('name'=> 'paragraph',   
					  'items'=> 
					  		array( 'NumberedList','BulletedList','-','Outdent','Indent','-','Blockquote','CreateDiv','-','JustifyLeft','JustifyCenter','JustifyRight','JustifyBlock','-','BidiLtr','BidiRtl' )),
				array('name'=> 'editing',     
					  'items'=> 
					  		array( 'Find','Replace','-','SelectAll','-','SpellChecker', 'Scayt' )),
			//array('name'=> 'document',    'items'=> array( 'Source','-','Save','NewPage','DocProps','Preview','Print','-','Layouts' )),
			//array('name'=> 'clipboard',   'items'=> array( 'Cut','Copy','Paste','PasteText','PasteFromWord','-','Undo','Redo' )),
			//array('name'=> 'forms',       'items'=> array( 'Form', 'Checkbox', 'Radio', 'TextField', 'Textarea', 'Select', 'Button', 'ImageButton', 'HiddenField' )),

			//array('name'=> 'basicstyles', 'items'=> array( 'Bold','Italic','Underline','Strike','Subscript','Superscript','-','RemoveFormat' )),
			//array('name'=> 'links',       'items'=> array( 'Link','Unlink','Anchor' )),
			//array('name'=> 'insert',      'items'=> array( 'Image','Flash','Table','HorizontalRule','Smiley','SpecialChar','PageBreak' )),

				array('name'=> 'styles', 
				  	  'items'=> 
							array( 'Styles','Format','Font','FontSize' )),
							array('Image', 'Link', 'Unlink', 'Anchor' ),
							array('name'=> 'colors', 
								  'items'=> 
									array( 'TextColor','BGColor' )),
									array('name'=> 'tools', 
										  'items'=> 
												array( 'Maximize', 'ShowBlocks','-','About' ))
			),
			'filebrowserBrowseUrl'=>CHtml::normalizeUrl(array('default/browser')),

	),
) ); ?>
<div style="position:relative;" data-target="load_in_editor">    
    <div id="upload_article_window">
    	<span class="wclose" id="close_upartwin"></span>
    	<div style="overflow:auto; height:100%;">
  <?	$articles=HelperAdmin::getAllArticlesList(false); ?>
    <table width="100%" height="100%" cellspacing="0" cellpadding="0" id="tblArticles">
      <tr bgcolor="#CCCCCC" class="bold">
        <td>id</td>
        <td>Название</td>
        <td>&nbsp;</td>
        <td>Статус</td>
      </tr>
<?	for($i=0,$j=count($articles);$i<$j;$i++){?>      
      <tr>
        <td><?=($i+1)?></td>
        <td nowrap data-article-id="<?=$articles[$i]['id']?>"><?=$articles[$i]['name']?></td>
        <td><a class="view" rel="tooltip" href="#" onClick="return manageArticleText(<?=$articles[$i]['id']?>,this);" data-original-title="Предпросмотр статьи"><i class="icon-eye-open"></i></a></td>
        <td><?=$articles[$i]['status']?></td>
      </tr>
<?	}?>      
    </table>
  	  </div>
    </div>
	<div style="position:absolute; left:10px; top:5px;"><a class="link" id="upload_article" href="javascript:void();">Загрузить статью...</a></div>
<input type="submit" name="submit" onclick="getDataFromCKeditor();return false;" value="Сохранить">
</div>
</form>
</div>
<?php $this->endWidget(); ?>