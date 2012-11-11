<?	// если в тестовом режиме:
	if (isset($_GET['test'])){?>
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
<form style="margin:0;" name="content_save" id="content_save" method="post" action="<?php echo Yii::app()->createUrl('admin/generator/save/') ?>">
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
        <?php foreach($model_modules as $key_mod=>$val_mod):?>
            <div onclick="_generator_modules.getModule(<?php 
				
				echo $model_modules[$key_mod]['id']; 
				
				?>)" data-module-type="<?php echo $model_modules[$key_mod]['name']; ?>"><?php echo $model_modules[$key_mod]['name']; ?></div>
        <?php endforeach; ?>
        	<div data-module-type="Текст" class="mod_type_text" title="Содержание текстового модуля вы можете задавать/изменять самостоятельно">Текст</div>
        </div>
    </div>
    <div id="<?="tmplPlace"?>">
        <div id="<?="tmplInner"?>"></div>
    </div>
    <h5 id="pick_out_section" class="link" style="display:<?="none"?>;">Выберите родительский раздел для создаваемой страницы</h5>
  	<div id="<?="save_tmpl_block"?>">
    	<div id="sections_radios">
        <label>
          <span>
        	<input type="radio" name="menu" id="none" value="radio"><b id="no_parent">Без родительского раздела</b>
          </span>
        </label>
	<?	$items=HelperAdmin::menuItem();
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
    	</div>
        <hr>
        Укажите название подраздела (текст меню): <input name="name" type="text" id="name" required>
        <hr>
        <hr>
        Укажите алиас (подстроку адреса) подраздела: <input name="alias" type="text" id="alias" required>
        <hr>
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
</form>    
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
	<table id="new_art_header" cellspacing="0">
      <tr>
        <td nowrap>Заголовок статьи: </td>
        <td width="100%"><input placeholder="Укажите заголовок статьи" name="article_header" id="article_header" type="text"></td>
      </tr>
    </table>
<?php	$this->widget('application.extensions.TheCKEditor.TheCKEditorWidget',
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
    <table width="100%" cellspacing="0" cellpadding="0" id="tblArticles">
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
	<div style="position:absolute; left:10px; top:5px;"><a class="link" id="upload_article" href="#">Загрузить статью...</a></div>
<input type="submit" name="submit" onclick="getDataFromCKeditor();return false;" value="Сохранить">
</div>
</form>
</div>
<?php $this->endWidget(); ?>