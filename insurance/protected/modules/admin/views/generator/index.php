<? //
if ($inExViews)
	$go_action='editView';
else
	$go_action=(isset($data))? "update?id=".$data['id']:"save";?>
<DIV align="left" id="testBlockInfoBottom" class="testBlock pFixed" style="right:0; bottom:0; color:#F00; display:<?="none"?>;">&nbsp;</DIV>
<? // var_dump("<h1>data:</h1><pre>",$data,"</pre>"); die();
if (isset($data)) // подключить скрипт с js-обработкой существущего макета:
	require_once Yii::getPathOfAlias('webroot')."/js/admin/generator/edit_template.php";
$groot=$this->groot; // директория Генератора
$includes=$groot.'includes/'; // директория подключаемых файлов
// вывести блок контроля Layout в тестовом режиме:
require_once $includes.'test_control.php';
//$this->breadcrumbs=array($this->module->id,);?>
<div id="article_preview_text">
</div>
<div align="left">
<form style="margin:0;" name="content_save" id="content_save" method="post" action="
<?=Yii::app()->createUrl('admin/generator/'.$go_action)?>">
<?	 	
if(!$inExViews){
	// подключить опции начального выбора макета:
	require_once $includes.'choice_init.php';?>
	<? // подключить кнопки управления макетом:
	require_once $includes.'tmpl_commands.php';?>
	<? // подключить текущие модули:
	require_once $includes.'sel_modules.php';?>
    <!--	БЛОК ДИНАМИЧЕСКОЙ ГЕНЕРАЦИИ МАКЕТА	-->
    <div id="<?="tmplPlace"?>">
        <div id="<?="tmplInner"?>"></div>
    </div>
<? 
}
// подключить опции метаописания, выбора родительского раздела, заголовка, названия страницы и алиаса:
require_once $includes.'save_tmpl_block.php';?>  	
</form>    
</div>
<? // подключить WYSWYG-редактор и его опции:
if(!$inExViews)
	require_once $includes.'editor.php';?>