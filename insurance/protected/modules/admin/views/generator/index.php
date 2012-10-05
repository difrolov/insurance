<?php
/* @var $this DefaultController */

$this->breadcrumbs=array(
	$this->module->id,
);/*?><h1><?php echo $this->uniqueId . '/' . $this->action->id; ?></h1><? */?>
<div align="left">
<h5>Выберите параметры макета создаваемой страницы</h5>
<div id="mng">
	<div id="txtActions">
    	<div>Схема макета:</div>
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
<? //<div id="test">test block</div>?>
<button id="<?="loadTemplate"?>" type="button" onClick="loadTemplate();">Загрузить макет</button>
<div id="<?="tmplPlace"?>">
	<div>Выберите модули для размещения на странице:</div>
	<div id="select_mod">
    	<div>Новости</div>
        <div>Готовое решение</div>
        <div>Программа страхования</div>
        <div>Случайная статья</div>
        <div>Текст</div>
    </div>
	<div id="<?="tmplInner"?>"></div>
</div>
</div>