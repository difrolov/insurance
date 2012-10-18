<?php

/* @var $this DefaultController */

$this->breadcrumbs=array(
	$this->module->id,
);/*?><h1><?php echo $this->uniqueId . '/' . $this->action->id; ?></h1><? */?>
<div align="left">
	<div id="choice_init">
        <h5>Выберите параметры макета создаваемой страницы</h5>
        <div id="mng">
            <div id="txtActions">
                <div>Колонки:</div>
                <div>Подзаголовок:</div>
                <div>Псевдофутер:</div>
            </div>
            <div id="txtChoice" onClick="defineTemplateSchema(event,this);">
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
        <button class="active" id="<?="btn_loadTemplate"?>" type="button" onClick="loadTemplate();">Загрузить макет</button>
        <button class="passive" disabled id="<?="btn_changeTemplate"?>" type="button" onClick="changeTemplate(this);">Изменить макет</button>
        <button class="passive" disabled id="<?="btn_cancelTemplateChanges"?>" type="button" onClick="cancelTemplateChanges(this);">Отменить изменения</button>
    </div>
    <div id="<?="sel_modules"?>">
      <ol>
        <li>Щёлкните нужную колонку; </li>
        <li>Щёлкните модули для размещения в ней.</li>
      </ol>
        <div id="select_mod" onClick="addModuleIntoBlock(event,this);">
            <div>Новости</div>
            <div>Готовое решение</div>
            <div>Программа страхования</div>
            <div>Случайная статья</div>
            <div class="mod_type_text" title="Содержание текстового модуля вы можете задавать/изменять самостоятельно">Текст</div>
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
		if (!$items=HelperAdmin::$arrMenuItems){
			//echo "<h1>No HelperAdmin::arrMenuItems</h1>";
			$items=HelperAdmin::menuItem();
		}
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
    <h4>Текстовый редактор</h4>
</div>

<div class="modal-body">
<form name="content_edit" method="post" action="<?php echo Yii::app()->createUrl('admin/object/edit/') ?>">
    <?php
$this->widget('application.extensions.TheCKEditor.theCKEditorWidget',array(
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
			array( 'Image', 'Link', 'Unlink', 'Anchor' ),
			array('name'=> 'document',    'items'=> array( 'Source','-','Save','NewPage','DocProps','Preview','Print','-','Templates' )),
			array('name'=> 'clipboard',   'items'=> array( 'Cut','Copy','Paste','PasteText','PasteFromWord','-','Undo','Redo' )),
			array('name'=> 'editing',     'items'=> array( 'Find','Replace','-','SelectAll','-','SpellChecker', 'Scayt' )),
			array('name'=> 'forms',       'items'=> array( 'Form', 'Checkbox', 'Radio', 'TextField', 'Textarea', 'Select', 'Button', 'ImageButton', 'HiddenField' )),

			array('name'=> 'basicstyles', 'items'=> array( 'Bold','Italic','Underline','Strike','Subscript','Superscript','-','RemoveFormat' )),
			array('name'=> 'paragraph',   'items'=> array( 'NumberedList','BulletedList','-','Outdent','Indent','-','Blockquote','CreateDiv','-','JustifyLeft','JustifyCenter','JustifyRight','JustifyBlock','-','BidiLtr','BidiRtl' )),
			array('name'=> 'links',       'items'=> array( 'Link','Unlink','Anchor' )),
			array('name'=> 'insert',      'items'=> array( 'Image','Flash','Table','HorizontalRule','Smiley','SpecialChar','PageBreak' )),

			array('name'=> 'styles',      'items'=> array( 'Styles','Format','Font','FontSize' )),
			array('name'=> 'colors',      'items'=> array( 'TextColor','BGColor' )),
			array('name'=> 'tools',       'items'=> array( 'Maximize', 'ShowBlocks','-','About' ))
			),
			'filebrowserBrowseUrl'=>CHtml::normalizeUrl(array('default/browser')),

	),



) ); ?>
<input type="submit" name="submit" onclick="submit_editor_form();return false;" >
</form>
</div>
<div class="modal-footer">
<?php $this->endWidget(); ?>
<script type="text/javascript">
function submit_editor_form(){
	console.info(CKEDITOR.instances['InsurArticleContent[content]'].getData());
}
</script>
