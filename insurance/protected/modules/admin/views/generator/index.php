<?	
if (isset($data)) // подключить скрипт с js-обработкой существущего макета:
	require_once Yii::getPathOfAlias('webroot')."/js/admin/generator/edit_template.php";
$groot=$this->groot; // директория Генератора
$includes=$groot.'includes/'; // директория подключаемых файлов
// вывести блок контроля Layout в тестовом режиме:
require_once $includes.'test_control.php';
//$this->breadcrumbs=array($this->module->id,);

$sect1=Data::getObjectsRecursive(false);
var_dump("<h1>sect1:</h1><pre>",$sect1,"</pre>");

$sect2=Data::getObjectsRecursive(' ','-2');
var_dump("<h1>sect2:</h1><pre>",$sect2,"</pre>");
?>
<div id="article_preview_text">
</div>
<div align="left">
<form style="margin:0;" name="content_save" id="content_save" method="post" action="<?php echo Yii::app()->createUrl('admin/generator/save/') ?>">
<? // подключить опции начального выбора макета:
require_once $includes.'choice_init.php';?>
<? // подключить кнопки управления макетом:
require_once $includes.'tmpl_commands.php';?>
<? // подключить текущие модули:
require_once $includes.'sel_modules.php';?>
    <!--	БЛОК ДИНАМИЧЕСКОЙ ГЕНЕРАЦИИ МАКЕТА	-->
    <div id="<?="tmplPlace"?>">
        <div id="<?="tmplInner"?>"></div>
    </div>
<? // подключить опции метаописания, выбора родительского раздела, заголовка, названия страницы и алиаса:
require_once $includes.'save_tmpl_block.php';?>  	
</form>    
</div>
<? // подключить WYSWYG-редактор и его опции:
require_once $includes.'editor.php';?>